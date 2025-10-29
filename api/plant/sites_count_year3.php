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
$this_year = date('Y');
$this_system = $core->load_system('sites');
$this_module = $this_system->load_module('item');
$all_sites = $this_system ->get_sites();

$lists = array();
$legend = array();
$years = array();
foreach($all_sites as $sites){
	if(empty($sites['status'])) continue;	
	$site = $sites['alias'];
	$SQL = "select FROM_UNIXTIME(timestamp, '%Y') as year, count(*) as count from ".$this_module->main_table." where site = '".$site."' group by FROM_UNIXTIME(timestamp, '%Y')";
	$sites_list = $DB_master->fetch_all($SQL);
	foreach($sites_list as $list){
		$lists[$site][$list['year']] = $list['count'];
		$years[$list['year']] = $list['year'];
	}
	$legend[$site] = $sites['sitename'];
}
$legend_show = count($legend) >=9 ? false : true;
sort($years,SORT_NUMERIC);
$years_tmp = $years;
$data = array();
array_unshift($years,"sites");
$data[] = $years;

foreach(array_keys($legend) as $site){
	$data_site = array();
	foreach($years_tmp as $year){
		$data_site[] = isset($lists[$site][$year]) ? intval($lists[$site][$year]) : 0;
	}
	if(array_sum($data_site) <1) continue;
	array_unshift($data_site,$legend[$site]);
	$data[] = $data_site;
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
		color:['#5470c6','#91cc75','#fac858','#ff0033','#73c0de','#3ba272','#fc8452','#9a60b4','#ea7ccc'],	
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
			  formatter: '{b}: {@<?php echo $this_year;?>} ({d}%)',
			},
			encode: {
			  itemName: 'sites',
			  value: '<?php echo $this_year;?>',
			  tooltip: '<?php echo $this_year;?>'
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