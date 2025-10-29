<?php
defined('PHP168_PATH') or die();
class P8_Sites_Letter extends P8_Module{

var $table;
var $table_data;
var $table_cat;

function __construct(&$system, $name){
	$this->system = &$system;

	parent::__construct($name);
	$this->table = $this->TABLE_.'item';
	$this->table_data = $this->TABLE_ . "data";
	$this->table_type = $this->TABLE_ . "type";
	$this->table_department = $this->TABLE_ . "department";
    $this->site = $this->system->site;
    $this->hong = 7;
	$this->huan = 3;
	
}
function get_config($reflash=false){
    
    if(!$reflash && $return = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', 'config', $this->system->SITE,'serialize')){
        return $return;
    }else{
        $return = $this->DB_master->fetch_one("SELECT data1 FROM {$this->system->TABLE_}site WHERE alias='{$this->system->SITE}'");
        $return = isset($return['data1']) ? $return['data1'] : '';
        if($return)
            $this->core->CACHE->write($this->system->name .'/modules/letter/', 'config', $this->system->SITE, $return);
        return mb_unserialize($return);
    }
}

function init_config(){
    $config= $this->get_config();
    $this->hong = isset($config['hong'])?$config['hong']:7;
    $this->huan = isset($config['huan'])?$config['huan']:3;
}

function set_module_config($data){
    $this->DB_master->update(
        $this->system->TABLE_.'site',
        array('data1'=>serialize($data)),
        "alias='{$this->system->SITE}'"
    );
    $this->exec_cache();
}

function get_category($type='', $reflash=false){
	if($type){
		return $this->get_category_data($type, $reflash);
	}
	return array(
		'type'=>$this->get_category_data('type', $reflash),
		'department'=>$this->get_category_data('department', $reflash)
	);
	
}

function get_category_data($type='type', $reflash=false){
	
	if(!$reflash && !$return = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', $type, $this->system->SITE, 'serialize')){
        $table =  $this->{'table_'.$type};
		$query = $this->DB_master->fetch_all("SELECT * FROM $table where site='{$this->system->SITE}' ORDER BY num DESC");
		$return = array();
		foreach($query as $key => $rs){
			$data[$rs['id']] = $rs;
		}
		$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $type, $this->system->SITE, $return, 'serialize');
		
	}
	return $return;

}

function deleteCat($type,$data){
   $table =  $this->{'table_'.$type};
   $this->DB_master->delete($table,"id IN(".implode(',',$data).")");
    $this->exec_cache();
}

function updateCat($data,$type){
    $tablename='table_'.$type;
    $table =  $this->$tablename;
	if(!empty($data['new'])){
		foreach($data['new'] as $key=>$name){
			$this->DB_master->insert($table, array('name'=>$name,'site'=>$this->system->SITE,'num'=>intval($data['newnum'][$key])));
		}
	}
	if(!empty($data['old'])){
		foreach($data['old'] as $id=>$name){
			$this->DB_master->update($table, array('name'=>$name,'num'=>intval($data['oldnum'][$id])),"id='$id'");
		}
	}
    $this->exec_cache();
}
function createNumber(){
	return date('YmdHis').rand(1000,9999);
}
function add(&$data){
	//插入主表取得ID
	$id = $this->DB_master->insert(
		$this->table,
		$this->DB_master->escape_string($data['main']),
		array('return_id' => true)
	);
	
	if(empty($id)) return false;
	
	//收集已上传的附件
	if(isset($data['attachment_hash'])){
		uploaded_attachments($this, $id, $data['attachment_hash']);
		unset($data['attachment_hash']);
	}
	
	$data['data']['item_id'] = $id;
	$st = $this->DB_master->insert(
		$this->table_data,
		$this->DB_master->escape_string($data['data'])
	);
	if(!$st){
		$this->delete(array('ids'=>array($id)));
		return false;
	}
	return $id;
}

function update($id,&$data){
	$status = true;
	//收集已上传的附件
	if(isset($data['attachment_hash'])){
		uploaded_attachments($this, $id, $data['attachment_hash']);
		unset($data['attachment_hash']);
	}
	$status |= $this->DB_master->update(
		$this->table,
		$this->DB_master->escape_string($data['main']),
		"id = '$id'"
	);
	$status |=	$this->DB_master->update(
		$this->table_data,
		$this->DB_master->escape_string($data['data']),
		"item_id = '$id' AND level='0'"
	);
	
	return $status;
}
function getData($id,$type='simple'){
	
	$data = $this->DB_master->fetch_one("SELECT i.* FROM {$this->table} as i WHERE i.id='$id'");
	
	if($type=='all' && $data){
		$data['data'] = $this->DB_master->fetch_all("SELECT d.* FROM {$this->table_data} as d WHERE d.item_id='$id'"); 
	
	}
	
	return $data;
}

