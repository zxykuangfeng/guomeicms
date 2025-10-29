<?php
defined('PHP168_PATH') or die();
//如没终审权限，检查初审
$this_controller->check_action($ACTION) or message('', $this_module->U_controller . '-verify_first', 0);
if (!empty($core->modules['auditflow']) && $core->modules['auditflow']['enabled'] && !empty(intval($core->CONFIG['audit_flow_enable']))) {
    include_once __DIR__ . '/verify_auditflow.php';
    return;
}


if (REQUEST_METHOD == 'GET') {

    $MODEL = '';

    if (isset($_REQUEST['model'])) {
        $this_system->init_model();
    }

    $MODEL && load_language($this_module, $MODEL);

    $page_url = $this_router . '-' . $ACTION . '?';

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $page = max($page, 1);
    $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
    $keyword = isset($_GET['keyword']) ? p8_stripslashes2(ltrim($_GET['keyword'])) : '';
    $keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(ltrim($_GET['word'])) : '');
    $username = isset($_GET['username']) ? trim($_GET['username']) : '';
    $verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
    $order =  isset($_GET['order']) && $_GET['order'] ? intval($_GET['order']) : 0;    
    $id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
    $word = urlencode($keyword);

    if (isset($_GET['verified'])) {
        $verified = intval($_GET['verified']);
        $T = $verified == 1 ? $this_module->main_table : $this_module->unverified_table;

    } else {
        $verified = 1;
        $T = $this_module->main_table;
    }

//如果是初审，去掉终审
    if ($verified == 0) {
        unset($this_module->CONFIG['verify_acl'][1]);
    }
    if (!in_array($verified, [0,1,2,3,66,77,88,-99,-100])) {
        message('no_privilege');
    }
    $class = [
        '0'  => '',
        '1'  => '',
        '2'  => '',
        '3'  => '',
        '66' => '',
		'77' => '',
        '88' => '',
        '99' => '',
    ];
    $class[abs($verified)] = 'class="over"';
    /*
    $page_url .= '&verified='. $verified;
    $page_url .= '&model='. $MODEL;
    $page_url .= '&cid='. $cid;
    $page_url .= '&word='. urlencode($keyword);
    $page_url .= '&page=?page?';
    */
    $page_url = $this_url . '?';
    $page_url = 'javascript:request_item(?page?)';

    $select = select();
    $my_category_to_verify = $this_controller->get_acl('my_category_to_verify');
    $my_category_to_verify_first = $this_controller->get_acl('my_category_to_verify_first');
    $my_addible_category = p8_json($my_category_to_verify);
    $category = &$this_system->load_module('category');
    $category->get_cache();
    $reflash_index = $this_controller->check_action('reflash_index');
    if ($verified == 1) {
        if ($MODEL) {
            $select->from($this_module->table . ' AS i', 'i.*');
        } else {
            $select->from($this_module->main_table . ' AS i', 'i.*');
        }
    } else {
        $select->from($T . ' AS i', 'i.*');
		switch($verified){
			case '-100':
				$select->in('i.verified', 88,true);
				break;
			case '3':
				$select->in('i.verified', array(0,2));
				break;
			default:
				$select->in('i.verified', $verified);
		}
    }
