DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
     `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
     `title` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
     `status` TINYINT(3) NOT NULL DEFAULT '0',
     `start_date` DATE NOT NULL,
     `end_date` DATE NOT NULL,
     PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
