<?php
return array (
  'admin_actions_map' => 
  array (
    'config' => '模块配置',
    'add' => '添加专题',
    'category' => '分类管理',
    'add_category' => '添加分类',
  ),
  'dynamic_list_url_rule' => '{$module_controller}-list-category-{$id}#-page-{$page}#.html',
  'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}.shtml',
  'htmlize' => '0',
  'html_list_url_rule' => '{$system_url}/special/list_{$id}#-page-{$page}#html',
  'html_view_url_rule' => '{$system_url}/special/{$id}.html',
  'mobile_template' => 'mobile/foolish',
  'template' => 'ycsyy',
  'view_page_cache_ttl' => '0',
);