<?php
include_once PHP168_PATH.'inc/select.php';

class DMSelect extends P8_DB_Select {
function _join($type, $table, $fields = '*', $join_cond = '', $index = ''){
	
	if(preg_match("/^(.+)\s+AS\s+(.+)$/i", $table, $m)){
		$alias = $m[2];
		if(preg_match("/^([^\.]+)\.(.+)/", $m[1], $mm)){
			$table = "$mm[1].$mm[2] AS $m[2]";
		}else{
			$table = "$m[1] AS $m[2]";
		}
	}else{
		$alias = $table;
		if(preg_match("/^([^\.]+)\.(.+)/", $table, $m)){
			$table = "$m[1].$m[2]";
		}else{
			$table = "$table";
		}
	}
	
	$this->_from[$alias] = array(
		'table' => $table,
		'join' => $type,
		'condition' => $join_cond,
		'fields' => $fields, 	//$this->_fields($fields, $alias)
		'index' => $index
	);
}


    /**
     * 搜索
     * @param string $field 要搜索的字段
     * @param string $keyword 要搜索的关键词
     **/
    function like($field, $keyword, $type = 'all', $exclude = false){
        $this->_keyword[] = $keyword;

        $not = $exclude ? 'NOT' : '';

        $keyword = str_replace(array('%'), array('\\%'), $keyword);
        switch($type){

            case 'left': $s = "$field $not LIKE '$keyword%'"; break;
            case 'right': $s = "$field $not LIKE '%$keyword'"; break;
            default: $s = "$field $not LIKE '%$keyword%'"; break;

        }

        $this->where($s);


    }

}