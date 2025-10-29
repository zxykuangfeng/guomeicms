<?php
defined('PHP168_PATH') or die();

class P8_Forms extends P8_Module{

var $table;			//主表
var $model_table;	//模型表
var $field_table;	//字段表
var $model;			//当前模型
var $MODEL;			//当前模型名称
var $data_table;	//当前模型数据表
var $_html;

function __construct(&$system, $name){
	$this->system = &$system;
	//不可配置
	parent::__construct($name);
	
	$this->table = $this->TABLE_.'item';
	$this->model_table = $this->TABLE_.'model';
	$this->field_table = $this->TABLE_.'model_field';
	$this->delimiter = chr(7);
	$this->col_delimiter = chr(6);
	$this->_html = array();
	
	//可选的字段类型 类型 => 语言包键值
	$this->field_types = array(
		'varchar'		=> 'forms_model_field_type_varchar',
		'tinyint'		=> 'forms_model_field_type_tinyint',
		'smallint'		=> 'forms_model_field_type_smallint',
		'mediumint'		=> 'forms_model_field_type_mediumint',
		'int'			=> 'forms_model_field_type_int',
		'bigint'		=> 'forms_model_field_type_bigint',
		
		'decimal'		=> 'forms_model_field_type_decimal',
		
		'char'			=> 'forms_model_field_type_char',
		
		'text'			=> 'forms_model_field_type_text',
		'mediumtext'	=> 'forms_model_field_type_mediumtext',
		'longtext' 		=> 'forms_model_field_type_longtext'
	);
	
	//可选的输入类型
	$this->widgets = array(
		'text'			=> 'forms_model_widget_text',
		'textarea'		=> 'forms_model_widget_textarea',
		'textdate'		=> 'forms_model_widget_textdate',
		
		'radio'			=> 'forms_model_widget_radio',
		'checkbox'		=> 'forms_model_widget_checkbox',
		
		'multi_select'	=> 'forms_model_widget_multi_select',
		'select'		=> 'forms_model_widget_select',
		'link'			=> 'forms_model_widget_link',
		'uploader_basic'=> 'forms_model_widget_uploader_basic',
		'uploader'		=> 'forms_model_widget_uploader',
		'multi_uploader_basic'=> 'forms_model_widget_multi_uploader_basic',
		'multi_uploader'=> 'forms_model_widget_multi_uploader',
		'image_uploader'=> 'forms_model_widget_image_uploader',
		'video_uploader'=> 'forms_model_widget_video_uploader',
		'photo_uploader'=> 'forms_model_widget_photo_uploader',
		'multi_edu'		=> 'forms_model_widget_multi_edu',
		'multi_family'	=> 'forms_model_widget_multi_family',
		'multi_employ'	=> 'forms_model_widget_multi_employ',
		
		'editor'		=> 'forms_model_widget_editor',
		'editor_basic'	=> 'forms_model_widget_editor_basic',
		'editor_common'	=> 'forms_model_widget_editor_common',
		
		'city' 			=> 'forms_model_widget_city',
		
		'linkage' 		=> 'forms_model_widget_linkage',
		'vscode'		=> 'forms_model_widget_vscode',
		'captcha'		=> 'forms_model_widget_captcha',
	);
}


/**
*设置当前的模型
*@param string $name 名称
**/
function set_model($name,$id=false){
	if(empty($name))return false;
	global $this_model;
	if(!preg_match('/^[a-zA-z]/', $name))$id=true;
	if($id){
		$index = $this->core->CACHE->read('core/modules', 'forms', 'index');
		if(!$index){
			$this->cache();
			$index = $this->core->CACHE->read('core/modules', 'forms', 'index');
		};
		$name = $index[$name];
	}
	$_model = $this->core->CACHE->read('core/modules', 'forms', $name, 'serialize');
	if(!$_model){
		$this->cache($name);
		$_model = $this->core->CACHE->read('core/modules', 'forms', $name, 'serialize');
	};
	if(!$_model)return false;
	unset($_model['config']);
	unset($this->model);
	$this->model = $this_model =$_model;
	$this->MODEL = $this->model['name'];
	$this->data_table = $this->table.'_'.$this->model['name'];
	return true;
}
/**
*取模型原始数据
*@param int or string $name 名称或ID,取决于第二个参数
*@param bool $id 可选,确定第一个参数是名称或ID
**/
function get_model($name,$id=false){
	$where = $id? " id = '".intval($name)."'" : " name = '$name'";
	return $this->DB_master->fetch_one("SELECT * FROM $this->model_table WHERE $where");
}

function get_models(){
    $models = $this->core->CACHE->read($this->system->name .'/modules', $this->name, 'models');

    return $models;
}
/*
* 统计模型数量
*/
function count_model(){
	$query = $this->DB_master->query("SELECT mid,count(*) as count FROM $this->table group by mid");
	while($row = $this->DB_master->fetch_array($query)){
		$id = $row['mid'];
		$this->DB_master->update(
			$this->model_table,
			array(
				'count' => $row['count']
			),
			"id = '$id'"
		);		
	}
}
/**
*取模型数据量统计
*@param int mid MID
**/
function get_model_count($mid){
	$ret = $this->DB_master->fetch_one("SELECT count(*) as count FROM $this->table WHERE mid = '$mid'");
	return $ret['count'] ? intval($ret['count']) : 0;
}
function add(&$data,$is_import = false,$is_unique = false){
	/*检测是否唯一*/
	global $this_model;
	$unique_fields = array();
	if(!$is_unique){
		foreach($this_model['fields'] as $name=>$fields){
			if($fields['CONFIG']['unique'] && in_array($name,array_keys($data['item']))){
				$unique_fields[] = $name;
				$data_check = array($name => array('data'=>$data['item'][$name]));
				$ret = $this->get_data_by_field($data_check);			
				if($ret) return array($name,$fields['alias']);
			}
		}
	}
	/*是否开启同IP频繁提交防护*/
	if(!$is_import && $this_model['CONFIG']['expire']){
		$ret = $this->get_last_data(
			array(
				'timestamp' => $data['main']['timestamp'],
				//'uid' => $data['main']['uid'],
				//'username' => $data['main']['username'],
				'mid' => $data['main']['mid'],
				'ip' => $data['main']['ip'],
			)
		);
		if($ret) return array('expire'=>intval($this_model['CONFIG']['expire']));
	}
	//插入主表取得ID
	$id = $this->DB_master->insert(
		$this->table,
		$this->DB_master->escape_string($data['main']),
		array('return_id' => true)
	);	
	if(empty($id)) return false;
	
	//收集己上传的附件
	if(!$is_import && isset($data['attachment_hash'])){
		uploaded_attachments($this, $id, $data['attachment_hash']);
		unset($data['attachment_hash']);
	}
	
	$data['item']['id'] = $id;
	$st = $this->DB_master->insert(
		$this->data_table,
		$this->DB_master->escape_string($data['item'])
	);
	if(!$st){
		$this->delete(array('ids'=>array($id)));
		return false;
	}
	//数据修改
	$this->change_count(1,'+');
	if(!$is_import){
		$this->sendMsg($id,'post');
		//是终审，则调用静态	
		if($data['main']['verified'] == 1 && $data['main']['mid']){
			$this->html_list($data['main']['mid'],false);
			$this->html_view($data['main']['mid'],$id);			
		}
	}
	return $id;
}

function update($id,&$data,$is_import = false){
	/*检测是否唯一*/
	global $this_model;
	$unique_fields = array();
	foreach($this_model['fields'] as $name=>$fields){
		if($fields['CONFIG']['unique'] && in_array($name,array_keys($data['item']))){
			$unique_fields[] = $name;
			$data_check = array('id'=> array('data'=>$id,'not'=>1),$name => array('data'=>$data['item'][$name]));
			$ret = $this->get_data_by_field($data_check);			
			if($ret) return array($name,$fields['alias']);
		}
	}
	$status = true;
	//收集己上传的附件
	if(!$is_import && isset($data['attachment_hash'])){
		uploaded_attachments($this, $id, $data['attachment_hash']);
		unset($data['attachment_hash']);
	}
	$status |= $this->DB_master->update(
		$this->table,
		$this->DB_master->escape_string($data['main']),
		"id = '$id'"
	);
	$status |=	$this->DB_master->update(
		$this->data_table,
		$this->DB_master->escape_string($data['item']),
		"id = '$id'"
	);
	if(!$is_import && $status) $this->sendMsg($id,'update');
	//是终审，则调用静态
	if(!$is_import && $data['main']['verified'] == 1 && $data['main']['mid']){
		$this->html_list($data['main']['mid'],false);
		$this->html_view($data['main']['mid'],$id);			
	}
	return $status;
}

/**
*取一条数据
*@param array
*@return bool 
**/
function get_last_data($check){
	global $this_model;
	if($check['ip'] == 'unknown') return false;	
	if($this_model['CONFIG']['expire']){
		$where = '';
		$dom = '';		
		foreach($check as $key=>$val){
			if($key == 'timestamp') continue;
			if(empty($val)) continue;
			$where .= $dom.$key." = '".$val."'";
			$dom = " and ";
		}
		$sql = "SELECT * FROM $this->table WHERE $where order by timestamp desc limit 1";
		$data = $this->DB_master->fetch_one($sql);
		if(!empty($data) && ($check['timestamp'] - $data['timestamp']<= intval($this_model['CONFIG']['expire']))){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function delete($data){

	$this->DB_master->delete(
			$this->table,
			"id in(".implode(",",$data['ids']).")"
	);
	$this->DB_master->delete(
			$this->data_table,
			"id in(".implode(",",$data['ids']).")"
	);
	//数据修改
	$this->change_count(count($data['ids']),'-');
	return $data['ids'];
}

function unimport_data($start_id,$end_id){
	$start_id = intval($start_id);
	$end_id = intval($end_id);
	if(!$start_id || !$end_id){
		return 0;
	}
	$ret = $this->DB_master->delete(
			$this->table,
			"`id` >=$start_id and `id` <=$end_id"
	);
	$ret2 = $this->DB_master->delete(
			$this->data_table,
			"`id` >=$start_id and `id` <=$end_id"
	);
	//数据修改
	$this->change_count($ret,'-');
	return $ret;
}
/**
*取一条数据
*@param int $id ID
*@param string $name 模型名称
*@return array 返回查询结果
**/
function get_data($id,$name=''){
	if(!$name)
		return $this->DB_master->fetch_one("SELECT * FROM $this->table WHERE id = '$id'");
	else
		return $this->DB_master->fetch_one("SELECT i.*, d.* FROM $this->table AS i LEFT JOIN $this->data_table AS d ON i.id = d.id WHERE i.id = '$id'");
}
/**
*取一条数据
*@param string $data 字段数据
*@return array 返回查询结果
**/
function get_data_by_field($data){
	if(empty($data)) return '';
	$where = '1=1';
	foreach($data as $field => $ds){
		$fdata = $ds['data'];
		if(isset($ds['not']) && $ds['not']) 
			$where .= " and `$field` != '$fdata'";
		else
			$where .= " and `$field` = '$fdata'";		
	}
	$sql = "SELECT * FROM $this->data_table WHERE $where";
	return $this->DB_master->fetch_one("SELECT * FROM $this->data_table WHERE $where");
}

function status($data){
	$this->DB_master->update(
			$this->table,
			$this->DB_master->escape_string(array(
				'status' => $data['status'],
				'recommend' => $data['recommend'],
				'reply' => $data['reply'],
				'replyer' => $data['replyer'],
				'reply_time' => P8_TIME
			)),
			"id in($data[ids])"
		);
		return $this->DB_master->fetch_all("SELECT id, status,reply, reply_time FROM $this->table WHERE id IN($data[ids]) ");
}

function p8_status($data){
	$this->DB_master->update(
			$this->table,
			$this->DB_master->escape_string(array(
				'p8_status' => $data['status'],
				'p8_reply' => $data['reply'],
				'p8_replyer' => $data['replyer'],
				'p8_reply_time' => P8_TIME
			)),
			"id in($data[ids])"
		);
		return $this->DB_master->fetch_all("SELECT id, p8_status,p8_reply, p8_reply_time FROM $this->table WHERE id IN($data[ids]) ");
}
function get_statuses(){
	$query = $this->DB_master->fetch_all("SELECT id,name FROM $this->model_table");
	$statuses = array();
	foreach($query as $key => $rs){
		$this_model = $this->core->CACHE->read('core/modules', 'forms', $rs['name'], 'serialize'); 
		$statuses[$rs['id']] = $this_model['CONFIG']['status'];
	}
	return $statuses;
}

function display($data){
	$this->DB_master->update(
		$this->table,
		array(
			'display' => abs(1-$data['ov'])
		),
		"id in($data[ids])"
	);
	
	return $this->DB_master->fetch_all("SELECT id, display FROM $this->table WHERE id IN($data[ids]) ");
}

function verify($data){
	
	$verified = $data['value'];
	
	$this->DB_master->update(
		$this->table,
		array(
			'verified' => $verified
		),
		$data['where']
	);
	//是终审，则调用静态
	if($verified == 1 && $data['mid']){		
		$this->html_list($data['mid'],false);
		foreach($data['id'] as $_id){
			$this->html_view($data['mid'],$_id);
		}		
	}
	return $data['id'];
}

/**
* 格式化数据
* @param array $data
**/
function format_data(&$data, $length=0){

	foreach($this->model['fields'] as $field => $v){
		
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
		case 'editor': case 'editor_basic': case 'editor_common':case 'ueditor': case 'ueditor_common': case 'photo_uploader': case 'uploader_basic':
			$data[$field] = attachment_url($data[$field]);
		break;
		
		case 'uploader': case 'image_uploader':
			$tmp = explode($this->delimiter, attachment_url($data[$field]));
			$data[$field] = array(
				'title' => $tmp[0],
				'url' => isset($tmp[1]) ? $tmp[1] : '',
				'thumb' => isset($tmp[2]) ? $tmp[2] : ''
			);
		break;
		
		//多上传器
		case 'multi_uploader_basic':
			$tmp = explode($this->delimiter, attachment_url($data[$field]));
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'title' => $v[0],
					'url' => isset($v[1]) ? $v[1] : ''
				);
			}
			unset($tmp);
		break;
		
		//多上传器
		case 'multi_uploader':
			$tmp = explode($this->delimiter, attachment_url($data[$field]));
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'title' => $v[0],
					'url' => isset($v[1]) ? $v[1] : '',
					'thumb' => isset($v[2]) ? $v[2] : ''
				);
			}
			unset($tmp);
		break;
		
		//教育经历
		case 'multi_edu':
			$tmp = explode($this->delimiter, $data[$field]);
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'date_attended_from' => isset($v[0]) ? $v[0] : '',
					'date_attended_to' => isset($v[1]) ? $v[1] : '',
					'schoolname' => isset($v[2]) ? $v[2] : '',
					'diploma_received' => isset($v[3]) ? $v[3] : '',
					'fieldofstudy' => isset($v[4]) ? $v[4] : '',					
				);
			}
			unset($tmp);
		break;
		//工作简历
		case 'multi_employ':
			$tmp = explode($this->delimiter, $data[$field]);
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'date_attended_from' => isset($v[0]) ? $v[0] : '',
					'date_attended_to' => isset($v[1]) ? $v[1] : '',
					'employer' => isset($v[2]) ? $v[2] : '',
					'position' => isset($v[3]) ? $v[3] : '',
				);
			}
			unset($tmp);
		break;
		//家庭成员
		case 'multi_family':
			$tmp = explode($this->delimiter, $data[$field]);
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'members' => isset($v[0]) ? $v[0] : '',
					'name' => isset($v[1]) ? $v[1] : '',
					'phone' => isset($v[2]) ? $v[2] : '',
					'email' => isset($v[3]) ? $v[3] : '',
					'employer' => isset($v[4]) ? $v[4] : '',
					'position' => isset($v[5]) ? $v[5] : '',
				);
			}
			unset($tmp);
		break;
		//case 'link':
		//	$data[$field] = preg_match("/^(http|https)/i",$data[$field])? $data[$field] : 'http://'.$data[$field];
		case 'link':
            if(strpos($data[$field], '|')){
                $linktemp = explode('|', $data[$field]);
                $data[$field] = array('txt'=>$linktemp[0], 'url'=>$linktemp[1]);
                !empty($linktemp[2]) && $data[$field]['target']=$linktemp[2];
            }else{
                $data[$field] = preg_match("/^(http|https)/i",$data[$field])? $data[$field] : 'http://'.$data[$field];
            }
        
        break;
		//时间选择器
		case 'textdate':
			$data[$field] = empty($data[$field]) ? '' : ($v['CONFIG']['full'] ? date('Y-m-d H:i:s',$data[$field]) : date('Y-m-d',$data[$field]));
		break;
		}
		$length && $data[$field] = p8_cutstr($data[$field], $length,'');//为标签而作
	}
	
}


