<?php
defined('PHP168_PATH') or die();

/**
* 保持约束, 保证同一作用域内没有相同名称的标签
**/

$IS_ADMIN or exit('false');

define('NO_ADMIN_LOG', true);

$system = isset($_POST['system']) ? html_entities($_POST['system']) : '';
$module = isset($_POST['module']) ? html_entities($_POST['module']) : '';
$site = isset($_POST['site']) ? html_entities($_POST['site']) : '';
$env = isset($_POST['env']) ? html_entities($_POST['env']) : '';
$postfix = isset($_POST['postfix']) ? html_entities($_POST['postfix']) : '';
$name = isset($_POST['name']) ? html_entities(from_utf8($_POST['name'])) : '';
$id = isset($_POST['id']) ? html_entities(from_utf8($_POST['id'])) : '';

strlen($name) or exit('false');
$sql = "SELECT * FROM $this_module->table WHERE system = '$system' AND module = '$module' AND site = '$site' AND env = '$env' AND postfix = '$postfix' AND name = '$name'";
if($id)$sql .=" AND ID!=$id";
$tmp = $DB_master->fetch_one($sql);

exit(empty($tmp) ? 'true' : 'false');
