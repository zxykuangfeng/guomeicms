<?php
$__FILE__ = __FILE__;

require_once dirname($__FILE__).'/../inc/init.php';
defined('PHP168_PATH') or die();
ini_set("session.cookie_httponly", 1);
session_set_cookie_params(0, NULL, NULL, NULL, TRUE);
header("Set-Cookie: hidden=value; httpOnly");
require_once PHP168_PATH .'inc/safepost.php';
$systems = $core->list_systems();
$allsites = array();
$site = isset($_GET['site']) ? p8_stripslashes2(xss_clear($_GET['site'])) : 'allstation';
$search_type = isset($_GET['search_type']) ? intval($_GET['search_type']) : 0;
$starttime = isset($_GET['starttime']) ? (trim($_GET['starttime'])!='' ? strtotime(trim($_GET['starttime']).' 0:0:0') : '') : '';
$endtime = isset($_GET['endtime']) ? (trim($_GET['endtime'])!='' ? strtotime(trim($_GET['endtime']).' 23:59:59') : '') : '';

$model = isset($_GET['model']) ? xss_clear($_GET['model']) : '';
if(isset($systems['sites']) && $systems['sites']['enabled']) {
    $sites = $core->load_system('sites');
    $allsites = $sites->get_sites();
    $site = count($allsites)==0 || ($site && !in_array($site,array_keys($allsites))) ? 'allstation' : (empty($site) ? 'allstation': $site);
    $p8_select = $site && $site != 'allstation' ? $allsites[$site]['sitename'] : '全站';
}else{
    $p8_select = "全站";
	$site = '';
}

$pages = '';
$count = 0;
//关键字
$keyword = isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '';
//$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '');
if(!strlen($keyword)){
    include template($core,'search','index');
	exit;
}

$year = isset($_GET['year']) ? p8_stripslashes2(trim($_GET['year'])) : '';
if($year){
	$starttime = strtotime($year.'-1-1 0:0:0');
	$endtime = strtotime($year.'-12-31 23:59:59');
}
$page_url = $year_url = $this_url .'?word='. urlencode($keyword);
$page_url .= '&page=?page?';
if($year) $page_url .= '&year='.$year;
$year_url .= '&page='.$page.'&search_type='.$search_type.'&model='.$model.'&year=';
if($search_type) $page_url .= $page_url.'&search_type='.$search_type;
if($site) $page_url .= '&site=?site?';
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
if($cid) $page_url .= '&cid=?cid?';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);

$list = array();
$page_size = 20;
$is_sites = false;
$sites_enabled = isset($systems['sites']) && $systems['sites']['enabled'];
if($sites_enabled && $site && !in_array($site,array('allstation','mainstation')) && in_array($site,array_keys($allsites))) {
   $is_sites = true;
}

//begin build sql
$this_system = $is_sites ? $core->load_system('sites') : $core->load_system('cms');
$this_module = $this_system->load_module('item');
$category = &$this_system->load_module('category');
if($is_sites){
	$this_system->load_site($site);
	$category->get_cache(true,$site);
}else{
    $category->get_cache();
}
$select = select();
//有分类
if($cid){
	$cids = array($cid);
	if(isset($category->categories[$cid]['categories'])){
		$cids = $category->get_children_ids($cid) + $cids;
	}
	$select->in('i.cid', $cids);
}
$keyword = html_entities($keyword);

if($model){
	$models = $this_system->get_models();
	$model = $model && isset($models[$model]) ? $model : '';
	if($model) $this_module->set_model($model);
}
$T = $model ? $this_module->table : $this_module->main_table;
$T = $search_type == 2 ? $this_module->main_table : $T;
$select->from($T . ' AS i', 'i.id,i.frame,i.title_bold as site,i.views,i.timestamp,i.create_time,i.model,i.cid,i.title,i.url,i.author,i.username,i.source,i.summary,i.list_order');

