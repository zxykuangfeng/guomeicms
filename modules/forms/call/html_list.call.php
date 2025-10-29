<?php
defined('PHP168_PATH') or die();

//P8_Forms::html($mid)
	if(empty($_mid_)) return false;
	if(empty($this->CONFIG['htmlize'])) return false;	
	foreach($GLOBALS as $k => $v){
		global $$k;
	}
	global $this_model;
	
	require_once PHP168_PATH .'inc/html.func.php';
	$_mid_ = isset($_mid_) ? filter_int($_mid_) : array();
	if(empty($_mid_)) return false;
	defined('P8_GENERATE_HTML') or define('P8_GENERATE_HTML', true);
	$this->_html['query'] = $this->DB_slave->query("SELECT * FROM $this->model_table WHERE id IN (". implode(',', $_mid_) .")");
	//页数
	$__perpage__ = isset($this->CONFIG['html_list_size']) ? intval($this->CONFIG['html_list_size']):5;
	$__tmp__ = $this->CONFIG['htmlize'];
	$this->CONFIG['htmlize'] = 1;
	$page_size = 20;
	while($__data__ = $this->DB_slave->fetch_array($this->_html['query'])){
		if($html_all){
			$_pages = ceil($__data__['count']/$page_size);
			$__pages__ = $__perpage__> $_pages? $_pages :$__perpage__;
		}else{
			$__pages__ = ceil($__data__['count']/$page_size);
		}
		for($page = 1;$page<=ceil($__data__['count']/$page_size);$page++){
			$_REQUEST['mid'] = $__data__['id'];
			$_SERVER['_REQUEST_URI'] = '/index.php/'. $SYSTEM .'/'. $MODULE .'-list-mid-'.$_REQUEST['mid'].'-page-'.$page;			
			$this->_html['file'] = p8_html_url($this, $__data__, 'list',$page==1?true:false);
			$this->_html['file'] = preg_replace('/#([^#]+)#/', '\1', $this->_html['file']);
			$this->_html['file'] = str_replace('//', '/', $this->_html['file']);
			$this->_html['file'] = str_replace('modules/forms/html/', 'html/', $this->_html['file']);
			$this->_html['file'] = str_replace('?page?', $page, $this->_html['file']);
			$basename = basename($this->_html['file']);		
			$path = str_replace($basename, '', $this->_html['file']);
			md($path);
			@chmod($path, 0755);
			ob_start();
			require PHP168_PATH .'index.php';
			$__content__ = ob_get_clean();		
			write_file($this->_html['file'], $__content__);
			@chmod($this->_html['file'], 0644);
		}
	}
	$this->CONFIG['htmlize'] = $__tmp__;
	
	return true;
