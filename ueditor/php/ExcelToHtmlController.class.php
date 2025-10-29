<?php
require dirname(__FILE__) .'/../../inc/init.php';
class ExcelToHtmlController
{
    protected $store_path;
    public function index()
    {
        global $core;
        $p8upload = $core->load_module('uploader');
        $upcontroller = &$core->controller($p8upload);
        $system = isset($_GET['system']) ? p8_addslashes($_GET['system']) : 'core';
        $module = isset($_GET['module']) ? p8_addslashes($_GET['module']) : '';
        $upcontroller->set($system, $module);
        $this->store_path = 'ueditor/file/'.date('Ymd');

        isset($_FILES['upfile']) && is_array($_FILES['upfile']) or message('select_upload_file');

        $json = $upcontroller->upload(array(
            'files' => $_FILES['upfile'],
        ),$this->store_path);

		$filePath = substr($json['0']['file'],strlen($core->get_attachment_url())+1);
		require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

		$src = PHP168_PATH.$filePath;
		$sFileType = PHPExcel_IOFactory::identify($src);//获取文件类型src是文件路径
		$objReader = PHPExcel_IOFactory::createReader($sFileType);//创建读取
		$objWriteHtml = new PHPExcel_Writer_HTML($objReader->load($src, 'UTF-8'));//加载内容
		$objWriteHtml->$useInlineCss = true;
		$xmlWriter = $objWriteHtml->save("php://output");//输出html文件到页面`
		exit($xmlWriter);		
    }
}