if($is_sites) {
	$select->from($T . ' AS i', 'i.id,i.frame,i.site,i.views,i.timestamp,i.create_time,i.model,i.cid,i.title,i.url,i.author,i.username,i.source,i.summary,i.list_order');
	$select->in('i.site', $site);
}
switch($search_type){
	case '1':
		$select->search('i.title', $keyword);
	break;
	case '2':
		$this_system->init_model();
		if(empty($model)){
			$this_module->set_model('article');
		}
		$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
		$select->search('a.content', $keyword,'(');
		$select->where_or();
		$select->search('i.title', $keyword,'',')');
	break;
	case '3':
		$select->search('i.author', $keyword);
	break;
	case '4':
		$select->in('i.username', $keyword);
	break;
	case '5':
		$select->search('i.source', $keyword);
	break;
	default:		
		$select->search('i.title', $keyword,'(');
		$select->where_or();
		$select->search('i.summary', $keyword,'',')');	
}
/*
* 如果有年份，按年份
*/
if($year){
	$select->where_and();
	$fromtime = $year ? strtotime($year.'-1-1 0:0:0') : 0;
	$totime = $year ? strtotime($year.'-12-31 23:59:59') : 0;
	$select->range('i.timestamp', $fromtime, $totime);
}else{
	if($starttime || $endtime){
		$select->where_and();
		$starttime_r = $starttime == '' ? 0 : $starttime;
		$endtime_r = $endtime == '' ? 0 : $endtime;
		$select->range('i.timestamp', $starttime_r, $endtime_r);
	}
}

//取年份
$get_year = $list_year = array();
$select_year = select();
$select_year->from($T. ' AS i', 'i.timestamp');	
$select_year->order('i.timestamp DESC');
$list_year = $core->list_item($select_year,array('page' => 0));
foreach($list_year as $k => $v){
	$get_year[] = date('Y',$v['timestamp']);
}
$get_year = array_unique($get_year);
//取数据
$count = 0;
$select->order('i.timestamp DESC');

//echo $select->build_sql();echo "<br/>";
//

