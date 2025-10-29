<?php
defined('PHP168_PATH') or die();

class P8_Sites_Letter_Controller extends P8_Controller{

function __construct(&$obj){
	parent::__construct($obj);
	
}
function add(&$POST){
	global  $UID, $USERNAME;
	$data = $this->valid_data($POST);
	$config = $this->model->core->get_config('core', 'letter');
	$data['main']['number']=$this->model->createNumber();
	$code = rand(10000,99999);
    $data['main']['site'] = $data['data']['site'] = $this->model->system->SITE;
	$data['main']['undisplay']=$config['undisplay'];
	$data['main']['code']=$code;
	$data['main']['uid'] = $UID;
	$data['main']['ip'] = P8_IP;
	$data['main']['create_time'] = time();

	$data['data']['add_time'] = time();
	$id = $this->model->add($data);
	return $id? array('id'=>$id,'number'=>$data['main']['number'],'code'=>$code):false;
	
}

function update(&$POST){
	$id= $POST['id'];
	$data = $this->valid_data($POST);
	$data['main']['update_time'] = time();
	$status = $this->model->update($id,$data);
	return $status?$id:$status;
}

function valid_data(&$POST){
	
	if(!captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '')){
			message('captcha_incorrect', HTTP_REFERER, 10);
	}
	$data = array(
		'main' => array(),
		'data' => array()
	);
	$func = 'html_entities';	
	//关联附件哈希
	$data['attachment_hash'] = isset($POST['attachment_hash']) ? $POST['attachment_hash'] : '';
		
	//验证公共部分
	$data['main']['title'] = filter_word($func($POST['title'])) or message('error');
	$data['main']['username'] = filter_word($POST['username']);
	$data['main']['age'] = intval($POST['age']);
	
	$config = $this->model->core->get_config('core', 'letter');
	$data['main']['department'] = intval($POST['department']);
	if(!empty($config['receive']) && !empty($config['redepartment'])){
		$data['main']['department'] = intval($config['redepartment']);	
	
	}
	
	$data['main']['gender'] = intval($POST['gender']);
	$data['main']['type'] = intval($POST['type']);
	$data['main']['visual'] = intval($POST['visual']);
	$data['main']['source'] = intval($POST['source']);
	$data['main']['profession'] = filter_word($POST['profession']);
	$data['main']['id_type'] = filter_word($POST['id_type']);
	$data['main']['id_num'] = filter_word($POST['id_num']);
	$data['main']['phone'] = filter_word($POST['phone']);
	$data['main']['email'] = filter_word($POST['email']);
	$data['main']['address'] = filter_word($POST['address']);
	
	$data['data']['content'] = filter_word($POST['content']) or message('error');
	$data['data']['attachment_name'] = !empty($POST['attachment_name'])? filter_word($POST['attachment_name']):'';
	$data['data']['attachment'] =  !empty($POST['attachment'])?attachment_url($POST['attachment'], true):'';
	return $data;
}

function reply(&$POST){
	global $UID,$USERNAME,$P8LANG,$core;

	$id = intval($POST['id']) or message('error');
	$rsdb = $this->model->getData($id,'all');
	$main = $data=array();
	$log = '';
	$cates = $this->model->get_category();
		
	$main['askable'] = intval($POST['askable']);
	
	$department = intval($POST['department']);
	if($rsdb['department']!=$department){
		$main['department'] = $department;
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['to_department'].$cates['department'][$department]['name'];
	}
		
	$type = intval($POST['type']);
	if($rsdb['type']!=$type){
		$main['type'] = $type;
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['to_type'].$cates['type'][$type]['name'];
	}
	
	$visual = intval($POST['visual']);
	if($rsdb['visual']!=$visual){
		$main['visual'] = $visual;
	}
	
	if(isset($POST['undisplay'])){
		$undisplay = intval($POST['undisplay']);
		if($rsdb['undisplay']!=$undisplay){
			$main['undisplay'] = $undisplay;
		}
	}	
	
	$replys = $POST['reply'];	
	$reply_id = $POST['reply_id'];	
	
	if(!empty($POST['finish_time']))$main['finish_time'] = strtotime($POST['finish_time']);
	if(!empty($POST['finish_name']))$main['finish_name'] = filter_word($POST['finish_name']);
	
	$turntig = '';
	if($main['finish_time'] || !empty($POST['turntig'])){
		
		if($main['finish_time'])$turntig .= p8lang($P8LANG['turntip'], $cates['department'][$department]['name'],$POST['finish_time']).';';
		if(!empty($POST['turntig']))$turntig .=filter_word($POST['turntig']);
		$turntig .= '   <font color="blue">('.$USERNAME.'  '.date('Y-m-d').')</font>';
		
		$redata = $this->model->getData($id,'all');
		$turntig = $turntig.'<br/>'.$redata['data'][0]['turntig'];
	}
	
	foreach($reply_id as $repid=>$t){
		if(!$t)continue;
		$data[$repid]=array(
			'reply'=>filter_word($replys[$repid]),
			'reply_time'=>time(),
			'reply_department'=>$department,
			'reply_name'=>$USERNAME,
			'reply_uid'=>$UID
		);
		if($turntig)$data[$repid]['turntig']=$turntig;
	}
	$status = intval($POST['status']);
	
	
	$config = $core->get_config('core', 'letter');
	$main['fengfa'] = $department==$config['receive']?0:1;
	
	if($main['fengfa'])$status=2;
	$replys[$repid] = trim($replys[$repid]);
	if(!empty($replys[$repid]))$status=3;
	
	if($rsdb['status']!=$status){
		$main['status'] = $status;
		$main['solve_time'] = $status==3?time():'';
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['rep_'.$status];
	}
	$main['solve_uid'] = $UID;
	$main['solve_department'] = $department;
	$main['status_change_time'] = time();
	$main['solve_name'] = $USERNAME;
	
	
	
	
	
	if($data){
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['reply'];
	}
	if($log){
		$main['log'] = $rsdb['log']. $log;
	 }
	/*  print_r($POST);
	echo $main['log'],'<br/>';
	print_r($rsdb);
	print_r($main);
	print_r($data);exit;  */
	$this->model->reply($id,$main, $data);
	
}

