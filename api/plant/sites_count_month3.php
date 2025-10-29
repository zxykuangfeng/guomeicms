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
//取去年的下个月份
$timestamp = mktime(0,0,0,date('m')+1,1,date('Y')-1);
$this_timestamp = P8_TIME;
$this_month = date('n');
$show_month = date('Y-m');
$this_system = $core->load_system('sites');
$this_module = $this_system->load_module('item');
$all_sites = $this_system ->get_sites();
$lists = array();
$legend = array();
$months = array();
foreach($all_sites as $sites){
	if(empty($sites['status'])) continue;	
	$site = $sites['alias'];
	$SQL = "select FROM_UNIXTIME(timestamp, '%Y-%m') as month, count(*) as count from ".$this_module->main_table." where timestamp >= '$timestamp' and timestamp< '$this_timestamp' and site = '".$site."' group by FROM_UNIXTIME(timestamp, '%Y-%m')";
	$sites_list = $DB_master->fetch_all($SQL);
	foreach($sites_list as $list){
		$lists[$site][$list['month']] = $list['count'];		
	}
	$legend[$site] = $sites['sitename'];
}
//超过9个站点，则不显示图例
$legend_show = count($legend) >=9 ? false : true;

//构建月份排序
$months[0] = 'sites';
for($i=1;$i<=12;$i++){
	if($i>$this_month)
		$months[$i-$this_month] = (date('Y')-1).'-'.($i<10?'0'.$i:$i);
	else
		$months[12-$this_month+$i] = date('Y').'-'.($i<10?'0'.$i:$i);
}
ksort($months);
//构建数据
$data = array();
$data[] = $months;
foreach(array_keys($legend) as $site_tmp){
	$data_site = array();
	$data_site[0] = $legend[$site_tmp];
	foreach($months as $key=>$mon){
		if($key) $data_site[$mon] = isset($lists[$site_tmp][$mon]) ? intval($lists[$site_tmp][$mon]) : 0;
	}
	if(array_sum($data_site) <1) continue;
	ksort($data_site);	
	$data[] = array_values($data_site);
}
$data_json = p8_json($data);
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
	setTimeout(function () {
	  option = {
		legend: {
			show:<?php echo $legend_show?'true':'false';?>,
			textStyle:{
			  color:"#53868B",
			},
			orient: 'vertical',
			left: 'left',
		},
		tooltip: {
		  trigger: 'axis',
		  showContent: false
		},
		dataset: {
		  source: <?php echo $data_json;?>
		},
		toolbox: {
				feature: {
					saveAsImage: {},					
				}
		},
		xAxis: { type: 'category',splitLine:{show: false} },
		yAxis: { gridIndex: 0,splitLine:{show: false} },
		grid: { top: '55%',left: '3%',right: '3%',bottom: '5%',containLabel: true },
		series: [
		  <?php for($i=1;$i<=count($legend);$i++){?>
		  {
			type: 'line',
			smooth: true,
			seriesLayoutBy: 'row',
			emphasis: { focus: 'series' }
		  },
		  <?php }?>
		  {
			type: 'pie',
			id: 'pie',
			radius: '30%',
			center: ['50%', '25%'],
			emphasis: {
			  focus: 'self'
			},
			label: {
			  formatter: '{b}: {@<?php echo $show_month;?>} ({d}%)',
			},
			encode: {
			  itemName: 'sites',
			  value: '<?php echo $show_month;?>',
			  tooltip: '<?php echo $show_month;?>'
			}
		  }
		]
	  };
	  myChart.on('updateAxisPointer', function (event) {
		const xAxisInfo = event.axesInfo[0];
		if (xAxisInfo) {
		  const dimension = xAxisInfo.value + 1;
		  myChart.setOption({
			series: {
			  id: 'pie',
			  label: {
				formatter: '{b}: {@[' + dimension + ']} ({d}%)'
			  },
			  encode: {
				value: dimension,
				tooltip: dimension
			  }
			}
		  });
		}
	  });
	  myChart.setOption(option);
	});

	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>