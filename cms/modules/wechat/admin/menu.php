<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');
GetGP(array('action','pid','id'));
$messageRow = array();
switch($action){
	case 'editmenu':		
		if($_POST){
			$_POST = p8_stripslashes2($_POST);
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
			$name = $_POST['name'];
			$value = $_POST['value'];
			$type = $_POST['type'];
			$list_order = $_POST['list_order'];
			if($id){
				//更新
				$result = $core->DB_master->query("UPDATE `$this_module->menus` SET `name` = '{$name}',`pid`= '{$pid}',`value`= '{$value}',`type`='{$type}',`list_order`='{$list_order}' where id = {$id}");
				message('修改成功！',$this_url);
			}else{
				//新增
				if($pid){
					$menu = $core->DB_master->fetch_all("select * from `$this_module->menus` where pid = '{$pid}'");
					if(count($menu)>=5) message('add_menu_false',$this_url);
				}else{
					$menu = $core->DB_master->fetch_all("select * from `$this_module->menus` where pid = 0");
					if(count($menu)>=3) message('add_menu_false',$this_url);
				}
				$result = $core->DB_master->query("INSERT INTO `$this_module->menus` (`name`,`pid`,`value`,`type`,`list_order`,`created_at`) VALUES('{$name}', '{$pid}', '{$value}', '{$type}','{$list_order}','".date('Y-m-d H:i:s')."')");
				message('增加成功！',$this_url);
			}
		}
		$menu = array();
		if($_GET['id']){
			$id = intval($_GET['id']);
			$action_name = '编辑菜单';
			$menu = $core->DB_master->fetch_one("select * from `$this_module->menus` where id = '{$id}'");
		}else{
			$menu['type'] = 'view';
			$action_name = '添加菜单';
		}
		//获取顶级栏目
		$query = $core->DB_master->query("SELECT * FROM `$this_module->menus` where pid = 0 order by list_order asc,id asc");
		$topMenus = array();
		while($row = $core->DB_master->fetch_array($query))
		{
			$topMenus[$row['id']] = $row['name'];
		}
		include template($this_module, 'menu_edit', 'admin');
	break;
	case 'deletemenu' :
		if($id){
			$id = intval($id);
			$menu = $core->DB_master->fetch_all("select * from `$this_module->menus` where pid = '{$id}'");
			if(!empty($menu)) {
				echo jsonencode(0);exit;
			}
			$core->DB_master->query("delete from `$this_module->menus` where id = '{$id}'");
			echo jsonencode($id);
			exit;
		}
	break;
	case 'createwxmenu':
		$topMenus = $this_module->getTopMenus();
		$i=0;
		$data = array();
		foreach ($topMenus as $topMenu){
			$data[$i]['name'] = $topMenu['name'];
			$data[$i]['type'] = $topMenu['type'];
			$data[$i]['value'] = $topMenu['value'];
			$childs = $this_module->geChildMenusByPid($topMenu['id']);
			if(is_array($childs)){
				$j=0;
				foreach ($childs as $child){
					$data[$i]['sub_button'][$j] = array($child['name'],$child['type'],$child['value']);
					$j++;
				}
			}
			$i++;
		}
		if(empty($data)) message('请先创建菜单',$this_url,2);
		require_once PHP168_PATH .'inc/WxService.class.php';
		$config = $core->get_config($this_system->name, $this_module->name);
		$wx = new WxService($config['appid'],$config['appsecret']);
		$result = $wx->createMenu($data);
		if($result['errcode']==0){
			message('创建公众号菜单成功！',$this_url);
		}else{
			$wx->getToken(true);
			message('创建公众号菜单失败'.$result['errmsg'],$this_url);
		}
	break;
	case 'deletewxmenu':
		require_once PHP168_PATH .'inc/WxService.class.php';
		$config = $core->get_config($this_system->name, $this_module->name);
		$wx = new WxService($config['appid'],$config['appsecret']);
		$result = $wx->deleteMenu();
		if($result['errcode']==0){
			message('删除公众号菜单成功！',$this_url);
		}else{
			$wx->getToken(true);
			message('删除公众号菜单失败'.$result['errmsg'],$this_url);
		}
	break;
	
	default :
		$query = $core->DB_master->query("SELECT * FROM `$this_module->menus` order by pid asc,list_order asc,id asc");
		$Menus = array();
		$i=0;
		while($row = $core->DB_master->fetch_array($query))
		{
			$row['type'] = $row['type'] == 'view' ? '跳转网页' : '发送消息';
			if($row['pid'] == 0){
				$Menus[$row['id']] = $row;
			}else{
				$Menus[$row['pid']]['childs'][] = $row;				
			}
		}
		include template($this_module, 'menu', 'admin');
}