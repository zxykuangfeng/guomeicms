<?php
defined('PHP168_PATH') or die();

class P8_Site_Item extends P8_Module{

var $model;				//当前模型
var $table;				//数据表
var $main_table;		//主表
var $unverified_table;	//未审核数据
var $addon_table;		//追加数据表
var $collection_table;	//收藏数据表
var $member_table;		//会员表
var $search_table;		//搜索表
var $attributes;		//属性
var $attribute_table;	//属性表
var $matrix_table;		//数据对接表
var $clone_table;		//签发记录表
var $tag_table;
var $tag_item_table;
var $credit_log_table;
var $order_table;
var $delimiter;			//自定义字段行分割符,有数据后不要随意修改,ascii bel
var $col_delimiter;		//自定义字段列分割符,有数据后不要随意修改,ascii ack
var $_categories;
var $_html;
var $site;
var $agent = [
	"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; AcooBrowser; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
	"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Acoo Browser; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.0.04506)",
	"Mozilla/4.0 (compatible; MSIE 7.0; AOL 9.5; AOLBuild 4337.35; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
	"Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)",
	"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)",
	"Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 1.0.3705; .NET CLR 1.1.4322)",
	"Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2; .NET CLR 3.0.04506.30)",
	"Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN) AppleWebKit/523.15 (KHTML, like Gecko, Safari/419.3) Arora/0.3 (Change: 287 c9dfb30)",
	"Mozilla/5.0 (X11; U; Linux; en-US) AppleWebKit/527+ (KHTML, like Gecko, Safari/419.3) Arora/0.6",
	"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2pre) Gecko/20070215 K-Ninja/2.1.1",
	"Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9) Gecko/20080705 Firefox/3.0 Kapiko/3.0",
	"Mozilla/5.0 (X11; Linux i686; U;) Gecko/20070322 Kazehakase/0.4.5",
	"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.8) Gecko Fedora/1.9.0.8-1.fc10 Kazehakase/0.5.6",
	"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
	"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/535.20 (KHTML, like Gecko) Chrome/19.0.1036.7 Safari/535.20",
	"Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; fr) Presto/2.9.168 Version/11.52",
];
var $host = '';
var $header = '';
var $referer = '';

function __construct(&$system, $name){
	$this->system = &$system;
	parent::__construct($name);
	
	$this->main_table = $this->system->TABLE_ .'item';
	$this->unverified_table = $this->TABLE_ .'unverified';
	$this->search_table = $this->TABLE_ .'search';
	$this->attribute_table = $this->TABLE_ .'attribute';
	$this->matrix_table = $this->TABLE_ .'matrix';
	$this->member_table = $this->TABLE_ .'member';
	$this->tag_table = $this->TABLE_ .'tag';
	$this->tag_item_table = $this->TABLE_ .'tag_item';
	$this->collection_table = $this->member_table .'_collection';
	$this->order_table = $this->system->TABLE_ .'order';
	$this->credit_log_table = $this->core->TABLE_ .'credit_log';
	$this->clone_table = $this->TABLE_ .'clone';
	$this->delimiter = chr(7);
	$this->col_delimiter = chr(6);
	$this->_html = array();
	$this->site = $this->system->site;
	$this->controller = $this->system->controller.'/'. $name;
	
	$this->attributes = array(
		1 => 'cms_item_attribute_1',
		2 => 'cms_item_attribute_2',
		3 => 'cms_item_attribute_3',
		4 => 'cms_item_attribute_4',
		5 => 'cms_item_attribute_5',
		6 => 'cms_item_attribute_6',
		7 => 'cms_item_attribute_7',
		8 => 'cms_item_attribute_8',
		9 => 'cms_item_attribute_9',
		10 => 'cms_item_attribute_10',
		11 => 'cms_item_attribute_11',
		12 => 'cms_item_attribute_12',
		13 => 'cms_item_attribute_13',
		14 => 'cms_item_attribute_14',
		15 => 'cms_item_attribute_15',
		16 => 'cms_item_attribute_16',
		17 => 'cms_item_attribute_17',
		18 => 'cms_item_attribute_18',
		//more attributes
	);
	
	$this->_categories = array();
	$this->header  = $this->agent[rand(0,count($this->agent) - 1)];
	$this->referer = empty($this->core->url)?'http://www.php168.net/' : $this->core->url;
	$this->host    = empty($this->core->url) ? 'www.php168.net' : $this->core->url;
}


/**
* 设置当前模型
* @param string $name 模型名称
**/
function set_model($name){
    $name = trim($name);
	$this->model = $name;
	
	$this->table = $this->TABLE_ . $name .'_';
	$this->addon_table = $this->TABLE_ . $name .'_addon';
}

/**
* 设置限局域网访问
* @limit 是否限定时间,默认不限定
**/
function set_content_html($cid = array(),$limit = false){
	
	$lan_timestamp = isset($this->CONFIG['lan_date']) && $this->CONFIG['lan_date'] ? intval($this->CONFIG['lan_date']) : 0;
	if(empty($cid)){
		$lan_date_enable = isset($this->CONFIG['lan_date_enable']) && $this->CONFIG['lan_date_enable'] ? true : false;
		if(!$lan_timestamp || !$lan_date_enable) return; 
	}
	if($limit && empty($lan_timestamp)){
		return; 
	}
	$lan_category = isset($this->system->site['config']['lan_category']) && $this->system->site['config']['lan_category'] ? explode(',',$this->system->site['config']['lan_category']) : array();
	$lan_category = array_filter($lan_category);
	$s = $comma = '';
	foreach($lan_category as $v){
		if($v){
			$s .= $comma ."$v";
			$comma = ',';
		}
	}
	if(empty($cid)){
		$where = $s ? ' where timestamp <= '.$lan_timestamp.' and cid NOT IN ('. $s .')' : '  where timestamp <= '.$lan_timestamp;
	}else{
		if($limit && $lan_timestamp)
			$where = $cid ? ' where cid IN ('. implode(',', $cid) .') and timestamp <= '.$lan_timestamp : '';
		else
			$where = $cid ? ' where cid IN ('. implode(',', $cid) .')' : '';
	}
	$all_models = $this->system->get_models();
	
	$this->CONFIG['htmlize'] = 1;
	require_once PHP168_PATH .'inc/html.func.php';
	foreach($all_models as $model=>$val){		
		if(!$val['enabled']) continue;
		$table = $this->system->TABLE_ .'item_'.$model.'_';
		$query = $this->DB_slave->query("select `id`,`site`,`cid`,`pages`,`timestamp`,`config` from $table $where");
		
		while($arr = $this->DB_slave->fetch_array($query)){
			$id = $arr['id'];
			$config = mb_unserialize(stripslashes($arr['config']));
			$config['allow_ip']['enabled'] = 2;				
			$status = $this->DB_master->update(
				$table,
				array('config'=>$this->DB_master->escape_string(serialize($config))),
				"id = '$id'"
			);			
			//获取要删除的HTML文件
			/*
			$category = $this->system->fetch_category($arr['cid'],false,$arr['site']);	
			$category['htmlize'] = 1;
			$arr['#category'] = $category;			
			$file = p8_html_url($this, $arr, 'view', false);
			$file = str_replace('/sites//','/sites/html/'.$this->system->SITE.'/',$file);
			$_no_page_file = preg_replace('/#([^#]+)#/', '', $file);
			$_page_file = preg_replace('/#([^#]+)#/', '$1', $file);			
			for($i = 1; $i <= $arr['pages']; $i++){
				$file = $i == 1 ? $_no_page_file : str_replace('?page?', $i, $_page_file);
				if($file) @unlink($file);
			}
			*/
		}		
	}
}
/**
* 设置不限局域网访问
**/
function unset_content_html($cid = array()){	
	$all_models = $this->system->get_models();
	$where = $cid ? 'where cid IN ('. implode(',', $cid) .')' : '';
	foreach($all_models as $model=>$val){		
		if(!$val['enabled']) continue;
		$table = $this->system->TABLE_ .'item_'.$model.'_';
		$query = $this->DB_slave->query("select `id`,`config` from $table $where");
		while($arr = $this->DB_slave->fetch_array($query)){
			$id = $arr['id'];
			$config = mb_unserialize(stripslashes($arr['config']));
			$config['allow_ip']['enabled'] = 0;				
			$status = $this->DB_master->update(
				$table,
				array('config'=>$this->DB_master->escape_string(serialize($config))),
				"id = '$id'"
			);			
		}
	}	
}

/**
* 取得未通过审核内容的简短数据
**/
function data_unverified($id){
	$sql = 'SELECT * FROM '. $this->unverified_table .' WHERE id = \''. $id .'\'';
	//读取
	return $this->DB_slave->fetch_one($sql);	
}

/**
* 取得内容的简短数据
**/
function data($act, $data){
	
	if($act == 'read'){
		$sql = 'SELECT id,uid,url,model,views,cid, pages,timestamp,allow_comment,credit,credit_type,html_view_url_rule,verify_frame FROM '. $this->main_table .' WHERE id = \''. $data .'\'';
		
		//读取
		if($this->core->CACHE->memcache){
			$ret = $this->core->CACHE->memcache_read($this->system->name .'_item_'. $data);
			if(!$ret && $ret = $this->DB_slave->fetch_one($sql)){
				$this->core->CACHE->memcache_write($this->system->name .'_item_'. $data, $ret);
			}
		}else{
			$ret = $this->DB_slave->fetch_one($sql);
		}
		return $ret;
	}else if($act == 'write' && $this->core->CACHE->memcache){
		//写入
		$d = array(
			'id' => $data['id'],
			'uid' => $data['uid'],
			'cid' => $data['cid'],
			'model' => $data['model'],
			'timestamp' => $data['timestamp'],
			'pages' => $data['pages'],
			'allow_comment' => $data['allow_comment'],
			'credit' => $data['credit'],
			'credit_type' => $data['credit_type'],
			'html_view_url_rule' => $data['html_view_url_rule']
		);
		$this->core->CACHE->memcache_write($this->system->name .'_item_'. $data['id'], $d);
	}else if($act == 'delete' && $this->core->CACHE->memcache){
		$this->core->CACHE->memcache_delete($this->system->name .'_item_'. $data);
	}
}

function get_page($cid,$model){
	$sql = "SELECT id FROM {$this->main_table} WHERE cid='$cid' AND model='$model'";
	$ret = $this->DB_slave->fetch_one($sql);
	return $ret;
}
/**
* 根据ID取签发数据的ID
**/
function get_clone_ids($id){
	$id = (array)$id;
	$sql = "select `to_id` from {$this->clone_table} where `from_id` in (".implode(',',$id).")";
	$to_ids = $this->DB_slave->fetch_all($sql);
	foreach($to_ids as $item){
		$id[] = intval($item['to_id']);
	}
	return $id;
}
/**
* 根据ID取属性
**/
function get_attributes($id){
	$sql = "SELECT `aid` FROM {$this->attribute_table} WHERE id='$id'";
	$ret = $this->DB_slave->fetch_all($sql);
	$attributes = array();
	foreach($ret as $v){
		$attributes[$v['aid']] = $v['aid'];
	}
	return $attributes;
}
/**
* 添加一条内容
**/
function add(&$data){
	return include $this->path .'call/add.call.php';
}

/**
* 修改一条内容
**/
function update($id, &$data, &$orig_data, $verified = true){
	return include $this->path .'call/update.call.php';
}

/**
* 追加数据
**/
function addon(&$data){
	return include $this->path .'call/addon.call.php';
}

/**
* 编辑追加数据
**/
function update_addon(&$data, &$orig_data){
	return include $this->path .'call/update_addon.call.php';
}

/**
* 删除追加数据
**/
function delete_addon($data){
	return include $this->path .'call/delete_addon.call.php';
}

/**
* 验证内容
**/
function verify($data){
	return include $this->path .'call/verify.call.php';
}

/**
* 删除记录
* @param array $data 要删除的条件
* @return array 被删除的ID
**/
function delete($data){
	
	return include $this->path .'call/delete.call.php';
}

/**
* 挂钩删除
**/
function hook_delete(&$obj, $cond){
	$orig_model = $this->model;
	
	//己审核的数据
	$this->delete(array(
		'where' => str_replace('#module_table#', $this->main_table, $cond),
		'hook' => true
	));
	
	//未审核的数据
	$this->delete(array(
		'where' => str_replace('#module_table#', $this->unverified_table, $cond),
		'verified' => 0,
		'hook' => true
	));
	
	$this->model = $orig_model;
}

/**
* 移动分类
* @param array $id 要移动的内容ID
* @param int $cid 要移动到的分类ID
* @return bool
**/
function move($id, $cid, $verified = true){
	return include $this->path .'call/move.call.php';
}

/**
 * 设置权重
 * @param array $id 要设置的内容ID
 * @param int $value 要设置到的权重大小
 * @return bool
 **/
function level($id, $value, $verified = true,$level_time){
    return include $this->path .'call/level.call.php';
}
/**
 * 设置评分
 * @param array $id 要设置的内容ID
 * @param int $value 要设置到的评分大小
 * @return bool
 **/
function score($id, $value, $verified = true,$push_back_reason){
    return include $this->path .'call/score.call.php';
}
/**
* 复制到分类
* @param array $id 要移动的内容ID
* @param int $cid 要移动到的分类ID
* @return bool
**/
function cloneitem($id, $cid, $verified = true, $clone_time='',$filter_word_enable = true,$clone_uid = 0){
	return include $this->path .'call/clone.call.php';
}

function list_order($id, $timestamp){
	return include $this->path .'call/list_order.call.php';
}

/**
* 为一条内容添加属性
* @param string $attributes 属性 1,2,3
* @param int $id 内容ID
* @param int $cid 分类ID
**/
function add_attribute($attributes, $id, $cid){
	return include $this->path .'call/add_attribute.call.php';
}

/**
* 为一条内容更新属性
* @param string $attributes 属性 1,2,3
* @param int $id 内容ID
* @param int $cid 分类ID
**/
function update_attribute($attributes, $id, $cid){
	$status = $this->DB_master->update(
		$this->main_table,
		array('attributes'=>$attributes),
		"id = '$id'"
	);
	$status = $this->DB_master->update(
		$this->table,
		array('attributes'=>$attributes),
		"id = '$id'"
	);
	return include $this->path .'call/add_attribute.call.php';
}
/**
* 格式化数据
* @param array $data
**/
function format_data(&$data){
	//封面
	$data['frame'] = isset($data['frame']) ? attachment_url(html_decode_entities($data['frame']),false,true) : '';	
	$data['verify_frame'] = isset($data['verify_frame']) ? attachment_url($data['verify_frame'],false,true) : '';
	$data['attachment_pdf'] = isset($data['attachment_pdf']) ? attachment_url($data['attachment_pdf'],false,true) : '';	
	$data['addon_frame'] = isset($data['addon_frame']) ? attachment_url($data['addon_frame'],false,true) : '';
	$data['url'] = isset($data['url']) ? html_entity_decode(attachment_url($data['url'],false,true)) : '';
	//来源地址
	if(isset($data['source'])){
		$tmp = explode('|', $data['source']);
		$data['source_name'] = $tmp[0];
		$data['source_url'] = isset($tmp[1]) ? $tmp[1] : '';
	}
	$data['summary'] = p8_stripslashes($data['summary']);
	$data['summary'] = preg_replace('/(amp;)+/','', $data['summary']);
	global $this_model;
	foreach($this_model['fields'] as $field => $v){
		
		if(!isset($data[$field])) continue;
		
		switch($v['widget']){
		
		//分割多选项
		case 'checkbox':
		case 'multi_select':
			$tmp = explode($this->delimiter, $data[$field]);
			$data[$field] = array();
			foreach($tmp as $vv){
				foreach($v['data'] as $value => $key){
					if($vv == $value) $data[$field][$value] = $value;
				}
			}
			unset($tmp);
		break;
		
		//上传器,编辑器要对附件地址处理
		case 'video_uploader':
			$data[$field] = attachment_url($data[$field],false,true);
		break;
		/*
		'editor'		=> 'cms_model_widget_editor',
		'editor_basic'	=> 'cms_model_widget_editor_basic',
		'editor_common'	=> 'cms_model_widget_editor_common',
		'ueditor_basic'	=> 'cms_model_widget_ueditor_basic',
		'ueditor_common'=> 'cms_model_widget_ueditor_common',
		 'ckeditor'		=> 'cms_model_widget_ckeditor',
		'ckeditor_basic'	=> 'cms_model_widget_ckeditor_basic',
		'ckeditor_common'	=> 'cms_model_widget_ckeditor_common',
		*/
		case 'editor': case 'editor_basic': case 'ueditor_common': case 'ueditor': case 'ueditor_basic': case 'editor_common':case 'ckeditor':case 'ckeditor_common':case 'ckeditor_basic':
			$data[$field] = attachment_url($data[$field],false,true);
			$data[$field] = html_decode_entities($data[$field]);
			//百度编辑器的字符
			$data[$field] = str_replace('"Microsoft YaHei"','&quot;Microsoft YaHei&quot;',$data[$field]);
		break;
		
		case 'uploader':case 'image_uploader':
			$tmp = explode($this->delimiter, attachment_url($data[$field],false,true));
			$data[$field] = array(
				'title' => $tmp[0],
				'url' => isset($tmp[1]) ? $tmp[1] : '',
				'thumb' => isset($tmp[2]) ? $tmp[2] : ''
			);
		break;
		
		//多上传器
		case 'multi_uploader': case 'video_multi_uploader':
			$tmp = explode($this->delimiter, attachment_url($data[$field],false,true));
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'title' => $v[0],
					'note' => $v[1],
					'url' => isset($v[2]) ? $v[2] : '',
					'thumb' => isset($v[3]) ? $v[3] : ''
				);
			}
			unset($tmp);
		break;
		}
	}
	
}

