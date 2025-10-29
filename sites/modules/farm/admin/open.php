<?php
defined('PHP168_PATH') or die();
/**
* 批量开启网站, 只提供AJAX
**/
if(REQUEST_METHOD == 'POST'){
		//过滤非数字
	$alias = isset($_POST['alias']) ? $_POST['alias'] : array();
	$status = isset($_POST['is_open']) && intval($_POST['is_open']) != 0 ? 1 : 0;
	$alias or exit('[]');
	
	
    if($alias){
        foreach($alias as $alias_name){
            $DB_master->update(
                $this_module->table,
                array(
                    'status' => $status
                ),
                "alias = '$alias_name'"
            );
        }
    }else{
        $this_module->cache();
    }
	$this_system->log(array(
		'title' => $P8LANG['_module_open_admin_log'],
		'request' => $_POST,
	));
	exit(jsonencode($alias));
}
exit('[]');