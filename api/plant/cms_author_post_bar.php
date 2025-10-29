<?php


require_once dirname(__FILE__) .'/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
/*
direct 1 水平
direct 0 垂直
*/
$direct = isset($request['direct']) && $request['direct'] ? 1 : 0;
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;

$this_system = $core->load_system('cms');
$this_module = $this_system->load_module('statistic');
//$year,$month=0,$cid=0,$model='',$uid=0, $download=false
$listCmsCategory = $this_module->getStatic_author(date('Y'));
$item_count = array();

foreach($listCmsCategory as $key=>$v){
	$item_count['name'][] = $v['author'];
	$item_count['data'][] = $v['num'] ? $v['num'] : 0;	
}
$item_count_json = json_encode($item_count);
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
var item_count_json = <?php echo $item_count_json;?>;
		
var option = {
		color:['#5470c6','#91cc75','#fac858','#ff0033','#73c0de','#3ba272','#fc8452','#9a60b4','#ea7ccc'],		
		toolbox: {
			feature: {
				saveAsImage: {show: true}
			}
		},
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				type: 'shadow'
			}
		},
		legend: {				
			right: '10%',
			show:false,
		},
		grid: {
			left: '3%',
			right: '3%',
			bottom: '3%',
			containLabel: true
		},
		calculable: true,
		<?php if($direct) {?>
		xAxis: {
			type: 'category',
			data: item_count_json.name,
		},
		yAxis: {
			name: '发稿量',
			axisLine: {
				lineStyle: {
					color: '#666'
				}
			},
			splitLine:{show: false}
		},
		<?php }else{?>
		xAxis: {
			name: '发稿量',
			axisLine: {
				lineStyle: {
					color: '#666'
				}
			},
			splitLine:{show: false}
		},
		yAxis: {
			type: 'category',
			data: item_count_json.name,
		},
		<?php }?>
		series: [{
			name: '发稿量',
			data: item_count_json.data,
			type: 'bar',								
			barWidth:'30%',	
			itemStyle: {
				normal: {color:'#3398DB'}
			},
			label:{
				show:true,
				position:'insideTop',
				color:'#53868B',
			},
		},					
	]
		
	};
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>