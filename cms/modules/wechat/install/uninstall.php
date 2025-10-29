<?php
defined('PHP168_PATH') or die();

$DB_master->query("DROP TABLE $this_module->keywords");
$DB_master->query("DROP TABLE $this_module->menus");
$DB_master->query("DROP TABLE $this_module->users");
$DB_master->query("DROP TABLE $this_module->pushlogs");
$DB_master->query("DROP TABLE $this_module->messages");