<?php
defined('PHP168_PATH') or die();
//header("Content-type: text/xml");//头文件非常重要
//header("Content-type: text/html; charset=gb2312");
$id= intval($_GET['id']);
$data = $this_module->getData($id,'all');
$cates = $this_module->get_category();
//创建xml文件
$dom=new DOMDocument('1.0','GBK');

//建立<VisitContentList>元素
$VisitContentList=$dom->createElement('VisitContentList');
 
//把<VisitContentList>元素追加到文档里面
$dom->appendChild($VisitContentList);
 
//建立<VisitContent>元素并将其作为<VisitContentList>的子元素
$VisitContent=$dom->createElement('VisitContent');

$VisitContent->setAttribute('id',md5($data['id'].'_letter'));
//选择类别
$VisitContent->setAttribute('questionType',base64_encode($cates['type'][$data['type']]['name']));
//被投诉单位
$VisitContent->setAttribute('letterDepart',base64_encode($cates['department'][$data['department']]['name']));
//经办人
$VisitContent->setAttribute('dealer',$data['solve_name']);
//服务事项编号（函号）
$VisitContent->setAttribute('code',$data['number']);
//事项编号（英文数字）
$VisitContent->setAttribute('outCode',$data['code']);
//查询码
$VisitContent->setAttribute('fetchCode',$data['code']);
//来信日期
$VisitContent->setAttribute('visitDate',date('Y-m-d H:i:s',$data['create_time']));
//转交时间
if($data['status_change_time']) $VisitContent->setAttribute('visitDate',date('Y-m-d H:i:s',$data['status_change_time']));
//处理状态,firstend	已办结，省已经归档
$VisitContent->setAttribute('dealStatus','firstsend');
//处理时限
if($data['finish_time']) $VisitContent->setAttribute('limitDate',date('Y-m-d H:i:s',$data['finish_time']));
//公开状态
$VisitContent->setAttribute('webStatus',$data['undisplay'] ? 0 : 1);
//可否公开
$VisitContent->setAttribute('visual',$data['visual'] ? 1 : 0);
//标题
$VisitContent->setAttribute('name',base64_encode($data['title']));
//投诉内容
$VisitContent->setAttribute('description',base64_encode($data['data'][0]['content']));
//办理方式
$VisitContent->setAttribute('dealType','self');
//事项类型（渠道）
$VisitContent->setAttribute('visitType','fuwu');
//事项亮灯
$VisitContent->setAttribute('alterLamp','green');
//签收时间
if($data['status_change_time']) $VisitContent->setAttribute('signInDate',date('Y-m-d H:i:s',$data['status_change_time']));
//回复时间
if($data['data'][0]['reply_time']) $VisitContent->setAttribute('replyDate',date('Y-m-d H:i:s',$data['data'][0]['reply_time']));
//办结时间
if($data['solve_time']) $VisitContent->setAttribute('endDate',date('Y-m-d H:i:s',$data['solve_time']));
//回复部门
$VisitContent->setAttribute('replyDepart',base64_encode($cates['department'][$data['data'][0]['reply_department']]['name']));
//办结部门
$VisitContent->setAttribute('doneDepart',base64_encode($cates['department'][$data['data'][0]['reply_department']]['name']));


//把<VisitContentList>元素追加到文档里面
$VisitContentList->appendChild($VisitContent);

$VisitorList=$dom->createElement('VisitorList');
$VisitContent->appendChild($VisitorList);
$Visitor=$dom->createElement('Visitor');
$Visitor->setAttribute('id',md5($data['uid'].'_letter'));
$Visitor->setAttribute('name',base64_encode($data['username']));
$Visitor->setAttribute('age',$data['age']);
$Visitor->setAttribute('mobile',$data['phone']);
$Visitor->setAttribute('prename',"visit");
$Visitor->setAttribute('status',1);
$Visitor->setAttribute('orderNum',0);
$Visitor->setAttribute('updateCode',0);
$Visitor->setAttribute('address',base64_encode("湖南省/株洲市"));
$VisitorList->appendChild($Visitor);

$AttachList=$dom->createElement('AttachList');
$VisitContent->appendChild($AttachList);
//在一字符串变量中建立XML结构
$xmlText=$dom->saveXML();
//echo PHP168_PATH;
//输出XML字符串
$xmlfile = PHP168_PATH .'data/core/modules/letter/xml/pull_'.$id.'.xml';
ob_start();
header("Content-type: text/xml; charset=gb2312");
//header("Content-type: text/html; charset=gb2312");
echo $xmlText;

$content = ob_get_clean();
@mkdir(PHP168_PATH .'data/core/modules/letter/xml');
write_file($xmlfile, $content);
@chmod($xmlfile, 0644);
header("Content-type: text/html; charset=utf-8");
if(file_exists($xmlfile)){
	$postdata = array(
		'file' => $xmlfile
	);	
	//初始一个curl会话
	$curl = curl_init();
	//设置url
	curl_setopt($curl, CURLOPT_URL,"http://218.76.27.46:8088/mess/tongbu/addVisitContent.jsp?user=xnxy&password=xnxy2276368");
	//设置发送方式：post
	curl_setopt($curl, CURLOPT_POST, true);
	//设置发送数据
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
	//抓取URL并把它传递给浏览器
	//$ret = curl_exec($curl);
	//关闭cURL资源，并且释放系统资源
	curl_close($curl);
	if($ret) {
		message('推送成功');
	}else{
		message('error，推送失败');
	}
}else{
	message('error，XML文件没生成成功，请检查目录权限');
}
?>
