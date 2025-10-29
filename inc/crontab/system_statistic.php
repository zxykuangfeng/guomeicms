<?php
defined('PHP168_PATH') or die();

/**
* 更新统计
**/

$cms = $core->load_system('cms');
$statistic_module = $cms->load_module('statistic');

$year = date('Y');
//_member
$static = $statistic_module->statisticMember(0, 0, $year, 0, '', 0,0);
//_data
$static = $statistic_module->statistic($year,0,'',0);
//day
$static = $statistic_module->day_statistic($year,0,'',0);
//sites
$systems = $core->list_systems();
if(isset($systems['sites']) && $systems['sites']['enable']){
	$static = $statistic_module->statisticSitesPush($year,0);
}
$statistic_module->cache();