function getList($param,$limit=10){
	
	$where = ' visual=1';
	//if(!empty($this->CONFIG['redepartment'])){
	//	$department = intval($this->CONFIG['redepartment']);	
	//	$where .= " AND department!='{$department}'";
	//}
	if(isset($param['uid']))
		$where .= " AND uid='{$param['uid']}'";
	if(isset($param['department']))
		$where .= " AND department='{$param['department']}'";
	if(isset($param['type']))
		$where .= " AND type='{$param['type']}'";
	if(isset($param['username']))
		$where .= " AND username='".p8_html_filter($param['username'])."'";
	$sql ="SELECT * FROM {$this->table} WHERE $where LIMIT $limit";
	return $this->DB_master->fetch_all($sql);
}

function searchData($number,$username){
	
	$data = $this->DB_master->fetch_one("SELECT i.* FROM {$this->table} as i WHERE i.number='$number' AND username='$username'");

	return $data;
}


function reply($id,$main,$data=array()){
	$this->DB_master->update(
			$this->table,
			$this->DB_master->escape_string($main),
			"id = '$id'"
	);
	
	if($data){
		foreach($data as $rid=>$rep){
			$this->DB_master->update(
			$this->table_data,
			$this->DB_master->escape_string($rep),
			"id = '$rid'"
			);
		}
	}
	
}


function delete($data){
//print_r($data);exit;
	$this->DB_master->delete(
			$this->table,
			"id in(".implode(",",$data['ids']).")"
	);
	$this->DB_master->delete(
			$this->table_data,
			"item_id in(".implode(",",$data['ids']).")"
	);
	return $data['ids'];
}
function verify($data){

	$this->DB_master->update(
			$this->table,
			array('status'=>1),
			"id in(".implode(",",$data['ids']).")"
	);

	return $data['ids'];
}

function comment($id,$common){
	return $this->DB_master->update(
		$this->table,
		array('comment'=>$common,'comment_time'=>time()),
		"id = '$id'"
	);
}

function getstatistics($begintime,$endtime){
	$cates = $this->get_category();
	$return = array();
	$where = '';
	if($begintime){
		$where .= "AND create_time > '$begintime'";
	}
	if($endtime){
		$where .= "AND create_time < '$endtime'";
	}
	$total = array();
	foreach($cates['department'] as $row){
		$sql = "SELECT type,COUNT(id) AS total,COUNT(DISTINCT solve_time) AS solve FROM {$this->table} WHERE department={$row['id']} $where GROUP BY type";
		$query = $this->DB_master->fetch_all($sql);
		$data = array();
		foreach($query as $item){
			$data[$item['type']]=$item;
			$total[$item['type']]['total'] +=$item['total'];
			$total[$item['type']]['solve'] +=$item['solve'];
			$total[$row['id']]['total'] +=$item['total'];
			$total[$row['id']]['solve'] +=$item['solve'];
		}
		$return[$row['id']] = $data;
		
	}
	$return['total']=$total;
	return $return;
}

function getstatistics2(){

	$sql = "SELECT type,COUNT(id) AS total,COUNT(DISTINCT solve_time) AS solve FROM {$this->table} GROUP BY type";
	$query = $this->DB_master->fetch_all($sql);
	$data = array();
    foreach($query as $item){
		$data[$item['type']]=$item;
	}
	return $data;
}

function getProgress($username,$number){
	$sql = "SELECT id,log FROM {$this->table} WHERE code='".$number."'";
	return $this->DB_master->fetch_one($sql);

}

function getdp($row){
	$dp = 1;
	$this->init_config();
	if($row['finish_time'])$row['create_time']=$row['finish_time'];
	if(!$row['solve_time'] && P8_TIME-$row['create_time']>86400*$this->hong)
		$dp = 3;
	elseif(!$row['solve_time'] && P8_TIME-$row['create_time']>86400*$this->huan)
		$dp = 2;
	return $dp;	
}


function id_type(){
	global $P8LANG;
	return array(
		1=>$P8LANG['id_type_1'],
		2=>$P8LANG['id_type_2'],
		3=>$P8LANG['id_type_3'],
		4=>$P8LANG['id_type_4'],
		5=>$P8LANG['id_type_5'],
	);
}

