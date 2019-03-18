-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.1.21-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win32
-- HeidiSQL 버전:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- serverside 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `serverside` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `serverside`;

-- 테이블 serverside.house 구조 내보내기
CREATE TABLE IF NOT EXISTS `house` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `phone` text NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- 테이블 데이터 serverside.house:~2 rows (대략적) 내보내기
/*!40000 ALTER TABLE `house` DISABLE KEYS */;
INSERT INTO `house` (`idx`, `name`, `price`, `phone`, `image`) VALUES
	(5, '좀더 좋은 팬션', 5000000, '010-5678-7891', '20171120190020.jpg');
/*!40000 ALTER TABLE `house` ENABLE KEYS */;

-- 테이블 serverside.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `pw` text NOT NULL,
  `phone` text NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 테이블 데이터 serverside.member:~2 rows (대략적) 내보내기
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`idx`, `email`, `pw`, `phone`, `name`) VALUES
	(1, 'test@test.com', '1234', '010-5564-4661', 'test'),
	(2, 'admin', '1234', '010-0000-0000', '관리자');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- 테이블 serverside.res 구조 내보내기
CREATE TABLE IF NOT EXISTS `res` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `housename` text NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `price` int(11) NOT NULL,
  `resname` text NOT NULL,
  `phone` text NOT NULL,
  `id` text NOT NULL,
  `money` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 테이블 데이터 serverside.res:~3 rows (대략적) 내보내기
/*!40000 ALTER TABLE `res` DISABLE KEYS */;
INSERT INTO `res` (`idx`, `housename`, `startdate`, `enddate`, `price`, `resname`, `phone`, `id`, `money`) VALUES
	(1, '좋은펜션', '2017-11-15', '2017-11-16', 50000, '관리자', '010-0000-0000', 'admin', '예약취소'),
	(2, '좋은펜션', '2017-11-27', '2017-12-01', 50000, '관리자', '010-0000-0000', 'admin', '환불대기'),
	(3, '좀더 좋은 팬션', '2017-11-15', '2017-11-22', 5000000, '관리자', '010-0000-0000', 'admin', '입금확인');
/*!40000 ALTER TABLE `res` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