function fetch_category($id){
	if(isset($this->_categories[$id])){
		return $this->_categories[$id];
	}else{
		$this->_categories[$id] = $this->core->CACHE->read($this->system->name .'/modules', 'category', (int)$id);
		if(empty($this->_category[$id])){
			$this->cache(false,true,array($id => $id),$this->system->SITE);
			$this->_category[$id] = $this->core->CACHE->read($this->system->name .'/modules', 'category', (int)$id);
		}
		return $this->_category[$id];
	}
}

/**
* 生成内容页静态
**/
function html(&$query,$this_site=''){
	$this_site = $this_site ? $this_site : $this->system->SITE;
	return include $this->path .'call/html.call.php';
}

function get_tag($str, $return_id = false){
	$ret = array('array' => array(), 'tag_id' => array(), 'tag' => array());
	$sql = $comma = ''; $i = 1;
	foreach(explode(',', $str) as $v){
		if(strlen($v = trim($v)) == 0) continue;
		if($i > 5) break;
		
		$ret['array'][] = $v;
		$sql .= $comma . '\''. $v. '\''; $comma = ',';
		$i++;
	}
	if(empty($ret['array'])) return $ret;
	
	if($return_id){
		$query = $this->DB_slave->query("SELECT id, name, item_count FROM $this->tag_table WHERE name IN ($sql)");
		while($arr = $this->DB_slave->fetch_array($query)){
			$ret['tag_id'][$arr['name']] = $arr['id'];
			$ret['tag'][$arr['name']] = $arr;
		}
	}
	
	return $ret;
}

