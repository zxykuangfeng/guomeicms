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

$main_table = $core->TABLE_.'sites_item';
$site_table = $core->TABLE_.'sites_site';
$sites_count = array();
//本年度
$timestamp = mktime(0,0,0,1,1,date('Y'));
$sites_list = $DB_master->fetch_all("select i.site,s.sitename,count(*) as count from ".$main_table." as i left JOIN ".$site_table." as s on s.alias = i.site where s.status = 1 and i.timestamp >=".$timestamp." GROUP by site order by count desc LIMIT 10");

$order = array_column($sites_list,'count');
array_multisort($order,SORT_ASC,$sites_list);

foreach($sites_list as $key=>$v){
	if($v['count'] < 1) continue;
	$sites_count['name'][] = $v['sitename'];
	$sites_count['data'][] = $v['count'] ? $v['count'] : 0;
}
$sites_count_json = json_encode($sites_count);
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
var sites_count_json = <?php echo $sites_count_json;?>;
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
		right: '3%',
		bottom: '3%',
		containLabel: true
	  },
		<?php if($direct) {?>
		xAxis: {
			type: 'category',
			data: sites_count_json.name,
		},
		yAxis: {
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine:{show: false}
		},
		<?php }else{?>
		xAxis: {
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine:{show: false}
		},
		yAxis: {
			type: 'category',
			data: sites_count_json.name,
		},
		<?php }?>
		series: [{
			data: sites_count_json.data,
			type: 'bar',				
		}]
	};	
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>