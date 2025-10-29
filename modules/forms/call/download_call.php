<?php
defined('PHP168_PATH') or die();

if(REQUEST_METHOD == 'POST'){
	
	$iid = isset($_GET['iid'])? intval($_GET['iid']) : '';
	$viewself = false;
	$mid = isset($_POST['mid'])? intval($_POST['mid']) : '';
	$istemplate = isset($_POST['istemplate']) && $_POST['istemplate'] ? true : false;	
	$mid = $iid ? 199 : $mid;
	$this_module->set_model($mid) or message('no_such_model');
	if(!$this_controller->check_model_action('download',$mid) && empty($this_model['CONFIG']['viewself'])){
		message('no_model_privilege');
	}elseif(!$this_controller->check_model_action('download',$mid) && !empty($this_model['CONFIG']['viewself'])){
		$viewself = true;
	}
	
	
	//搜索开始
	$select = select();
	$select -> from("$this_module->table AS i", 'i.id, i.username, i.ip, i.timestamp, i.status,i.verified');
	$select -> left_join("$this_module->data_table AS d", 'd.*','i.id=d.id');
	$select -> in('i.mid', $mid);
	if($_POST['ids']) $select -> in('d.id', explode(',',$_POST['ids']));
	if($iid) $select -> in('d.iid', $iid);
	if($viewself)$select -> in('i.uid',$UID);
	//搜索条件
	$mindate = isset($_POST['mindate']) ? strtotime($_POST['mindate']) : null;
	$maxdate = isset($_POST['maxdate']) ? strtotime($_POST['maxdate']) : null;
	!$mindate && $mindate = null;
	!$maxdate && $maxdate = null;
	if($mindate || $maxdate){
		$select -> range('i.timestamp', $mindate, $maxdate);
	}
	
	$username = isset($_POST['username']) ? html_entities($_POST['username']) : '';
	if($username){
		$select -> like('i.username', $username);
	}
	$selectstatus = isset($_POST['selectstatus']) ? intval($_POST['selectstatus']) : '';
	if($selectstatus){
		$select -> in('i.status', $selectstatus);
	}
	
	//自定义字段
	$F = isset($_POST['field#']) ? $_POST['field#'] : array();
	foreach($this_model['filterable_fields'] as $field=>$field_data){
		if(!empty($F[$field])){
			if($field_data['widget']=='radio' || $field_data['widget']=='select' || $field_data['widget']=='city'){
				$data[$field] = $F[$field];
				$select -> in("d.$field",$F[$field]);
			}elseif($field_data['widget']=='checkbox' || $field_data['widget']=='multi_select'){
				if(!empty($F[$field])){
					foreach($F[$field] as $v){
						if(array_key_exists($v,$field_data['data'])){
							$data[$field][] = $v;
							$select -> like("d.$field",$v);
						}
					}
				}
			}elseif($field_data['widget']=='linkage'){
				foreach($F[$field] as $k=>$vl){
						if($vl)
						$data[$field] = $vl;
				}
				if($data[$field]){
					$select -> like("d.$field",p8_addslashes($data[$field]),'left');
				}
			}
		}
	}


	$select -> order('i.id DESC');
	if($istemplate) $select->limit(0,5);

	//echo $select->build_sql();
	//exit;
	$count = 0;
	$list = $core->list_item($select);
	$status = $this_module->CONFIG['status'];
	$delimiter = $this_module->delimiter;
	$col_delimiter = $this_module->col_delimiter;
	
	foreach($list as $key=>$value){
		$fv = array();
		$fv['id'] = $value['id'];
		$fv['username'] = $value['username'];
		$fv['ip'] = $value['ip'];
		$fv['timestamp'] = date('Y-m-d H:i:s',$value['timestamp']);
		$fv['status'] = $status[$value['status']];
		$fv['verify'] = $P8LANG['verify'][$value['verified']];
		//$this_module->format_data($value);
		
		foreach($this_model['fields'] as $field => $field_data){
			
			if(!isset($value[$field])) continue;
			
			switch($field_data['widget']){
				
				//分割多选项
				case 'radio':case 'select':case 'city':
					foreach($field_data['data'] as $k => $v){
						if($value[$field] == $k) $fv[$field] =  is_array($v) ? $v[0]:$v;
					}
				break;
				case 'checkbox':case 'multi_select':
					$tmp = explode($delimiter, $value[$field]);
					$_v = array();
					foreach($tmp as $vv){
						foreach($field_data['data'] as $k => $v){
							if($vv == $k) $_v[] = is_array($v) ? $v[0]:$v;
						}
					}
					$fv[$field] = implode(',',$_v);
				break;
				//上传器,编辑器要对附件地址处理
				case 'editor': case 'editor_basic': case 'editor_common':case 'ueditor': case 'ueditor_common': case 'photo_uploader': case 'uploader_basic':
					$fv[$field]  = attachment_url($value[$field]);
				break;
				
				case 'uploader': case 'image_uploader':
					$value[$field] = str_replace($delimiter,'|', attachment_url($value[$field]));
					$fv[$field] = str_replace('||','', $value[$field]);
				break;
				
				//多上传器
				case 'multi_uploader':
				case 'multi_edu':
				case 'multi_family':
				case 'multi_employ':
				case 'multi_uploader_basic':
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
					$fv[$field] = $value[$field];
			}
			//if($istemplate) $fv[$field] = $value[$field];
			unset($value[$field]);
		}		
		$fv += $fv;		
		if($istemplate){
			unset($fv['id'],$fv['ip'],$fv['timestamp'],$fv['status']);
		}		
		foreach($fv as $k => $v){
			$fv[$k] = $v."\t";
		}		
		$list[$key] = $fv;
	}
	if(empty($list)) message('forms_model_not_null');
	$head = array(
		'id'=>'id',
		'username' => $P8LANG['username'],
		'ip' => 'IP',
		'timestamp' => $P8LANG['addtime'],
		'verify' => $P8LANG['verify'][''],
		'status' => $P8LANG['status']
	);
	if($istemplate) $head = array();
	foreach($this_model['fields'] as $field=>$field_data){
		$head[$field] = $field_data['alias'].($field_data['units']? "($field_data[units])" : '');
	}
	if($istemplate) $head['username'] = $P8LANG['username'];
	//print_r($list);exit;
	/*
	require PHP168_PATH.'/inc/excel.class.php';
	$export=new excel(1);
	$export->setFileName('forms-'.$this_model['alias'].'-'.$iid,'download',date('m-d-h-i-s', P8_TIME));
	$export->fileHeader(array_values($head));		
	$export->fileData($list);
	$export->fileFooter();
	$export->exportFile();
	*/
	require PHP168_PATH.'/inc/PHPExcel.php';
	$objExcel = new PHPExcel();
	$objExcel->getProperties()->setCreator($USERNAME)                  //设置作者
                            ->setLastModifiedBy($USERNAME)  //最后一次保存者
                            ->setTitle($this_model['alias'])                      //标题
                            ->setSubject($this_model['alias'])                  //主题
                            ->setDescription($this_model['alias'])               //备注
                            ->setKeywords("mark")                    //标记
                            ->setCategory("category");               //类别
	
	
	$AtoZ = range('A','Z');
	foreach($AtoZ as $r){$rows2[] = 'A'.$r;}
	$rows = array_merge($AtoZ,$rows2);
	foreach(array_values($head) as $index=>$h){		
		$objExcel->setActiveSheetIndex(0)->setCellValue($rows[$index].'1', $h);
	}	
	foreach($list as $index=>$m){
		$new_index = $index+2;
		foreach(array_keys($head) as $h_index=>$h){
			$objExcel->setActiveSheetIndex(0)->setCellValue($rows[$h_index].$new_index, $m[$h]);
		}
	}
	//设置sheet标题
	$objExcel->getActiveSheet()->setTitle('Sheet1');
	//设置为第一个sheet为活动状态
	$objExcel->setActiveSheetIndex(0);
	//保存
	$filename = $this_model['alias']."-".date('m-d-h-i-s', P8_TIME).".xlsx";
	//$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
	//$objWriter->save($filename);
	//如果生成并提供下载
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename);
	header('Cache-Control: max-age=0');
	header('Cache-Control: max-age=1');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: cache, must-revalidate');
	header('Pragma: public');		 
	$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
}
