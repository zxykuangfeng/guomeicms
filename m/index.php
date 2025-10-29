<?php
$_GET['ismobile']=isset($_GET['ismobile']) && empty($_GET['ismobile']) ? 0 : 1;
defined('ISMOBILE') || define('ISMOBILE',true);
defined('FROM_MOBILE') || define('FROM_MOBILE',true);
require dirname(__FILE__).'/../index.php';