//$verified = abs($verified);
//array_intersect the same id
    $array_intersect = [];

    $show[0] = $show[1] = $show[2] = $show[3] = $show[66] = $show[77] = $show[88] = $show[99] = true;
    if (isset($my_category_to_verify[0])) {
        if (!$IS_FOUNDER) {
            if (isset($my_category_to_verify_first[0])) {
                $show[0] = $show[2] = false;
            } elseif (!empty($my_category_to_verify_first)) {
                $array_intersect = array_keys($my_category_to_verify_first);
                if ($verified == 3) {
                    $select->in('i.cid', array_keys($array_intersect));
                }
                if ($verified == 2) {
                    $select->in('i.cid', array_keys($array_intersect), true);
                }
                if ($verified == 0) {
                    $select->in('i.cid', array_keys($array_intersect), true);
                }
            } else {
                $show[0] = $show[3] = false;
            }
        }
    } elseif (!empty($my_category_to_verify)) {
        if (!$IS_FOUNDER) {
            if (isset($my_category_to_verify_first[0])) {
                $array_intersect = array_keys($my_category_to_verify);
                if ($verified == 0 || $verified == 2) {
                    $select->in('i.cid', $array_intersect, true);
                }
                if (in_array($verified, [1, 3, 66])) {
                    $select->in('i.cid', $array_intersect);
                }
            } elseif (!empty($my_category_to_verify_first)) {
                $array_intersect = array_intersect(array_keys($my_category_to_verify),
                    array_keys($my_category_to_verify_first));
                $array_merge = array_unique(array_merge(array_keys($my_category_to_verify),
                    array_keys($my_category_to_verify_first)));
                $array_diff_verify = array_diff(array_keys($my_category_to_verify),
                    array_keys($my_category_to_verify_first));
                $array_diff_verify_first = array_diff(array_keys($my_category_to_verify_first),
                    array_keys($my_category_to_verify));

                if (empty($array_intersect)) {
                    $show[3] = false;
                    if ($verified == 0) {
                        $select->in('i.cid', array_keys($my_category_to_verify_first));
                    }
                    if (in_array($verified, [1, 2, 66])) {
                        $select->in('i.cid', array_keys($my_category_to_verify));
                    }
                    if (abs($verified) == 99) {
                        $select->in('i.cid', $array_merge);
                    }
                } else {
                    if (in_array($verified, [1, 66, 99])) {
                        $select->in('i.cid', array_keys($my_category_to_verify));
                    }
                    if ($verified == 3) {
                        $select->in('i.cid', $array_intersect);
                    }
                    if (empty($array_diff_verify_first)) {
                        $show[0] = false;
                    }
                    if (empty($array_diff_verify)) {
                        $show[2] = false;
                    }
                    if ($verified == 0 && !empty($array_diff_verify_first)) {
                        $select->in('i.cid', $array_diff_verify_first);
                    }
                    if ($verified == 2 && !empty($array_diff_verify)) {
                        $select->in('i.cid', $array_diff_verify);
                    }
                }
            } else {
                $show[0] = $show[3] = false;
                $mycids = array_keys($my_category_to_verify);
                if (count($mycids) > 1 || count($mycids) == 1 && $mycids[0] != 0) {
                    $select->in('i.cid', $mycids);
                }
            }
        }
    } else {
        if (!$IS_FOUNDER) {
            $show[2] = $show[3] = false;
            if (isset($my_category_to_verify_first[0])) {
                if ($cid) {
                    $select->in('i.cid', $cid);
                }
            } elseif (!empty($my_category_to_verify_first)) {
                $select->in('i.cid', array_keys($my_category_to_verify_first));
            }
        }
    }
    if ($IS_FOUNDER) {
        $show[0] = $show[2] = $show[3] = $show[66] = true;
    }
//if(!$show[abs($verified)]) message('no_privilege');
    /*
        if(isset($my_category_to_verify[0]) || $IS_FOUNDER){
            if($cid)$select->in('i.cid',$cid);
        }elseif(!empty($my_category_to_verify)){
            $my_category_to_verify =array_keys($my_category_to_verify);
            if($cid && in_array($cid, $my_category_to_verify)){
                $select->in('i.cid', $cid);
            }else{
                $select->in('i.cid', $my_category_to_verify);
            }
        }else{
                message('no_privilege');
        }
    */
    if ($id) {
        $select->in('i.id', $id);
    } else {
        switch($order){
			case '1':
				$select->order('i.timestamp ASC, i.level DESC');
			break;
			case '2':
				$select->order('i.level DESC, i.timestamp DESC');
			break;			
			default:
				$select->order('i.timestamp DESC, i.level DESC');
		}		
        if (strlen($keyword)) {
            $select->search('i.title', $keyword);
        }
        if (strlen($username)) {
            $select->in('i.username', $username);
        }
        if (strlen($verifier)) {
            $select->in('i.verifier', $verifier);
        }
        if ($cid) {
            $ids = [$cid] + $category->get_children_ids($cid);
            $select->in('i.cid', $ids);
        }
    }
