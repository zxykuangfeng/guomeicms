<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>执行升级文件</title>
</head>
<body>
<h2>使用说明：此文件必须放在在upgrade目录下,并执行本文件。</h2><br>
<?php
set_time_limit(0);
header('Content-type: text/html; charset=utf-8');
//按要执行的顺序，依次往下写文件名。
$execute_arr = array(
	'column_default_value.php',
	'filter_conn.php',
	'letter_ip.php',
	'install_wechat.php',
	'menu_sys.php',
	'sites_menu_custom.php',
	'sites_menu_nav.php',
	'sites_menu_quick.php',
	'sites_menu_user.php',
	'ad.php',
	'version.php',
);

echo "<br><h3>本次升级已完成，已升级到版本2023年02月06日的版本；请进入网站后果更新全站缓存；本次升级的文件及顺序如下：</h3><br>";
foreach($execute_arr as $key=>$file){
	echo ++$key.'、'.$file."<br>";
	echo '<iframe src="'.$file.'" frameborder="0" style="width: 0; height: 0;"></iframe>';
}
?>
</body>
</html>