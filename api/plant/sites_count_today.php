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
$direct = isset($request['direct']) ? intval($request['direct']) : 1;
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;

$this_system = $core->load_system('sites');
$this_module = $this_system->load_module('item');
$all_sites = $this_system ->get_sites();
//构建时间组合
$timestamp = strtotime("-1 months",P8_TIME);
for($i=31;$i>=0;$i--){
	if(strtotime('-'.$i.' day', P8_TIME) <= $timestamp) continue;
	$date_ = date('m-d',strtotime('-'.$i.' day', P8_TIME));
	$month[$date_] = $date_;
	
}
$lists = array();
$legend = array();
$empty_date = array();
$site_count = 0;
foreach($all_sites as $sites){
	if(empty($sites['status'])) continue;
	$site_count ++;
	$site = $sites['alias'];
	
	foreach($month as $mon){
		$lists[$site][$mon] = 0;		
	}
	
	$SQL = "select FROM_UNIXTIME(timestamp, '%m-%d') as timestamp, count(*) as count from ".$this_module->main_table." where timestamp> ".$timestamp." and timestamp< ".P8_TIME." and site = '".$site."' group by FROM_UNIXTIME(timestamp, '%m-%d')";
	$sites_list = $DB_master->fetch_all($SQL);
	foreach($sites_list as $list){
		$lists[$site][$list['timestamp']] = intval($list['count']);		
	}
	
	//全部为空，则删除本站点数据
	if(array_sum($lists[$site]) ==0){
		unset($lists[$site]);
		$site_count --;
		continue;
	}else{
		$legend[$site] = $sites['sitename'];
	}
	foreach($month as $mon){
		if(!$lists[$site][$mon]){
			$empty_date[] = $mon;
		}
	}
}
//找出所有站点都没发数据的日期
$emp_date = array();
foreach(array_count_values($empty_date) as $date=>$count){
	if($site_count == $count){
		$emp_date[] = $date;
		unset($month[$date]);//清理整理时间
	}
}
//清除不要的数据
foreach($lists as $site=>$val){
	foreach($val as $date=>$v){
		if(in_array($date,$emp_date)) unset($lists[$site][$date]);
	}	
}
$del_date = array();
foreach($sum_count as $date => $sum){
	if(!$sum) $del_date[] = $date;
}

$legend_json = json_encode(array_values($legend));
$month_json = json_encode(array_values($month));

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
var option = {
	color:['#5470c6','#91cc75','#fac858','#ff0033','#73c0de','#3ba272','#fc8452','#9a60b4','#ea7ccc'],	
	tooltip: {
	trigger: 'axis'
	},
	toolbox: {
		feature: {
			saveAsImage: {},
			magicType: {
				type: ['line', 'bar', 'stack']
			}
		}
	},
	legend: {
	data: <?php echo $legend_json;?>,
	textStyle:{
	color:"#53868B",
	}
	},
	grid: {
	left: '3%',
	right: '3%',
	bottom: '3%',
	containLabel: true
	},
	<?php if($direct) {?>
	xAxis: {
		type: 'category',
		boundaryGap: false,
		data: <?php echo $month_json;?>,
	},
	yAxis: {
		type: 'value',
		splitLine:{
		show:false
		}
	},
	<?php }else{?>
	xAxis: {
	type: 'value',
		splitLine:{
			show:false
		}		
	},
	yAxis: {
		type: 'category',
		boundaryGap: false,
		data: <?php echo $month_json;?>,
	},
	<?php }?>
	series: [
	<?php foreach($lists as $site => $data){ ?>
	{
	name: '<?php echo $legend[$site];?>',
	type: 'line',
	smooth: true,
	data: <?php echo json_encode(array_values($data));?>
	},
	<?php }?>
	]
	};	
	if (option && typeof option === 'object') {
	myChart.setOption(option);
	}
	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>