/**
* 添加标签(tag)
* @param string $str 要添加的字符串,分隔. tag1,tag2
* @param int $iid tagged的内容id
* @param string $action 添加或更新内容
**/
function add_tag($str, $iid, $action = 'add'){
	if(strlen($str) == 0) return false;
	
	return include $this->path .'call/add_tag.call.php';
}

/**
* 缓存
**/
function cache(){
	parent::cache();
	
	return include $this->path .'call/cache.call.php';
}


/**
* 生成集群使用的数据
* @param array $id 要推送数据的内容ID
* @param int $cid 要推送到远程的分类ID
* @return array
**/
function cluster_data($id, $cid, $send_time_type = 0, $send_time = P8_TIME){
	return include $this->path .'call/cluster_data.call.php';
}

function sites_data($id, $cid, $push_site, $send_time_type, $send_time){
	return include $this->path .'call/sites_data.call.php';
}

function add_order($data){

	$pay = $this->core->load_module('pay');
	if($sdata = $pay->order($data)){
		$data['NO'] = $sdata['NO'];
		$status = $this->DB_master->insert(
			$this->order_table,
			$this->DB_master->escape_string($data),
			array('return_id' => true)
		);
		return $sdata;
	}
}
/**
* 生成列表页静态
**/
function html_list($dcid,$mobile=false,$this_site=''){
	$this_site = $this_site ? $this_site : $this->system->SITE;
	return include $this->path .'call/html_list.call.php';
}

