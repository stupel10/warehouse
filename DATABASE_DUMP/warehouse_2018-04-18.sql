# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.35)
# Database: warehouse
# Generation Time: 2018-04-18 12:52:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `warehouses` varchar(200) DEFAULT '',
  `admins` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `warehouses`, `admins`)
VALUES
	(1,'company','','');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;

INSERT INTO `config` (`setting`, `value`)
VALUES
	('attack_mitigation_time','+30 minutes'),
	('attempts_before_ban','30'),
	('attempts_before_verify','5'),
	('bcrypt_cost','10'),
	('cookie_domain',NULL),
	('cookie_forget','+30 minutes'),
	('cookie_http','0'),
	('cookie_name','authID'),
	('cookie_path','/'),
	('cookie_remember','+1 month'),
	('cookie_secure','0'),
	('emailmessage_suppress_activation','0'),
	('emailmessage_suppress_reset','0'),
	('mail_charset','UTF-8'),
	('password_min_score','3'),
	('request_key_expiration','+10 minutes'),
	('site_activation_page','activate'),
	('site_email','no-reply@phpauth.cuonic.com'),
	('site_key','fghuior.)/!/jdUkd8s2!7HVHG7777ghg'),
	('site_name','PHPAuth'),
	('site_password_reset_page','reset'),
	('site_timezone','Europe/Paris'),
	('site_url','https://github.com/PHPAuth/PHPAuth'),
	('smtp','0'),
	('smtp_auth','1'),
	('smtp_debug','0'),
	('smtp_host','smtp.example.com'),
	('smtp_password','password'),
	('smtp_port','25'),
	('smtp_security',NULL),
	('smtp_username','email@example.com'),
	('table_attempts','user_attempts'),
	('table_requests','user_requests'),
	('table_sessions','user_sessions'),
	('table_users','users'),
	('table_user_profiles','user_profiles'),
	('verify_email_max_length','100'),
	('verify_email_min_length','5'),
	('verify_email_use_banlist','1'),
	('verify_password_min_length','3');

/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;

INSERT INTO `suppliers` (`id`, `company_id`, `name`, `address`)
VALUES
	(9,1,'Stavebniny Jan','Trnava');

/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` int(11) DEFAULT NULL,
  `log` text,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;

INSERT INTO `logs` (`id`, `company_id`, `user_id`, `user_name`, `log`, `dt`)
VALUES
	(1,1,40,NULL,'Log out','2018-04-04 01:31:49'),
	(2,1,40,0,'Log out','2018-04-04 01:35:36'),
	(3,1,40,0,'Log out','2018-04-09 13:58:00'),
	(4,1,40,0,'Log out','2018-04-09 14:19:00'),
	(5,1,40,0,'Log out','2018-04-13 14:12:48'),
	(6,1,40,0,'Log out','2018-04-13 15:01:29'),
	(7,7,50,0,'Log out','2018-04-13 15:29:46'),
	(8,1,40,0,'Log out','2018-04-13 17:27:04'),
	(9,1,40,0,'Log out','2018-04-13 17:57:20');

/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `about` text,
  `photo_link` varchar(100) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `unit_weight` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `company_id`, `name`, `about`, `photo_link`, `unit_price`, `unit_weight`)
VALUES
	(1,1,'Lavicka ocelova','Nejaka ocelova lavicka','',90,80),
	(2,1,'Umela lavicka','Umelohmotna lavicka z umelej hmoty','',30,20),
	(3,1,'KAWA ER6N','KAWASAKI ER-6N','/assets/images/products/company_1_product_3.jpg',8000,206),
	(5,1,'BIKE DUCATI BLACK','cierny  ducati','/assets/images/products/company_1_product_5.jpg',999.99,14.001);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rkey` varchar(20) NOT NULL,
  `expire` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table subscribers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscribers`;

CREATE TABLE `subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;

INSERT INTO `subscribers` (`id`, `company_id`, `name`, `address`)
VALUES
	(2,1,'Slovnaft','Bratislava');

/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_attempts`;

CREATE TABLE `user_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_permissions`;

CREATE TABLE `user_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `default_value` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;

INSERT INTO `user_permissions` (`id`, `name`, `default_value`)
VALUES
	(1,'create_user',0),
	(2,'edit_user',0),
	(3,'delete_user',0),
	(4,'view_user',0),
	(5,'create_product',0),
	(6,'view_product',0),
	(7,'edit_product',0),
	(8,'delete_product',0),
	(9,'create_warehouse',0),
	(10,'view_warehouse',0),
	(11,'edit_warehouse',0),
	(12,'delete_warehouse',0),
	(13,'move_product',0),
	(14,'create_partner',0),
	(15,'view_partner',0),
	(16,'edit_partner',0),
	(17,'delete_partner',0);

/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;

INSERT INTO `user_profiles` (`id`, `name`, `surname`, `company_id`, `date_registered`, `role`)
VALUES
	(40,'admin',NULL,1,'2018-04-18 00:27:38','admin'),
	(64,'plkok@plopk.plo','plkok@plopk.plo12',1,'2018-04-18 00:41:27','accountant');

/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_sessions`;

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_sessions` WRITE;
/*!40000 ALTER TABLE `user_sessions` DISABLE KEYS */;

