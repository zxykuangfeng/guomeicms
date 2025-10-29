<?php
defined('PHP168_PATH') or die();
!empty($core->plugins['wechatconnect']['installed']) && !empty($core->plugins['wechatconnect']['enabled']) && $PLUGIN['wechatconnect'] = &$core->load_plugin('wechatconnect');
$__plugin['wechatconnect'] = empty($PLUGIN['wechatconnect']) ? '' : $PLUGIN['wechatconnect']->display();
?>
<?php
print <<<EOT
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="X-Csrf-Token" content="{$CSRF_TOKEN}">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
<title>{$P8LANG['login']}</title>
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/member/default/core/style.css" />
<script type="text/javascript" src="{$RESOURCE}/js/config.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jq_validator.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/lang/core/{$core->CONFIG['lang']}.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jsencrypt.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/login.js?rid=
EOT;
echo P8_TIME;
print <<<EOT
"></script>
</head>
<body>
<div class="headbar">
<div class="header">
<div class="logo fl"><img src="{$RESOURCE}/skin/member/default/core/images/logo.png"/></div>
<div class="home fr"><a href="{$core->controller}">返回首页</a></div>
</div>
</div>
<div class="contentbox">
<div class="wrapper">
<div class="loginbox">
<div class="logindiv fr">

<div class="brand">				
<a href="javascript:return false;" class="active" id="login_form" onclick="showlogin('form')">账号密码{$P8LANG['login']}</a>
EOT;
if(!empty($core->CONFIG['plugins']['wechatconnect']['enabled'])  && !empty($this_module->CONFIG['wechat_login'])){
print <<<EOT

&nbsp;<a  href="javascript:return false;" id="login_drlogin" onclick="showlogin('drlogin')">微信扫码{$P8LANG['login']}</a>
EOT;
}
if(!empty($this_module->CONFIG['sms_login'])){
print <<<EOT

&nbsp;<a  href="javascript:return false;" id="login_sms" onclick="showlogin('sms')">手机短信{$P8LANG['login']}</a>
EOT;
}
print <<<EOT

</div>

<form method="post" id="form" action="$this_url">
<div class="formint">
<input type="text" name="username" id="username" class="username" autocomplete="false" value="请输入账号" onfocus="if(this.value=='请输入账号'){this.value='';}" onblur="if(this.value==''){this.value='请输入账号';}"/>
</div>
<div class="formint">
<input type="password" name="password" id="password" autocomplete="off" class="password"/>						
</div>
EOT;
if(!empty($this_module->CONFIG['login_with_captcha'])){
print <<<EOT

<div class="formcode">
<input name="captcha" type="text" id="captcha" class="input" value="验证码" onfocus="if (value =='验证码'){value =''}" onblur="if (value ==''){value='验证码'}" /> <span id="captcham"></span>
</div>
<script type="text/javascript">
captcha($('#captcham'), $('#captcha'));
</script>
EOT;
}
print <<<EOT

