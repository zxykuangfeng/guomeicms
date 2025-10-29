<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$id = isset($_GET['id'])? $_GET['id'] : '';
	!empty($id) or message('no_such_item');
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('id', $id);

	//echo $select->build_sql();
	$rsdb = $core->select($select, array('single' => true, 'ms' => 'master'));
    $member = &$core->load_module('member');
	$getManager = function($uids)use($member,$core){
        return $core->DB_master->fetch_all("SELECT id,username,name FROM {$member->table} WHERE id IN ($uids)");
    };
    $sitess = [];
    $sitesjs = [];
    if(isset($core->systems['sites'])) {
        $sites = $core->load_system('sites');
        $sitess = $sites->sites;
        foreach ($sitess as $kk=>$vv){
            $sitesjs[]=['k'=>$kk,'v'=>$vv['sitename']];
        }
    }
    $sitesjs = json_encode($sitesjs,256);


    $formjss=[];
    if(isset($core->modules['forms'])) {
        $form = $core->load_module('forms');
        $formmods = $form->get_models();
        foreach ($formmods as $kk=>$vv){
            $formjss[]=['k'=>$kk,'v'=>$vv['alias']];
        }
    }
    $formjs = json_encode($formjss,256);




	$step_one = $getManager($rsdb['step_one']);
	$step_two = $getManager($rsdb['step_two']);
	$step_three = $getManager($rsdb['step_three']);
	$step_four = $getManager($rsdb['step_four']);
	$step_final = $getManager($rsdb['step_final']);
	$step_auto = $getManager($rsdb['step_auto']);

	include template($this_module, 'edit', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$this_controller->update($_POST['id'],$_POST);
	message('done',$this_router.'-list?module='.$_POST['module']);
}