INSERT INTO `user_sessions` (`id`, `uid`, `hash`, `expiredate`, `ip`, `agent`, `cookie_crc`)
VALUES
	(54,46,'7c834bf6db0a8d13e5ef4b0cf17e85800bc7341c','2018-05-03 22:29:00','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','2693b230732ad1a7a2dbb674d5182978f55900f2'),
	(63,47,'33fc778e17343624a21c57cc6df657ff62dc56c7','2018-04-13 15:31:43','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','05d74eda5cc10060a1238b2e71806bcc08563465'),
	(64,48,'846e2649edfce37349de7e6652eb1c5231dba459','2018-04-13 15:33:12','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','52df5665a4ffaf7f13b5984327ae120359028d39'),
	(65,50,'baced15bd735eca946fdb11b66929e6de8f59bce','2018-04-13 15:37:03','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','6789151edabcccd1d48f466bdfe6c16a19480774'),
	(66,51,'8f475fd09b66507562f60e3245f6e7b1bca6237e','2018-04-13 15:37:49','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','239e62a2c676f9be906815744dd8a9f61f49d602'),
	(71,42,'7d0978089b7a5d4f5324f760421a07fe14e671fd','2018-05-17 09:01:24','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','9345a209020b0793addf9e90bf5cabf0b28dc431');

/*!40000 ALTER TABLE `user_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_profile` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `isactive`, `dt`, `active_profile`)
VALUES
	(42,'robka@robka.diplo','$2y$10$D7QJMU3SFRkkzeinzUHUo.VHvPwvjMXeBFeJ7du.izc8nD/2mibWe',1,'2018-03-31 19:22:14',40),
	(66,'plkok@plopk.plo','$2y$10$5ZgEwp6B8jxhntlCVpcS.uF9BoUKwQxFdAurvdz53O2VMCTS3RLrC',1,'2018-04-18 00:18:10',64);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_permissions`;

CREATE TABLE `users_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_profile_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;

INSERT INTO `users_permissions` (`id`, `user_profile_id`, `permission_id`, `value`)
VALUES
	(16,40,1,1),
	(17,40,2,1),
	(18,40,3,1),
	(19,40,4,1),
	(20,40,5,1),
	(21,40,6,1),
	(22,40,7,1),
	(23,40,8,1),
	(24,40,9,1),
	(25,40,10,1),
	(26,40,11,1),
	(27,40,12,1),
	(28,40,13,1),
	(29,40,15,1),
	(30,40,17,1),
	(31,40,14,1),
	(32,62,1,1),
	(33,62,2,1),
	(34,62,3,1),
	(35,62,4,1),
	(36,62,5,1),
	(37,62,6,1),
	(38,62,7,1),
	(39,62,8,1),
	(40,62,9,1),
	(41,62,10,1),
	(42,62,11,1),
	(43,62,12,1),
	(44,62,13,1),
	(45,62,14,1),
	(46,62,15,1),
	(47,62,16,1),
	(48,62,17,1),
	(49,63,1,0),
	(50,63,2,0),
	(51,63,3,0),
	(52,63,4,0),
	(53,63,5,1),
	(54,63,6,1),
	(55,63,7,1),
	(56,63,8,1),
	(57,63,9,0),
	(58,63,10,1),
	(59,63,11,0),
	(60,63,12,0),
	(61,63,13,1),
	(62,63,14,1),
	(63,63,15,1),
	(64,63,16,1),
	(65,63,17,0),
	(66,64,1,0),
	(67,64,2,0),
	(68,64,3,0),
	(69,64,4,0),
	(70,64,5,0),
	(71,64,6,1),
	(72,64,7,0),
	(73,64,8,0),
	(74,64,9,0),
	(75,64,10,1),
	(76,64,11,0),
	(77,64,12,0),
	(78,64,13,0),
	(79,64,14,0),
	(80,64,15,1),
	(81,64,16,0),
	(82,64,17,0),
	(83,64,1,0),
	(84,64,2,0),
	(85,64,3,0),
	(86,64,4,0),
	(87,64,5,0),
	(88,64,6,1),
	(89,64,7,0),
	(90,64,8,0),
	(91,64,9,0),
	(92,64,10,1),
	(93,64,11,0),
	(94,64,12,0),
	(95,64,13,0),
	(96,64,14,0),
	(97,64,15,1),
	(98,64,16,0),
	(99,64,17,0);

/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table warehouse_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `warehouse_products`;

CREATE TABLE `warehouse_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `warehouse_products` WRITE;
/*!40000 ALTER TABLE `warehouse_products` DISABLE KEYS */;

INSERT INTO `warehouse_products` (`id`, `warehouse_id`, `product_id`, `quantity`, `supplier_id`)
VALUES
	(12,1,3,4,10),
	(14,1,5,10,11),
	(15,1,5,8,9);

/*!40000 ALTER TABLE `warehouse_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table warehouses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `warehouses`;

CREATE TABLE `warehouses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` text,
  `info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;

INSERT INTO `warehouses` (`id`, `company_id`, `name`, `address`, `info`)
VALUES
	(1,1,'prvy','Ochotnicka 45\r\n91701 Trnava\r\nSlovensko','Nejake zakladne info o sklade'),
	(2,1,'Druhy',NULL,NULL);

/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
