<?php
defined('PHP168_PATH') or die();

class P8_CMS_Statistic extends P8_Module{
var $main_table;		//主表
var $site_item_table;		//主表
var $data_table; 
var $member_table; 

function __construct(&$system, $name){

	$this->configurable = false;
	$this->system = &$system;
	parent::__construct($name);
	$this->main_table = $this->system->TABLE_ .'item';
	$this->site_item_table = $this->core->TABLE_ .'sites_item';
	$this->data_table = $this->TABLE_.'data';
	$this->member_table = $this->TABLE_.'member';
	$this->cluster_table = $this->TABLE_.'cluster';
	$this->sites_push_table = $this->TABLE_.'sites_push';
	$this->sites_content_table = $this->TABLE_.'sites_content';
}

function getStatic($year,$month=0,$cid=0,$model='',$uid=0, $download=false){
	global $P8LANG;
	$cids = array();
	
	$where = "1=1";
	$orderby = '';
	if($year && $month){
		$group = " day";
	
		$where .= " AND year='$year' AND month='$month'";
		$orderby = " day DESC";
	}elseif($year){
		$group = " month";
		$where .= " AND year='$year'";
		$orderby = " month DESC";
	}elseif($month){
		$group = " year";
		$where .= " AND month='$month'";
		$orderby = " year DESC";
	}else{
		$group = " year";
		$orderby = " year DESC";
	}	
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		$cids = $category->get_children_ids($cid);
		array_unshift($cids,$cid);
		$where .= " AND cid IN (".implode(',',$cids).")";
	}
	
	if($model){
		$where .= " AND model='$model'";
	}
	
	if($uid){
		$this->data_table = $this->member_table;
		$where .= " AND uid='$uid'";
	}

	$sql = "SELECT * FROM (SELECT cid,model,year,month,day,FROM_UNIXTIME(timestamp,'%Y-%m-%d %H:%i:%s') AS timestamp,SUM(post) AS post,SUM(`comment`) AS `comment`,SUM(visit) AS visit FROM {$this->data_table} WHERE $where) AS ST GROUP BY $group ORDER BY $orderby";
	//echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	if($download){
		foreach($data as $key=>$row){
			$dodata[$key]['time'] = $row['year'].($year!='0'? '-'.$row['month']:'').(($year!='0' && $month!='0')? '-'.$row['day']:'');
			$dodata[$key]['post'] = $row['post'];
			$dodata[$key]['comm'] = $row['comment'];
		}
		$headertext=array($P8LANG['date'],$P8LANG['post'],$P8LANG['comment']);
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

function getStatic_ranger($startdate='',$enddate='',$groupby='',$cid,$model,$download=false,$page=1,$page_size=20){	
	global $P8LANG;
	if($startdate){
		$where = "1=1";	
		$starttime = strtotime($startdate);
		$where .= " AND timestamp>='$starttime'";
	}
	if($enddate){
		$where = "1=1";	
		$endtime = strtotime($enddate);
		$where .= " AND timestamp<='$endtime'";
	}
	if($startdate && $enddate){
		$where = "1=1";	
		$starttime = strtotime($startdate);
		$endtime = strtotime($enddate);
		$where .= " AND timestamp>='$starttime' AND timestamp<='$endtime'";
	}
	if($groupby == 'day'){
		$field = "FROM_UNIXTIME(timestamp,'%Y年%m月%d日')";
	}
	if($groupby == 'month'){
		$field = "FROM_UNIXTIME(timestamp,'%Y年%m月')";
	}
	if($groupby == 'year'){
		$field = "FROM_UNIXTIME(timestamp,'%Y年')";
	}
	$orderby = ' date DESC';
	if($groupby && ($startdate || $enddate)) {		
		$groupby = " $groupby";
	}
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		$cids = $category->get_children_ids($cid);
		array_unshift($cids,$cid);
		$where .= " AND cid IN (".implode(',',$cids).")";
	}
	
	if($model){
		$where .= " AND model='$model'";
	}
	$sql = "SELECT $field AS date,count(1) AS post,SUM(comments) AS `comment`,SUM(views) AS views FROM {$this->system->TABLE_}item WHERE $where GROUP BY date ORDER BY $orderby";
	$data = $this->DB_slave->fetch_all($sql);	
	$dodata = array();
	if($download){
		foreach($data as $key=>$row){
			$dodata[$key]['date'] = $row['date'];
			$dodata[$key]['post'] = $row['post'];
			$dodata[$key]['views'] = $row['views'];
			$dodata[$key]['comm'] = $row['comment'];
		}
		$headertext=array($P8LANG['date'],$P8LANG['post'],$P8LANG['views'],$P8LANG['comment']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('statistic_data','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($dodata);
		$export->fileFooter();
		$export->exportFile();
	}else{
		$ret = array_chunk($data,$page_size);
		$ret_data = array(
			'data' => $ret[$page-1] ? $ret[$page-1] : array(),
			'count' => count($data),
		);
		return $ret_data;
	}
}

function getStaticMemberRanger($gid=0, $rid=0, $cid='', $model='',$page=1,$startdate='',$enddate=''){
	$cids = array();	
	$where = "1=1";		
	if($gid)
		$where .= " AND u.role_gid='$gid'";
	if($rid)
		$where .= " AND u.role_id='$rid'";
	
	$sql = "SELECT COUNT(1) as num FROM {$this->core->TABLE_}member as u WHERE $where ";
	$count = $this->DB_slave->fetch_one($sql);
	$count = $count['num'];
	$page_size = 20;
	$offset = ($page-1)*$page_size;
	if($startdate){
		$starttime = strtotime($startdate);
		$where .= " AND timestamp>='$starttime'";
	}
	if($enddate){
		$endtime = strtotime($enddate);
		$where .= " AND timestamp<='$endtime'";
	}
	if($startdate && $enddate){
		$starttime = strtotime($startdate);
		$endtime = strtotime($enddate);
		$where .= " AND timestamp>='$starttime' AND timestamp<='$endtime'";
	}
	$orderby = '';
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		foreach($cid as $id){
			if(!$id)continue;
			$cidss = $category->get_children_ids($id);
			$cid = array_merge($cid,$cidss);
		}
		$where .= " AND s.cid IN (".implode(',',$cid).")";
	}
	if($model){
		$where .= " AND s.model='$model'";
	}
	
	$sql = "SELECT u.username,u.id,u.name, s.cid,s.model,max(FROM_UNIXTIME(timestamp,'%Y')) AS year,,max(FROM_UNIXTIME(timestamp,'%m')) AS month,,max(FROM_UNIXTIME(timestamp,'%d')) AS day,
			,max(FROM_UNIXTIME(timestamp,'%Y-%m-%d %H:%i:%s')) AS timestamp,count(1) AS post FROM {$this->core->TABLE_}member AS u
			LEFT JOIN {$this->system->TABLE_}item AS s ON u.id=s.uid
			WHERE $where GROUP BY u.id,s.cid,s.model ORDER BY post DESC,u.display_order DESC LIMIT $offset,$page_size";
	echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => 'javascript:request_item(?page?)'
	));
	return array('list'=>$data,'page'=>$pages);

}

