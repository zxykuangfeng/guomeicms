<?php
$job=isset($_POST['job']) ? $_POST['job'] : '';

if($job=='db'){
	$dbtype = isset($_POST['dbtype']) ? $_POST['dbtype'] : '';
	$host = isset($_POST['host']) ? $_POST['host'] : '';
	$port = isset($_POST['port']) ? $_POST['port'] : '';
	$user = isset($_POST['user']) ? $_POST['user'] : '';
	$pawd = isset($_POST['pawd']) ? $_POST['pawd'] : '';
	$name = isset($_POST['name']) ? $_POST['name'] : '';

    $name = preg_replace('/[^\w_]+/i','',$name);
	$charset = isset($_POST['charset']) ? $_POST['charset'] : '';
    if(!in_array(strtolower($charset),['utf8','gbk','gb2312','big5','binary','latin1','utf8mb3','utf8mb4']))$charset='utf8';
    if(phpversion() >= '7.0'){
        try{
            $dsn = $dbtype.':host='.$host;
            $port && $dsn.=";port=$port";
            if($dbtype=='kdb'){
                $dsn.=";dbname=$name";
            }

            $link = new PDO($dsn, $user, $pawd);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($dbtype=='mysql'){
                $link->exec('SET NAMES ' . $charset);
                $link->exec("CREATE DATABASE IF NOT EXISTS `$name` DEFAULT CHARSET=$charset");
            }
        }catch(\Exception $e){
           if($e->getCode()==2002)exit('nolink');
           if($e->getCode()==1045)exit('nolink');
           if($e->getCode()==42000)exit('nocreate');
           else  exit($e->getMessage());
        }
    }else{
        $link = @mysql_connect($host.':'.$port, $user, $pawd) or exit('nolink');
        $version = mysql_get_server_info($link);
        $default_charset = '';
        if($version > '4.1'){
            //检查支不支持当前字符集
            mysql_query("SET NAMES $charset") or exit('charset');
            $default_charset = "DEFAULT CHARSET=$charset";
        }
        mysql_query("CREATE DATABASE IF NOT EXISTS `$name` $default_charset", $link) or exit('nocreate');
        mysql_select_db($name, $link) or exit('nodb');
	}
	exit('true');	
}
