/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - bitseller
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bitseller` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bitseller`;

/*Table structure for table `bank_list` */

DROP TABLE IF EXISTS `bank_list`;

CREATE TABLE `bank_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT '',
  `is_use` tinyint(4) DEFAULT 1,
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bank_list` */

insert  into `bank_list`(`id`,`name`,`is_use`,`is_del`) values 
(1,'국민은행',1,0),
(2,'광주은행',1,0),
(3,'경남은행',1,0),
(4,'기업은행',1,0),
(5,'농협은행',1,0),
(6,'대구은행',1,0),
(7,'도이치은행',1,0),
(8,'부산은행',1,0),
(9,'상호저축은행',1,0),
(10,'새마을금고',1,0),
(11,'수협은행',1,0),
(12,'신협은행',1,0),
(13,'신한은행',1,0),
(14,'외환은행',1,0),
(15,'우리은행',1,0),
(16,'우체국',1,0),
(17,'전북은행',1,0),
(18,'제주은행',1,0),
(19,'하나은행',1,0),
(20,'한국씨티은행',1,0),
(21,'HBC은행',1,0),
(22,'SC제일은행',1,0),
(23,'산림조합',1,0),
(24,'카카오뱅크',1,0),
(25,'케이뱅크',1,0),
(26,'SB저축은행',1,0),
(27,'테스트',1,0),
(28,'신협',1,0),
(31,'농협',1,0),
(32,'기업',1,0),
(35,'산업은행',1,0),
(36,'한화투자증권',1,0);

/*Table structure for table `coin_list` */

DROP TABLE IF EXISTS `coin_list`;

