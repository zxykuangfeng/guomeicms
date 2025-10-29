<?php
defined('PHP168_PATH') or die();

class P8_Auditflow_Controller extends P8_Controller
{

    function __construct(&$obj)
    {
        parent::__construct($obj);
    }


    function check_scope($system, $module = '', $postfix = '')
    {
        global $IS_FOUNDER;
        if ($IS_FOUNDER) {
            return true;
        }

        //所有系统
        if (!empty($this->acl['scope']['*'])) {
            return true;
        }

        //系统下的所有模块
        if (!empty($this->acl['scope'][$system]['*'])) {
            return true;
        }

        //所有后缀
        if (!empty($this->acl['scope'][$system][$module]['*'])) {
            return true;
        }

        return !empty($this->acl['scope'][$system][$module][$postfix]);
    }

    /**
     * 添加
     **/
    function add(&$POST)
    {
        $data = $this->valid_data($POST);
        if (empty($data['title'])) {
            return false;
        }
        if ($data === null) {
            return false;
        }

        //if(!$this->check_scope($data['system'], $data['module'], $data['postfix'])) return false;

        return $this->model->add($data);
    }

    /**
     * 更新
     **/
    function update($id, &$POST)
    {
        $data = $this->valid_data($POST);
        unset($data['name']);
        if ($data === null) {
            return false;
        }

        //if(!$this->check_scope($data['system'], $data['module'], $data['postfix'])) return false;

        return $this->model->update($id, $data);
    }

    /**
     * 验证数据
     **/
    function valid_data(&$POST)
    {
        $data = [];

        $data['title'] = html_entities($POST['title']);
        $data['desc'] = html_entities($POST['desc']);
        $data['system'] = html_entities($POST['system']);
        $data['module'] = html_entities($POST['module']);
        $data['postfix'] = html_entities($POST['postfix']);
        if(!in_array($data['module'],['sites']))$data['postfix']='mainstation';
        $data['num'] = intval($POST['num']);
        $data['step_final'] = implode(',', $POST['step_final']);
        $data['step_auto'] = implode(',', $POST['step_auto']);

        $map = ['step_one', 'step_two', 'step_three', 'step_four'];
        foreach ($map as $i => $k) {
            $data[$k] = '';
            if ($i < $data['num'] - 1) {
                $data[$k] = implode(',', $POST[$k]);
                if (!$data[$k]) {
                    return false;
                }
            }
        }
        $data['timestamp'] = date('Y-m-d H:i:s');
        $data['status'] = intval($POST['status']);
        return $data;
    }


}
