<?php
defined('PHP168_PATH') or die();

/**
* 采集内容
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){

@set_time_limit(0);
@ignore_user_abort(false);

//传送门
function _poster($id, $msg = ''){
	global $this_url, $CACHE, $MODULE, $task, $P8LANG;
	
	$CACHE->write('core/modules/'. $MODULE, 'task', $id, $task, 'serialize');
	
	$form = $msg .'
<form action="'. $this_url .'" id="form" method="post">
	<input type="hidden" name="start" value="1" />
	<input type="hidden" name="id" value="'. $id .'" />'.
	$P8LANG['spider']['refresh'] .
'</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById("form").submit(); }, 1);
</script>';
	
	message($form);
	
	exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

//初始化任务 step:1
if(empty($_POST['start'])){
	//规则ID
	$id or message('access_denied');
	
	$rule = $this_module->get_rule($id, false, true);
	if(empty($rule)) message('access_denied');

    if($rule['data']['enable']!=1)message('disable');;

	if($CACHE->read('core/modules/'. $MODULE, 'task', $id, 'serialize')){
		message(p8lang($P8LANG['spider']['task_running'], array($id)));
	}
	
	$item_per_time = isset($_POST['per_time']) ? intval($_POST['per_time']) : 5;
	
	$task = array(
		'rule_id' => $id,
		'offset' => 0,
		'start_time' => P8_TIME,
		'per_time' => $item_per_time,
		'list_offset' => $rule['data']['start'],
		'process' => array()
	);
	
	/*
	'process' => array(
		'pages' => 10,	//列表页数量
		'items' => 20,	//列表内容数
		'item_pages' => ,	//列表内容数
		'item_pages' => 10	
	)
	*/
	
	/*$config = $core->get_config('core', $MODULE);
	isset($config['running_tasks']) || $config['running_tasks'] = array();
	$config['running_tasks'][$hash] = P8_TIME;
	$this_module->set_config(array('running_tasks' => $config['running_tasks']));
	*/
	_poster($id);
}


//不产生日志
define('NO_ADMIN_LOG', true);

$task = $CACHE->read('core/modules/'. $MODULE, 'task', $id, 'serialize');

//完成了exit
if(!empty($task['done'])){
	
	$CACHE->delete('core/modules/'. $MODULE, 'task', $id);

    $DB_master->update(
        $this_module->TABLE_ .'rule',
        ['timestamp'=>time()],
        'id='.$id,
        false
    );
	
	message(p8lang($P8LANG['spider']['done'], P8_TIME - $task['start_time']), $this_router .'-rule');
}








$rule = $this_module->get_rule($task['rule_id'], false, true);
if(empty($rule)) message('access_denied');

if($rule['data']['save_space']=='cms') {
//同时写入主站内容
    $consystem = &$core->load_system('cms');
    $conitemmodule = &$consystem->load_module('item');
    $conitemcontroller = &$core->controller($conitemmodule);
}elseif($rule['data']['save_space']=='sites'){
    $consystem = &$core->load_system('sites');
    $consystem->init_site($rule['data']['sites_alias']);
    $conitemmodule = &$consystem->load_module('item');
    $conitemcontroller = &$core->controller($conitemmodule);
}

$ccccccid = $rule['data']['cms_category'];
$autoVerify = $rule['data']['auto_verify']==1;
$captureImage = $rule['data']['capture_image']==1;
$CAT = &$consystem->fetch_category($ccccccid);
global $this_model;
$_REQUEST['model'] = $CAT['model'];
$consystem->init_model();
$conitemmodule->set_model($CAT['model']);

//开始获取列表页 step:2
if(empty($task['process']['list_done'])){
	
	isset($task['process']['items']) || $task['process']['items'] = array();
	
	
	if($task['list_offset'] <= $rule['data']['end']){
		if($ret = $this_module->capture_list($rule, $task['list_offset']++)){
			$task['process']['items'] = !empty($rule['data']['reverse']) ?
				array_merge($ret['items'], $task['process']['items']) :
				array_merge($task['process']['items'], $ret['items']);
		}
		
		//goto step:2
		_poster($id, $P8LANG['spider']['item']);
	}
	
	$task['process']['list_done'] = true;
	
	//goto step: 3, 找到x条记录
	_poster( $id, p8lang($P8LANG['spider']['x_items_found'], count($task['process']['items'])) );
}


