<?php
//移动版定时静态首页
// */30 * * * * /alidata/service/php /home/wwwroot/inc/crontab/cms_index_to_html_mobile.crontab.php
require_once dirname(dirname(dirname(__FILE__))).'/inc/init.php';
require dirname(__FILE__).'/cms_index_to_html_mobile.php';