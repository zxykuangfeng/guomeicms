<?php
defined('PHP168_PATH') or die();

/**
* 移动内容,只提供AJAX POST调用
**/

$this_controller->check_admin_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');

	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$cid or exit('[]');

	$__id__ = $id;
	
	if(isset($_POST['verified'])){
		$verified = $_POST['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
    $org_cid = $org_un_cid = array();
    $ids = implode(',', (array)$id);

    if($verified) {
        $query = $core->DB_master->query("SELECT cid FROM $this_module->main_table WHERE id IN ($ids)");
        while($arr = $core->DB_master->fetch_array($query)){
            $org_cid[] = $arr['cid'];
        }
        //尝试找未终审的数据
        if(empty($org_cid)) {
            $query = $core->DB_master->query("SELECT cid FROM $this_module->unverified_table WHERE id IN ($ids)");
            while($arr = $core->DB_master->fetch_array($query)){
                $org_un_cid[] = $arr['cid'];
            }
            $verified = !empty($org_un_cid) ? false : true;
        }
    }

    if(!empty($org_cid) || !empty($org_un_cid)) {
        $this_module->move($id, $cid, $verified) or exit('[]');
        $this_module->html_list($cid);
		//html the mobile list
		if(!empty($this_module->core->CONFIG['enable_mobile'])){
			$_GLOBALS['core']->ismobile=true;
			$this_module->core->ismobile=true;
			$this_module->html($core->DB_master->query("SELECT * FROM $this_module->main_table WHERE id IN ($ids)"));
			$this_module->html_list($cid,true);
			$_GLOBALS['core']->ismobile=false;
			$this_module->core->ismobile=false;
		}
        if (!empty($org_cid)) {
            foreach(array_unique($org_cid) as $vvv) {
				$_GLOBALS['core']->ismobile=false;
				$this_module->core->ismobile=false;
                $this_module->html_list(intval($vvv));
				//html the mobile list
				if(!empty($this_module->core->CONFIG['enable_mobile'])){
					$_GLOBALS['core']->ismobile=true;
					$this_module->core->ismobile=true;
					$this_module->html_list(intval($vvv),true);
					$_GLOBALS['core']->ismobile=false;
					$this_module->core->ismobile=false;
				}			
            }
        }
    }
   exit(p8_json($__id__));
}