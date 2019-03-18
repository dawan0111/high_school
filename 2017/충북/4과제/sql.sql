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


-- webd13 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `webd13` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `webd13`;

-- 테이블 webd13.booth 구조 내보내기
CREATE TABLE IF NOT EXISTS `booth` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `booth` varchar(200) NOT NULL,
  `id` varchar(200) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- 테이블 데이터 webd13.booth:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `booth` DISABLE KEYS */;
INSERT INTO `booth` (`idx`, `booth`, `id`, `startdate`, `enddate`) VALUES
	(5, 'N04', '강슥흔', '2017-08-12 00:00:00', '2017-08-13 00:00:00'),
	(7, 'N04', '강슥흔', '2017-08-21 00:00:00', '2017-08-25 00:00:00'),
	(8, 'C13', '김대완', '2017-08-14 00:00:00', '2017-08-18 00:00:00'),
	(9, 'F17', '강슥흔', '2017-08-13 00:00:00', '2017-08-16 00:00:00'),
	(10, 'I01', '강슥흔', '2017-08-20 00:00:00', '2022-02-10 00:00:00');
/*!40000 ALTER TABLE `booth` ENABLE KEYS */;

-- 테이블 webd13.fair 구조 내보내기
CREATE TABLE IF NOT EXISTS `fair` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `max_people` int(11) NOT NULL,
  `intro` text NOT NULL,
  `boothidx` int(11) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- 테이블 데이터 webd13.fair:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `fair` DISABLE KEYS */;
INSERT INTO `fair` (`idx`, `name`, `startdate`, `enddate`, `max_people`, `intro`, `boothidx`, `image`) VALUES
	(1, '박람회', '2017-08-12 00:00:00', '2017-08-13 00:00:00', 20, '안녕하세요 이제 진지하게 설명좀 하겠습니다 이 박람회는 무엇이며 무엇인지 아니면 무엇을 하는지 알려드릴수 있는 중요한 기회가 될것이니 꼭 참여해 주시기 바랍니다.', 5, '201708110342071647.jpg'),
	(2, '박람횧', '2017-08-14 00:00:00', '2017-08-18 00:00:00', 50, '선착순50명 와 씹오진다', 8, '2017081109481925849.jpg'),
	(3, '빡람회', '2017-08-14 00:00:00', '2017-08-15 00:00:00', 50, '저는 박람회입니다.', 9, '201708111002346795.jpg'),
	(4, '나는강슥흔', '2017-08-23 00:00:00', '2021-05-12 00:00:00', 5, '선착순 5명 와 오진닫ㄷㄷ', 10, '2017081111160119103.png');
/*!40000 ALTER TABLE `fair` ENABLE KEYS */;

-- 테이블 webd13.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(200) NOT NULL,
  `pw` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 테이블 데이터 webd13.member:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `type`) VALUES
	(1, 'tjrgus0011', '@k12345', '강슥흔', '기업회원'),
	(5, 'user01', '@k12345', '유저', '일반회원'),
	(6, 'admin', '1234', '관리자', '관리자'),
	(7, 'dawan0111', '@k12345', '김대완', '기업회원');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- 테이블 webd13.userres 구조 내보내기
CREATE TABLE IF NOT EXISTS `userres` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `fairidx` int(11) NOT NULL,
  `people` int(11) NOT NULL,
  `id` text NOT NULL,
  `day` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- 테이블 데이터 webd13.userres:~14 rows (대략적) 내보내기
/*!40000 ALTER TABLE `userres` DISABLE KEYS */;
INSERT INTO `userres` (`idx`, `fairidx`, `people`, `id`, `day`) VALUES
	(5, 2, 10, 'user01', '2017-08-18 00:00:00'),
	(7, 1, 3, 'user01', '2017-08-12 00:00:00'),
	(8, 1, 3, 'user01', '2017-08-12 00:00:00'),
	(9, 1, 3, 'user01', '2017-08-12 00:00:00'),
	(10, 1, 3, 'user01', '2017-08-12 00:00:00'),
	(11, 1, 3, 'user01', '2017-08-12 00:00:00'),
	(12, 1, 1, 'user01', '2017-08-12 00:00:00'),
	(13, 1, 1, 'user01', '2017-08-12 00:00:00'),
	(14, 1, 3, 'user01', '2017-08-12 00:00:00'),
	(15, 1, 1, 'user01', '2017-08-13 00:00:00'),
	(16, 1, 1, 'user01', '2017-08-13 00:00:00'),
	(17, 3, 40, 'user01', '2017-08-15 00:00:00'),
	(18, 3, 20, 'user01', '2017-08-14 00:00:00');
/*!40000 ALTER TABLE `userres` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
