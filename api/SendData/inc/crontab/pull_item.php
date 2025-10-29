<?php
defined('PHP168_PATH') or die();

/**
* 推送信箱数据
**/
//error_reporting(E_ALL);

$Letter = $core->load_module('letter');
$select = select();
$select->from($Letter->table, '*');
$select->in('status',3);
$select->in('pulled',0);
$select->order('id ASC');
$list = array();
$list = $core->list_item(
		$select,
		array(
			'page' => 1,
			'count' => 0,
			'page_size' => 5
		)
	);

foreach($list as $val){
	$id = $val['id'];
	//var_dump($id);
	$data = $Letter->getData($id,'all');
	//if(intval($data['pulled']) == 1) message('已推送成功，请不要重复推送',$this_router .'-pull_data',3);
	$cates = $Letter->get_category();

	$iid = md5($data['id'].'_letter');
	//选择类别
	$questionType = base64_encode($cates['type'][$data['type']]['name']);
	//被投诉单位
	$letterDepart = base64_encode($cates['department'][$data['department']]['name']);
	//经办人
	$dealer = $data['solve_name'];
	//服务事项编号（函号）
	$code = $data['number'];
	//事项编号（英文数字）
	$outCode = $data['code'];
	//查询码
	$fetchCode = $data['code'];
	//来信日期
	$visitDate = date('Y-m-d H:i:s',$data['create_time']);
	//转交时间
	if($data['status_change_time']) $visitDate = date('Y-m-d H:i:s',$data['status_change_time']);
	//处理状态,firstend	已办结，省已经归档
	$dealStatus = 'firstsend';
	//处理时限
	if($data['finish_time']) $limitDate = date('Y-m-d H:i:s',$data['finish_time']);
	//公开状态
	$webStatus = $data['undisplay'] ? 0 : 1;
	//可否公开
	$visual = $data['visual'] ? 1 : 0;
	//username
	$username = base64_encode($data['username']);
	//标题
	$name = base64_encode($data['title']);
	//投诉内容
	$description = base64_encode($data['data'][0]['content']);
	//reply
	$reply = base64_encode($data['data'][0]['reply']);
	//办理方式
	$dealType = 'self';
	//事项类型（渠道）
	$visitType = 'fuwu';
	//事项亮灯
	$alterLamp = 'green';
	//签收时间
	if($data['status_change_time']) $signInDate = date('Y-m-d H:i:s',$data['status_change_time']);
	//回复时间
	if($data['data'][0]['reply_time']) $replyDate = date('Y-m-d H:i:s',$data['data'][0]['reply_time']);
	//办结时间
	if($data['solve_time']) $endDate = date('Y-m-d H:i:s',$data['solve_time']);
	//回复部门
	$replyDepart = base64_encode($cates['department'][$data['data'][0]['reply_department']]['name']);
	//办结部门
	$doneDepart = base64_encode($cates['department'][$data['data'][0]['reply_department']]['name']);

	$xmlText = "<?xml version=\"1.0\" encoding=\"GBK\"?>
	<VisitContentList> 
	  <VisitContent id=\"$iid\" outCode='$outCode' questionType=\"$questionType\" fetchCode=\"$fetchCode\" visitDate=\"$visitDate\" dealStatus=\"firstend\" dutyDepartText=\"\" publishStatus=\"1\" name=\"$name\" description=\"$description\" visitType=\"arrive\" visitTypeText=\"%u8868%u626c\" mark=\"100\"> 
		<VisitorList dataName=\"%u4fe1%u8bbf%u4ef6%u4fe1%u606f\"> 
		  <Visitor id=\"$iid\" name=\"$username\" mobile=\"\" email=\"\" address=\"\" visitContentId=\"$iid\"/> 
		</VisitorList>  
		<VisitDealList dataName=\"%u529e%u7406%u4fe1%u606f%u5217%u8868\"> 
		  <VisitDeal id=\"$iid\" dealDeate=\"$endDate\" dealDepart=\"$replyDepart\" description=\"$reply\" acceptRemark=\"%u5f88%u611f%u8c22%u60a8%u7684%u56de%u7b54\" acceptDate=\"$visitDate\" visitContentId=\"$iid\"/> 
		</VisitDealList> 
	  </VisitContent>  
	</VisitContentList>";

	//输出XML
	$xmlfile = PHP168_PATH .'data/core/modules/letter/xml/pull_'.$id.'.xml';

	ob_start();
	header("Content-type: text/xml; charset=gb2312");
	echo $xmlText;
	$content = ob_get_clean();
	@mkdir(PHP168_PATH .'data/core/modules/letter/xml');
	write_file($xmlfile, $content);
	@chmod($xmlfile, 0644);

	header("Content-type: text/html; charset=utf-8");
	if(file_exists($xmlfile)){		
		$curl = curl_init();
		$postdata = array(
			"name" => 'test',
			"file" => '@'.$xmlfile
		);
		//兼容5.0-5.6版本的curl
		if(class_exists('\CURLFile')) {
			$postdata['file'] = new \CURLFile(realpath($xmlfile));
		}else{
			if (defined('CURLOPT_SAFE_UPLOAD')) {
				curl_setopt($ch, CURLOPT_SAFE_UPLOAD, FALSE);
			}
		}
		curl_setopt($curl, CURLOPT_URL,"http://218.76.27.46:8088/mess/tongbu/addVisitContent.jsp?user=xnxy&password=xnxy2276368");
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		$ret = curl_exec($curl);
		//$ret = true;
		curl_close($curl);
		if($ret)$Letter->set_pull($id,2);
	}
}
header("Content-type: text/html; charset=utf-8");

