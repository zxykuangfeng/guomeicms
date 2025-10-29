<?php
defined('PHP168_PATH') or die();

class P8_Sites_Category_Controller extends P8_Controller{

function __construct(&$obj){
	parent::__construct($obj);
}


/**
* 添加分类
**/
function add(&$POST,$cache = true){
	$data = $this->valid_data($POST);
	if($data === null) return false;
	unset($data['id']);
	
	if($data['type'] != 3){
		//if(is_dir($this->model->system->path . $data['path'])){
			//return false;
		//}
		//模型必须填写
		if(empty($data['model'])) return false;
		/* $data['list_template'] = $data['model'].'/list';
		$data['view_template'] = $data['model'].'/view';
		$data['item_template'] = 'common/ico_title/dot_title'; */
	}
	$this->model->system->init_site();
	$data['site'] = !empty($POST['site'])?$POST['site']:$this->model->system->SITE;
	return $this->model->add($data,$cache);
}

/**
* 修改分类
**/
function update($id, &$POST){
	$data = $this->valid_data($POST);
	
	if($data === null) return false;
	
	
	$select = select();
	$select->from($this->model->table, '*');
	$select->in('id', $id);
	$orig_data = $this->core->select($select, array('single' => true, 'ms' => 'master'));
	if($data['type'] != 3){
		//模型必须填写
		if(empty($data['model'])) return false;
		require_once PHP168_PATH .'inc/pinyin.class.php';
		$pinyin = new P8_Pinyin();
		$name = $pinyin->convert($data['name']);
		$data['letter'] = substr($name, 0, 1);
	}
	return $this->model->update($id, $data, $orig_data);
}

/**
* 验证数据
**/
function valid_data(&$POST){
	
	$models = $this->model->system->get_models();
	
	$data = array();
	$data['id'] = isset($POST['id']) ? intval($POST['id']) : 0;
	//名称
	$data['name'] = isset($POST['name']) ? html_entities($POST['name']) : '';
	if(!strlen($data['name'])) return null;
	//跳转URL
	$data['url'] = !empty($POST['url']) ? html_entities($POST['url']) : '';
	//if(!empty($data['url']) && strpos($data['url'],'http')===false )
	//$data['url'] = 'http://'.$data['url'];
	//父分类
	$data['parent'] = isset($POST['parent']) ? intval($POST['parent']) : 0;
	$data['matrix'] = isset($POST['matrix']) ? intval($POST['matrix']) : 0;
	//分类类型
	$data['type'] = isset($POST['type']) ? intval($POST['type']) : 2;
	//要是外链，以下就无关紧要了
	if($data['type'] ==3 ){
		$data['config'] = array('target'=>isset($POST['config']['target'])? $POST['config']['target']:'_blank');
		$data['config'] = $this->DB_master->escape_string(serialize($data['config']));
		return $data;
	}
	
	//大列表显示所有内容
	$data['list_all_model'] = isset($POST['list_all_model']) && $data['type']==1 ? intval($POST['list_all_model']) : 0;
	
	//绑定域名
	$data['domain'] = isset($POST['domain']) ? html_entities($POST['domain']) : '';
	//模型
	$data['model'] = isset($POST['model']) && isset($models[$POST['model']]) ? $POST['model'] : '';
	//HTML存放路径
	$data['path'] = isset($POST['path']) ? basename(trim($POST['path'])) : '';
	if(!strlen($data['path'])){
		//如果没填路径以名称的拼音名
		require_once PHP168_PATH .'inc/pinyin.class.php';
		$pinyin = new P8_Pinyin();
		$name = $pinyin->convert($data['name']);
		$data['path'] = str_replace(' ', '', $name);
		$data['letter'] = substr($name, 0, 1);
	}
	//生成HTML
	$data['htmlize'] = isset($POST['htmlize']) ? intval($POST['htmlize']) : 0;
	$data['htmlize'] = max($data['htmlize'], 0);
	
	//这两个参数很危险
	//静态列表页URL
	$data['html_list_url_rule'] = isset($POST['html_list_url_rule']) ? html_entities($POST['html_list_url_rule']) : '';
	//静态内容页URL
	$data['html_view_url_rule'] = isset($POST['html_view_url_rule']) ? html_entities($POST['html_view_url_rule']) : '';
	//这两个参数很危险
	
	//列表页模板
	$data['list_template'] = !empty($POST['list_template']) ? $POST['list_template'] : $data['model'] .'/list';
	//内容页模板
	$data['view_template'] = !empty($POST['view_template']) ? $POST['view_template'] : $data['model'] .'/view';
	$data['item_template'] = !empty($POST['item_template']) ? $POST['item_template'] : 'common/ico_title'.($data['type']==1? '/list014':'/list016');;
	
	//移动设备列表页模板
	$data['list_template_mobile'] = !empty($POST['list_template_mobile']) ? $POST['list_template_mobile'] : $data['model'].'/list_mobile';
	//移动设备内容页模板
	$data['view_template_mobile'] = !empty($POST['view_template_mobile']) ? $POST['view_template_mobile'] : $data['model'] .'/view_mobile';
	$data['item_template_mobile'] = !empty($POST['item_template_mobile']) ? $POST['item_template_mobile'] : 'mobile/list';

	//封面
	$data['frame'] = isset($POST['frame']) ? attachment_url($POST['frame'], true) : '';
	
	//排序
	$data['display_order'] = isset($POST['display_order']) ? intval($POST['display_order']) : 0;
	//分页每页条数
	$data['page_size'] = isset($POST['page_size']) ? intval($POST['page_size']) : 20;
	$data['page_size'] = max($data['page_size'], 1);
	//关键字
	$data['seo_keywords'] = isset($POST['seo_keywords']) ? html_entities($POST['seo_keywords']) : '';
	//描述
	$data['seo_description'] = isset($POST['seo_description']) ? html_entities($POST['seo_description']) : '';
	$data['label_postfix'] = isset($POST['label_postfix']) ? html_entities($POST['label_postfix']) : '';
	$data['auto_label_postfix'] = isset($POST['auto_label_postfix']) ? html_entities($POST['auto_label_postfix']) : '';
	$data['config'] = isset($POST['config']) ? (array)$POST['config'] : array();
	$data['config']['orderby'] = isset($POST['config']['orderby']) ? preg_replace('/[^0-9a-zA-Z_]/', '', $POST['config']['orderby']) : 'timestamp';
	$data['config']['orderby_desc'] = empty($POST['config']['orderby_desc']) ? 0 : 1;
	
	$data['config']['administrator'] = isset($POST['config']['administrator']) ? array_filter(array_map('trim', explode(',', html_entities($POST['config']['administrator'])))) : array();
	$users = $comma = '';
	foreach($data['config']['administrator'] as $v){
		$users .= $comma . '\''. $v .'\'';
		$comma = ',';
	}
	$_users = array();
	if($users){
		//检验用户
		$query = $this->DB_slave->query("SELECT username FROM {$this->core->member_table} WHERE username IN ($users)");
		
		while($arr = $this->DB_slave->fetch_array($query)){
			$_users[] = $arr['username'];
		}
		$_users = array_flip($_users);
	}
	$data['config']['administrator'] = $_users;
	$data['config']['direct_to_category_id'] = isset($data['config']['direct_to_category_id']) && !empty($data['config']['direct_to_category_id']) ? intval($data['config']['direct_to_category_id']) : 0;
    $data['config']['need_login'] = isset($data['config']['need_login']) ? intval($data['config']['need_login']) : 0;
	$data['config']['fee']['credit_type'] = isset($POST['config']['fee']['credit_type']) ? intval($POST['config']['fee']['credit_type']) : 0;
	$data['config']['fee']['credit'] = isset($POST['config']['fee']['credit']) ? intval($POST['config']['fee']['credit']) : 0;
	
	$data['config']['list_pages_template_mobile'] = empty($POST['config']['list_pages_template_mobile']) ? 'page_template_mobile' : $POST['config']['list_pages_template_mobile'];
	$data['config']['view_pages_template'] = empty($POST['config']['view_pages_template']) ? 'base_page_template' : $POST['config']['view_pages_template'];
	
	$data['config']['list_title_length'] = isset($data['config']['list_title_length']) ? intval($data['config']['list_title_length']) : 120;
	$data['config']['list_title_length_mobile'] = empty($POST['config']['list_title_length_mobile'])?0:intval($POST['config']['list_title_length_mobile']);
	$data['config']['allow_ip']['enabled'] = isset($POST['config']['allow_ip']['enabled']) ? $POST['config']['allow_ip']['enabled'] : 0;		
	//设置“启用仅限局域网访问”、浏览权限控制则栏目强制使用动态
	$data['htmlize'] = $data['config']['allow_ip']['enabled'] || isset($data['config']['authority_viewer']) || (isset($data['config']['authority']) && !in_array('0',$data['config']['authority'])) ? 0 : $data['htmlize'];
	$data['config']['allow_ip']['collectip'] = isset($POST['config']['allow_ip']['collectip']) ? explode("\r\n", trim($POST['config']['allow_ip']['collectip'])) : array();
	$data['config']['allow_ip']['collectip'] = array_filter(array_map('trim',$data['config']['allow_ip']['collectip']));
	$data['config']['allow_ip']['beginip'] = isset($POST['config']['allow_ip']['beginip']) ? trim($POST['config']['allow_ip']['beginip']) : '';
	$data['config']['allow_ip']['endip'] = isset($POST['config']['allow_ip']['endip']) ? trim($POST['config']['allow_ip']['endip']) : '';		
	$data['config']['allow_ip']['ruleoutip'] = isset($POST['config']['allow_ip']['ruleoutip']) ? explode("\r\n", trim($POST['config']['allow_ip']['ruleoutip'])) : array();
	$data['config']['allow_ip']['ruleoutip'] = array_filter(array_map('trim',$data['config']['allow_ip']['ruleoutip']));
	$data['config']['post_year'] = isset($data['config']['post_year']) ? intval($data['config']['post_year']) : 0;
	$data['config']['post_quarter'] = isset($data['config']['post_quarter']) ? intval($data['config']['post_quarter']) : 0;
	$data['config']['post_size'] = isset($data['config']['post_size']) ? intval($data['config']['post_size']) : 0;
	$data['config']['manager'] = isset($data['config']['manager']) ? $data['config']['manager'] : array();	
	$data['config']['post_month'] = isset($data['config']['post_month']) ? intval($data['config']['post_month']) : 0;
	$data['config']['post_week'] = isset($data['config']['post_week']) ? intval($data['config']['post_week']) : 0;
	$data['config']['auditflow'] = isset($data['config']['auditflow']) ? intval($data['config']['auditflow']) : 0;
	$data['config']['authority'] = isset($data['config']['authority']) && in_array('0',$data['config']['authority']) ? array('0'=>0) : $data['config']['authority'];
	$data['config'] = $this->DB_master->escape_string(serialize($data['config']));
	
	$path = '';
	if($data['parent']){
		//继承父分类的路径
		$cat = $this->DB_master->fetch_one("SELECT path FROM {$this->model->table} WHERE id = '$data[parent]'");
		$path = $cat['path'] .'/';
		unset($cat);
	}
	
	$orig_path = '';
	if($data['id']){
		//原来的设置,如果跟原来的设置一样,不用判断目录存在
		$cat = $this->DB_master->fetch_one("SELECT path FROM {$this->model->table} WHERE id = '$data[id]'");
		$orig_path = basename($cat['path']);
	}
	
	if(
		$data['parent'] == 0 && strlen($orig_path) &&
		strlen($data['path']) && $orig_path != $data['path'] &&
		is_dir($this->model->system->path . $data['path'])
	){
		//如果是顶级分类, 要检查根目录的文件夹是否重复
		return null;
	}
	
	$data['path'] = $path . $data['path'];
	//是否启用密码访问栏目
    $data['need_password'] = isset($POST['need_password']) ? intval($POST['need_password']) : 0;
    $data['category_password'] = isset($POST['category_password']) ? trim($POST['category_password']) : '';
	
	return $data;
}

}
