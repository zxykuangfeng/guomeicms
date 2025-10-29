<?php
defined('PHP168_PATH') or die();

class P8_Credit extends P8_Module{

var $table;						//积分类型表
var $rule_table;				//规则表
var $log_table;					//积分得失日志表
var $rule_log_table;			//规则应用日志表
var $rule_log_cache_table;		//规则日志缓存表
var $credits;
var $rules;
var $last_cache;

function __construct(&$system, $name){
	//本模块没有配置
	$this->configurable = false;
	$this->system = &$system;
	parent::__construct($name);
	
	$this->table = $this->core->TABLE_ .'credit';
	$this->member_table = $this->TABLE_ .'member';
	$this->rule_table = $this->TABLE_ .'rule';
	$this->log_table = $this->TABLE_ .'log';
	$this->rule_log_table = $this->TABLE_ .'rule_log';
	$this->rule_log_cache_table = $this->TABLE_ .'rule_log_cache';
	
	$this->last_cache = '@'. $this->core->CONFIG['last_credit_cache'];
}

function P8_Credit(&$system, $name){
	$this->__construct($system, $name);
}

/**
* 添加积分类型
* $type 整数或小数,只有设置了float_bit才为小数,float_point为小数点位数
* $is_unsigned 是否可以为负积分,默认不允许
* $default_value 积分的默认值
**/
function add($data){
	$id = $this->DB_master->insert(
		$this->table,
		$data,
		array('return_id' => true)
	);
	
	$is_unsigned = $data['is_unsigned'] ? 'unsigned' : '';
	$type = $data['float_bit'] ? "decimal({$data['float_bit']},{$data['float_point']})" : "int";
	$this->DB_master->query("ALTER TABLE $this->member_table ADD COLUMN credit_$id $type $is_unsigned NOT NULL DEFAULT '{$data['default_value']}'");
	$this->DB_master->query("ALTER TABLE {$this->core->TABLE_}role ADD COLUMN credit_$id $type $is_unsigned NOT NULL DEFAULT '0'");
	
	return $id;
}

/**
* 删除积分种类
**/
function delete($id){
	if(
		$status = $this->DB_master->delete(
			$this->table,
			"id = '$id'"
		)
	){
		//删除相应规则
		$this->DB_master->delete($this->rule_table, "credit_id = '$id'");
		//删除相应字段
		$this->DB_master->query("ALTER TABLE $this->member_table DROP COLUMN credit_$id");
		$this->DB_master->query("ALTER TABLE ". $this->core->TABLE_ ."role DROP COLUMN credit_$id");
		return $status;
	}
	
}

/**
* 删除积分日志
**/
function delete_credit_log($id){
	if(is_array($id)){
		foreach($id as $each_id){
			$this->delete_credit_log($each_id);
		}
	}else{
		return $status = $this->DB_master->delete(
				$this->log_table,
				"id = '$id'"
		);
	}
}

/**
* 修改积分类型,参数同添加
**/
function update($id, $data){
	if(
		$this->DB_master->update(
			$this->table,
			$data,
			"id = '$id'"
		)
	){
		$is_unsigned = $data['is_unsigned'] ? 'unsigned' : '';
		$type = $data['float_bit'] ? "decimal({$data['float_bit']},{$data['float_point']})" : "int";
		return $this->DB_master->query("ALTER TABLE $this->member_table CHANGE credit_$id credit_$id $type $is_unsigned NOT NULL DEFAULT '{$data['default_value']}'");
	}
}

/**
* 应用积分规则,在模型层里调用
* @param object $obj 系统或模块的模型层对象
* @param string $action 动作
* @param int $uid 用户ID
* @param int $role_id 用户的角色
* @param string $postfix 自定义的RULE后缀
**/
function apply_rule(&$obj, $action, $uid, $role_id, $postfix = '',$id='0',$push_back_reason=''){
	if(empty($uid) || empty($action)) return false;
	/*
	$rule = [system][module][role_id][postfix]
	*/
	switch($obj->type){
	
	case 'core':
	case 'system':
		$system = $obj->name;
		$module = '';
		$site = $obj->site['alias'] ? $obj->site['alias'] : '';
	break;
	
	case 'module':
		$system = $obj->system->name;
		$module = $obj->name;
		$site = $obj->site['alias'] ? $obj->site['alias'] : '';
	break;
	
	default:
		return false;
	
	}
	if(is_array($postfix)){
		//可以设置一串后缀 array(1, 2, 3),后缀使用顺序为查找1,如果1找到了直接使用1,如果没找到找2,依此类推
		foreach($postfix as $v){
			if(empty($this->rules[$system][$module][$role_id][$v])){
				$this->get_cache_rule($system, $module, $role_id, $v);
				
				if(!empty($this->rules[$system][$module][$role_id][$v])){
					$postfix = $v;
					break;
				}
			}
		}
	}else{
		//从缓存中读取规则
		if(empty($this->rules[$system][$module][$role_id][$postfix]))
			$this->get_cache_rule($system, $module, $role_id, $postfix);
	}
	
	//如果缓存中仍然没有规则,直接退出 
	if(empty($this->rules[$system][$module][$role_id][$postfix][$action])){
		return false;
	}
	$rule = &$this->rules[$system][$module][$role_id][$postfix][$action];
	
	//更新积分
	$credit = array();
	//积分日志
	$log = array();
	//规则日志
	$rule_log = array();
	//规则日志缓存
	$rule_log_cache = array();
	foreach($rule as $k => $v){
		
		if($v['times']){
			//有次数限制,先从内存缓存里面读
			$check = $this->DB_master->fetch_one("SELECT times AS num, timestamp FROM $this->rule_log_cache_table WHERE uid = '$uid' AND rule_id = '$k'");
			
			if(empty($check)){
				//检查有没有超过限制
				$check = $this->DB_master->fetch_one(
					"SELECT COUNT(*) AS num FROM $this->rule_log_table WHERE uid = '$uid' AND rule_id = '$k'". ($v['interval'] ? ' AND timestamp > '. (P8_TIME - $v['interval']) : '')
				);
			}else{
				//频率过期,重新计算次数
				if($v['interval'] && $check['timestamp'] + $v['interval'] < P8_TIME){
					$check['num'] = 0;
				}
			}
			
			//超过限制就跳出
			if($check['num'] >= $v['times']) continue;
			
			$rule_log_cache[] = array($uid, $k, P8_TIME, $check['num'] +1);
		}
		
		$credit[$v['credit_id']] = $v['credit'];
		$log[] = array($uid, $v['credit_id'], $v['credit'], P8_TIME,$system,$module,$site,$id,$push_back_reason,'system');
		$rule_log[] = array($uid, $k, P8_TIME);
	}
	
	if($this->core->update_credit($uid, $credit)){
		//replace into 方式插入缓存表
		$this->DB_master->insert(
			$this->rule_log_cache_table,
			$rule_log_cache,
			array(
				'multiple' => array('uid' ,'rule_id', 'timestamp', 'times'),
				'unique' => array('uid' ,'rule_id'),
				'replace' => true
			)
		);
		
		$this->log($log);
		$this->rule_log($rule_log);
	}
	
	return $credit;
}

/**
* 获取缓存的规则
**/
function get_cache_rule($system, $module = '', $role_id = 0, $postfix = ''){
	$key = $system;
	$key = $module ? $key .'-'. $module : $key;
	$no_role_key = $key;
	$key = $role_id ? $key .'-role-'. $role_id : $key;
	$key = $postfix ? $key .'#'. $postfix : $key;
	$no_role_key = $postfix ? $no_role_key .'#'. $postfix : $no_role_key;
	
	global $CACHE;
	//先检查特定角色的
	$rule = $CACHE->read('core/modules/credit', 'rule', $key . $this->last_cache);
	if(!empty($rule)){
		$this->rules[$system][$module][$role_id][$postfix] = $rule;
		return true;
	}
	
	//如果特定角色的没有,再检查公用角色的
	if($role_id && $rule = $CACHE->read('core/modules/credit', 'rule', $no_role_key . $this->last_cache)){
		if(empty($rule)) return false;
		
		$this->rules[$system][$module][0][$postfix] = $rule;
		$this->rules[$system][$module][$role_id][$postfix] = &$this->rules[$system][$module][0][$postfix];
		//引用
	}
}

/**
* 记录积分得失日志
**/
function log($logs,$unique = false){
	global $USERNAME;
	if($unique){
		foreach($logs as $key => $log){
			$iid = $log[6];
			$this->DB_master->delete(
				$this->log_table,
				"iid = '$iid'"
			);
			//增加设置人员
			$logs[$key][] = $USERNAME;			
		}
		
		return $this->DB_master->insert(
			$this->log_table,
			$logs,
			array(
				'multiple' => array('uid', 'credit_id', 'credit', 'timestamp','system','module','site','iid','reason','setter'),
				'unique' => array('uid', 'credit_id', 'credit'),
				'replace' => true,
			)
		);
	}else{
		return $this->DB_master->insert(
			$this->log_table,
			$logs,
			array(
				'multiple' => array('uid', 'credit_id', 'credit', 'timestamp','system','module','site','iid','reason','setter'),
                'unique' => array('uid', 'credit_id', 'credit'),
				'replace' => true,
			)
		);
		
	}
	
}

/**
* 记录积分规则应用日志
**/
function rule_log($logs){
	return $this->DB_master->insert(
		$this->rule_log_table,
		$logs,
		array(
			'multiple' => array('uid', 'rule_id', 'timestamp'),
		)
	);
}

/**
* 生成缓存
**/
function cache(){
	parent::cache();
	
	return include $this->path .'call/cache.call.php';
}

/**
* 添加规则
* @param int $credit_id 积分类型的ID
* @param string $system 积分规则所在的系统
* @param string $module 积分规则所在的模块
* @param string $action 积分规则所在的action
* @param int|float $credit 积分规则所得分的积分
* @param int $times 规则应用的次数
* @param int $interval 规则应用频率,单位为秒
**/
function add_rule($data){
	return $this->DB_master->insert(
		$this->rule_table,
		$data,
		array('return_id' => true)
	);
}

/**
* 修改规则,参数同添加
**/
function update_rule($id, $data){
	return $this->DB_master->update(
		$this->rule_table,
		$data,
		"id = '$id'"
	);
}

/**
* 删除规则
**/
function delete_rule($id){
	return $this->DB_master->delete(
		$this->rule_table,
		"id = '$id'"
	);
}

/**
* 按ID查看一条积分类型
**/
function view($id){
	$ret = $this->DB_master->fetch_one("SELECT * FROM $this->table WHERE id = '$id'");
	$ret['roe'] = mb_unserialize($ret['roe']);
	return $ret;
}

/**
* 按ID查看一条积分规则
**/
function view_rule($id){
	return $this->DB_master->fetch_one("SELECT * FROM $this->rule_table WHERE id = '$id'");
}

/*
* 统计
* @param string $system 积分规则所在的系统
* @param string $credit_id 积分规则所用的类型
* @param string $site 积分规则所在的分站别名
* @param string $start_date 积分规则开始时间
* @param string $end_date 积分规则结束时间
* @param int $num 显示的数量
* @param bool $download 下载
*/
function getCredit($system,$credit_id,$start_date = 0,$end_date = 0,$num = 30,$site = '',$download = false){
	global $core,$P8LANG;
	$where = "1=1";
	if($start_date){
		$where = "1=1";	
		$starttime = strtotime($start_date);
		$where .= " AND timestamp>='$starttime'";
	}
	if($end_date){
		$where = "1=1";	
		$endtime = strtotime($end_date);
		$where .= " AND timestamp<='$endtime'";
	}
	if($start_date && $end_date){
		$where = "1=1";	
		$starttime = strtotime($start_date);
		$endtime = strtotime($end_date);
		$where .= " AND timestamp>='$starttime' AND timestamp<='$endtime'";
	}	
	if($system){
		$where .= " AND system='$system'";
	}
	if($site){
		$where .= " AND site='$site'";
	}
	if($credit_id){
		$where .= " AND credit_id='$credit_id'";
	}
	if($download) $num = 10000;
	$mtable = $this->core->TABLE_.'member';
	
	$sql = "SELECT g.uid, g.credit_id, m.username, m.name, SUM(`credit`) AS sum FROM $this->log_table AS g LEFT JOIN $mtable AS m ON g.uid = m.id WHERE $where GROUP BY `uid` ORDER BY `sum` DESC LIMIT 0,$num";
	
	$data = $this->DB_slave->fetch_all($sql);
	if($download){
		foreach($data as $key=>$row){
			$dodata[$key]['uid'] = $row['uid'];
			$dodata[$key]['username'] = $row['username'];
			$dodata[$key]['name'] = $row['name'];
			$dodata[$key]['credit_id'] = $P8LANG['credit_id'][$credit_id] ? $P8LANG['credit_id'][$credit_id] : $row['credit_id'];
			$dodata[$key]['sum'] = $row['sum'];
		}
		$headertext=array($P8LANG['uid'],$P8LANG['username'],$P8LANG['name'],$P8LANG['credit_id'][0],$P8LANG['sum']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('statistic','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($dodata);
		$export->fileFooter();
		$export->exportFile();
	}else{
		return $data;
	}
}

}
