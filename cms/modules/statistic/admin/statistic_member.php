<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$core->get_cache('role_group');
	$core->get_cache('role');
	$groups = $core->role_groups;
	$roles = $core->roles;
	
	foreach($roles as $key=>$row){
		$groups[$row['gid']]['roles'][$key] = $row;
	}
	$path = array();
	
	$models = $this_system->get_models();
	
	foreach($core->roles as $v){
		$path[$v['id']][] = $v['gid'];
		$path[$v['id']][] = $v['id'];
	}
	$years= range(date("Y"),date("Y")-10);
	$months= range(01,12);
	$json = array(
		'json' => p8_json($groups),
		'path' => p8_json($path)
	);
	include template($this_module, 'statistic_member', 'admin');
}elseif(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$models = $this_system->get_models();
	$act = isset($_POST['act'])? $_POST['act'] : '';
	$year = intval($_POST['year']);
	$years= range(date("Y"),date("Y")-10);
	$year = !in_array($year,$years) ? date("Y") : $year;	
	$month = !in_array($_POST['month'],range(01,12)) ? '' : intval($_POST['month']);
	$model = xss_clear($_POST['model']);
	if($model && !array_key_exists($model,$models)){
		exit;
	}
	$gid = isset($_POST['gid']) && $_POST['gid'] ? intval($_POST['gid']) : 0;
	$gid = preg_replace('/[^0-9,]/', '', $gid);
	$gid = intval($gid);
	
	$rid = isset($_POST['rid']) && $_POST['rid'] ? intval($_POST['rid']) : 0;
	$rid = preg_replace('/[^0-9,]/', '', $rid);
	$rid = intval($rid);
	
	$cid = isset($_POST['cid']) && $_POST['cid'] ? intval($_POST['cid']) : 0;
	$cid = preg_replace('/[^0-9,]/', '', $cid);
	$cid = intval($cid);
	$cid = filter_int(explode(',', $cid));
	$pattern = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';	
	$start_date = isset($_POST['start_date']) && preg_match($pattern, $_POST['start_date']) ? $_POST['start_date'] : '';
	$end_date = isset($_POST['end_date']) && preg_match($pattern, $_POST['end_date']) ? $_POST['end_date'] : '';
	
	if($act=='query'){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$page = max($page, 1);
		//if($start_date || $end_date)
		//	$data = $this_module->getStaticMemberRanger($gid, $rid, $cid, $model,$page,$start_date,$end_date);
		//else
			$data = $this_module->getStaticMember($gid, $rid, $year, $month, $cid, $model,$page);
		echo p8_json($data);
		exit;
	}elseif($act=='stat'){
		if(!$year) exit('false');
		$step = $_POST['step'];
		$step = preg_replace('/[^0-9,]/', '', $step);
		$step = intval($step);
		$static = $this_module->statisticMember($gid, $rid, $year, $month, $cid, $model,$step);
		if($static['step']){
			echo "<script type='text/javascript'>";
				echo "parent.$('#step').val('".$static['step']. "');";
				echo "parent.statistic('".$static['step']."');";
				echo "</script>";
				exit;
		}else{
			echo "<script type='text/javascript'>";
			echo "parent.$('#step').val('0');";
			echo "alert('".$P8LANG['done']."');";
			echo "parent.ajaxing({action: 'hide'});";
			echo "parent.get_data();";
			echo "</script>";
			exit;
		}
	}elseif($act=='download'){
		//$uids = $_POST['uids'];
		$this_module->downloadMember($gid, $rid, $year, $month, $cid, $model,0);
	}
	

}