/*全站搜索*/
if($site == 'allstation' && $sites_enabled) {	
	$sites_system = $core->load_system('sites');
	$item_module = $sites_system->load_module('item');
	$sites_category = &$sites_system->load_module('category');
	$select_sites = select();	
	
	if($model){
		$models = $sites_system->get_models();
		$model = $model && isset($models[$model]) ? $model : '';
		if($model) $item_module->set_model($model);
	}
	$T = $model ? $item_module->table : $item_module->main_table;
	$T = $search_type == 2 ? $item_module->main_table : $T;
	$select_sites->from($T . ' AS i', 'i.id,i.frame,i.site,i.views,i.timestamp,i.create_time,i.model,i.cid,i.title,i.url,i.author,i.username,i.source,i.summary,i.list_order');

	switch($search_type){
		case '1':
			$select_sites->search('i.title', $keyword);
		break;
		case '2':
			$sites_system->init_model();
			if(empty($model)){
				$item_module->set_model('article');
			}
			$select_sites->inner_join($item_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
			$select_sites->search('a.content', $keyword,'(');
			$select_sites->where_or();
			$select_sites->search('i.title', $keyword,'',')');
		break;
		case '3':
			$select_sites->search('i.author', $keyword);
		break;
		case '4':
			$select_sites->in('i.username', $keyword);
		break;
		case '5':
			$select_sites->search('i.source', $keyword);
		break;
		default:		
			$select_sites->search('i.title', $keyword,'(');
			$select_sites->where_or();
			$select_sites->search('i.summary', $keyword,'',')');	
	}
	/*
	* 如果有年份，按年份
	*/
	if($year){
		$select_sites->where_and();
		$fromtime = $year ? strtotime($year.'-1-1 0:0:0') : 0;
		$totime = $year ? strtotime($year.'-12-31 23:59:59') : 0;
		$select_sites->range('i.timestamp', $fromtime, $totime);
	}else{
		if($starttime || $endtime){
			$select_sites->where_and();
			$starttime_r = $starttime == '' ? 0 : $starttime;
			$endtime_r = $endtime == '' ? 0 : $endtime;
			$select_sites->range('i.timestamp', $starttime_r, $endtime_r);
		}		
	}
	
	//取数据
	$count = 0;
	$select_sites->order('i.timestamp DESC');
	$sql_count = '('.$select->build_count_sql().') union all ('.$select_sites->build_count_sql().')';
	$count_num = $core->DB_master->fetch_all($sql_count);
	$cms_count = $count_num[0]['num'];
	$sites_count = $count_num[1]['num'];
	//总数量
	$count = $count_num[0]['num'] + $count_num[1]['num'];
	//总页数
	$page_count = ceil($count / $page_size);
	$cms_page_count = ceil($count_num[0]['num'] / $page_size);
	$sites_page_count = ceil($count_num[1]['num'] / $page_size);	
	//都有数据，共超过1页
	if($cms_page_count && $sites_page_count){	
		//1.总数只有一页的情况下
		if($page_count<=1){
			$select->limit(($page-1)*$page_size, $page_size);	
			$select_sites->limit(($page-1)*$page_size, $page_size);
			$sql_list =  '('.$select->build_sql().') union all ('.$select_sites->build_sql().')';		
			$list = $core->DB_master->fetch_all($sql_list);			
		}else{
			//2.总数超过1页，都有数据时，先显示主站再显示站群数据
			//2.1页数小于cms最大页数-1时，只显示cms
			if($page<=$cms_page_count-1){
				$list = $core->list_item(
					$select,
					array(
						'page' => &$page,
						'count' => &$count,
						'page_size' => $page_size
					)
				);
			}
			//2.2 等于cms最大页码时，显示两种数据
			if($page == $cms_page_count){
				$list = $core->list_item(
					$select,
					array(
						'page' => &$page,
						'count' => &$count,
						'page_size' => $page_size
					)
				);
				$list_sites = $core->list_item(
					$select_sites,
					array(
						'page' => 1,
						'count' => 0,
						'page_size' => $page_size*$page - $count_num[0]['num']
					)
				);
				foreach($list_sites as $item){
					$list[] = $item;
				};
			}
			//2.3 大于cms页码时，只显示sites数据
			if($page>$cms_page_count){
				$list = $core->list_item(
					$select_sites,
					array(
						'page' => $page - $cms_page_count,
						'count' => &$count,
						'start_num'=> $page_size*$page - $count_num[0]['num'] - 1,
						'page_size' => $page_size
					)
				);
			}
			
		}
	}else{
		//只有cms有数据时
		if($cms_page_count && empty($sites_page_count)){
			$list = $core->list_item(
				$select,
				array(
					'page' => &$page,
					'count' => &$count,
					'page_size' => $page_size
				)
			);
		}
		//只有sites有数据时
		if(empty($cms_page_count) && $sites_page_count){
			$list = $core->list_item(
				$select_sites,
				array(
					'page' => &$page,
					'count' => &$count,
					'page_size' => $page_size
				)
			);
		}
		
	}
}else{
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => $page_size
		)
	);
	$page_count = ceil($count / $page_size);
}


