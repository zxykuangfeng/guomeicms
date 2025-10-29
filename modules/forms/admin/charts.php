<?php
defined('PHP168_PATH') or die();

//$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$mid = isset($_GET['mid'])? intval($_GET['mid']) : '';
	$app = isset($_GET['app'])? intval($_GET['app']) : 1;
	$app_id = $app ? 'p8_echart_app_'.intval($app) : 'p8_echart_app_1';
	
	$this_module->set_model($mid) or message('no_such_model');
	//我管理的表单
	$my_forms_manage = $this_controller->get_acl('my_forms_manage');
	$mids = $my_forms_manage ? array_keys($my_forms_manage) : array();
	if(!$IS_FOUNDER){
		in_array($mid,$mids) or message('no_privilege');
	}
	
	//取模型配置
	$model_data = array();
	$model_select = select();
	$model_select->from($this_module->model_table, '*');
	$model_select->in('id', $mid);	
	$model_data = $core->select($model_select, array('single' => true, 'ms' => 'master'));	
	$config = mb_unserialize($model_data['config']);
	//获取某个场景配置数据
	$appconfig = isset($config[$app_id]) && $config[$app_id] ? $config[$app_id] : array();
	
	// 判断元素是否存在
	if(in_array($appconfig['p8_charts_dimension_x'], $appconfig['p8_charts_dimension'])) {
		$key = array_search($appconfig['p8_charts_dimension_x'], $appconfig['p8_charts_dimension']);
		unset($appconfig['p8_charts_dimension'][$key]);
	}
	
	//组建应用名称
	$appnames = array();
	for($i=1;$i<8;$i++){
		$name = 'p8_echart_app_'.$i;
		$lang_alias = 'forms_model_app_name_'.$i;
		$appnames[$i] = isset($config[$name]['p8_charts_appname']) && $config[$name]['p8_charts_appname'] ? $config[$name]['p8_charts_appname'] : $P8LANG[$lang_alias];
	}
	$this_appname = $appnames[$app];
	//取字段
	$select_field = select();
	$select_field->from($this_module->field_table, '*');
	$select_field->in('model', $this_module->MODEL);
	$select_field->order('display_order DESC');

	$list_field = $core->list_item($select_field,array('page_size' => 0,'ms' => 'master'));
	$list_field or message('forms_model_field_list_not_null');
	$dimensions = array();
	$four_select = array();
	foreach($list_field as $key=>$field){
		if($field['widget'] == 'text') {
			$dimensions[$field['name']] = array(
				'display_order'=> $field['display_order'],
				'name'=>$field['name'],
				'alias'=>$field['alias']
			);
			$four_select[$field['name']] = array(
				'widget' => $field['widget'],
				'data' => $field['data'],
				'units' => $field['units'],
				'alias'=>$field['alias']
			);		
			unset($list_field[$key]);
			continue;
		}
		if(!in_array($field['widget'],array('radio','checkbox','multi_select','select'))) {
			unset($list_field[$key]);
			continue;
		}
		$four_select[$field['name']] = array(
			'widget' => $field['widget'],
			'data' => $field['data'],
			'units' => $field['units'],
			'alias'=>$field['alias']
		);		
		$dimensions[$field['name']] = array(
			'display_order'=> $field['display_order'],
			'name'=>$field['name'],
			'alias'=>$field['alias']
		);
		$widgetdata = $field['data'] ? mb_unserialize($field['data']):array();
		$widget_data = array();
		foreach($widgetdata as $keys=>$datas){
			$keys = html_decode_entities($keys);
			$widget_data[$keys] = is_array($datas) ?  html_decode_entities($datas['0']) : html_decode_entities($datas);				
		}
		$list_field[$key]['widgetdata'] = $widget_data;	
	}
	//简单对维度排个序
	$keys = array_column($dimensions, 'key');
	$values = array_column($dimensions, 'value');
	array_multisort($keys, SORT_DESC, $values, SORT_DESC, $dimensions);
	//统计模式
	$count_model = array(
		'count' => $P8LANG['forms_count_model_count'],
		'average' => $P8LANG['forms_count_model_average'],
		'sum' => $P8LANG['forms_count_model_sum'],
		'count_x' => $P8LANG['forms_count_model_count_x'],
		'range' => $P8LANG['forms_count_model_range'],
		'median' => $P8LANG['forms_count_model_median'],
		'variance' => $P8LANG['forms_count_model_variance'],
		'deviation' => $P8LANG['forms_count_model_deviation'],
	);	
	$count_model_json = p8_json($count_model);
	$dimensions_json = p8_json($dimensions);
	$start_date = date('Y-m-d H:i:s',strtotime("-1 years 1 day"));
	$end_date = date('Y-m-d  H:i:s',P8_TIME);
	//两种状态
	$status = $this_module->CONFIG['status'];
	$p8_status = $this_model['CONFIG']['status'];	
	
	//初始化配置
	$appconfig['p8_charts_others'] = empty($appconfig['p8_charts_others']) ? array('smooth','toolbox') : $appconfig['p8_charts_others'];
	$appconfig['p8_charts_titposition'] = empty($appconfig['p8_charts_titposition']) ? 1 : intval($appconfig['p8_charts_titposition']);
	$appconfig['p8_charts_charts'] = empty($appconfig['p8_charts_charts']) ? 'bar' : $appconfig['p8_charts_charts'];
	$appconfig['p8_charts_dimension_x'] = empty($appconfig['p8_charts_dimension_x']) ? (array_keys($dimensions)[0] ? array_keys($dimensions)[0] : '') : $appconfig['p8_charts_dimension_x'];
	$appconfig['p8_charts_gridTop'] = empty($appconfig['p8_charts_gridTop']) ? '60' : $appconfig['p8_charts_gridTop'];
	$appconfig['p8_charts_gridBottom'] = empty($appconfig['p8_charts_gridBottom']) ? '60' : $appconfig['p8_charts_gridBottom'];
	$appconfig['p8_charts_gridLeft'] = empty($appconfig['p8_charts_gridLeft']) ? '10%' : $appconfig['p8_charts_gridLeft'];
	$appconfig['p8_charts_gridRight'] = empty($appconfig['p8_charts_gridRight']) ? '10%' : $appconfig['p8_charts_gridRight'];
	
	include template($this_module, 'charts', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$mid = isset($_POST['mid']) ? intval($_POST['mid']) : '';
	if($_POST['SetConfiG'])	{
		$this_module->update_model_config($mid,$_POST);
		echo $data = json_encode(array('set'=>true));
		exit;
	}
	$mid or exit('[]');
	$this_module->set_model($mid);
	$dimension_x = $_POST['dimension_x'] ? $_POST['dimension_x'] : '';
	$count_model_x = $_POST['count_model_x'] && in_array($_POST['count_model_x'],array('category','countall')) ? $_POST['count_model_x'] : 'category';
	$dimension = $_POST['dimension'] ? $_POST['dimension'] : array();	
	// 判断元素是否存在
	if(in_array($dimension_x, $dimension)) {
		$key = array_search($dimension_x, $dimension);
		unset($dimension[$key]);
	}	
	$dimension_all = $dimension;
	$dimension_all[] = $dimension_x;
	$dimension_all = array_unique($dimension_all);
	//取字段
	$select_field = select();
	$select_field->from($this_module->field_table, 'id,name,widget,data');
	$select_field->in('model', $this_module->MODEL);
	$list_field = $core->list_item($select_field,array('page_size' => 0,'ms' => 'master'));
	
	//取数据
	$data = array();
	$select = select();
	$select -> from("$this_module->table as i",'i.*');
	$select -> left_join("$this_module->data_table as d",'d.*','i.id=d.id');
	$select -> in('i.mid',$mid);
	
	//搜索条件--自定义字段过滤
	$F = isset($_POST['field#']) ? $_POST['field#'] : array();
	foreach($this_model['filterable_fields'] as $field=>$field_data){
		if(!empty($F[$field]) && $field_data['widget']=='text'){
			$data[$field] = $F[$field];
			$select->like("d.$field",$F[$field]);
		}
	}
	foreach($list_field as $key=>$field_data){		
		$field = $field_data['name'];
		$list_field[$key]['data'] = $field_data['data'] = $field_data['data'] ? mb_unserialize($field_data['data']):array();
		if(!empty($F[$field])){
			if($field_data['widget']=='radio' || $field_data['widget']=='select'){
				$select -> in("d.$field",$F[$field]);
			}elseif($field_data['widget']=='checkbox' || $field_data['widget']=='multi_select'){
				if(!empty($F[$field])){
					foreach($F[$field] as $v){
						if(array_key_exists($v,$field_data['data'])){
							$select->like("d.$field",$v);
						}	
					}
				}
			}
		}		
	}
	
	//搜索条件--时间
	$start_date = isset($_POST['start_date'])? $_POST['start_date'] : '';
	if($start_date && strtotime($start_date))	$select->range('i.timestamp',strtotime($start_date));
	
	$end_date = isset($_POST['end_date'])? $_POST['end_date'] : '';
	if($end_date && strtotime($end_date)) $select->range('i.timestamp',null,strtotime($end_date));

	//搜索条件--状态
	$selectstatus = isset($_POST['selectstatus']) ? $_POST['selectstatus'] : array();
	if($selectstatus) $select->in('i.status',$selectstatus);
	
	$search_status = isset($_POST['search_status']) ? $_POST['search_status'] : array();
	if($search_status) $select->in('i.p8_status',$search_status);
	
	$select->order('i.display_order DESC,i.id DESC');
	//echo $select->build_sql();
	$list = $core->list_item($select,array('page_size' => 0,'ms' => 'master'));
	
	foreach($list as $key=>$detail){
		$this_module->format_data($list[$key]);
		$this_module->format_view($list[$key]);
		foreach($detail as $keys=>$details){
			if (!empty($_POST['count_model'])) {
				if ($count_model_x == 'category' && !in_array($keys, $dimension_all)) {
					unset($list[$key][$keys]);
				} elseif ($count_model_x != 'category' && !in_array($keys, $dimension)) {
					unset($list[$key][$keys]);
				}
			} else {
				if (!in_array($keys, $dimension_all)) {
					unset($list[$key][$keys]);
				}
			}
		}		
	}
	if($count_model_x == 'category'){
		$dimension_x_column = array_unique(array_column($list, $dimension_x));		
	}
	//var_dump($dimension_x_column);
	$each_dim = array();
	//统计模式	
	if(!empty($_POST['count_model'])){
		//分拆数据
		foreach($list as $value){
			foreach($value as $dim=>$v){
				if($count_model_x == 'category'){
					if($dim == $dimension_x) continue;
					$each_dim[$dim][$value[$dimension_x]][] = $v;
				}else{
					$each_dim[$dim][] = $v;
				}
			}
		}
		$_POST['count_model'] = array($_POST['count_model']);
		$list = array();
		if($count_model_x == 'category'){
			foreach($dimension_x_column as $x => $dim_x){
				foreach($_POST['count_model'] as $c=>$count_model){					
					$list[$x.$c][$dimension_x] = $dim_x;
					$list[$x.$c]['p8_alias_score_dim'] = $count_model;
					switch($count_model){
						case 'average':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->calculateAverage($data[$dim_x]);						
							}
						break;
						case 'count_x':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->countNonEmptyValues($data[$dim_x]);
							}
						break;
						case 'sum':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->calculateArraySum($data[$dim_x]);
							}
						break;
						case 'count':
							foreach($each_dim as $dims => $datas){
								$ret = $this_module->countByCategory($datas[$dim_x]);
								foreach($ret as $dim=>$data){
									$list[] = array(
												'name' => $list_field[$dims]['data'][$dim][0]?$list_field[$dims]['data'][$dim][0]:$dim,
												'count' => $data
											);
								}				
							}
						break;
						case 'median':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->calculateMedian($data[$dim_x]);
							}
						break;				
						case 'range':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->calculateRange($data[$dim_x]);
							}
						break;
						case 'variance':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->calculateVariance($data[$dim_x]);
							}
						break;
						case 'deviation':
							foreach($each_dim as $dim => $data){
								$list[$x.$c][$dim] = $this_module->calculateStandardDeviation($data[$dim_x]);
							}
						break;
					}
					$count_j++;
				}
			}
			//整理数据
			$list = array_values($list);
			//排序
			$keys = array_column($list, 'p8_alias_score_dim');
			array_multisort($keys, SORT_DESC, $list);
			//移除干扰项
			
			$columnToRemove = 'p8_alias_score_dim';
			$return = array_map(function ($row) use ($columnToRemove) {
				unset($row[$columnToRemove]);
				return $row;
			}, $list);
			$list = $return;			
		}else{
			foreach($_POST['count_model'] as $c=>$count_model){
				$list[$c][$dimension_x] = $P8LANG['forms_count_model_'.$count_model];
				switch($count_model){
					case 'average':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->calculateAverage($data);						
						}
					break;
					case 'count_x':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->countNonEmptyValues($data);
						}
					break;
					case 'sum':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->calculateArraySum($data);
						}
					break;
					case 'count':
						foreach($each_dim as $dims => $datas){
							$ret = $this_module->countByCategory($datas);
							foreach($ret as $dim=>$data){
								$list[] = array(
											'name' => $list_field[$dims]['data'][$dim][0]?$list_field[$dims]['data'][$dim][0]:$dim,
											'count' => $data
										);
							}				
						}
					break;
					case 'median':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->calculateMedian($data);
						}
					break;				
					case 'range':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->calculateRange($data);
						}
					break;
					case 'variance':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->calculateVariance($data);
						}
					break;
					case 'deviation':
						foreach($each_dim as $dim => $data){
							$list[$c][$dim] = $this_module->calculateStandardDeviation($data);
						}
					break;
				}			
			}
			
		}
				
	}	
	
	//指定数据
	$start_count = intval($_POST['start_count']);
	$end_count = intval($_POST['end_count']);
	$list = $this_module->getElementsInRange($list,$start_count,$end_count);
	echo $data = json_encode($list);
	exit;	
}
