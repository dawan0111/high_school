-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.1.32-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win32
-- HeidiSQL 버전:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- serverside 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `serverside` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `serverside`;

-- 테이블 serverside.map 구조 내보내기
CREATE TABLE IF NOT EXISTS `map` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `start` text COLLATE utf8_bin NOT NULL,
  `end` text COLLATE utf8_bin NOT NULL,
  `spend` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.map:~100 rows (대략적) 내보내기
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
INSERT INTO `map` (`idx`, `start`, `end`, `spend`) VALUES
	(1, '서울', '서울', 0),
	(2, '서울', '경기', 20),
	(3, '서울', '강원', 100),
	(4, '서울', '충북', 110),
	(5, '서울', '충남', 120),
	(6, '서울', '대전', 200),
	(7, '서울', '경남', 250),
	(8, '서울', '경북', 310),
	(9, '서울', '전남', 240),
	(10, '서울', '전북', 220),
	(11, '경기', '서울', 25),
	(12, '경기', '경기', 0),
	(13, '경기', '강원', 110),
	(14, '경기', '충북', 130),
	(15, '경기', '충남', 140),
	(16, '경기', '대전', 220),
	(17, '경기', '경남', 270),
	(18, '경기', '경북', 330),
	(19, '경기', '전남', 260),
	(20, '경기', '전북', 240),
	(21, '강원', '서울', 110),
	(22, '강원', '경기', 130),
	(23, '강원', '강원', 0),
	(24, '강원', '충북', 150),
	(25, '강원', '충남', 160),
	(26, '강원', '대전', 230),
	(27, '강원', '경남', 290),
	(28, '강원', '경북', 300),
	(29, '강원', '전남', 250),
	(30, '강원', '전북', 270),
	(31, '충북', '서울', 120),
	(32, '충북', '경기', 140),
	(33, '충북', '강원', 130),
	(34, '충북', '충북', 0),
	(35, '충북', '충남', 50),
	(36, '충북', '대전', 40),
	(37, '충북', '경남', 110),
	(38, '충북', '경북', 60),
	(39, '충북', '전남', 120),
	(40, '충북', '전북', 100),
	(41, '충남', '서울', 130),
	(42, '충남', '경기', 150),
	(43, '충남', '강원', 170),
	(44, '충남', '충북', 60),
	(45, '충남', '충남', 0),
	(46, '충남', '대전', 70),
	(47, '충남', '경남', 140),
	(48, '충남', '경북', 90),
	(49, '충남', '전남', 130),
	(50, '충남', '전북', 110),
	(51, '대전', '서울', 210),
	(52, '대전', '경기', 230),
	(53, '대전', '강원', 240),
	(54, '대전', '충북', 50),
	(55, '대전', '충남', 80),
	(56, '대전', '대전', 0),
	(57, '대전', '경남', 100),
	(58, '대전', '경북', 70),
	(59, '대전', '전남', 110),
	(60, '대전', '전북', 90),
	(61, '경남', '서울', 240),
	(62, '경남', '경기', 280),
	(63, '경남', '강원', 270),
	(64, '경남', '충북', 120),
	(65, '경남', '충남', 150),
	(66, '경남', '대전', 110),
	(67, '경남', '경남', 0),
	(68, '경남', '경북', 50),
	(69, '경남', '전남', 80),
	(70, '경남', '전북', 100),
	(71, '경북', '서울', 300),
	(72, '경북', '경기', 320),
	(73, '경북', '강원', 310),
	(74, '경북', '충북', 70),
	(75, '경북', '충남', 80),
	(76, '경북', '대전', 60),
	(77, '경북', '경남', 70),
	(78, '경북', '경북', 0),
	(79, '경북', '전남', 90),
	(80, '경북', '전북', 110),
	(81, '전남', '서울', 250),
	(82, '전남', '경기', 270),
	(83, '전남', '강원', 260),
	(84, '전남', '충북', 130),
	(85, '전남', '충남', 140),
	(86, '전남', '대전', 120),
	(87, '전남', '경남', 90),
	(88, '전남', '경북', 100),
	(89, '전남', '전남', 0),
	(90, '전남', '전북', 60),
	(91, '전북', '서울', 210),
	(92, '전북', '경기', 250),
	(93, '전북', '강원', 260),
	(94, '전북', '충북', 110),
	(95, '전북', '충남', 100),
	(96, '전북', '대전', 90),
	(97, '전북', '경남', 110),
	(98, '전북', '경북', 100),
	(99, '전북', '전남', 50),
	(100, '전북', '전북', 0);
/*!40000 ALTER TABLE `map` ENABLE KEYS */;

-- 테이블 serverside.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `weight` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.member:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `phone`, `weight`, `type`) VALUES
	(2, 'test@test.com', 'asdf1234', '회사', '010-1234-5678', 0, '고객사'),
	(3, 'test2@test.com', 'asdf1234', '부릉', '010-1234-5678', 24, '지입차량주'),
	(4, 'admin', '1234', '관리자', '', 0, '관리자'),
	(5, 'test3@test.com', 'asdf1234', '호에에사', '01-123-4267', 0, '고객사'),
	(6, 'asd@asd.asd', 'asdqwe123', 'asd', '123-123-1234', 0, '고객사');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- 테이블 serverside.product 구조 내보내기
CREATE TABLE IF NOT EXISTS `product` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text COLLATE utf8_bin NOT NULL,
  `user_name` text COLLATE utf8_bin NOT NULL,
  `user_phone` text COLLATE utf8_bin NOT NULL,
  `weight` int(11) NOT NULL,
  `location` text COLLATE utf8_bin NOT NULL,
  `order_date` date NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `truck` int(11) NOT NULL,
  `state` text COLLATE utf8_bin NOT NULL,
  `code` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.product:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- 테이블 serverside.truck 구조 내보내기
CREATE TABLE IF NOT EXISTS `truck` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text COLLATE utf8_bin NOT NULL,
  `product_idx` text COLLATE utf8_bin NOT NULL,
  `order_date` date NOT NULL,
  `weight` int(11) NOT NULL,
  `spend` int(11) NOT NULL,
  `location` text COLLATE utf8_bin NOT NULL,
  `now_location` text COLLATE utf8_bin NOT NULL,
  `state` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.truck:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `truck` DISABLE KEYS */;
/*!40000 ALTER TABLE `truck` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