/**
* 格式化数据
* @param array $data
**/
function format_view(&$data){

	foreach($this->model['fields'] as $field => $v){
		
		if(!isset($data[$field])) continue;
		
		switch($v['widget']){
		
			//城市
			case 'city':
				$area = area();
				$area->get_cache();
				$ps = $area->get_parents($data[$field]);
				$data[$field] = $area->areas[$data[$field]]['name'];
				$_a = '';
				foreach($ps as $k =>$v){
					$_a .= $v['name'].'>';
				}
				$data[$field] = $_a.$data[$field];
			break;
			case 'textarea':
			$data[$field] = nl2br($data[$field]);
			break;
			case 'linkage':
				$values = explode('-',$data[$field]);
				$resust = array();
				$filedata = mb_unserialize($v['data']['select_data']);
				foreach($values as $key=>$val){
					if($key==0)
						$filedata = !empty($filedata[$val])? $filedata[$val] : array();
					else
						$filedata = !empty($filedata['s'][$val])? $filedata['s'][$val] : array();;
					if($val && !empty($filedata))$resust[$val] = $filedata['n'];
				}
				$data[$field] = $resust;
			break;
		}
	}


}

/**
* 添加一个模型
* @param string $name 模型名称(唯一)
* @param string $alias 模型别名
* @return int 返回的ID
**/
function add_model(&$data){
	return include $this->path .'call/add_model.call.php';
}

