<?php
$disk_config = array('3' => 'GB','2' => 'MB','1' => 'KB');
//当前磁盘的总容量
$disk_total = disk_total_space('.');
//当前磁盘的剩余空间
$disk_free = disk_free_space('.');
//可用率
$user_percentage = round(($disk_total-$disk_free)/$disk_total,3)*100;

foreach($disk_config as $disk_key => $disk_value){
	//$disk_total
	if($disk_total > pow(1024, $disk_key)){
		$disk_total = round($disk_total / pow(1024,$disk_key)).$disk_value;
	}
	//$disk_free
	if($disk_free > pow(1024, $disk_key)){
		$disk_free = round($disk_free / pow(1024,$disk_key)).$disk_value;
	}
}
?>
<!DOCTYPE html>
<html lang="zh-CN" style="height: 100%">
<head>
  <meta charset="utf-8">
</head>
<body style="height: 100%; margin: 0">
  <div id="container" style="height: 100%"></div>
<script type="text/javascript" src="./../../js/plant/echarts.min.js"></script>
<script type="text/javascript">
    var dom = document.getElementById('container');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option = {
			tooltip: {
				formatter: '{b} : {c}%'
			},
			series: [{
				name: '使用率',
				type: 'gauge',
				progress: {
					show: true
				},
				detail: {
					valueAnimation: true,
					formatter: '{value}%'
				},
				data: [{
					value: <?php echo $user_percentage;?>,
					name: '磁盘使用率'
				}]
			}]
		};
        myChart.setOption(option);
        $(document).ready(function () {
            myChart.resize();

        })
        window.addEventListener("resize", function () {
            myChart.resize();
        });

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>
</body>
</html>