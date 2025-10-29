<?php
defined('PHP168_PATH') or die();
error_reporting(0);
$core->CONFIG['debug'] = 0;
if(REQUEST_METHOD == 'GET'){
	$systems = $core->list_systems();
	if(!P8_AJAX_REQUEST){
		
		include template($this_system, 'syscheck/'.$ACTION, 'admin');
		exit;
	}	
	//每增加一个需要修改字段文件，写一条数据
	/*
	array(
		'file'=>'升级执行文件名，不带.php',
		'system'=>'系统名',
		'fields'=>'关联典型字段名',
		'timestamp'=>'升级修改时间',
		'table'=>'关系数据表，不带前缀',
		'summary'=>'必要性升级说明',
		'change'=>'改变字段长度时，新字段Type的关键信息'
	)
	*/
	$check_data = array(
		array('file'=>'ad46','system'=>'46','fields'=>'manager','timestamp'=>'2019-09-11','table'=>'46_','summary'=>'广告模块增加管理员设置'),
		array('file'=>'admin_log','system'=>'core','fields'=>'system','timestamp'=>'2021-08-24','table'=>'admin_log','summary'=>'强化后台操作日志'),
		array('file'=>'alisms','system'=>'sms','fields'=>'','timestamp'=>'2020-05-10','table'=>'sms_data','summary'=>'阿里短信'),
		array('file'=>'authority','system'=>'sites','fields'=>'authority','timestamp'=>'2020-12-20','table'=>'sites_item','summary'=>'分站浏览权限'),
		array('file'=>'authority','system'=>'cms','fields'=>'authority','timestamp'=>'2018-08-19','table'=>'cms_item','summary'=>'分角色浏览信息权限字段增加文件'),
		array('file'=>'category_password','system'=>'cms','fields'=>'need_password','timestamp'=>'2018-03-18','table'=>'cms_category','summary'=>'栏目需要密码访问'),
		array('file'=>'clone_log','system'=>'cms','fields'=>'','timestamp'=>'2022-04-05','table'=>'cms_item_clone','summary'=>'签发日志'),
		array('file'=>'cms_category','system'=>'cms','fields'=>'url','timestamp'=>'2021-11-04','table'=>'cms_category','summary'=>'主站栏目简介字段扩大到65535字符长度','change'=>'1000'),
		array('file'=>'cms_custom','system'=>'cms','fields'=>'custom_a','timestamp'=>'2019-12-12','table'=>'cms_item_article_','summary'=>'新增预留字段字段'),
		array('file'=>'cms_statistic','system'=>'cms','fields'=>'','timestamp'=>'2020-12-29','table'=>'cms_statistic_sites_content','summary'=>'统计失效的数据表重命名的修复'),
		array('file'=>'column_default_value','system'=>'core','fields'=>'','timestamp'=>'2022-02-13','table'=>'','summary'=>'表字段默认值'),
		array('file'=>'comment','system'=>'cms','fields'=>'verifier','timestamp'=>'2021-04-26','table'=>'cms_item_comment','summary'=>'评论支持审核等操作'),
		array('file'=>'digg','system'=>'cms','fields'=>'','timestamp'=>'2021-05-06','table'=>'cms_item_digg','summary'=>'数据表丢失pcms_item_digg'),
		array('file'=>'filter_link','system'=>'core','fields'=>'','timestamp'=>'2021-04-06','table'=>'filter_link','summary'=>'创建外链数据表'),
		array('file'=>'filter_word','system'=>'core','fields'=>'filter_word','timestamp'=>'2020-10-26','table'=>'filter_word','summary'=>'过滤关键字，支持长正则表达式'),
		array('file'=>'forms','system'=>'forms','fields'=>'post_template_mobile','timestamp'=>'2019-06-17','table'=>'forms_model','summary'=>'表单，增加移动功能'),
		array('file'=>'formsxmtj','system'=>'forms','fields'=>'','timestamp'=>'2019-06-22','table'=>'forms_item_xmtj','summary'=>'表单内容回复信息导出功能'),
		array('file'=>'forms_email','system'=>'member','fields'=>'is_email_manager','timestamp'=>'2020-09-27','table'=>'member','summary'=>'表单前台增加选择人'),
		array('file'=>'forms_status','system'=>'forms','fields'=>'p8_status','timestamp'=>'2022-01-26','table'=>'forms_item','summary'=>'表单，增加字段'),
		array('file'=>'label','system'=>'label','fields'=>'site','timestamp'=>'2020-07-30','table'=>'label','summary'=>'标签功能'),
		array('file'=>'label_time','system'=>'label','fields'=>'last_setter','timestamp'=>'2021-02-02','table'=>'label','summary'=>'标签模块增加更新时间和用户设置'),
		array('file'=>'letter','system'=>'letter','fields'=>'vefify_content','timestamp'=>'2018-03-29','table'=>'letter_data','summary'=>'信箱增加审核人和审核意见'),
		array('file'=>'letter696','system'=>'letter','fields'=>'recommend','timestamp'=>'2018-07-12','table'=>'letter_item','summary'=>'信箱增加推荐设置'),
		array('file'=>'letter_custom','system'=>'letter','fields'=>'custom_a','timestamp'=>'2021-11-21','table'=>'letter_item','summary'=>'信件增加预留字段'),
		array('file'=>'letter_system','system'=>'letter','fields'=>'vefify','timestamp'=>'2018-05-24','table'=>'letter_item','summary'=>'信件和系统权重字段'),
		array('file'=>'letter_system','system'=>'cms','fields'=>'level','timestamp'=>'2018-05-24','table'=>'cms_item','summary'=>'信件和系统权重字段'),
		array('file'=>'letter_system','system'=>'sites','fields'=>'level','timestamp'=>'2018-05-24','table'=>'sites_item','summary'=>'信件和系统权重字段'),
		array('file'=>'level','system'=>'cms','fields'=>'level','timestamp'=>'2019-09-08','table'=>'cms_item_unverified','summary'=>'主站权重字段'),
		array('file'=>'level_time','system'=>'cms','fields'=>'level_time','timestamp'=>'2020-09-07','table'=>'cms_item','summary'=>'权重字段设置有效时间'),
		array('file'=>'level_time','system'=>'sites','fields'=>'level_time','timestamp'=>'2020-09-07','table'=>'sites_item_unverified','summary'=>'权重字段设置有效时间'),
		array('file'=>'matrix','system'=>'sites','fields'=>'','timestamp'=>'2021-01-04','table'=>'sites_item_matrix','summary'=>'主站与分站的数据对接'),
		array('file'=>'member_dept','system'=>'member','fields'=>'dept','timestamp'=>'2021-10-19','table'=>'member','summary'=>'会员增加部门的设置'),
		array('file'=>'menu_icon','system'=>'core','fields'=>'menu_icon','timestamp'=>'2020-05-31','table'=>'admin_menu','summary'=>'增加后台菜单小图标awesome字体库'),
		array('file'=>'model_list','system'=>'cms','fields'=>'list_order','timestamp'=>'2019-07-01','table'=>'cms_model','summary'=>'模型排序'),
		array('file'=>'navigation_menu','system'=>'core','fields'=>'summary','timestamp'=>'2020-02-09','table'=>'navigation_menu','summary'=>'前台导航菜单上传图片及简介'),
		array('file'=>'navigation_menu','system'=>'sites','fields'=>'dynamic_url','timestamp'=>'2020-02-09','table'=>'sites_menu','summary'=>'前台导航菜单上传图片及简介'),
		array('file'=>'password_to_sha512','system'=>'member','fields'=>'password','timestamp'=>'2022-05-09','table'=>'member','summary'=>'把密码加密改成sha512,字段长度增加'),
		array('file'=>'push_message','system'=>'sites','fields'=>'push_username','timestamp'=>'2020-07-02','table'=>'sites_stop_data','summary'=>'审核推送的数据时，给推送者发站内信'),
		array('file'=>'recycle','system'=>'cms','fields'=>'','timestamp'=>'2018-12-19','table'=>'cms_category_recycle','summary'=>'主站增加栏目回收站'),
		array('file'=>'recycle','system'=>'sites','fields'=>'','timestamp'=>'2018-12-24','table'=>'sites_category_recycle','summary'=>'分站增加栏目回收站'),
		array('file'=>'schedul','system'=>'schedul','fields'=>'date_time','timestamp'=>'2020-04-12','table'=>'plugin_schedul_','summary'=>'插件排班'),
		array('file'=>'score','system'=>'core','fields'=>'credit_3','timestamp'=>'2020-11-08','table'=>'credit_member','summary'=>'内容评分'),
		array('file'=>'score','system'=>'cms','fields'=>'score','timestamp'=>'2020-11-08','table'=>'cms_item','summary'=>'内容评分'),
		array('file'=>'score','system'=>'sites','fields'=>'score','timestamp'=>'2020-11-08','table'=>'sites_item','summary'=>'内容评分'),
		array('file'=>'sites3','system'=>'sites','fields'=>'parent','timestamp'=>'2019-01-22','table'=>'sites_site','summary'=>'三级子站功能'),
		array('file'=>'sitesviewip','system'=>'sites','fields'=>'config','timestamp'=>'2018-11-21','table'=>'sites_item_article_','summary'=>'内容IP地址访问，增加字段'),
		array('file'=>'sites_category_password','system'=>'sites','fields'=>'need_password','timestamp'=>'2022-04-11','table'=>'sites_category','summary'=>'分站增加栏目需要密码访问设置'),
		array('file'=>'sites_category_password','system'=>'sites','fields'=>'need_password','timestamp'=>'2022-04-11','table'=>'sites_category_recycle','summary'=>'分站增加栏目需要密码访问设置'),
		array('file'=>'sites_recycle','system'=>'sites','fields'=>'','timestamp'=>'2019-07-15','table'=>'sites_site_recycle','summary'=>'站群增加恢复分站功能'),
		array('file'=>'sites_statistic','system'=>'sites','fields'=>'new_id','timestamp'=>'2017-06-18','table'=>'sites_stop_data','summary'=>'分站统计功能'),
		array('file'=>'sites_stop','system'=>'sites','fields'=>'from','timestamp'=>'2021-03-09','table'=>'sites_stop_data','summary'=>'审核推送的数据时，给推送者发站内信'),
		array('file'=>'sites_stop','system'=>'cms','fields'=>'push_item_id','timestamp'=>'2021-03-09','table'=>'cms_item_unverified','summary'=>'审核推送的数据时，给推送者发站内信'),
		array('file'=>'sites_stop','system'=>'sites','fields'=>'push_item_id','timestamp'=>'2021-03-09','table'=>'sites_item_unverified','summary'=>'审核推送的数据时，给推送者发站内信'),
		array('file'=>'source','system'=>'cms','fields'=>'source','timestamp'=>'2018-06-19','table'=>'cms_item','summary'=>'标签支持调用来源source字段'),
		array('file'=>'source2','system'=>'cms','fields'=>'source','timestamp'=>'2019-12-17','table'=>'cms_item_unverified','summary'=>'来源功能进行字段'),
		array('file'=>'source2','system'=>'sites','fields'=>'source','timestamp'=>'2019-12-17','table'=>'sites_item_unverified','summary'=>'来源功能进行字段'),		
		array('file'=>'survey','system'=>'survey','fields'=>'uid','timestamp'=>'2020-05-11','table'=>'survey_item','summary'=>'在线调查，非超管只能看到自己的项目'),
		array('file'=>'verifier671','system'=>'cms','fields'=>'verifier','timestamp'=>'2018-07-03','table'=>'cms_item_unverified','summary'=>'没过审数据保留审核人信息'),
		array('file'=>'verify_frame','system'=>'cms','fields'=>'verify_frame','timestamp'=>'2019-12-08','table'=>'cms_item','summary'=>'新增站点审核图片功能进行字段'),
		array('file'=>'verify_frame','system'=>'sites','fields'=>'verify_frame','timestamp'=>'2019-12-08','table'=>'sites_item','summary'=>'新增站点审核图片功能进行字段'),
		array('file'=>'verify_frame','system'=>'cms','fields'=>'verify_frame','timestamp'=>'2019-12-08','table'=>'cms_item_unverified','summary'=>'新增站点审核图片功能进行字段'),
		array('file'=>'verify_frame','system'=>'sites','fields'=>'verify_frame','timestamp'=>'2019-12-08','table'=>'sites_item_unverified','summary'=>'新增站点审核图片功能进行字段'),
		array('file'=>'verify_frame','system'=>'cms','fields'=>'verify_frame','timestamp'=>'2019-12-08','table'=>'cms_item_article_','summary'=>'新增站点审核图片功能进行字段'),
		array('file'=>'verify_frame','system'=>'sites','fields'=>'verify_frame','timestamp'=>'2019-12-08','table'=>'sites_item_article_','summary'=>'新增站点审核图片功能进行字段'),	
		array('file'=>'viewip','system'=>'sites','fields'=>'config','timestamp'=>'2018-10-14','table'=>'sites_item_article_','summary'=>'内容带IP控制功能'),
		array('file'=>'cms_verifier','system'=>'cms','fields'=>'verifier','timestamp'=>'2022-05-25','table'=>'cms_item','summary'=>'审核人','change'=>'50'),
		array('file'=>'word_censor','system'=>'core','fields'=>'','timestamp'=>'2021-10-24','table'=>'word_censor','summary'=>'百度智能云扫描'),
		array('file'=>'word_censor','system'=>'core','fields'=>'','timestamp'=>'2022-08-12','table'=>'word_censor_filter','summary'=>'百度智能云扫描'),
		array('file'=>'cms_statistic_site','system'=>'sites','fields'=>'post_im','timestamp'=>'2022-06-20','table'=>'cms_statistic_sites_content','summary'=>'分站内容统计重点栏目的升级'),	
		array('file'=>'vote_browser','system'=>'core','fields'=>'enabled_24','timestamp'=>'2022-07-07','table'=>'vote_','summary'=>'投票增加24小时内重复投票的设置'),
		array('file'=>'admin_change_pasd','system'=>'core','fields'=>'last_change_password','timestamp'=>'2022-08-07','table'=>'member','summary'=>'管理员账号需要强制在多少时间段内重新修改密码，不修改密码，直接跳转到修改密码界面'),
		array('file'=>'role_url','system'=>'core','fields'=>'url','timestamp'=>'2022-08-21','table'=>'role','summary'=>'针对角色增加链接转向及字段优化升级'),
		array('file'=>'role_url','system'=>'core','fields'=>'is_unique','timestamp'=>'2022-08-21','table'=>'role_group_field','summary'=>'针对角色增加链接转向及字段优化升级'),
		array('file'=>'model_time','system'=>'cms','fields'=>'starttime','timestamp'=>'2022-09-13','table'=>'cms_item_article_','summary'=>'针对通用的模型，增加时间字段'),
		array('file'=>'model_time','system'=>'sites','fields'=>'starttime','timestamp'=>'2022-09-13','table'=>'sites_item_article_','summary'=>'针对通用的模型，增加时间字段'),
		array('file'=>'role_group','system'=>'core','fields'=>'editable','timestamp'=>'2022-10-10','table'=>'role_group_field','summary'=>'对会员组自定义字段，增加是否允许编辑配置项'),
		array('file'=>'word_scan','system'=>'core','fields'=>'','timestamp'=>'2022-10-10','table'=>'word_scan_filter','summary'=>'增加系统内容体检扫描'),
		array('file'=>'word_scan','system'=>'core','fields'=>'','timestamp'=>'2022-10-10','table'=>'word_scan','summary'=>'增加系统内容体检扫描'),
		array('file'=>'attachment_pdf','system'=>'cms','fields'=>'attachment_pdf','timestamp'=>'2022-10-15','table'=>'cms_item','summary'=>'PDF附件功能进行升级字段','change'=>'255'),
		array('file'=>'attachment_pdf','system'=>'sites','fields'=>'attachment_pdf','timestamp'=>'2022-10-15','table'=>'sites_item','summary'=>'PDF附件功能进行升级字段','change'=>'255'),
		array('file'=>'attachment_pdf','system'=>'cms','fields'=>'attachment_pdf','timestamp'=>'2022-10-15','table'=>'cms_item_unverified','summary'=>'PDF附件功能进行升级字段','change'=>'255'),
		array('file'=>'attachment_pdf','system'=>'sites','fields'=>'attachment_pdf','timestamp'=>'2022-10-15','table'=>'sites_item_unverified','summary'=>'PDF附件功能进行升级字段','change'=>'255'),
		array('file'=>'attachment_pdf','system'=>'cms','fields'=>'attachment_pdf','timestamp'=>'2022-10-15','table'=>'cms_item_article_','summary'=>'PDF附件功能进行升级字段','change'=>'255'),
		array('file'=>'attachment_pdf','system'=>'sites','fields'=>'attachment_pdf','timestamp'=>'2022-10-15','table'=>'sites_item_article_','summary'=>'PDF附件功能进行升级字段','change'=>'255'),
		array('file'=>'role_center','system'=>'core','fields'=>'role_template','timestamp'=>'2022-10-18','table'=>'role','summary'=>'角色增加会员中心指定模板设置'),
		array('file'=>'member_dept2','system'=>'core','fields'=>'','timestamp'=>'2022-10-18','table'=>'member_dept','summary'=>'会员增加组织架构及统计'),
		array('file'=>'model_part','system'=>'cms','fields'=>'part','timestamp'=>'2022-10-24','table'=>'cms_model_field','summary'=>'增加字段复杂布局设置升级'),
		array('file'=>'letter_parent','system'=>'core','fields'=>'parent','timestamp'=>'2022-10-31','table'=>'letter_cat','summary'=>'信箱二级部门'),
		array('file'=>'cms_author_x','system'=>'cms','fields'=>'author_x','timestamp'=>'2022-11-17','table'=>'cms_item','summary'=>'多作者发稿件时的统计'),
		array('file'=>'letter_ip','system'=>'core','fields'=>'p8_ip','timestamp'=>'2022-11-27','table'=>'letter_item','summary'=>'信箱增加IP地址字段'),
		array('file'=>'filter_conn','system'=>'core','fields'=>'conn','timestamp'=>'2022-11-27','table'=>'filter_link','summary'=>'外链扫描死链接的检测'),
		array('file'=>'member_pwd','system'=>'core','fields'=>'find_pwd','timestamp'=>'2022-12-13','table'=>'member','summary'=>'会员通过密保找回密码'),
		array('file'=>'filter_link2','system'=>'core','fields'=>'cid','timestamp'=>'2023-01-04','table'=>'filter_link','summary'=>'外链扫描栏目ID'),
		array('file'=>'ad_source','system'=>'core','fields'=>'source','timestamp'=>'2023-01-05','table'=>'46_','summary'=>'广告模块增加位置备注'),
		array('file'=>'menu_sys','system'=>'core','fields'=>'menu_sys','timestamp'=>'2023-01-10','table'=>'admin_menu','summary'=>'增加后台菜单归属字段'),
		array('file'=>'sites_menu_custom','system'=>'sites','fields'=>'','timestamp'=>'2023-02-01','table'=>'sites_menu_custom','summary'=>'分站自定义管理菜单'),
		array('file'=>'sites_menu_quick','system'=>'sites','fields'=>'','timestamp'=>'2023-02-03','table'=>'sites_menu_quick','summary'=>'分站栏目快捷发布菜单'),
		array('file'=>'sites_menu_nav','system'=>'sites','fields'=>'','timestamp'=>'2023-02-04','table'=>'sites_menu_nav','summary'=>'分站专属个性化管理菜单'),
		array('file'=>'sites_menu_user','system'=>'sites','fields'=>'','timestamp'=>'2023-02-04','table'=>'sites_menu_user','summary'=>'用户专属个性化管理菜单'),
		array('file'=>'survey_login','system'=>'core','fields'=>'login','timestamp'=>'2023-03-02','table'=>'survey_item','summary'=>'在线调查增加是否登录项'),
		array('file'=>'cms_statistic_site_push','system'=>'cms','fields'=>'score','timestamp'=>'2023-03-05','table'=>'cms_statistic_sites_push','summary'=>'分站推送数据统计的升级'),
		array('file'=>'cms_statistic_views','system'=>'sites','fields'=>'','timestamp'=>'2023-03-05','table'=>'cms_statistic_sites_views','summary'=>'浏览量统计的升级'),
		array('file'=>'ask_category','system'=>'ask','fields'=>'category_banner','timestamp'=>'2023-03-08','table'=>'ask_category_','summary'=>'问答系统栏目增加封面图片'),	
		array('file'=>'title','system'=>'cms','fields'=>'title','timestamp'=>'2023-03-15','table'=>'cms_item_article_','summary'=>'标题字段升级成500长度','change'=>'500'),	
		array('file'=>'sites_verifier','system'=>'sites','fields'=>'verifier','timestamp'=>'2022-05-25','table'=>'sites_item_article_','summary'=>'审核人字段升级成50长度','change'=>'50'),			
		array('file'=>'verifier671','system'=>'cms','fields'=>'verifier','timestamp'=>'2023-03-19','table'=>'cms_item_unverified','summary'=>'可能存在的字段缺失'),
		array('file'=>'verifier671','system'=>'sites','fields'=>'verifier','timestamp'=>'2023-03-19','table'=>'sites_item_unverified','summary'=>'可能存在的字段缺失'),
		array('file'=>'filter_word_type','system'=>'core','fields'=>'type','timestamp'=>'2023-07-18','table'=>'filter_word','summary'=>'敏感词的正确词语提示'),
		array('file'=>'word_scan_type','system'=>'core','fields'=>'type','timestamp'=>'2023-07-18','table'=>'word_scan_filter','summary'=>'内容扫描敏感词的正确词语提示'),
		array('file'=>'cms_statistic_site','system'=>'core','fields'=>'title','timestamp'=>'2023-09-07','table'=>'vote','summary'=>'投票模块标题长度升级','255'),
        array('file'=>'survey_title','system'=>'core','fields'=>'title','timestamp'=>'2023-09-07','table'=>'survey_item','summary'=>'survey字段升级长度','255'),
        array('file'=>'vote_name','system'=>'core','fields'=>'views_im','timestamp'=>'2023-08-27','table'=>'cms_statistic_sites_content','summary'=>'分站内容统计重点栏目的升级'),
		array('file'=>'wechat','system'=>'cms','fields'=>'push_at','timestamp'=>'2024-01-21','table'=>'cms_wechat_pushlogs','summary'=>'微信模块兼容','change'=>'512'),
		array('file'=>'verify_log','system'=>'core','fields'=>'','timestamp'=>'2024-01-29','table'=>'p8_item_verify_log','summary'=>'普通审核记录'),
		array('file'=>'forms_display','system'=>'forms','fields'=>'display','timestamp'=>'2024-02-05','table'=>'forms_item','summary'=>'表单，增加字段'),
		array('file'=>'survey_view','system'=>'core','fields'=>'view_result','timestamp'=>'2024-03-12','table'=>'survey_item','summary'=>'在线调查是否允许游客查看投票'),
		array('file'=>'survey_post','system'=>'core','fields'=>'cookie','timestamp'=>'2024-03-12','table'=>'survey_item','summary'=>'在线调查是否解决防作弊投票'),
		array('file'=>'attachment_type','system'=>'core','fields'=>'type','timestamp'=>'2024-04-25','table'=>'cms_attachment','summary'=>'附件类型字段升级','change'=>'255'),
		array('file'=>'message_user','system'=>'core','fields'=>'is_message_user','timestamp'=>'2024-07-23','table'=>'member','summary'=>'发短消息时，能直接选择用户'),
		array('file'=>'cms_author_x2','system'=>'cms','fields'=>'author','timestamp'=>'2024-07-30','table'=>'cms_item','summary'=>'主站内容统计多作者的升级','change'=>'50'),
		array('file'=>'crontab','system'=>'core','fields'=>'time','timestamp'=>'2022-09-13','table'=>'crontab_','summary'=>'计划任务需要设置一个某天具体时间执行'),
		array('file'=>'message_type','system'=>'core','fields'=>'type','timestamp'=>'2024-05-06','table'=>'message','summary'=>'信箱增加信息类型的升级'),
		array('file'=>'uploader','system'=>'core','fields'=>'site','timestamp'=>'2024-07-31','table'=>'sites_attachment','summary'=>'上传附件增加站点标识信息'),
		array('file'=>'uploader_type','system'=>'core','fields'=>'type','timestamp'=>'2024-08-01','table'=>'cms_attachment','summary'=>'上传附件类型兼容docx','change'=>'100'),
	);
	
	$system = $_GET['system'] && in_array($_GET['system'],array('cms','sites','ask')) ? $_GET['system'] : '';
	$modules_list = $core->list_modules(true);
	$modules_list['core']['alias'] = '系统核心';
	$timeKey = $system_model = array();	
	foreach($systems as $alias => $sys){
		if(!in_array($alias,array('cms','sites'))) continue;
		$modules_list[$alias]['alias'] = $sys['alias'];
		$select = select();
		$select->from($core->CONFIG['table_prefix'].$alias.'_model', 'name');	
		$select->in('enabled','1');
		$system_model[$alias] = $core->list_item($select,array('page_size' => 0,'ms' => 'master'));		
	}
	//检测verifier是否异常
	$name = $core->CONFIG['table_prefix'].'cms_item';
    $verifier_ret = $DB_master->getTableColumn($name, 'verifier');

	if(empty($verifier_ret) || stripos($verifier_ret['Type'],'varchar')===false){
		$check_data[] = array('file'=>'cms_verifier','system'=>'cms','fields'=>'verifier','timestamp'=>'2017-07-18','table'=>'cms_item','summary'=>'审核人必须为字符串类型','upgrade'=>'N');
	}else{
		$check_data[] = array('file'=>'cms_verifier','system'=>'cms','fields'=>'verifier','timestamp'=>'2017-07-18','table'=>'cms_item','summary'=>'审核人必须为字符串类型','upgrade'=>'Y');
	}
	if(isset($systems['sites']) && $systems['sites']['enabled']){
		$name = $core->CONFIG['table_prefix'].'sites_item';
        $verifier_ret = $DB_master->getTableColumn($name, 'verifier');
		if(empty($verifier_ret) || stripos($verifier_ret['Type'],'varchar')===false){
			$check_data[] = array('file'=>'sites_verifier','system'=>'sites','fields'=>'verifier','timestamp'=>'2017-07-18','table'=>'sites_item','summary'=>'审核人必须为字符串类型','upgrade'=>'N');
		}else{
			$check_data[] = array('file'=>'sites_verifier','system'=>'sites','fields'=>'verifier','timestamp'=>'2017-07-18','table'=>'sites_item','summary'=>'审核人必须为字符串类型','upgrade'=>'Y');
		}
	}
	
	foreach($check_data as $key=>$value){
		if($system && $value['system'] != $system){
			unset($check_data[$key]);
			continue;
		}
		if(empty($value['table']) && empty($value['fields'])) {
			unset($check_data[$key]);
			continue;
		}
		$check_data[$key]['system'] = isset($modules_list[$value['system']]['alias']) ? $modules_list[$value['system']]['alias'] : $modules_list['core']['alias'];
		$check_data[$key]['file'] = $value['file'].'.php';
		$check_data[$key]['table'] = $value['table'] ? $core->CONFIG['table_prefix'].str_replace($core->CONFIG['table_prefix'], '', $value['table']) : '';
		//扩展
		if(strpos($value['table'],'_article_') && !in_array($value['file'],array('model_time'))){			
			foreach($system_model[$value['system']] as $v){
				$new_recode = $check_data[$key];
				if($v['name'] == 'article') continue;
				$new_recode['table'] = str_replace("_article_","_".$v['name']."_",$new_recode['table']);
				$check_data[] = $new_recode;				
			}
		}
	}
	
	$sql = '';
	foreach($check_data as $keys=>$values){
		if(empty($values['table']) && empty($values['fields'])) {
			unset($check_data[$keys]);
			continue;
		}
		$timeKey[] = $values['timestamp'];
		if(!isset($values['upgrade'])){
			$check_data[$keys]['upgrade'] = 'N';
			$table = $values['table'];
			//检测是否存在数据表或字段
            $ret = false;

            if(!$DB_master->checkTableExists($table)){
                $check_data[$keys]['upgrade'] = 'N2';
            }else{
                if (!empty($values['table']) && empty($values['fields'])) {
                    $ret = $DB_master->checkTableExists($table);
                }
				if(!empty($values['table']) && !empty($values['fields'])) {
                    $fields = trim($values['fields']);
                    $ret = $DB_master->checkFileExists($table, $fields);
                }
				if(!empty($values['table']) && !empty($values['fields']) && !empty($values['change'])) {
                    $fields = trim($values['fields']);
                    $ret = $DB_master->getTableColumn($table, $fields);
					$ret = stripos($ret['Type'],$values['change']) !== false ? true : false;
                }				
                $check_data[$keys]['upgrade'] = empty($ret) ? 'N' : 'Y';
            }
		}
		$check_data[$keys]['file_exists'] = is_file(PHP168_PATH."/upgrade/".$values['file']) ? 'Y' : 'N';
	}
	array_multisort($timeKey,SORT_DESC,$check_data);
	echo p8_json($check_data);
	exit;
	
	
}else if(REQUEST_METHOD == 'POST'){
	
	
}