function update_model($id,$data){
	$model_data = $this->get_model($id,true);
	$config = mb_unserialize($model_data['config']);
	if(empty($data['config']['status'])) unset($config['status']);
	$data['config'] = array_merge($config,$data['config']);
	$data['config'] = $this->DB_master->escape_string(serialize($data['config']));
	if(
		$status = $this->DB_master->update(
			$this->model_table,
			$data,
			"id = '$id'"
		)
	){
		
		$this->cache($id);
	}
	return $status;
}

function getElementsInRange($arr, $start, $end) {
  if ($start<0 || $start == $end || $start>$end) {
    return $arr;
  }

  $counter = 0;
  $result = [];

  foreach ($arr as $key=>$element) {
    $counter++;
	if ($counter >= $start && $counter <= $end) {
      $result[] = $element;
    }
  }

  return $result;
}


// 求平均值
function calculateAverage($arr) {
    $sum = array_sum($arr);
    $count = count($arr);
    return round($sum / $count,2);
}
// 求计数
function countNonEmptyValues($array) {
  $count = 0;
  foreach ($array as $value) {
   if ($value !== null && $value !== '') {
      $count++;
    }
  }
  return $count;
}
// 求和
function calculateArraySum($array) {
  $sum = 0;
  foreach ($array as $value) {
    $sum += $value;
  }
  return round($sum,2);
}
// 按类别计数
function countByCategory($arr) {
    $countArr = array();
    foreach ($arr as $value) {
        if (isset($countArr[$value])) {
            $countArr[$value]++;
        } else {
            $countArr[$value] = 1;
        }
    }
    return $countArr;
}

