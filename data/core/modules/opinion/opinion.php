<?php
return array (
  'admin_actions_map' => 
  array (
    'config' => '模块配置',
    'add' => '添加项目',
    'item' => '项目管理',
    'list' => '内容管理',
  ),
  'dynamic_list_url_rule' => '{$module_controller}-list#-page-{$page}#.html',
  'dynamic_post_url_rule' => '{$module_controller}-post-id-{$id}#-page-{$page}#.html',
  'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}#-page-{$page}#.html',
  'mobile_template' => 'mobile/school',
  'template' => '',
  'undisplay' => '0',
);