CREATE TABLE `coin_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `key` varchar(20) DEFAULT '',
  `kor_name` varchar(30) DEFAULT '',
  `image` varchar(100) DEFAULT '',
  `sell_limit` float(5,2) DEFAULT 0.00,
  `is_use` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `coin_list` */

insert  into `coin_list`(`id`,`name`,`key`,`kor_name`,`image`,`sell_limit`,`is_use`) values 
(1,'STRAX','STRAX','스트라티스','STRAX.png',0.00,1),
(2,'ZRX','ZRX','제로엑스','ZRX.png',0.00,1),
(3,'BTC','BTC','비트코인','BTC.png',0.00,1),
(4,'HIVE','HIVE','하이브','HIVE.png',0.00,1),
(5,'XRP','XRP','리플','XRP.png',0.00,1),
(6,'ETH','ETH','이더리움','ETH.png',0.00,1),
(7,'STORJ','STORJ','스토리지','STORJ.png',0.00,1),
(8,'MATIC','MATIC','폴리곤','MATIC.png',0.00,1),
(9,'WEMIX','WEMIX','위믹스','WEMIX.png',0.00,1),
(10,'WAVES','WAVES','웨이브','WAVES.png',0.00,1),
(11,'DOGE','DOGE','도지코인','DOGE.png',0.00,1),
(12,'SAND','SAND','샌드박스','SAND.png',0.00,1),
(13,'SOL','SOL','솔라나','SOL.png',0.00,1),
(14,'ADA','ADA','에이다','ADA.png',0.00,1),
(15,'STX','STX','스택스','STX.png',0.00,1),
(16,'1INCH','1INCH','1인치네트워크','1INCH.png',1.20,1),
(17,'STMX','STMX','스톰엑스','STMX.png',0.00,1),
(18,'AQT','AQT','알파쿼크','AQT.png',0.00,1),
(19,'POWR','POWR','파워렛저','POWR.png',0.00,1),
(20,'BCH','BCH','비트코인캐시','BCH.png',0.00,1),
(21,'AXS','AXS','엑시인피니티','AXS.png',0.00,1),
(22,'MANA','MANA','디센트럴랜드','MANA.png',0.00,1),
(23,'ZIL','ZIL','질리카','ZIL.png',0.00,1),
(24,'BAT','BAT','베이직어텐션토큰','BAT.png',0.00,1),
(25,'REP','REP','어거','REP.png',0.00,1),
(26,'PUNDIX','PUNDIX','펀디엑스','PUNDIX.png',0.00,1),
(27,'LSK','LSK','리스크','LSK.png',0.00,1),
(28,'LINK','LINK','체인링크','LINK.png',0.00,1),
(29,'HUNT','HUNT','헌트','HUNT.png',0.00,1),
(30,'ETC','ETC','이더리움클래식','ETC.png',0.00,1),
(31,'FLOW','FLOW','플로우','FLOW.png',0.00,1),
(32,'NEAR','NEAR','니어프로토콜','NEAR.png',0.00,1),
(33,'STRK','STRK','스트라이크','STRK.png',0.00,1),
(34,'KAVA','KAVA','카바','KAVA.png',0.00,1),
(35,'STEEM','STEEM','스팀','STEEM.png',0.00,1),
(36,'ELF','ELF','엘프','ELF.png',0.00,1),
(37,'GMT','GMT','스테픈','GMT.png',0.00,1),
(38,'TRX','TRX','트론','TRX.png',0.00,1),
(39,'SBD','SBD','스팀달러','SBD.png',0.00,1),
(40,'PLA','PLA','플레이댑','PLA.png',0.00,1),
(41,'MTL','MTL','메탈','MTL.png',0.00,1),
(42,'SRM','SRM','세럼','SRM.png',0.00,1),
(43,'CHZ','CHZ','칠리즈','CHZ.png',0.00,1),
(44,'THETA','THETA','쎄타토큰','THETA.png',0.00,1),
(45,'NU유의','NU유의','누사이퍼','NU.png',0.00,1),
(46,'KNC','KNC','카이버네트워크','KNC.png',0.00,1),
(47,'BORA','BORA','보라','BORA.png',0.00,1),
(48,'ALGO','ALGO','알고랜드','ALGO.png',0.00,1),
(49,'VET','VET','비체인','VET.png',0.00,1),
(50,'GLM','GLM','골렘','GLM.png',0.00,1),
(51,'WAXP','WAXP','왁스','WAXP.png',0.00,1),
(52,'AVAX','AVAX','아발란체','AVAX.png',0.00,1),
(53,'SXP','SXP','솔라','SXP.png',0.00,1),
(54,'DOT','DOT','폴카닷','DOT.png',0.00,1),
(55,'ATOM','ATOM','코스모스','ATOM.png',0.00,1),
(56,'EOS','EOS','이오스','EOS.png',0.00,1),
(57,'STPT','STPT','에스티피','STPT.png',0.00,1),
(58,'AAVE','AAVE','에이브','AAVE.png',0.00,1),
(59,'CBK','CBK','코박토큰','CBK.png',0.00,1),
(60,'TFUEL','TFUEL','쎄타퓨엘','TFUEL.png',0.00,1),
(61,'HUM','HUM','휴먼스케이프','HUM.png',0.00,1),
(62,'XLM','XLM','스텔라루멘','XLM.png',0.00,1),
(63,'ENJ','ENJ','엔진코인','ENJ.png',0.00,1),
(64,'TON','TON','톤','TON.png',0.00,1),
(65,'NEO','NEO','네오','NEO.png',0.00,1),
(66,'JST','JST','저스트','JST.png',0.00,1),
(67,'XEC','XEC','이캐시','XEC.png',0.00,1),
(68,'MBL유의','MBL유의','무비블록','MBL.png',0.00,1),
(69,'XTZ','XTZ','테조스','XTZ.png',0.00,1),
(70,'CRO','CRO','크로노스','CRO.png',0.00,1),
(71,'OMG','OMG','오미세고','OMG.png',0.00,1),
(72,'T','T','쓰레스홀드','T.png',0.00,1),
(73,'ARK','ARK','아크','ARK.png',0.00,1),
(74,'ICX','ICX','아이콘','ICX.png',0.00,1),
(75,'BTG','BTG','비트코인골드','BTG.png',0.00,1),
(76,'POLY','POLY','폴리매쓰','POLY.png',0.00,1),
(77,'ONG','ONG','온톨로지가스','ONG.png',0.00,1),
(78,'ANKR','ANKR','앵커','ANKR.png',0.00,1),
(79,'QTUM','QTUM','퀀텀','QTUM.png',0.00,1),
(80,'SNT','SNT','스테이터스네트워크토큰','SNT.png',0.00,1),
(81,'HBAR','HBAR','헤데라','HBAR.png',0.00,1),
(82,'GAS','GAS','가스','GAS.png',0.00,1),
(83,'MOC','MOC','모스코인','MOC.png',0.00,1),
(84,'UPP','UPP','센티넬프로토콜','UPP.png',0.00,1),
(85,'META','META','메타디움','META.png',0.00,1),
(86,'SC','SC','시아코인','SC.png',0.00,1),
(87,'MLK','MLK','밀크','MLK.png',0.00,1),
(88,'AERGO','AERGO','아르고','AERGO.png',0.00,1),
(89,'QKC','QKC','쿼크체인','QKC.png',0.00,1),
(90,'TT','TT','썬더코어','TT.png',0.00,1),
(91,'GRS','GRS','그로스톨코인','GRS.png',0.00,1),
(92,'CVC','CVC','시빅','CVC.png',0.00,1),
(93,'LOOM','LOOM','룸네트워크','LOOM.png',0.00,1),
(94,'RFR','RFR','리퍼리움','RFR.png',0.00,1),
(95,'DAWN','DAWN','던프로토콜','DAWN.png',0.00,1),
(96,'IOST','IOST','아이오에스티','IOST.png',0.00,1),
(97,'ONT','ONT','온톨로지','ONT.png',0.00,1),
(98,'BSV','BSV','비트코인에스브이','BSV.png',0.00,1),
(99,'CELO','CELO','셀로','CELO.png',0.00,1),
(100,'DKA','DKA','디카르고','DKA.png',0.00,1),
(101,'MFT','MFT','메인프레임','MFT.png',0.00,1),
(102,'ARDR','ARDR','아더','ARDR.png',0.00,1),
(103,'ORBS','ORBS','오브스','ORBS.png',0.00,1),
(104,'FCT2','FCT2','피르마체인','FCT2.png',0.00,1),
(105,'AHT','AHT','아하토큰','AHT.png',0.00,1),
(106,'IQ','IQ','에브리피디아','IQ.png',0.00,1),
(107,'IOTA','IOTA','아이오타','IOTA.png',0.00,1),
(108,'MED','MED','메디블록','MED.png',0.00,1),
(109,'MVL','MVL','엠블','MVL.png',0.00,1),
(110,'XEM','XEM','넴','XEM.png',0.00,1),
(111,'CRE','CRE','캐리프로토콜','CRE.png',0.00,1),
(112,'SSX','SSX','썸씽','SSX.png',0.00,1),
(113,'BTT','BTT','비트토렌트','BTT.png',0.00,1);

/*Table structure for table `coin_trade_list` */

DROP TABLE IF EXISTS `coin_trade_list`;

CREATE TABLE `coin_trade_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `coin_type` varchar(20) NOT NULL,
  `cur_price` float DEFAULT NULL,
  `cur_price1` float DEFAULT NULL,
  `coin_quantity` float(8,6) DEFAULT NULL,
  `order_amount` bigint(20) NOT NULL,
  `payout_rate` float(5,2) DEFAULT NULL COMMENT '지급율',
  `add_amount` bigint(20) DEFAULT NULL COMMENT '추가금액',
  `payout_amount` bigint(20) DEFAULT NULL COMMENT '배당금액',
  `state` tinyint(1) unsigned zerofill DEFAULT 0 COMMENT '0:구매 1:정산 2: 실격',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_del` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `coin_trade_list` */

insert  into `coin_trade_list`(`id`,`user_id`,`coin_type`,`cur_price`,`cur_price1`,`coin_quantity`,`order_amount`,`payout_rate`,`add_amount`,`payout_amount`,`state`,`created_at`,`updated_at`,`is_del`) values 
(1,1,'STRAX',1480,NULL,33.783783,50000,NULL,NULL,NULL,0,'2022-07-07 11:49:35','2022-06-29 23:22:56',0),
(2,1,'TON',2585,NULL,19.342360,50000,NULL,NULL,NULL,0,'2022-07-07 11:49:36','2022-07-02 10:09:44',0),
(3,1,'TON',2590,NULL,19.305019,50000,NULL,NULL,NULL,0,'2022-07-07 11:49:36','2022-07-02 10:10:05',0),
(4,1,'ETH',1437000,NULL,0.034795,50000,10.01,5002,55002,0,'2022-07-14 06:12:25','2022-07-14 06:12:25',0);

/*Table structure for table `exchange_list` */

DROP TABLE IF EXISTS `exchange_list`;

CREATE TABLE `exchange_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `requested_date` datetime DEFAULT current_timestamp(),
  `amount` double DEFAULT 0,
  `accepted_date` datetime DEFAULT NULL,
  `type` tinyint(4) DEFAULT 0 COMMENT '0:충전 1:환전',
  `state` tinyint(4) DEFAULT 0 COMMENT '0:대기 1:승인 2:부결',
  `is_del` tinyint(4) DEFAULT 0 COMMENT '0:정상 1:삭제',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `exchange_list` */

