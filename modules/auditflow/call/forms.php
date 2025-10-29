<?php
/**
 *
 * Power by php168.net
 * User: bingbin
 * Date: 2023/08/06
 * Time: 17:22
 */

class formscall
{

    const CALL_MODULE='forms';
    /**
     * 跟据当前审核进度 加载显示界面
     * @return array
     */
    public function getitem()
    {
        global $core, $this_module, $P8LANG, $IS_FOUNDER, $USERNAME;

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $verified = isset($_GET['verified']) ? intval($_GET['verified']) : 0;

        $module = $core->load_module('forms');

       $data = $module->get_data($id);

        global $UID;
        $return = [];
        $verify_html = '';

        $Cate = $module->get_model($data['mid'],true);

        $config = unserialize($Cate['config']);

        $auditId = intval($config['auditflow']);
        if (!$auditId) {
            return ['htmlstr' => '抱歉，此模型未设置审核流', 'code' => -1];
        }
        $num = $this_module->getAudit($auditId, 'num');

        $steps = $this_module::STEPMAP[$num];
        $tosteps = $this_module::TOSTEP[$num];
        $_verified = $verified;
        if ($verified == -99 or $verified == 88 or $verified == 66) {//-99 退稿 66回收站
            $verified = -1;
        }

        foreach ($steps as $step => $verifi) {
            if ($verifi < $verified) {
                continue;
            }
            if (!$IS_FOUNDER && !$this_module->checkAudit($data['mid'], $UID, $verifi, self::CALL_MODULE, 'mainstation')) {
                break;
            }
            $tostatus = $tosteps[$verifi];
            $verify_html .= '<span><input type="radio" id="verify' . $tostatus . '" name="value" value="' . $tostatus . '" /><label for="verify' . $tostatus . '">' . $P8LANG[$step] . '</label> </span>';

        }

        $logs = $this_module->getLog($id,self::CALL_MODULE);
        $line = count($logs);
        $logs = implode('<br/>', $logs);
        $finalVerifi = array_values(array_slice($steps, -1, 1));

        if ($IS_FOUNDER
            or ($verify_html && $verified != 1)
            or (1 == $_verified && $this_module->checkAudit($data['mid'],$UID, $finalVerifi[0], self::CALL_MODULE))
            or $this_module->checkPreLast($id,$USERNAME, self::CALL_MODULE)
            or ($verified==-1 && $this_module->checkNextAudit($data['mid'], $UID, $verified, self::CALL_MODULE))
        ) {
            $verify_html = '<span><input type="radio" id="verify99" name="value" value="-99" /><label for="verify99">退稿</label> </span>'
                . '<span><input type="radio" id="verify88" name="value" value="88" /><label for="verify88">回收站</label> </span>'
                . '<span><input type="radio" id="verify0" name="value" value="0" /><label for="verify0">待审核</label> </span>'
                . $verify_html;

            $verify_html .= "<fieldset><legend>审核理由</legend><textarea rows='5' cols='60'></textarea></fieldset>";

            $verify_html = ($logs ? '<fieldset><legend>审核记录</legend>' . $logs . '</fieldset><br/>' : '') . $verify_html;
            $return = ['htmlstr' => $verify_html, 'line' => $line, 'code' => 0];
        } else {
            $verify_html = '<font color="blue">抱歉，您暂未轮到处理或暂无权限处理！</font>';
            $verify_html = $verify_html . ($logs ? '<br/><br/><fieldset><legend>审核记录</legend>' . $logs . '</fieldset><br/>' : '');
            $return = ['htmlstr' => $verify_html, 'line' => $line, 'code' => -1];
        }
        return $return;
    }

    /**
     * 审核
     * @return null
     */
    public function verifyitem()
    {
        global $USERNAME, $this_module, $core;


        $id = isset($_POST['id']) ? $_POST['id'] : [];
        $value = isset($_POST['value']) ? trim($_POST['value']) : 'undefined';
        if (!is_numeric($value)) {
            message('[]');
        }
        $id or message('[]');

        $id = filter_int($id);
        $id or exit('[]');

        $verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? 1 : 0;
        //退稿理由
        $push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';

        $data = [
            'module'      => self::CALL_MODULE,
            'iid'         => $id[0],
            'prestep'     => intval($_POST['verified']),
            'step'        => $value,
            'verifyer'    => $USERNAME,
            'verify_time' => time(),
            'reason'      => $push_back_reason,
        ];
        $this_module->addItem($data);


        $module = $core->load_module(self::CALL_MODULE);
        /*
         value = -99 退稿
         value = 0  撤回初审
         value =2   初审
         value = 1 终审
         value = 88 回收站
        */
        $ret = $module->verify([
            'id' => $id[0],
            'where' => "id IN ({$id[0]})",
            'value' => $value,
            'push_back_reason' => $push_back_reason
        ])
        or exit('{"code":0}');
        $ret = [
            'code'=>1,
            'id'=>[$ret[0]['id']],
            'verified'=>$value,
        ];
        exit(json_encode($ret));
    }

    /**
     * 缓存
     * @param $stepnums
     * @param $datasp
     * @return array
     */
    public function cache($stepnums, $datasp)
    {
        global $this_module, $core;
        $module = $core->load_module(self::CALL_MODULE);
        $query = $core->DB_master->query("SELECT id,config FROM {$module->model_table}");

        $stepsflow = [];
        while ($cdata = $core->DB_master->fetch_array($query)) {
            $config = unserialize($cdata['config']);

            $stepId = $config['auditflow'];
            $num = $stepnums[$stepId];
            $stepData = $datasp[$stepId];
            foreach ($stepData as $admin => $step) {
                $veData = [];
                foreach ($step as $k => $ii) {
                    if ($ii == 8) {
                        $veData[] = P8_Auditflow::STEPMAP[$num]['step_final'];
                    } else {
                        $veData[] = $ii;
                    }
                }
                $stepsflow[$admin][$cdata['id']] = [
                    'num'      => $num,
                    'steps'    => $step,
                    'verified' => $veData,
                ];
            }
        }
      //  print_r($stepsflow);
        return $stepsflow;
    }

    public function getStepByCid($cid){
        global $this_module, $core;
        $module = $core->load_module(self::CALL_MODULE);
        $Cate = $module->get_model($cid);
        $auditId = $Cate['CONFIG']['auditflow'] ? intval($Cate['CONFIG']['auditflow']) : 0;
        return $auditId;
    }

    /**
     * @return false
     */
    public function checkAudits(){
        return false;
    }

    public function setCateDefault($auditId,$postfix=''){
        global $this_module, $core;
        $module = $core->load_module(self::CALL_MODULE);
        $query = $core->DB_master->query("SELECT id,config FROM {$module->table}");
        while ($cdata = $core->DB_master->fetch_array($query)) {
            $config = unserialize($cdata['config']);
            $config['auditflow']= isset($config['auditflow'])?$config['auditflow']:$auditId;
            $config = serialize($config);

            $core->DB_master->update($module->table, ['config'=>$config], "id=".$cdata['id']);

        }
        $module->cache();
    }
}