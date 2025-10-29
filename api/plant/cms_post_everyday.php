<?php
require_once dirname(__FILE__) .'/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
$reflash = isset($request['reflash']) && $request['reflash'] ? intval($request['reflash']) : 300;
$startValue = date('Y-m-d',strtotime("-1 years",P8_TIME));
$this_system = $core->load_system('cms');
$this_module = $this_system->load_module('item');
$lists = array();
//本年度
$timestamp = mktime(0,0,0,1,1,date('Y')-3);
$SQL = "select FROM_UNIXTIME(timestamp, '%Y-%m-%d') as timestamp, count(*) as count from ".$this_module->main_table." where timestamp >= $timestamp group by FROM_UNIXTIME(timestamp, '%Y-%m-%d') order by timestamp asc";
$_list = $DB_master->fetch_all($SQL);
foreach($_list as $list){
	$lists[] = array($list['timestamp'],intval($list['count']));
}
$data_json = json_encode($lists);
?>
<!DOCTYPE html>
<html lang="zh-CN" style="height: 100%">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="<?php echo $reflash;?>">
</head>
<body style="height: 100%; margin: 0">
  <div id="container" style="height: 100%"></div>
<script type="text/javascript" src="./../../js/plant/jquery.js"></script>
<script type="text/javascript" src="./../../js/plant/echarts.min.js"></script>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('container'));
	var option;
	var data = <?php echo $data_json;?>;
    
	myChart.setOption(
    (option = {
      color:['#5470c6','#91cc75','#fac858','#ff0033','#73c0de','#3ba272','#fc8452','#9a60b4','#ea7ccc'],
      tooltip: {
        trigger: 'axis'
      },
      grid: {
        left: '3%',
        right: '3%',
        bottom: '10%'
      },
	  toolbox: {
		feature: {
				saveAsImage: {},				
				magicType: {
					type: ['line', 'bar']
				}
			}
		},
      xAxis: {
        data: data.map(function (item) {
          return item[0];
        })
      },
      yAxis: {
		splitLine:{
			show:false
		}
	  },
      dataZoom: [
        {
          startValue: '<?php echo $startValue;?>'
        },
        {
          type: 'inside'
        }
      ],      
      series: {
		type: 'line',
		smooth: true,
        data: data.map(function (item) {
          return item[1];
        }),
      }
    })
  );


    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>
</body>
</html>