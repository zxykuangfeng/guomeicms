<?php
defined('PHP168_PATH') or die();

/**
* 添加模型
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$allsites  = $this_system->get_sites();
	$templates = $this_module->get_sites_templates();
    $data['parent']=0;
    $data['status']=1;
    $data['template']='default';
	$allow_template = true;
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$countsites = $DB_master->fetch_one("select count(*) as `count` from ".$this_module->table." where `status`=1");
	//允许启用的站点数量
	$allow_sites_num = 100;
	if(intval($countsites['count'])>=$allow_sites_num){
		message(p8lang($P8LANG['add_sites_fail'], $allow_sites_num));
	}
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$this_controller->add($_POST) or message('fail');
    $this_system->log(array(
		'title' => $P8LANG['_module_add_admin_log'],
		'request' => $_POST,
	));
	if(!empty($_POST['init'])){
     $form = <<<FORM
{$P8LANG['init_site']}
<form action="$this_router-init_site" method="post" id="form">
<input type="hidden" name="init" value="{$_POST['init']}" />
<input type="hidden" name="site" value="{$_POST['alias']}" />
<input type="hidden" name="item" value="category" />
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1);
</script>
FORM;
	message($form);
    
    }
	message('done',$this_router.'-list');
}

