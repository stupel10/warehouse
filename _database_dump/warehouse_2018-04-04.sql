# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.35)
# Database: warehouse
# Generation Time: 2018-04-03 23:48:37 +0000
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
	(1,'TESCO','','');

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
	(2,1,40,0,'Log out','2018-04-04 01:35:36');

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
	(1,1,'Lavicka ocelova','Nejaka ocelova lavicka','../../assets/images/products/company_1_product_1.',90,80),
	(2,1,'Umela lavicka','Umelohmotna lavicka z umelej hmoty','../../assets/images/products/company_1_product_2.',30,20),
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



# Dump of table user_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_attempts`;

CREATE TABLE `user_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `rights` text,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;

INSERT INTO `user_profiles` (`id`, `name`, `surname`, `company_id`, `rights`, `date_registered`)
VALUES
	(40,'admin',NULL,1,NULL,'2018-03-31 19:26:09'),
	(44,'Jozo','Slama',1,NULL,'2018-04-03 22:21:05');

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
	(58,42,'7c2fca5542427fd237f841b3ccf045885131cac3','2018-05-04 01:36:34','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36','9479dc3600d10153ff1069f9993ebdaeb9bb7248');

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
	(46,'jozo@slama.sk','$2y$10$FFYaZV/xpjJBFlHenv7dxeTv5LDbN9ARhJ6Y5N0BVpqUw4ZTStRUC',1,'2018-04-03 22:21:05',44);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table warehouse_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `warehouse_products`;

CREATE TABLE `warehouse_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `warehouse_products` WRITE;
/*!40000 ALTER TABLE `warehouse_products` DISABLE KEYS */;

INSERT INTO `warehouse_products` (`id`, `warehouse_id`, `product_id`, `quantity`)
VALUES
	(6,1,3,4),
	(7,1,1,6);

/*!40000 ALTER TABLE `warehouse_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table warehouses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `warehouses`;

CREATE TABLE `warehouses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;

INSERT INTO `warehouses` (`id`, `company_id`, `name`)
VALUES
	(1,1,'prvy'),
	(2,1,'Druhy');

/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