function set_push_attributes($dell_id){
	global $USERNAME;
	$query = $this->DB_master->query("SELECT id, cid, model, attributes FROM $this->main_table WHERE id IN (". implode(',', $dell_id) .")");
	$scid = array();		
	//设置内容属性
	$datas = array();
	while($arr = $this->DB_master->fetch_array($query)){
		//原本属性
		$_attributes = array_filter(explode(',', $arr['attributes']));
		$_attributes[] = 10;
		$datas[] = array($arr['id'], 10, $arr['cid'], $USERNAME, P8_TIME);

		$_attributes = implode(',', array_unique($_attributes));
		
		//更新主表属性
		$this->DB_master->update(
			$this->main_table,
			array('attributes' => $_attributes),
			"id = '$arr[id]'"
		);
		
		//更新模型表属性
		$this->set_model($arr['model']);
		$this->DB_master->update(
			$this->table,
			array('attributes' => $_attributes),
			"id = '$arr[id]'"
		);
		$scid[$arr['cid']]=$arr['cid'];
	}
	
	//批量replace into
	$this->DB_master->insert(
		$this->attribute_table,
		$datas,
		array(
			'multiple' => array('id', 'aid', 'cid', 'last_setter', 'timestamp'),
			'replace' => true
		)
	);
}

