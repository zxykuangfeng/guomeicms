<?php
defined('PHP168_PATH') or die();

class P8_Uploader_Controller extends P8_Controller{

var $filter;
var $enable;
var $_system;
var $_module;

function __construct(&$obj){
	parent::__construct($obj);
	
	
	//允许上传但是过滤器是空的,先用角色的过滤器,如果角色也是空的,最后用默认的过滤器
	if(!empty($this->model->CONFIG['role_filters'][$this->core->ROLE]['filter'])){
		$this->filter = &$this->model->CONFIG['role_filters'][$this->core->ROLE]['filter'];
	}else{
		$this->filter = &$this->model->CONFIG['filter'];
	}
	$this->filter[''] = 512000;
    if (isset($this->model->CONFIG['role_filters'][$this->core->ROLE]['enabled'])){
        $this->enable = $this->model->CONFIG['role_filters'][$this->core->ROLE]['enabled'];
    }else{
        $this->enable = false;
    }
}


function set($system = 'core', $module = ''){
	$this->_system = $system;
	$this->_module = $module;
	$this->model->set($system, $module);
}

/**
* 上传
* @param array $FILES 要上传的文件数组,一般来源是$_FILES
* @param array $filter 文件过滤器
* @param store_path $store_path 指定上传路径
* @return array 已经上传的文件数组
**/
function upload($data,$store_path = ''){
    global $IS_FOUNDER;
    if(!empty($data['chunks'])){

        $sss = $this->model->upload_chunk($data,$store_path);
        if(!$sss)return[];
    }
    if(!$this->check_role_enable()){
        return [];
    }

	$files = array();
	$data['thumb_width'] = isset($data['thumb_width']) ? intval($data['thumb_width']) : 0;
	$data['thumb_width'] = max(0, $data['thumb_width']);
	$data['thumb_height'] = isset($data['thumb_height']) ? intval($data['thumb_height']) : 0;
	$data['thumb_height'] = max(0, $data['thumb_height']);
	
	$data['cthumb_width'] = isset($data['cthumb_width']) ? intval($data['cthumb_width']) : 0;
	$data['cthumb_width'] = max(0, $data['cthumb_width']);
	$data['cthumb_height'] = isset($data['cthumb_height']) ? intval($data['cthumb_height']) : 0;
	$data['cthumb_height'] = max(0, $data['cthumb_height']);
	
	if(!empty($data['files']) && is_array($data['files']['name'])){
		//多个
		foreach($data['files']['name'] as $k => $v){
            if(!$data['files']['tmp_name'][$k])continue;
			$files[] = array(
				'name' => $data['files']['name'][$k],
				'tmp_name' => $data['files']['tmp_name'][$k],
				'type' => $data['files']['type'][$k],
				'size' => $data['files']['size'][$k],
			);
		}
	}else if(!empty($data['files'])){
		//单个
		$files[] = $data['files'];
	}
	unset($data['files']);
    $error=[];
	//在这里限制文件类型,大小
	foreach($files as $k => $v) {
        $files[$k]['name'] = clear_script($v['name']);
        if (empty($data['capture']) && !is_uploaded_file($files[$k]['tmp_name'])) {
            //如果不是捕抓来的文件,但又不是上传的文件
            unset($files[$k]);
            $error[] = [
                'filename' => $v['name'],
                'state'    => 'false',
                'msg'      => "图片超过最大值,上传失败!"
            ];
            continue;
        }

        $ext = file_ext($v['name']);
        $files[$k]['ext'] = $ext;

        $mimetype = (!empty($this->model->CONFIG['fileinfo_check']['enabled']) or (is_null($this->model->CONFIG['fileinfo_check']['enabled']) and class_exists('finfo')))?$this->getMimeDetect($files[$k]):$ext;
        //过滤文件类型,大小, 无论如何也不能上传php文件
        $_ext = strtolower($ext);

        if (
            ($_ext && preg_match('/\.?php.*/i', $_ext))
            || !isset($this->filter[$_ext])
            || $v['size'] > $this->filter[$_ext]
            || $v['size'] < 30
            || in_array($_ext, $this->model->deny)
            || strtolower($mimetype) !== strtolower($ext)
        ) {
            $error[] = [
                'filename' => $v['name'],
                'state'    => 'false',
                'msg'      => $v['size'] > $this->filter[$_ext] ? "图片超过最大值,上传失败!!" : "不充许上传此文件"
            ];
            //wlog("chunkupload.log",sprintf("\n[%s]controller can no upload php:%b, fiter:%b, size:%b,%d > %d, deny:%b"                ,date('Y-m-d H:i:s'),$_ext && preg_match('/\.?php.*/i', $_ext),!isset($this->filter[$_ext]),                $v['size'] > $this->filter[$_ext],$v['size'],$this->filter[$_ext],                in_array($_ext,$this->model->deny)));
            unset($files[$k]);
        }
    }

	return array_merge($error,$this->model->upload(array(
		'files' => $files,
		'thumb_width' => $data['thumb_width'],
		'thumb_height' => $data['thumb_height'],
		'cthumb_width' => $data['cthumb_width'],
		'cthumb_height' => $data['cthumb_height'],
		'image_cut' => empty($data['image_cut']) ? false : true,
		'capture' => empty($data['capture']) ? false : true
	),$store_path));
}

/**
* 捕抓网络文件
* @param array $file 要捕抓文件的URL数组
**/
function capture($data){
	
	$data['thumb_width'] = isset($data['thumb_width']) ? intval($data['thumb_width']) : 0;
	$data['thumb_width'] = max(0, $data['thumb_width']);
	$data['thumb_height'] = isset($data['thumb_height']) ? intval($data['thumb_height']) : 0;
	$data['thumb_height'] = max(0, $data['thumb_height']);
	
	$data['cthumb_width'] = isset($data['cthumb_width']) ? intval($data['cthumb_width']) : 0;
	$data['cthumb_width'] = max(0, $data['cthumb_width']);
	$data['cthumb_height'] = isset($data['cthumb_height']) ? intval($data['cthumb_height']) : 0;
	$data['cthumb_height'] = max(0, $data['cthumb_height']);
	
	$files = array(
		'name' => array(),
		'tmp_name' => array(),
		'size' => array(),
		'type' => array()
	);
	
	$today = CACHE_PATH .'tmp/attachment/'. date('Y-m-d', P8_TIME) .'/';
	md($today);
	
	foreach((array)$data['files'] as $v){
		$ext = file_ext($v);
		$_ext = strtolower($ext);
		//无论如何也不能上传php文件
		if(
			(empty($_ext) || ($_ext && !preg_match('/\.php.*/i', $_ext))) &&
			isset($this->filter[$ext]) && $tmp = @file_get_contents($v)
		){
			
			//临时文件
			$tmp_file = $today . unique_id();
			write_file($tmp_file, $tmp);
			
			$files['name'][] = basename($v);
			$files['tmp_name'][] = $tmp_file;
			$files['size'][] = strlen($tmp);
			$files['type'][] = function_exists('mime_content_type') ? 
				($m = mime_content_type($tmp_file) ? $m : 'application/octet-stream' ) :
				'application/octet-stream';
		}
	}
	
	return $this->upload(array(
		'files' => $files,
		'capture' => true,
		'image_cut' => empty($data['image_cut']) ? false : true,
		'thumb_width' => $data['thumb_width'],
		'thumb_height' => $data['thumb_height'],
		'cthumb_width' => $data['cthumb_width'],
		'cthumb_height' => $data['cthumb_height']
	));
}

/**
* 检查是否允许上传
**/
function check_enabled(){
	
	if(empty($this->filter)){
		return false;
	}
	
	if($this->_module !== ''){
		$bool = isset($this->model->CONFIG['enables'][$this->_system][$this->_module]);
		//模型允不允许上传
	}else{
		$bool = isset($this->model->CONFIG['enables'][$this->_system]['']);
		//系统允不允许上传
	}
	
	return $bool;
}

function check_role_enable(){
    global $IS_FOUNDER;
    if(!$IS_FOUNDER && !$this->enable){
        return false;
    }
    return true;
}

function delete($system, $module, $cond){
	
}

function getMimeDetect($tmpfile){
    $mime = [
        'ai'   => ['application/postscript'],
        'eps'  => ['application/postscript'],
        'exe'  => ['application/octet-stream'],
        'doc'  => ['application/vnd.ms-word','application/msword'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        'xls'  => ['application/vnd.ms-excel'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        'ppt'  => ['application/vnd.ms-powerpoint'],
        'pps'  => ['application/vnd.ms-powerpoint'],
        'pdf'  => ['application/pdf'],
        'xml'  => ['application/xml'],
        'odt'  => ['application/vnd.oasis.opendocument.text'],
        'swf'  => ['application/x-shockwave-flash'], // archives
        'gz'   => ['application/x-gzip'],
        'tgz'  => ['application/x-gzip'],
        'bz'   => ['application/x-bzip2'],
        'bz2'  => ['application/x-bzip2'],
        'tbz'  => ['application/x-bzip2'],
        'zip'  => ['application/zip'],
        'rar'  => ['application/x-rar'],
        'tar'  => ['application/x-tar'],
        '7z'   => ['application/x-7z-compressed'], // texts
        'txt'  => ['text/plain'],
        'csv'  => ['text/plain'],
        'php'  => ['text/x-php'],
        'html' => ['text/html'],
        'htm'  => ['text/html'],
        'js'   => ['text/javascript'],
        'css'  => ['text/css'],
        'rtf'  => ['text/rtf'],
        'rtfd' => ['text/rtfd'],
        'py'   => ['text/x-python'],
        'java' => ['text/x-java-source'],
        'rb'   => ['text/x-ruby'],
        'sh'   => ['text/x-shellscript'],
        'pl'   => ['text/x-perl'],
        'sql'  => ['text/x-sql'], // images
        'bmp'  => ['image/x-ms-bmp'],
        'jpg'  => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'gif'  => ['image/gif'],
        'png'  => ['image/png'],
        'tif'  => ['image/tiff'],
        'tiff' => ['image/tiff'],
        'tga'  => ['image/x-targa'],
        'psd'  => ['image/vnd.adobe.photoshop'], //audio
        'mp3'  => ['audio/mpeg'],
        'mid'  => ['audio/midi'],
        'ogg'  => ['audio/ogg'],
        'mp4a' => ['audio/mp4'],
        'wav'  => ['audio/wav'],
        'wma'  => ['audio/x-ms-wma'], // video
        'avi'  => ['video/x-msvideo'],
        'dv'   => ['video/x-dv'],
        'mp4'  => ['video/mp4'],
        'mpeg' => ['video/mpeg'],
        'mpg'  => ['video/mpeg'],
        'mov'  => ['video/quicktime'],
        'wm'   => ['video/x-ms-wmv'],
        'flv'  => ['video/x-flv'],
        'mkv'  => ['video/x-matroska'],
        ];

		$path = $tmpfile['tmp_name'];
		$ext = $tmpfile['ext'];
        $fmime = 'internal';
        $file_type = "unknown";
		$mimetype = "unknown";
        if (class_exists('finfo')) {
            $fmime = 'finfo';
        } else {
            if (function_exists('mime_content_type')) {
                $fmime = 'mime_content_type';
            } else {
                if (function_exists('exec')) {
                    $result = exec('file -ib ' . escapeshellarg(__FILE__));
                    if (0 === strpos($result, 'text/x-php') or 0 === strpos($result, 'text/x-c++')) {
                        $fmime = 'linux';
                    }
                    $result = exec('file -Ib ' . escapeshellarg(__FILE__));
                    if (0 === strpos($result, 'text/x-php') or 0 === strpos($result, 'text/x-c++')) {
                        $fmime = 'bsd';
                    }
                }else{
                    $fp = fopen($path, "r");
                    $bin = fread($fp, 2);
                    fclose($fp);$str_info = @unpack("C2chars", $bin);//Unpack data from binary string
                    $type_code = intval($str_info["chars1"] . $str_info["chars2"]);// Get the integer value of a variable
                    switch ($type_code) {
                        case 7790:
                            $file_type = 'application/octet-stream';
                            break;
                        case 7784:
                            $file_type = 'audio/midi';
                            break;
                        case 8075:
                            $file_type = 'application/zip';
                            break;
                        case 8297:
                            $file_type = 'application/x-rar';
                            break;
                        case 255216:
                            $file_type =  'image/jpeg';
                            break;
                        case 7173:
                            $file_type = 'image/gif';
                            break;
                        case 6677:
                            $file_type = 'image/x-ms-bmp';
                            break;
                        case 13780:
                            $file_type = 'image/png';
                            break;
                        default:
                            $file_type = "unknown";
                            break;
                    }
                    if($file_type!='unknown')
                        $fmime = 'binary';
                }
            }
        }

        switch ($fmime) {
            case 'finfo':
                $finfo = finfo_open(FILEINFO_MIME);
                if ($finfo) {
                    $type = @finfo_file($finfo, $path);
                }
                break;
            case 'mime_content_type':
                $type = mime_content_type($path);
                break;
            case 'linux':
                $type = exec('file -ib ' . escapeshellarg($path));
                break;
            case 'bsd':
                $type = exec('file -Ib ' . escapeshellarg($path));
                break;
            case 'binary':
                $type = $file_type;
                break;
            default:
                $pinfo = pathinfo($path);
                $ext = isset($pinfo['extension']) ? strtolower($pinfo['extension']) : '';
                $type = isset($mime[$ext]) ? $mime[$ext][0] : 'unkown';
                break;
        }
        $type = explode(';', $type);
        if ($fmime != 'internal' and $type[0] == 'application/octet-stream') {
            $pinfo = pathinfo($path);
            $ext = isset($pinfo['extension']) ? strtolower($pinfo['extension']) : '';
            if (!empty($ext) and !empty($mime[$ext])) {
                $type[0] = $mime[$ext][0];
            }
        }
        foreach ($mime as $t=>$v){
            if(in_array($type[0],$v)){
               $mimetype = $t;
			   break;
            }
        }

		if(strtolower($ext)=='jpeg' && strtolower($mimetype)=='jpg')$mimetype='jpeg';
		if(strtolower($ext)=='csv' && strtolower($mimetype)=='txt')$mimetype='csv';
		if(strtolower($ext)=='docx' && strtolower($mimetype)=='zip')$mimetype='docx';
        return $mimetype;
    }

}