<div class="formbtn">
<input type="submit" value="{$P8LANG['login']}" tabindex="3" class="submit" id="loginbtn"/>
</div>
<div class="formul">
<ul>
<li>记住密码<input type="checkbox" name="remember_me" value="1" /></li>
<li><a href="{$core->controller}/member-getpassword">忘记密码</a></li>
<li><a href="{$core->controller}/member-findpwd">重置密码</a></li>
<li><a href="{$core->controller}/member-register" class="tologin">{$P8LANG['register']}</a></li>
</ul>
</div>
<input type="hidden" name="site_name" value="{$site_name}" />
<input type="hidden" name="forward" value="
EOT;
if(isset($forward)){
print <<<EOT
$forward
EOT;
}
print <<<EOT
" />
</form>
<div id="drlogin" style="margin:5px auto; display:none">
{$__plugin['wechatconnect']}
</div>
<div id="sms" style="margin:5px auto; display:none">
EOT;
if(!empty($this_module->CONFIG['sms_login'])){
print <<<EOT

<form method="post" action="$this_url" id="smsform">
<div class="formint input-with-error">
<input type="text" name="mobile" id="mobile" class="username" autocomplete="false" value="请输入手机号" onfocus="if(this.value=='请输入手机号'){this.value='';}" onblur="if(this.value==''){this.value='请输入手机号';}"/>
</div>
<div class="formint input-with-error">
<input type="text" name="checkcode" id="checkcode" autocomplete="off" class="password" value="短信验证码" onfocus="if(this.value=='短信验证码'){this.value='';}" onblur="if(this.value==''){this.value='短信验证码';}"/>
</div>
<div class="formint_captcha">
<div class="formcode">
EOT;
if(!empty($this_module->CONFIG['login_with_captcha'])){
print <<<EOT

<input name="captcha" type="text" id="sms_captcha" class="input" value="验证码" onfocus="if (value =='验证码'){value =''}" onblur="if (value ==''){value='验证码'}" /> <span id="sms_captcham"></span>
<script type="text/javascript">
captcha($('#sms_captcham'), $('#sms_captcha'));
</script>
EOT;
}
print <<<EOT

</div>
<div class="p8_sendsms">
<button id="p8_sendsms"/>获取验证码</button>
<span id="countdown" class="countdown"></span>
<script type="text/javascript">
$(document).ready(function(){
$("#p8_sendsms").click(function(){
// 监听输入框的失去焦点事件，设置默认值  
$('#checkcode').blur(function() {  
if (this.value === '') {  
this.value = '短信验证码'; 
}  
});  

$('#checkcode').focus(function() {  
if (this.value === '短信验证码') {  
this.value = '';
}  
}); 
var phone = $('#mobile').val();
var regex = /^1[3456789]\\d{9}$/; 
if (!regex.test(phone)){  
alert('请正确输入手机号!');  
return false;
}
if(phone.length==11){									
// 禁用按钮  
$(this).prop('disabled', true);										  
// 显示倒计时（可选）  
var countdown = 60;  
var countdownElement = $('#countdown'); // 假设你有一个元素来显示倒计时  
if (!countdownElement.length) {  
countdownElement = $('<span id="countdown"></span>').appendTo($(this).parent()); // 如果没有，就创建一个  
}  
var intervalId = setInterval(function() {  
countdown--;  
countdownElement.text(countdown);  
if (countdown <= 0) {  
clearInterval(intervalId);  
// 重新启用按钮  
$('#p8_sendsms').prop('disabled', false);  
// 清除倒计时显示（可选）  
countdownElement.remove();  
}  
}, 1000); 

$.ajax({
url: '{$core->url}/index.php/core/letter-checksms',
type: 'post',
dataType: 'json',
cache: false,
data: ajax_parameters({phone: phone}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
if(json=='OK')
alert('手机短信发送成功！');
else
alert('发送失败！'+json);
}
});
}else{
alert('请正确输入手机号！');
return false;
}
})
})
</script>
</div>
</div>
<div class="formbtn">
<input type="submit" value="{$P8LANG['login']}" tabindex="3" class="submit"/>
</div>
<div class="formul">
<ul>
<li>记住密码<input type="checkbox" name="remember_me" value="1" /></li>
<li><a href="{$core->controller}/member-getpassword">忘记密码</a></li>
<li><a href="{$core->controller}/member-findpwd">重置密码</a></li>
<li><a href="{$core->controller}/member-register" class="tologin">{$P8LANG['register']}</a></li>
</ul>
</div>
<input type="hidden" name="site_name" value="{$site_name}" />
<input type="hidden" name="forward" value="
EOT;
if(isset($forward)){
print <<<EOT
$forward
EOT;
}
print <<<EOT
" />
</form>
EOT;
}else{
print <<<EOT

<div class="info_image"></div>
<div class="info_text">需开启登录功能并设置短信接口！</div>
EOT;
}
print <<<EOT

</div>
</div>
</div>
</div>
</div>
<div class="footbar">
<div class="footer">
<div class="copyright">
<ul>
<li>{$core->CONFIG['copyright']}</li>
</ul>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
var Referrer = document.referrer;
if(Referrer && Referrer.toLowerCase().indexOf('javascript') != -1){
p8_window.alert('严正警告！！！您的攻击行为已经被记录在案，我们已保留证据！');
};
$('#username').focus();	
$('#form').validate({
rules: {
username: {
required: true
},
tmppd: {
required: true
}
},
messages: {
username: {
required: '<font color=red>帐号不能为空</font>'
},
tmppd: {
required: '<font color=red>密码不能为空</font>'
}
},
errorPlacement: function(error, element) {  
error.insertBefore(element);  
},
onkeyup: false
});
// 添加自定义验证方法  
$.validator.addMethod("notDefaultValue", function(value, element) {  
return value !== "短信验证码";
}, "请填写有效的短信验证码");
$('#smsform').validate({
rules: {
mobile: {
required: true,
digits: true, // 确保只包含数字  
minlength: 11, // 最小长度11位  
maxlength: 11 // 最大长度11位
},
checkcode: {
required: true,
notDefaultValue: true
}
},
messages: {
mobile: {
required: '请正确输入手机号!',
digits: "手机号只能包含数字",  
minlength: "手机号必须是11位数字",  
maxlength: "手机号不能超过11位数字"
},
checkcode: {
required: '验证码不能为空',
minlength: "验证码最小为4位",
notDefaultValue: "请填写短信验证码"
}
},
submitHandler: function(form) {  
form.submit();  
},
errorClass: "sms-error",
errorPlacement: function(error, element) {  
error.insertBefore(element);  
},
onkeyup: false
});

$('#p8_sendsms').click(function() {  

});
});
$('#username').get(0).focus();
function showlogin(id){
$('#form').hide();
$('#drlogin').hide();
$('#sms').hide();
$('#login_sms').removeClass('active');
$('#login_drlogin').removeClass('active');
$('#login_form').removeClass('active');
$('#'+id).show();
$('#login_'+id).addClass('active');
}
</script>
</body>
</html>
EOT;
?>