function check_action($action, $prix=''){
	global $IS_FOUNDER;
	if($IS_FOUNDER) return true;
	if($this->model->system->check_manager($action))return true;
	return parent::check_action($action, $prix?$prix:$this->model->system->SITE);
	
}
function check_admin_action($action, $postfix = ''){
	global $IS_FOUNDER;
	if($IS_FOUNDER) return true;
	if($this->model->system->check_manager($action))return true;
	return parent::check_admin_action($action, $prix?$prix:$this->model->system->SITE);
}
function check_manage($department=0,$type=0){
	global $IS_FOUNDER;
	if($IS_FOUNDER)return true;
	$manage = false;
	if($this->check_action('manager', $this->model->system->SITE)){
		$my_manage = $this->get_acl('my_letter_manage', $this->model->system->SITE);
		foreach($my_manage as $dep=>$tys){
			if($dep && $department==$dep){
				foreach($tys as $ty){
					if($ty==$type)
						$manage = true;
				}
			}elseif($dep=='0'){
				foreach($tys as $ty){
					if($ty==$type)
						$manage = true;
				}
			}
		}
	}
	return $manage;

}
function getcatbyAct($act){
	global $IS_FOUNDER;
	
	
	$allcate = $this->model->get_category('department');
	
	if($IS_FOUNDER)return $allcate;
	$mycat = $this->get_acl('my_letter_manage', $this->model->system->SITE);

	$return = array();
	if(isset($mycat[$act])){
        if(array_key_exists('0',$mycat[$act]))
            $return = $allcate;
        else
            foreach($mycat[$act] as $d)
                $return[$d] = $allcate[$d];
    }
	
	return $return;
}
function check_acl($act,$department=0){
	global $IS_FOUNDER;
	if($IS_FOUNDER)return true;
	
	$acts = $this->getcatbyAct($act);
	
	if(array_key_exists('0',$acts))return true;
	return !empty($acts[$department]);

}
function manageMessage(){
	global $IS_FOUNDER;
	$my_manage = $this->get_acl('my_letter_manage');
//print_r($my_manage);
	$acl_where = $split = '';
	if(!$IS_FOUNDER){
		foreach($my_manage as $dep=>$tys){
			$tys=implode(',',$tys);
			if($dep)
				$acl_where .= " $split (department='$dep' AND type IN($tys))";
			else
				$acl_where .= " $split type IN($tys)";
			$split = ' OR ';	
		}
		if(!$acl_where)
			return false;
		$acl_where = " WHERE $acl_where";
	}
	$sql = "SELECT status,COUNT(id) AS co FROM {$this->model->table}  $acl_where GROUP BY status";
	$data = $this->model->DB_master->fetch_all($sql);

	$mana = array(0=>0,1=>0,2=>0,3=>0);
	foreach($data as $row){
		$mana[$row['status']] = $row['co'];
	}
	$sql = "SELECT comment,COUNT(id) AS co FROM {$this->model->table} $acl_where GROUP BY comment";
	$data = $this->model->DB_master->fetch_all($sql);
	$comm = array(0=>0,1=>0,2=>0,3=>0);
	foreach($data as $row){
		$comm[$row['comment']] = $row['co'];
	}
	return array('mana'=>$mana,'comm'=>$comm);

}

function add_cate(&$POST){
    $kind = $POST['kind'];
    
}
}