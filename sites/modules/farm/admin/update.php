<?php
defined('PHP168_PATH') or die();

/**
* 添加模型
**/
$mysites = $this_system->get_manage_sites();
$alias = html_entities(isset($_GET['alias'])?$_GET['alias']:$_POST['alias']);
in_array($alias,$mysites) || $this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$alias = clear_special_char($_GET['alias']);
	$alias = $alias ? $alias : html_entities($this_system->SITE);
	$data = $this_module->get_site($alias);
    $data['config'] = mb_unserialize($data['config']);
    $data['config'] = p8_stripslashes($data['config']);	
	$data['config']['logo'] = isset($data['config']['logo']) && $data['config']['logo'] ? attachment_url($data['config']['logo'],false,true):'';
	$data['config']['logo_1'] = isset($data['config']['logo_1']) && $data['config']['logo_1'] ? attachment_url($data['config']['logo_1'],false,true):'';
	$data['config']['logo_2'] = isset($data['config']['logo_2']) && $data['config']['logo_2'] ? attachment_url($data['config']['logo_2'],false,true):'';
	$data['config']['logo_3'] = isset($data['config']['logo_3']) && $data['config']['logo_3'] ? attachment_url($data['config']['logo_3'],false,true):'';	
	$data['config']['logo_motto'] = isset($data['config']['logo_motto']) && $data['config']['logo_motto'] ? attachment_url($data['config']['logo_motto'],false,true):'';
	$data['config']['logo_header'] = isset($data['config']['logo_header'])  && $data['config']['logo_header'] ? attachment_url($data['config']['logo_header'],false,true):'';
    $data['config']['logo_footer'] = isset($data['config']['logo_footer'])  && $data['config']['logo_footer'] ? attachment_url($data['config']['logo_footer'],false,true):'';
	$data['allow_ip']['enabled'] = isset($data['config']['allow_ip']['enabled']) ? $data['config']['allow_ip']['enabled'] : 0;
    $data['allow_ip']['collectip'] = isset($data['config']['allow_ip']['collectip']) ? $data['config']['allow_ip']['collectip'] : array();
    $data['allow_ip']['beginip'] = isset($data['config']['allow_ip']['beginip']) ? trim($data['config']['allow_ip']['beginip']) : '';
    $data['allow_ip']['endip'] = isset($data['config']['allow_ip']['endip']) ? trim($data['config']['allow_ip']['endip']) : '';
    $data['allow_ip']['ruleoutip'] = isset($data['config']['allow_ip']['ruleoutip']) ? $data['config']['allow_ip']['ruleoutip'] : array();
    $data['stop_ip']['enabled'] = isset($data['config']['stop_ip']['enabled']) ? ($data['config']['stop_ip']['enabled'] == 1 ? 1 : 0) : 0;
    $data['stop_ip']['forbidip'] = isset($data['config']['stop_ip']['forbidip']) ? $data['config']['stop_ip']['forbidip'] : array();
    $data['stop_ip']['beginip'] = isset($data['config']['stop_ip']['beginip']) ? trim($data['config']['stop_ip']['beginip']) : '';
    $data['stop_ip']['endip'] = isset($data['config']['stop_ip']['endip']) ? trim($data['config']['stop_ip']['endip']) : '';	
    $data['template_logs'] = explode('|',$data['config']['template_logs']);	
	$templates = $this_module->get_sites_templates();
	$allow_template = $this_system->check_manager('template');	
	
	//岗位架构处理
	$inputname = 'config[department]';
	$department =  intval($data['config']['department']);
	$department_cates = $this_module->get_department_category(true);	
	$select_size = 1;
	$data_field = array();
	$select_data = array();
	$cates_alias = array();
	//构建一级
	foreach($department_cates['department'] as $key => $row){
		$cates_alias[$row['id']] = $row;
		if($row['parent']) continue;
		$s = array();
		foreach($row['menus'] as $k=>$m){
			$cates_alias[$m['id']] = array('name'=>$row['name'].' . '.$m['name']);
			if($department == $m['id']) $data_field = array($m['parent'],$m['id']);
			$s[$m['id']] = array(
				'i' => $m['id'],
				'n' => $m['name'],
				's' => '',			
			);
		}
		if($department == $row['id']) $data_field = array($row['id']);
		$select_data[$row['id']] = array(
			'i' => $row['id'],
			'n' => $row['name'],
			's' => $s,
		);
		if(count($row['menus'])>=1) $select_size = 2;
	}
	$select_json_data = p8_json($select_data);
	$selectdata = array();	
	//岗位架构
	$item_config = $core->get_config($this_system->name, 'item');
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$countsites = $DB_master->fetch_one("select count(*) as `count` from ".$this_module->table." where `status`=1");
	//var_dump($countsites);
    if($_POST['status']==1){
        file_put_contents($this_system->path. 'html/'.$this_system->SITE.'/sitestatus.js','');
    }else{
        file_put_contents($this_system->path. 'html/'.$this_system->SITE.'/sitestatus.js','exit();document.body.innerHTML="";var ppp =new P8_Dialog({title_text:"提示信息",height:130});ppp.content.append(\'<h4 style="color:#1E62B0"><br>抱歉，站点暂时关闭。</h4>\');ppp.show();');
    }
	//允许启用的站点数量
	$allow_sites_num = 100;
	if($_POST['status']==1 && intval($countsites['count'])>=$allow_sites_num){
		message(p8lang($P8LANG['add_sites_fail'], $allow_sites_num));
	}
	$this_controller->update($_POST) or message('fail');
	$this_system->log(array(
		'title' => $P8LANG['_module_update_admin_log'],
		'request' => $_POST,
	));
	message('done',$this_router.'-update?alias='.$alias,1);
}
