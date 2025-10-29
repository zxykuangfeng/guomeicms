<?php
defined('PHP168_PATH') or die();

/**
 *
 **/
class P8_Auditflow extends P8_Module
{

    var $table;            //数据表
    var $table_item;            //数据表
    var $steps;
    var $calles;

    const FINAL_STEP = 8;

    //状态码
    const STEPMAP = [
        5 => [
            'step_one'   => 0, //'一审',
            'step_two'   => 2, //'二审',
            'step_three' => 4,//'三审',
            'step_four'  => 6,//'四审',
            'step_final' => 8, //'终审',
        ],
        4 => [
            'step_one'   => 0, //'一审',
            'step_two'   => 2, //'二审',
            'step_three' => 4,//'三审',
            'step_final' => 6, //'终审',
        ],

        3 => [
            'step_one'   => 0, //'一审',
            'step_two'   => 2, //'二审',
            'step_final' => 4, //'终审',
        ],

        2 => [
            'step_one'   => 0, //'一审',
            'step_final' => 2, //'终审',

        ],
    ];

    /**
     * 目标码
     */
    const TOSTEP = [
        5=>[
            8 => 1, //'终审',
            6 => 8,//'四审',
            4 => 6,//'三审',
            2 => 4, //'二审',
            0 => 2, //'一审'
        ],
        4=>[
            6 => 1, //'终审',
            4 => 6,//'三审',
            2 => 4, //'二审',
            0 => 2, //'一审'
        ],
        3=>[
            4 => 1, //'终审',
            2 => 4, //'二审',
            0 => 2, //'一审'
        ],
        2=>[
            2 => 1, //'终审',
            0 => 2, //'一审'
        ],

    ];

    const NEED_ZERO = 0; //不需处理
    const NEED_ONE = 1; //未轮到处理
    const NEED_TWO = 2; //待处理
    const NEED_THREE = 3; //已处理

    function __construct(&$system, $name)
    {
        $this->configurable = true;
        $this->system = &$system;

        parent::__construct($name);
        $this->TABLE_ = $this->core->TABLE_ . 'audit_';

        $this->table = $this->core->TABLE_ . 'audit_step';
        $this->table_item = $this->core->TABLE_ . 'audit_item';

    }


    /**
     * 生成权限缓存
     **/
    function cache($module='cms', $postfix='mainstation', $return = false)
    {
        global $core;
        $query = $this->DB_master->query("SELECT * FROM $this->table WHERE module='{$module}' and postfix='$postfix'");

        $dostep = function (&$datasp, $steps, $step) {
            foreach ($steps as $admin) {
                if ($admin) {
                    $datasp[$admin][] = $step;
                }
            }
        };

        $datasp = [];
        $stepnums = [];
        while ($arr = $this->DB_master->fetch_array($query)) {

            $stepnums[$arr['id']] = $arr['num'];
            $one = explode(',', $arr['step_one']);
            $two = explode(',', $arr['step_two']);
            $thre = explode(',', $arr['step_three']);
            $four = explode(',', $arr['step_four']);
            $final = explode(',', $arr['step_final']);

            // $datasp[$arr['id']]['admin'] = ['steps'];

            $_step = [];
            $dostep($_step, $one, self::STEPMAP[5]['step_one']);
            $dostep($_step, $two, self::STEPMAP[5]['step_two']);
            $dostep($_step, $thre, self::STEPMAP[5]['step_three']);
            $dostep($_step, $four, self::STEPMAP[5]['step_four']);
            $dostep($_step, $final, self::STEPMAP[5]['step_final']);


            $datasp[$arr['id']] = $_step;
        }

        $stepsflow = $this->getCall($module)->cache($stepnums,$datasp);
        if ($return) {
            return $stepsflow;
        }

        /*$data = [
            'admin1'=>[
                    cid1=>['num'=>2,steps=>['step1','step2'],verified=['verified1','verified2']],//num:多少级， steps:可以操作的步级, verified:可以审核的当前状态
                    cid2=>['num'=>2,steps=>['step1','step2']],
                ],
        ];*/

        global $CACHE;
        $CACHE->write('core/modules', 'auditflow', 'stepflow_'.$module.'_'.$postfix, $stepsflow, 'serialize');

    }

    function getAudit($id,$field='')
    {
        $stepd = $this->DB_master->fetch_one("select * from {$this->table} where id={$id}");
        return $field && isset($stepd[$field])?$stepd[$field]:$stepd;
    }