function check_repush($datas,$to = 'sites'){
	global $core;
	$push_table = $this->system->TABLE_.'stop_data';
	$to = $to ? $to : 'sites';
	$list = array();
	foreach($datas as $key => $data){
		$title = $data['title'];
		$cid = $data['cid'];
		$iid = $data['iid'];
		$where = "`from` = 'sites' and `sc` = 'c' and `status` in ('0','1','2')";
		$where .= " and `to` = '$to'";
		$where .= " and `title` = '$title'";
		$where .= " and `cid` = '$cid'";
		$where .= " and `item_id` = '$iid'";
		$sql = "SELECT * FROM $push_table WHERE $where";
		//echo $sql;
		if($ret = $this->DB_slave->fetch_one($sql)){
			$site_status = explode(',',$ret['site_status']);
			$list[$key] = array(
				'id' => $iid,
				'title' => $title,
				'timestamp' => $ret['timestamp'],
				'status' => $ret['status'],
				'new_id' => $ret['new_id'],
				'site' => current($site_status),
			);
		}
	}
	return $list;
}

















/**
* 标签调用的数据, 接口
* @param array $LABEL 标签模块
* @param array $label 标签数据
* @param array $var 变量
**/
function label(&$LABEL, &$label, &$var){
	global $core;
	$option = &$label['option'];
	
	$orig_model = $this->model;
	if(!empty($var['model'])){
		//变量传入的
		$model = $var['model'];
	}else if(!empty($option['model'])){
		$model = $option['model'];
	}
	
	if(!empty($model)){
		$this->set_model($model);
		
		//当前模型
		$this_model = &$this->system->get_model($model);
		
		$table = $this->table;
		
		$sphinx_indexes = $this->system->sphinx_indexes(array($model => 1));
		
		$fields = 'i.*';
	}else{
		$table = $this->main_table;
		
		$sphinx_indexes = $this->system->sphinx_indexes();
		
		$fields = 'i.id,i.authority, i.model, i.title, i.title_color, i.title_bold, i.sub_title, i.cid, i.frame, i.url, i.uid, i.username, i.attributes, i.summary, i.html_view_url_rule, i.views, i.level, i.comments, i.timestamp, i.list_order';
	}
	
	$category = &$this->system->load_module('category');
	$category->get_cache();
	
	$select = select();
	$select->in('site',$this->system->SITE);
	
	if(empty($option['ids'])){
		
		$sphinx = $this->CONFIG['sphinx'];
		$sphinx['index'] = $sphinx_indexes;
		
		if(!empty($option['attribute'])){
			//有属性,取消sphinx
			$select->from($table .' AS i', $fields);
			$select->inner_join($this->attribute_table .' AS a', '', 'a.id = i.id');
			$select->in('a.aid', $option['attribute']);
			$sphinx['enabled'] = 0;
			
		}else{
			$select->from($table .' AS i', $fields);
		}
		
		//时间区间
		$select->range(
			'i.timestamp',
			empty($option['timestamp'][0]) ? null : strtotime($option['timestamp'][0]),
			empty($option['timestamp'][1]) ? null : strtotime($option['timestamp'][1]),
			empty($option['timestamp']['exclude'])? null : $option['timestamp']['exclude']
		);
		
		//分类
		if(!empty($option['category'])){
			//如果有属性,使用属性的字段来作为条件
			
			$cats = $option['category'];
			if(!empty($option['include_sub_category'])){
				foreach($option['category'] as $v){
					$cats = array_merge($category->get_children_ids($v));
				}
			}
			
			$select->in(empty($option['attribute']) ? 'i.cid' : 'a.cid', $cats);
		}
		
		//用户ID
		if(!empty($option['uids'])){
			$select->in('i.uid', $option['uids']);
		}
		
		//搜索关键字
		if(!empty($option['keyword'])){
			/*if(!empty($option['keyword_tag'])){*/
				$tag = $this->get_tag($option['keyword'], true);
				
				if($tag['tag_id']){
					$select->inner_join($this->tag_item_table .' AS ti', '', 'ti.iid = i.id');
					$select->in('ti.tid', $tag['tag_id']);
					$select->distinct();
				}
			/*}else{
				$select->search('i.title', $option['keyword']);
			}*/
		}
		
		foreach($option['field#'] as $field => $v){
			$exclude = empty($v['exclude']) ? false : true;
			switch($v['op']){
			
			case 'in':
				$select->in('i.'. $field, $v['value'], $exclude);
			break;
			
			case 'range':
				$select->in('i.'. $field, $v[0], $v[1], $exclude);
			break;
			
			case 'search':
				$select->like('i.'. $field, $v['value'], 'all', $exclude);
			break;
			
			}
		}
		
		//排序
		if(!empty($option['order_by_string'])){
			if(array_key_exists('d.digg',$option['order_by']) || array_key_exists('d.trample',$option['order_by']))
				$select->left_join($this->TABLE_.'digg as d', 'd.digg, d.trample', 'd.iid=i.id', $index = '');
				
			$select->order($option['order_by_string']);
		}else{
			$select->order('i.timestamp DESC');
		}
		
		//当前页码
		$page = 0;
		//总记录数
		$count = 0;
		$page_size = $option['limit'];
		
		//处理变量
		if(is_array($var)){
			$var = $this->DB_master->escape_string($var);
			
			foreach($option['var_fields'] as $field => $v){
				//处理变量字段
				switch($v['operator']){
				
				case 'in':
					$select->in($field, $var[$field]);
				break;
				
				case 'range':
					$exclude = !empty($var[$field]) || !empty($var['exclude']) ? true : false;
					$select->range(
						$field,
						isset($var[$field][0]) ? $var[$field][0] : null,
						isset($var[$field][1]) ? $var[$field][1] : null,
						$exclude
					);
				break;
				
				case 'search':
					if($field == 'i.title'){
						$tag = $this->get_tag($var[$field], true);
						
						if($tag['tag_id']){
							$select->inner_join($this->tag_item_table .' AS ti', '', 'ti.iid = i.id');
							$select->in('ti.tid', $tag['tag_id']);
							$select->distinct();
						}
					}else{
						$select->search($field, $var[$field]);
					}
				break;
				
				}
			}
			
			if($option['pageable']){
				//可分页,有页码
				if(isset($var['#page#'])) $page = $var['#page#'];
				//有记录数
				if(isset($var['#count#'])) $count = $var['#count#'];
				//指定了limit
				$page_size = empty($var['#page_size#']) ? $option['limit'] : $var['#page_size#'];
			}
		}
		
		//echo $select->build_sql() .'<hr />';
		//取出数据
		$list = $this->core->list_item(
			$select,
			array(
				'page' => &$page,
				'page_size' => $page_size,
				'count' => &$count,
				'sphinx' => $sphinx
			)
		);
		
		
		//如果可分页
		if($option['pageable']){
			//获取页面上的当前分类数据
			global $CAT;
			if(!empty($CAT)){
				//如果处于本模块的分页脚本上
				$CAT['is_category'] = true;
				
				//当前分类的分页
				$pages = list_page(array(
					'count' => $count,
					'page' => $page,
					'page_size' => $page_size,
					'url' => $this->system->site_p8_url($this, $CAT, 'list', false)
				));
			}
		}
		
	}else{
		$select->from($table .' AS i', $fields);
		//指定ID,不需分页,不使用sphinx, 排序按传入ID的顺序排
		$select->in('i.id', $option['ids']);
		$c = range(0, count($option['ids']) -1);
		
		$list = $this->core->list_item(
			$select,
			array('page_size' => 0)
		);
		
		$tmp = array_combine($option['ids'], $c);
		foreach($list as $v){
			$tmp[$v['id']] = $v;
		}
		
		$list = array_values($tmp);
	}
	//echo $select->build_sql().'<br>';
	unset($select, $tmp);
	//设置回原来的模型
	$this->set_model($orig_model);
	
	
	$dot = empty($option['title_dot']) ? '' : '...';
	//幻灯片宽高
	$swidth = isset($option['width']) ? $option['width'] : 300;
	$sheight = isset($option['height']) ? $option['height'] : 300;
	
	//每行的宽度,用于多列
	$width = isset($option['rows']) && $option['rows'] > 1 ? (100/$option['rows']-1).'%' : '99%';
	$wf ='';
	if($width!='99%'){
		$wf = "width:$width;float:left;margin-right:1%";
	}
	$title_length = empty($option['title_length']) ? 0 : $option['title_length'];
	$summary_length = empty($option['summary_length']) ? 0 : $option['summary_length'];
	$core_config = $core->get_config('core','');
	foreach($list as $k => $v){		
		$v['#category'] = &$category->categories[$v['cid']];
		$v['url'] = html_entity_decode(attachment_url($v['url'],false,true));
		$v_config = isset($v['config']) ? mb_unserialize(stripslashes($v['config'])) : array();
		if(empty($v['url']) && $v_config['allow_ip']['enabled'] >= 1 && $core_config['static_enable'] && $core_config['static_url']){
			$list[$k]['url'] = $core_config['static_url'].'/s.php/'.$this->system->SITE.'/item-view-id-'.$v['id'].'.html';
		}else{
			$this_category = $this->system->fetch_category($v['cid']);
			if($this_category['htmlize']){
				$list[$k]['url'] = $this->system->site_p8_url($this, $v, 'view');
			}else{
				$list[$k]['url'] = $core_config['static_url'].'/s.php/'.$this->system->SITE.'/item-view-id-'.$v['id'].'.html';
			}
			//$list[$k]['url'] = $this->system->site_p8_url($this, $v, 'view');
		}
		//$list[$k]['url'] = $v['#category']['allow_ip_enabled'] >= 1 || $v_config['allow_ip']['enabled'] >= 1 ? $this->system->siteurl.'/item-view-id-'.$v['id'] : $list[$k]['url'];		
		if($v['#category']['allow_ip_enabled'] >= 1 || $v_config['allow_ip']['enabled'] >= 1){
			$list[$k]['url'] = $core_config['static_enable'] && $core_config['static_url'] ? $core_config['static_url'].'/s.php/'.$this->system->SITE.'/item-view-id-'.$v['id'].'.html' : $this->system->siteurl.'/item-view-id-'.$v['id'];			
		}
		if(($v['#category']['allow_ip_enabled'] >= 1 || $v_config['allow_ip']['enabled'] >= 1) && $core_config['static_enable'] && $core_config['static_url'])
			$list[$k]['url'] = $core_config['static_url'].'/s.php/'.$this->system->SITE.'/item-view-id-'.$v['id'].'.html';		
		//权限控制下使用动态
		if($v['authority'] || $v_config['authority_viewer'] || 
			!empty($category->categories[$v['cid']]['authority_viewer']) || 
			(!empty($category->categories[$v['cid']]['authority']) && !in_array('0',$category->categories[$v['cid']]['authority']))
		){
			$list[$k]['url'] = $core_config['static_url'].'/s.php/'.$this->system->SITE.'/item-view-id-'.$v['id'].'.html';
		}
		$list[$k]['frame'] = attachment_url($v['frame'],false,true);
		if($list[$k]['frame'] && $core_config['lazyload']){
			$list[$k]['frame'] = $RESOURCE.'/images/nopic.jpg" class="lazy" original="'.$list[$k]['frame'];
		}
		$list[$k]['full_title'] = $v['title'];
		$list[$k]['title'] = p8_cutstr(html_entity_decode($v['title'],ENT_NOQUOTES), $title_length, $dot);
		$list[$k]['summary'] = p8_cutstr(html_entity_decode(p8_stripslashes($v['summary']),ENT_NOQUOTES), $summary_length, '');
		$list[$k]['summary'] = preg_replace('/(amp;)+/','', $list[$k]['summary']);
		$tmp = explode('|', $v['sub_title']);
		$list[$k]['sub_title'] = $tmp[0];
		$list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
		
		//分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		//分类URL
		$list[$k]['category_url'] = $v['#category']['url'];
		
		//加粗和颜色
		if(!empty($v['title_color'])) $list[$k]['title'] = '<font color="'. $v['title_color'] .'">'. $list[$k]['title'] .'</font>';
		if(!empty($v['title_bold'])) $list[$k]['title'] = '<b>'. $list[$k]['title'] .'</b>';
	}
	
	global $SKIN, $TEMPLATE, $RESOURCE;
	$this_system = &$this->system;
	$this_module = &$this;
	$SYSTEM = $this->system->name;
	$MODULE = $this->name;
	$core = &$this->core;
	
	if(!empty($label['option']['tplcode']) && strlen($label['option']['tplcode']) > 10){
		//即时编译的模板
		$tplcode = $LABEL->compile_template($label['option']['tplcode']);
		ob_start();
		eval($tplcode);
		$content = ob_get_clean();
		
	}else{
		//变量中指定了模板
		$template = empty($var['#template#']) ? $label['option']['template'] : $var['#template#'];
		
		//用数据包含模板取得标签内容
		ob_start();
		include $LABEL->template($template);
		$content = ob_get_clean();
	}
	
	return isset($pages) ? array($content, $pages) : array($content);
}

