<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$env_items = array(
		'os' => array('need' => 'notset', 'best' => '类unix','name' => 'PHP_OS'),
		'server_software' => array('need' => 'notset', 'best' => 'nginx'),
		'php' => array('need' => '5.2.4', 'best' => '7.3','name' => 'PHP_VERSION'),
		'mysql' => array('need' => '5.0', 'best' => '5.7'),
		'dm' => array('need' => '8.0', 'best' => '8.0'),
		'kdb' => array('need' => '12.0', 'best' => '12.0'),
		'attachmentupload' => array('need' => 'notset', 'best' => '200M'),
		'gdversion' => array('need' => '1.0', 'best' => '2.0'),
		'curl' => array('need' => 'notset', 'best' => 'enable'),
		'ssi' => array('need' => 'notset', 'best' => 'enable'),
		'ssl' => array('need' => 'notset', 'best' => 'enable'),
		'memcache' => array('need' => 'notset', 'best' => 'enable'),
		'eAccelerator' => array('need' => 'notset', 'best' => 'enable'),
		'opcache' => array('need' => 'notset', 'best' => 'enable'),
		'php168_path' => array('need' => 'notset', 'best' => 'notset'),
		'php168_ip' => array('need' => 'notset', 'best' => 'notset'),
		'base_root' => array('need' => 'notset', 'best' => 'notset'),
		'php_ini_root' => array('need' => 'notset', 'best' => 'notset'),
		'mysql_data' => array('need' => '100MB', 'best' => 'notset'),
		'diskspace' => array('need' => '1000MB', 'best' => 'notset'),
	);

	foreach($env_items as $key => $item) {
		switch ($key) {  
			case 'php':  
				$env_items[$key]['current'] = PHP_VERSION;  
				break;  
			case 'php_ini_root':  
				$env_items[$key]['current'] = php_ini_loaded_file();  
				break;  
			case 'attachmentupload':  
				$env_items[$key]['current'] = @ini_get('file_uploads') ? (min(min(ini_get('upload_max_filesize'), ini_get('post_max_size')), ini_get('memory_limit'))) : 'unknow';  
				break;  
			case 'gdversion':  
				$tmp = function_exists('gd_info') ? gd_info() : array();  
				$env_items[$key]['current'] = empty($tmp['GD Version']) ? 'noext' : $tmp['GD Version'];  
				unset($tmp);  
				break;  
			case 'diskspace':  
				if (function_exists('disk_free_space')) {  
					$disk_config = [  
						'3' => 'GB',  
						'2' => 'MB',  
						'1' => 'KB'  
					];  
					$disk_total = disk_total_space('.');  
					$disk_free = disk_free_space('.');  
					$free_percentage = round($disk_free/$disk_total,3)*100;  
					foreach ($disk_config as $disk_key => $disk_value) {  
						if ($disk_total > pow(1024, $disk_key)) {  
							$disk_total = round($disk_total / pow(1024,$disk_key)).$disk_value;  
						}  
						if ($disk_free > pow(1024, $disk_key)) {  
							$disk_free = round($disk_free / pow(1024,$disk_key)).$disk_value;  
						}  
					}  
					$env_items[$key]['current'] = $disk_total.'/'.$disk_free.'，可用率'.$free_percentage.'%';  
				} else {  
					$env_items[$key]['current'] = 'unknow';  
				}  
				break;  
			case 'server_software':  
				$env_items[$key]['current'] = $_SERVER[SERVER_SOFTWARE];  
				break;  
			case 'mysql_data':  
				$dbm = $core->load_module('dbm');  
				$list = $dbm->table_status();  
				$info = include $dbm->path .'#.php';    
				$size = 0;  
				foreach($list as $k => $v){  
					$a = str_replace($core->CONFIG['table_prefix'], '', $v['Name']);  
					$list[$k]['alias'] = isset($info['table_alias'][$a]) ? $info['table_alias'][$a] : '';    
					$size += $v['Data_length'];  
				}  
				switch (true) {  
					case ($size >= 1024 * 1024 * 1024):  
						$env_items[$key]['current'] = round($size / (1024 * 1024 * 1024)) . ' GB';  
						break;  
					case ($size >= 1024 * 1024):  
						$env_items[$key]['current'] = round($size / (1024 * 1024)) . ' MB';  
						break;  
					case ($size >= 1024):  
						$env_items[$key]['current'] = round($size / 1024) . ' KB';  
						break;  
					default:  
						$env_items[$key]['current'] = $size . ' B';  
						break;  
				}  
				break;  
			case $core->CONFIG['mysql_connect_type']:
				$env_items[$core->CONFIG['mysql_connect_type']]['current'] = $DB_master->version();
				break;  
			case 'memcache':  
				$env_items[$key]['current'] = class_exists('Memcache') ? $P8LANG['env']['enable'] : $P8LANG['env']['disable'];  
				break;  
			case 'eAccelerator':  
				$env_items[$key]['current'] = extension_loaded('eaccelerator') ? $P8LANG['env']['enable'] : $P8LANG['env']['disable'];  
				break;  
			case 'ssi':  
				$env_items[$key]['current'] = $core->CONFIG['ssi'] ? $P8LANG['env']['enable'] : $P8LANG['env']['disable'];  
				break;  
			case 'ssl':  
				$env_items[$key]['current'] = extension_loaded('openssl') ? $P8LANG['env']['enable'] : $P8LANG['env']['disable'];  
				break;
			case 'opcache':  
				$opcache_data = function_exists('opcache_get_configuration') ? opcache_get_configuration() : array();  
				$env_items[$key]['current'] = !empty($opcache_data['directives']['opcache.enable']) ? $P8LANG['env']['enable'] : $P8LANG['env']['disable'];  
				break;  
			case 'base_root':  
				$env_items[$key]['current'] = P8_ROOT;  
				break;  
			case 'php168_path':  
				$env_items[$key]['current'] = PHP168_PATH;  
				break;  
			case 'php168_ip':  
				$env_items[$key]['current'] = P8_IP;  
				break;  
			case 'curl':  
				if(function_exists('curl_init') && function_exists('curl_version')){  
					$v = curl_version();  
					$env_items[$key]['current'] = $P8LANG['env']['enable'].' '.$v['version'];  
				}else{  
					$env_items[$key]['current'] = $P8LANG['env']['disable'];  
				}  
				break;  
			default:  
				if(isset($item['name'])) {
					$env_items[$key]['current'] = constant($item['name']);
				}
		}		
		$env_items[$key]['key_note'] = $P8LANG['env'][$key.'_note'] ? $P8LANG['env'][$key.'_note'] : '';
		$env_items[$key]['status'] = 1;
		if($item['need'] != 'notset' && strcmp($env_items[$key]['current'], $item['need']) < 0) {
			$env_items[$key]['status'] = 0;
		}
	}	
	include template($this_system, 'syscheck/'.$ACTION, 'admin');

}else if(REQUEST_METHOD == 'POST'){
	
	
}