insert  into `exchange_list`(`id`,`user_id`,`requested_date`,`amount`,`accepted_date`,`type`,`state`,`is_del`) values 
(1,1,'2022-07-06 02:15:36',50000,NULL,0,0,0),
(2,1,'2022-07-06 02:15:53',50000,NULL,0,0,0),
(3,1,'2022-07-06 02:43:35',100000,NULL,0,0,0),
(4,1,'2022-07-06 02:44:10',150000,NULL,0,0,0),
(5,3,'2022-07-06 02:44:23',200000,NULL,0,0,0),
(6,1,'2022-07-13 05:08:22',0,NULL,0,0,0),
(7,1,'2022-07-13 05:09:08',50000,NULL,0,0,0),
(8,1,'2022-07-13 05:14:05',50000,NULL,0,0,0),
(9,1,'2022-07-13 09:03:17',50000,'2022-07-13 13:18:04',1,1,0),
(10,1,'2022-07-13 20:07:34',50000,'2022-07-13 20:08:29',1,1,0),
(11,1,'2022-07-13 20:10:49',600000,'2022-07-13 21:28:27',0,1,0),
(12,1,'2022-07-14 06:41:00',1050000,NULL,0,0,0);

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
(14,1,'관리자',5,'Aleksanser Asanov','전체공지','전체공지입니다.','2022-07-12 14:31:48',0,NULL,0),
(15,1,'관리자',6,'asdf','전체공지','전체공지입니다.','2022-07-12 14:31:48',0,NULL,0),
(16,1,'관리자',9,'alska','전체공지','전체공지입니다.','2022-07-12 14:31:48',0,NULL,0),
(17,1,'관리자',5,'Aleksanser Asanov','쪽지','쪽지입니다','2022-07-14 11:20:21',0,NULL,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `notice_list` */

insert  into `notice_list`(`id`,`user_id`,`subject`,`content`,`is_popup`,`created_at`,`updated_at`,`is_del`) values 
(1,1,'안녕하세요','<div>goodluck 123 <h1>work</h1> and live123</div>',1,'2022-07-07 20:55:03','2022-07-06 23:30:09',0);

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
  `bank_info` varchar(255) DEFAULT NULL,
  `deposit_from` time DEFAULT NULL,
  `deposit_to` time DEFAULT NULL,
  `withdraw_from` time DEFAULT NULL,
  `withdraw_to` time DEFAULT NULL,
  `guide` blob DEFAULT NULL,
  `service_pause_msg` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`app_name`,`bank_info`,`deposit_from`,`deposit_to`,`withdraw_from`,`withdraw_to`,`guide`,`service_pause_msg`) values 
