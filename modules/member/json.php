<?php
defined('PHP168_PATH') or die();
error_reporting(0);
$string = trim($_GET['tmppd']);
$ret = $this_module->authcode($string,'ENCODE',30);
echo '|'.$ret;