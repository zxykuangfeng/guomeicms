<?php
return array (
  'name' => 'affairs',
  'config' => 
  array (
    'prev&next_item' => '1',
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
      'widget' => 'editor',
      'widget_addon_attr' => '',
      'display_order' => '95',
      'units' => '',
      'description' => '',
    ),
    'fileno' => 
    array (
      'parent' => '0',
      'name' => 'fileno',
      'alias' => '我要预约',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '1',
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
      'display_order' => '28',
      'units' => '',
      'description' => '',
    ),
    'indexno' => 
    array (
      'parent' => '0',
      'name' => 'indexno',
      'alias' => '事项编号',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '1',
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
      'display_order' => '0',
      'units' => '',
      'description' => '',
    ),
    'issued' => 
    array (
      'parent' => '0',
      'name' => 'issued',
      'alias' => '受理单位',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '1',
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
      'display_order' => '0',
      'units' => '',
      'description' => '',
    ),
    'name' => 
    array (
      'parent' => '0',
      'name' => 'name',
      'alias' => '审批事项名称',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '1',
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
      'display_order' => '0',
      'units' => '',
      'description' => '',
    ),
    'opendate' => 
    array (
      'parent' => '0',
      'name' => 'opendate',
      'alias' => '办事申请',
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
      'display_order' => '30',
      'units' => '',
      'description' => '',
    ),
    'recorder' => 
    array (
      'parent' => '0',
      'name' => 'recorder',
      'alias' => '我要咨询',
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
      'display_order' => '26',
      'units' => '',
      'description' => '',
    ),
    'sxlb' => 
    array (
      'parent' => '0',
      'name' => 'sxlb',
      'alias' => '审批方式',
      'type' => 'varchar',
      'list_table' => '1',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '255',
      'is_unsigned' => '0',
      'editable' => '1',
      'default_value' => '',
      'data' => 
      array (
        '线上审批' => '线上审批',
        '线下审批' => '线下审批',
        '线上+线下' => '线上+线下',
      ),
      'config' => 
      array (
      ),
      'widget' => 'select',
      'widget_addon_attr' => '',
      'display_order' => '0',
      'units' => '',
      'description' => '',
    ),
    'toushu' => 
    array (
      'parent' => '0',
      'name' => 'toushu',
      'alias' => '我要投诉',
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
      'display_order' => '24',
      'units' => '',
      'description' => '',
    ),
  ),
);
