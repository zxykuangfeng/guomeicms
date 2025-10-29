<?php
return array (
  'name' => 'down',
  'config' => 
  array (
    'admin_edit_template' => '',
    'member_edit_template' => '',
    'frame_thumb_width' => '',
    'frame_thumb_height' => '',
    'content_thumb_width' => '',
    'content_thumb_height' => '',
    'hidedownurl' => '1',
    'thunderid' => '08311',
    'flashgetid' => '6370',
  ),
  '#fields' => 
  array (
    'content' => 
    array (
      'parent' => '0',
      'name' => 'content',
      'alias' => '资源介绍',
      'type' => 'mediumtext',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
      ),
      'widget' => 'editor',
      'widget_addon_attr' => '',
      'display_order' => '33',
      'units' => '',
      'description' => '',
    ),
    'copyright' => 
    array (
      'parent' => '0',
      'name' => 'copyright',
      'alias' => '授权形式',
      'type' => 'tinyint',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '3',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
        1 => '免费版',
        2 => '试用版',
        3 => '破解版',
        4 => '商业版',
      ),
      'config' => 
      array (
      ),
      'widget' => 'select',
      'widget_addon_attr' => '',
      'display_order' => '77',
      'units' => '',
      'description' => '',
    ),
    'demo' => 
    array (
      'parent' => '0',
      'name' => 'demo',
      'alias' => '演示地址',
      'type' => 'varchar',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '255',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => 'size="40"',
      'display_order' => '88',
      'units' => '',
      'description' => '',
    ),
    'operatingsystem' => 
    array (
      'parent' => '0',
      'name' => 'operatingsystem',
      'alias' => '运行环境',
      'type' => 'varchar',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '255',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
        1 => 'Windows',
        2 => 'Linux',
        3 => 'Unix',
        4 => 'DOS',
      ),
      'config' => 
      array (
        0 => '',
      ),
      'widget' => 'multi_select',
      'widget_addon_attr' => '',
      'display_order' => '99',
      'units' => '',
      'description' => '',
    ),
    'softlanguage' => 
    array (
      'parent' => '0',
      'name' => 'softlanguage',
      'alias' => '资源语言',
      'type' => 'tinyint',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '3',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
        1 => '简体中文',
        2 => '繁体中文',
        3 => '英文',
        4 => '日韩',
      ),
      'config' => 
      array (
      ),
      'widget' => 'select',
      'widget_addon_attr' => '',
      'display_order' => '66',
      'units' => '',
      'description' => '',
    ),
    'softsize' => 
    array (
      'parent' => '0',
      'name' => 'softsize',
      'alias' => '资源大小',
      'type' => 'varchar',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '10',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '55',
      'units' => 'K',
      'description' => '',
    ),
    'softurl' => 
    array (
      'parent' => '0',
      'name' => 'softurl',
      'alias' => '资源地址',
      'type' => 'mediumtext',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
      ),
      'widget' => 'uploader',
      'widget_addon_attr' => '',
      'display_order' => '44',
      'units' => '',
      'description' => '',
    ),
    'totaldown' => 
    array (
      'parent' => '0',
      'name' => 'totaldown',
      'alias' => '总下载量',
      'type' => 'mediumint',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '5',
      'is_unsigned' => '0',
      'editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '0',
      'units' => '',
      'description' => '',
    ),
  ),
);
