<?php
return array (
  'name' => 'article',
  'config' => 
  array (
    'prev&next_item' => '1',
    'admin_edit_template' => '',
    'member_edit_template' => '',
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
      'display_order' => '98',
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
      'length' => '255',
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
      'display_order' => '97',
      'units' => '',
      'description' => '针对有时间范围的信息，默认不选择',
    ),
  ),
);