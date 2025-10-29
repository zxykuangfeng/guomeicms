<?php
return array (
  'name' => 'people',
  'config' => 
  array (
  ),
  '#fields' => 
  array (
    'award' => 
    array (
      'parent' => '0',
      'name' => 'award',
      'alias' => '获奖荣誉',
      'type' => 'mediumtext',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
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
      'widget' => 'editor_common',
      'widget_addon_attr' => '',
      'display_order' => '0',
      'units' => '',
      'description' => '',
    ),
    'birthday' => 
    array (
      'parent' => '0',
      'name' => 'birthday',
      'alias' => '出生日期',
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
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '7',
      'units' => '',
      'description' => '',
    ),
    'content' => 
    array (
      'parent' => '0',
      'name' => 'content',
      'alias' => '人物介绍',
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
      'widget' => 'editor_common',
      'widget_addon_attr' => '',
      'display_order' => '2',
      'units' => '',
      'description' => '',
    ),
    'department' => 
    array (
      'parent' => '0',
      'name' => 'department',
      'alias' => '部门',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '1',
      'orderby' => '1',
      'not_null' => '1',
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
      'widget_addon_attr' => '',
      'display_order' => '5',
      'units' => '',
      'description' => '',
    ),
    'education' => 
    array (
      'parent' => '0',
      'name' => 'education',
      'alias' => '学历',
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
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '6',
      'units' => '',
      'description' => '',
    ),
    'event' => 
    array (
      'parent' => '0',
      'name' => 'event',
      'alias' => '人物事迹',
      'type' => 'mediumtext',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
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
      'widget' => 'editor_common',
      'widget_addon_attr' => '',
      'display_order' => '2',
      'units' => '',
      'description' => '',
    ),
    'Hometown' => 
    array (
      'parent' => '0',
      'name' => 'Hometown',
      'alias' => '籍贯',
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
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '8',
      'units' => '',
      'description' => '',
    ),
    'motion' => 
    array (
      'parent' => '0',
      'name' => 'motion',
      'alias' => '企业提案',
      'type' => 'mediumtext',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
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
      'widget' => 'editor_common',
      'widget_addon_attr' => '',
      'display_order' => '1',
      'units' => '',
      'description' => '',
    ),
    'name' => 
    array (
      'parent' => '0',
      'name' => 'name',
      'alias' => '姓名',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '1',
      'orderby' => '1',
      'not_null' => '1',
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
      'widget_addon_attr' => '',
      'display_order' => '9',
      'units' => '',
      'description' => '',
    ),
    'office' => 
    array (
      'parent' => '0',
      'name' => 'office',
      'alias' => '职务',
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
      ),
      'config' => 
      array (
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '4',
      'units' => '',
      'description' => '',
    ),
    'photo' => 
    array (
      'parent' => '0',
      'name' => 'photo',
      'alias' => '照片',
      'type' => 'text',
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
      'widget' => 'image_uploader',
      'widget_addon_attr' => '',
      'display_order' => '3',
      'units' => '',
      'description' => '照片大小：148*220',
    ),
  ),
);