// 求中位数
function calculateMedian($arr) {
    sort($arr);
    $count = count($arr);
    $middle = floor(($count - 1) / 2);
    if ($count % 2 == 0) {
        $median = ($arr[$middle] + $arr[$middle + 1]) / 2;
    } else {
        $median = $arr[$middle];
    }
    return round($median,2);
}

// 求众数
function calculateMode($arr) {
    $countArr = array_count_values($arr);
    $maxCount = max($countArr);
    $modes = array();
    foreach ($countArr as $key => $value) {
        if ($value == $maxCount) {
            $modes[] = $key;
        }
    }
    return $modes;
}

// 求极差
function calculateRange($arr) {
    return max($arr) - min($arr);
}

// 求方差
function calculateVariance($arr) {
    $mean = $this->calculateAverage($arr);
    $variance = 0;
    foreach ($arr as $value) {
        $variance += pow($value - $mean, 2);
    }
    $variance /= count($arr);
    return round($variance,2);
}

// 求标准差
function calculateStandardDeviation($arr) {
    $variance = $this->calculateVariance($arr);
    return round(sqrt($variance),2);
}


function update_model_config($id,$data){
	$app_id = $data['app'] ? 'p8_echart_app_'.intval($data['app']) : 'p8_echart_app_1';
	foreach($data as $key=>$v){
		if($key != 'mid') $data[$app_id]['p8_charts_'.$key] = $v;
		unset($data[$key]);
	}
	
	$model_data = $this->get_model($id,true);	
	$config = mb_unserialize($model_data['config']);
	//先清空系统原来的配置项
	$config[$app_id]['p8_charts_field#'] = array();
	$_data = array_merge($config,$data);
	$datas['config'] = $this->DB_master->escape_string(serialize($_data));
	if(
		$status = $this->DB_master->update(
			$this->model_table,
			$datas,
			"id = '$id'"
		)
	){
		
		$this->cache($id);
	}
	return $status;
}
function export($mid){
	return include $this->path .'call/export.call.php';
}
/**
* 导入模型
* @param string $name 模型的名称
* @param string $alias POST的模型别名
* @return int add方法返回的值
**/
function import($post, $oname){
	return include $this->path .'call/import.call.php';
}

