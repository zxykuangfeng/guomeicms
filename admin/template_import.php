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
                exit(json_encode(['code'=>0,'msg'=>'密码错误']));
            }
            $recode = include CACHE_PATH .'db_backup/code.php';
            if(!$recode or $recode!=$code){
                exit(json_encode(['code'=>0,'msg'=>'密码错误']));
            }
            exit(json_encode(['code'=>1,'msg'=>'done']));
            break;
        case 'import':

            $code = $_POST['code'];
            if(!$code){
                echo '<script> window.parent.alert("上传失败,密码错误");</script>';exit;
            }
            $recode = include CACHE_PATH .'db_backup/code.php';
            if(!$recode or $recode!=$code){
                echo '<script> window.parent.alert("上传失败,密码错误");</script>';exit;
            }

            $name =  $_POST['importtpl'];

            $attdir = PHP168_PATH .$core->CONFIG['attachment']['path'];
            $path = attachment_url($name,true);
            $path = str_replace('<!--#p8_attach#-->',$attdir,$path);

            include PHP168_PATH.'/inc/pclzip.lib.php';
            $zip = new PclZip($path);//压缩文件的路径

            if (($list = $zip->listContent()) == 0) {
                die("Error : ".$zip->errorInfo(true));
            }
            $removePath = [];


            $tmpp = explode('/',$list[0]['filename']);
            foreach($tmpp as $fn) {
                if ($fn!= 'template' && $fn != 'skin') {
                    $removePath[] = $fn;
                }else{
                    break;
                }
            }

            $removePathStr = implode('/', $removePath);

            if ($zip->extract(PCLZIP_OPT_PATH, PHP168_PATH,PCLZIP_OPT_REMOVE_PATH,$removePathStr) == 0) {
                echo '<script> window.parent.alert("上传失败");</script>';exit;
            }else{
                echo '<script> window.parent.alert("模板上传成功，请更新模板缓存");</script>';exit;
            }
    }

    message('done', HTTP_REFERER);

}
function getPaths($path){
    $flsi = scandir($path);
    $fff = [];
    foreach ($flsi as $ff){
        if($ff=='.' or $ff=='..')continue;
        if(is_dir($path.$ff)){
            $fff += getPaths($path.$ff.'/');
        }else {
            $fff[] = $path . $ff;
        }
    }
    return $fff;
};