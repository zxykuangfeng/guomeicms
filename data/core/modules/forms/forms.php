<?php
return array (
  'admin_actions_map' => 
  array (
    'config' => '模块配置',
    'list' => '内容管理',
    'model' => '模型管理',
    'import' => '导入模型',
  ),
  'close' => '0',
  'dynamic_list_url_rule' => '{$module_controller}-list-mid-{$id}#-page-{$page}#.html',
  'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}.html',
  'htmlize' => '1',
  'htmlize_list' => '1',
  'htmlize_post' => '1',
  'htmlize_view' => '1',
  'html_list_url_rule' => '{$core_url}/html/{$model_name}/list_{$id}#-page-{$page}#.html',
  'html_post_url_rule' => '{$core_url}/html/{$model_name}/post.html',
  'html_view_url_rule' => '{$core_url}/html/{$model_name}/view_{$id}.html',
  'mobile_template' => 'mobile/school',
  'status' => false,
  'template' => '',
  'view_page_cache_ttl' => '0',
);