function getStatic_author($year,$month=0,$cid=0,$model='',$uid=0, $download=false){
	global $P8LANG;
	$cids = array();
	
	$where = "1=1";
	$orderby = 'num DESC';
	if($year && $month){
		$starttime = strtotime($year.'-'.$month.'-1 0:0:0');
		$endtime = strtotime($year.'-'.$month.'-31 23:59:59');
		$where .= " AND timestamp<$endtime AND timestamp>$starttime";
	}elseif($year){
		$starttime = strtotime($year.'-1-1 0:0:0');
		$endtime = strtotime($year.'-12-31 23:59:59');
		$where .= " AND timestamp<$endtime AND timestamp>$starttime";
	}elseif($month){
		$year = date('Y');
		$starttime = strtotime($year.'-'.$month.'-1 0:0:0');
		$endtime = strtotime($year.'-'.$month.'-31 23:59:59');
		$where .= " AND timestamp<$endtime AND timestamp>$starttime";	
	}
	
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		$cids = $category->get_children_ids($cid);
		array_unshift($cids,$cid);
		$where .= " AND cid IN (".implode(',',$cids).")";
	}
	
	if($model){
		$where .= " AND model='$model'";
	}
	
	if($uid){
		$this->data_table = $this->member_table;
		$where .= " AND uid='$uid'";
	}
    $data = [];
	$map = [];
	$i=0;
	foreach(['', '_x','_y','_z'] as $_k){

        $sql = "SELECT author{$_k} as author,count(author{$_k}) AS num FROM {$this->main_table} WHERE $where GROUP BY author{$_k} ORDER BY $orderby";


        $_data = $this->DB_slave->fetch_all($sql);
        foreach($_data as $row){
            $key = $row['author']?$row['author']:'无名氏';

            if(!isset($data[$map[$key]])) {
                $map[$key] = $i;
                $i++;
                $data[$map[$key]]['author'] = $key;
                $data[$map[$key]]['num'] = $row['num'];
            }elseif(empty($_k or ($_k && $key!='无名氏'))){
                $data[$map[$key]]['num'] += $row['num'];
            }
        }
    }
	if($download){
		$headertext=array($P8LANG['author'],$P8LANG['count']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('statistic','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($data);
		$export->fileFooter();
		$export->exportFile();
	}else{
		return $data;
	}

}

function getStatic_sites_author($year,$month=0,$cid=0,$model='',$uid=0, $download=false, $site=null,$page=1,$page_size=20){
	global $P8LANG;
	$cids = array();
	
	$where = "1=1";
	$orderby = 'num DESC';
	if($year && $month){
		$starttime = strtotime($year.'-'.$month.'-1 0:0:0');
		$endtime = strtotime($year.'-'.$month.'-31 23:59:59');
		$where .= " AND timestamp<$endtime AND timestamp>$starttime";
	}elseif($year){
		$starttime = strtotime($year.'-1-1 0:0:0');
		$endtime = strtotime($year.'-12-31 23:59:59');
		$where .= " AND timestamp<$endtime AND timestamp>$starttime";
	}elseif($month){
		$year = date('Y');
		$starttime = strtotime($year.'-'.$month.'-1 0:0:0');
		$endtime = strtotime($year.'-'.$month.'-31 23:59:59');
		$where .= " AND timestamp<$endtime AND timestamp>$starttime";	
	}
	
	if($model){
		$where .= " AND model='$model'";
	}
	if($site){
		$where .= " AND site='$site'";
	}
	if($uid){
		$this->data_table = $this->member_table;
		$where .= " AND uid='$uid'";
	}


    $data = [];
    $map = [];
    $i=0;
    foreach(['', '_x','_y','_z'] as $_k){

        $sql = "SELECT author{$_k} as author,count(author{$_k}) AS num FROM {$this->site_item_table} WHERE $where GROUP BY author{$_k} ORDER BY $orderby";


        $_data = $this->DB_slave->fetch_all($sql);
        foreach($_data as $row){
            $key = $row['author']?$row['author']:'无名氏';
            if(!isset($data[$map[$key]])) {
                $map[$key] = $i;
                $i++;
                $data[$map[$key]]['author'] = $key;
                $data[$map[$key]]['num'] = $row['num'];
            }elseif(empty($_k or ($_k && $key!='无名氏'))){
                $data[$map[$key]]['num'] += $row['num'];
            }
        }
    }


	if($download){
		$headertext=array($P8LANG['author'],$P8LANG['count']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('statistic','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($data);
		$export->fileFooter();
		$export->exportFile();
	}else{
		$ret = array_chunk($data,$page_size);
		$ret_data = array(
			'data' => $ret[$page-1] ? $ret[$page-1] : array(),
			'count' => count($data),
		);
		return $ret_data;
	}

}

function statistic($year,$month=0,$cid=0,$model=''){
	$cids = array();
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		$cids = $category->get_children_ids($cid);
	}
	$this->day_statistic($year,$month,$cids);
	return true;
	

}

function getStaticMember($gid=0, $rid=0, $year=0, $month=0, $cid='', $model='',$page=1){
	$cids = array();
	
	$where = "1=1";
	
	
	if($gid)
		$where .= " AND u.role_gid='$gid'";
	if($rid)
		$where .= " AND u.role_id='$rid'";
	
	$sql = "SELECT COUNT(1) as num FROM {$this->core->TABLE_}member as u WHERE $where ";
	$count = $this->DB_slave->fetch_one($sql);
	$count = $count['num'];
	$page_size = 20;
	$offset = ($page-1)*$page_size;
	
	$orderby = '';
	if($year && $month){
		$where .= " AND s.year='$year' AND s.month='$month'";
	}elseif($year){
		$where .= " AND s.year='$year'";
	}elseif($month){
		$where .= " AND s.month='$month'";
	}	
	
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		foreach($cid as $id){
			if(!$id)continue;
			$cidss = $category->get_children_ids($id);
			$cid = array_merge($cid,$cidss);
		}
		$where .= " AND s.cid IN (".implode(',',$cid).")";
	}
	if($model){
		$where .= " AND s.model='$model'";
	}
	
	$sql = "SELECT u.username,u.id,u.name,max(FROM_UNIXTIME(timestamp,'%Y-%m-%d %H:%i:%s')) AS timestamp,SUM(post) AS post,SUM(`comment`) AS `comment`,SUM(visit) AS visit 
			FROM {$this->core->TABLE_}member AS u
			LEFT JOIN {$this->member_table} AS s ON u.id=s.uid
			WHERE $where GROUP BY u.id ORDER BY post DESC,u.display_order DESC LIMIT $offset,$page_size";
	//echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	$count = 0;
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => 'javascript:request_item(?page?)'
	));
	return array('list'=>$data,'page'=>$pages);

}

