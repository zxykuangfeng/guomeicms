<?php
//为了防止过快刷新，做延时处理
sleep(1);
defined('PHP168_PATH') or die();

$cid = 0;
$page = 1;
foreach ($URL_PARAMS as $k => $v) {
    switch ($v) {
        
        case 'category':
            $cid = isset($URL_PARAMS[$k + 1]) ? intval($URL_PARAMS[$k + 1]) : 0;
            break;
        
        case 'page':
            $page = isset($URL_PARAMS[$k + 1]) ? intval($URL_PARAMS[$k + 1]) : 1;
            $page = max($page, 1);
            break;
    }
}

$cid or exit(p8_json(array()));

// 页面缓存参数: cid
$PAGE_CACHE_PARAM['cid'] = $cid;

// 页面缓存参数: page
$PAGE_CACHE_PARAM['page'] = $page;

// 页面缓存参数: 更新时间
$PAGE_CACHE_PARAM['ttl'] = empty($this_module->CONFIG['list_page_cache_ttl']) ? 0 : $this_module->CONFIG['list_page_cache_ttl'];

// 加载分类模块并取得当前分类的缓存
$category = &$this_system->load_module('category');

$CAT = &$this_system->fetch_category($cid);

// 分类不存在
$CAT or exit(p8_json(array()));

/**
 * *大列表显示所有内容**
 */
if ($CAT['list_all_model'] && $CAT['type'] == 1) {
    // 当前分类的内容数
    $count = $field_filter ? 0 : $CAT['item_count'];
    $pages = intval($count/$CAT['page_size'])+1;
    if($page>$pages) exit(p8_json(array()));
    $_urltemp = $CAT['url'];
    $CAT['url'] = '';
    $CAT['is_category'] = true;
    $page_url = p8_url($this_module, $CAT, 'list', false);
    $CAT['url'] = $_urltemp;
    $select = select();
    $select->from($this_module->main_table . ' AS i', 'i.*');
    // 最后才加载数据较大的分类数据
    $category->get_cache();
    // print_r($CAT);
    // 父分类
    $parent_cats = $category->get_parents($cid);
    // 子分类
    $subcategories = array();
    if (isset($category->categories[$cid]['categories'])) {
        $subcategories = $category->categories[$cid]['categories'];
        $CATEGORY = $category->get_children_ids($cid) + array(
            $cid
        );
    } else {
        $CATEGORY = $cid;
    }
    
    $select->in('i.cid', $CATEGORY);
    //echo $select->build_sql();
    
    $sphinx = $this_module->CONFIG['sphinx'];
    $sphinx['index'] = $this_system->sphinx_indexes(array(
        $MODEL => 1
    ));

    $orderby = empty($CAT['CONFIG']['orderby']) ? 'i.list_order' : $CAT['CONFIG']['orderby'];
    $orderbylevel = in_array($orderby,array('i.list_order','list_order')) ? 'i.level DESC,':'';
    $orderby .= empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
    $orderby = $orderbylevel.$orderby;

    $title_length = empty($CAT['CONFIG']['list_title_length']) ? 100 : $CAT['CONFIG']['list_title_length'];
    if ($core->ismobile)
        $title_length = empty($CAT['CONFIG']['list_title_length_mobile']) ? 20 : $CAT['CONFIG']['list_title_length_mobile'];
    $dot = empty($CAT['CONFIG']['title_dot']) ? '' : '...';
    
    $select->order($orderby);
    //echo $select->build_sql();
    $list = $core->list_item($select, array(
        'count' => &$count,
        'page' => &$page,
        'page_size' => $CAT['page_size'],
        'sphinx' => $sphinx
    ));
    
    foreach ($list as $k => $v) {
        $v['#category'] = &$category->categories[$v['cid']];
        $list[$k]['url'] = p8_url($this_module, $v, 'view');
        $list[$k]['frame'] = attachment_url($v['frame']);
        $list[$k]['full_title'] = $v['title'];
        $list[$k]['title'] = p8_cutstr($v['title'], $title_length, $dot);
        $tmp = explode('|', $v['sub_title']);
        $list[$k]['sub_title'] = $tmp[0];
        $list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
        
        // 分类名称
        $list[$k]['category_name'] = $v['#category']['name'];
        // 分类URL
        $list[$k]['category_url'] = $v['#category']['url'];
        //分类封面
		$list[$k]['category_frame'] = attachment_url($v['#category']['frame']);
        if (! empty($v['title_color']))
            $list[$k]['title'] = '<font color="' . $v['title_color'] . '">' . $list[$k]['title'] . '</font>';
        if (! empty($v['title_bold']))
            $list[$k]['title'] = '<b>' . $list[$k]['title'] . '</b>';
    }
} else {
    // 初始化模型
    $_REQUEST['model'] = $CAT['model'];
    $this_system->init_model();
    $this_model or message('no_such_cms_model');
    $this_model['enabled'] or message('cms_model_disabled');
}

