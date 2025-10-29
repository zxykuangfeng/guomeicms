<?php
return array (
  'name' => 'article',
  'config' => 
  array (
    'prev&next_item' => '1',
    'allow_custom' => '1',
    'custom_a' => '预留列表字段：custom_a',
    'custom_a_enabled' => '1',
    'custom_b' => '预留列表字段：custom_b',
    'custom_c' => '预留列表字段：custom_c',
    'custom_d' => '预留列表字段：custom_d',
    'custom_e' => '预留列表字段：custom_e',
    'custom_f' => '预留内容字段：custom_f',
    'custom_f_enabled' => '1',
    'custom_g' => '预留内容字段：custom_g',
    'custom_g_enabled' => '1',
    'custom_h' => '预留内容字段：custom_h',
    'custom_i' => '预留内容字段：custom_i',
    'custom_j' => '预留内容字段：custom_j',
    'admin_edit_template' => '',
    'member_edit_template' => '',
    'frame_thumb_width' => '',
    'frame_thumb_height' => '',
    'content_thumb_width' => '',
    'content_thumb_height' => '',
  ),
  '#fields' => 
  array (
    'content' => 
    array (
      'parent' => '0',
      'name' => 'content',
      'alias' => '内容',
      'type' => 'mediumtext',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '0',
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
      'display_order' => '99',
      'units' => '',
      'description' => '',
    ),
    'endtime' => 
    array (
      'parent' => '0',
      'name' => 'endtime',
      'alias' => '到期日期',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '50',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'full' => '1',
      ),
      'widget' => 'textdate',
      'widget_addon_attr' => 'placeholder="请选择到期时间"',
      'display_order' => '97',
      'units' => '',
      'description' => '针对有时间范围的信息，默认不选择',
    ),
    'starttime' => 
    array (
      'parent' => '0',
      'name' => 'starttime',
      'alias' => '开始日期',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '50',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'full' => '1',
      ),
      'widget' => 'textdate',
      'widget_addon_attr' => 'placeholder="请选择开始时间"',
      'display_order' => '98',
      'units' => '',
      'description' => '针对有时间范围的信息，默认不选择',
    ),
  ),
);