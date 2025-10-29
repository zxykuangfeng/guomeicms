<?php
/**
 *
 * Power by php168.net
 * User: bingbin
 * Date: 2021/9/15
 * Time: 15:14
 */

require dirname(__FILE__) .'/../../inc/init.php';
$Site = $core->load_system('sites');
$return['status'] = $Site->site['status'];
$str = json_encode($return);
exit($str);