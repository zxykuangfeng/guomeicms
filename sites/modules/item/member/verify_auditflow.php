<?php
defined('PHP168_PATH') or die();

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
//$my_category_to_verify = $this_controller->get_acl('my_category_to_verify', $this_system->SITE);
    $keyword = isset($_GET['keyword']) ? p8_stripslashes2(ltrim($_GET['keyword'])) : '';
    $keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(ltrim($_GET['word'])) : '');
    $username = isset($_GET['username']) ? trim($_GET['username']) : '';
    $verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
    $desc = empty($_GET['order']) ? ' DESC' : ' ASC';
    $order_num = empty($_GET['order']) ? 0 : intval($_GET['order']);
    $id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
    $word = urlencode($keyword);

    if (isset($_GET['verified'])) {
        $verified = intval($_GET['verified']);
        $T = $verified == 1 ? $this_module->main_table : $this_module->unverified_table;

    } else {
        $verified = 1;
        $T = $this_module->main_table;
    }
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

    global $UID;
    $auditFlow = &$this_module->core->load_module('auditflow');

    if ($verified == 1) {
        if ($MODEL) {
            $select->from($this_module->table . ' AS i', 'i.*');
        } else {
            $select->from($this_module->main_table . ' AS i', 'i.*');
        }
    } else {
        $select->from($T . ' AS i', 'i.*');

        if (in_array($verified, [-99, 88, 66])) {
            $select->in('i.verified', $verified);
        } else {
            $select->in('i.verified', [-99, 88, 66], true);
        }


    }

    $select->in('i.site', $this_system->SITE);
    if ($this_system->check_manager()) {
        ;
    } else {
        if ($id) {
            $select->in('i.id', $id);
        } else {
            if ($cid) {
                $category->get_cache();
                if ($cid) {
                    $ids = [$cid] + $category->get_children_ids($cid);
                    $select->in('i.cid', $ids);
                }
            } else {
                $conditon = $auditFlow->getCondition('sites',$this_system->SITE, $UID);
                if ($conditon) {
                    $select->where($conditon);
                } else {
                    $select->in('i.cid', '-1');
                }
            }
        }
    }


    $select->order('i.level ' . $desc . ', i.timestamp' . $desc);
    if (strlen($keyword)) {
        $select->search('i.title', $keyword);
    }
    if (strlen($username)) {
        $select->in('i.username', $username);
    }
    if (strlen($verifier)) {
        $select->in('i.verifier', $verifier);
    }


//$select->order('i.id DESC');

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
    $usernames = [];
    foreach ($list as $k => $v) {
        $list[$k]['level'] = isset($P8LANG['sites_item']['level_rank'][$v['level']]) && $v['level'] > 240 ? $P8LANG['sites_item']['level_rank'][$v['level']] : $v['level'];
        $list[$k]['url'] = $core->STATIC_URL . '/s.php/' . $this_system->SITE . '/item-view-id-' . $v['id'];
        $list[$k]['url'] .= $verified == 1 ? '' : '?verified=0';
        $list[$k]['frame_url'] = $core->STATIC_URL . '/s.php/' . $this_system->SITE . '/item-view_frame-id-' . $v['id'];
        $list[$k]['frame_url'] .= $verified == 1 ? '' : '?verified=0';
        $list[$k]['title'] = p8_cutstr($list[$k]['title'], 90);
        $list[$k]['attributes'] = explode(',', $v['attributes']);
        $list[$k]['poster_name'] = !empty($v['username']) ? generate_unique_key($v['username']) : '';
        $list[$k]['verifier_name'] = !empty($v['verifier']) ? generate_unique_key($v['verifier']) : '';
        $list[$k]['verify_need'] = $auditFlow->checkNeed($v['cid'], $UID, $v['verified'], $this_system->name,$this_system->SITE);
        if ($v['username']) {
            $usernames[] = $v['username'];
        }
        if ($v['verifier']) {
            $usernames[] = $v['verifier'];
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

    $allsites = $_allsites = $this_system->get_sites();
    $sitename = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename'] : '';
    $site_domain = !empty($allsites[$this_system->SITE]['domain']) ? $allsites[$this_system->SITE]['domain'] : $this_system->controller;

//属性JSON
    $attributes = [];
    foreach ($this_module->attributes as $aid => $lang) {
        $attributes[$aid] = $this_module->CONFIG['attributes'][$aid] ? $this_module->CONFIG['attributes'][$aid] : $P8LANG['sites_item']['attribute'][$aid];
    }
    $attr_json = p8_json($attributes);
//推送数据到分站
    $allow_sites_push = $this_controller->check_action('sites_push');

//推送数据到总站
    $allow_cluster_push = $this_controller->check_action('cluster_push');

//分站间直推送数据
    $allow_sites_push_sites = $this_controller->check_action('sites_push_sites');
    $allow_view_to_html = $this_controller->check_action('view_to_html');
    $allow_clone = $this_controller->check_action('clone');
    $allow_verify_frame = $this_module->CONFIG['verify_frame_editable'] && $this_module->CONFIG['menu_verify_frame'] ? false : true;
    $sync_index_to_html = $this_module->CONFIG['sync_index_to_html'] ? 1 : 0;
    $cms_system = $core->load_system('cms');
    unset($_allsites[$this_system->SITE]);
    $_allsites = array_keys($_allsites);
    $selected_site = current($_allsites);
	//顺序改一下
	$verify_acl = $this_module->CONFIG['verify_acl'];
	foreach($verify_acl as $key=>$val){
		$verify_acl[$key]['name'] = $val['name'] ? $val['name'] : $P8LANG['sites_item']['verify'][$key];
	}
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
    include template($this_module, 'verify_auditflow');

} else {
    if (REQUEST_METHOD == 'POST') {
        //只提供AJAX调用

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
        if($verified == 0){
			$ret = $this_controller->verify_first(array(
				'where' => $cond,
				'value' => $value,
				'verified' => $verified,
				'push_back_reason' => $push_back_reason
			))or exit('[]');
		}else{
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
