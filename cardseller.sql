/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - cardseller
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cardseller` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `cardseller`;

/*Table structure for table `card_list` */

DROP TABLE IF EXISTS `card_list`;

CREATE TABLE `card_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) DEFAULT '',
  `type` enum('AMERICAN_EXPRESS','MASTER_CARD','VISA_CARD','DISC') DEFAULT 'VISA_CARD',
  `cvv` varchar(20) DEFAULT '',
  `exp_date` date DEFAULT NULL,
  `category` varchar(200) DEFAULT '',
  `price` float(5,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT '',
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `card_number` varchar(25) DEFAULT '',
  `card_address` varchar(100) DEFAULT '',
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT '',
  `zip` varchar(10) DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `is_purchased` tinyint(1) DEFAULT 0,
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `card_list` */

insert  into `card_list`(`id`,`image`,`type`,`cvv`,`exp_date`,`category`,`price`,`name`,`email`,`phone`,`card_number`,`card_address`,`country_id`,`state_id`,`city`,`zip`,`created_at`,`updated_at`,`is_purchased`,`is_del`) values 
(1,'','AMERICAN_EXPRESS','5184460','2029-01-28','BLACK MARKET VR 89% NoRef',1.00,'',NULL,NULL,'1231231134537753','3323 Kings Highway 3B',1,1,'Brooklyn','','2023-01-27 22:58:37','2023-01-29 04:58:38',1,0),
(2,'','AMERICAN_EXPRESS','5184461','2023-01-16','BLACK MARKET VR 89% NoRef',1.50,'',NULL,NULL,'12123111123','',1,1,'','','2023-01-27 22:58:37','2023-01-30 13:00:53',1,0),
(3,'','AMERICAN_EXPRESS','5184462','2027-01-29','BLACK MARKET VR 89% NoRef',1.00,'asdf','dsaf@as.com','123123','123123','United States',1,1,'Brooklyn','11234','2023-01-27 22:58:37','2023-02-01 22:40:41',0,0),
(4,'','AMERICAN_EXPRESS','5184463','2023-02-16','BLACK MARKET VR 89% NoRef',1.00,'Aleksandr Karasik','royal.dragon811@gmail.com','5859783147','12312312311','United States',1,1,'Brooklyn','11234','2023-01-27 22:58:37','2023-02-01 22:38:53',0,0),
(5,'','AMERICAN_EXPRESS','5184464','2023-01-18','BLACK MARKET VR 89% NoRef',1.00,'',NULL,NULL,'345456456','',1,1,'','','2023-01-27 22:58:37','2023-01-27 22:58:37',0,0),
(6,'','AMERICAN_EXPRESS','5184465','2022-12-29','BLACK MARKET VR 89% NoRef',1.00,'',NULL,NULL,'456456456','',1,1,'','','2023-01-27 22:58:37','2023-01-27 22:58:37',0,0),
(7,'','AMERICAN_EXPRESS','5184466','2023-01-11','BLACK MARKET VR 89% NoRef',1.00,'',NULL,NULL,'','',1,1,'','','2023-01-27 22:58:37','2023-01-27 22:58:37',0,0),
(117,'','AMERICAN_EXPRESS','123','2025-02-01','123123',2.00,'Aleksandr Karasik','royal.dragon811@gmail.com','5859783147','435345345345','United States',1,1,'Brooklyn','11234','2023-02-01 22:09:30','2023-02-01 22:40:08',0,0);

/*Table structure for table `card_sell_list` */

DROP TABLE IF EXISTS `card_sell_list`;

CREATE TABLE `card_sell_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `card_id` bigint(20) NOT NULL,
  `cur_price` float(5,2) DEFAULT 0.00,
  `info` blob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `card_sell_list` */

insert  into `card_sell_list`(`id`,`user_id`,`card_id`,`cur_price`,`info`,`created_at`,`updated_at`,`is_del`) values 
(1,2,1,1.00,NULL,'2023-01-29 04:58:38','2023-01-29 04:58:38',0),
(2,12,2,1.50,NULL,'2023-01-30 13:00:52','2023-01-30 13:00:52',0);

/*Table structure for table `country_list` */

DROP TABLE IF EXISTS `country_list`;

CREATE TABLE `country_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `is_use` tinyint(4) DEFAULT 1,
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `country_list` */

insert  into `country_list`(`id`,`name`,`is_use`,`is_del`) values 
(1,'UNITED STATE',1,0),
(2,'UNITED KINGDOM',1,0),
(3,'CANADA',1,0),
(4,'ARGENTINA',1,0);

/*Table structure for table `credit_list` */

DROP TABLE IF EXISTS `credit_list`;

CREATE TABLE `credit_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `coin_type` enum('BTC','LTC','DOGE') DEFAULT NULL,
  `coin_price` double DEFAULT 0,
  `coin_fee` float(5,2) DEFAULT 0.00,
  `wallet_address` varchar(30) DEFAULT NULL,
  `amount` float(8,2) DEFAULT 0.00,
  `status` enum('OPENED','CLOSED','PAID') DEFAULT 'OPENED',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `credit_list` */

insert  into `credit_list`(`id`,`user_id`,`coin_type`,`coin_price`,`coin_fee`,`wallet_address`,`amount`,`status`,`created_at`,`updated_at`,`is_del`) values 
(3,2,'LTC',0,0.00,'sssss',0.00,'OPENED','2023-01-30 07:52:16','2023-01-30 07:52:16',0),
(4,2,'DOGE',0,0.00,'sssss',0.00,'OPENED','2023-01-30 07:52:23','2023-01-30 07:52:23',0),
(5,2,'BTC',0,0.00,'sssss',0.00,'OPENED','2023-01-30 08:14:09','2023-01-30 08:14:09',0),
(6,2,'BTC',0,0.00,'sssss',0.00,'OPENED','2023-01-30 08:14:54','2023-01-30 08:14:54',0),
(7,2,'BTC',0,0.00,'sssss',0.00,'OPENED','2023-01-30 08:15:42','2023-01-30 08:15:42',0),
(8,2,'BTC',0,0.00,'sssss',0.00,'OPENED','2023-01-30 08:18:12','2023-01-30 08:18:12',0),
(9,2,'LTC',100,10.00,'sssss',0.00,'OPENED','2023-01-30 08:19:41','2023-01-30 08:19:41',0),
(10,2,'BTC',0,0.00,'sssss',0.00,'OPENED','2023-01-30 08:20:11','2023-01-30 08:20:11',0),
(11,2,'DOGE',100,10.00,'sssss',0.00,'OPENED','2023-01-30 08:20:46','2023-01-30 08:20:46',0),
(12,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-01-30 09:46:01','2023-01-30 09:46:01',0),
(13,2,'LTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:18:03','2023-02-01 04:18:03',0),
(14,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:19:12','2023-02-01 04:19:12',0),
(15,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:33:41','2023-02-01 04:33:41',0),
(16,2,'LTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:33:48','2023-02-01 04:33:48',0),
(17,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:35:22','2023-02-01 04:35:22',0),
(18,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:36:07','2023-02-01 04:36:07',0),
(19,2,'LTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:37:10','2023-02-01 04:37:10',0),
(20,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:38:46','2023-02-01 04:38:46',0),
(21,2,'LTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:41:22','2023-02-01 04:41:22',0),
(22,2,'DOGE',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:41:45','2023-02-01 04:41:45',0),
(23,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:41:51','2023-02-01 04:41:51',0),
(24,2,'BTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:43:05','2023-02-01 04:43:05',0),
(25,2,'LTC',100,10.00,'sssss',0.00,'OPENED','2023-02-01 04:45:14','2023-02-01 04:45:14',0),
(26,2,'LTC',94.2609,10.00,'LWo9o6EpWfwWBEcLkdn7vYhChNQALB',0.00,'OPENED','2023-02-01 05:41:27','2023-02-01 05:41:27',0),
(27,2,'DOGE',0.0967,10.00,'DQMwyUpB3byL8FcdZgJmt59XdhkZyE',0.00,'OPENED','2023-02-01 05:41:55','2023-02-01 05:41:55',0),
(28,2,'BTC',23161.097,10.00,'36H7rpwHvuznCtamkEQ5cKVp4tHkpT',50.00,'PAID','2023-02-01 05:42:19','2023-01-31 22:44:01',0);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `faq_list` */

DROP TABLE IF EXISTS `faq_list`;

CREATE TABLE `faq_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` blob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer` blob DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `faq_list` */

insert  into `faq_list`(`id`,`question`,`created_at`,`answer`,`updated_at`,`is_del`) values 
(12,'How to create new account','2022-07-07 15:40:47','You can do this','2022-07-14 11:19:03',0),
(14,'What','2022-07-12 15:49:55','The aaa','2022-07-12 16:30:49',0);

/*Table structure for table `message_list` */

DROP TABLE IF EXISTS `message_list`;

CREATE TABLE `message_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) NOT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT '',
  `content` blob DEFAULT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  `read_date` timestamp NULL DEFAULT NULL,
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `message_list` */

insert  into `message_list`(`id`,`sender_id`,`sender_name`,`receiver_id`,`receiver_name`,`subject`,`content`,`send_date`,`is_read`,`read_date`,`is_del`) values 
(10,1,'alks',5,'Aleksanser Asanov','123123','1231313','2022-07-12 14:30:37',0,NULL,0),
(11,1,'alks',6,'asdf','123123','1231313','2022-07-12 14:30:37',0,NULL,0),
(12,1,'alks',9,'alska','123123','1231313','2022-07-12 14:30:37',0,NULL,0),
(14,1,'admin',5,'Aleksanser Asanov','test1','ssss','2022-07-12 14:31:48',0,NULL,0),
(15,1,'admin',6,'asdf','test2','sadf','2022-07-12 14:31:48',0,NULL,0),
(16,1,'admin',9,'alska','test3','cvbfg','2022-07-12 14:31:48',0,NULL,0),
(17,1,'관리자',5,'Aleksanser Asanov','test4','gggg','2022-07-14 11:20:21',0,NULL,0);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2014_10_12_200000_add_two_factor_columns_to_users_table',2);

/*Table structure for table `notice_list` */

DROP TABLE IF EXISTS `notice_list`;

CREATE TABLE `notice_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` blob DEFAULT NULL,
  `is_popup` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `notice_list` */

insert  into `notice_list`(`id`,`user_id`,`subject`,`content`,`is_popup`,`created_at`,`updated_at`,`is_del`) values 
(1,1,'Hello','<div>goodluck 123 <h1>work</h1> and live123</div>',1,'2023-01-25 13:16:02','2022-07-06 23:30:09',0),
(4,NULL,'This is the test info',NULL,0,'2023-02-02 03:26:52','2023-02-02 03:26:52',0);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('alks.asanov@gmail.com','$2y$10$wCnV6WUwNFZah3Qvv5LPyOlZ6F5qBSgWx6ZODklhSZFOG5wcg1pni','2022-07-08 09:35:23');

/*Table structure for table `qna_list` */

DROP TABLE IF EXISTS `qna_list`;

CREATE TABLE `qna_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT '',
  `content` blob DEFAULT NULL,
  `requested_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer` blob DEFAULT NULL,
  `is_answer` tinyint(1) DEFAULT 0,
  `answered_date` timestamp NULL DEFAULT NULL,
  `type` tinyint(4) DEFAULT 0 COMMENT '0:일반 1:계좌문의',
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `qna_list` */

insert  into `qna_list`(`id`,`user_id`,`user_name`,`subject`,`content`,`requested_date`,`answer`,`is_answer`,`answered_date`,`type`,`is_del`) values 
(1,1,'alks','문이','<div>안녕학세요<h1>무슨뜻이에요</h1></div>','2022-07-07 05:56:38','알겠습니다',1,'2022-07-14 11:19:13',0,0),
(12,1,'alks','계좌문의','계좌번호를 문의합니다.','2022-07-07 15:40:47','예 테스트입니다',1,'2022-07-14 11:19:03',1,0),
(14,1,'관리자','안녕하게1','ㅇㅁㅁㅁ','2022-07-12 15:49:55','답변날짜',1,'2022-07-12 16:30:49',0,0);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(200) DEFAULT NULL,
  `apirone_account` varchar(255) DEFAULT NULL,
  `apirone_trans_key` varchar(255) DEFAULT NULL,
  `guide` blob DEFAULT NULL,
  `service_pause_msg` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`app_name`,`apirone_account`,`apirone_trans_key`,`guide`,`service_pause_msg`) values 
