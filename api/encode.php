<?php
// $string： 明文 或 密文  
// $operation：DECODE表示解密,其它表示加密  
// $key： 密匙  
// $expiry：密文有效期
$list['user'] = base64_decode(trim($_REQUEST['user']));
$list['tmppd'] = base64_decode(trim($_REQUEST['tmppd']));
//string = trim($_REQUEST['tmppd']);
//$user = trim($_REQUEST['user']);
$expiry = 20; 
$key = md5('php168'); 
$keya = md5(substr($key, 0, 16));  
$keyb = md5(substr($key, 16, 16)); 
$div = '';
$back = '';
foreach($list as $string){
	$keyc = substr(md5(microtime()), -4);  
	$cryptkey = $keya.md5($keya.$keyc);  
	$key_length = strlen($cryptkey);  
	$string = sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;  
	$string_length = strlen($string);  
	$result = '';  
	$box = range(0, 255);  
	$rndkey = array();  
	for($i = 0; $i <= 255; $i++) {  
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);  
	}
	for($j = $i = 0; $i < 256; $i++) {  
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;  
		$tmp = $box[$i];  
		$box[$i] = $box[$j];  
		$box[$j] = $tmp;  
	}  
	for($a = $j = $i = 0; $i < $string_length; $i++) {  
		$a = ($a + 1) % 256;  
		$j = ($j + $box[$a]) % 256;  
		$tmp = $box[$a];  
		$box[$a] = $box[$j];  
		$box[$j] = $tmp;  
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));  
	}	
	$back .= $div.$keyc.str_replace('=', '', base64_encode($result));
	$div = '-p8-';
}
echo $back; 