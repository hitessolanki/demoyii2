-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `employee_master`;
CREATE TABLE `employee_master` (
  `emp_code` varchar(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `joining_date` date DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active,0:Inactive',
  `created_at` int(10) DEFAULT 0,
  `updated_at` int(10) DEFAULT 0,
  `photo_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`emp_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `employee_master` (`emp_code`, `full_name`, `joining_date`, `designation`, `status`, `created_at`, `updated_at`, `photo_data`) VALUES
('E101',	'Hitesh solanki',	'2020-02-03',	'Full Stack Developer',	1,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `user_master`;
CREATE TABLE `user_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `original_password` varchar(255) NOT NULL,
  `email_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `auth_key` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:inactive 1:Active 2:block 3:admin block',
  `file_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Not deleted 1:Deleted',
  `created_at` int(10) NOT NULL DEFAULT 0,
  `updated_at` int(10) NOT NULL DEFAULT 0,
  `last_visited_at` int(10) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:admin',
  `password_reset_token` varchar(255) DEFAULT NULL,
  `photo_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_master` (`id`, `first_name`, `last_name`, `username`, `password`, `original_password`, `email_id`, `auth_key`, `status`, `file_id`, `is_deleted`, `created_at`, `updated_at`, `last_visited_at`, `is_admin`, `password_reset_token`, `photo_data`) VALUES
(1,	'hitesh1',	'solanki1',	'hovjc',	'$2y$13$KlUF65ce9vQGSm2byASWJu9dRqdQJVHpvAKcs9yalLsOspyI3ZIZS',	'^z8SAlNK',	'solanki2.h@gmail.com',	'eec527573971d16c8849b5770c245826',	1,	NULL,	0,	1504851243,	1504852202,	0,	1,	'GULC8W4hC6yEVLBfQmgYc_ED7bVeFJs6_1504851244',	NULL),
(19,	'super',	'admin',	'xjtpd',	'$2y$13$XZ2mMVTT9eKkbrhFVVw0zebdWf9CSw9Wd4iUrJSbfOzOoUcweG.U6',	'Admin@123',	'hiteshsolanki3112@gmail.com',	'b0ec5951ebfc469e8578fadb7ebcfc0f',	1,	NULL,	0,	1504853830,	1504864534,	0,	1,	'A1HRdl9d89ysX8B1IymenTjlqKjn6SfW_1504853830',	NULL),
(20,	'hiren',	'test',	'cyspg',	'$2y$13$aflhx1v7zI7pj5GoFJhHzOPyRx33VPugUwjvQFwa3h4gTGZuO3/sy',	'N;=.rnTe',	'hitesh.solanki@test.com',	'0c0fdd8af511193d5d7f0b4488b17b59',	1,	212,	0,	1587997949,	1587997949,	0,	1,	NULL,	NULL);

-- 2020-04-27 14:38:11