//所有模型
    $models = $this_system->get_models();

    $count = 0;
    $select->left_join($core->TABLE_ . 'member as m', 'm.name as poster_name', 'm.username=i.username');
//$select->left_join($core->TABLE_.'member as v', 'v.name as verifier_name', 'v.username=i.verifier');

//echo $select->build_sql();
//取数据
    $list = $core->list_item(
        $select,
        [
            'page'      => &$page,
            'count'     => &$count,
            'page_size' => 20,
            'ms'        => 'master',
        ]
    );
    $usernames = $models_addon = array();
	$core_config = $core->get_config('core','');
	$main_domain = $core_config['static_enable'] && $core_config['static_url'] ? $core_config['static_url'] : $core->url;
    foreach ($list as $k => $v) {
		$v['#category'] = &$category->categories[$v['cid']];
        $list[$k]['level'] = isset($P8LANG['cms_item']['level_rank'][$v['level']]) && $v['level'] > 240 ? $P8LANG['cms_item']['level_rank'][$v['level']] : $v['level'];
        $list[$k]['title'] = p8_cutstr($list[$k]['title'], 66);
        $list[$k]['url'] = p8_url($this_module, $v, 'view');
		$list[$k]['url'] .= $verified == 1 ? '' : '?verified=0';
		$list[$k]['url'] = attachment_url($list[$k]['url'],false,true);
        $list[$k]['attributes'] = explode(',', $v['attributes']);
        if($verified != 1) {
            $data = unserialize($v['data']);
            $list[$k]['verifier'] = $data['main']['verifier'];
        }
        $list[$k]['poster_name'] = !empty($v['username']) ? generate_unique_key($v['username']) : '';
        $list[$k]['verifier_name'] = !empty($v['verifier']) ? generate_unique_key($v['verifier']) : '';
        if($v['username']) {
            $usernames[] = $v['username'];
        }
        if($v['verifier']) {
            $usernames[] = $v['verifier'];
        }		
		$v_config = isset($v['config']) ? mb_unserialize(stripslashes($v['config'])) : array();
		if(empty($v['url']) && $v_config['allow_ip']['enabled'] >= 1 && $core_config['static_enable'] && $core_config['static_url']){
			$list[$k]['static_url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';
		}else{
			$list[$k]['static_url'] = $list[$k]['url'] ? $list[$k]['url'] : $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';
		}
		$models_addon[$v['model']][$k] = $v['id'];
		$list[$k]['lan_access_only'] = 0;
    }
	/*局域网*/
	foreach($models_addon as $model_ => $model_ids){
		if(!$model_) continue;
		$table = $this_module->TABLE_ .$model_.'_';
		$where = 'where id in ('.implode(',',array_values($model_ids)).')';
		$query = $core->DB_master->query("select `id`,`config` from $table $where");
		$model_ids_flip = array_flip($model_ids);
		while($arr = $core->DB_master->fetch_array($query)){
			$v_config = $arr['config'] ? mb_unserialize(stripslashes($arr['config'])) : array();
			if($v_config && $v_config['allow_ip']['enabled'] >= 1){
				$list[$model_ids_flip[$arr['id']]]['lan_access_only'] = 1;
			}
		}	
	}
//member_info
    $member_info = [];
    if ($usernames) {
        $push_usernames_string = '';
        $div = '';
        foreach (array_unique($usernames) as $username_tmp) {
            $push_usernames_string .= $div . "'" . $username_tmp . "'";
            $div = ',';
        }
        $member_table = $core->TABLE_ . 'member';
        $sql = "SELECT id,username,name FROM `$member_table` WHERE username in ($push_usernames_string);";
        $query = $core->DB_master->query($sql);
        while ($arr = $core->DB_master->fetch_array($query)) {
            $md5_username = generate_unique_key($arr['username']);
            $member_info[$md5_username] = $arr['name'];
        }
    }
//分页
    $pages = list_page([
        'count'     => $count,
        'page'      => $page,
        'page_size' => 20,
        'url'       => $page_url,
    ]);
//属性JSON
    $attributes = [];
    foreach ($this_module->attributes as $aid => $lang) {
        $attributes[$aid] = $P8LANG['cms_item']['attribute'][$aid];
    }
    $allow_cms_sites_push = $this_controller->check_action('cms_sites_push') && isset($core->systems['sites']) && $core->systems['sites']['installed'];
    $allow_view_to_html = $this_controller->check_action('view_to_html');
    $allow_clone = $this_controller->check_action('clone');
    $allow_verify_frame = $this_module->CONFIG['verify_frame_editable'] && $this_module->CONFIG['menu_verify_frame'] ? false : true;
    $sync_index_to_html = $this_module->CONFIG['sync_index_to_html'] ? 1 : 0;
    if (isset($core->systems['sites']) && $core->systems['sites']['installed']) {
        $sites_system = &$core->load_system('sites');
        $allsites = $_allsites = $sites_system->get_sites();
        $_allsites = array_keys($_allsites);
        $selected_site = current($_allsites);
    } else {
        $allsites = $_allsites = [];
        $selected_site = '';
    }
	//顺序改一下
	$verify_acl = $this_module->CONFIG['verify_acl'];
	$verify_acl_sort = array();
	if(isset($verify_acl[-99])){ $verify_acl_sort[-99] = $verify_acl[-99];unset($verify_acl[-99]);}
	if(isset($verify_acl[88])){ $verify_acl_sort[88] = $verify_acl[88];unset($verify_acl[88]);}
	if(isset($verify_acl[0])){ $verify_acl_sort[0] = $verify_acl[0];unset($verify_acl[0]);}
	if(isset($verify_acl[2])){ $verify_acl_sort[2] = $verify_acl[2];unset($verify_acl[2]);}
	if(isset($verify_acl[1])){ $verify_acl_sort[1] = $verify_acl[1];unset($verify_acl[1]);}
	foreach($verify_acl as $key=>$val){
		$verify_acl_sort[$key] = $val;
	}
	$this_module->CONFIG['verify_acl'] = $verify_acl_sort ? $verify_acl_sort : $this_module->CONFIG['verify_acl'];
	
    include template($this_module, 'verify');

} else {
    if (REQUEST_METHOD == 'POST') {
        //只提供AJAX调用
//id: id, value: value,verified:verified
//$_POST['id'] = 1254;
//$_POST['value'] = 2;
//$_POST['verified'] = 0;
        $id = isset($_POST['id']) ? $_POST['id'] : [];
        $value = isset($_POST['value']) ? intval($_POST['value']) : 0;
        $id or message('no_such_item');

        $id = filter_int($id);
        $id or exit('[]');

        $verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? 1 : 0;
        //退稿理由
        $push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
		$member_info = get_member($USERNAME);
		$push_back_reason .= date('Y-m-d H:i:s', P8_TIME).' '.$P8LANG['verifier'].':'.$USERNAME.($member_info['name'] ? '('.$member_info['name'].')' : '');	
        $T = $value == 1 ? $this_module->unverified_table : $this_module->main_table;
        $T = $verified ? $this_module->main_table : $this_module->unverified_table;

        $cond = $T . '.id IN (' . implode(',', $id) . ')';
        if ($verified == 0) {
            $ret = $this_controller->verify_first([
                'where'            => $cond,
                'value'            => $value,
                'verified'         => $verified,
                'push_back_reason' => $push_back_reason,
            ]) or exit('[]');
        } else {
            $ret = $this_controller->verify([
                'where'            => $cond,
                'value'            => $value,
                'verified'         => $verified,
                'push_back_reason' => $push_back_reason,
            ]) or exit('[]');
        }
        exit(jsonencode($ret));
    }
}
