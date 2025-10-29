<?php
defined('PHP168_PATH') or die();

class P8_Sites_farm_Controller extends P8_Controller{

function __construct(&$obj){
	parent::__construct($obj);
	
}


/**
* 添加一个模型
**/
function add(&$POST){
	
	$data = $this->valid_data($POST);
	$data['timestamp'] = P8_TIME;
	return $this->model->add($data);
}

/**
* 修改一个模型
* @param string $name 模型名称
* @param array $POST 数据
**/
function update(&$POST){
	
	$data = $this->valid_data($POST);
	$alias = $data['alias'];
	//模型名不允许修改
	unset($data['alias']);
	
	return $this->model->update($alias, $data);
}


/**
* 验证是否是正确的模型名,字段名,必须以字母开头
* @param string $name
**/
function valid_name($name){
	return preg_replace('/[^0-9a-zA-Z_]/', '', $name);
}

/**
* 验证模型数据
* @param array $POST
**/
function valid_data(&$POST){
	global $USERNAME;
	$data = array();
	$data['alias'] = isset($POST['alias']) ? $this->valid_name(clear_special_char($POST['alias'])) : '';
	$data['sitename'] = isset($POST['sitename']) ? html_entities($POST['sitename']) : '';
	$data['domain'] = isset($POST['domain']) ? html_entities($POST['domain']) : '';
	$data['domain'] = preg_replace('/(.*)\/$/','\1',$data['domain']);
	if($data['domain'] && (strpos($data['domain'],'http://')===false && strpos($data['domain'],'https://')===false))$data['domain'] = 'http://'.$data['domain'];
	$data['template'] = isset($POST['template']) ? html_entities($POST['template']) : '';;
	$data['status'] = empty($POST['status']) ? 0 : 1;
    $data['parent'] = empty($POST['parent']) ? 0 : intval($POST['parent']);
	$data['ipordomain'] = empty($POST['ipordomain']) ? 0 : 1;
	$data['domain'] = empty($data['ipordomain']) ? '' : $data['domain'];
	if(in_array('s.php',explode('/',$data['domain']))){
		$data['domain'] = '';
		$data['ipordomain'] = 0;
	}
	$data['config'] = $POST['config'];
    $data['config']['allow_ip']['enabled'] = isset($data['config']['allow_ip']['enabled']) ? $data['config']['allow_ip']['enabled'] : 0;
    $data['config']['allow_ip']['collectip'] = isset($data['config']['allow_ip']['collectip']) ? explode("*", trim($data['config']['allow_ip']['collectip'])) : array();
    $data['config']['allow_ip']['collectip'] = array_filter(array_map('trim',$data['config']['allow_ip']['collectip']));

    //$data['config']['allow_ip']['beginip'] = isset($data['config']['allow_ip']['beginip']) ? trim($data['config']['allow_ip']['beginip']) : '';
    //$data['config']['allow_ip']['endip'] = isset($data['config']['allow_ip']['endip']) ? trim($data['config']['allow_ip']['endip']) : '';
    $data['config']['allow_ip']['area_ip'] = isset($data['config']['allow_ip']['area_ip']) ? explode("\r\n", trim($data['config']['allow_ip']['area_ip'])) : array();
    $data['config']['allow_ip']['area_ip'] = empty($data['config']['allow_ip']['area_ip'])? array() : array_flip($data['config']['allow_ip']['area_ip']);

    $data['config']['allow_ip']['ruleoutip'] = isset($data['config']['allow_ip']['ruleoutip']) ? explode("*", trim($data['config']['allow_ip']['ruleoutip'])) : array();
    $data['config']['allow_ip']['ruleoutip'] = array_filter(array_map('trim',$data['config']['allow_ip']['ruleoutip']));
    $data['config']['stop_ip']['enabled'] = isset($data['config']['stop_ip']['enabled']) ? ($data['config']['stop_ip']['enabled'] == 1 ? 1 : 0) : 0;
    $data['config']['stop_ip']['forbidip'] = isset($data['config']['stop_ip']['forbidip']) ? explode("*", trim($data['config']['stop_ip']['forbidip'])) : array();
    $data['config']['stop_ip']['forbidip'] = array_filter(array_map('trim',$data['config']['stop_ip']['forbidip']));

    //$data['config']['stop_ip']['beginip'] = isset($data['config']['stop_ip']['beginip']) ? trim($data['config']['stop_ip']['beginip']) : '';
    //$data['config']['stop_ip']['endip'] = isset($data['config']['stop_ip']['endip']) ? trim($data['config']['stop_ip']['endip']) : '';
    $data['config']['stop_ip']['area_ip'] = isset($data['config']['stop_ip']['area_ip']) ? explode("\r\n", trim($data['config']['stop_ip']['area_ip'])) : array();
    $data['config']['stop_ip']['area_ip'] = empty($data['config']['stop_ip']['area_ip'])? array() : array_flip($data['config']['stop_ip']['area_ip']);
	$data['config']['need_password'] = isset($data['config']['need_password']) && $data['config']['need_password'] ? 1 : 0;	
	$data['config']['site_password'] = isset($data['config']['site_password']) ? html_entities($data['config']['site_password']) : '';
	$data['config']['logo'] = isset($data['config']['logo']) && $data['config']['logo'] ? attachment_url(html_entities($data['config']['logo']), true) : '';
	$data['config']['logo_1'] = isset($data['config']['logo_1']) && $data['config']['logo_1'] ? attachment_url(html_entities($data['config']['logo_1']), true) : '';
	$data['config']['logo_2'] = isset($data['config']['logo_2']) && $data['config']['logo_2'] ? attachment_url(html_entities($data['config']['logo_2']), true) : '';
	$data['config']['logo_3'] = isset($data['config']['logo_3']) && $data['config']['logo_3'] ? attachment_url(html_entities($data['config']['logo_3']), true) : '';
	$data['config']['logo_motto'] = isset($data['config']['logo_motto']) && $data['config']['logo_motto'] ? attachment_url(html_entities($data['config']['logo_motto']), true) : '';
	$data['config']['logo_header'] = isset($data['config']['logo_header']) && $data['config']['logo_header'] ? attachment_url(html_entities($data['config']['logo_header']), true) : '';
    $data['config']['logo_footer'] = isset($data['config']['logo_footer']) && $data['config']['logo_footer'] ? attachment_url(html_entities($data['config']['logo_footer']), true) : '';    	
	$data['config']['statistic_cats'] = preg_replace('/[^0-9,]/', '', $data['config']['statistic_cats']);	
	$data['config']['statistic_cats'] = empty($data['config']['statistic_cats']) ? array() : filter_int(explode(',',$data['config']['statistic_cats']));
	$data['config']['authentication_mark'] = empty($data['config']['authentication_mark']) ? 0 : 1;
	//组织架构统计
	$department = $data['config']['department'] = isset($data['config']['department']) ? intval($data['config']['department']): 0;	
	$parent_department = $data['config']['parent_department'] = isset($data['config']['parent_department'])? intval($data['config']['parent_department']): 0;
	if(empty($department) && !empty($parent_department)) $data['config']['department'] = $parent_department;	
	foreach($data['config']['statistic_cats'] as $key=>$sid){
		if(empty($this->model->system->fetch_category($sid,true))) unset($data['config']['statistic_cats'][$key]);
	}
	//读原来的配置数据
	$get_old_data = $this->model->get_site($data['alias']);		
	$old_config = mb_unserialize($get_old_data['config']);
	if($data['template'] != $get_old_data['template']){
		$template_logs = array();
		if(!empty($old_config['template_logs'])){
			$template_logs = explode('|',$old_config['template_logs']);
		}
		if(isset($template_logs[9])) unset($template_logs[9]);
		$templates = $this->model->get_sites_templates();
		//admin于2021年2月3日10:10:10,设置模板:学校风格281,别名:school281 |
		$new_log = $USERNAME."于".date('Y-m-d H:i:s',P8_TIME)."设置模板：".$templates[$data['template']]['name']."，别名：".$data['template']." |";
		$old_log = !empty($template_logs) ? implode('|',$template_logs) : '';		
		//加记录
		$data['config']['template_logs'] = $new_log.$old_log;
	}else{
		$data['config']['template_logs'] = isset($old_config['template_logs']) ? $old_config['template_logs'] : '';
	}
	$data['config'] = empty($data['config']) ? '' : serialize($data['config']);
	$data['data1'] = $data['data2'] = $data['data3'] = '';
	return $data;
}



/**
* 删除字段
* @param int $id 字段ID
**/
function delete_field($id){
	$id = filter_int($id);
	$ids = implode(',', $id);
	
	if(empty($ids)) return false;
	
	$cond = "id IN ($ids)";
	
	return $this->model->delete_field($cond);
}

function init_site($site, $init, $item){
    if($item=='category'){
         //复制栏目
        $category= &$this->model->system->load_module('category');
        $category->get_cache(true, $init);
        $this->model->init_site_category($site, $category->top_categories);
        $category->cache(false);
        return 'site';
    }elseif($item=='site'){
         $this->model->init_site($site,$init);
        return 'menu';
    }elseif($item=='menu'){
         $this->model->init_menu($site,$init);
        return 'label';
    }elseif($item=='label'){
         $this->model->init_site_label($site,$init);
        return 'item';
    } elseif($item=='item'){
        define('P8_CLUSTER',1);
        $this->model->init_site_item($site,$init);
        return 'letter';
    } elseif($item=='letter'){
        return 'done';
    }     

}

}
