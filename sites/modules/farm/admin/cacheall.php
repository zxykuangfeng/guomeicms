<?php
defined('PHP168_PATH') or die();

/**
* 缓存模型
**/

if(REQUEST_METHOD == 'GET'){
	$site = isset($_POST['site'])? $_POST['site'] : $this_system->SITE;
	//farm
	$this_module->cache($site);
	//更新模板缓存
	$sdata = $this_system->site;
	rm(CACHE_PATH .'template/sites/'.$sdata['template'].'/', true);
	//label
	$LABEL = &$core->load_module('label');
	$query = $core->DB_master->query("SELECT id FROM $LABEL->table WHERE site = '$site'");
	while($v = $core->DB_master->fetch_array($query)){
		$LABEL->cache($v['id']);
	}
	//manu
	$this_module->menu_cache($site);
	//model
	$model = &$this_system->load_module('model');
	$model->cache();
	//category
	$category = &$this_system->load_module('category');
	$category->cache(false);
	message('done',$this_module->admin_controller.'/../category-list?site='.$site);
}else if(REQUEST_METHOD == 'POST'){
	$cache = $_POST['cache'];
	$site = $_POST['site'];
    foreach($cache as $c){
        switch($c){
            case 'farm':
                $this_module->cache($site);
            break;
            case 'template':
                //更新模板缓存
                $sdata = $this_system->site;
                rm(CACHE_PATH .'template/sites/'.$sdata['template'].'/', true);
            break;
            case 'label':
                $LABEL = &$core->load_module('label');
                $query = $core->DB_master->query("SELECT id FROM $LABEL->table WHERE site = '$site'");
                while($v = $core->DB_master->fetch_array($query)){
                    $LABEL->cache($v['id']);
                }   
            break;
            case 'manu':
                $this_module->menu_cache($site);
            break;
            case 'model':
                $model = &$this_system->load_module('model');
                $model->cache();
            break;
            case 'category':
                $category = &$this_system->load_module('category');
                $category->cache(false);
            break;
			case 'menu_custom':
                $this_module->menu_custom_cache($site);
            break;
            case 'letter':
            
            break;
        }
    }
	//$this_module->cache();
	$this_system->log(array(
		'title' => $P8LANG['_module_cache_admin_log'],
		'request' => $_POST,
	));
	exit('[]');
}
