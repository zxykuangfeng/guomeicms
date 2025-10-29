-- <?php exit;?>
UPDATE `p8_sites_category` SET `htmlize` = 0;
ALTER TABLE  `p8_navigation_menu` ADD `summary` text NOT NULL,ADD `frame` CHAR( 255 ) NOT NULL;
ALTER TABLE `p8_navigation_menu` ADD `dynamic_url` CHAR( 255 ) NOT NULL DEFAULT '' AFTER `url`;
UPDATE `p8_navigation_menu` SET `dynamic_url` =  `url`;