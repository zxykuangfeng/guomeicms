<?php
header('Pragma: no-cache');
header('Cache-Control: no-cache, must-revalidate');

require dirname(__FILE__) .'/../inc/init.php';
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$hash = unique_id(16);
//SESSION
$_P8SESSION['Csrf_Token'] = strtolower($hash);
echo $hash;

