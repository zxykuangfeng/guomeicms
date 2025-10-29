<?php
/**
* 获取主站统计信息。
* 返回list和count
**/

require_once dirname(__FILE__) .'/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;

$member_table = $core->TABLE_.'member';
$role_table = $core->TABLE_.'role';
$roles = $DB_master->fetch_all("SELECT * FROM `$role_table`");
$_roles = $role_list = $role_ret = array();
foreach($roles as $role_t){
	$_roles[$role_t['id']] = $role_t['name'];
}
$role_list = $DB_master->fetch_all("SELECT count(*) as `count`,role_id FROM `$member_table` GROUP BY `role_id`");

foreach($role_list as $key => $role_m){
	$role_ret[] = array(
		'value' => $role_m['count'],
		'name' => $_roles[$role_m['role_id']]
	);
}
$role_json = json_encode($role_ret);
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
var role_json = <?php echo $role_json;?>;
var option = {
		color:['#5470c6','#91cc75','#fac858','#ff0033','#73c0de','#3ba272','#fc8452','#9a60b4','#ea7ccc'],		
		tooltip: {
			trigger: 'item'
		},
		toolbox: {
			feature: {
				saveAsImage: {},				
			}
		},
		legend: {
			orient: 'vertical',
			left: 'left',
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
		series: [
			{
			  type: 'pie',
			  radius: '58%',
			  data: role_json,
			  emphasis: {
				itemStyle: {
				  shadowBlur: 5,
				  shadowOffsetX: 0,
				  shadowColor: 'rgba(0, 0, 0, 0.2)'
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