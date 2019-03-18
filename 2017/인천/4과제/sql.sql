-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.1.29-MariaDB - mariadb.org binary distribution
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

-- 테이블 serverside.alram 구조 내보내기
CREATE TABLE IF NOT EXISTS `alram` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bidx` int(11) NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL,
  `toid` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.alram:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `alram` DISABLE KEYS */;
INSERT INTO `alram` (`idx`, `content`, `date`, `bidx`, `id`, `toid`) VALUES
	(1, 'rlaeodhks', '2018-01-21 15:11:06', 3, 'user05', 'user05'),
	(2, 'fdhsajhdsajkh', '2018-01-21 15:11:09', 3, 'user05', 'user05'),
	(3, 'chltls', '2018-01-21 15:11:29', 3, 'user05', 'user05'),
	(4, 'fsdfdsa', '2018-01-21 15:11:46', 3, 'user05', 'user05'),
	(5, '댓글댓글', '2018-01-21 15:23:48', 2, 'user03', 'user05');
/*!40000 ALTER TABLE `alram` ENABLE KEYS */;

-- 테이블 serverside.board 구조 내보내기
CREATE TABLE IF NOT EXISTS `board` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `skin` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.board:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `board` DISABLE KEYS */;
INSERT INTO `board` (`idx`, `content`, `id`, `date`, `skin`) VALUES
	(2, '이현준 ** ***', 'user05', '2018-01-21 15:01:01', '초록'),
	(3, '*** **', 'user05', '2018-01-21 15:01:38', '노랑'),
	(4, '글글글', 'user03', '2018-01-21 15:20:52', '빨강'),
	(6, 'dsadasfsadsad', 'user07', '2018-01-21 15:38:45', '초록');
/*!40000 ALTER TABLE `board` ENABLE KEYS */;

-- 테이블 serverside.comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `comment` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bidx` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.comment:~4 rows (대략적) 내보내기
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`idx`, `bidx`, `content`, `date`, `id`) VALUES
	(1, 3, 'rlaeodhks', '2018-01-21 15:11:06', 'user05'),
	(2, 3, '다시', '2018-01-21 15:15:56', 'user05'),
	(4, 3, 'fsdfdsa', '2018-01-21 15:11:46', 'user05'),
	(5, 2, '댓글댓글댓글', '2018-01-21 15:24:30', 'user03');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- 테이블 serverside.file 구조 내보내기
CREATE TABLE IF NOT EXISTS `file` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `pidx` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `filename` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.file:~5 rows (대략적) 내보내기
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`idx`, `pidx`, `type`, `filename`) VALUES
	(2, 4, 'comment', '19086664338b3867968ee92193abfb8220180121151146439654.png'),
	(12, 6, 'board', 'd2f05b223197015699439f29602f8a7d20180121153845806840.jpg'),
	(13, 6, 'board', '1bb87d41d15fe27b500a4bfcde01bb0e2018012115384579624.png'),
	(14, 6, 'board', 'cd0b1769d0b2226e94d93907417da80f20180121153845311327.jpg'),
	(15, 6, 'board', 'bdd4501c35a3a52b8a04ca79e173eb6b20180121153845168644.jpg');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- 테이블 serverside.friend 구조 내보내기
CREATE TABLE IF NOT EXISTS `friend` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `formid` text COLLATE utf8_bin NOT NULL,
  `toid` text COLLATE utf8_bin NOT NULL,
  `accept` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.friend:~3 rows (대략적) 내보내기
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
INSERT INTO `friend` (`idx`, `formid`, `toid`, `accept`) VALUES
	(2, 'user05', 'user07', 1),
	(5, 'user03', 'user05', 1),
	(6, 'user03', 'user07', 1);
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;

-- 테이블 serverside.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `number` text COLLATE utf8_bin NOT NULL,
  `skill` text COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.member:~17 rows (대략적) 내보내기
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `number`, `skill`, `image`) VALUES
	(18, 'user01', '1234', '웹디원', '101', '웹디자인', 'user.jpg'),
	(19, 'user02', '1234', '웹디투', '102', '웹디자인', 'user.jpg'),
	(20, 'user03', '1234', '웹디쓰리', '103', '웹디자인', 'user.jpg'),
	(21, 'user04', '1234', '웹디포', '104', '웹디자인', 'user.jpg'),
	(22, 'user05', '123456789', '폴리원', '101', '폴리메카닉스', '60ed01bbffb48c12b68ab4c35d4d7d6b2973.png'),
	(23, 'user06', '1234', '폴리투', '102', '폴리메카닉스', 'user.jpg'),
	(24, 'user07', '1234', '폴리쓰리', '103', '폴리메카닉스', 'user.jpg'),
	(25, 'user08', '1234', '폴리포', '104', '폴리메카닉스', 'user.jpg'),
	(26, 'user09', '1234', '금형원', '101', '금형', 'user.jpg'),
	(27, 'user10', '1234', '금형투', '102', '금형', 'user.jpg'),
	(28, 'user11', '1234', '금형쓰리', '103', '금형', 'user.jpg'),
	(29, 'user12', '1234', '금형포', '104', '금형', 'user.jpg'),
	(30, 'user13', '1234', '선반원', '101', '선반', 'user.jpg'),
	(31, 'user14', '1234', '선반투', '102', '선반', 'user.jpg'),
	(32, 'user15', '1234', '선반쓰리', '103', '선반', 'user.jpg'),
	(33, 'user16', '1234', '선반포', '104', '선반', 'user.jpg'),
	(34, 'admin', '1234', '관리자', '', '', '');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
