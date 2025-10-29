<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/

if(REQUEST_METHOD == 'GET' || defined('P8_GENERATE_HTML')){


}else if(REQUEST_METHOD == 'POST'){

    $model_table = $core->TABLE_.'forms_item_'.$this_model['name'];
    /*
     * @date2 要设置唯一性的字段名称，与后台字段名保持一致
    */
    $date2 = $_POST['field#']['date2'];
    //从数据库中读数据
    $data = $core->DB_master->fetch_one("SELECT * FROM $model_table WHERE date2='$date2'");
    //检测字段值，有数据存在数据库中则报错
    empty($data) or message('field_unquie');
}