/**
* 个人主页内容列表
**/
function homepage_list(&$block){
	
	global $core, $SKIN, $RESOURCE, $USER;
	
	$select = select();
	$select->from($this->member_table .' AS m', 'm.iid');
	$select->inner_join($this->main_table .' AS i', 'i.*', 'm.iid = i.id');
	$select->in('m.uid', $USER['id']);
	$select->order('m.timestamp DESC');
	
	$page = 0;
	$count = 0;
	$page_size = empty($block['item_count']) ? 10 : $block['item_count'];
	$page_size = max(1, $page_size);
	
	$list = $this->core->list_item(
		$select,
		array(
			'page' => &$page,
			'page_size' => $page_size,
			'count' => &$count,
			//'sphinx' => $sphinx
		)
	);
	
	$category = &$this->system->load_module('category');
	$category->get_cache();
	
	foreach($list as $k => $v){
		$v['#category'] = &$category->categories[$v['cid']];
		$list[$k]['url'] = $this->system->site_p8_url($this, $v, 'view');
		
		$list[$k]['frame'] = attachment_url($v['frame'],false,true);
		//$list[$k]['summary'] = p8_cutstr($v['summary'], $summary_length, '');
		$tmp = explode('|', $v['sub_title']);
		$list[$k]['sub_title'] = $tmp[0];
		$list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
		
		//分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		//分类URL
		$list[$k]['category_url'] = $v['#category']['url'];
		
		//加粗和颜色
		if(!empty($v['title_color'])) $list[$k]['title'] = '<font color="'. $v['title_color'] .'">'. $list[$k]['title'] .'</font>';
		if(!empty($v['title_bold'])) $list[$k]['title'] = '<b>'. $list[$k]['title'] .'</b>';
	}
	
	ob_start();
	include template($this, 'block/list');
	return ob_get_clean();
	
}
/**
* 按ID查看一条积分记录
**/
function view_credit_log($id){
	$system = $this->system->name;
	$ret = $this->DB_master->fetch_one("SELECT * FROM $this->credit_log_table WHERE system = '$system' and iid = '$id'");
	return $ret;
}
/**
* 取分站各部门发布统计
**/
function get_dept_static($pid=0,$type="all"){
	$detp_list = array();
	$module_member = $this->core->load_module('member');
	$module_member->get_cache();
	
	$sql = "select id,parent,name from {$module_member->dept_table}";
	
	$query = $this->DB_master->query($sql);
	//$parents_arr = array();
	while($arr = $this->DB_master->fetch_array($query)){
		$detp_list[$arr['id']] = $arr;
		$detp_list[$arr['id']]['count'] = 0;
		//if($arr['parent'] == $pid) $parents_arr[] = $arr['id'];
	}
	if($type == 'month'){
		//当月 
		$month_date = mktime(0,0,0,date('m'),1,date('Y'));
		$where .= "i.site in ('".$this->system->SITE."') and i.timestamp >= $month_date";
	}else if($type == 'year'){
		//本年度 
		$year_date = mktime(0,0,0,1,1,date('Y'));
		$where .= "i.site in ('".$this->system->SITE."') and i.timestamp >= $year_date";
	}else{
		//不限
		$where .= "i.site in ('".$this->system->SITE."')";
	}
	$SQL = "SELECT m.dept2 as dept, COUNT(*) AS `count` FROM $this->main_table AS i,$module_member->table AS m where i.uid = m.id and $where GROUP BY m.dept2";
	$query = $this->DB_master->query($SQL);
	
	$list = array();
	$get_id = array();
	while($arr = $this->DB_master->fetch_array($query)){
		if($arr['dept'] && $arr['count']){
			$get_id[] = $arr['dept'];
			$detp_list[$arr['dept']]['count'] = $arr['count'];
			//如果有父分类同时更新父分类
			if($parents = $module_member->get_parents($arr['dept'])){
				foreach($parents as $v){			
					$detp_list[$v['id']]['count'] += $arr['count'];
					$get_id[] = $v['id'];
				}		
			}
		}
	}
	foreach($detp_list as $did=>$dept){
		//if(!in_array($dept['parent'],$parents_arr)) unset($detp_list[$did]);//只保留所有的二级部门
		if($dept['parent'] != $pid) unset($detp_list[$did]);//只要所属下级部门
	}
	$sort = array_column($detp_list,'count');
	array_multisort($sort,SORT_DESC,$detp_list);	
	return $detp_list;
}
/**
 * 爬取内容
 * @param  $url
 */
