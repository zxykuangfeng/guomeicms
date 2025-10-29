<?php
defined('PHP168_PATH') or die();

/**
* 会员导入
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$roles = $core->load_module('role');	
	$roles->get_cache();
	$roles->get_group_cache();
	$list = $roles->get_by_system('core');
	
	include template($this_module, 'import', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	require_once PHP168_PATH.'inc/PHPExcel/IOFactory.php';
	//加载excel文件    
	// 获取上传文件对应的字典（对象
	$fileInfo = $_FILES["import_file"];
	// 获取上传文件的名称
	$fileName = p8_filter_special_chars(clear_special_char($fileInfo["name"],true));
	if(empty($fileName) || strtolower(file_ext($fileName)) != 'xlsx') message('error3');	
	isset($_FILES['import_file']) or message('error1');
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
	$filename = CACHE_PATH ."/core/modules/member/".$fileName;
	$uploaded = move_uploaded_file($filePath, $filename);	
	if(!$uploaded) {
		message('error5');
	}
	$objPHPExcelReader = PHPExcel_IOFactory::load($filename);    
  
	$reader = $objPHPExcelReader->getWorksheetIterator();  	
	//循环读取sheet  
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
	if(empty($res_arr)) message('error4');
	$members = array();
	foreach($res_arr as $index=>$res_array){
		if($index<=0) continue;
		foreach($res_array as $m_index => $member_tmp){
			$members[$index][$res_arr[0][$m_index]] = $member_tmp;
		}
	}
	if(empty($members)) message('error4');
	$import_err = false;
	foreach($members as $member){
		//$m = convert_encode('GBK','UTF-8',$m);
		//$member = array_combine($fields,$m);
		if($member['username']){
			$s = $this_controller->check_username($member['username']);
			if($s == -1){
				$import_err = true;
				record('the username <font color="red">'.$member['username'].'</font> is illegal. the import data is"'.implode(",",$member).'"');
				continue;
			}
			if($s == -2){
				$import_err = true;
				record('the username <font color="red">'.$member['username'].'</font> is repeat. the import data is"'.implode(",",$member).'"');
				continue;
			}
		}else{
			continue;
		}
		if($member['email']){
			$ss = $this_controller->check_email($member['email']);
			if($ss == -1){
				$import_err = true;
				record('the email <font color="red">'.$member['email'].'</font> is illegal. the import data is"'.implode(",",$member).'"');
				//continue;
			}
			if($ss == -2){
				$import_err = true;
				record('the email <font color="red">'.$member['email'].'</font> is repeat. the import data is"'.implode(",",$member).'"');
				continue;
			}
		}else{
			$member['email'] = md5_16($member['username']).'@qq.com';
		}
		$data = $this_controller->valid_data($member);
		$id = $this_controller->register($member);
		if($id){
			unset($data['attachment_hash'],$data['#data#'],$data['password'],$data['email']);
			$status = $this_module->DB_master->update(
				$this_module->table,
				$data,
				"id = '$id'"
			);			
			if($status === false){
				$import_err = true;
				record('the email <font color="red">'.$member['username'].'</font> is inpurt error. the import data is"'.implode(",",$member).'"');
				$DB_master->query("DELETE FROM $this_module->table WHERE username='".$member['username']."'");
			}
		}else{
			$import_err = true;
			record('the email <font color="red">'.$member['username'].'</font> is inpurt error. the import data is"'.implode(",",$member).'"');
			$DB_master->query("DELETE FROM $this_module->table WHERE username='".$member['username']."'");
		}
	}
	rm(PHP168_PATH.$fileName,true);
	if($import_err){
		message(
			array(
				array('view', $this_router.'-list'),
				array('continue_add', $this_url),
				array('record_err', $core->url."/data/import_member.html",'_blank')
			),
			$this_url,
			10000
		);
	}else{
		message(
			array(
				array('view', $this_router.'-list'),
				array('continue_add', $this_url),		
			),
			$this_url,
			10000
		);
	}	
}
function record($content){

	$recordfield = CACHE_PATH."import_member.html";
	
	$data = '['.date('Y-m-d h:i:s').']'."\t".$content.'<br>';
	write_file($recordfield,$data,'a');
}




