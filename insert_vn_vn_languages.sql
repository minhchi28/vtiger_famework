INSERT INTO `vtiger_language` (`id`, `name`, `prefix`, `label`, `lastupdated`, `sequence`, `isdefault`, `active`) VALUES (NULL, 'Vietnamese', 'vn_vn', 'Tiếng Việt | Vietnamese', '2018-06-21 04:14:20', NULL, '1', '1');
UPDATE `vtiger_language_seq` SET `id` = 17;
UPDATE `vtiger_language` SET `isdefault` = '1' WHERE `vtiger_language`.`id` = 17;