function wechat_get($url)
{
	$ch=curl_init($url);
	$options = [
		CURLOPT_USERAGENT => $this->agent,
		CURLOPT_REFERER => $this->referer,
	];
	curl_setopt_array($ch,$options);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch,CURLOPT_TIMEOUT,60);
	$output=curl_exec($ch);
	return $output;
}
/*
 * 获取内容
 * $url		路径
 * $type	模式，1：
 */
function crawByUrl($url)
{
	$content = $this->wechat_get($url);
	$basicInfo = $this->articleBasicInfo($content);
	$content_html = $this->contentHandle($content,1);
	return array_merge($basicInfo,['content_html'=>$content_html]);
}
/**
 * 处理微信文章源码，提取文章主体，处理图片链接
 * @param  $content 抓取的微信文章源码
 * $type	1：本地化，2：去图片
 * @return [带图html文本，无图html文本]
 */
function contentHandle($content,$type)
{
	$content_html_pattern = '/<div class="rich_media_content([^>]*)>(.*?)<\/div>/s';
	preg_match_all($content_html_pattern, $content, $html_matchs);

	$content_html = !empty($html_matchs[2][0]) ? $html_matchs[2][0] : "";
	if ($type == 1){
		/*带图片html文本 原滋原味,可用于图片本地化*/
		$content_text =str_replace("data-src","src",$content_html);
	}else{
		/** @var  无图html文本，把所有图片都去掉啦！！！ */
		$content_text = preg_replace('/<img.*?>/s','',$content_html);
	}
	return $content_text;
}
/**
 *图片本地化
**/
function content_local_images($content,$len = 0){
	$deal_content = $len ? substr($content,0,$len) : $content;		
	if($content){
		$spider = $this->core->load_module('spider');
		$ret_content = $spider->capture_image($deal_content);
		$ret_content = $len ? $ret_content.substr($content,$len) : $ret_content;
	}else{
		$ret_content = '';
	}	
	return $ret_content;
}
/**
 * 获取文章的基本信息
 * @param  $content 文章详情源码
 * @return $basicInfo
 */
