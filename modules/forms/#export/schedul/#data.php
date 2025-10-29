<?php
return array (
  'name' => 'schedul',
  'alias' => '值班平台',
  'config' => 
  array (
    'logo' => '',
    'allow_ip' => 
    array (
      'enabled' => '0',
      'collectip' => 
      array (
      ),
      'beginip' => '',
      'endip' => '',
      'ruleoutip' => 
      array (
      ),
    ),
    'email' => 'xxx@163.com',
    'import_logs' => 
    array (
      0 => 
      array (
        'logs' => '',
        'import_record' => 
        array (
          0 => '5323',
          1 => '5328',
        ),
      ),
    ),
  ),
  'post_template' => '',
  'list_template' => '',
  'view_template' => '',
  '#fields' => 
  array (
    'date' => 
    array (
      'model' => 'schedul',
      'parent' => '0',
      'name' => 'date',
      'alias' => '值班时间',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '1',
      'filterable' => '1',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '50',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'textdate',
      'widget_addon_attr' => '',
      'display_order' => '255',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
    'leader' => 
    array (
      'model' => 'schedul',
      'parent' => '0',
      'name' => 'leader',
      'alias' => '带班领导',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '1',
      'filterable' => '1',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '50',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '240',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
    'officer' => 
    array (
      'model' => 'schedul',
      'parent' => '0',
      'name' => 'officer',
      'alias' => '值班人员',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '1',
      'filterable' => '1',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '255',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '220',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
    'place' => 
    array (
      'model' => 'schedul',
      'parent' => '0',
      'name' => 'place',
      'alias' => '值班地点',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '1',
      'filterable' => '1',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '50',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '200',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
    'remarks' => 
    array (
      'model' => 'schedul',
      'parent' => '0',
      'name' => 'remarks',
      'alias' => '备注',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '0',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '255',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'textarea',
      'widget_addon_attr' => '',
      'display_order' => '0',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
    'telephone' => 
    array (
      'model' => 'schedul',
      'parent' => '0',
      'name' => 'telephone',
      'alias' => '值班电话',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '1',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '0',
      'length' => '50',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
      ),
      'config' => 
      array (
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '180',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
  ),
);