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

//配置
$config = html_entities($core->get_config('core', ''));
$_conf = $config['plant'];
$category = $_conf['category'] ? $_conf['category'] : '';
$cids = array();
$where = '';
if($category){
	$cids = explode(',',$_conf['category']);
	$cids = array_filter($cids);
	if($cids) $where = ' id in ('.implode(',',$cids).')';
}
$where = $where ? $where : '`parent`=0 and `type` in (1,2)';

$category_table = $core->TABLE_.'cms_category';
$listCmsCategory = $DB_master->fetch_all("select `id`,`name`,`item_count` from ".$category_table." where $where");	
$item_count = array();
foreach($listCmsCategory as $key=>$v){
	if($v['item_count'] <1) continue;
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