<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');

$type = isset($_GET['type']) ? $_GET['type'] : '';
$type = !$type ? 'image' : $type;
include template($this_module, 'material', 'admin');
	