function delete_model($mid){
	$this->set_model($mid,true);
	//删除数据
	$this->DB_master->delete(
		$this->table,
		"mid='$mid'"
	);
	//删除字段
	$filds = $this->DB_master->fetch_all("SELECT * FROM $this->field_table WHERE model = '$this->MODEL'");
	if(is_array($filds)){
		foreach($filds as $field){
			$this->delete_field($field['id']);
		}
	
	}
	//删除模型
	$this->DB_master->delete(
		$this->model_table,
		"id='$mid'"
	);
	//删除数据表
	$this->DB_master->query("DROP TABLE `$this->data_table`");	
	return $mid;	
}

/**
* 为模型增加一个字段
* @param int $mid 模型ID
* @param string $name 字段名称(唯一)
* @param string $alias 字段别名
* @param string $type 字段类型
* @param int $length 字段长度
* @param bool $is_unsigned 非负数
* @param string $widget 输入方式
* @param int $display_order 排序
* @return int 返回的ID
**/
function add_field(&$data){
	
	empty($data['config']) && $data['config'] = array();
	empty($data['data']) && $data['data'] = array();
	$data['data'] = $this->DB_master->escape_string(serialize($data['data']));
	$is_unique = isset($data['config']['unique']) && $data['config']['unique'] ? 1 : 0;
	$data['config'] = $this->DB_master->escape_string(serialize($data['config']));
	$fieldname = $data['name'];
	if(
		$id = $this->DB_master->insert(
			$this->field_table,
			$data,
			array('return_id' => true)
		)
	){
		
		$field = $this->field_sql($data);
		
		$status = $this->DB_master->query("ALTER TABLE $this->data_table ADD `$fieldname` $field");
		if($is_unique) $this->DB_master->query("ALTER TABLE $this->data_table ADD UNIQUE ($fieldname)");
		$this->cache($this->model['id']);
	}
	
	return $id;
}