//分页
$pages = list_page(array(
    'count' => $count,
    'site' => $site,
    'page' => $page,
    'page_size' => $page_size,
	'cid' => $cid,
    'url' => $page_url
));
//处理URL
foreach($list as $k => $v){
	if($site == 'allstation' && $sites_enabled){
		if($v['site'] != '1' && $v['site'] != '0' && !in_array($v['site'],array_keys($allsites))){
			//清除无效数据
			unset($list[$k]);
			continue;
		}
		$is_sites_flag = in_array($v['site'],array_keys($allsites));
		$v['#category'] = $category->categories[$v['cid']];
		if($is_sites_flag){			
			$sites_system->load_site($v['site']);
			$sites_category->get_cache(true,$v['site']);
			$item_module->site = $sites_system->site;
			$item_module->controller = str_replace("/index.php/sites/","/s.php/".$v['site']."/",$item_module->controller);
			$item_module->controller = str_replace("/index.php/cms/","/s.php/".$v['site']."/",$item_module->controller);
			$v['#category'] = $sites_category->categories[$v['cid']];			
		}		
		$list[$k]['url'] = $is_sites_flag ? $sites_system->site_p8_url($item_module, $v, 'view') : p8_url($this_module, $v, 'view');
		//var_dump($list[$k]['url']);
		$list[$k]['frame'] = attachment_url($v['frame']);
		$list[$k]['summary'] = html_entity_decode($v['summary']);
		$list[$k]['summary'] = preg_replace('/(amp;)+/','', $list[$k]['summary']);
		$list[$k]['summary'] = str_replace($keyword,'<font color="red">'.$keyword.'</font>',$list[$k]['summary']);
		$list[$k]['title'] = str_replace($keyword,'<font color="red">'.$keyword.'</font>',$v['title']);	
		//分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		//分类地址
		$list[$k]['category_url'] = $v['#category']['url'];
	}else{
		$v['#category'] = $category->categories[$v['cid']];
		//var_dump($v);
		//var_dump($this_module);
		$list[$k]['url'] = $is_sites ? $this_system->site_p8_url($this_module, $v, 'view') : p8_url($this_module, $v, 'view');
		$list[$k]['frame'] = attachment_url($v['frame']);
		$list[$k]['summary'] = html_entity_decode($v['summary']);
		$list[$k]['summary'] = preg_replace('/(amp;)+/','', $list[$k]['summary']);
		$list[$k]['summary'] = str_replace($keyword,'<font color="red">'.$keyword.'</font>',$list[$k]['summary']);
		$list[$k]['title'] = str_replace($keyword,'<font color="red">'.$keyword.'</font>',$v['title']);	
		//分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		//分类地址
		$list[$k]['category_url'] = $v['#category']['url'];
	}	
}

//标签云
function getCloud( $data = array(), $minFontSize = 12, $maxFontSize = 30 )
{
    $minimumCount = min( array_values( $data ) );
    $maximumCount = max( array_values( $data ) );
    $spread = $maximumCount - $minimumCount;
    $cloudHTML = '';
    $cloudTags = array();
	$spread == 0 && $spread = 1;
    foreach($data as $tag => $count )
    {
        $size = $minFontSize + ( $count - $minimumCount )
            * ( $maxFontSize - $minFontSize ) / $spread;
        $cloudTags[] = '<a style="color:#'.randColor().';font-size: ' . floor( $size ) . 'px'
            . '" href="?word='.$tag.'" title="\'' . $tag .
            '\' 热度 ' . $count . '">'
            . htmlspecialchars( stripslashes( $tag ) ) . '</a>';
    }

    return join( "\n", $cloudTags ) . "\n";
}
function randColor(){
    $colors=array('FF0000','0000FF','FF00FF','000000','70DB93','5C3317','9F5F9F','D9D919','A67D3D','FF7F00','8E6B23','6F4242','FF7F00',
    '42426F','2F4F2F','9932CD','871F78','7093DB','32CD99','6B8E23','2F2F4F','23238E','00009C','CFB53B','6B4226','D8BFD8','CC3299','99CC32');
    $show_color = array_rand($colors, 1);
    return $colors[$show_color];
}
function shuffle_assoc($list) {
    if (!is_array($list)) return $list;
    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key)
        $random[$key] = $list[$key];
    return $random;
}
$listdb = $DB_master->fetch_all("select name,item_count from ".$core->TABLE_.'cms_item_tag'." ORDER BY id DESC limit 30");
foreach ($listdb as $item) {
  $keywind[$item['name']] = $item['item_count'];
}
$keywind = shuffle_assoc($keywind);

$usetime = substr(get_timer() - $P8['start_time'], 0, 7);
$LABEL_POSTFIX = array('search');
include template($core,'search','index');