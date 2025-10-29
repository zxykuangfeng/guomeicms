<?php
defined('PHP168_PATH') or die();

$ids = isset($_GET['id']) ? explode(',',$_GET['id']) : array();
$ids = array_map('intval',$ids);
foreach($ids as $key => $value) {
    if (!is_numeric($value) || $value <= 0) {
        unset($ids[$key]);
    }
}
if($ids === array() || !count($ids)) exit('{}');
$ids = implode(',',$ids);
$this_system->init_model();

$sql = "SELECT iid,softsize,totaldown FROM $this_module->addon_table WHERE iid in ($ids)";
$query=$DB_slave->fetch_all($sql);

if(!$query)exit('{}');
echo json_encode($query);
exit;