function get_comments(){
	global $P8LANG;
	return array(
		1=>$P8LANG['comments_1'],
		2=>$P8LANG['comments_2'],
		3=>$P8LANG['comments_3'],
	);
}
/**
* 生成缓存
* @param bool $cache_all 缓存所有站点
* @param bool $list_cache 是否写缓存,如果否,则不写缓存,保持树形结构,用于实时刷新
* @param array $ids 只缓存的分类的ID哈希 array(id1 => 1, id2 => 1 ...)
**/
function cache($cache_all = true){
	parent::cache();
	if(!$cache_all)
		$this->exec_cache($this->system->SITE);
	else{
		$this->system->get_sites();
		foreach($this->system->sites as $site=>$sdata){
			$this->exec_cache($site);
		}
	}
}

function exec_cache($site=''){
    $site = $site? $site: $this->system->SITE;
    $config = $this->DB_master->fetch_one("SELECT data1 FROM {$this->system->TABLE_}site WHERE alias='$site'");
    $this->core->CACHE->write($this->system->name .'/modules/letter/', 'config', $site, $config['data1']);
    
    $query = $this->DB_master->fetch_all("SELECT * FROM {$this->table_type} WHERE site='{$site}' ORDER BY num DESC");
    $type = array();
    foreach($query as $key => $rs){
        $type[$rs['id']] = $rs;
    }
    $this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', 'type', $site, $type, 'serialize');
    
    
    $query = $this->DB_master->fetch_all("SELECT * FROM {$this->table_department} WHERE site='{$site}' ORDER BY num DESC");
    $department = array();
    foreach($query as $key => $rs){
        $department[$rs['id']] = $rs;
    }
    $this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', 'department', $site, $department, 'serialize');

}


/**
*标签 接口
**/
function label(&$LABEL, &$label, &$var){
	$option = &$label['option'];
	//print_r($option);
	global $SKIN, $TEMPLATE, $RESOURCE,$P8LANG;
	load_language($this, 'global');
	if(empty($option['statistic_id'])){
		$select = select();
		$select->from($this->table .' AS i', 'i.*');
		$lenght = intval($option['summary_length']);
		$select->left_join($this->table_data .' AS d', 'd.reply_time,substring(d.content,1,'.$lenght.') as summary,substring(d.reply,1,'.$lenght.') as reply', 'd.item_id=i.id');
		
		
		//排序
		if(!empty($option['order_by_string'])){
			$select->order($option['order_by_string']);
		}else{
			$select->order('i.id DESC');
		}
		$site = $site? $site: $this->system->SITE;
		$select->in('i.site', $site);
		if(empty($option['ids'])){
			
			if($option['department']){
					$select->in('i.department',$option['department']);
			}
			if($option['type']){
				$select->in('i.type',$option['type']);
			}
			$select -> in('undisplay',0);
			$select -> in('visual',1);
			if(!empty($option['status']))
				$select->in('i.status', $option['status']-1);
				
			if(!empty($this->CONFIG['redepartment'])){
				$redepartment = intval($this->CONFIG['redepartment']);	
				$select->in("i.department",$redepartment,true);
			}	
				
			//当前页码
			$page = 0;
			//总记录数
			$count = 0;
			$page_size = $option['limit'];
			
			//echo $select->build_sql();
			//取出数据
			$list = $this->core->list_item(
				$select,
				array(
					'page' => &$page,
					'page_size' => $page_size,
					'count' => &$count,
					'sphinx' => $option['sphinx']
				)
			);
			
		}else{
			//指定ID,不需分页,不使用sphinx
			$select->in('i.id', $option['ids']);
			$c = range(0, count($option['ids']) -1);
			
			$list = $this->core->list_item(
				$select,
				array(
					'page_size' => 0
				)
			);
			
			$tmp = array_combine($option['ids'], $c);
			foreach($list as $v){
				$tmp[$v['id']] = $v;
			}
			
			$list = array_values($tmp);
		}
	
		
		$cates = $this->get_category();
		//处理URL
		foreach($list as $k => $v){
			$list[$k]['url'] = $this->controller.'-view-id-'.$v['id'];
			$list[$k]['full_title'] = $v['title'];
			$dot=!empty($option['title_dot'])?'...' : '';
			$list[$k]['title'] = p8_cutstr($v['title'], $option['title_length'], $dot);
			//分类名称
			$list[$k]['department_name'] = $cates['department'][$v['department']]['name'];
			$list[$k]['type_name'] = $cates['type'][$v['type']]['name'];
			$list[$k]['status_name'] = $P8LANG['status_'.$v['status']];
			$list[$k]['dp'] = $this->getdp($v);
		}
	}else{
		$func = 'tonji_0'.$option['statistic_id'];
		$_list = $this->$func(array('pagesize'=>$option['limit']));
		$list = $_list['list'];
		$page = $_list['page'];
	}
	//随机数
	$rand = rand_str(4);
	//每行的宽度,用于多列
	$width = (isset($option['rows']) && $option['rows']>1) ? (100/$option['rows']-1).'%' : '99%';
	
	
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

}
