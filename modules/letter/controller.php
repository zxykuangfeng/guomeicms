<?php
defined('PHP168_PATH') or die();

class P8_Letter_Controller extends P8_Controller{

function __construct(&$obj){
	parent::__construct($obj);
	
}
function add(&$POST){
	global  $UID, $USERNAME;
	$data = $this->valid_data($POST);
	$config = $this->model->core->get_config('core', 'letter');
	$data['main']['number']=$this->model->createNumber();
	$code = rand_str(9);
	$data['main']['undisplay'] = !empty($config['undisplay']) ? 1 : ($data['main']['visual'] ? 0 : 1);
	$data['main']['code']=$code;
	$data['main']['uid'] = $UID;
	$data['main']['ip'] = P8_IP;
	$data['main']['create_time'] = time();

	$data['data']['add_time'] = time();
	$id = $this->model->add($data);
	if($id && empty($config['receive'])) $this->model->sendMsg($id);
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
	
	if(empty($POST['is_from_api']) && !captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '')){
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
	$data['main']['title'] = filter_word($func($POST['title']));
	strlen($data['main']['title']) > 2 or message('error_title');
	$data['main']['username'] = filter_word($POST['username']);
	$data['main']['age'] = intval($POST['age']);
	
	$config = $this->model->core->get_config('core', 'letter');
	
	$department = $POST['department'] = isset($POST['department'])? intval($POST['department']): 0;
	$parent_department = $POST['parent_department'] = isset($POST['parent_department'])? intval($POST['parent_department']): 0;
	if(empty($department) && !empty($parent_department)) $POST['department'] = $parent_department;	
	$data['main']['department'] = intval($POST['department']);
	if(!empty($config['receive']) && !empty($config['redepartment'])){
		$data['main']['department'] = intval($config['redepartment']);	
	
	}
	$data['main']['p8_ip'] = P8_IP;
	$data['main']['gender'] = intval($POST['gender']);
	$data['main']['type'] = intval($POST['type']) or message('error_type');
	$data['main']['visual'] = intval($POST['visual']);
	$data['main']['source'] = intval($POST['source']);
	$data['main']['profession'] = filter_word($POST['profession']);
	$data['main']['id_type'] = intval($POST['id_type']);
	$data['main']['id_num'] = filter_word($POST['id_num']);
	if(!empty($config['id_num_confirm'])) strlen($data['main']['id_num'])>=9 or message('id_num_title');
	$data['main']['phone'] = filter_word($POST['phone']);
	$data['main']['email'] = filter_word($POST['email']);
	$data['main']['address'] = filter_word($POST['address']);
	$data['main']['custom_a'] = isset($POST['custom_a']) ? filter_word($POST['custom_a']) : '';
	$data['main']['custom_b'] = isset($POST['custom_b']) ? filter_word($POST['custom_b']) : '';
	$data['main']['custom_c'] = isset($POST['custom_c']) ? filter_word($POST['custom_c']) : '';
	$data['main']['custom_d'] = isset($POST['custom_d']) ? filter_word($POST['custom_d']) : '';
	$data['main']['custom_e'] = isset($POST['custom_e']) ? filter_word($POST['custom_e']) : '';
	$data['main']['custom_f'] = isset($POST['custom_f']) ? filter_word($POST['custom_f']) : '';
	
	$data['data']['content'] = filter_word($func($POST['content'])) or message('error_content');
	strlen($data['data']['content']) > 10 or message('error_content');
		
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
	$liu = false;
		
	$main['askable'] = intval($POST['askable']);
	
	$department = intval($POST['department']);
	if($department && $rsdb['department']!=$department){
		$main['department'] = $department;
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['to_department'].$cates['department'][$department]['name'];
		$liu =true;
	}
		
	$type = intval($POST['type']);
	if($type && $rsdb['type']!=$type){
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
	
	$replys = empty($POST['reply'])?array():$POST['reply'];	
	$reply_id = $POST['reply_id'];	
	
	if(!empty($POST['finish_time']))$main['finish_time'] = strtotime($POST['finish_time']);
	if(!empty($POST['create_time']))$main['create_time'] = strtotime($POST['create_time']);
	if(!empty($POST['finish_name']))$main['finish_name'] = filter_word($POST['finish_name']);
	
	$turntig = '';
	if($main['finish_time'] || !empty($POST['turntig'])){
		
		if($main['finish_time'])$turntig .= p8lang($P8LANG['turntip'], $cates['department'][$department]['name'],$POST['finish_time']).';';
		if(!empty($POST['turntig']))$turntig .=filter_word($POST['turntig']);
		$turntig .= '   <font color="blue">('.$USERNAME.'  '.date('Y-m-d').')</font>';
		
		$redata = $this->model->getData($id,'all');
		$turntig = $turntig.'<br/>'.$redata['data'][0]['turntig'];
	}
	if($replys || $department){
		foreach($reply_id as $repid=>$t){
			if(!$t)continue;
			$data[$repid]=array(
				'reply_time'=> !empty($POST['reply_time']) ? strtotime($POST['reply_time']):time(),
				'reply_name'=>$USERNAME,
				'reply_uid'=>$UID
			);
			if($replys)
				$data[$repid]['reply']=filter_word($replys[$repid]);
			if($department)
				$data[$repid]['reply_department']=$department;
			if($turntig)
				$data[$repid]['turntig']=$turntig;
		}
	}
	$status = intval($POST['status']);
	
	$config = $core->get_config('core', 'letter');
	$main['fengfa'] = $department==$config['receive']?0:1;
	$replys[$repid] = trim($replys[$repid]);
	if(!empty($replys[$repid])){
		if($config['status']){
			$main['status'] = $status = 3;
			$main['vefify'] = 1;
		}else{			
			$main['status'] = $status = 2;
			$main['vefify'] = 0;
			if($this->check_action('vefify')) {
				$main['status'] = $status = 3;
				$main['vefify'] = 1;
			}
		}		
	}else{
		//有分发，没回复则为受理
		if($main['fengfa']) {
			$main['status'] = $status = 1;
			$main['vefify'] = 0;
		}else{
			message('error');
		}
	}
		
	if($rsdb['status']!=$status){
		$main['status'] = $status;
		$main['solve_time'] = $status==3 ? time(): '';
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['rep_'.$status];
	}
    $main['finish_time'] = $main['finish_time'] ? $main['finish_time'] : time()+86000*intval($config['finish_days']);
	if($status==3) $main['solve_time'] = time();
	//如果已经解决，则以原解决时间为准，不再修改解决的时间
	if($rsdb['status'] >= 2 && $status==3) {
		$main['solve_time'] = $rsdb['solve_time'] ? $rsdb['solve_time'] : (!empty($POST['reply_time']) ? strtotime($POST['reply_time']):time());
	}
	//如果有提供实际解决的时间,以提供的为准
	$main['solve_time'] = !empty($POST['solve_time'])  ? strtotime($POST['solve_time']) : $main['solve_time'];
	$main['solve_uid'] = $UID;
	$main['solve_department'] = $department;
	$main['status_change_time'] = time();
	$main['solve_name'] = $USERNAME;	
	$main['recommend'] = !empty($POST['recommend']) ? 1 : 0;
	
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
	//var_dump($main);exit;
	$this->model->reply($id,$main, $data);
	if($liu)$this->model->sendMsg($id);
}

function vefify(&$POST){
	global $UID,$USERNAME,$P8LANG,$core;

	$id = intval($POST['id']) or message('error');
	$rsdb = $this->model->getData($id,'all');
	$main = $data=array();
	$log = '';
	$cates = $this->model->get_category();
	$liu = false;
		
	$main['askable'] = intval($POST['askable']);
	
	$department = intval($POST['department']);
	if($department && $rsdb['department']!=$department){
		$main['department'] = $department;
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['to_department'].$cates['department'][$department]['name'];
		$liu =true;
	}
		
	$type = intval($POST['type']);
	if($type && $rsdb['type']!=$type){
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
	
	$replys = empty($POST['reply'])?array():$POST['reply'];
	$vefifys = empty($POST['vefify_content'])?array():$POST['vefify_content'];	
	$reply_id = $POST['reply_id'];	
	
	if(!empty($POST['finish_time']))$main['finish_time'] = strtotime($POST['finish_time']);
	if(!empty($POST['create_time']))$main['create_time'] = strtotime($POST['create_time']);
	if(!empty($POST['finish_name']))$main['finish_name'] = filter_word($POST['finish_name']);
	
	$turntig = '';
	if($main['finish_time'] || !empty($POST['turntig'])){
		
		if($main['finish_time'])$turntig .= p8lang($P8LANG['turntip'], $cates['department'][$department]['name'],$POST['finish_time']).';';
		if(!empty($POST['turntig']))$turntig .=filter_word($POST['turntig']);
		$turntig .= '   <font color="blue">('.$USERNAME.'  '.date('Y-m-d').')</font>';
		
		$redata = $this->model->getData($id,'all');
		$turntig = $turntig.'<br/>'.$redata['data'][0]['turntig'];
	}
	if($replys || $vefifys || $department){
		foreach($reply_id as $repid=>$t){
			if(!$t)continue;
			$data[$repid]=array(
				'reply_time'=>!empty($POST['reply_time']) ? strtotime($POST['reply_time']):time(),
				'reply_name'=>$USERNAME,
				'reply_uid'=>$UID
			);
			if($replys)
				$data[$repid]['reply']=filter_word($replys[$repid]);
			if($vefifys)
				$data[$repid]['vefify_content']=filter_word($vefifys[$repid]);
			if($department)
				$data[$repid]['reply_department']=$department;
			if($turntig)
				$data[$repid]['turntig']=$turntig;
		}
	}
	$status = intval($POST['status']);
	
	
	$config = $core->get_config('core', 'letter');
	$main['fengfa'] = $department==$config['receive']?0:1;
	
//	if($main['fengfa'])$status=2;
	$replys[$repid] = trim($replys[$repid]);
//	if(!empty($replys[$repid]))$status=3;
	
	if($rsdb['status']!=$status){
		$main['status'] = $status;
		$main['solve_time'] = $status == 3 ? time() : '';
		$main['status_change_time'] = time();
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['rep_'.$status];
	}	
	//$main['finish_time'] = $main['finish_time'] ? $main['finish_time'] : time()+86000*intval($config['finish_days']);
	$main['solve_uid'] = $UID;
	$main['solve_department'] = $department;
	//$main['status_change_time'] = time();
	$main['solve_name'] = $USERNAME;
	$main['vefify'] = !empty($POST['vefify']) ? 1 : 0;
	$main['status'] = $main['vefify']==0 ? 2 : 3;
	$main['recommend'] = !empty($POST['recommend']) ? 1 : 0;

	if($data){
		$log .='<br/>'.'['.date('Y-m-d H:i').']'.$USERNAME.$P8LANG['reply'];
	}
	if($log){
		$main['log'] = $rsdb['log']. $log;
	 }
	 //reply and vefify
	if($main['vefify'] && $main['status']==3)
		$main['solve_time'] = empty($POST['reply_time']) ? time() : strtotime($POST['reply_time']);
	//如果已经解决，则以原解决时间为准，不再修改解决的时间
	if($rsdb['status'] >= 2 && $status==3) {
		$main['solve_time'] = $rsdb['solve_time'] ? $rsdb['solve_time'] : (!empty($POST['reply_time']) ? strtotime($POST['reply_time']):time());
	}
	$this->model->reply($id,$main, $data);
	if($liu)$this->model->sendMsg($id);
}

function check_manage($department=0,$type=0){
	global $IS_FOUNDER;
	if($IS_FOUNDER)return true;
	$manage = false;
	if($this->check_action('manager')){
		$my_manage = $this->get_acl('my_letter_manage');
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
	
	
	$cates = $this->model->get_category();
	$allcate = $cates['department'];
	if($IS_FOUNDER)return $allcate;
	$mycat = $this->get_acl('my_letter_manage');

	$return = array();
	if(isset($mycat[$act])){
        if(array_key_exists('0',$mycat[$act]))
            $return = $allcate;
        else
            foreach($mycat[$act] as $d)
                $return[$d] = $allcate[$d];
    }
	
	//处理二级部门
	$subcat = array();
	foreach($allcate as $key => $row){
		foreach($row['menus'] as $k=>$m){
			//$m['name'] = $row['name'] .' > '.$m['name'];
			$subcat[$m['id']] = $m;
		}
	}
	foreach($return as $key=>$cat){
		if(empty($cat) && isset($subcat[$key])){
			$return[$key] = $subcat[$key];
			$return[$subcat[$key]['parent']] = $allcate[$subcat[$key]['parent']];			
		}
	}
	return $return;
}
function check_acl($act,$department=0){
	global $IS_FOUNDER;
	if($IS_FOUNDER)return true;
	
	$acts = $this->getcatbyAct($act);
	return !empty($acts[$department]);

}
function manageMessage(){
	global $IS_FOUNDER;
	$my_manage = $this->getcatbyAct('manager');
//print_r($my_manage);
	$acl_where = $split = '';
	if(!$IS_FOUNDER){
        $deps = array_keys($my_manage);
		if(!$deps)
			return false;
        $did = implode(',',$deps);
		$acl_where = " WHERE department in ($did)";
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


}