if ($CAT['type'] == 2) {
    // $select的参数
    $select_param = array();
    
    $select_param['from'] = array(
        $this_module->table . ' AS i',
        'i.*'
    );
    
    $CAT['is_category'] = true;
    $tmp = $CAT['htmlize'];
    if ($CAT['htmlize'] == 2) {
        $tmp = $CAT['htmlize'];
        $CAT['htmlize'] = 0;
    }
    $page_url = p8_url($this_module, $CAT, 'list', false);
    $CAT['htmlize'] = $tmp;
    
    $page_urls = $selected_fields = array();
    
    $field_filter = false;

    $orderby = empty($CAT['CONFIG']['orderby']) ? 'i.list_order' : $CAT['CONFIG']['orderby'];
    $orderbylevel = in_array($orderby,array('i.list_order','list_order')) ? 'i.level DESC,':'';
    $orderby .= empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
    $orderby = $orderbylevel.$orderby;

    $select_param['order'] = array(
        $orderby
    );
    
    if (! empty($this_model['filterable_fields'])) {
        // 可过滤的自定义字段处理
        foreach ($URL_PARAMS as $k => $v) {
            
            if (empty($this_model['filterable_fields'][$v]))
                continue;
            
            $field = $this_model['filterable_fields'][$v];
            
            switch ($field['type']) {
                
                case 'tinyint':
                case 'smallint':
                case 'mediumint':
                case 'int':
                case 'bigint':
                    
                    switch ($field['widget']) {
                        
                        case 'input':
                        case 'select':
                        case 'radio':
                            $value = isset($URL_PARAMS[$k + 1]) ? intval($URL_PARAMS[$k + 1]) : null;
                            $select_param['in']['i.' . $v] = array(
                                'i.' . $v,
                                $value
                            );
                            $selected_fields[$v] = $PAGE_CACHE_PARAM[$k] = $value;
                            $field_filter = true;
                            break;
                    }
                    
                    break;
                
                case 'decimal':
                case 'float':
                    
                    switch ($field['widget']) {
                        
                        case 'input':
                        case 'select':
                        case 'radio':
                            $value = isset($URL_PARAMS[$k + 1]) ? floatval($URL_PARAMS[$k + 1]) : null;
                            
                            $select_param['in']['i.' . $v] = array(
                                'i.' . $v,
                                $value
                            );
                            $selected_fields[$v] = $PAGE_CACHE_PARAM[$k] = $value;
                            $field_filter = true;
                            break;
                    }
                    break;
            }
        }
        
        $keyword = isset($_GET['keyword']) ? html_entities(trim($_GET['keyword'])) : '';
        if ($keyword != '') {
            $PAGE_CACHE_PARAM['NO_CACHE'] = 1;
            $select_param['search'] = array(
                'i.title',
                $keyword
            );
            $field_filter = true;
        }
    }
} else {
    
    page_cache($PAGE_CACHE_PARAM);
    
    $category->get_cache();
    
    // 父分类
    $parent_cats = $category->get_parents($cid);
    // 子分类
    $subcategories = array();
    if (isset($category->categories[$cid]['categories'])) {
        $subcategories = $category->categories[$cid]['categories'];
        $CATEGORY = $category->get_children_ids($cid) + array(
            $cid
        );
    }
}

// print_R($page_urls);
// ----------------------------------------------------------
// 模型自定义脚本
if (! $CAT['list_all_model'])
    require $this_model['path'] . 'list.php';
    // ----------------------------------------------------------

