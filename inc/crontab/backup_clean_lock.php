<?php
defined('PHP168_PATH') or die();
$tid = $CACHE->read('core/modules/', 'dbm', 'backup_lock','serialize');
$CACHE->delete('core/modules/'. 'dbm', 'task', $tid);
$CACHE->delete('core/modules/', 'dbm', 'backup_lock');