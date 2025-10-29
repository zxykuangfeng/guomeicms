<?php
defined('PHP168_PATH') or die();

//P8_Forms::import($post, $oname)
	$oname = str_replace(array("./","../",".\\","..\\","..","\\"),'',$oname);
	//模型数据以及字段
	$path = $this->path .'#export/'. $oname .'/';
	
	if(!is_dir($path)){
		return false;
	}
	$lists = array('GBK', 'UTF-8',);
	$data = include $path .'#data.php';
	$str = file_get_contents($path .'#data.php');
	foreach ($lists as $items) {
		$tmp = convert_encode($items,'UTF-8',$str);
		if (md5($tmp) == md5($str)) {
			if($items == 'GBK') $data = convert_encode('GBK','UTF-8',$data);
		}
	}
	$fields = $data['#fields'];
	unset($data['#fields']);
	if($post['template']){
		$tp = $post['template'];
		$tp['post_template'] && $post['post_template'] = $data['post_template'];
		$tp['list_template'] && $post['list_template'] = $data['list_template'];
		$tp['view_template'] && $post['view_template'] = $data['view_template'];
	}
	unset($post['template']);
	$post['config'] = $data['config'];
	//直接添加
	$_path = CACHE_PATH .'tmp/forms_model_import/'. $oname .'/';
	if($mid = $this->add_model($post)){
		$this->set_model($mid);
		$tmp = convert_encode('GBK', 'UTF-8', $fields);	//转换编码		
		if($fields['alias'] != $tmp['alias']){
			$fields = convert_encode('GBK', 'UTF-8', $fields);	//转换编码	
		}
		foreach($fields as $k =>$v){
			$v['model'] = $post['name'];
			$this->add_field($v);
		}
		
		$_path = CACHE_PATH .'tmp/forms_model_import/'. $oname .'/';
		cp($path, $_path);
		foreach($this->core->CONFIG['templates'] as $template => $alias){
			if(!$post['post_template'])rm($_path.'template/'.$template.'/core/'.$this->name.'/tpl/'.$data['post_template'].'.html');
			if(!$post['list_template'])rm($_path.'template/'.$template.'/core/'.$this->name.'/tpl/'.$data['list_template'].'.html');
			if(!$post['view_template'])rm($_path.'template/'.$template.'/core/'.$this->name.'/tpl/'.$data['view_template'].'.html');
		}
		if(is_dir($_path.'modules/'.$this->name.'/model/'. $oname .'/')){
			cp($_path.'modules/'.$this->name.'/model/'. $oname .'/', $_path.'modules/'.$this->name.'/model/'. $post['name'] .'/');
			rm($_path.'modules/'.$this->name.'/model/'. $oname .'/');
		}
		//不再转换
		//require_once PHP168_PATH .'inc/install.func.php';		
		//convert_file_encode($_path, 'gbk', $this->core->CONFIG['page_charset'], '.js|.css|.html|.php');
		
		//把所有文件覆盖到根目录即可
		cp($_path, PHP168_PATH);
		rm($_path);
		rm(PHP168_PATH .'#data.php');
	}
	
	return $mid;