(1,NULL,'신한은행 정의영 01012010110','08:00:00','09:00:09','12:00:00','20:00:00','<pre class=\"lang-js s-code-block\"><code class=\"hljs language-javascript\">    <span class=\"hljs-comment\">// Single Date with time</span>\r\n    $(<span class=\"hljs-string\">\'.single-date-time\'</span>).<span class=\"hljs-title function_\">daterangepicker</span>({\r\n        <span class=\"hljs-attr\">singleDatePicker</span>:<span class=\"hljs-literal\">true</span>,\r\n        <span class=\"hljs-attr\">timePicker</span>: <span class=\"hljs-literal\">true</span>,\r\n        <span class=\"hljs-attr\">applyClass</span>: <span class=\"hljs-string\">\'bg-slate-600\'</span>,\r\n        <span class=\"hljs-attr\">cancelClass</span>: <span class=\"hljs-string\">\'btn-light\'</span>,\r\n        <span class=\"hljs-attr\">locale</span>: {\r\n            <span class=\"hljs-attr\">format</span>: <span class=\"hljs-string\">\'MM/DD/YYYY h:mm a\'</span>\r\n        }\r\n    });\r\n</code></pre>',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`nickname`,`email`,`str_id`,`level`,`type`,`is_use`,`is_del`,`phone`,`bank_id`,`bank_user`,`bank_account`,`money`,`deposit_sum`,`withdraw_sum`,`buy_sum`,`profit_sum`,`email_verified_at`,`password`,`referer`,`two_factor_secret`,`two_factor_recovery_codes`,`remember_token`,`memo`,`created_at`,`updated_at`) values 
(1,'관리자','알렉스','alks.asanov@gmail.com','alks',1,'ADMIN',1,0,'01012313453',1,'루지군','1231231',0,0,0,0,0,NULL,'$2y$10$WtlLAhQszer7WrzqiZp8B.bbEz3ZDVCeE0DRVXeBi22NpX8zYHUcq','',NULL,NULL,'xyw8MTsAc5OcfbC7guiUMI50NenSMn8xEQqgcCjoxeN1JlUxK99LLc1KSyUY',NULL,'2022-06-15 03:04:53','2022-07-09 00:57:51'),
(2,'test','테스터','test@test.com','test',2,'USER',1,0,'101010191343',2,'아나링크','12313123',0,0,0,0,0,NULL,'$2y$10$sWa5.3ZwX8VEqD0Wl8.NnuL78EFHFl9B/WYaJifCA/FrgpecWwNSO',NULL,NULL,NULL,NULL,NULL,'2022-06-22 20:24:17','2022-07-11 15:36:25'),
(3,'아리아',NULL,'admin@admin.com',NULL,1,'ADMIN',1,0,NULL,NULL,NULL,NULL,0,0,0,0,0,NULL,'$2y$10$NhaNgu.Myz3Fez9rNWKPoujNRt0lkdni//iGkEDf.YIyvx4zI.zYO','',NULL,NULL,NULL,NULL,'2022-07-09 15:50:13','2022-07-09 15:50:13'),
(4,'Aleksanser Asanov',NULL,'admin@sdaf.com',NULL,1,'ADMIN',1,0,NULL,NULL,NULL,NULL,0,0,0,0,0,NULL,'$2y$10$skrwEufxeE4oplCHJARhGuJk4C46DOgPI7vCsxDD1Xd282ugXekFe','',NULL,NULL,NULL,NULL,'2022-07-09 15:53:06','2022-07-09 15:53:06'),
(5,'Aleksanser Asanov','아리아','adminadsf@adf.com','aleks',1,'USER',1,0,'+15857707195',17,'아리아','1230111',0,0,0,0,0,NULL,'$2y$10$IxO6Kiv3Sb/CkOuEkQ/lFuHm88UWZblY4NADgkfdK6A/nl150OG4a',NULL,NULL,NULL,NULL,NULL,'2022-07-09 16:13:50','2022-07-11 14:11:19'),
(6,'asdf','sdf','baoyu0222@naver.com','asd',1,'USER',1,0,'123123123',14,'qwe','asd123',0,0,0,0,0,NULL,'$2y$10$mLHtxRA44l/0NHXaxn0tguyjJI8sPeOP/UML53xiQ7ZPQ7Pvuvsc6','1aa',NULL,NULL,NULL,NULL,'2022-07-11 04:10:13','2022-07-11 14:12:27'),
(9,'alska','asdf','admin@min.com','alks',2,'USER',1,0,'+15857707195',2,'아리아','1230111',10000,0,0,0,0,NULL,'$2y$10$8TcdoniL5fgLTEfrJD5xWu46YfJEA0/uIgqlWKX4Gxy.d4iChOt7S',NULL,NULL,NULL,NULL,NULL,'2022-07-11 15:41:57','2022-07-11 15:41:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
