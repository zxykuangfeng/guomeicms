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
$conn = isset($_REQUEST['conn']) ? intval($_REQUEST['conn']) : 0;
$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
$page = max($page, 1);

if(REQUEST_METHOD == 'GET'){
	$config = $core->get_config('core', '');
	$link_filter = isset($config['link_filter']) ? $config['link_filter'] : array();
	$uploader = $core->get_config('core','uploader');
	$filter = array_keys($uploader['filter']);
	$filter = array_map('strtolower',$filter);
	
	$systems = $core->list_systems();
	$system = $system && in_array($system,array_keys($systems)) ? $system : '';
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
	$select->from($core->TABLE_.'filter_link', '*');
		
	$models = array();
	if($system){
		$select_system = &$core->load_system($system);
		$select_item = $select_system->load_module('item');
		$models = $select_system->get_models(true);
		$site = $site ? $site : $select_system->SITE;
		$select->in('system', $system);
		$page_url .= '&system='.$system;
	}
	if($model){
		$select->in('model', $model);
		$page_url .= '&model='.$model;
	}	
	if($conn > 0){
		$select->in('conn', 1);
		$page_url .= '&conn=1';
	}else if($conn < 0){
		$select->in('conn', 0);
		$page_url .= '&conn=-1';
	}
	if(strlen($word)) $select->search('link', $word);
	if($site){
		$select->in('site', $site);
		$page_url .= '&site='.$site;
	}
	
	$select->order('id DESC');
	//echo $select->build_sql();
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
		$list[$key]['system'] = $item['system'] == 'cms' ? '主站' : '分站';					
		$list[$key]['site'] = $sites[$item['site']]['sitename'] ? $sites[$item['site']]['sitename'] : $item['site'];
		$list[$key]['iid'] = $item['iid'];					
		if($item['system']=='sites')
			$list[$key]['view'] = strchr($systems['sites']['controller'],'/s.php/',true).'/s.php/'.$item['site'].'/item-view-id-'.$item['iid'];
			$list[$key]['view'] = str_replace('index.php/sites/../../s.php/','s.php/',$list[$key]['view']);
		if($item['system']=='cms')
			$list[$key]['view'] = $systems['cms']['controller'].'/item-view-id-'.$item['iid'];
		$list[$key]['link'] = $item['link'];	
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
		case 'config':
			$_POST = p8_stripslashes2($_POST);
			$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
			$config['filter_link_exe'] = isset($config['filter_link_exe']) ? 1 : 0;
			$core->set_config($config);
			message('done',$this_url);
		break;
		
		case 'cleanall':
			$core->DB_master->delete($core->TABLE_.'filter_link', "id>0");
			message('done',$this_url);
		break;
		case 'rebuild':
			$models = array();		
			$form = '';
			/*
			if($system){
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$models = $select_system->get_models(true);
				if($site){
					$core->DB_master->delete($core->TABLE_.'filter_link', "`system`='$system' and `site`='$site'");
				}else{
					$core->DB_master->delete($core->TABLE_.'filter_link', "`system`='$system'");
				}
				foreach($models as $n_model => $v_model){
					$table = $select_item->main_table;
					$ret = $core->DB_master->fetch_one("select count(*) as count from $table where `model`='$n_model'");
					if($ret['count']>0){
						for($i=1;$i<=ceil($ret['count']/500);$i++){
							$form .= '<form action="'.$this_url.'" method="post" id="'. $n_model.'_'.$i.'" target="'. $n_model.'_'.$i.'">'.
								'<input type="hidden" name="model" value="'.$n_model.'">'.
								'<input type="hidden" name="system" value="'.$system.'">'.
								'<input type="hidden" name="page" value="'.$i.'">'.
								'<input type="hidden" name="site" value="'.$site.'">'.
								'</form>'.
								'<iframe style="display: none;" name="'. $n_model.'_'.$i.'"></iframe>'.
								'<script type="text/javascript">document.getElementById("'. $n_model.'_'.$i.'").submit();</script>';
						}
					}
				}
			}
			message($P8LANG['doing'].$form,$this_url,5);
			*/
			if($system){
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$models = $select_system->get_models(true);
				if($site){
					$core->DB_master->delete($core->TABLE_.'filter_link', "`system`='$system' and `site`='$site'");
				}else{
					$core->DB_master->delete($core->TABLE_.'filter_link', "`system`='$system'");
				}
				
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
			$select->from($core->TABLE_.'filter_link', 'id,system,module,site,iid,link');
			if($system) $select->in('system', $system);
			if($site) $select->in('site', $site);
			if($model) $select->in('model', $model);
			if(strlen($word)) $select->search('link', $word);
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
				$data[$key]['system'] = $item['system'] == 'cms' ? '主站' : '分站';					
				$data[$key]['site'] = $sites[$item['site']]['sitename'] ? $sites[$item['site']]['sitename'] : $item['site'];
				$data[$key]['cid'] = $item['cid'];	
				$data[$key]['iid'] = $item['iid'];					
				if($item['system']=='sites')
					$data[$key]['view'] = $systems['sites']['controller'].'/../../s.php/'.$item['site'].'/item-view-id-'.$item['iid'];
					$data[$key]['view'] = str_replace('index.php/sites/../../s.php/','s.php/',$data[$key]['view']);
				if($item['system']=='cms')
					$data[$key]['view'] = $systems['cms']['controller'].'/item-view-id-'.$item['iid'];
				$data[$key]['link'] = $item['link'];	
			}
			$head = array(
				'id'=>'id',
				'system' => '系统',			
				'site' => '站点',
				'cid' => '栏目ID',
				'iid' => '信息ID',			
				'view' => '关联信息URL',
				'link' => '外部资源或链接',				
			);

			//print_r($list);exit;
			array_unshift($data,$head);
			$data = convert_encode("UTF-8","GB2312",$data);
			require PHP168_PATH.'/inc/csv.class.php';
			$filename = 'filter_link-'.date('Y-m-d-h-i-s', P8_TIME).'.csv';
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
		break;
		case "build":
			if($system && $model){
				//取数据
				$select_system = &$core->load_system($system);
				$select_item = $select_system->load_module('item');
				$select = select();
				$select_item->set_model($model);
				if($system == 'sites'){
					$select->from($select_item->addon_table.' AS a', 'a.site,a.iid,a.content');
					if($site) $select->in('a.site',$site);
					$select->inner_join($select_item->table.' AS i','i.cid','a.iid = i.id');
				}
				if($system == 'cms'){
					$select->from($select_item->addon_table.' AS a', 'a.iid,a.content');
					$select->inner_join($select_item->table.' AS i','i.cid','a.iid = i.id');
				}
				$select->where("`content` REGEXP '[a-zA-z]+://[^\s]*'");
				$use_sphinx = true;
				$sphinx = $select_item->CONFIG['sphinx'];
				
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
						'sphinx' => $use_sphinx && $sphinx['enabled'] ? $sphinx : null,
						'page' => $page,				
						'page_size' => 50,
					)
				);
				$matches = array();
				//可信域名		
				$config = $core->get_config('core','');
				$link_filter = isset($config['link_filter']) ? $config['link_filter'] : array();
				$filter_link_exe = isset($config['filter_link_exe']) && $config['filter_link_exe'] == '1' ? true : false;
				if($core->url){
					$link_filter[] = $core->url;
				}
				//取允许上传的后缀
				$uploader = $core->get_config('core','uploader');
				$filter = array_keys($uploader['filter']);
				$filter = array_map('strtolower',$filter);
				$ch = curl_init();
				foreach($list as $key=>$item){
					preg_match_all("/([a-zA-z]+:\/\/[^\s]*)/i", $item['content'], $matches, PREG_PATTERN_ORDER);
					$matches = $matches ? array_unique($matches[0]) : array();
					if($matches){
						foreach($matches as $m=>$link){		
							//是否外链？
							$extend_link = true;
							//检测每个域
							foreach($link_filter as $extend){
								if(stristr($link,$extend)) {
									$extend_link = false;
									continue;
								}
							}
							//是外链
							if($extend_link){
								$links = explode('"',$link);
								$len = strlen($links[0]);						
								for($i = 0; $i < $len; $i++) {
									$char = substr($links[0], $i, 1);						
									$isCh = preg_match("/^[" . chr(0xa1) . "-" . chr(0xff) . "]+$/", $char); // 判断是否是中文
									if($isCh) {
										$links[0] = substr($links[0],0,$i);
										break;
									}
								}						
								$ext = end(explode('.',$links[0]));
								if(!$filter_link_exe || $filter_link_exe && !in_array(strtolower($ext),$filter)){						
									//入库
									$url = str_replace('"','',$links[0]);
									curl_setopt($ch,CURLOPT_URL,$url);
									curl_setopt($ch,CURLOPT_HEADER,1);
									curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
									$data = curl_exec($ch);
									$headers = curl_getinfo($ch);
									curl_close($ch);
									$conn = $headers['http_code'] == '200' ? 1 : 0;
									//curl失效时，尝试用另一种
									if(!$conn){
										$ret = get_headers($url, 1);
										$conn = preg_match('/200/',$ret[0]) ? 1 : 0;
									}							
									$core->DB_master->insert(
										$core->TABLE_.'filter_link',
										array(
											'system' => $system,
											'module' => 'item',
											'site' => isset($item['site']) ? $item['site'] : 'mainstation',
											'cid' => $item['cid'],
											'iid' => $item['iid'],
											'model' => $model,
											'link' => $url,
											'conn' => $conn,
										)
									);
								}
							}						
						}
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