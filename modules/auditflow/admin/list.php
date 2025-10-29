<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

    $module = isset($_GET['module']) ? trim($_GET['module']) : '';
    $postfix = isset($_GET['postfix']) ? trim($_GET['postfix']) : '';
    $num = isset($_GET['num']) ? intval($_GET['num']) : '';
    $verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';

    $select = select();
    $select->from($this_module->table, '*');
    $module && $select->in('module',$module);
    $postfix && $select->in('postfix',$postfix);
    $num && $select->in('num',$num);
    $member = &$core->load_module('member');
    if($verifier){
        $manager = $this_module->core->DB_master->fetch_one("SELECT id,username,name FROM {$member->table} WHERE `username` like '%$verifier%'");
        if($manager){
            $vid = $manager['id'];
            $select->like('step_one',$vid);
            $select->where_or();
            $select->like('step_two',$vid);
            $select->where_or();
            $select->like('step_three',$vid);
            $select->where_or();
            $select->like('step_four',$vid);
            $select->where_or();
            $select->like('step_final',$vid);
            $select->where_or();
            $select->like('step_auto',$vid);
        }
    }

    $select->order('id DESC');

    $page_url = $this_url .'?all='. $all;

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $page = max(1, $page);
    $count = 0;
    $page_size = 40;

    $page_url .= '&page=?page?';


    $list = $core->list_item(
        $select,
        array(
            'page' => &$page,
            'count' => &$count,
            'page_size' => $page_size
        )
    );

    $uids = [];
    $one = array_column($list,'step_one');
    $two = array_column($list,'step_two');
    $thre = array_column($list,'step_three');
    $four = array_column($list,'step_four');
    $final = array_column($list,'step_final');
    $auto = array_column($list,'step_auto');

    $uids = array_merge($uids,$one,$two,$thre,$four,$final,$auto);
    $uids = implode(',',$uids);
    $uids = array_filter(array_unique(explode(',',$uids)));
    $uids = implode(',',$uids);
    $uids = $uids?$uids:-1;


    $managers = $core->DB_master->fetch_all("SELECT id,username,name FROM {$member->table} WHERE id IN ($uids)");
    $managers = array_column($managers, 'username', 'id');

    $formatuser = function($uids)use ($managers){
        $user = [];
        $uidarr = explode(',',$uids);
        foreach ($uidarr as $uid){
            $user[] = $managers[$uid];
        }
        return implode('，', $user);
    };

    $sitess = [];
    if(isset($core->systems['sites'])) {
        $sites = $core->load_system('sites');
        $sitess = $sites->sites;
    }


    $modules = [
        'cms'=>'<b>主站<font color="blue">内容系统</font></b>',
        'sites'=>'<b>子站<font color="blue">站群系统</font></b>',
        'forms'=>'<b>主站<font color="blue">表单内容模块</font></b>',
    ];
    $sitess = [];
    $sitesjs = [];
    if(isset($core->systems['sites'])) {
        $sites = $core->load_system('sites');
        $sitess = $sites->sites;

        foreach ($sitess as $kk=>$vv){
            $sitesjs[]=['k'=>$kk,'v'=>$vv['sitename']];
        }
        $sitess['mainstation'] = '主站';
    }
    $sitesjs = json_encode($sitesjs,256);
    $sitess['mainstation']['sitename'] = '主站';
    foreach($list as &$item){
        $item['step_one'] = $formatuser($item['step_one']);
        $item['step_two'] = $formatuser($item['step_two']);
        $item['step_three'] = $formatuser($item['step_three']);
        $item['step_four'] = $formatuser($item['step_four']);
        $item['step_final'] = $formatuser($item['step_final']);
        $item['step_auto'] = $formatuser($item['step_auto']);
        $item['module_name'] = $modules[$item['module']];
        if($item['module']=='sites') {
            $item['postfix_name'] = $sitess[$item['postfix']]['sitename'];
        }else if($item['module']=='forms') {
            $item['postfix_name'] = $formmods[$item['postfix']]['alias'];
        }
        $item['module_name2'] = strip_tags($modules[$item['module']]);
    }

    $pages = list_page(array(
        'count' => $count,
        'page' => $page,
        'page_size' => $page_size,
        'url' => $page_url
    ));

    include template($this_module, 'list', 'admin');

}else if(REQUEST_METHOD == 'POST'){

    $action = isset($_POST['act']) ? $_POST['act'] : '';

    switch($action){

        case 'import':
            $data = isset($_POST['data']) ? trim(p8_stripslashes2($_POST['data'])) : '';
            $data = convert_encode($core->CONFIG['page_charset'], 'UTF-8', $data);

            $data = @mb_unserialize($data);
            $data or message('fail', HTTP_REFERER);

            //转成UTF-8
            $data = convert_encode('UTF-8', $core->CONFIG['page_charset'], $data);

            foreach($data as $label){
                unset($label['id']);

                $this_module->add($label,true);
            }

            message('done', HTTP_REFERER);
            break;

        case 'export':
            define('NO_ADMIN_LOG', true);

            $id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
            $id or exit('no_such_item');

            $ids = implode(',', $id);
            $query = $DB_master->query("SELECT * FROM $this_module->table WHERE id IN ($ids)");
            $data = array();
            while($arr = $DB_master->fetch_array($query)){
                $arr['option'] = mb_unserialize($arr['option']);
                unset($arr['id']);
                unset($arr['timestamp']);
                unset($arr['last_update']);
                $data[] = $arr;
            }
            //转成UTF-8
            $data = convert_encode($core->CONFIG['page_charset'], 'UTF-8', $data);

            $content = serialize($data);
            header('Last-Modified: '. gmdate('D, d M Y H:i:s', P8_TIME).' GMT');
            header('Content-Type:application/octet-stream');
            header('Pragma: no-cache');
            header('Content-Encoding: none');
            header('Content-Disposition: attachment; filename="label.txt');
            header('Content-Length:'. strlen($content));

            exit($content);
            break;

    }
}
