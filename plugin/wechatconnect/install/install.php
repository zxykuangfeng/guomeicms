<?php
//初始化设置
defined('PHP168_PATH') or die();
$config = array();
$config['appid'] = '';
$config['key'] = '';
$config['display'] = '2';
$this_plugin->set_config($config);
$this_plugin->_cache();