    /**
     * 依权限构造条件
     * @param $module
     * @param $uid
     * @param $final 终审
     * @return string
     */
    function getCondition($module,$postfix, $uid, $final = false, $iid='cid')
    {
        global $CACHE, $IS_FOUNDER;

        if ($IS_FOUNDER) {
            return " 1=1";
        }
        if ($final) {
            return $this->getCondition2($module,$postfix, $uid,$iid);
        }
        // $cacheData = $CACHE->read('core/modules', 'auditflow', 'stepflow_' . $module, 'serialize');
        $cacheData = $this->cache($module, $postfix,true);
        $return = [];
        $cData = $cacheData[$uid];
        foreach ($cData as $cid => $steps) {
            $return[$cid] = $cid;
        }
        $return = $return ? implode(',', $return) : '-1';
        $return = "{$iid} in($return)";
        return " $return";
    }

    /**
     * 依权限构造条件
     * @param $module
     * @param $uid
     * @return string
     */
    function getCondition2($module,$postfix, $uid, $iid='cid')
    {
        $cacheData = $this->cache($module,$postfix,true);
        $return = [];
        $cData = $cacheData[$uid];
        foreach ($cData as $cid => $steps) {
            if(in_array(self::FINAL_STEP, $steps['steps']))
                $return[$cid] = $cid;
        }
        $return = $return ? implode(',', $return) : '-1';
        $return = "{$iid} in($return)";
        return " $return";
    }

    /**
     * 取选择
     * @return array
     */
    function getSteps($module='',$postfix='')
    {
        $sql = "SELECT * FROM $this->table WHERE 1=1";
        if($module)$sql .= " and module='{$module}'";
        if($postfix)$sql .= " and postfix='{$postfix}'";
        $list = $this->DB_master->fetchArray($sql);

        $uids = [];
        $one = array_column($list,'step_one');
        $two = array_column($list,'step_two');
        $thre = array_column($list,'step_three');
        $four = array_column($list,'step_four');
        $final = array_column($list,'step_final');
        $auto = array_column($list,'step_auto');

        $uids = array_merge($uids,$one,$two,$thre,$four,$final,$auto);
        $uids = implode(',',$uids);
        $uids = array_filter(array_unique(explode(',',$uids)));
        $uids = implode(',',$uids);
        $uids = $uids?$uids:-1;
        $member = &$this->core->load_module('member');
        $manager = $this->DB_master->fetch_all("SELECT id,username,`name` FROM {$member->table} WHERE id IN ($uids)");
        $managers = array_column($manager, 'username', 'id');
        $managers2 = array_column($manager, 'name', 'id');

        $makeOption = function($steps,$title)use($managers,$managers2){

            $uids = explode(',',$steps);
            $unames = [];
            foreach ($uids as $uid){
                $unames[] = $managers[$uid]. ($managers2[$uid]? '('.$managers2[$uid].')':'');
            }
            if(!$unames)return $title;
            return $title.'【'.implode('，',$unames).'】';

        };

        $steps = [];
        foreach($list as $arr){
            $title =  $arr['title'].'：';

            $arr['step_one'] && $title.= $makeOption($arr['step_one'],'一审');
            $arr['step_two'] && $title.= $makeOption($arr['step_two'],'，二审');
            $arr['step_three'] && $title.= $makeOption($arr['step_three'],'，三审');
            $arr['step_four'] && $title.= $makeOption($arr['step_four'],'，四审');
            $arr['step_final'] && $title.= $makeOption($arr['step_final'],'，终审');

            $steps[$arr['id']] = $title;//$arr['title'].'：一审[张三]二审[李四]三审[王五]终审[admin]';
        }
        return $steps;
    }

    /**
     * 是否处理
     *  const NEED_ZERO = 0; //不需处理
    const NEED_ONE = 1; //未轮到处理
    const NEED_TWO = 2; //待处理
    const NEED_THREE = 3; //已处理
     * @param $cid
     * @param $uid
     * @param $verified
     * @param $module
     * @return mixed
     */
    function checkNeed($cid, $uid, $verified, $module,$postfix)
    {
        global $IS_FOUNDER, $P8LANG;
        $need = 0;
        if ($IS_FOUNDER) {
            if ($verified == 1) {
                $need = self::NEED_ZERO;
            } elseif ($verified == 0) {
                $need = self::NEED_TWO;
            } elseif ($verified > 1 && $verified <= 8) {
                $need = self::NEED_TWO;
            } else {
                $need = self::NEED_THREE;
            }
        } else {
            $v = $this->checkAudit($cid, $uid, $verified, $module, $postfix);
            if ($verified == 1) {
                $need = self::NEED_ZERO;
            }elseif ($verified == 0 && $v) {
                $need = self::NEED_TWO;
            } elseif (($verified == 0 or $verified > 1) && $verified <= 8) {
                if ($v) {
                    $need = self::NEED_TWO;
                }elseif($this->checkNextAudit($cid, $uid, $verified, $module,$postfix)){
                    $need = self::NEED_ONE;
                }else {
                    $need = self::NEED_THREE;
                }
            } else {
                $need = self::NEED_THREE;
            }

        }
        load_language($this, 'global');
        return $P8LANG['audit_need'][$need];
    }


