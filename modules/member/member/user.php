<?php
defined('PHP168_PATH') or die();

/**
* 登录
**/

//style=com&id=header_login
header('Content-Type: application/javascript; charset=utf-8');
if(REQUEST_METHOD == 'GET'){
	if(isset($_GET['username']) || isset($_GET['password'])){
		exit('attack');
	}
	$style = 'com';
    $boxid = 'header_login';
    $forward=HTTP_REFERER;
    if(!$boxid){
        include template($this_module, 'login/com');
    }else{
        if($UID){
            $this_module->set_model($ROLE_GROUP);
            $member_info = $this_module->get_member_info($UID);
        }
		$site = null;
		$mysites = array();
		if(isset($core->systems['sites']) && !empty($core->systems['sites']['enabled'])){
			$site = $core->load_system('sites');
			$mysites = array_slice($site->get_manage_sites(),0,8);
			$allsites  = $site->get_sites();
		}
		$mysites_num = count($mysites);
		ob_start();
        include template($this_module, 'login/com');
        $show=ob_get_contents();
        ob_end_clean();
        $show=str_replace(array("\n","\r","'"),array("","","\'"),$show);

        if(isset($core->systems['sites']) && !empty($core->systems['sites']['enabled'])){
            $site = $core->load_system('sites');			
            if($site->isfromsites()){                
				$show = str_replace('u.php"','u.php?site='.$site->SITE.'"',$show);
				$show = str_replace('mainstation',$site->SITE,$show);				
            }else{
				$show = str_replace('u.php"','u.php?site=mainstation"',$show);
			}
			$show = str_replace('_mainsites_','mainstation',$show);
        }
        echo "$('#header_login').html('$show');";
        exit;
    }

}