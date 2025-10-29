<?php
return array (
  'admin_actions_map' => 
  array (
    'list_interface' => '接口管理',
    'test' => '短信测试',
  ),
  'interfaces' => 
  array (
    3068 => 
    array (
      'alias' => '短信通',
      'apply_url' => 'http://www.php168.net/',
      'enabled' => 0,
      'config' => 
      array (
      ),
    ),
    'alisms' => 
    array (
      'alias' => '阿里云',
      'apply_url' => 'https://dysms.console.aliyun.com',
      'enabled' => 1,
      'config' => 
      array (
        'accessKeyId' => 'LTAIYAOawrBcNe93',
        'accessKeySecret' => 'aQ4LudIPpMZbmnL2T3UtBGG1ejDWXK',
        'SignName' => '国微软件',
        'TemplateCode1' => 'SMS_157450405',
        'TemplateCode2' => 'SMS_157283476',
      ),
    ),
    'ccell' => 
    array (
      'alias' => '官方短信通道2',
      'apply_url' => 'http://www.php168.net/',
      'enabled' => 0,
      'config' => 
      array (
      ),
    ),
    'panzer' => 
    array (
      'alias' => '官方短信通道3',
      'apply_url' => 'http://www.php168.net/',
      'enabled' => 0,
      'config' => 
      array (
      ),
    ),
  ),
);