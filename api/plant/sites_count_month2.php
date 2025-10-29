<?php

/**
 * 获取主站统计信息。
 * 返回list和count
 **/

require_once dirname(__FILE__) . '/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
/*
direct 1 水平
direct 0 垂直
*/
$direct = isset($request['direct']) && $request['direct'] ? 1 : 0;
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;

$main_table = $core->TABLE_ . 'sites_item';
$site_table = $core->TABLE_ . 'sites_site';

$timestamp = strtotime("-7 days", P8_TIME);

$sites_count = array();
$sites_list = $DB_master->fetch_all("select i.site,s.sitename,count(*) as count from " . $main_table . " as i left JOIN " . $site_table . " as s on s.alias = i.site where s.status = 1 and i.timestamp >=" . $timestamp . " GROUP by site order by count desc LIMIT 10");
foreach ($sites_list as $key => $v) {
	if ($v['count'] < 1) continue;
	$sites_count['name'][] = $v['sitename'];
	$sites_count['data'][] = $v['count'] ? $v['count'] : 0;
}
$sites_count_json = json_encode($sites_count);
?>
<!DOCTYPE html>
<html lang="zh-CN" style="height: 100%">

<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="<?php echo $reflash; ?>">

</head>

<body style="height: 100%; margin: 0">
	<div id="container" style="height: 100%"></div>
	<script type="text/javascript" src="./../../js/plant/echarts.min.js"></script>
	<script type="text/javascript">
		var myChart = echarts.init(document.getElementById('container'));
		var sites_count_json = <?php echo $sites_count_json; ?>;
		var option = {
			color: ['#5470c6', '#91cc75', '#fac858', '#ff0033', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'],
			title: {
				text: "78集团军站群大数据",
				subtext:"7天内各站点发稿量排名",
				left: "center",
				top: "top",
				link: "http://22.118.34.87/plant.php",
				target: "blank",
				textStyle: {
					fontSize: 12
				},
			},
			tooltip: {
				trigger: 'axis',
				axisPointer: {
					type: 'shadow'
				}
			},
			//   toolbox: {
			// 	feature: {
			// 		saveAsImage: {},
			// 		// magicType: {
			// 		// 	type: ['bar']
			// 		// }
			// 	}
			// 	},
			legend: {},
			grid: {
				top: '5%',
				left: '3%',
				right: '3%',
				bottom: '3%',
				containLabel: true
			},
			<?php if ($direct) { ?>
				xAxis: {
					type: 'category',
					data: sites_count_json.name,
					show: false,
					name: "单位",
					nameLocation: "middle"
				},
				yAxis: {
					type: 'value',
					boundaryGap: [0, 0.01],
					splitLine: {
						show: false
					}
				},
			<?php } else { ?>
				xAxis: {
					type: 'value',
					boundaryGap: [0, 0.01],
					splitLine: {
						show: false
					}
				},
				yAxis: {
					type: 'category',
					data: sites_count_json.name,
				},
			<?php } ?>
			series: [{
				data: sites_count_json.data,
				colorBy: "data",
				type: 'bar',
				itemStyle: {
					color: {
						type: 'linear',
						x: 0,
						y: 0,
						x2: 0,
						y2: 1,
						colorStops: [{
							offset: 0,
							color: '#29B572' // 0% 处的颜色
						}, {
							offset: 1,
							color: '#077253' // 100% 处的颜色
						}],
						global: false // 缺省为 false
					},
					borderRadius: [3, 3, 0, 0]
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