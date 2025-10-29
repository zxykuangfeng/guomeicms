<?php
//Code By Safe3 
function customError($errno, $errstr, $errfile, $errline)
{ 
 echo "<b>Error number:</b> [$errno],error on line $errline in $errfile<br />";
 die();
}
set_error_handler("customError",E_ERROR);
$getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|DATABASE()|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|DATABASE()|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|DATABASE()|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){  

if(is_array($StrFiltValue))
{
    $StrFiltValue=implode($StrFiltValue);
}  
if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){
		if(!empty(intval($core->CONFIG['admin_io_day']))) slog("<br><br>操作IP: ".$_SERVER["REMOTE_ADDR"]."<br>操作时间: ".strftime("%Y-%m-%d %H:%M:%S")."<br>操作页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."<br>提交参数: ".$StrFiltKey."<br>提交数据: ".$StrFiltValue);
        //print "websec notice:Illegal operation!";
        message("严正警告！！！您的攻击行为已经被记录在案，我们已保留证据！");
		exit();
}      
}  
//$ArrPGC=array_merge($_GET,$_POST,$_COOKIE);
foreach($_GET as $key=>$value){ 
	StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){ 
	StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){ 
	StopAttack($key,$value,$cookiefilter);
}
function slog($logs)
{
    global $core;
    $toppath = PHP168_PATH."data/log/".date("Y-m-d")."_logs.log";
    md(PHP168_PATH."data/log/", true);
    write_file($toppath, $logs,'a');
    $day = $core->CONFIG['admin_io_day'] ? (intval($core->CONFIG['admin_io_day'])>=7 ? intval($core->CONFIG['admin_io_day']) : 7) : 14;
    $topdir = PHP168_PATH."data/log/".date('Y-m-d',strtotime( '-'.$day.' days', time()))."_log.htm";
    rm($topdir);
}
?>