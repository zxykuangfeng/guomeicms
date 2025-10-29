<?php
defined('PHP168_PATH') or die();

/**
* 预览兼检验
**/

if(REQUEST_METHOD == 'POST'){
	
	define('NO_ADMIN_LOG', true);
	error_reporting(0);
	
	if($label['type'] == 'sql'){
		$sql = preg_replace('!--[^\r\n]*|#[^\r\n]*|/\*[\s\S]*\*/!', '', $label['content']);
		//危险的,你懂的
		if(!preg_match('/^select/i', $sql) || preg_match('/into\s+outfile/i', $sql)) exit('false');
	}	

	//如果验证的话,只检查内容模板是否有错即可	
	if(empty($label['option']['tplcode'])){		
		$ret = @eval(include template($TEMP_OBJ, $label['option']['template'], 'label')) !== false;		
		
	}else{
		require_once PHP168_PATH .'inc/template.func.php';
		$tplcode = template_compile($label['option']['tplcode']);
		$tplcode = str_replace(array('<?php', '?>'), array('', ''), $tplcode);
		$ret = @eval($tplcode) !== false;
		
	}	
	exit($ret);
	
}
