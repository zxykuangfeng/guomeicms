<?php
//后台管理语言包

return array(
	
	'_module_manage_admin_log' => '管理数据库',
	'_module_backup_admin_log' => '备份数据库',
	'_module_restore_admin_log' => '还原数据库',
	'dbm_confirm_to_backup' => '确定备份所有数据表吗？',
	'dbm_backup_init' => '正在初始化。共 {$1} 个表',
	'dbm_restore_init' => '正在初始化',
	'dbm_backup_done' => '备份完成，耗时 {$1} 秒',
	'dbm_restore_done' => '还原完成，耗时 {$1} 秒',
	'dbm_backup_process' => '{$1} 个表剩余，当前表{$2}。<br />正在备份第 {$3} 行，共 {$4} 行',
	'dbm_restore_process' => '共 {$1} 个文件，正在还原第 {$2} 个文件',
	'dbm_backup_locked' => '<form action="{$1}/core/dbm-manage" method="POST">备份已经在进行，锁定中。可强制手动解锁后备份。<input type="submit" value="解除锁定" class="cache_btn"><input type="hidden" name="act" value="unlock"/></form>',
	
);