(1,NULL,'apr-981e90565fff83a804edb75e4b71a897','Cvl1odzHLRHuQcnhKkfGUkwzKk9oMoCm','<pre class=\"lang-js s-code-block\"><code class=\"hljs language-javascript\">\r\n</code></pre>',NULL);

/*Table structure for table `state_list` */

DROP TABLE IF EXISTS `state_list`;

CREATE TABLE `state_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `country_id` bigint(20) DEFAULT NULL,
  `is_use` tinyint(1) DEFAULT 0,
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `state_list` */

insert  into `state_list`(`id`,`name`,`country_id`,`is_use`,`is_del`) values 
(1,'NEW YORK',1,1,0),
(2,'WASHINGTON',1,1,0),
(3,'LONDON',2,1,0),
(4,'OTAWA',3,1,0);

/*Table structure for table `trading_schedule` */

DROP TABLE IF EXISTS `trading_schedule`;

CREATE TABLE `trading_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `calculate_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_use` tinyint(1) DEFAULT NULL,
  `is_del` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `trading_schedule` */

insert  into `trading_schedule`(`id`,`start_time`,`end_time`,`calculate_time`,`created_at`,`updated_at`,`is_use`,`is_del`) values 
(1,'08:00:00','10:00:00','12:00:00','2022-06-24 22:15:48','2022-06-24 22:15:53',1,0);