/**
* 修改一个字段,参数基本同add_field
* @return bool
**/
function update_field($id, &$data){
	$data['data'] = $this->DB_master->escape_string(serialize($data['data']));
	$is_unique = isset($data['config']['unique']) && $data['config']['unique'] ? 1 : 0;
	$config = $data['config'];
	$data['config'] = $this->DB_master->escape_string(serialize($data['config']));
	$fielddb = $this->get_field($id);
	$fieldname = $fielddb['name'];
	$olddata['config'] = mb_unserialize($fielddb['config']);
	//不允许修改模型,字段存放表
	unset($data['model']);
	unset($data['name']);	
	if(
		$status = $this->DB_master->update(
			$this->field_table,
			$data,
			"id = '$id'"
		)
	){
		$field = $this->field_sql($data);		
		$status = $this->DB_master->query("ALTER TABLE $this->data_table CHANGE `$fieldname` `$fieldname` $field");		
		if($is_unique){			
			if(!isset($olddata['config']['unique']) || $olddata['config']['unique'] != $is_unique){
				$unique_status = $this->DB_master->query("ALTER TABLE $this->data_table ADD UNIQUE ($fieldname)");
				if(!$unique_status){
					$data['config'] = $config;
					$data['config']['unique'] = 0;
					$data['config'] = $this->DB_master->escape_string(serialize($data['config']));
					$this->DB_master->update(
						$this->field_table,
						$data,
						"id = '$id'"
					);
				}
			}
		}else{
			if($olddata['config']['unique']){
				$this->DB_master->query("ALTER TABLE $this->data_table DROP INDEX $fieldname");
			}
		}
		
		$this->cache($this->model['id']);
	}
	//return $status;
}

/**
* 修改一个字段,只修改与字段类型无关的资料
* @return bool
**/
function update_field_data($id, $data){
	!empty($data['data']) && $data['data'] = $this->DB_master->escape_string(serialize($data['data']));
	!empty($data['config']) && $data['config'] = $this->DB_master->escape_string(serialize($data['config']));
	//不允许修改模型,字段存放表
	unset($data['model']);
	unset($data['type']);
	unset($data['name']);
	unset($data['not_null']);
	if(
		$status = $this->DB_master->update(
			$this->field_table,
			$data,
			"id = '$id'"
		)
	){
		$this->cache($this->model['id']);
	}
	return $status;
}

function delete_field($id){
	$field=$this->get_field($id);
	if(empty($field))return false;
	if($status = $this->DB_master->delete($this->field_table,"id='$id'")){
		$this->DB_master->query("ALTER TABLE $this->data_table DROP `$field[name]`");
		$this->cache();
		return true;
	}
	return false;
}

/**
*取模型原始数据
*@param int or string $name 名称或ID,取决于第二个参数
*@param bool $id 可选,确定第一个参数是名称或ID
**/
function get_field($id){
	return $this->DB_master->fetch_one("SELECT * FROM $this->field_table WHERE id='$id'");
}
/**
* 连接字段的SQL
**/
function field_sql(&$data){
	$field = $data['type'];
	
	switch($data['type']){
		case 'tinyint': case 'smallint': case 'mediumint': case 'int': case 'bigint': case 'decimal': case 'float': case 'double':
			
			if(!$data['length']) $data['length'] = 0;
			
			$field .= " ($data[length])";
			
			if($data['is_unsigned']){
				$field .= ' unsigned';
			}
            $field .= " DEFAULT '0'";
			
		break;
		
		case 'char': case 'varchar': 
			if(!$data['length']) $data['length'] = 0;
			
			$field .= " ($data[length])";
			$field .= " DEFAULT ''";
		break;
		
		case 'tinytext': case 'text': case 'mediumtext': case 'longtext':
			
		break;
	}
	
	if($data['not_null']){
		$field .= ' NOT NULL';
	}
	
	return $field;
}


/**
* 更新特定或所有模型的缓存
* @param string $name 要更新模型的名称, 如果传入了特定的模型名称, 则只生成特定模型的缓存
**/
function cache($name = ''){
	$this->count_model();
	parent::cache();
	return include $this->path .'call/cache.call.php';
}

/**
*修改数据量
*@param int $count
*@param string $type
*@param string $model
**/
function change_count($count, $type, $model=''){
	$M = $model? $model : $this->model['name'];
	if($type == '+'){
		$set = "count+$count";
	}elseif($type == '-'){
		$set = "count-$count";
	}
	return $this->DB_master->update(
		$this->model_table,
		array('count' => $set),
		"name = '$M'",
		false
	);
}

function html($id){
	return include $this->path .'call/html.call.php';
}

function html_list($_mid_,$html_all = false){
	return include $this->path .'call/html_list.call.php';
}

function html_view($_mid_,$only_id = 0){
	return include $this->path .'call/html_view.call.php';
}

function clean($ids){

	foreach($ids as $id)
	{
		$id = intval($id);
		if(!$id)continue;
		$model_info = $this->set_model($id,true);
	
		$this->DB_master->delete(
				$this->table,
				"mid=$id"
		);
		$this->DB_master->delete(
				$this->data_table,
				"1=1"
		);
		//数据修改
		$this->DB_master->update(
			$this->model_table,
			array('count' => '0'),
			"id = '$id'",
			false
		);
	}
}


