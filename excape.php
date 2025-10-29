<?php

$__FILE__ = __FILE__;

require_once dirname($__FILE__).'/inc/init.php';

$str = '自动静态';

echo $core->DB_master->escape_string($str);

echo "<br/>\n";



$link = mysql_connect('localhost','root','govgwsjk123)(', true);
//$link = mysql_connect('localhost','root','root', true);
 var_dump($link);
 //$serverset = "character_set_connection='utf8',character_set_results='utf8',character_set_client=binary,sql_mode=''";\
 
// mysql_query("SET $serverset", $link);
 mysql_query("SET names utf8", $link);
 
 mysql_select_db('sharp0501',$link);
 
 $s = '重新测试自动静态';
 $s = mysql_real_escape_string($s, $link);
 
 echo $s;
 