function statisticMember($gid=0, $rid=0, $year, $month=0, $cid='', $model='',$step=0){
	$cids = array();
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		foreach($cid as $id){
			if(!$id)continue;
			$cidss = $category->get_children_ids($id);
			$cid = array_merge($cid,$cidss);
		}
	}
	$cids = $cid;
	$where= "1=1";
	if($gid)
		$where .= " AND role_gid='$gid'";
	if($rid)
		$where .= " AND role_id='$rid'";
	$limit = 100;
	
	$sql = "SELECT id FROM {$this->core->TABLE_}member WHERE $where LIMIT $step,$limit";
	$uids = $this->DB_slave->fetch_all($sql);
	if($uids){
		foreach($uids as $row){
			$this->day_statistic($year,$month,$cids,$row['id']);
		}
		return array('step'=>$step+$limit);
	}else{
		return array('step'=>0);
	}
	
}
function statisticCluster($year, $month=0, $cid='', $model=''){
	$this->statisticClusterDay($year,$month,$cid);
	return true;
}
function statisticClusterDay($year,$month,$cids){
	if($month){
		$begin = strtotime("$year-$month-01 00:00:00");
		$end = strtotime("+1 month",$begin);
	}else{
		$begin = strtotime("$year-01-01 00:00:00");
		$end = strtotime("+1 year",$begin);
	}
	$time = time();
	
	$cluster = $this->core->load_module('cluster');
	$cms_item_server  = $cluster->load_service('server','cms_item');
	//---------
	$where = $cids? " AND client_id IN (".implode(',',$cids).")" : '';
	$sql = "SELECT COUNT(1) FROM {$cms_item_server->table} WHERE timestamp>='$begin' AND timestamp<'$end' $where";
	$C1 = $this->DB_slave->fetch_one($sql);
	if(!$C1)return;
	//---------
	
	$table = $this->cluster_table;
	
	$sql = "DELETE FROM {$table} WHERE year='$year'";
	if($month)
		$sql .= " AND month='$month'";
	if($cids)
		$sql .= " AND client_id IN (".implode(',',$cids).")";

	$this->DB_slave->query($sql);	
	
	for($day=$begin;$day<$end;$day+=86400){
		$where = $cids? " AND client_id IN (".implode(',',$cids).")" : '';

		$sql = "SELECT client_id,cid, model,SUM(IF(status,1,0)) AS verified,SUM(IF(status,0,1)) AS unverified,COUNT(id) AS post,FROM_UNIXTIME(timestamp,'%m') AS month,FROM_UNIXTIME(timestamp,'%d') AS day FROM {$cms_item_server->table} WHERE timestamp>='$day' AND timestamp<'".($day+86400)."' $where GROUP BY client_id";
		$_pdata = $this->DB_slave->fetch_all($sql);
		$pdata = $pk = array();
		if($_pdata)foreach($_pdata as $key=>$row){
			$pdata[$row['client_id']] = $row;
			$pk[] = $row['client_id'];
		}
		
		if($pk)foreach($pk as $k){
			$post = !empty($pdata[$k])? $pdata[$k]['post'] : 0;
			$verified = !empty($pdata[$k])? $pdata[$k]['verified'] : 0;
			$unverified = !empty($pdata[$k])? $pdata[$k]['unverified'] : 0;
			$comment = 0;
			if($post){
				$model = !empty($pdata[$k])? $pdata[$k]['model'] : $cdata[$k]['model'];
				$month = !empty($pdata[$k])? $pdata[$k]['month'] : $cdata[$k]['month'];
				$date = !empty($pdata[$k])? $pdata[$k]['day'] : $cdata[$k]['day'];
				$cid = !empty($pdata[$k])? $pdata[$k]['cid'] : $cdata[$k]['cid'];
				$sql = "INSERT IGNORE {$table} (`client_id`,`cid`,`model`,`year`,`month`,`day`,`post`,`verified`,`unverified`,`timestamp`) 
						VALUES('$k','$cid','$model','$year','$month','$date','$post','$verified','$unverified','$time');";
				$this->DB_slave->query($sql);	
			}			
		}
	}	
}