/**
* 标签调用的数据, 接口
* @param array $LABEL 标签模块
* @param array $label 标签数据
* @param array $var 变量
**/
function label(&$LABEL, &$label, &$var){
	global $mid;
	$omid = $mid && intval($mid) ? intval($mid) : 0;
	$option = &$label['option'];
	$mid = $option['mid'];
	$this->set_model($mid);
	if(!$this->model)return false;
	$this_model = $this->model;
	if(!$this_model['enabled']){
		echo "";exit;
	}
	$option['fields'] = $option['fields']? $option['fields'] : array_keys($this_model['fields']);
	$afields = 'a.*';
	if(isset($option['fields'])){
		$afields = $dash = '';
		foreach($option['fields'] as $field){
			$afields .= $dash.'a.'.$field;
			$dash = ',';
		}
	}
	$select = select();
	$select->from($this->table .' AS i', 'i.*');
	$select->inner_join($this->data_table .' AS a', $afields, 'a.id = i.id');
    $select->in('i.display',0);
	isset($option['status']) && $select->in('i.status',$option['status']);
	if(isset($option['recommend']) && $option['recommend']>=0)$select->in('i.recommend',$option['recommend']);
	if(isset($option['date']) && $option['date']>0){
		if($option['date'] == 1){
			//获取今日开始时间戳和结束时间戳  
			$begintime=mktime(0,0,0,date('m'),date('d'),date('Y')); 
			$endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}elseif($option['date'] == 2){
		//获取近3天起始时间戳和结束时间戳  
			$begintime=mktime(0,0,0,date('m'),date('d')-2,date('Y'));
			$endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}elseif($option['date'] == 3){
			//获取近7天起始时间戳和结束时间戳  
			$begintime=mktime(0,0,0,date('m'),date('d')-6,date('Y'));
			$endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}elseif($option['date'] == 4){ 
			//获取本周起始时间戳和结束时间戳   
			$begintime = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));
			$endtime=mktime(0,0,0,date('m'),date('d')-date('w')+7,date('y'));
		}elseif($option['date'] == 5){ 
			//获取本月起始时间戳和结束时间戳  
			$begintime=mktime(0,0,0,date('m'),1,date('Y'));
			$endtime=mktime(23,59,59,date('m'),date('t'),date('Y'));
		}elseif($option['date'] == 6){ 
			$begintime = strtotime(date("Y",time())."-1"."-1"); //本年开始  
			$endtime = strtotime(date("Y",time())."-12"."-31"); //本年结束 
		}
		if($begintime && $endtime) $select->range('a.date',$begintime,$endtime);
	}
	//排序
	if(!empty($option['order_by_string'])){
		$select->order($option['order_by_string']);
	}else{
		$select->order('i.list_order DESC');
	}
	//审核
	$verified = isset($option['verified'])? intval($option['verified']) : 1;
	$verified = in_array($verified,array(0,1,2,3,88,-99)) ? $verified : 1; 
	if($verified == 3){
		$select->in('i.verified', array(2,0));
	}else{
		$select -> in('i.verified',$verified);
	}
	//当前页码
	$page = 0;
	//总记录数
	$count = 0;
	$page_size = $option['limit'];

	//echo $select->build_sql().'<br>';
	
	$list = $this->core->list_item(
		$select,
		array(
			'page' => &$page,
			'page_size' => $page_size,
			'count' => &$count,
			//'sphinx' => $sphinx
		)
	);
	unset($select, $tmp);
	//幻灯片宽高
	$swidth = isset($option['width']) ? $option['width'] : 300;
	$sheight = isset($option['height']) ? $option['height'] : 300;
	
	//每行的宽度,用于多列
	$width = isset($option['rows']) && $option['rows'] > 1 ? (100/$option['rows']-1).'%' : '99%';
	$wf ='';
	if($width!='99%'){
		$wf = "width:$width;float:left;margin-right:1%";
	}	
	
	foreach($list as $key=>$detail){
		$this->format_data($list[$key] ,$option['title_length']);
		$this->format_view($list[$key]);
		$detail['model_name'] = $this_model['name'];
		$list[$key]['url'] = p8_url($this, $detail, 'view');
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
	if($omid && $omid != $mid) {
		$this->set_model($omid);
	}
	return isset($pages) ? array($content, $pages) : array($content);
}

