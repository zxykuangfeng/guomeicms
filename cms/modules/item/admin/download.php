<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	$category = &$this_system->load_module('category');
	$category->get_cache();
	$MODEL = $_POST['model'] ? xss_clear($_POST['model']) : 'aritcle';
	$models = $this_system->get_models();
	if(!array_key_exists($MODEL,$models)){
		message('fail');
	}
	$key_word = isset($_POST['key_word']) ? trim($_POST['key_word']) : '';
	$key_type = isset($_POST['key_type']) ? trim($_POST['key_type']) : '';
	if(in_array($key_type,['id','keyword','username','allitem','author','verifier','source','url','regexp_mobile','regexp_id'])){
		$_POST[$key_type] = $key_word;
		${$key_type} = $key_word;
	}
	
	$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
	$keyword = $keyword ? $keyword : (isset($_POST['word']) ? trim($_POST['word']) : '');
	$username = isset($_POST['username']) ? trim($_POST['username']) : '';
	$author = isset($_POST['author']) ? trim($_POST['author']) : '';
	$verifier = isset($_POST['verifier']) ? trim($_POST['verifier']) : '';
	$source = isset($_POST['source']) ? trim($_POST['source']) : '';
	$url = isset($_POST['url']) ? trim($_POST['url']) : '';
	$allitem = isset($_POST['allitem']) ? trim($_POST['allitem']) : '';
	$regexp_mobile = isset($_POST['regexp_mobile']) ? true : false;
	$regexp_id = isset($_POST['regexp_id']) ? true : false;
	
	$this_system->init_model();
	$sphinx['index'] = $this_system->sphinx_indexes(array($MODEL => 1));
	//搜索开始
	$select = select();
	$select->from($this_module->table .' AS i', 'i.*');
	//搜索条件
	$select->in('i.model', $MODEL);
	$mindate = isset($_POST['mindate']) ? strtotime($_POST['mindate']) : null;
	$maxdate = isset($_POST['maxdate']) ? strtotime($_POST['maxdate']) : null;
	!$mindate && $mindate = null;
	!$maxdate && $maxdate = null;
	if($mindate || $maxdate){
		$select -> range('i.timestamp', $mindate, $maxdate);
	}
	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	if($cid){
		$ids = array($cid) + $category->get_children_ids($cid);
		
		$select->in('i.cid', $ids);
	}
	$select->order('i.id desc');	
	$select->left_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = i.cid');
	
	if(strlen($keyword)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.title', $keyword);
	}
	if(strlen($username)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.username', $username);
	}
	if(strlen($verifier)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.verifier', $verifier);
	}
	if(strlen($author)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.author', $author);
	}
	if(strlen($source)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.source', $source);
	}
	if(strlen($url)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.url', $url);
	}
	if(strlen($allitem)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
		$select->search('a.content', $allitem,'(');
		$select->where_or();
		$select->search('i.title', $allitem,'',')');
	}
	if($regexp_mobile){
		$use_sphinx = $verified == 1 ? true : false;
		$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
		if(empty($_GET['regexp_mobile']))
			$select->where("`content` REGEXP '[^0-9](13|14|15|17|18|19)[0-9]{9}[^0-9]'");
		else{
			$mobile = preg_replace('/[^\d]/','',$_GET['regexp_mobile']);
			$select->where("`content` like '%{$mobile}%'");
		}        
	}
	if($regexp_id){
		$use_sphinx = $verified == 1 ? true : false;
		$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
		if(empty($_GET['regexp_id']))
			$select->where("(`content` REGEXP '[^1-9][0-9]{6}(19|20)[0-9]{2}(0[1-9]|10|11|12)(([0-2][1-9])|10|20|30|31)[0-9]{3}[0-9xX]{1}[^0-9xX]'  OR `content` REGEXP '[^1-9][0-9]{6}[0-9]{2}(0[1-9]|10|11|12)(([0-2][1-9])|10|20|30|31)[0-9]{2}[^0-9]')");
		else{
			$regexp_id = preg_replace('/[^\dxX]/','',$_GET['regexp_id']);
			$select->where("`content` like '%{$regexp_id}%'");
		}
	}
	
	$count = 0;
	//取数据
	$list = $core->list_item($select);	
	//echo $select->build_sql();
	foreach($list as $key=>$item){
		$list[$key]['level'] = isset($P8LANG['cms_item']['level_rank'][$item['level']]) && $item['level']>240 ? $P8LANG['cms_item']['level_rank'][$item['level']] : $item['level'];
		if(!empty($list[$key]['source'])){
			$emp_source = explode('|',$list[$key]['source']);
			$list[$key]['source'] = $emp_source[0];
			$list[$key]['sourceurl'] = $emp_source[1];
		}
	}
	//属性JSON
	$attributes = array();
	foreach($this_module->attributes as $aid => $lang){
		$attributes[$aid] = $P8LANG['cms_item']['attribute'][$aid];
	}
	foreach($list as $key=>$value){
		$fv = array();		
		$fv['id'] = $value['id'];		
		$fv['username'] = $value['username'];
		$fv['cid'] = $value['cid'];			
		$fv['category_name'] = $value['category_name'];
		$fv['title'] = $value['title'];
		$fv['turl'] = $value['url'] ? html_entity_decode($value['url'],ENT_QUOTES) : '';
		$fv['url'] = $value['url'] ? html_entity_decode($value['url'],ENT_QUOTES) : $this_module->controller.'-view-id-'.$fv['id'].'.html';
		$fv['surl'] = $STATIC_URL.'/html/'.$value['cid'].'/'.date('Y-m-d',$value['timestamp']).'/content-'.$value['id'].'.html';
		
		$attr = explode(',',$value['attributes']);
		$attrs = '';
		$dom = '';
		foreach($attr as $v){
			if($attributes[$v]){
				$attrs .= $dom.$attributes[$v];
				$dom = ',';
			}
		}
		$fv['attribute'] = $attrs;
		$fv['source'] = $value['source'];
		$fv['author'] = $value['author'];
		$fv['editer'] = $value['editer'];
		$fv['timestamp'] = date('Y-m-d h:i:s',$value['timestamp']);
		$fv['create_time'] = $value['create_time'] ? date('Y-m-d h:i:s',$value['create_time']) : '';
		$fv['update_time'] = $value['update_time'] ? date('Y-m-d h:i:s',$value['update_time']) : '';				
		$fv['verify_time'] = $value['verify_time'] ? date('Y-m-d h:i:s',$value['verify_time']) : '';
		$fv['verifier'] = $value['verifier'];
		$fv['views'] = $value['views'];
		$fv['level'] = $value['level'];
		$fv['score'] = $value['score'];			
		foreach($this_model['fields'] as $field => $field_data){
			if(!$field_data['list_table']) continue;
			switch($field_data['widget']){				
				//分割多选项
				case 'radio':case 'select':case 'city':
					foreach($field_data['data'] as $k => $v){
						if($value[$field] == $k)$fv[$field] =  $v;
					}
				break;
				case 'checkbox':case 'multi_select':
					$tmp = explode($delimiter, $value[$field]);
					$_v = array();
					foreach($tmp as $vv){
						foreach($field_data['data'] as $k => $v){
							if($vv == $k) $_v[] = $v;
						}
					}
					$fv[$field] = implode(',',$_v);
				break;
				//上传器,编辑器要对附件地址处理
				case 'editor': case 'editor_basic': case 'editor_common':case 'ueditor': case 'ueditor_common':
					$fv[$field]  = attachment_url($value[$field]);
				break;
				
				case 'uploader': case 'image_uploader':
					$value[$field] = str_replace($delimiter,'|', attachment_url($value[$field]));
					$fv[$field] = str_replace('||','', $value[$field]);
				break;
				
				//多上传器
				case 'multi_uploader': case 'video_multi_uploader':
					$_dd = str_replace($delimiter,'|', attachment_url($value[$field]));
					$value[$field] = str_replace($col_delimiter,"\r\n" , $_dd);
					$fv[$field] = str_replace('||','', $value[$field]);
				break;	
				case 'link':
					$fv[$field] = preg_match("/^(http|https)/i",$value[$field])? $value[$field] : 'http://'.$value[$field];
				break;
				//时间选择器
				case 'textdate':
					$fv[$field] = empty($value[$field]) ? '' : date('Y-m-d',$value[$field]);
				break;
                case 'linkage': 
                    $values = explode('-',$value[$field]);
                    $resust = array();
                    $filedata = mb_unserialize($field_data['data']['select_data']);
                
                    foreach($values as $key=>$val){
                        if($key==0)
                            $filedata = !empty($filedata[$val])? $filedata[$val] : array();
                        else
                            $filedata = !empty($filedata['s'][$val])? $filedata['s'][$val] : array();;
                        if($val && !empty($filedata))$resust[$val] = $filedata['n'];
                    }
                    
                    $fv[$field] = implode('/',$resust);
                    break;
				default:
					$fv[$field] = isset($value[$field]) ? $value[$field] : '';
			}
			unset($value[$field]);
		}
		$fv += $fv;
		foreach($fv as $k => $v){
			$fv[$k] = $v."\t";
		}
		$list[$key] = $fv;
	}		
	$head = array(
		'id'=>'id',		
		'username' => $P8LANG['username'],		
		'cid' => $P8LANG['cid'],
		'category_name'=> $P8LANG['category_name'],
		'title' => $P8LANG['title'],
		'turl' => $P8LANG['turl'],
		'url' => $P8LANG['url'],
		'surl' => $P8LANG['surl'],
		'attribute' => $P8LANG['cms_item']['attribute'][''],
		'source' => $P8LANG['source'],
		'author' => $P8LANG['author'],
		'editer' => $P8LANG['editer'],
		'timestamp' => $P8LANG['timestamp'],
		'create_time' => $P8LANG['create_time'],
		'update_time' => $P8LANG['update_time'],		
		'verify_time' => $P8LANG['verify_time'],
		'verifier' => $P8LANG['verifier'],
		'views' => $P8LANG['views'],
		'level' => $P8LANG['level'],
		'score' => $P8LANG['score'],
	);
	foreach($this_model['fields'] as $field=>$field_data){
		if(!$field_data['list_table']) continue;
		$head[$field] = $field_data['alias'].($field_data['units']? "($field_data[units])" : '');
	}

	//print_r($list);exit;
	array_unshift($list,$head);
	$list = convert_encode("UTF-8","GB2312",$list);
	require PHP168_PATH.'/inc/csv.class.php';
	$filename = 'cms-'.date('Y-m-d-h-i-s', P8_TIME).'.csv';
	$csv = new P8_Csv();
	$csv->data = $list;
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

}