function getStaticCluster($year,$month=0,$cid=0,$model='',$download=false){
	global $P8LANG;
	
	$where = "1=1";
	$orderby = '';
	if($year && $month){
		$group = " day";
	
		$where .= " AND year='$year' AND month='$month'";
		$orderby = " day DESC";
	}elseif($year){
		$group = " month";
		$where .= " AND year='$year'";
		$orderby = " month DESC";
	}elseif($month){
		$group = " year";
		$where .= " AND month='$month'";
		$orderby = " year DESC";
	}else{
		$group = " year";
		$orderby = " year DESC";
	}
	
	if($cid){
		$where .= " AND client_id ='$cid'";
	}
	
	if($model){
		$where .= " AND model='$model'";
	}


	$sql = "SELECT client_id,cid,model,year,month,day,max(FROM_UNIXTIME(timestamp,'%Y-%m-%d %H:%i:%s')) AS timestamp,SUM(post) AS post,SUM(verified) AS verified FROM {$this->cluster_table} WHERE $where GROUP BY $group ORDER BY $orderby";
	//echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	if($download){
		foreach($data as $key=>$row){
			$dodata[$key]['time'] = $row['year'].($year!='0'? '-'.$row['month']:'').(($year!='0' && $month!='0')? '-'.$row['day']:'');
			$dodata[$key]['post'] = $row['post'];
		}
		$headertext=array($P8LANG['date'],$P8LANG['post'],$P8LANG['comment']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('statistic_cluster','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($dodata);
		$export->fileFooter();
		$export->exportFile();
	}else{
		return $data;
	}

}
function downloadMember($gid, $rid, $year, $month, $cid, $model,$uids){
	global $P8LANG;
	
	$cids = array();
	
	$where = "1=1";
	$orderby = '';
	if($year && $month){
		$where .= " AND s.year='$year' AND s.month='$month'";
	}elseif($year){
		$where .= " AND s.year='$year'";
	}elseif($month){
		$where .= " AND s.month='$month'";
	}else{
	
	}
	
	
	if($cid){
		$category = $this->system->load_module('category');
		$category->get_cache(false);
		foreach($cid as $id){
			if(!$id)continue;
			$cidss = $category->get_children_ids($id);
			$cid = array_merge($cid,$cidss);
		}
		$where .= " AND s.cid IN (".implode(',',$cid).")";
	}
	if($model){
		$where .= " AND s.model='$model'";
	}
	
	if($gid){
		$gid = preg_replace('/[^0-9,]/', '', $gid);
		$gid = intval($gid);
		$where .= " AND u.role_gid='$gid'";
	}
	if($rid){
		$rid = preg_replace('/[^0-9,]/', '', $rid);
		$rid = intval($rid);
		$where .= " AND u.role_id='$rid'";
	}
	/*
	if($uids){
		$uids = substr($uids,1);
		$where .= " AND u.id IN ($uids)";
	}
	*/

	$sql = "SELECT u.username, IF(SUM(post),SUM(post),0) AS post,IF(SUM(`comment`),SUM(`comment`),0) AS `comment`
			FROM {$this->core->TABLE_}member AS u 
			LEFT JOIN {$this->member_table} AS s ON u.id=s.uid
			WHERE $where GROUP BY u.id ORDER BY post DESC,u.display_order DESC";
	//echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	if($data){
		$headertext=array($P8LANG['user'],$P8LANG['post'],$P8LANG['comment']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('statistic','download',date('Y-m-d-H-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($data);
		$export->fileFooter();
		$export->exportFile();
	}else{
		message('data_empty');
	}
}

function day_statistic($year,$month,$cids,$uid=0){
	if($month){
		$begin = strtotime("$year-$month-01 00:00:00");
		$end = strtotime("+1 month",$begin);
	}else{
		$begin = strtotime("$year-01-01 00:00:00");
		$end = strtotime("+1 year",$begin);
	}
	$time = time();
	//---------
	$where = $cids? " AND cid IN (".implode(',',$cids).")" : '';
	if($uid)$where .= " AND uid='$uid'";
	$sql = "SELECT COUNT(1) AS c0 FROM {$this->system->TABLE_}item WHERE timestamp>='$begin' AND timestamp<'$end' $where";
	$sql2 = "SELECT COUNT(1) AS c1 FROM {$this->system->TABLE_}item_unverified WHERE timestamp>='$begin' AND timestamp<'$end' $where";
	$C10 = $this->DB_slave->fetch_one($sql);
	$C11 = $this->DB_slave->fetch_one($sql2);
	$C1 = $C10['c0'] + $C11['c1'];
	
	$where = $cids? " AND i.cid IN (".implode(',',$cids).")" : '';
	if($uid)$where .= " AND c.uid='$uid'";
	/*
	$sql = "SELECT * FROM (SELECT COUNT(1) AS c2, FROM_UNIXTIME(c.timestamp,'%d') AS day FROM {$this->system->TABLE_}item_comment AS c
				LEFT JOIN {$this->system->TABLE_}item AS i ON i.id=c.iid
				WHERE c.timestamp>='$begin' AND c.timestamp<'$end' $where) AS ST GROUP BY day";
	*/
	$sql = "SELECT COUNT(1) AS c2, day FROM (SELECT COUNT(1) AS comment_count, FROM_UNIXTIME(c.timestamp,'%d') AS day FROM {$this->system->TABLE_}item_comment AS c
				LEFT JOIN {$this->system->TABLE_}item AS i ON i.id=c.iid
				WHERE c.timestamp>='$begin' AND c.timestamp<'$end' $where GROUP BY day) AS ST GROUP BY day";
	$C2 = $this->DB_slave->fetch_one($sql);
	if(!$C1 && !$C2['c2'])return;
	//---------
	
	$table = $uid? $this->member_table :$this->data_table;
	
	$sql = "DELETE FROM {$table} WHERE year='$year'";
	if($uid)
		$sql .= " AND uid='$uid'";
	if($month)
		$sql .= " AND month='$month'";
	if($cids)
		$sql .= " AND cid IN (".implode(',',$cids).")";

	$this->DB_slave->query($sql);	
	
	$uid && $r_g = $this->get_role_group($uid);
	
	for($day=$begin;$day<$end;$day+=86400){
		$where = $cids? " AND cid IN (".implode(',',$cids).")" : '';
		if($uid)$where .= " AND uid='$uid'";
		$sql = "SELECT cid, model,COUNT(id) AS post,max(FROM_UNIXTIME(timestamp,'%m')) AS month,max(FROM_UNIXTIME(timestamp,'%d')) AS day FROM {$this->system->TABLE_}item WHERE timestamp>='$day' AND timestamp<'".($day+86400)."' $where GROUP BY cid,model";
		
		$_pdata = $this->DB_slave->fetch_all($sql);
		$pdata = $pk = array();
		if($_pdata)foreach($_pdata as $key=>$row){
			$pdata[$row['cid']] = $row;
			$pk[] = $row['cid'];
		}
		
		$sql = "SELECT cid, model,COUNT(id) AS unverified,max(FROM_UNIXTIME(timestamp,'%m')) AS month,max(FROM_UNIXTIME(timestamp,'%d')) AS day FROM {$this->system->TABLE_}item_unverified WHERE timestamp>='$day' AND timestamp<'".($day+86400)."' $where GROUP BY cid,model";
		$_pdata = $this->DB_slave->fetch_all($sql);
		$udata = $uk = array();
		if($_pdata)foreach($_pdata as $key=>$row){
			$udata[$row['cid']] = $row;
			$uk[] = $row['cid'];
		}
		
		
		$where = $cids? " AND i.cid IN (".implode(',',$cids).")" : '';
		if($uid)$where .= " AND c.uid='$uid'";
		$sql = "SELECT i.cid, i.model, COUNT(c.id) AS `comment`,max(FROM_UNIXTIME(c.timestamp,'%m')) AS month,max(FROM_UNIXTIME(c.timestamp,'%d')) AS day FROM {$this->system->TABLE_}item_comment AS c
				LEFT JOIN {$this->system->TABLE_}item AS i ON i.id=c.iid
				WHERE c.timestamp>='$day' AND c.timestamp<'".($day+86400)."' $where GROUP BY i.cid,i.model";
		$_cdata = $this->DB_slave->fetch_all($sql);
		$cdata = $ck = array();
		if($_cdata)foreach($_cdata as $key=>$row){
			$cdata[$row['cid']] = $row;
			$ck[] = $row['cid'];
		}
		
		$ak = array_merge($pk,$ck,$uk);
		array_unique($ak);
		
		if($ak){		
			foreach($ak as $k){
				$post = !empty($pdata[$k])? $pdata[$k]['post'] : 0;
				$unverified = !empty($udata[$k])? $udata[$k]['unverified'] : 0;
				$comment = !empty($cdata[$k])? $cdata[$k]['comment'] : 0;
				if($post  || $comment || $unverified){
					$model = !empty($pdata[$k])? $pdata[$k]['model'] : (!empty($udata[$k])? $udata[$k]['model']:$cdata[$k]['model']);
					$month = !empty($pdata[$k])? $pdata[$k]['month'] : (!empty($udata[$k])? $udata[$k]['month']:$cdata[$k]['month']);
					$month = intval($month);
					$date = !empty($pdata[$k])? $pdata[$k]['day'] : (!empty($udata[$k])? $udata[$k]['day']:$cdata[$k]['day']);
					$date = intval($date);
					$sql = "INSERT IGNORE {$table} (".($uid? "`uid`,`role_id`,`role_gid`,":"")."`cid`,`model`,`year`,`month`,`day`,`post`,`unverified`,`comment`,`visit`,`timestamp`) 
							VALUES(".($uid? "'$uid','$r_g[role_id]','$r_g[role_gid]',":"")."'$k','$model','$year','$month','$date','$post','$unverified','$comment','0','$time');";
					$this->DB_slave->query($sql);	
				}			
			}
		}	
	}
}

function get_role_group($uid){
	$sql = "SELECT id,role_id,role_gid FROM {$this->core->TABLE_}member WHERE id='$uid'";
	return $this->DB_slave->fetch_one($sql);
	 
}

/**
* 生成缓存
* @param string $model 指定模型,如果不指定则是生成所有模型的分类
* @param bool $cache_all 是否把每个分类都缓存成一个缓存文件
* @param bool $write_cache 是否写缓存,如果否,则不写缓存,保持树形结构,用于实时刷新
* @param array $id 只缓存的分类的ID哈希 array(id1 => 1, id2 => 1 ...)
**/
function cache($cache_all = true, $write_cache = true, $id = array()){
	parent::cache();
}
function get_self_client(){
	$cluster = $this->core->load_module('cluster');
	$selfclient = $this->core->url.'/index.php/core/cluster-client';
	$sql = "SELECT id FROM {$cluster->client_table} WHERE client_url='$selfclient'";
	$query = $this->DB_slave->fetch_one($sql);
	$client_id = $query['id'];
	return $client_id;
}
/**
* 标签调用的数据, 接口
* @param array $LABEL 标签模块
* @param array $label 标签数据
* @param array $var 变量
**/
function label(&$LABEL, &$label, &$var){
	
$option = &$label['option'];

$where = $where2 = '1=1';

switch($option['timelong']){
	case '2year':
		$where .= " AND year='".(date('Y')-2)."'";
		$where2 = "timestamp >='".mktime(0,0,0,1,1,date('Y')-2)."'";
	break;
	case '1year':
		$where .= " AND year='".(date('Y')-1)."'";
		$where2 = "timestamp >='".mktime(0,0,0,1,1,date('Y')-1)."'";
	break;	
	case 'year':
		$where .= " AND year='".date('Y')."'";
		$where2 = "timestamp >='".mktime(0,0,0,1,1,date('Y'))."'";
	break;
	case 'three':
		$m = date('m');
		if($m<=3)
			$mm=1;
		elseif($m<=6)
			$mm=4;
		elseif($m<=9)
			$mm=7;
		elseif($m<=12)
			$mm=10;		
			
		$where .= " AND year='".date('Y')."' AND month>='$mm'";
		$where2 = "timestamp >='".mktime(0,0,0,$mm,1,date('Y'))."'";
	break;
	case 'month':
		$where .= " AND year='".date('Y')."' AND month='".date('n')."'";
		$where2 = "timestamp >='".strtotime(date('Y-m'))."'";
	break;
	case 'week':
		$w = mktime(0, 0, 0, date('n',P8_TIME), ((date('j',P8_TIME)+1)-date('N',P8_TIME)), date('Y',P8_TIME));
		//本周开始
		$wd = date('j',$w);
		//今天		
		$t = date('j',P8_TIME);
		if($wd<=$t){
			$week_array = range($wd,$t);
			$wds = '('.implode(',',$week_array).')';
			$where .= " AND year='".date('Y')."' AND month='".date('n')."' AND day in $wds";
		}else{
			$week_array = range($wd,31);
			$week_array2 = range(1,$t);
			$wds = '('.implode(',',array_unique($week_array)).')';
			$wds2 = '('.implode(',',array_unique($week_array2)).')';
			$where .= " AND ((year='".date('Y',$w)."' AND month='".date('n',$w)."' AND day in $wds) or ";			
			$where .= "(year='".date('Y')."' AND month='".date('n')."' AND day in $wds2))";			
		}		
		$where2 = "timestamp >='".$w."'";
	break;
	case 'day':
		$where .= " AND year='".date('Y')."' AND month='".date('n')."' AND day='".date('j')."'";
		$where2 = "timestamp >='".strtotime(date('Y-m-d H:i:s'))."'";
	break;
}

if($option['model']!=''){
	$where .= " AND model='{$option['model']}'";
}
if($option['cid']){
	$cids = html_entities($option['category']);
	$where .= " AND cid in ($cids)";
}
//排序
$order = $comma = '';
foreach($option['order_by'] as $field => $desc){
	$order .= $comma . $field .($desc ? ' DESC' : ' ASC');
	$comma = ',';
}
if(!$order)
	$order = " post DESC";
//分类
if(in_array($option['statistic_id'],array('memberpost','member','score')) && !empty($option['category'])){
	$cats = substr($option['category'],-1)==',' ? substr($option['category'],0,-1) : $option['category'];
	$where .= " AND cid in ($cats)";
}

$page_size = $option['limit'];

$role_module = $this->core->load_module('role');
$role_module->roles || $role_module->get_cache();
$syg = $all_sites = array();
foreach($role_module->roles as $ro){
	if($ro['type']=='system')$syg[] = $ro['id'];
}
$syg = implode(',',$syg);

if($option['statistic_id']=='member'){	
	$sql = "SELECT role_id,cid,SUM(post) as post, SUM(unverified) as unverified FROM {$this->member_table} WHERE $where AND role_id NOT IN($syg) GROUP BY role_id ORDER BY $order LIMIT $page_size";
}elseif($option['statistic_id']=='memberpost'){
	/*账号删除即不再纳入统计
	$sql = "SELECT u.username,u.id,u.name,u.icon,cid,SUM(s.post) as post, SUM(s.unverified) as unverified 
			FROM {$this->member_table} AS s
			LEFT JOIN {$this->core->TABLE_}member AS u ON u.id=s.uid
			WHERE $where AND s.role_id NOT IN($syg)
			GROUP BY u.id 
			ORDER BY $order LIMIT $page_size";
	*/
	$sql = "SELECT u.username,u.id,u.name,u.icon,cid,SUM(s.post) as post, SUM(s.unverified) as unverified 
			FROM {$this->member_table} AS s,{$this->core->TABLE_}member AS u where u.id=s.uid and $where AND s.role_id NOT IN($syg)
			GROUP BY u.id ORDER BY $order LIMIT $page_size";
}elseif($option['statistic_id']=='cluster'){
	$self_id = $this->get_self_client();
	$sql = "SELECT client_id,SUM(post) as post,SUM(verified) as verified,SUM(unverified) as unverified FROM {$this->cluster_table} WHERE $where AND client_id<>'$self_id' GROUP BY client_id ORDER BY $order LIMIT $page_size";
}elseif($option['statistic_id']=='govopen'){
	$sql = "SELECT jigou,COUNT(id) as post FROM {$this->system->TABLE_}item_govopen_ WHERE $where2 GROUP BY jigou ORDER BY $order LIMIT $page_size";
}elseif(in_array($option['statistic_id'],array('dept_month','dept2_month','dept_year','dept2_year'))){
	//$sql = "SELECT * FROM {$this->core->TABLE_}member_dept WHERE `parent` = 0 ORDER BY item_count desc LIMIT $page_size";
	
	$detp_list = array();
	$module_member = $this->core->load_module('member');
	$module_member->get_cache();
	
	$sql = "select id,parent,name from {$module_member->dept_table}";
	
	$query = $this->DB_slave->query($sql);
	$parents_arr = array();
	while($arr = $this->DB_slave->fetch_array($query)){
		$detp_list[$arr['id']] = $arr;
		$detp_list[$arr['id']]['count'] = 0;
		$detp_list[$arr['id']]['score'] = 0;
		if($arr['parent'] == 0) $parents_arr[] = $arr['id'];
	}
	//当月 
	if(in_array($option['statistic_id'],array('dept_month','dept2_month'))){
		$month_date = mktime(0,0,0,date('m'),1,date('Y'));
		$where = "i.timestamp >= $month_date";
	}else{
		//本年度 
		$year_date = mktime(0,0,0,1,1,date('Y'));
		$where = "i.timestamp >= $year_date";
	}
	if(in_array($option['statistic_id'],array('memberpost','member','score','dept_month','dept_year','dept2_month','dept2_year')) && !empty($option['category'])){
		$cats = substr($option['category'],-1)==',' ? substr($option['category'],0,-1) : $option['category'];
		$where .= " AND i.cid in ($cats)";
	}
	$sql = "SELECT m.dept2 as dept, COUNT(*) AS `count`,COUNT(score = '3') AS `score` FROM $this->main_table AS i INNER JOIN $module_member->table AS m ON i.uid = m.id WHERE $where  GROUP BY dept";					
}elseif($option['statistic_id']=='score'){
	/*账号删除即不再纳入统计
	$sql = "SELECT u.username,u.id,u.name,u.icon,u.dept,u.dept2,u.icon,SUM(s.score) as post
			FROM {$this->system->TABLE_}item AS s
			LEFT JOIN {$this->core->TABLE_}member AS u ON u.id=s.uid
			WHERE $where2 AND u.role_id NOT IN($syg)
			GROUP BY u.id 
			ORDER BY $order LIMIT $page_size";
	*/
	$sql = "SELECT u.username,u.id,u.name,u.icon,u.dept,u.dept2,u.icon,SUM(s.score) as post
			FROM {$this->system->TABLE_}item AS s,{$this->core->TABLE_}member AS u where u.id=s.uid and $where2 AND u.role_id NOT IN($syg)
			GROUP BY u.id ORDER BY $order LIMIT $page_size";
}elseif($option['statistic_id']=='sites_score'){
	/*账号删除即不再纳入统计
	$sql = "SELECT u.username,u.id,u.name,u.icon,u.dept,u.dept2,u.icon,SUM(s.score) as post
			FROM {$this->core->TABLE_}sites_item AS s
			LEFT JOIN {$this->core->TABLE_}member AS u ON u.id=s.uid
			WHERE $where2 AND u.role_id NOT IN($syg)
			GROUP BY u.id 
			ORDER BY $order LIMIT $page_size";
	*/
	$dot = '';
	$sites_str = '';
	if(!empty($option['sites'])){
		$sites_str = ' and s.site in (';
		$have_sites = false;
		foreach($option['sites'] as $site){
			if($site){
				$have_sites = true;
				$sites_str .= $dot."'".$site."'";
				$dot=',';
			}
		}
		$sites_str .= ')';
		if($have_sites) $where2 .= $sites_str;
	}
	$sql = "SELECT u.username,u.id,u.name,u.icon,u.dept,u.dept2,u.icon,SUM(s.score) as post
			FROM {$this->core->TABLE_}sites_item AS s,{$this->core->TABLE_}member AS u WHERE u.id=s.uid AND $where2 AND u.role_id NOT IN($syg)
			GROUP BY u.id ORDER BY $order LIMIT $page_size";
}elseif($option['statistic_id']=='sites_push'){
	$where2 = $where2 != '1=1' ? 'i.'.$where2.' AND ' : '';
	$all_sites = $this->core->CACHE->read('sites/modules', 'farm', 'all');
	$dot = '';
	$sites_str = '';
	$have_sites = false;
	if(!empty($option['sites'])){
		$sites_str = 'i.site in (';		
		foreach($option['sites'] as $site){
			if($site){
				$have_sites = true;
				$sites_str .= $dot."'".$site."'";
				$dot=',';
			}
		}
		$sites_str .= ')';		
	}
	if($have_sites){
		if($have_sites) $where2 .= $where2 ? ' AND '.$sites_str : $sites_str;
		$sql = "SELECT i.site,COUNT(*) AS `count`
			FROM {$this->core->TABLE_}sites_stop_data AS i
			INNER JOIN {$this->core->TABLE_}cms_item AS m ON i.new_id = m.id
			WHERE $where2  AND i.from = 'sites' AND i.to = 'cms'
			GROUP BY site 
			ORDER BY count DESC LIMIT $page_size";
	}else{
		$sql = "SELECT i.site,COUNT(*) AS `count`
			FROM {$this->core->TABLE_}sites_stop_data AS i
			INNER JOIN {$this->core->TABLE_}cms_item AS m ON i.new_id = m.id
			WHERE $where2 i.from = 'sites' AND i.to = 'cms'
			GROUP BY site 
			ORDER BY count DESC LIMIT $page_size";		
	}
	
}
//echo $sql,'<br/>';exit;

$query = $this->DB_slave->fetch_all($sql);

//print_r($query);

	$dot = empty($option['title_dot']) ? '' : '...';
	//幻灯片宽高
	$swidth = isset($option['width']) ? $option['width'] : 300;
	$sheight = isset($option['height']) ? $option['height'] : 300;
	
	//每行的宽度,用于多列
	$width = isset($option['rows']) && $option['rows'] > 1 ? (100/$option['rows']-1).'%' : '99%';
	$wf ='';
	if($width!='99%'){
		$wf = "width:$width;float:left;margin-right:1%";
	}
	$title_length = empty($option['title_length']) ? 0 : $option['title_length'];
	$summary_length = empty($option['summary_length']) ? 0 : $option['summary_length'];
//print_r($option);	
	$list = array();
	$list_count = array();
	$get_id = array();
	$module_member = $this->core->load_module('member');
	$module_member->get_cache();
	$parents = $module_member->get_parents(6);
	$get_sites = array();
	foreach($query as $k => $v){
		if(in_array($option['statistic_id'],array('dept_month','dept2_month','dept_year','dept2_year'))){
			if($v['dept'] && ($v['count'] || $v['score'])){
				$get_id[] = $v['dept'];
				$detp_list[$v['dept']]['count'] = $v['count'];
				$detp_list[$v['dept']]['score'] = $v['score'];
				//如果有父分类同时更新父分类
				if($parents = $module_member->get_parents($v['dept'])){
					foreach($parents as $vv){
						$detp_list[$vv['id']]['count'] += $v['count'];
						$detp_list[$vv['id']]['score'] += $v['score'];
						$get_id[] = $vv['id'];						
					}		
				}
			}			
		}elseif($option['statistic_id']=='member'){
			$role_module->roles || $role_module->get_cache();
			$v['title'] =  $role_module->roles[$v['role_id']]['name'];
			$v['all'] = $v['post'] + $v['unverified'];
		}elseif($option['statistic_id']=='memberpost'){
			$v['title'] =  $v['username'];
			$v['all'] = $v['post'] + $v['unverified'];
		}elseif($option['statistic_id']=='cluster'){
			$cluster = $this->core->load_module('cluster');
			$clients = $cluster->clients;
			$v['title'] =  $clients[$v['client_id']]['name'];
			$v['all'] = $v['post'];
		}elseif($option['statistic_id']=='govopen'){
			$modelata = $this->core->CACHE->read($this->system->name .'/modules', 'model', 'govopen','serialize');
			$filedata = $modelata['fields']['jigou']['data'];
			$v['title'] =  $filedata[$v['jigou']];
			$v['all'] = $v['post'];
		}elseif($option['statistic_id']=='score'){
			$v['title'] =  $v['name'] ? $v['name'] : $v['username'];
			$v['icon'] = attachment_url($v['icon']);
			$v['all'] = $v['post'];
		}elseif($option['statistic_id']=='sites_score'){
			$v['title'] =  $v['name'] ? $v['name'] : $v['username'];
			$v['icon'] = attachment_url($v['icon']);
			$v['all'] = $v['post'];
		}elseif($option['statistic_id']=='sites_push'){
			if($v['site']) $get_sites[] = $v['site'];			
			$v['title'] = $v['name'] = $all_sites[$v['site']]['sitename'] ? $all_sites[$v['site']]['sitename'] : $v['site'];
			$v['score'] = 0;
			$list_count[$v['site']] = $v;
		}
		$list[$k+1] = $v;
	}
	
	if(in_array($option['statistic_id'],array('dept2_month','dept2_year'))){
		//只保留二级部门
		foreach($detp_list as $did=>$dept){
			if(!in_array($dept['parent'],$parents_arr)) unset($detp_list[$did]);
		}
		$sort = array_column($detp_list,'count');
		array_multisort($sort,SORT_DESC,$detp_list);
		if(count($detp_list) > $page_size) $detp_list = array_slice($detp_list, 0, $page_size, true);
		$list = $detp_list;
	}
	if(in_array($option['statistic_id'],array('dept_month','dept_year'))){
		//只保留一级部门
		foreach($detp_list as $did=>$dept){
			if(!in_array($dept['id'],$parents_arr)) unset($detp_list[$did]);
		}
		$sort = array_column($detp_list,'count');
		array_multisort($sort,SORT_DESC,$detp_list);
		if(count($detp_list) > $page_size) $detp_list = array_slice($detp_list, 0, $page_size, true);
		$list = $detp_list;
	}
	if($option['statistic_id']=='sites_push'){
		$str_sites = '';
		$comm = '';
		foreach($get_sites as $val){
			$str_sites .= "$comm'$val'";
			$comm = ',';
		}
		$where2 = $where2 ? $where2.' AND ' : $where2;
		if($str_sites){
			$sql = "SELECT i.site,COUNT(*) AS `count`
				FROM {$this->core->TABLE_}sites_stop_data AS i
				INNER JOIN {$this->core->TABLE_}cms_item AS m ON i.new_id = m.id
				WHERE $where2 i.from = 'sites' AND i.to = 'cms' and m.score= '3' and i.site in($str_sites)
				GROUP BY site 
				ORDER BY count DESC LIMIT $page_size";
		}else{
			$sql = "SELECT i.site,COUNT(*) AS `count`
				FROM {$this->core->TABLE_}sites_stop_data AS i
				INNER JOIN {$this->core->TABLE_}cms_item AS m ON i.new_id = m.id
				WHERE $where2 i.from = 'sites' AND i.to = 'cms' and m.score= '3'
				GROUP BY site 
				ORDER BY count DESC LIMIT $page_size";
		}
		$query = $this->DB_slave->fetch_all($sql);		
		foreach($query as $k => $v){
			$list_count[$v['site']]['score'] = $v['count'];
		}
		$count_sites = count($get_sites);
		if($count_sites < $page_size){		
			foreach($all_sites as $val){
				if(!in_array($val['alias'],$get_sites) && $count_sites < $page_size){
					$list_count[] = array(
						'title' => $val['sitename'],
						'name' => $val['sitename'],
						'count' => 0,
						'score' => 0,
					);
					$count_sites ++;
				}
			}
		}
		$list = $list_count;
	}
//print_r($list);exit;
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

	return isset($pages) ? array($content, $pages) : array($content);
}	



/*************************************sites*******************************************/

function getStaticSitesPush($year,$month=0,$cid=0,$model='',$download=false){
	global $P8LANG;
	$cids = array();
	
	$where = "1=1";
	$orderby = '';
	if($year && $month){
        $group = " site, year, month";
		$where .= " AND year='$year' AND month='$month'";
		$orderby = " post DESC";
	}elseif($year){
		$group = " site, year, month";
		$where .= " AND year='$year'";
		$orderby = " post DESC";
	}else{
        $group = " site, year, month";
		$orderby = " post DESC";
    }

	$sql = "SELECT site,year,month,SUM(post) AS post,SUM(score) AS score,SUM(verified) AS verified,max(FROM_UNIXTIME(timestamp,'%Y-%m-%d %H:%i:%s')) AS timestamp FROM {$this->sites_push_table} WHERE $where GROUP BY $group ORDER BY $orderby";
	//echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	if($download){
		$sites = $this->core->load_system('sites');
		$all_sites = $sites->get_sites();
		foreach($data as $key=>$row){
			$dodata[$key]['site'] = $all_sites[$row['site']]['sitename'];
			$dodata[$key]['post'] = $row['post'];
			$dodata[$key]['verified'] = $row['verified'];
		}
        //print_r($dodata);exit;
		$headertext=array($P8LANG['name'],$P8LANG['post'],$P8LANG['verify']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('site-statistic','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($dodata);
		$export->fileFooter();
		$export->exportFile();
	}else{
		return $data;
	}

}

function statisticSitesPush($year,$month=0){
    $this->checkVefified($year,$month);
    $sites = $this->core->load_system('sites');
    $stop = $sites->load_module('stop');
    
	if($month){
		$begin = strtotime("$year-$month-01 00:00:00");
		$end = strtotime("+1 month",$begin);
	}else{
		$begin = strtotime("$year-01-01 00:00:00");
		$end = strtotime("+1 year",$begin);
	}
	$time = time();
	
    $sql = "DELETE FROM {$this->sites_push_table} WHERE year='$year'";
	if($month)
		$sql .= " AND month='$month'";

	$this->DB_slave->query($sql);

    $months = $month ? array($month) : range(1,12);
    foreach($months as $key=>$mon){
        
        $_begin = $month?$begin: strtotime("+$key month",$begin);
        $_end = $month?$end: strtotime("+1 month",$_begin);
        $sql = "SELECT site, COUNT(*) AS c FROM {$stop->table} WHERE `sc`='c' and `from`='sites' and `to` = 'cms' and timestamp>='$_begin' AND timestamp<'$_end' group by site";		
		$sql_status = "SELECT site, COUNT(*) AS count FROM {$stop->table} WHERE `sc`='c' and `status` in (1,2) and `from`='sites' and `to` = 'cms' and timestamp>='$_begin' AND timestamp<'$_end' group by site";
		/*取状态数*/
		$list_status = array();
		$query_status = $this->DB_slave->fetch_all($sql_status);		
		foreach($query_status as $k => $v){
			$list_status[$v['site']] = intval($v['count']);
		}
		$list_count = array();
		$sql_score = "SELECT i.site,COUNT(*) AS `count`
			FROM {$stop->table} AS i
			INNER JOIN {$this->main_table} AS m ON i.new_id = m.id
			WHERE i.sc='c' and i.timestamp>='$_begin' AND i.timestamp<'$_end' and m.score = '3'
			GROUP BY site";
		$query_score = $this->DB_slave->fetch_all($sql_score);		
		foreach($query_score as $k => $v){
			$list_count[$v['site']] = intval($v['count']);
		}
        $query = $this->DB_slave->fetch_all($sql);
        foreach($query as $row){
            $site = $row['site'];
            $post = intval($row['c']);
			$score = $list_count[$row['site']] ? $list_count[$row['site']] : 0;
            $verified = $list_status[$row['site']] ? $list_status[$row['site']] : 0;

            $sql = "INSERT IGNORE {$this->sites_push_table} (`site`,`year`,`month`,`post`,`verified`,`score`,`timestamp`) 
						VALUES('$site','$year','$mon','$post','$verified','$score','$time');";
			$this->DB_slave->query($sql);	
        }
    }
    return true;
}

function checkVefified($year,$month=0){
    if($month){
		$begin = strtotime("$year-$month-01 00:00:00");
		$end = strtotime("+1 month",$begin);
	}else{
		$begin = strtotime("$year-01-01 00:00:00");
		$end = strtotime("+1 year",$begin);
	}
    $sites = $this->core->load_system('sites');
    $stop = $sites->load_module('stop');
    
    $sql = "SELECT new_id FROM {$stop->table} WHERE sc='c' and status=0 and timestamp>='$begin' AND timestamp<'$end'";
    $query = $this->DB_slave->fetch_all($sql);
    $ids = array();
    
    foreach($query as $row){
        $ids[] = $row['new_id'];
    }
    $ids = array_filter($ids);
    if(empty($ids))return;
    
    $ids = implode(',',$ids);
    $sql = "SELECT id FROM {$this->system->TABLE_}item WHERE id IN ($ids)";
    
    $query = $this->DB_slave->fetch_all($sql);
    $ids = array();
    foreach($query as $row){
        $ids[] = $row['id'];
    }
    if(empty($ids))return;
    
    $ids = implode(',',$ids);
    $sql = "UPDATE {$stop->table} SET status=1 WHERE new_id IN ($ids)";
    $this->DB_slave->query($sql);
}




function getStaticSitesContent($year,$month=0,$cid=0,$model='',$download=false,$order=0){
	global $P8LANG;
	$cids = array();
	
	$where = "1=1";
	$orderby = '';
	if($year && $month){
        $group = " site, year, month";
		$where .= " AND year='$year' AND month='$month'";
		$orderby = " post DESC";
	}elseif($year){
		$group = " site, year, month";
		$where .= " AND year='$year'";
		$orderby = " post DESC";
	}else{
        $group = " site, year, month";
		$orderby = " post DESC";
    }

	$sql = "SELECT site,year,month,SUM(views_im) AS views_im,SUM(views) AS views,SUM(post) AS post,SUM(verified) AS verified,SUM(post_im) AS post_im,SUM(verified_im) AS verified_im,SUM(verified) AS verified,max(FROM_UNIXTIME(timestamp,'%Y-%m-%d %H:%i:%s')) AS timestamp FROM {$this->sites_content_table} WHERE $where GROUP BY $group ORDER BY $orderby";
	//echo $sql;exit;
	$data = $this->DB_slave->fetch_all($sql);
	$_data = array();
	$sites = $this->core->load_system('sites');
	$all_sites = $sites->get_sites();
	foreach($data as $key=>$row){
		if(array_key_exists($row['site'],$all_sites) && $row['post']) $_data[] = $row;
	}
	$data = $_data;
	//排序
	if($order){
		$sortdata = array();		
		foreach($data as $key=>$row){
			$data[$row[site]] = $row;
		}
		foreach($all_sites as $site=>$v){
			if(isset($data[$site])){
				$sortdata[] = $data[$site];
			}
		}
		$data = $sortdata;		
	}
	if($download){
		$dodata = array();	
		foreach($data as $key=>$row){			
			$dodata[$key]['site'] = $all_sites[$row['site']]['sitename'] ? $all_sites[$row['site']]['sitename'] : $row['site'];
			$dodata[$key]['post'] = $row['post'];
			$dodata[$key]['post_im'] = $row['post_im'];
			$dodata[$key]['post_unim'] = $row['post'] - $row['post_im'];			
			$dodata[$key]['verified'] = $row['verified'];			
			$dodata[$key]['verified_im'] = $row['verified_im'];
			$dodata[$key]['verified_unim'] = $row['verified'] - $row['verified_im'];
			$dodata[$key]['views'] = $row['views'];
			$dodata[$key]['views_im'] = $row['views_im'];
			$dodata[$key]['views_unim'] = $row['views'] - $row['views_im'];
		}
		$headertext=array($P8LANG['sitename'],$P8LANG['post'],$P8LANG['post_im'],$P8LANG['post_unim'],$P8LANG['verified_number'],$P8LANG['verified_im'],$P8LANG['verified_unim'],$P8LANG['views'],$P8LANG['views_im'],$P8LANG['views_unim']);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('site-statistic','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($dodata);
		$export->fileFooter();
		$export->exportFile();
	}else{
		return $data;
	}
}

function statisticSitesContent($year,$month=0){
    $this->checkVefified($year,$month);
    $sites = $this->core->load_system('sites');
    $item = $sites->load_module('item');
    $farm_module = $sites->load_module('farm');
	
	if($month){
		$begin = strtotime("$year-$month-01 00:00:00");
		$end = strtotime("+1 month",$begin);
	}else{
		$begin = strtotime("$year-01-01 00:00:00");
		$end = strtotime("+1 year",$begin);
	}
	$time = time();
	
    $sql = "DELETE FROM {$this->sites_content_table} WHERE year='$year'";
	if($month)
		$sql .= " AND month='$month'";

	$this->DB_slave->query($sql);

    $months = $month?array($month):range(1,12);
	foreach($months as $key=>$mon){
        
        $_begin = $month?$begin: strtotime("+$key month",$begin);
        $_end = $month?$end: strtotime("+1 month",$_begin);
        
        $undata = array();
        $sql = "SELECT site, COUNT(1) AS c  FROM {$item->unverified_table} WHERE timestamp>='$_begin' AND timestamp<'$_end' group by site";
        $query = $this->DB_slave->fetch_all($sql);
        foreach($query as $row){
            $undata[$row['site']] = $row['c'];	
        }
        
        
        $sql = "SELECT site, COUNT(1) AS c,sum(views) AS views  FROM {$item->main_table} WHERE timestamp>='$_begin' AND timestamp<'$_end' group by site";
        $query = $this->DB_slave->fetch_all($sql);
        foreach($query as $row){
            $site = $row['site'];
            $unverified = isset($undata[$row['site']])?$undata[$row['site']]:0;
            $verified = $row['c'];
            $post = $row['c']+$unverified;
			$views = $row['views'];
            
            $sql = "INSERT IGNORE {$this->sites_content_table} (`site`,`year`,`month`,`post`,`views`,`verified`,`unverified`,`timestamp`) 
						VALUES('$site','$year','$mon','$post','$views','$verified','$unverified','$time');";
			$this->DB_slave->query($sql);	
        }
		//重点栏目
		
		foreach($sites->get_sites() as $site_alias => $sites_val){
			if(empty($sites_val['status'])) continue;			
			$farm_data = $farm_module->get_site($site_alias);
			$farm_data['config'] = p8_stripslashes(mb_unserialize($farm_data['config']));
			$statistic_cats = isset($farm_data['config']['statistic_cats']) && $farm_data['config']['statistic_cats'] ? $farm_data['config']['statistic_cats'] : array();
			if($statistic_cats){
				$statistic_cats = implode(',',$statistic_cats);
				$sql = "SELECT `site`, COUNT(1) AS c  FROM {$item->unverified_table} WHERE `timestamp`>='$_begin' AND `timestamp`<'$_end' and `site` = '$site_alias' and `cid` in ($statistic_cats)";
				$unrow = $this->DB_slave->fetch_one($sql);				
				
				$sql = "SELECT `site`, COUNT(1) AS c, sum(views) AS views  FROM {$item->main_table} WHERE `timestamp`>='$_begin' AND `timestamp`<'$_end' and `site` = '$site_alias' and `cid` in ($statistic_cats)";
				
				$row = $this->DB_slave->fetch_one($sql);
				if($row['c'] || $unrow['c']){
					$unverified = isset($unrow['c'])?$unrow['c']:0;
					$verified_im = $row['c'];//采用量
					$post_im = $row['c']+$unverified;//投稿量
					$views = $row['views'];
					
					$sql = "UPDATE {$this->sites_content_table} SET `post_im` = '$post_im',`views_im` = '$views', `verified_im` = '$verified_im' WHERE `site`='$site_alias' and `year`='$year' and `month`='$mon';";
					$this->DB_slave->query($sql);	
				}
			}
		}
        
        
    }
    return true;
}

}
