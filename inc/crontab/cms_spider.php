<?php
/**
 * 自动采集
 * Power by php168.net
 * User: bingbin
 * Date: 2022/8/21
 * Time: 11:07
 */
defined('PHP168_PATH') or die();

$spider = &$core->load_module('spider');



$select = select();
$select->from($spider->rule_table, 'id,timestamp');
$query = $select->build_sql();
$llist = $core->DB_master->fetch_all($query);

foreach ($llist as $itemm) {

    $ssssssid = $itemm['id'];
    //规则ID
    $ssssssid or message('access_denied');
    $rule = $spider->get_rule($ssssssid, false, true);
    if (empty($rule)) {
        continue;
    }

    if($rule['data']['enable']!=1)continue;

    if($rule['data']['save_space']=='cms') {
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

    //初始化模型
    $_REQUEST['model'] = $CAT['model'];
	global $this_model;
    $consystem->init_model();
    $conitemmodule->set_model($CAT['model']);

    $task = [
            'rule_id'     => $ssssssid,
            'offset'      => 0,
            'done'      => 0,
            'start_time'  => P8_TIME,
            'per_time'    => 5,
            'list_offset' => $rule['data']['start'],
            'process'     => ['items'=>[],'item_pages'=>0],
        ];

        while (!$task['done']) {
            //不产生日志
            define('NO_ADMIN_LOG', true);
            

            //开始获取列表页 step:2

            while ($task['list_offset'] <= $rule['data']['end']) {
                if ($ret = $spider->capture_list($rule, $task['list_offset']++)) {
                    $task['process']['items'] = !empty($rule['data']['reverse']) ?
                        array_merge($ret['items'], $task['process']['items']) :
                        array_merge($task['process']['items'], $ret['items']);
                }
            }



            //抓内容 step:3
            $i = 0;
            $time = P8_TIME;

            $captured_items = [];
            if (
                $tmp = $DB_master->fetch_one("SELECT captured_items FROM {$spider->rule_table} WHERE id = '{$rule['id']}'")
            ) {
                $captured_items = @mb_unserialize($tmp['captured_items']);
                $captured_items = $captured_items ? $captured_items : [];
            }

            foreach ($task['process']['items'] as $url => $v) {
              
                if (!isset($captured_items[md5($url)])) {

                    

                    if (!($item = $spider->capture_item($rule, $url))) {
                        //请求失败
                        unset($task['process']['items'][$url]);
                        continue;
                    }

                    $pages = isset($item['pages']) ? $item['pages'] : false;
                    unset($item['pages']);

                    $data = [
                        'rid'            => $rule['id'],
                        'title'          => strip_tags($v['title']),
                        'timestamp'      => $time++,
                        'data'           => $item,
                        'captured_items' => '',
                    ];

                    //如果内容页没取到封面缩略图,用列表页的
                    if (empty($data['data']['frame'])) {
                        $data['data']['frame'] = $v['frame'];
                    }
					$_post = $data;
                    if($item_id = $spider->add_item($data)){
						$_post['cid'] = $ccccccid;
						$_post['verify'] = $autoVerify;
						$_post['capture_image'] = $captureImage;

						//自定义模型处理数据
						get_data($_post);
                       
						$cmsid = $conitemcontroller->add($_post, true);
					}			

                    if ($pages != $url && $pages) {
                        is_array($pages) || $pages = [$pages => 'next'];

                        $task['process']['item_pages'] = $pages;
                        $task['process']['item_id'] = $item_id;



                        //抓取内容分页 step:4
                        while (!empty($task['process']['item_pages'])) {

                            $current = current($task['process']['items']);
                            $i = 0;
                            $time = P8_TIME;
                            while (list($urll, $v) = each($task['process']['item_pages'])) {

                                $i++;
                                if ($i > $task['per_time']) {
                                    //防止超时,再跳转
                                    break;
                                }

                                if (!($item = $spider->capture_item($rule, $urll, 1))) {
                                    //请求失败
                                    unset($task['process']['item_pages'][$urll]);
                                    break;
                                }

                                if (
                                    !empty($item['pages']) && is_string($item['pages']) &&
                                    empty($task['process']['item_pages'][$item['pages']])
                                ) {
                                    //猛地下一页
                                    $task['process']['item_pages'][$item['pages']] = 'next';
                                }

                                //追加数据
                                $data = [
                                    'iid'       => $task['process']['item_id'],
                                    'timestamp' => $time++,
                                    'data'      => $item,
                                ];

                                if($spider->add_item($data)){
                                    $data['iid'] = $cmsid;

                                    get_data($data);

                                    $conitemcontroller->addon($data);
                                }

                                unset($task['process']['item_pages'][$urll]);

                            }

                            if (empty($task['process']['item_pages'])) {
                                //分页采完了, 弹出采完的URL
                                array_shift($task['process']['items']);
                            }

                        }


                    }
					$captured_items[md5($url)] = 1;
                }

                unset($task['process']['items'][$url]);
            }


            //重复项统计
            $DB_master->update(
                $spider->rule_table,
                ['captured_items' => serialize($captured_items)],
                "id = '{$rule['id']}'"
            );


            if (empty($task['process']['items'])) {
                //完成任务
                $task['done'] = true;
            }

        }

        $DB_master->update(
            $spider->TABLE_ . 'rule',
            ['timestamp' => time()],
            'id=' . $ssssssid,
            false
        );

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
