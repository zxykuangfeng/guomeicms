<?php
defined('PHP168_PATH') or die();
@set_time_limit(0);
$this_controller->check_admin_action($ACTION) or message('no_privilege');

$system = isset($_REQUEST['system']) ? $_REQUEST['system'] : '';
$site = isset($_REQUEST['site']) ? $_REQUEST['site'] : '';
$model = isset($_REQUEST['model']) ? $_REQUEST['model'] : '';
$word = isset($_REQUEST['word']) ? p8_stripslashes2(trim($_REQUEST['word'])) : '';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
$incremental = isset($_REQUEST['incremental']) && $_REQUEST['incremental'] ? true : false;
$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
$page = max($page, 1);
$word_censor_table = $core->TABLE_.'word_censor';

if(REQUEST_METHOD == 'GET'){
	$sql = "show tables LIKE '$word_censor_table'";
	$ret = $DB_master->fetch_all($sql);
	if(empty($ret)) message('word_censor_table_err');
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
	$select->from($word_censor_table, '*');
		
	$models = array();
	if($system){
		$select_system = &$core->load_system($system);
		$select_item = $select_system->load_module('item');
		$site = $site ? $site : $select_system->SITE;
		$models = $select_system->get_models(true);
		$select->in('system', $system);
		$page_url .= '&system='.$system;
	}
	if($model){
		$select->in('model', $model);
		$page_url .= '&model='.$model;
	}
	if(strlen($word)) $select->search('message', $word);
	if($site){
		$select->in('site', $site);
		$page_url .= '&site='.$site;
	}
	
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
		$list[$key]['id'] = $item['id'];
		$list[$key]['create_time'] = $item['create_time'] ? date('Y-m-d H:i:s',$item['create_time']) : '';
		$list[$key]['system'] = $item['system'] == 'cms' ? '主站' : '分站';					
		$list[$key]['site'] = $sites[$item['site']]['sitename'] ? $sites[$item['site']]['sitename'] : $item['site'];
		$list[$key]['iid'] = $item['iid'];					
		if($item['system']=='sites')
			$list[$key]['view'] = $core->url.'/s.php/'.$item['site'].'/item-view-id-'.$item['iid'];
			$list[$key]['view'] = str_replace('index.php/sites/../../s.php/','s.php/',$list[$key]['view']);
		if($item['system']=='cms')
			$list[$key]['view'] = $systems['cms']['controller'].'/item-view-id-'.$item['iid'];
		$list[$key]['message'] = $item['message'];	
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
		case 'rebuild':
			$config = $core->get_config('core','');
			if(empty($config['content_censor_enabled'])){
				message($P8LANG['censor_enable_error'],$this_url,2);
				exit;
			}else{
				if(empty($config['content_censor_appid']) || empty($config['content_censor_secretid']) || empty($config['content_censor_secretkey'])){
					message($P8LANG['censor_config_error'],$this_url,2);
					exit;
				}
			}
			$models = array();
			$form = '';
			if($system){
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$models = $select_system->get_models(true);
				if(!$incremental) $core->DB_master->delete($word_censor_table, "`system`='$system'");
				foreach($models as $n_model => $v_model){
					$select_item->set_model($n_model);
					$table = $select_item->addon_table;					
					$sql = "select count(*) as count from $table";
					if($incremental){					
						$ret = $core->DB_master->fetch_one("select max(create_time) as create_time from $word_censor_table where `system` = '$system' and `model`='$n_model'");
						$create_time = $ret['create_time'] ? intval($ret['create_time']) : 0;
						if($create_time) $sql .= " and `create_time` > $create_time";
					}
					$ret = $core->DB_master->fetch_one($sql);
					if($ret['count']>0){
						for($i=1;$i<=ceil($ret['count']/300);$i++){
						$form .= '<form action="'.$this_url.'" method="post" id="'. $n_model.'_'.$i.'" target="'. $n_model.'_'.$i.'">'.
							'<input type="hidden" name="model" value="'.$n_model.'">'.
							'<input type="hidden" name="system" value="'.$system.'">'.
							'<input type="hidden" name="page" value="'.$i.'">'.
							'</form>'.
							'<iframe style="display: none;" name="'. $n_model.'_'.$i .'"></iframe>'.
							'<script type="text/javascript">document.getElementById("'. $n_model.'_'.$i.'").submit();</script>';
						}
					}
				}
			}
			message($P8LANG['doing'].$form,$this_url,20);	
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
			$select->from($word_censor_table, 'id,system,module,site,iid,message');
			if($system) $select->in('system', $system);
			if($site) $select->in('site', $site);
			if($model) $select->in('model', $model);
			if(strlen($word)) $select->search('message', $word);
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
				$data[$key]['id'] = $item['id'];
				$data[$key]['create_time'] = $item['create_time'] ? date('Y-m-d H:i:s',$item['create_time']) : '';
				$data[$key]['system'] = $item['system'] == 'cms' ? '主站' : '分站';					
				$data[$key]['site'] = $sites[$item['site']]['sitename'] ? $sites[$item['site']]['sitename'] : $item['site'];
				$data[$key]['iid'] = $item['iid'];					
				if($item['system']=='sites')
					$data[$key]['view'] = $systems['sites']['controller'].'/../../s.php/'.$item['site'].'/item-view-id-'.$item['iid'];
					$data[$key]['view'] = str_replace('index.php/sites/../../s.php/','s.php/',$data[$key]['view']);
				if($item['system']=='cms')
					$data[$key]['view'] = $systems['cms']['controller'].'/item-view-id-'.$item['iid'];
				$data[$key]['message'] = $item['message'];	
			}
			$head = array(
				'id'=>'id',
				'create_time'=> '扫描时间',
				'system' => '系统',			
				'site' => '站点',
				'iid' => '信息ID',			
				'view' => '关联信息URL',
				'message' => '云审核结果',				
			);

			//print_r($list);exit;
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
		default :			
			if($system && $model){
				//取数据
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$select = select();
				$select_item->set_model($model);
				$select->from($select_item->addon_table, '*');
				if($system == 'sites'){
					$allsites  = $select_system->get_sites();					
					$select->from($select_item->addon_table, '`site`,`iid`,`content`');
					//$select->in('site',$sites_arr);
				}
				if($system == 'cms')
					$select->from($select_item->addon_table, '`iid`,`content`');
					$list = $core->list_item(
						$select,
						array(
							'ms' => 'master',
							'sphinx' => null,
							'page' => $page,
							'page_size' => 300,
						));
				foreach($list as $key=>$item){
					if($system == 'sites' && $item['site'] && !isset($allsites[$item['site']])){
						continue;
					}
					$ms = $core->controller($select_item)->aipcontentcensor($item['content'],true);
					if($ms !== true){
						$core->DB_master->insert(
							$word_censor_table,
							array(
								'create_time' => P8_TIME,
								'system' => $system,
								'module' => 'item',
								'site' => isset($item['site']) ? $item['site'] : 'mainstation',
								'iid' => $item['iid'],
								'model' => $model,
								'message' => $ms
							)
						);
					}
				}		
			}
			message('doing',$this_url,20);
		break;
	}	
}