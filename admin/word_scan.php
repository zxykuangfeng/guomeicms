<?php
defined('PHP168_PATH') or die();
@set_time_limit(0);
$this_controller->check_admin_action($ACTION) or message('no_privilege');
$_REQUEST = p8_stripslashes2(xss_clear($_REQUEST));
$system = isset($_REQUEST['system']) ? $_REQUEST['system'] : '';
$site = isset($_REQUEST['site']) ? $_REQUEST['site'] : '';
$model = isset($_REQUEST['model']) ? $_REQUEST['model'] : '';
$word = isset($_REQUEST['word']) ? trim($_REQUEST['word']) : '';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : $P8LANG['doing'];
$persentage = isset($_REQUEST['persentage']) ? floatval($_REQUEST['persentage']) : 0;
$persentage = round($persentage/10,1);
$count_all = isset($_REQUEST['count_all']) ? intval($_REQUEST['count_all']) : 0;
$pages = isset($_REQUEST['pages']) ? intval($_REQUEST['pages']) : 0;
$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
$page = max($page, 1);
$word_scan_table = $core->TABLE_.'word_scan';
$path = substr($STATIC_URL, -1) != '/' ? $STATIC_URL : substr($STATIC_URL,0,-1);//去/
if(REQUEST_METHOD == 'GET'){
	$sql = "show tables LIKE '$word_scan_table'";
	$ret = $DB_master->fetch_all($sql);
	if(empty($ret)) message('word_scan_table_err');
	$systems = $core->list_systems();
	$get_sites = $sites = array();
	if($systems['sites']){
		$sites_system = &$core->load_system('sites');
		$get_sites = $sites_system->get_sites();		
	}
	$sites['mainstation'] = array('alias'=>'mainstation','sitename'=>'主站');
	$sites = array_merge($sites,$get_sites);
	
	$page_size = 20;
	$count = 0;
	$page_url = $this_url .'?word='. urlencode($word);
	
	$select = select();	
	$select->from($word_scan_table.' AS i', 'i.*');
		
	$models = array();
	if($system){
		$select_system = &$core->load_system($system);
		$select_item = $select_system->load_module('item');
		$site = $site ? $site : $select_system->SITE;
		$models = $select_system->get_models(true);
		$select->in('i.system', $system);
		$page_url .= '&system='.$system;
	}
	if($model){
		$select->in('i.model', $model);
		$page_url .= '&model='.$model;
	}
	if(strlen($word)) $select->search('i.message', $word);
	if($site){
		$select->in('i.site', $site);
		$page_url .= '&site='.$site;
	}
	$select->left_join($core->TABLE_.'member as m', 'm.username,m.name', 'm.id=i.uid');
	$select->order('id DESC');
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => $page_size,
			'ms' => 'master',
			'sphinx' => null
		)
	);
	foreach($list as $key=>$item){
		$list[$key]['create_time'] = $item['create_time'] ? date('Y-m-d H:i',$item['create_time']) : '';
		$list[$key]['timestamp'] = $item['timestamp'] ? date('Y-m-d H:i',$item['timestamp']) : '';
		$list[$key]['system'] = $item['system'] == 'cms' ? '主站' : '分站';					
		$list[$key]['site'] = $sites[$item['site']]['sitename'] ? $sites[$item['site']]['sitename'] : $item['site'];
		$list[$key]['username'] = $item['username'].($item['name']? ' | '.$item['name']:'');
		if($item['system']=='sites'){
			$list[$key]['view'] = $path.'/s.php/'.$item['site'].'/item-view-id-'.$item['iid'];
		}		
		$list[$key]['view'] = str_replace('index.php/sites/../../s.php/','s.php/',$list[$key]['view']);
		
		if($item['system']=='cms')
			$list[$key]['view'] = $systems['cms']['controller'].'/item-view-id-'.$item['iid'];
		if(strrpos($list[$key]['view'],"http://") === FALSE && strrpos($list[$key]['view'],"https://") === FALSE){
			$list[$key]['view'] = substr($list[$key]['view'],0,1) != '/' ? '/'.$list[$key]['view'] : $list[$key]['view'];//加/
			$list[$key]['view'] = $path.$list[$key]['view'];
		}	
	}
	$page_url .= '&page=?page?';
	
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));
	include template($this_system, 'syscheck/'.$ACTION, 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	switch($type){
		case 'recycle':
			$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
			$id or message($P8LANG['fail']);			
			$select = select();	
			$select->from($word_scan_table, 'system,site,id,iid');
			$select->in('id',$id);
			$lists = $core->list_item($select,array());
			$$has_cms = $has_sites = false;
			//cms
			$form = '<form action="'.$core->admin_controller.'/cms/item-verify" method="post" id="cms" target="cms">';
			$form .= '<input type="hidden" name="value" value="88">';
			$form .= '<input type="hidden" name="verified" value="1">';
			//sites
			$sites_form = '<form action="'.$core->admin_controller.'/sites/item-verify" method="post" id="sites" target="sites">';
			$sites_form .= '<input type="hidden" name="value" value="88">';
			$sites_form .= '<input type="hidden" name="verified" value="1">';
			foreach($lists as $list){
				if($list['system'] == 'cms'){
					$has_cms = true;
					$form .= '<input type="hidden" name="id[]" value="'.$list['iid'].'" />';				
				}else{
					$has_sites = true;
					$sites_form .= '<input type="hidden" name="id[]" value="'.$list['iid'].'" />';
				}
			}
			$form .= '</form><iframe style="display: none;" name="cms"></iframe>';
			$form .= '<script type="text/javascript">document.getElementById("cms").submit();</script>';
			
			$sites_form .= '</form><iframe style="display: none;" name="sites"></iframe>';
			$sites_form .= '<script type="text/javascript">document.getElementById("sites").submit();</script>';
			$message = $P8LANG['done'].($has_cms ? $form : '').($has_sites ? $sites_form : '');
			//同步删除扫描记录
			$core->DB_master->delete($word_scan_table, 'id IN ('. implode(',', $id) .')');
			message($message,$this_url,1);
		break;
		case 'cleanall':
			$core->DB_master->delete($word_scan_table, "id>0");
			message('done',$this_url);
		break;
		case 'rebuild':
			$models = array();
			$form = '';
			if($system){
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$models = $select_system->get_models(true);
				if($site)
					$core->DB_master->delete($word_scan_table, "`system`='$system' and `site`='$site'");
				else
					$core->DB_master->delete($word_scan_table, "`system`='$system'");
				
				$all_models = array_keys($models);
				//第一个模型
				$n_model = current($all_models);
				$select_item->set_model($n_model);
				$main_table = $select_item->main_table;
				$table = $select_item->addon_table;				
				$sql_all = "select count(*) as count from $main_table";
				$sql = "select count(*) as count from $table";
				if($site) {
					$sql_all .= " where `site` = '$site'";
					$sql .= " where `site` = '$site'";
				}
				$ret_all = $core->DB_master->fetch_one($sql_all);
				$ret = $core->DB_master->fetch_one($sql);
				//初始化
				___poster(p8lang($P8LANG['scanning'],array(0)),0,$n_model,$system,$page,$ret['count']>0 ? ceil($ret['count']/50):0,$ret_all['count']>0?$ret_all['count']:0,$site);			
				
			}
		break;
		case 'cleanall':
			$core->DB_master->delete($word_scan_table, "id>0");
			message('done',$this_url);
			exit;
		break;
		case 'get_model':
			$models = array();
			if($system){
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$models = $select_system->get_models(true);
			}
			exit(p8_json($models));
		break;
		case 'download':
			$systems = $core->list_systems();
			$get_sites = $sites = array();
			if($systems['sites']){
				$sites_system = &$core->load_system('sites');
				$get_sites = $sites_system->get_sites();		
			}
			$sites['mainstation'] = array('alias'=>'mainstation','sitename'=>'主站');
			$sites = array_merge($sites,$get_sites);
			$select = select();	
			$select->from($word_scan_table.' AS i', 'i.*');
			if($system) $select->in('i.system', $system);
			if($site) $select->in('i.site', $site);
			if($model) $select->in('i.model', $model);
			if(strlen($word)) $select->search('i.message', $word);
			$select->left_join($core->TABLE_.'member as m', 'm.username,m.name', 'm.id=i.uid');
			$select->order('id DESC');
			$list = $core->list_item(
				$select,
				array(				
					'ms' => 'master',
					'sphinx' => null
				)
			);
			$data = array();
			foreach($list as $key=>$item){
				if(!$item['title']) continue;				
				$data[$key]['system'] = $item['system'] == 'cms' ? '主站' : '分站';					
				$data[$key]['site'] = $sites[$item['site']]['sitename'] ? $sites[$item['site']]['sitename'] : $item['site'];
				$data[$key]['title'] = $item['title'];
				$data[$key]['timestamp'] = $item['timestamp'] ? date('Y-m-d H:i',$item['timestamp']) : '';
				$data[$key]['username'] = $item['username'] .($item['name']? ' | '.$item['name']:'');
				$data[$key]['author'] = $item['author'] ? $item['author'] : '';
				$data[$key]['create_time'] = $item['create_time'] ? date('Y-m-d H:i',$item['create_time']) : '';
				if($item['system']=='sites'){
					$data[$key]['view'] = $path.'/s.php/'.$item['site'].'/item-view-id-'.$item['iid'];
				}
				$data[$key]['view'] = str_replace('index.php/sites/../../s.php/','s.php/',$data[$key]['view']);
				
				if($item['system']=='cms')
					$data[$key]['view'] = $systems['cms']['controller'].'/item-view-id-'.$item['iid'];
				if(strrpos($data[$key]['view'],"http://") === FALSE && strrpos($data[$key]['view'],"https://") === FALSE){
					
					$data[$key]['view'] = substr($data[$key]['view'],0,1) != '/' ? '/'.$data[$key]['view'] : $data[$key]['view'];//加/
					$data[$key]['view'] = $path.$data[$key]['view'];
				}
				$data[$key]['message'] = str_replace(array('<font color="#0000FF">','</font>'),'',$item['message']);	
			}
			$head = array(
				'system' => $P8LANG['system'],	
				'site' => $P8LANG['site'],
				'title' => $P8LANG['title'],
				'timestamp' => $P8LANG['timestamp'],
				'username' => $P8LANG['username'],
				'author' => $P8LANG['author'],
				'create_time'=> '扫描时间',			
				'view' => $P8LANG['url'],
				'message' => '扫描结果',
			);

			array_unshift($data,$head);
			$data = convert_encode("UTF-8","GB2312",$data);
			require PHP168_PATH.'/inc/csv.class.php';
			$filename = 'filter_link-'.date('Y-m-d-H-i-s', P8_TIME).'.csv';
			$csv = new P8_Csv();
			$csv->data = $data;
			$csv->file = 'php://output';
			header("Content-type:application/vnd.ms-excel;charset=UTF-8");
			header('Last-Modified: '. gmdate('D, d M Y H:i:s', P8_TIME) .' GMT');
			header('Pragma: no-cache');
			header('Content-type: text/csv');
			header('Content-Encoding: none');
			header('Content-Disposition: attachment; filename='. $filename);
			header('Content-type: csv');
			$csv->save();
			exit;		
		break;
		case 'build':
			if($system && $model){
				//取数据
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$select = select();
				$select_item->set_model($model);
				if($system == 'sites'){
					$allsites  = $select_system->get_sites();					
					$select->from($select_item->addon_table ." AS a", 'a.site,a.iid,a.content');
					if($site) $select->in('a.site',$site);
				}else{
					$select->from($select_item->addon_table ." AS a", 'a.iid,a.content');
				}
				$select->left_join($select_item->main_table ." AS i", 'i.title,i.author,i.timestamp,i.uid','a.iid = i.id');
				
				$table = $select_item->addon_table;					
				$sql = "select count(*) as count from $table";
				if($site) $sql .= " where `site` = '$site'";
				$ret = $core->DB_master->fetch_one($sql);
				$get_pages = $ret['count']>0 ? ceil($ret['count']/50):0;
				$count = $ret['count'] >0 ? ($page < $pages ? 50 : $ret['count']%50) : 0;
				$persentage = $count >0 ? round($persentage + 100*($count/$count_all),1) : $persentage;
				$persentage = $persentage>= 99 ? 99.9 : $persentage;
				$list = $core->list_item(
					$select,
					array(
						'ms' => 'master',
						'sphinx' => null,
						'page' => $page,
						'page_size' => 50,
					)
				);
				foreach($list as $key=>$item){
					if($system == 'sites' && $item['site'] && !isset($allsites[$item['site']])){
						continue;
					}
					if(!$item['title']) continue;
					$ms = valid_word_scan($item['content']);
					if($ms && $ms !== true){
						$core->DB_master->insert(
							$word_scan_table,
							array(
								'create_time' => P8_TIME,
								'timestamp' => $item['timestamp'],
								'uid' => $item['uid'],
								'system' => $system,
								'module' => 'item',
								'site' => isset($item['site']) ? $item['site'] : 'mainstation',
								'title' => $item['title'],
								'author' => $item['author'],
								'iid' => $item['iid'],
								'model' => $model,
								'message' => implode(',',$ms)
							)
						);
					}
				}		
			}
			
			$models = $select_system->get_models(true);
			$all_models = array_keys($models);
			//最后一个模型时
			if($model == end($all_models)){
				//最后一页时
				if($get_pages==0 || $page>=$get_pages){
					message('done',$this_url,1);
				}else{
					___poster(p8lang($P8LANG['scanning'],array($persentage)),$persentage,$model,$system,++$page,$get_pages,$count_all,$site);
				}
			}else{
				if($get_pages==0 || $page>=$get_pages){
					$index = array_search($model,$all_models)+1;
					$model = $all_models[$index];			
					___poster(p8lang($P8LANG['scanning'],array($persentage)),$persentage,$model,$system = $system,1,$get_pages,$count_all,$site);
				}else{
					___poster(p8lang($P8LANG['scanning'],array($persentage)),$persentage,$model,$system = $system,++$page,$get_pages,$count_all,$site);
				}
			}			
			break;
	}	
}
function ___poster($message = '',$persentage,$model ='',$system = '',$page = 1,$pages = 1,$count_all= 0,$site = ''){

	global $this_url;
	$form = <<<FORM
$message
<form action="$this_url" method="post" id="form">
<input type="hidden" name="message" value="{$message}">
<input type="hidden" name="model" value="{$model}">
<input type="hidden" name="system" value="{$system}">
<input type="hidden" name="persentage" value="{$persentage}">
<input type="hidden" name="count_all" value="{$count_all}">
<input type="hidden" name="pages" value="{$pages}">
<input type="hidden" name="page" value="{$page}">
<input type="hidden" name="type" value="build">
<input type="hidden" name="site" value="{$site}">
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 100);
</script>
FORM;
	message($form);
}