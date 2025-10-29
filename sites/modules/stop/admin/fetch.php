<?php
defined('PHP168_PATH') or die();
$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
    $id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
    $ids = implode(',',$id);
    
    $cid = isset($_POST['cid'])? intval($_POST['cid']):0;
    $cid or exit('[]');
    
    $item = &$this_system->load_module('item');
  
    $query = $core->DB_master->query("SELECT * FROM {$this_module->table} WHERE id IN ($ids)");
    
	$controller = &$core->controller($item);
	
	$ret = $res = array();
    while($data = $core->DB_master->fetch_array($query)){
        $_REQUEST['model'] = $data['model'];
        $this_system->init_model();
        $item->set_model($_REQUEST['model']);
        $data['data'] = mb_unserialize($data['data']);
        $data['data']['verify'] = 1;
		$data['data']['verifier'] = $USERNAME;
       // $data['data']['timestamp'] = date('Y-m-d H:i:s',$data['data']['timestamp']);
       // $data['data']['list_order'] = date('Y-m-d H:i:s',$data['data']['list_order']);
	   //unset($data['data']['timestamp'],$data['data']['list_order']);//主站推送给分站的时间，客户须要是最新时间，不能是主站发布的旧时间。
        $data['data']['cid'] = $cid;
		$data['data']['html'] = 1;
		if($iid = $controller->add($data['data'],true,false)){
           $res[]=$data['id'];
            //追加
            if(!empty($data['data']['addon'])){
                foreach($data['data']['addon'] as $vv){
                    $vv['iid'] = $iid;
                    $controller->addon($vv);
                }
            }
			$new_id = isset($data['new_id']) && intval($data['new_id']) ? intval($data['new_id']) : 0;
			//提取后删除未审核对应的数据
			if($new_id){
				$del = $controller->delete(array(
					'where' => $item->unverified_table .".id = '".$new_id."'",
					'verified' => false,
					'delete_hook' => true,
					'iid' => $new_id
				));	
			}
			//设置接收端
            $push_id = $this_module->set_receive_status(array($this_system->SITE), $data['id'],1,$iid);
			//设置发送端
			if($push_id) $this_module->set_push_item_status($iid,1,array($this_system->SITE), $push_id['id']);
        }
    }
    exit(json_encode($res));
    
}    