if ($CAT['type'] == 2) {
    
    if (!empty($this_model['filterable_fields'])) {

        // ---------------------------------------------------------------{

        $CAT['filter'] = '{filter}';
        $CAT['htmlize'] = 0;
        $this_module->CONFIG['dynamic_list_url_rule'] = str_replace('{$id}', '{$id}{$filter}', $this_module->CONFIG['dynamic_list_url_rule']);
        $_page_url = p8_url($this_module, $CAT, 'list', false);
        
        $filter = '';
        foreach ($selected_fields as $field => $value) {
            $filter .= '-' . $field . '-' . $value;
        }
        $page_url = str_replace('{filter}', $filter, $_page_url);
        $_page_url = preg_replace('/#[^#]+#/', '', $_page_url);
        
        $form_url = preg_replace('/#[^#]+#/', '', $page_url);
        if ($keyword != '') {
            $_page_url .= '?keyword=' . urlencode($keyword);
        }
        // print_r($selected_fields);
        
        // 各字段的过滤链接
        foreach ($this_model['filterable_fields'] as $field => $field_data) {
            // 取消过滤链接(全部)
            $page_urls[$field][''] = '';
            
            foreach ($selected_fields as $_field => $_value) {
                if ($_field == $field)
                    continue;
                
                $page_urls[$field][''] .= '-' . $_field . '-' . $_value;
            }
            
            $page_urls[$field][''] = str_replace('{filter}', $page_urls[$field][''], $_page_url);
            
            foreach ($field_data['data'] as $value => $key) {
                $page_urls[$field][$value] = '';
                
                foreach ($selected_fields as $_field => $_value) {
                    if ($_field == $field)
                        continue;
                    
                    $page_urls[$field][$value] .= '-' . $_field . '-' . $_value;
                }
                
                $page_urls[$field][$value] .= '-' . $field . '-' . $value;
                
                $page_urls[$field][$value] = str_replace('{filter}', $page_urls[$field][$value], $_page_url);
            }
        }
        
        // ---------------------------------------------------------------}
    }
    
    // 当前分类的内容数
    $count = $field_filter ? 0 : $CAT['item_count'];
    $pages = intval($count/$CAT['page_size'])+1;
    if($page>$pages) exit(p8_json(array()));
    $select = select();
    
    // 最后才加载数据较大的分类数据
    $category->get_cache();
    
    // 父分类
    $parent_cats = $category->get_parents($cid);
    
    // 子分类
    $subcategories = array();
    if (isset($category->categories[$cid]['categories'])) {
        $subcategories = $category->categories[$cid]['categories'];
        $CATEGORY = $category->get_children_ids($cid) + array(
            $cid
        );
    } else {
        $CATEGORY = $cid;
    }
    
    $select->in('i.cid', $CATEGORY);
    
    // print_R($select_param);
    foreach ($select_param as $func => $param) {
        // $select->$func($param);
        switch ($func) {
            
            case 'in':
                foreach ($param as $field => $_param) {
                    call_user_func_array(array(
                        &$select,
                        $func
                    ), $_param);
                }
                break;
            
            case 'range':
                foreach ($param as $field => $_param) {
                    call_user_func_array(array(
                        &$select,
                        $func
                    ), $_param);
                }
                break;
            
            default:
                call_user_func_array(array(
                    &$select,
                    $func
                ), $param);
                break;
        }
    }
    $sphinx = $this_module->CONFIG['sphinx'];
    $sphinx['index'] = $this_system->sphinx_indexes(array(
        $MODEL => 1
    ));
    
    $title_length = empty($CAT['CONFIG']['list_title_length']) ? 120 : $CAT['CONFIG']['list_title_length'];
    if ($core->ismobile)
        $title_length = empty($CAT['CONFIG']['list_title_length_mobile']) ? 20 : $CAT['CONFIG']['list_title_length_mobile'];
    $dot = empty($CAT['CONFIG']['title_dot']) ? '' : '...';

    $list = $core->list_item($select, array(
        'count' => &$count,
        'page' => &$page,
        'page_size' => $CAT['page_size'],
        'sphinx' => $sphinx
    ));
    
    foreach ($list as $k => $v) {
        $v['#category'] = &$category->categories[$v['cid']];
        $list[$k]['url'] = p8_url($this_module, $v, 'view');
        $list[$k]['frame'] = attachment_url($v['frame']);
        $list[$k]['full_title'] = $v['title'];
        $list[$k]['title'] = p8_cutstr($v['title'], $title_length, $dot);
        $tmp = explode('|', $v['sub_title']);
        $list[$k]['sub_title'] = $tmp[0];
        $list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
        $list[$k]['summary'] = html_entity_decode($v['summary']);
        $list[$k]['summary'] = preg_replace('/(amp;)+/', '', $list[$k]['summary']);
        // 分类名称
        $list[$k]['category_name'] = $v['#category']['name'];
        // 分类URL
        $list[$k]['category_url'] = $v['#category']['url'];
        //分类封面
		$list[$k]['category_frame'] = attachment_url($v['#category']['frame']);
        if (! empty($v['title_color']))
            $list[$k]['title'] = '<font color="' . $v['title_color'] . '">' . $list[$k]['title'] . '</font>';
        if (! empty($v['title_bold']))
            $list[$k]['title'] = '<b>' . $list[$k]['title'] . '</b>';
    }
}
exit(p8_json($list));

