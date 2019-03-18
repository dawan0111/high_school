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


-- homepage 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `homepage` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `homepage`;

-- 테이블 homepage.board 구조 내보내기
CREATE TABLE IF NOT EXISTS `board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `boardname` text NOT NULL,
  `main` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- 테이블 데이터 homepage.board:~6 rows (대략적) 내보내기
/*!40000 ALTER TABLE `board` DISABLE KEYS */;
INSERT INTO `board` (`id`, `type`, `boardname`, `main`) VALUES
	(46, 'normal', '이반게시판', 0),
	(47, 'photo', '사진게시판', 0),
	(48, 'photo', '오진게시판', 1),
	(58, 'normal', '삼반게시판', 0),
	(59, 'photo', '육진게시판', 0);
/*!40000 ALTER TABLE `board` ENABLE KEYS */;

-- 테이블 homepage.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 테이블 데이터 homepage.member:~2 rows (대략적) 내보내기
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`idx`, `id`, `password`, `name`) VALUES
	(1, 'test@test.com', '@rlaeodhks0', '김대완'),
	(2, 'admin@admin.com', '1234', '관리자\r\n');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- 테이블 homepage.page 구조 내보내기
CREATE TABLE IF NOT EXISTS `page` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `siteName` text NOT NULL,
  `mysqlPass` text NOT NULL,
  `dbName` text NOT NULL,
  `dbPass` text NOT NULL,
  `admin_email` text NOT NULL,
  `adminPass` text NOT NULL,
  `slideImage` text NOT NULL,
  `normal_board` text NOT NULL,
  `photo_board` text NOT NULL,
  `description` text NOT NULL,
  `theme` text NOT NULL,
  `tag` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 테이블 데이터 homepage.page:~1 rows (대략적) 내보내기
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` (`idx`, `siteName`, `mysqlPass`, `dbName`, `dbPass`, `admin_email`, `adminPass`, `slideImage`, `normal_board`, `photo_board`, `description`, `theme`, `tag`) VALUES
	(2, '한라봉', '1234', 'dbid', '1234', 'admin@admin.com', '1234', '69f31a5ad47f59ce0fbc714c6f8849b5.png, 6b6ac7fb5725b6d3f30896e30fda28c8.png, d1e330360fa9950c136216a47a8b8876.png', '45, 46, 58', '47, 48, 59', 'ㅎㅇ방가방가방가', '2', 'A, Img');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;

-- 테이블 homepage.post 구조 내보내기
CREATE TABLE IF NOT EXISTS `post` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` text NOT NULL,
  `writer` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `boardidx` int(11) NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- 테이블 데이터 homepage.post:~23 rows (대략적) 내보내기
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`idx`, `id`, `writer`, `title`, `content`, `boardidx`, `image`, `date`) VALUES
	(23, 'test@test.com', '김대완', '제목', '글본문', 47, '2017080113435712463.png', '2017-08-01 13:43:57'),
	(24, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(25, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(26, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(27, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(28, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(29, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(30, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(31, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(32, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(33, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(34, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(35, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(36, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(37, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(38, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(39, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(40, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.', 45, '', '2017-08-01 15:40:59'),
	(41, 'test@test.com', '김대완', '글제목입니다.', '글본문입ㄴ디ㅏ.ㅋㅋㅋ', 45, '', '2017-08-01 15:40:59'),
	(42, 'test@test.com', '김대완', '제목입니다.', '본온문입니다.', 48, '201708011619341886.png', '2017-08-01 16:19:34'),
	(43, 'test@test.com', '김대완', '20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상20자이상', 'ㅇㄹㄴㅁㅇㄴㅁㅇㄴㅁㅇㄴ', 48, '2017080116252121573.png', '2017-08-01 16:25:21'),
	(44, 'admin@admin.com', '관리자', '나는관리자다 부럽냐', '아니요', 45, '', '2017-08-03 08:47:41'),
	(45, 'admin@admin.com', '관리자', 'dsdsd', '<b data-idx=\'test\'>굻어</b><i>기울어</i><img src=\'https://s.pstatic.net/static/www/mobile/edit/2017/0801/cropImg_339x222_102063137714513782.jpeg\'><a href=\'http://www.naver.com\'>이동</a>', 46, '', '2017-08-02 10:35:29'),
	(47, 'admin@admin.com', '관리자', '나는선비ㅎㅇ', '<a href=\'http://www.daum.net\'>이동</a>', 46, '', '2017-08-02 10:39:22');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
