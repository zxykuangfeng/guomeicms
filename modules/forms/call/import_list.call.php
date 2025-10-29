<?php
	defined('PHP168_PATH') or die();
	@set_time_limit(0);
	$mid = isset($_POST['mid'])? intval($_POST['mid']) : '';
	$this_module->set_model($mid) or message('no_such_forms_model');
	$this_controller->check_model_action('import_list',$mid) or message('no_model_privilege');
	require_once PHP168_PATH.'inc/PHPExcel/IOFactory.php';
    //加载excel文件    
	// 获取上传文件对应的字典
	$fileInfo = $_FILES["csv_file"];
	// 获取上传文件的名称
	$fileName = p8_filter_special_chars(clear_special_char($fileInfo["name"],true));
	$allowedTypes = array('xlsx', 'xls'); // 允许的文件类型
	$maxSize = 10 * 1024 * 1024; // 最大文件大小（10MB）

	// 检查文件类型
	$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
	if ($fileType != 'xlsx' && $fileType != 'xls') {
		message('error3');
	}
	// 检查文件大小
	if ($_FILES["import_file"]["size"] > $maxSize) {
		message('error2');
	}
	// 获取上传文件保存的临时路径
	$filePath = $fileInfo["tmp_name"];
	$filename = CACHE_PATH ."core/modules/forms/".$fileName;
	$uploaded = move_uploaded_file($filePath, $filename);
	if(!$uploaded) {
		message('error5');
	}
	if(!file_exists($filename)){
		message('forms_import_error');
	}
	$objPHPExcelReader = PHPExcel_IOFactory::load($filename);    
  
    $reader = $objPHPExcelReader->getWorksheetIterator();  	
    //循环读取sheet  
	$res_arr = array();
    foreach($reader as $sheet) {  
        //读取表内容  
        $content = $sheet->getRowIterator();  		
        //逐行处理  
        //$res_arr = array();  
        foreach($content as $key => $items) {  
              
             $rows = $items->getRowIndex();              //行  
             $columns = $items->getCellIterator();       //列  
             $row_arr = array();  
             //确定从哪一行开始读取  
             if($rows < 2){  
                 continue;  
             }  
             //逐列读取  
             foreach($columns as $head => $cell) {  
                 //获取cell中数据  
                 $data = $cell->getValue();  
                 $row_arr[] = $data;  
             }  
             $res_arr[] = $row_arr;  
        }  
          
    }   
	/*
	require_once PHP168_PATH.'inc/csv.class.php';
	$csv  = new P8_Csv();
	$csv->open($_FILES["csv_file"]["tmp_name"]);
	if(!$csv->data)return;
	*/
	$fields = isset($_POST['fields'])? $_POST['fields'] : array();
	
	$line = isset($_POST['line'])? intval($_POST['line'])-1 : 0;
	$recordfield = $RESOURCE."/data/import_forms_list_".$this_model['name'].".html";
	
	//$datas = convert_encode("GB2312","UTF-8",$res_arr);
	$datas = $res_arr;
	if(empty($datas)) message('error');
	$import_error = false;
	$import_record = array();
	//unique
	$unique_field = array();
	foreach($this_model['fields'] as $field_name => $fd){
		if($fd['CONFIG']['unique'] == 1){
			$unique_field[] = $field_name;
		} 
	}
	$member = $core->load_module('member');
	foreach($datas as $key => $val){
		if($key < $line)continue;
		$val = attachment_url($val,true);		
		$data = array(
			'main' => array(),
			'item' => array()
		);
		$data['main']['verified'] = 1;
		$data['main']['timestamp'] = P8_TIME;
		$data['main']['uid'] = $UID;
		$data['main']['username'] = $USERNAME;
		$_username_168 = isset($val[$fields['_username_168']]) && trim($val[$fields['_username_168']]) ? trim($val[$fields['_username_168']]) : '';
		if($_username_168){
			$member_table = $core->TABLE_.'member';
			$member_info = $core->DB_master->fetch_one("SELECT `id`,`username` from $member_table where username='$_username_168'");
			if($member_info){
				$data['main']['username'] = $_username_168;			
				$data['main']['uid'] = $member_info['id'];
			}
		}
		$data['main']['mid'] = $this_model['id'];
		$data['main']['ip'] = P8_IP;
		$data['main']['title'] = $this_model['alias'];	
		$data['main']['status'] = 9;
		$data['main']['list_order'] = P8_TIME;
		$data['main']['config'] = '';
		foreach($fields as $field=>$fid){
			if($fid=='')continue;
			if($field=='_username_168')continue;
			if(!array_key_exists($field,$this_model['fields']))continue;
			$fielddb = $this_model['fields'][$field];
			$table = 'item';
			$val[$fid] = trim($val[$fid]);
			switch($fielddb['widget']){
				//单选,单选下拉框
				case 'radio': case 'select':
					foreach($fielddb['data'] as $fkey => $fdata){
						if($val[$fid] == $fdata || $val[$fid] == $fdata[0]){
							$data[$table][$field] = $fkey;							
						}
					}
				break;
				//多选框,多选下拉框
				case 'checkbox': case 'multi_select':
					$_myselect = explode(',',$val[$fid]);
					$_mydata = array();
					foreach($fielddb['data'] as $fkey => $fdata){
						if(in_array($fdata,$_myselect))$_mydata[] = $fkey;
					}
					$data[$table][$field] = implode(',',$_mydata);
				break;
				//时间选择器
				case 'textdate':
					$data[$table][$field] = isset($val[$fid]) ? strtotime($val[$fid]) : '';
				break;
				//上传器
				case 'uploader': case 'image_uploader':
					$tmp = explode('|', $val[$fid]);
					$data[$table][$field] = array(
						'title' => $tmp[0],
						'url' => isset($tmp[1]) ? $tmp[1] : '',
						'thumb' => isset($tmp[2]) ? $tmp[2] : ''
					);
				break; 
				
				
				//批量上传
				case 'multi_uploader':
					$tmp = explode("\r\n", $val[$field]);
			
					$data[$field] = array();
					foreach($tmp as $v){
						$v = explode("|", $v);
						$data[$field][] = array(
							'title' => $v[0],
							'url' => isset($v[1]) ? $v[1] : '',
							'thumb' => isset($v[2]) ? $v[2] : ''
						);
					}
					unset($tmp);
				break; 
				
				//教育经历
				case 'multi_edu':
					$tmp = explode("\r\n", $val[$field]);
			
					$data[$field] = array();
					foreach($tmp as $v){
						$v = explode("|", $v);
						$data[$field][] = array(
							'date_attended_from' => isset($v[0]) ? $v[0] : '',
							'date_attended_to' => isset($v[1]) ? $v[1] : '',
							'schoolname' => isset($v[2]) ? $v[2] : '',
							'diploma_received' => isset($v[3]) ? $v[3] : '',
							'fieldofstudy' => isset($v[4]) ? $v[4] : '',
						);
					}
					unset($tmp);
				break; 
				
				//工作简历
				case 'multi_employ':
					$tmp = explode("\r\n", $val[$field]);
			
					$data[$field] = array();
					foreach($tmp as $v){
						$v = explode("|", $v);
						$data[$field][] = array(
							'date_attended_from' => isset($v[0]) ? $v[0] : '',
							'date_attended_to' => isset($v[1]) ? $v[1] : '',
							'employer' => isset($v[2]) ? $v[2] : '',
							'position' => isset($v[3]) ? $v[3] : '',							
						);
					}
					unset($tmp);
				break; 
				
				//家庭成员
				case 'multi_family':
					$tmp = explode("\r\n", $val[$field]);
			
					$data[$field] = array();
					foreach($tmp as $v){
						$v = explode("|", $v);
						$data[$field][] = array(
							'members' => isset($v[0]) ? $v[0] : '',
							'name' => isset($v[1]) ? $v[1] : '',
							'phone' => isset($v[2]) ? $v[2] : '',
							'email' => isset($v[3]) ? $v[3] : '',
							'employer' => isset($v[4]) ? $v[4] : '',
							'position' => isset($v[5]) ? $v[5] : '',							
						);
					}
					unset($tmp);
				break; 
				
				default:
					$data[$table][$field] = filter_word($val[$fid]);
			}
			
		}
		if(empty($unique_field)){
			//不是唯一性的
			$status = $this_module->add($data,true,false);
		}else{
			$unique_data = array();
			foreach($unique_field as $name){
				$unique_data[$name] = array(
					'field' => $name,
					'data' => $data['item'][$name]
				);
			}			
			$old_data = $this_module->get_data_by_field($unique_data);			
			if(empty($old_data)){
				$status = $this_module->add($data,true,true);
			}else{				
				$status = $this_module->update($old_data['id'],$data,true);
			}
		}
		if(!$status){
			$import_error = true;
			record('the '.$key.' is import error. the import data is "'.implode(",",$val).'"',$recordfield);
		}else{
			$import_record[] = $status;
			if(count($import_record)>=3){
				$import_record = array($import_record[0],end($import_record));
			}
			if(count($import_record)==1) $import_record[] = $status;
		}
	}
	//读记录
	$model_data = $this_module->get_model($mid,true);
	$model_config = mb_unserialize($model_data['config']);
	$import_logs = isset($model_config['import_logs']) ? $model_config['import_logs'] : array();
	if(count($import_logs)>=10) array_shift($import_logs);
	$file_name = $_FILES['csv_file']['name'];
	$import_logs[] = array(
		'logs'=>"<strong>".$USERNAME."</strong> 于 ".date('m-d H:i:s',P8_TIME)." 导入《".$file_name."》，ID范围：<strong>".$import_record[0]." 至 ".$import_record[1].'</strong>',
		'import_record'=>$import_record
	);
	$model_config['import_logs'] = $import_logs;
	$update_data['config'] = $core->DB_master->escape_string(serialize($model_config));	
	$ret = $core->DB_master->update(
		$this_module->model_table,
		$update_data,
		"id = '$mid'"
	);
	//删除导入源文件
	rm(PHP168_PATH.$fileName,true);
	if($import_error){
		message(
			array(
				array('view', $recordfield)
			),
			$this_router.'-list?mid='.$mid,
			10000
		);
	}	
	
function record($content,$recordfield){
	$data = '['.date('Y-m-d h:i:s').']'."\t".$content.'<br>';
	write_file($recordfield,$data,'a');
}
