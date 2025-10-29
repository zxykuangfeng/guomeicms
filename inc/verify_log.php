<?php
class VerifyLog
{

    protected $db;
    protected $table;

    function __construct()
    {
        global $core;
        $this->db = $core->DB_master;
        $this->table = $core->TABLE_ . 'item_verify_log';
    }

    function create($module,$iid,$stepName,$reason)
    {
        global $USERNAME;
        $member_info = get_member($USERNAME);
        $td = date('Y-m-d');
        $detail = explode($td,$reason);
        $reason=$detail[0];
        if(!is_array($iid)){
            $iids=[$iid];
        }else{
            $iids = $iid;
        }
        foreach($iids as $id) {
            $data = [
                'module'      => $module,
                'iid'         => $id,
                'step_title'  => $stepName,
                'operator'    => $USERNAME . ($member_info['name'] ? '(' . $member_info['name'] . ')' : ''),
                'update_time' => time(),
                'reason'      => $reason
            ];

            $this->db->insert($this->table, $data);
        }

    }

    function list($module, $iid)
    {
        return $this->db->fetchArray("SELECT * FROM {$this->table} WHERE module='{$module}' AND iid='{$iid}'");
    }

    function listHtml($module, $iid)
    {
        $list = $this->list($module, $iid);
        $logstr = '';
        foreach ($list as $item) {
            $logs[] = date('[Y-m-d H:i:s]',$item['update_time']) . ' ' . $item['operator'] . '执行了【' . $item['step_title'] . ($item['reason'] ? '】，审核理由：' . $item['reason'] : '】');
        }
        if($logs){
            $logstr = implode('<br/>',$logs);
            $logstr = '<fieldset><legend style="font-size: 12px">审核记录</legend>' . $logstr . '</fieldset><br/>';
        }

        return [
            'line'=>count($logs),
            'htmlstr'=>$logstr
        ];
    }
}