/*Table structure for table `user_level` */

DROP TABLE IF EXISTS `user_level`;

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT '',
  `pay_percent` float(6,3) DEFAULT NULL,
  `levelup_amount` bigint(20) DEFAULT NULL,
  `min_limit` bigint(20) DEFAULT NULL,
  `max_limit` bigint(20) DEFAULT NULL,
  `can_buy` tinyint(1) DEFAULT 1 COMMENT '0:구매불가 1:구매가능',
  `image` varchar(255) DEFAULT NULL,
  `is_use` tinyint(1) DEFAULT 1 COMMENT '0:사용불가 1:사용가능',
  `is_del` tinyint(1) DEFAULT 0 COMMENT '0:미삭제 1:삭제',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_level` */

insert  into `user_level`(`id`,`level`,`name`,`pay_percent`,`levelup_amount`,`min_limit`,`max_limit`,`can_buy`,`image`,`is_use`,`is_del`) values 
(1,1,'브론즈',10.005,300,1,150,1,NULL,1,0),
(2,2,'실버',0.000,1500,150,500,1,NULL,1,0),
(3,3,'골드',0.000,9000,1000,3000,1,NULL,1,0),
(4,4,'VIP',0.000,9999999999,5000,10000,1,NULL,1,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `str_id` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT 1,
  `type` enum('ADMIN','MANAGER','USER') DEFAULT 'USER',
  `is_use` tinyint(4) DEFAULT 1 COMMENT '0:미사용 1:사용 2:신규',
  `is_del` tinyint(1) DEFAULT 0 COMMENT '0:미삭제 1:삭제',
  `phone` varchar(12) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_user` varchar(50) DEFAULT NULL,
  `bank_account` varchar(50) DEFAULT NULL,
  `money` bigint(20) NOT NULL DEFAULT 0,
  `deposit_sum` bigint(20) DEFAULT 0,
  `withdraw_sum` bigint(20) DEFAULT 0,
  `buy_sum` bigint(20) DEFAULT 0,
  `profit_sum` bigint(20) DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `referer` varchar(50) DEFAULT '',
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `memo` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`nickname`,`email`,`str_id`,`level`,`type`,`is_use`,`is_del`,`phone`,`bank_id`,`bank_user`,`bank_account`,`money`,`deposit_sum`,`withdraw_sum`,`buy_sum`,`profit_sum`,`email_verified_at`,`password`,`referer`,`two_factor_secret`,`two_factor_recovery_codes`,`remember_token`,`memo`,`created_at`,`updated_at`) values 
(1,'admin','admin','admin@gmail.com','admin',1,'ADMIN',1,0,'01012313453',1,'lu','1231231',0,0,0,0,0,NULL,'$2y$10$WtlLAhQszer7WrzqiZp8B.bbEz3ZDVCeE0DRVXeBi22NpX8zYHUcq','',NULL,NULL,'iYdNuzgkU1S7mO1Q2CXXNxQ8kQr4N8qE2fKEyuW0HR1xriNzC1eSdnYHIRdV',NULL,'2022-06-15 03:04:53','2022-07-09 00:57:51'),
(2,'test','테스터','test@test.com','test',2,'USER',1,0,'101010191343',2,'as','12313123',1495,0,0,0,0,NULL,'$2y$10$WtlLAhQszer7WrzqiZp8B.bbEz3ZDVCeE0DRVXeBi22NpX8zYHUcq',NULL,NULL,NULL,NULL,NULL,'2022-06-22 20:24:17','2023-02-02 11:24:07'),
(5,'Aleksanser Asanov','아리아','adminadsf@adf.com','aleksa',1,'USER',1,1,'+15857707195',17,'ar','1230111',0,0,0,0,0,NULL,'$2y$10$WtlLAhQszer7WrzqiZp8B.bbEz3ZDVCeE0DRVXeBi22NpX8zYHUcq',NULL,NULL,NULL,NULL,NULL,'2022-07-09 16:13:50','2023-01-30 23:22:02'),
(6,'asdf','sdf','baoyu0222@naver.com','asd',1,'USER',1,1,'123123123',14,'qwe','asd123',0,0,0,0,0,NULL,'$2y$10$mLHtxRA44l/0NHXaxn0tguyjJI8sPeOP/UML53xiQ7ZPQ7Pvuvsc6','1aa',NULL,NULL,NULL,NULL,'2022-07-11 04:10:13','2023-01-30 23:17:40'),
(12,'drg',NULL,'ac2f24621938093b@mail.com','ac2f24621938093b',1,'USER',1,0,NULL,NULL,NULL,NULL,120,0,0,0,0,NULL,'$2y$10$BnVli7Ad9d.qV/XQ/VJc3OA0oqkXcmX7AIvCtfiFEnvFfiG9g1apS','',NULL,NULL,NULL,NULL,'2023-01-30 12:59:51','2023-01-30 23:19:25');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
