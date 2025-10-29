<?php


require_once dirname(__FILE__) .'/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
/*
direct 1 水平
direct 0 垂直
*/
$direct = isset($request['direct']) && $request['direct'] ? 1 : 0;
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;

$category_table = $core->TABLE_.'cms_category';

//$timestamp = strtotime("-1 months",P8_TIME);
$listCmsCategory = $DB_master->fetch_all("select `id`,`name`,`item_count` from ".$category_table." where `parent`=0 and `type` in (1,2)");
$item_count = array();

//排除基本些栏目ID
$clean_id = array('8888','9999','7777');

foreach($listCmsCategory as $key=>$v){
	if($v['item_count'] <1 || in_array($v['id'],$clean_id)) continue;
	$item_count['name'][] = $v['name'];
	$item_count['data'][] = $v['item_count'] ? $v['item_count'] : 0;	
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
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				type: 'shadow'
			}
		},
		toolbox: {
			feature: {
				saveAsImage: {},
				magicType: {
					type: ['line', 'bar']
				}
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
			data: item_count_json.name,
		},
		yAxis: {
			show: false,
		},
		<?php }else{?>
		xAxis: {
			show: false,
		},
		yAxis: {
			type: 'category',
			data: item_count_json.name,
		},
		<?php }?>
		series: [{
			data: item_count_json.data,
			type: 'bar',
			label:{
				show:true,
				position:'insideTop',
				color:'#53868B',
			},
		}]
	};
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>