    /**
     * 判断权限
     * @param $cid
     * @param $uid
     * @param $verified
     * @param $module
     */
    function checkAudit($cid, $uid, $verified, $module, $postfix='mainstation')
    {
        global $CACHE, $IS_FOUNDER;
        // if($IS_FOUNDER)return true;
        //$cacheData = $CACHE->read('core/modules', 'auditflow', 'stepflow_' . $module, 'serialize');
        if($this->getCall($module)->checkAudits())return true;

        $cacheData = $this->cache($module,$postfix,true);

        if (!$cacheData[$uid]) {
            return false;
        }
        $cData = $cacheData[$uid];
        foreach ($cData as $fcid => $verifieds) {
            if ($cid == $fcid && in_array($verified, $verifieds['verified'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * next
     * @param $cid
     * @param $uid
     * @param $verified
     * @param $module
     * @return bool
     */
    function checkNextAudit($cid, $uid, $verified, $module,$postfix){
        foreach (self::STEPMAP[5] as $step=>$ve){
            if($ve<=$verified)continue;
            if($this->checkAudit($cid, $uid, $ve,$module,$postfix)){
                return true;
            }
        }
        return false;
    }


    /**
     * 添加
     * @param array $data
     * @param string $replace 是否覆盖之前的
     **/
    function add($data, $replace = false)
    {

        $id = $this->DB_master->insert(
            $this->table,
            $data,
            ['return_id' => true, 'replace' => $replace]
        );

        return $id;
    }

    /**
     * 更新
     * @param int $id 标签ID
     * @param array $data
     **/
    function update($id, &$data)
    {

        $status = $this->DB_master->update(
            $this->table,
            $data,
            "id = '$id'"
        );

        return $status;
    }

    /**
     * 删除
     * @param array $data 删除条件
     **/
    function delete($id)
    {
        $status = $this->DB_master->delete(
            $this->table,
            "id = '$id'"
        );
        return $status;
    }


    /**
     * 记录
     * @param $data
     * @param false $replace
     * @return mixed
     */
    function addItem($data, $replace = false)
    {
        $id = $this->DB_master->insert(
            $this->table_item,
            $data,
            ['return_id' => true, 'replace' => $replace]
        );

        return $id;
    }

    /**
     * 取记录
     * @param $iid
     * @return array
     */
    function getLog($iid,$module='cms')
    {
        global $P8LANG;
        $query = $this->DB_master->query("SELECT * FROM $this->table_item where iid=$iid AND module='{$module}'");
        $logs = [];
        $steps = $P8LANG['steps'];
        while ($arr = $this->DB_master->fetch_array($query)) {

            $logs[] = date('[Y-m-d H:i]') . ' ' . $arr['verifyer'] . '执行了【' . $steps[$arr['step']] . ($arr['reason'] ? '】，审核理由：' . $arr['reason'] : '】');
        }

        return $logs;
    }

    /**
     * 自动审核权限
     * @param $cid
     * @param $uid
     * @param string $module
     * @return bool
     */
    function checkAuto($cid, $uid,$module='cms'){

        $auditId = $this->getCall($module)->getStepByCid($cid);
        $audit = $this->getAudit($auditId);
        $autoUser = explode(',',$audit['step_auto']);
        if(in_array($uid, $autoUser))return true;
        return false;
    }

    /**
     * 上一次审核人
     * @param $id
     * @param $USERNAME
     * @return bool
     */
    function checkPreLast($id, $USERNAME ,$module='cms',$postfix='mainstation'){
        $lastData = $this->DB_master->fetch_one(" SELECT * FROM {$this->table_item} WHERE iid=$id AND module='{$module}'  ORDER BY ID DESC LIMIT 1");
        return ($lastData['verifyer']==$USERNAME and $lastData['prestep']>=0 and $lastData['prestep']!=1 and $lastData['prestep']<=8 and $lastData['prestep']!=$lastData['step']);
    }

    /**
     * 是否是审核员
     * @param $uid
     * @param $module
     * @return bool
     */
    function checkVerfier($uid,$module,$postfix){
        $cacheData = $this->cache($module,$postfix,true);
        return !empty($cacheData[$uid]);
    }

    public function getCall($module){
        if(isset($this->calles[$module]))return $this->calles[$module];
      if(file_exists(__DIR__ .'/call/'.$module.'.php')){
            require_once __DIR__ .'/call/'.$module.'.php';
            $classname = $module.'call';
            $this->calles[$module] = new $classname;
            return $this->calles[$module];
        }
      return null;
    }

    public function setDefault($auditId, $module, $postfix){
        return $this->getCall($module)->setCateDefault($auditId,$postfix);
    }

}