function sendMsg($id,$action = 'add'){
	global $this_model,$core,$SKIN,$RESOURCE,$STATIC_URL;
	$data = $this->get_data($id,$this_model['name']);	
	if(empty($this_model['CONFIG'][$action]['reminder_enabled']) || empty($this_model['CONFIG'][$action]['type'])) return;
	
	//以用户发布时选择的通知类型为第一优先
	$type = isset($this_model['CONFIG'][$action]['type']) && $this_model['CONFIG'][$action]['type'] ? $this_model['CONFIG'][$action]['type'] : array();	
	if(!$type) return;
	$select_manager = isset($config[$action]['manager']) ? $config[$action]['manager'] : array();	
	$uid = $this_model['CONFIG'][$action]['reminder_enabled'] && $this_model['CONFIG'][$action]['manager'] ? $this_model['CONFIG'][$action]['manager'] : array();
	$model_email = $this_model['CONFIG'][$action]['reminder_enabled'] && $this_model['CONFIG'][$action]['email'] ? str_replace(array(',','|','，'),',',$this_model['CONFIG'][$action]['email']) : '';
	$model_email = explode(',',$model_email);
	$_emails = array_unique(array_merge($model_email));
	$uid = array_unique(array_merge($uid,$select_manager,array($data['uid'])));
	$_uids = $comm = '';
	foreach($uid as $_u){
		if($_u) {
			$_uids = $comm.$_u;
			$comm = ',';
		}
	}
	if(!($_uids || $model_email || $select_manager)) return;

	$query = $this->core->DB_master->query("SELECT id, cell_phone,email FROM {$this->core->TABLE_}member WHERE id in ($_uids)");
	$this_module = &$this;
	$email_sended = array();
	$contents = '';
	if(in_array('email',$type)){
		$this->format_data($data);
		$this->format_view($data);
		$status = $this->CONFIG['status'];
		//模型自定义脚本
		include $this_model['path'] .'view.php';		
		$template = empty($this_model['view_template'])? 'view' : 'tpl/'.$this_model['view_template'];			
		$member_info = $user_data;	
		$status_json = p8_json($this_module->CONFIG['status']);
		ob_start();
		include template($this_module, $template);
		$contents = ob_get_clean();
		//取CSS
		$preg = '/href=[\"|\']?(.*?)[\"|\']?\s.*?>/i';//匹配img标签的正则表达式
		preg_match_all($preg, $contents, $allImg);//这里匹配所有的img
		$cssstring = '<style type="text/css">';
		foreach($allImg[1] as $css){
			if(strpos($css,'.css') || strpos($css,'.CSS')){
				$cssstring .= file_get_contents($css);//将整个文件内容读入到一个字符串中
			}
		}		
		$cssstring .= '</style>';
		$cssstring = str_replace(array("\r\n", "\r", "\n"), "", $cssstring);		
		//取主体
		if(stristr($contents,"<body>",0)){
			$contents = substr(stristr($contents,"<body>",0),6);
		}else{
			$len = strlen('<body style="background:#fff;background-image:none;">');
			$contents = substr(stristr($contents,'<body style="background:#fff;background-image:none;">',0),$len);
		}
		if($contents) $contents = stristr($contents,"</body>",1);
		//view
		if(strpos('http://',$this_module->controller))
			$viewlink = $this_module->controller .'-view-id-'.$id;
		else
			$viewlink = $this->core->STATIC_URL .'/index.php/forms-view-id-'.$id;
		$viewlinks = '<h3>查看详情：<a href="'.$viewlink.'" target="_blank">'.$viewlink.'</a><h3><br>';
		$contents = $cssstring.$viewlinks.$contents;
	}
	$mscontent = $this_model['alias'].'有新信息（'.date('Y-m-d H:i:s',P8_TIME).'）';
	if($this_model['CONFIG'][$action]['title']){
		$search = array('{title}', '{timestamp}', '{code}','{status}');
		$status = $this->CONFIG['status'];
		$replace = array($data['title'] != $this_model['alias'] ? $data['title'] : '', date('Y-m-d H:i:s',P8_TIME), $data['code'],$status[$data['status']]);
		$title = str_replace($search, $replace, $this_model['CONFIG'][$action]['title']);
	}else{
		$title = $mscontent;
	}
	$email = $this->core->load_module('mail');
	while($user_data = $this->DB_master->fetch_array($query)){
		if(!$user_data)continue;
		$suid = $user_data['id'];		
		$mobile = isset($user_data['cell_phone'])? filter_word($user_data['cell_phone']) : '';
		$semail = isset($user_data['email'])? filter_word($user_data['email']) : '';		
		$mobile = str_replace(array(',','|','，'),',',$mobile);
		
		$semail = str_replace(array(',','|','，'),',',$semail);
		$status1 = $status3 = $status2 = false;		
		
		if(in_array('msg',$type)){
			$message = $this->core->load_module('message');
			$sdata = array(
				'uid' => $suid,
				'title' => $title,
				'content' => $mscontent
			);
			$status1 = $message->send($sdata);
		}
		if(in_array('sms',$type) && $mobile){
			$sendto = $mobile;			
			$sms = $this->core->load_module('sms');
			$sms_content = str_replace(array("\t"), '', strip_tags($mscontent));
			if($sendto){
				$status2 = $sms->send(
					$sendto,
					$sms_content
				);
			}
		}
		if(in_array('email',$type) && $semail){								
			$sendto = explode(',', $semail);
			$sendto = array_unique(array_merge($_emails,$sendto));			
			foreach($sendto as $send){
				if(in_array($send,$email_sended)) continue;
				if(!$send) continue;				
				$email->set(array(
					'subject' => $title,
					'message' => $contents,
					'send_to' => $send
				));				
				$email_sended[] = $send;
				$status3 = $email->send();
			}		
		}
	}
	//针对非选择的用户，直接输入的邮件
	foreach($_emails as $emailed){
		if(in_array($emailed,$email_sended)) continue;
		if(!$emailed) continue;	
		$ret = $email->set(array(
			'subject' => $title,
			'message' => $contents,
			'send_to' => $emailed
		));	
		$status4 = $email->send();
	}		
}

}