//抓取内容分页 step:4
if(!empty($task['process']['item_pages'])){
	
	$current = current($task['process']['items']);
	$i = 0;
	$time = P8_TIME;
	while( list($url, $v) = each($task['process']['item_pages']) ){
		
		$i++;
		if($i > $task['per_time']){
			//防止超时,再跳转
			break;
		}
		
		if(!($item = $this_module->capture_item($rule, $url, 1))){
			//请求失败
			unset($task['process']['item_pages'][$url]);
			break;
		}
		
		if(
			!empty($item['pages']) && is_string($item['pages']) &&
			empty($task['process']['item_pages'][$item['pages']])
		){
			//猛地下一页
			$task['process']['item_pages'][$item['pages']] = 'next';
		}
		
		//追加数据
		$data = array(
			'iid' => $task['process']['item_id'],
			'timestamp' => $time++,
			'data' => $item
		);

		$_post = $data;
		$this_module->add_item($data);

        $_post['iid'] = $task['process']['cms_id'];

        get_data($_post);

        $conitemcontroller->addon($_post);
		
		unset($task['process']['item_pages'][$url]);
		
	}
	
	if(empty($task['process']['item_pages'])){
		//分页采完了, 弹出采完的URL
		array_shift($task['process']['items']);
	}
	
	//goto step:3
	_poster( $id, p8lang($P8LANG['spider']['capture_item_page'], $current['title'], count($task['process']['item_pages'])) );
}


//抓内容 step:3
$i = 0;
$time = P8_TIME;

$captured_items = array();
if(
	$tmp = $DB_master->fetch_one("SELECT captured_items FROM $this_module->rule_table WHERE id = '$rule[id]'")
){
	$captured_items = @mb_unserialize($tmp['captured_items']);
	$captured_items = $captured_items ? $captured_items : array();
}

foreach($task['process']['items'] as $url => $v){
	$i++;
	if($i > $task['per_time']){
		//防超时,重新跳转, goto step:3
		break;
	}
	
	
	if(!isset($captured_items[md5($url)])){
		

		
		if(!($item = $this_module->capture_item($rule, $url))){
			//请求失败
			unset($task['process']['items'][$url]);
			continue;
		}
		
		$pages = isset($item['pages']) ? $item['pages'] : false; unset($item['pages']);
		
		$data = array(
			'rid' => $rule['id'],
			'title' => strip_tags($v['title']),
			'timestamp' => $time++,
			'data' => $item,
			'captured_items' => ''
		);
		
		//如果内容页没取到封面缩略图,用列表页的
		if(empty($data['data']['frame'])){
			$data['data']['frame'] = $v['frame'];
		}

        $_post = $data;
        if($item_id = $this_module->add_item($data)){
            $_post['cid'] = $ccccccid;
            $_post['verify'] = $autoVerify;
            $_post['capture_image'] = $captureImage;

            //自定义模型处理数据
            get_data($_post);
            $cmsid = $conitemcontroller->add($_post, true);

            $captured_items[md5($url)] = 1;

            if($pages != $url && $pages){
                is_array($pages) || $pages = array($pages => 'next');

                $task['process']['item_pages'] = $pages;
                $task['process']['item_id'] = $item_id;
                $task['process']['cms_id'] = $cmsid;

                //暂停内容任务去采集分页,采完分页再继续 goto step:4
                break;
            }
        }
	}
	
	unset($task['process']['items'][$url]);
}

//重复项统计
$DB_master->update(
	$this_module->rule_table,
	array( 'captured_items' => serialize($captured_items) ),
	"id = '$rule[id]'"
);


if(empty($task['process']['items'])){
	//完成任务
	$task['done'] = true;
}

_poster( $id, p8lang($P8LANG['spider']['capture_list'], count($task['process']['items'])) );

}



//获取数据
function get_data(&$POST){
    global $this_model;

    //来源
    $POST['source'] = isset($POST['data']['source_name']) ?
        $POST['data']['source_name'] . (isset($POST['data']['source_url']) ? '|'. $POST['data']['source_url'] : '') : '';
    //作者
    $POST['author'] = isset($POST['data']['author']) ? $POST['data']['author'] : '';
    //封面
    $POST['frame'] = isset($POST['data']['frame']) ? $POST['data']['frame'] : '';
    //摘要
    $POST['summary'] = isset($POST['data']['summary']) ? $POST['data']['summary'] : '';

    //發布時間也用采集的
    $POST['timestamp'] = !empty($POST['data']['timestamp']) ? str_replace('　','',trim($POST['data']['timestamp'])) : $POST['timestamp'];

    $POST['addon_title'] = isset($POST['data']['addon_title']) ? $POST['data']['addon_title'] : '';
    $POST['addon_frame'] = isset($POST['data']['addon_frame']) ? $POST['data']['addon_frame'] : '';
    $POST['addon_summary'] = isset($POST['data']['addon_summary']) ? $POST['data']['addon_summary'] : '';

    $POST['field#'] = array();

    foreach($this_model['fields'] as $field => $v){
        switch($v['widget']){

            case 'multi_uploader': case 'uploader': case 'image_uploader':
            $POST['field#'][$field] = array();

            isset($POST['data'][$field .'_title']) &&
            $POST['field#'][$field]['title'] = $POST['data'][$field .'_title'];

            isset($POST['data'][$field .'_url']) &&
            $POST['field#'][$field]['url'] = $POST['data'][$field .'_url'];

            isset($POST['data'][$field .'_thumb']) &&
            $POST['field#'][$field]['thumb'] = $POST['data'][$field .'_thumb'];
            break;

            default:
                isset($POST['data'][$field]) &&
                $POST['field#'][$field] = $POST['data'][$field];
        }
    }

    unset($POST['data']);
}
