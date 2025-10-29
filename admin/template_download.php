<?php
defined('PHP168_PATH') or die();

/**
 * 表管理
 **/

$this_controller->check_admin_action('') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    $list = array();
    $handle = opendir(CACHE_PATH .'db_backup/');
    if($handle === false) {
        $error = error_get_last();
        message($error['message']);
    }
    while(($item = readdir($handle)) !== false){
        if($item == '.' || $item == '..' || !is_dir(CACHE_PATH .'db_backup/'. $item)) continue;
        $datm = substr($item,0,16);
        $datms =  explode('#',$datm);
        $datms[1] = str_replace('_',':',$datms[1]);
        $datm = implode(' ',$datms);

        $flsi = scandir(CACHE_PATH .'db_backup/'.$item);

        $list[] = [
            'title'=>$item,
            'datetime'=>$datm,
            'size'=>count($flsi),
            'hash'=>authcode_token($item,'INCODE',0,true)
        ];
        rsort($list);
    }

    include template($this_module, 'download', 'admin');


}else if(REQUEST_METHOD == 'POST'){

    $action = isset($_POST['act']) ? $_POST['act'] : '';
    $module = isset($_POST['module']) ? $_POST['module'] : '';

    switch($action){

        case 'checkcode':

            $code = $_POST['code'];
            if(!$code){
                exit(json_encode(['code'=>0,'msg'=>'code is need']));
            }
            $recode = include CACHE_PATH .'db_backup/code.php';
            if(!$recode or $recode!=$code){
                exit(json_encode(['code'=>0,'msg'=>'code is err']));
            }
            exit(json_encode(['code'=>1,'msg'=>'done']));
            break;
        case 'download':

            $code = $_POST['code'];
            if(!$code){
                exit(json_encode(['code'=>0,'msg'=>'code is need']));
            }
            $recode = include CACHE_PATH .'db_backup/code.php';
            if(!$recode or $recode!=$code){
                exit(json_encode(['code'=>0,'msg'=>'code is err']));
            }


            $name = isset($_POST['name']) ? basename(clean_path($_POST['name'])) : '';
            $name = escapeshellcmd($name);
            $name = p8_filter_special_chars(clear_special_char($name));

            $tpldir = PHP168_PATH.'template/';
            $skindir = PHP168_PATH.'skin/' ;

            if($module=='sites'){
                $tpldir .= 'sites/';
                $skindir .= 'sites/';
            }elseif($module=='member'){
                $tpldir .= 'member/';
                $skindir .= 'member/';
            }

            $fname = $name;

            if(!is_dir($tpldir . $name)){
                exit(json_encode(['code'=>0,'msg'=>'file not exist']));
            }else{
                $_fname = include $tpldir . $name.'/#.php';
                $fname .= '_'.$_fname['name'];
            }

            $att_path = $tpldir .$name .'/';
            $skn_path = $skindir.$name .'/';
            $_path = md5($name).'.zip';;
            $_path = PHP168_PATH . $core->CONFIG['attachment']['path'] .'/core/' . $_path;

            @rm($_path);
            include PHP168_PATH.'/inc/pclzip.lib.php';
            $pclzip = new PclZip($_path);

            $flsi = scandir($att_path);

            $fff  = [];
            foreach ($flsi as $ff){
                if($ff=='.' or $ff=='..')continue;
                $fff[] = $att_path.$ff;
            }

            $ffft = getPaths($att_path);
            $fffs = getPaths($skn_path);
            $fff = array_merge($ffft,$fffs);

            $phppath = PHP168_PATH;
            if($ind=strpos(PHP168_PATH,':')!=false) {
                $phppath = substr(PHP168_PATH,$ind+1);
            }
            $pclzip->create($fff,PCLZIP_OPT_REMOVE_PATH,$phppath,PCLZIP_OPT_ADD_PATH,$name);


            $filetype = file_ext($_path);


//ob_end_clean();
            header('Last-Modified: '.gmdate('D, d M Y H:i:s', P8_TIME).' GMT');
            header('Pragma: no-cache');
            header('Content-Encoding: none');

            header('Content-Disposition: attachment; filename='.$fname.'.zip' );

            header('Content-type: '. $filetype);
            header('Content-Length: '.filesize($_path));
            ob_clean();
            flush();
            readfile($_path);

            rm($_path);
            exit;
            break;

    }

    message('done', HTTP_REFERER);

}
function getPaths($path){
    $flsi = scandir($path);
    $fff = [];
    foreach ($flsi as $ff){
        if($ff=='.' or $ff=='..')continue;
        if(is_dir($path.$ff)){
            $fff = array_merge($fff,getPaths($path.$ff.'/'));
        }else {
            $fff[] = $path . $ff;
        }
    }
    return $fff;
};