function articleBasicInfo($content)
{	
	//待获取item                
	$item = [
				'ct' => 'date',//发布时间
				'msg_title' => 'title',//标题
				'msg_desc' => 'summary',//描述
				'msg_link' => 'content_url',//文章链接
				'msg_cdn_url' => 'frame',//封面图片链接
			];
	$basicInfo = [
		'author' => '',
		'copyright_stat' => '',
	];
	foreach ($item as $k => $v) {
		$pattern = '/'.$k.'\s*=\s*(\'|")(.*?)(\'|")/s';
		preg_match_all($pattern,$content,$matches);
		if(array_key_exists(1, $matches) && !empty($matches[2][0])){
			$basicInfo[$v] = $this->htmlTransform($matches[2][0]);
		}else{
			$basicInfo[$v] = '';
		}
	}
	if($basicInfo['frame']){
		$spider = $this->core->load_module('spider');
		$basicInfo['frame'] = $spider->capture_attachment($basicInfo['frame']);
	}
	/** 获取作者 */
	preg_match('/<span class="rich_media_meta rich_media_meta_text">(.*?)<\/span>/s', $content, $matchAuthor);
	if(!empty($matchAuthor[1])) $basicInfo['author'] = $matchAuthor[1];
	/** 文章类型 */
	preg_match('/<span id="copyright_logo" class="rich_media_meta meta_original_tag">(.*?)<\/span>/s', $content, $matchType);
	if(!empty($matchType[1])) $basicInfo['copyright_stat'] = $matchType[1];

	return $basicInfo;
}
/**
 * 特殊字符转换
 * @param  $string
 * @return $string
 */
function htmlTransform($string)
{
	$string = str_replace('&quot;','"',$string);
	$string = str_replace('&amp;','&',$string);
	$string = str_replace('amp;','',$string);
	$string = str_replace('&lt;','<',$string);
	$string = str_replace('&gt;','>',$string);
	$string = str_replace('&nbsp;',' ',$string);
	$string = str_replace("\\", '',$string);
	return $string;
}
/*
 * 过滤样式
 */
function clearHtml($content)
{
	$content = preg_replace("/<a[^>]*>/i", "", $content);
	@$content = preg_replace("/<\/a>/i", "", $content);
	$content = preg_replace("/<div[^>]*>/i", "", $content);
	@$content = preg_replace("/<\/div>/i", "", $content);
	$content = preg_replace("/<!--[^>]*-->/i", "", $content);//注释内容
	$content = preg_replace("/style=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/class=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/id=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/lang=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/width=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/height=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/border=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/face=.+?['|\"]/i", '', $content);//去除样式
	$content = preg_replace("/face=.+?['|\"]/", '', $content);//去除样式 只允许小写 正则匹配没有带 i 参数
	$content = preg_replace("/<iframe[^>]*>/i", '', $content);//去除视频
	$content = preg_replace("/<\/iframe>/i", '', $content);//去除视频
	return $content;
}
}

