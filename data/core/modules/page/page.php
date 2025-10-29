<?php
return array (
  'admin_actions_map' => 
  array (
    'config' => '模块配置',
    'add' => '添加独立页',
    'list' => '管理独立页',
  ),
  'dynamic_list_url_rule' => '{$module_controller}-list.shtml',
  'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}.shtml',
  'htmlize' => '1',
  'html_view_url_rule' => '{$system_url}/page/{$id}.html',
  'mobile_template' => 'mobile/foolish',
  'template' => 'ycsyy',
);