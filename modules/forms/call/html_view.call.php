<?php
defined('PHP168_PATH') or die();

//P8_Forms::html($_mid_,$id)
	if(empty($_mid_)) return false;
	
	if(empty($this->CONFIG['htmlize'])) return false;
	foreach($GLOBALS as $k => $v){
		global $$k;
	}
	global $this_model;
	require_once PHP168_PATH .'inc/html.func.php';
	defined('P8_GENERATE_HTML') or define('P8_GENERATE_HTML', true);
	$_mid_ = isset($_mid_) ? filter_int($_mid_) : array();
	$this->_html['query'] = $this->DB_slave->query("SELECT * FROM $this->model_table WHERE id IN (". implode(',', $_mid_) .")");	
	$__tmp__ = $this->CONFIG['htmlize'];
	$this->CONFIG['htmlize'] = 1;
	$page_size = 20;
	$where = 'verified = 1';
	$only_id = isset($only_id) ? intval($only_id) : 0;
	while($__data__ = $this->DB_slave->fetch_array($this->_html['query'])){		
		$this_table = $this->table;
		$where = $only_id ? $where ." and id =$only_id" : $where." and mid = ".$__data__['id'];
		$ret = $this->DB_slave->query("SELECT * FROM $this_table where $where");
		while($__datas__ = $this->DB_slave->fetch_array($ret)){		
			$_REQUEST['mid'] = $__datas__['mid'];
			$_SERVER['_REQUEST_URI'] = '/index.php/'. $MODULE .'-view-id-'.$__datas__['id'];
			$__datas__['name'] = $__data__['name'];
			$this->_html['file'] = p8_html_url($this, $__datas__, 'view');
			$this->_html['file'] = preg_replace('/#([^#]+)#/', '\1', $this->_html['file']);
			$this->_html['file'] = str_replace('/html//', '/html/'.$__data__['name'].'/', $this->_html['file']);
			$this->_html['file'] = str_replace('//', '/', $this->_html['file']);
			$this->_html['file'] = str_replace('modules/forms/html/', 'html/', $this->_html['file']);
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
	
