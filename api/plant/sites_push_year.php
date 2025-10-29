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

$stop_data_table = $core->TABLE_.'sites_stop_data';
$site_table = $core->TABLE_.'sites_site';
$sites_count = array();

$timestamp = mktime(0,0,0,1,1,date('Y'));

//本年度
$sites_list = $DB_master->fetch_all("select i.status,i.site,s.sitename,count(*) as count from ".$stop_data_table." as i left JOIN ".$site_table." as s on s.alias = i.site where i.from = 'sites' and i.to = 'cms' and i.status = 1 and i.timestamp >=".$timestamp." GROUP by site order by count desc limit 10");

foreach($sites_list as $key=>$v){
	if($v['count'] < 1) continue;
	$sites_count[] = array(
		'value' => $v['count'] ? $v['count'] : 0,
		'name' => $v['sitename']
	);	
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
		color:['#5470c6','#91cc75','#fac858','#ff0033','#73c0de','#3ba272','#fc8452','#9a60b4','#ea7ccc'],	
		title: {			
		  },
		  tooltip: {
			trigger: 'item'
		  },
		  legend: {
			orient: 'vertical',
			left: 'left',
			textStyle:{
			  color:"#53868B",
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
		  series: [
			{
			  type: 'pie',
			  radius: '58%',
			  data: sites_count_json,
			  emphasis: {
				itemStyle: {
				  shadowBlur: 10,
				  shadowOffsetX: 0,
				  shadowColor: 'rgba(0, 0, 0, 0.5)'
				}
			  }
			}
		  ]
		};	
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
	window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>