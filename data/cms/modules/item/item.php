<?php
return array (
  'admin_actions_map' => 
  array (
    'config' => '模块配置',
    'add' => '添加内容',
    'list' => '内容列表',
    'comment' => '评论管理',
    'list_to_html' => '列表页静态',
    'view_to_html' => '内容页静态',
    'mood' => '表情管理',
    'spider' => '采集入库',
    'tag' => 'Tag(标签)管理',
    'report' => '统计报告',
  ),
  'allow_comment' => '1',
  'allow_digg' => '0',
  'allow_mood' => '0',
  'attribute_acl' => 
  array (
    1 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    2 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    3 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    4 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    5 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    6 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    7 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
    8 => 
    array (
      4 => 1,
      1 => 1,
      13 => 1,
    ),
  ),
  'authority' => '0',
  'cms_to_sites_connect' => '0',
  'comment' => 
  array (
    'enabled' => '0',
    'require_verify' => '0',
    'page_size' => '20',
    'view_page_size' => '5',
  ),
  'deny_cids' => '',
  'dynamic_homepage_list_url_rule' => '{$URL}#-page-{$page}#.shtml',
  'dynamic_list_url_rule' => '{$module_controller}-list-category-{$id}#-page-{$page}#.shtml',
  'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}#-page-{$page}#.shtml',
  'exp_type' => 
  array (
    0 => 
    array (
      'code' => 'chinapost',
      'name' => '邮政包裹',
    ),
    1 => 
    array (
      'code' => 'YTO',
      'name' => '圆通',
    ),
    2 => 
    array (
      'code' => 'SFEXPRESS',
      'name' => '顺丰',
    ),
    3 => 
    array (
      'code' => 'STO',
      'name' => '申通',
    ),
    4 => 
    array (
      'code' => 'JD',
      'name' => '京东',
    ),
    5 => 
    array (
      'code' => 'YUNDA',
      'name' => '韵达',
    ),
    6 => 
    array (
      'code' => 'ZTO',
      'name' => '中通',
    ),
    7 => 
    array (
      'code' => 'HTKY',
      'name' => '汇通',
    ),
    8 => 
    array (
      'code' => 'EMS',
      'name' => 'EMS',
    ),
    9 => 
    array (
      'code' => 'TTKDEX',
      'name' => '天天',
    ),
    10 => 
    array (
      'code' => 'GTO',
      'name' => '国通',
    ),
    11 => 
    array (
      'code' => 'DEPPON',
      'name' => '德邦',
    ),
    12 => 
    array (
      'code' => 'ZJS',
      'name' => '宅急送',
    ),
    13 => 
    array (
      'code' => 'others',
      'name' => '其它',
    ),
  ),
  'first_img_to_frame' => '1',
  'htmlize' => '1',
  'html_list_size' => '5',
  'list_navigagion' => 'nav_list02',
  'list_page_cache_ttl' => '0',
  'list_page_cacle_ttl' => '0',
  'menu_attribute' => '0',
  'menu_clone' => '0',
  'menu_cluster_push' => '0',
  'menu_delete' => '0',
  'menu_download' => '0',
  'menu_htmlize_mobile' => '0',
  'menu_htmlize_view' => '0',
  'menu_level' => '0',
  'menu_list_order' => '0',
  'menu_move' => '0',
  'menu_set_score' => '0',
  'menu_sites_push' => '0',
  'menu_verify' => '0',
  'menu_verify_first' => '0',
  'menu_verify_frame' => '0',
  'mobile_dynamic_list_url_rule' => '{$module_mobile_controller}-list-mid-{$id}#-page-{$page}#.html',
  'mobile_dynamic_view_url_rule' => '{$module_mobile_controller}-view-id-{$id}.html',
  'mobile_template' => 'mobile/school',
  'order' => 
  array (
    'enabled' => '0',
    'field_1' => '姓名',
    'field_1_enabled' => '1',
    'field_2' => '电话',
    'field_2_enabled' => '1',
    'field_3' => '数量',
    'field_3_enabled' => '1',
    'field_4' => '手机号',
    'field_5' => '电子邮件',
    'field_6' => '快递地址',
    'field_7' => '公司名称',
    'code' => 'dx_',
  ),
  'score_level' => 
  array (
    0 => 
    array (
      'code' => 0,
      'name' => '普通',
    ),
    1 => 
    array (
      'code' => 1,
      'name' => '中等',
    ),
    2 => 
    array (
      'code' => 2,
      'name' => '良好',
    ),
    3 => 
    array (
      'code' => 3,
      'name' => '优秀',
    ),
    4 => 
    array (
      'code' => 4,
      'name' => '特别优秀',
    ),
  ),
  'sites_to_cms_connect' => '0',
  'sphinx' => 
  array (
    'enabled' => '0',
    'host' => 'localhost',
    'port' => '3312',
  ),
  'sync_del_html' => '0',
  'sync_index_to_html' => '1',
  'template' => 'ycsyy',
  'verify_acl' => 
  array (
    2 => 
    array (
      'name' => '初审',
      'role' => 
      array (
        1 => '1',
      ),
    ),
    1 => 
    array (
      'name' => '终审',
      'role' => 
      array (
        1 => '1',
      ),
    ),
    0 => 
    array (
      'name' => '待审核',
      'role' => 
      array (
        1 => '1',
      ),
    ),
    88 => 
    array (
      'name' => '回收站',
      'role' => 
      array (
        1 => '1',
      ),
    ),
    -99 => 
    array (
      'name' => '退稿',
      'role' => 
      array (
        1 => '1',
      ),
    ),
  ),
  'view_page_cache_ttl' => '0',
  'view_page_cacle_ttl' => '0',
);