<?php
/**
 *
 * Power by php168.net
 * User: bingbin
 * Date: 2023/2/12
 * Time: 23:28
 */

if(REQUEST_METHOD == 'POST'){
    $id = intval($_POST['id']);
    $module = trim($_POST['module']);
    $postfix = trim($_POST['postfix']);
    $this_module->setDefault($id,$module,$postfix);
    message('done',$this_router.'-list?module='.$_POST['module']);
}
