<?php
defined('PHP168_PATH') or die();

if(REQUEST_METHOD == 'GET'){

	//load_language($this_plugin, 'global');	//加载语言包
	$job = isset($_GET['job'])? $_GET['job'] : '';
	if(!$job){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$page = max(1, $page);
		$page_url = $this_url .'?plugin=schedul&page=?page?';
		$page_param= array();		
		$select = select();
		$select->from($this_plugin->table, '*');
		$date_times = $dcode = $name = '';
		if(!empty($_GET['date'])){
			$date = $_GET['date'];
			$select->in('date',$date);
			$page_param['date'] = $date;
		}
		if(!empty($_GET['date_time'])){
			$date_times = $_GET['date_time'];
			$select->in('date_time',$date_times);
			$page_param['date_time'] = $date_times;
		}
		if(!empty($_GET['dcode'])){
			$dcode = $_GET['dcode'];
			$select->in('dcode',$dcode);
			$page_param['dcode'] = $dcode;
		}
		if(!empty($_GET['name'])){
			$name = $_GET['name'];
			$select->like('name',$name);
			$page_param['name'] = $name;
		}
		$select->order('date DESC, list_order ASC, id ASC');
		$count = 0;
		$list = $core->list_item(
			$select,
			array(
				'page' => &$page,
				'count' => &$count,
				'page_size' => 20
			)
		);
		
		if($page_param){
			$page_param = http_build_query($page_param);
			$page_url .=(strpos($page_url,'?')===false? '?':'&').$page_param;
		}
		
		$pages = list_page(array(
				'count' => $count,
				'page' => $page,
				'page_size' => 20,
				'url' => $page_url
			));
		$config=$this_plugin->get_config(false);
		$department = $date_time = array();
		foreach($config['date_time'] as $v){
			$date_time[$v['code']] = $v['name'];
		}
		foreach($config['department'] as $v){
			$department[$v['code']] = $v['name'];
		}		
		include $this_plugin->template('index');
		exit;
	}else if($job=='cache'){
		$this_plugin->_cache();
	}else if($job=='add'){
		$config=$this_plugin->get_config(false);
		$config_json = p8_json($config);
		include $this_plugin->template('add');
		exit;
	}else if($job=='import'){
		$datalist = array(
			'date' => array('alias'=>'日期'),
			'date_time' => array('alias'=>'时段'),
			'name' => array('alias'=>'姓名'),
			'level' => array('alias'=>'职称/职务'),
			'dcode' => array('alias'=>'部门'),
			'phone' => array('alias'=>'电话'),
			'event' => array('alias'=>'备注说明'),			
		);		
		include $this_plugin->template('import');
		exit;
	}else if($job=='edit'){
		$id = isset($_GET['id'])?intval($_GET['id']):0;
		$row = $this_plugin->get_data($id);
		$config=$this_plugin->get_config(false);
		include $this_plugin->template('add');
		exit;
	}else if($job=='config'){
		$config=$this_plugin->get_config(false);
		include $this_plugin->template('config');
		exit;
	}
	message('done',$this_url.'?plugin=schedul');
	
}elseif(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$do=isset($_POST['do'])? $_POST['do']:'';
	if($do=='config'){
		$department = isset($_POST['department']) && is_array($_POST['department']) ? $_POST['department'] : array();
		$date_time = isset($_POST['date_time']) && is_array($_POST['date_time']) ? $_POST['date_time'] : array();
		
		$delete = isset($_POST['delete'])? $_POST['delete'] : array();
		$delete_time = isset($_POST['delete_time'])? $_POST['delete_time'] : array();
		$data = array();
		foreach($department['code'] as $k=>$v){
			$data['department'][$k]['code'] = $v;
			$data['department'][$k]['name'] = $department['name'][$k];
		}
		if(!empty($delete)){
			foreach($delete as $v){
				unset($data['department'][$v]);
			}
		}
		foreach($date_time['code'] as $k=>$v){
			$data['date_time'][$k]['code'] = $v;
			$data['date_time'][$k]['name'] = $date_time['name'][$k];
		}
		if(!empty($delete_time)){
			foreach($delete_time as $v){
				unset($data['date_time'][$v]);
			}
		}		
		$this_plugin->set_config($data);		
		$this_plugin->_cache();
		message('done',$this_url.'?plugin=schedul&job=config',2);
	}else if($do=='order'){
		$listorder = isset($_POST['listorder'])?$_POST['listorder']:array();
		foreach($listorder as $key=>$id){
			$this_plugin->update($id,array('list_order'=>$key));
		}
		message('done',$this_url.'?plugin=schedul',2);
	}else if($do=='delete'){
		$id = isset($_POST['id'])?intval($_POST['id']):0;
		$this_plugin->delete($id);
		message('done',$this_url.'?plugin=schedul',2);
	}else if($do=='deleteitems'){
		$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
		$id or exit('[]');
		$this_plugin->delete($id);
		exit(jsonencode($id));		
	}
	else if($do=='import'){
		$_POST = p8_stripslashes2($_POST);			
		require_once PHP168_PATH.'inc/PHPExcel/IOFactory.php';
		isset($_FILES['csv_file']) or message('error');		
		//加载excel文件    
		// 获取上传文件对应的字典（对象
		$fileInfo = $_FILES["csv_file"];
		// 获取上传文件的名称
		$fileName = p8_filter_special_chars(clear_special_char($fileInfo["name"],true));		
		
		$allowedTypes = array('xlsx', 'xls'); // 允许的文件类型
		$maxSize = 10 * 1024 * 1024; // 最大文件大小（10MB）

		// 检查文件类型
		$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		if ($fileType != 'xlsx' && $fileType != 'xls') {
			message('error3');
		}
		// 检查文件大小
		if ($_FILES["import_file"]["size"] > $maxSize) {
			message('error2');
		}
		// 获取上传文件保存的临时路径
		$filePath = $fileInfo["tmp_name"];
		$filename = CACHE_PATH ."/plugin/".$fileName;		
		$uploaded = move_uploaded_file($filePath, $filename);	
		if(!$uploaded) {
			message('error5');
		}
		$objPHPExcelReader = PHPExcel_IOFactory::load($filename);    
	  
		$reader = $objPHPExcelReader->getWorksheetIterator();  	
		//循环读取sheet  
		foreach($reader as $sheet) {  
			//读取表内容  
			$content = $sheet->getRowIterator();  		
			//逐行处理  
			//$res_arr = array();  
			foreach($content as $key => $items) {  
				  
				 $rows = $items->getRowIndex();              //行  
				 $columns = $items->getCellIterator();       //列  
				 $row_arr = array();  
				 //确定从哪一行开始读取  
				 if($rows < 2){  
					 continue;  
				 }  
				 //逐列读取  
				 foreach($columns as $head => $cell) {  
					 //获取cell中数据  
					 $data = $cell->getValue();  
					 $row_arr[] = $data;  
				 }  
				 $res_arr[] = $row_arr;  
			}  
			  
		}
		$fields = isset($_POST['fields'])? $_POST['fields'] : array();		
		$line = isset($_POST['line'])? intval($_POST['line']) : 0;		
		foreach($res_arr as $key => $val){
			if($key < $line)continue;
			//构建data
			$data = array();
			foreach($fields as $field=>$fid){
				if($fid=='')continue;				
				$data[$field] = $val[$fid];
			}
			//$this_plugin->add(convert_encode('gbk','utf-8',$data));
			$this_plugin->add($data);
		}
		$this_plugin->_cache();
		//删除导入源文件
		rm(PHP168_PATH.$fileName,true);
		message('done',$this_url.'?plugin=schedul',2);
	}else if($do=='add'){
		$dates = isset($_POST['date'])?$_POST['date']:array();
		$date_time = isset($_POST['date_time'])?$_POST['date_time']:array();
		$name = isset($_POST['name'])?$_POST['name']:array();
		$level = isset($_POST['level'])?$_POST['level']:array();
		$phone = isset($_POST['phone'])?$_POST['phone']:array();
		$event = isset($_POST['event'])?$_POST['event']:array();
		$dcode = isset($_POST['dcode'])?$_POST['dcode']:array();
		foreach($dates as $key=>$date){
			if(!$date || !$name[$key])continue;
			$this_plugin->add(array(
				'date'=>$date,
				'name'=>$name[$key],
				'date_time'=>isset($date_time[$key])?$date_time[$key]:0,
				'level'=>$level[$key],
				'phone'=>$phone[$key],
				'event'=>$event[$key],
				'dcode'=>$dcode[$key],
			));
		}
		$this_plugin->_cache();
		message('done',$this_url.'?plugin=schedul',2);
	}else if($do=='edit'){
		$id = isset($_POST['id'])?intval($_POST['id']):0;
		$dates = isset($_POST['date'])?$_POST['date']:array();
		$date_time = isset($_POST['date_time'])?$_POST['date_time']:array();
		$name = isset($_POST['name'])?$_POST['name']:array();
		$level = isset($_POST['level'])?$_POST['level']:array();
		$phone = isset($_POST['phone'])?$_POST['phone']:array();
		$event = isset($_POST['event'])?$_POST['event']:array();
		$dcode = isset($_POST['dcode'])?$_POST['dcode']:array();
		foreach($dates as $key=>$date){
			if(!$date || !$name[$key])continue;
			$this_plugin->update($id,array(
				'date'=>$date,
				'name'=>$name[$key],
				'date_time'=>isset($date_time[$key])?$date_time[$key]:0,
				'level'=>$level[$key],
				'phone'=>$phone[$key],
				'event'=>$event[$key],
				'dcode'=>$dcode[$key],
			));
		}
		$this_plugin->_cache();
		message('done',$this_url.'?plugin=schedul',2);
	}
}
