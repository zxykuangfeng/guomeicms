<?php
/**
* 获取主站统计信息。
* 返回list和count
**/

require_once dirname(__FILE__) .'/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
/*
direct 1 水平
direct 0 垂直
*/
$direct = isset($request['direct']) && $request['direct'] ? 1 : 0;
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;

$this_module = $core->load_module('member');
$config = $core->get_config('core', 'member');
//修复栏目内容数
$DB_master->update($this_module->dept_table, array('item_count' => 0,'item_score' => 0,'item_count_sites' => 0,'item_score_sites' => 0), '');
			
//1970-01-01
$set_date['statistic_start_date'] = $statistic_start_date = isset($config['statistic_start_date']) && $config['statistic_start_date'] ? intval($config['statistic_start_date']) : 0;
//2050-01-01
$set_date['statistic_end_date'] = $statistic_end_date = isset($config['statistic_end_date']) && $config['statistic_end_date'] ? intval($config['statistic_end_date']) : 2524579200;
if($statistic_end_date < P8_TIME) $statistic_end_date = $set_date['statistic_end_date'] = P8_TIME;
if($set_date['statistic_start_date'] < $set_date['statistic_end_date']){
	$set_date['statistic_date'] = P8_TIME;
	$this_module->set_config($set_date);
}
			
$systems = $core->list_systems();
$this_sys = $core->load_system('sites');
$item = $this_sys->load_module('item');					
$where = "m.dept2 >0 and i.timestamp >= $statistic_start_date and i.timestamp <= $statistic_end_date";		
$all_sites = $this_sys->get_sites();
foreach($all_sites as $site=>$site_tmp){
	if(empty($site_tmp['status'])) unset($all_sites[$site]);
}						
$where .= ' and i.site in (\''. implode("','",array_keys($all_sites)) .'\')';

$SQL = "SELECT m.dept2 as dept, COUNT(*) AS `count` FROM $item->main_table AS i INNER JOIN $this_module->table AS m ON i.uid = m.id WHERE $where and i.score>0  GROUP BY dept";
$list = $DB_master->fetch_all($SQL);
$score_list = array();
foreach($list as $score){
	$score_list[$score['dept']] = $score['count'];
}
$SQL = "SELECT m.dept2 as dept, COUNT(*) AS `count` FROM $item->main_table AS i INNER JOIN $this_module->table AS m ON i.uid = m.id WHERE $where  GROUP BY dept";
$query = $DB_master->query($SQL);
while($arr = $DB_master->fetch_array($query)){
	$this_module->update_count('sites',$arr['dept'], $arr['count'],intval($score_list[$arr['dept']]['count']));
}

$member_dept = $core->TABLE_.'member_dept';
$main_table = $core->TABLE_.'sites_item';
$site_table = $core->TABLE_.'sites_site';
$dept_count = array();

$dept_all = $DB_master->fetch_all("SELECT * FROM ".$member_dept);
$depts = array();
foreach($dept_all as $key=>$v){
	$depts[$v['id']] = $v;
}
$dept_list = $DB_master->fetch_all("SELECT * FROM ".$member_dept." WHERE `parent` != 0 and `parent` in (select `id` from ".$member_dept." where `parent` = 0) ORDER BY item_count_sites DESC LIMIT 10");

//排除不想显示的部门
$clean_dept = array('9999','8888','7777');

$order = array_column($dept_list,'item_count_sites');
array_multisort($order,SORT_ASC,$dept_list);

foreach($dept_list as $key=>$v){
	if($v['item_count_sites'] < 1 || in_array($v['id'],$clean_dept)) continue;
	$dept_count['name'][] = $depts[$v['parent']]['name']." ".$v['name'];
	$dept_count['data'][] = $v['item_count_sites'] ? $v['item_count_sites'] : 0;
	$dept_count['score'][] = $v['item_score_sites'] ? $v['item_score_sites'] : 0;
}
$dept_count_json = json_encode($dept_count);
?>
<!DOCTYPE html>
<html lang="zh-CN" style="height: 100%">
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="<?php echo $reflash;?>">	
</head>
<body style="height: 100%; margin: 0">
  <div id="container" style="height: 100%"></div>
<script type="text/javascript" src="./../../js/plant/echarts.min.js"></script>
<script type="text/javascript">
var myChart = echarts.init(document.getElementById('container'));
var dept_count_json = <?php echo $dept_count_json;?>;
var option = {			
	  tooltip: {
		trigger: 'axis',
		axisPointer: {
		  type: 'shadow'
		}
	  },
	  legend: {},
	  toolbox: {
		feature: {
			saveAsImage: {},			
			magicType: {
				type: ['line', 'bar']
			}
		}
	},
	  grid: {
		top: '3%',
		left: '3%',
		right: '4%',
		bottom: '3%',
		containLabel: true
	  },
	  <?php if($direct){ ?>
		yAxis: [{
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine:{show: false}
		},
		{
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine:{show: false}
		}
		],
		xAxis: {
			type: 'category',
			data: dept_count_json.name,
		},
		series: [{
			data: dept_count_json.data,
			type: 'bar',				
		},
		{
			data: dept_count_json.score,
			type: 'bar',
			yAxisIndex: 1,
		}
		]
	  <?php }else{?>
		xAxis: [{
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine:{show: false}
		},
		{
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine:{show: false}
		}
		],
		yAxis: {
			type: 'category',
			data: dept_count_json.name,
		},
		series: [{
			data: dept_count_json.data,
			type: 'bar',				
		},
		{
			data: dept_count_json.score,
			type: 'bar',
			xAxisIndex: 1,
		}
		]
	  
	  <?php }?>
	};	
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>