<?php
defined('PHP168_PATH') or die();

/**
* 缓存模型
**/

set_time_limit(0);
if(REQUEST_METHOD == 'GET'){
	$mysites = array();	
	$mysites = $this_system->get_manage_sites();
	$mysites || $this_controller->check_admin_action($ACTION) or message('no_privilege');
	$allsites  = $this_system->get_sites();
	foreach($mysites as $site){
		if($allsites[$site]['status']){
			$html_sites[] = $site;
		}		
	}
	!empty($html_sites) or message('no_privilege');
	
	$form = <<<EOT
<form id="form" method="post" action="$this_url">
</form>
<script type="text/javascript">
if(confirm('$P8LANG[confirm_to_do]')){
	document.getElementById('form').submit();
}
</script>
EOT;
	message($form);
	
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
