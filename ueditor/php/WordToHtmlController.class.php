<?php
require dirname(__FILE__) .'/../../inc/init.php';
class WordToHtmlController
{
    protected $store_path;
    public function index()
    {
        global $core,$P8_ROOT;
        $p8upload = $core->load_module('uploader');
        $upcontroller = &$core->controller($p8upload);
        $system = isset($_GET['system']) ? p8_addslashes($_GET['system']) : 'core';
        $module = isset($_GET['module']) ? p8_addslashes($_GET['module']) : '';
        $upcontroller->set($system, $module);
        $this->store_path = 'ueditor/word/'.date('Ymd');

        isset($_FILES['upfile']) && is_array($_FILES['upfile']) or message('select_upload_file');

        $json = $upcontroller->upload(array(
            'files' => $_FILES['upfile'],
        ),$this->store_path);

       $filePath = substr($json['0']['file'],strlen($core->get_attachment_url())+1);

        require 'vendor/autoload.php';


		$phpWord = \PhpOffice\PhpWord\IOFactory::load(PHP168_PATH.$filePath);

        // 直接输出到页面显示
//        $phpWord->save('php://output', 'HTML');

        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        header("Content-Type:text/html; charset=utf-8");
        exit($this->replaceImageSrc($xmlWriter->getContent()));
//        exit($xmlWriter->getContent());
    }

    /**
     * 将HTML代码中的所有图片地址替换
     * @param $content string 要查找的内容
     * @return string
     */
    private function replaceImageSrc($content)
    {
		global $core;
		$preg = '/(\s+src\s?\=)\s?[\'|"]([^\'|"]*)/is'; // 匹配img标签的正则表达式
		preg_match_all($preg, $content, $allImg); // 匹配所有的img
		
        if (!$allImg) return $content;
		$get_attachment_url = $core->CONFIG['attachment_storate_type'] == 'relative_url' ? '' : $this->core->get_attachment_url();
		$attachment_url = $get_attachment_url .'/'. $core->CONFIG['attachment']['path'];		

        foreach ($allImg[0] as $k => $v) {
            $old = ltrim($v, '" src=');

            preg_match('/^(data:\s*image\/(\w+);base64,)/', $old, $temp);
            $tempType = $temp[2];   // 获取类型

            // 判断目录是否存在，不存在时创建
            $tempFilePath = PHP168_PATH.'attachment/store/'.$this->store_path;

            if (!file_exists($tempFilePath))
                mkdir($tempFilePath);

            // 拼接完整路径
            $filename = '/word_image_' . time() . $k . '.' . $tempType;
            $tempFileName = PHP168_PATH.'attachment/store/'.$this->store_path . $filename;
            $base64 = str_replace($temp[1], '', $old);
            file_put_contents($tempFileName, base64_decode($base64));
			// 替换路径字符串,使用网络路径
            $new_url = str_replace('//','/',$attachment_url.'/store/'.$this->store_path . $filename);
			$content = str_replace($old, $new_url, $content);
        }
        return $content;
    }
}


