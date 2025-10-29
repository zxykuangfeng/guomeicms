<?php
return array (
  'name' => 'bybd6',
  'alias' => '成绩查询平台',
  'config' => 
  array (
    'summary' => '',
    'logo' => '/attachment/core/forms/2023_05/19_20/fee10721aeb59314.png',
    'modelname' => '',
    'hint' => '',
    'remarks' => '',
    'result_hint' => '',
    'copyright' => '',
    'disable_message' => '',
    'deadline' => '',
    'post_total' => 0,
    'expire' => '0',
    'print_template' => '',
    'allow_ip' => 
    array (
      'enabled' => '0',
      'collectip' => 
      array (
      ),
      'area_ip' => 
      array (
      ),
      'ruleoutip' => 
      array (
      ),
      'beginip' => '',
      'endip' => '',
    ),
    'label_postfix' => '',
    'email' => 'xxx@163.com',
    'import_logs' => 
    array (
      0 => 
      array (
        'logs' => '<strong>ycyyo</strong> 于 05-30 09:26:58 导入《新建 XLS 工作表.xlsx》，ID范围：<strong>4669 至 4670</strong>',
        'import_record' => 
        array (
          0 => '4669',
          1 => '4670',
        ),
      ),
    ),
  ),
  'post_template' => 'post_table',
  'list_template' => 'list_chaxun2_wuyanzhengma',
  'view_template' => 'view_print',
  '#fields' => 
  array (
    'beizhu' => 
    array (
      'model' => 'bybd6',
      'parent' => '0',
      'name' => 'beizhu',
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
      ),
      'widget' => 'textarea',
      'widget_addon_attr' => 'cols="70" rows="6"',
      'display_order' => '40',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '如有备注，请填写',
    ),
    'cpmc' => 
    array (
      'model' => 'bybd6',
      'parent' => '0',
      'name' => 'cpmc',
      'alias' => '姓名',
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
        'print' => 1,
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => 'style="border:1px solid #e1eaf4"',
      'display_order' => '60',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '请输入考生姓名',
    ),
    'sfzh' => 
    array (
      'model' => 'bybd6',
      'parent' => '0',
      'name' => 'sfzh',
      'alias' => '身份证号',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '0',
      'filterable' => '0',
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
        'print' => 1,
        'layout' => 'horizen',
        'visible_role' => 
        array (
          0 => '8',
          1 => '4',
          2 => '6',
          3 => '7',
          4 => '5',
          5 => '1',
          6 => '2',
          7 => '3',
          8 => '12',
          9 => '13',
        ),
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '59',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
    'tibaoren' => 
    array (
      'model' => 'bybd6',
      'parent' => '0',
      'name' => 'tibaoren',
      'alias' => '准考证号',
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
        'print' => 1,
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => 'style="border:1px solid #e1eaf4"',
      'display_order' => '55',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '请填入准考证号',
    ),
    'yuefen' => 
    array (
      'model' => 'bybd6',
      'parent' => '0',
      'name' => 'yuefen',
      'alias' => '成绩',
      'type' => 'varchar',
      'part' => '',
      'list_table' => '1',
      'filterable' => '0',
      'orderby' => '0',
      'not_null' => '1',
      'length' => '255',
      'is_unsigned' => '0',
      'editable' => '1',
      'manager_editable' => '0',
      'default_value' => '',
      'data' => 
      array (
        1 => 
        array (
          0 => '自定义1',
          1 => '',
        ),
        2 => 
        array (
          0 => '自定义2',
          1 => '',
        ),
      ),
      'config' => 
      array (
        'print' => 1,
        'layout' => 'horizen',
        'unique' => 0,
      ),
      'widget' => 'text',
      'widget_addon_attr' => '',
      'display_order' => '50',
      'units' => '',
      'jsreg' => '',
      'jsregmsg' => '',
      'color' => '',
      'description' => '',
    ),
  ),
);