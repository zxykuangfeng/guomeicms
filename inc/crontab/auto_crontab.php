<?php
//*/5 * * * * /alidata/service/php /alidata/www/sharp/inc/crontab/auto_crontab.php 

require_once dirname(dirname(dirname(__FILE__))).'/inc/init.php';

$crontab = $core->load_module('crontab');
$crontab_id = !empty($argv[1])?$argv[1]:0;
require $crontab->path .'inc/run.php';
	