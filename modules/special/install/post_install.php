<?php
defined('PHP168_PATH') or die();


//添加一些初始化内容
if(is_file($this_module->path .'install/init_data.php')){
	 $sql = get_install_sql(
		$DB_master,
		file_get_contents($this_module->path .'install/init_data.php'),
		$this_module->TABLE_
	);
	foreach($sql as $v){
		$DB_master->query($v);
	} 
}
//更新分类缓存
$this_module->category->cache();
