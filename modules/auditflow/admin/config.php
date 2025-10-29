<?php
/**
 *
 * Power by php168.net
 * User: bingbin
 * Date: 2023/1/17
 * Time: 16:14
 */

defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$sites = $core->load_system('sites');
$allsites  = $sites->get_sites();

$form = $core->load_module('forms');
$formmods = $form->get_models();

if(REQUEST_METHOD == 'GET'){
    $config = $core->get_config($this_system->name, '');
	foreach($formmods as $name=>$value){
		if($value['id'] == 199) unset($formmods[$name]);
	}
	// print_r($formmods);

    include template($this_module, 'config', 'admin');

}else if(REQUEST_METHOD == 'POST'){
    $_POST = p8_stripslashes2($_POST);

    $config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();

    if(!isset($config['audit_flow_enable'])){
        $config['audit_flow_enable'] = 0;
    }
    foreach($allsites as $alias=>$sdata){
       if(!isset($config['audit_flow_enable_'.$alias])){
           $config['audit_flow_enable_'.$alias] = 0;
       }
    }
    foreach($formmods as $ft=>$fd) {
        if (!isset($config['audit_flow_enable_forms_'.$ft])) {
            $config['audit_flow_enable_forms_'.$ft] = 0;
        }
    }

    $core->set_config($config);
    message('done',$this_url);
}
