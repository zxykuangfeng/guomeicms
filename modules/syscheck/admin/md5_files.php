<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

function _md5_files($path){
	static $path_filter, $filter, $ext_filter;
	
	if(empty($path_filter)){
		$path_filter = array(
			CACHE_PATH => 1,
			PHP168_PATH .'html/' => 1,
			PHP168_PATH .'sites/html/' => 1,
			PHP168_PATH .'attachment/' => 1,
			PHP168_PATH .'template/' => 1,
			PHP168_PATH .'sky/' => 1,
		);
		
		$filter = array('.svn' => 1, '_svn' => 1, 'acl' => 1);
		
		$ext_filter = array('php' => 1, 'js' => 1);
	}
	
	$ret = array();
	
	$handle = opendir($path);
	while(($item = readdir($handle)) !== false){
		if($item == '.' || $item == '..' || isset($path_filter[$path]) || isset($filter[$item])) continue;
		
		if(is_dir($path . $item)){
			$ret += _md5_files($path . $item .'/');
		}else{
			$ext = strtolower(file_ext($item));
			if(!isset($ext_filter[$ext])) continue;
			
			$ret[str_replace(PHP168_PATH, '', $path . $item)] = array(md5_file($path . $item),filemtime($path . $item));
		}
	}
	
	return $ret;
}

@set_time_limit(0);
@ignore_user_abort(false);
load_language($core, 'md5_files');
$tmpfile = CACHE_PATH .'md5_files/md5_files.php';
md(CACHE_PATH .'md5_files');
$list = @include $tmpfile;
$list = $list?:array();
if(REQUEST_METHOD == 'GET'){
	
	include template($this_module, 'md5_files', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){

	if(!empty($_POST['del'])){
        $id = p8_addslashes($_POST['ids']);
        $tmp = $list[$id];
        unset($list[$id]);
        unlink(CACHE_PATH .'md5_files/'.$tmp['path'].'.php');
        write_file($tmpfile, "<?php\r\nreturn ". var_export( $list, true).';');
        message('done');
    }elseif(!empty($_POST['tittle'])){
        $path= md5(P8_TIME.$_POST['tittle']);
		
        $list[$path]= array(
            'tittle'=>p8_addslashes($_POST['tittle']),
            'add_time'=>date('Y-m-d H:i:s',P8_TIME),
            'path'=>$path
            );
        $data = _md5_files(PHP168_PATH);
		write_file(CACHE_PATH .'md5_files/'.$path.'.php', "<?php\r\nreturn ". var_export( $data, true).';');
		write_file($tmpfile, "<?php\r\nreturn ". var_export( $list, true).';');
		message('done');
	}elseif(!empty($_POST['diff'])){
        if(count($_POST['ids'])!=2){
            message('2file');
        }
		$ids=$_POST['ids'];


       $src = @include CACHE_PATH .'md5_files/'.$list[$ids[0]]['path'].'.php';

       $new = @include CACHE_PATH .'md5_files/'.$list[$ids[1]]['path'].'.php';


		$diff = array();
		foreach($new as $file => $hash){
			if(!isset($src[$file])){
				$diff[$file] = array(
					'status' => 'new',
					'time' => $hash[1]
				);
			}else if($hash[0] != $src[$file][0]){
				$diff[$file] = array(
					'status' => 'mod',
					'time' => $hash[1]
				);
			}
			
			unset($src[$file]);
		}
		
		foreach($src as $file => $hash){
			$diff[$file] = array(
				'status' => 'del',
				'time' => $hash[1]
			);
		}
		
		include template($this_module, 'md5_files', 'admin');
		
	}
}
