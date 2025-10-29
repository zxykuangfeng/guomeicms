<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    $action = isset($_GET['action'])? $_GET['action'] : 'add';
    $module = isset($_GET['module'])? $_GET['module'] : 'cms';

    $sitess = [];
    if(isset($core->systems['sites'])) {
        $sites = $core->load_system('sites');
        $sitess = $sites->sites;
    }
    $rsdb=['num'=>2,'module'=>$module];
    include template($this_module, 'edit', 'admin');

}else if(REQUEST_METHOD == 'POST'){

    if($status = $this_controller->add($_POST)) {
        message('done', $this_router . '-list?module=' . $_POST['module']);
    }else{
        message('fail', $this_router . '-list?module=' . $_POST['module']);
    }
}
