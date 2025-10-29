-- <?php exit;?>

REPLACE INTO `p8_crontab_` (`id`, `name`, `script`, `status`, `next_run_time`, `last_run_time`, `day`, `week`, `month`, `hour`, `minute`) VALUES 
(1, '清除SESSION', 'clear_session.php', 1, 1502064000, 1502020995, 0, 0, 0, 12, 0);
REPLACE INTO `p8_crontab_` (`id`, `name`, `script`, `status`, `next_run_time`, `last_run_time`, `day`, `week`, `month`, `hour`, `minute`) VALUES 
(2, '清除过期角色', 'expired_buy_role.php', 1, 1502035200, 1501985107, 1, 0, 0, 0, 0);
REPLACE INTO `p8_crontab_` (`id`, `name`, `script`, `status`, `next_run_time`, `last_run_time`, `day`, `week`, `month`, `hour`, `minute`) VALUES 
(3, '定时静态PC版首页', 'cms_index_to_html.php', 1, 1502026920, 1502026630, 0, 0, 0, 0, 5);
REPLACE INTO `p8_crontab_` (`id`, `name`, `script`, `status`, `next_run_time`, `last_run_time`, `day`, `week`, `month`, `hour`, `minute`) VALUES 
(5, '定时静态移动版首页', ' cms_index_to_html_mobile.php', 1, 1502027100, 1502026227, 0, 0, 0, 0, 15);

