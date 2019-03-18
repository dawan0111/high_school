-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.1.34-MariaDB - mariadb.org binary distribution
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

-- 테이블 serverside.file 구조 내보내기
CREATE TABLE IF NOT EXISTS `file` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text COLLATE utf8_bin NOT NULL,
  `realname` text COLLATE utf8_bin NOT NULL,
  `midx` int(11) NOT NULL,
  `filesize` int(11) NOT NULL,
  `sidx` int(11) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `midx` (`midx`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.file:~12 rows (대략적) 내보내기
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`idx`, `filename`, `realname`, `midx`, `filesize`, `sidx`) VALUES
	(16, 'Lee-Hak-The-Gr8est-Korean-Buffets-Under-P500-2.jpg', '20180727213039_464.jpg', 1, 78, 0),
	(17, 'o-GETTYIMAGESBANK-570.jpg', '20180727213039_536.jpg', 1, 105, 0),
	(18, '앤틱-한식접시-3.jpg', '20180727213039_823.jpg', 1, 368, 0),
	(19, '20140706_181731-817x459.jpg', '20180728083516_976.jpg', 22, 72, 0),
	(20, 'Lee-Hak-The-Gr8est-Korean-Buffets-Under-P500-2.jpg', '20180727213039_464.jpg', 22, 78, 0),
	(21, 'o-GETTYIMAGESBANK-570.jpg', '20180727213039_536.jpg', 22, 105, 0),
	(22, '앤틱-한식접시-3.jpg', '20180727213039_823.jpg', 22, 368, 0),
	(23, 'Korea-Food-Main_opt.jpg', '20180728083557_373.jpg', 23, 118, 0),
	(24, 'fontawesome.js', '20180728112051_846.js', 28, 893, 0),
	(25, 'jquery-3.3.1.min.js', '20180728112134_906.js', 30, 85, 0),
	(26, 'fontawesome.js', '20180728112051_846.js', 0, 893, 0),
	(27, 'ac95b6b6456e39656a807ea1e547c603.gif', '20180728112401_958.gif', 31, 408, 0);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- 테이블 serverside.mail 구조 내보내기
CREATE TABLE IF NOT EXISTS `mail` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `target` text COLLATE utf8_bin NOT NULL,
  `s_read` int(11) NOT NULL,
  `t_read` int(11) NOT NULL,
  `s_del` int(11) NOT NULL,
  `t_del` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `t_spam` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_id` text COLLATE utf8_bin NOT NULL,
  `send_name` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.mail:~36 rows (대략적) 내보내기
/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
INSERT INTO `mail` (`idx`, `title`, `content`, `target`, `s_read`, `t_read`, `s_del`, `t_del`, `type`, `t_spam`, `date`, `send_id`, `send_name`) VALUES
	(1, 'title', 'dfsafsdasadfdsaffdsadsggdfsdgsfsdfgfsdg', 'test2@test.com', 1, 1, 0, 0, 'send', 0, '2018-07-27 21:30:39', 'test@test.com', '이름'),
	(2, 'dsdadsadsadsada', 'asdasdadsdsadfvxxzccvcxvcxvcx', 'test2@test.com', 1, 1, 0, 0, 'send', 1, '2018-07-27 21:31:06', 'test@test.com', '이름'),
	(3, 'title', 'saddsasdaasdds', 'test2@test.com', 0, 0, 0, 0, 'tmp', 0, '2018-07-28 07:30:43', 'test@test.com', '이름'),
	(4, 'sdadasdsasda', 'dsasadsdasdadsasdasdasdasdasaddsasadasdasdasdasdadsdassdasdaasdsdasd', '', 0, 0, 0, 0, 'my', 0, '2018-07-28 07:38:47', 'test@test.com', '이름'),
	(5, 'sdasdaasd', 'sdafgcxvcxvcxvcxsfsdafa', '', 0, 0, 0, 0, 'my', 0, '2018-07-28 07:39:01', 'test@test.com', '이름'),
	(6, 'sdasdaasd', 'sdafgcxvcxvcxvcxsfsdafa', '', 0, 0, 0, 0, 'my', 0, '2018-07-28 07:40:42', 'test@test.com', '이름'),
	(7, 'sdasdaasd', 'sdafgcxvcxvcxvcxsfsdafa', '', 0, 0, 0, 0, 'my', 0, '2018-07-28 07:41:08', 'test@test.com', '이름'),
	(8, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test@test.com', 0, 1, 0, 0, 'send', 0, '2018-07-28 07:59:35', 'test2@test.com', '이름2'),
	(9, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 1, 1, 0, 0, 'send', 0, '2018-07-28 08:30:34', 'test@test.com', '이름'),
	(10, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 0, 'send', 0, '2018-07-28 08:30:59', 'test@test.com', '이름'),
	(11, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 0, 'send', 1, '2018-07-28 08:31:05', 'test@test.com', '이름'),
	(12, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 1, 'send', 0, '2018-07-28 08:31:11', 'test@test.com', '이름'),
	(13, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 1, 'send', 0, '2018-07-28 08:31:20', 'test@test.com', '이름'),
	(14, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 2, 'send', 0, '2018-07-28 08:31:23', 'test@test.com', '이름'),
	(15, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 2, 'send', 0, '2018-07-28 08:32:02', 'test@test.com', '이름'),
	(16, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 0, 'send', 1, '2018-07-28 08:32:05', 'test@test.com', '이름'),
	(17, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 0, 'send', 1, '2018-07-28 08:32:08', 'test@test.com', '이름'),
	(18, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 0, 0, 0, 'send', 0, '2018-07-28 08:32:10', 'test@test.com', '이름'),
	(19, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 0, 0, 0, 'send', 0, '2018-07-28 08:32:10', 'test@test.com', '이름'),
	(20, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 1, 0, 0, 'send', 1, '2018-07-28 08:32:33', 'test@test.com', '이름'),
	(21, '제목', 'ㅇㄴㅁㄴㅇㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇㄴㅁㅇ', 'test3@test.com', 0, 0, 0, 0, 'send', 0, '2018-07-28 08:32:41', 'test@test.com', '이름'),
	(22, 'title', 'dfsafsdasadfdsaffdsadsggdfsdgsfsdfgfsdg', 'test3@test.com', 0, 1, 0, 0, 'send', 0, '2018-07-28 08:35:16', 'test2@test.com', '이름2'),
	(23, 'dsasadsad', 'dsadsadsafsdafdsafgdsgfdsgfdhfgdhgfhgfhgfhgfhgfhgfhgfhgfhfghgfhgf', 'test2@test.com', 1, 0, 2, 0, 'send', 0, '2018-07-28 08:35:57', 'test3@test.com', '이름2'),
	(24, 'ㅇㅇ확인', '00확인', 'test2@test.com', 1, 0, 0, 0, 'send', 0, '2018-07-28 08:38:48', 'test3@test.com', '이름2'),
	(25, 'ㄹㄹㅇㄴㅇㄴㄹㄹㅇㄴㄹㅇㄴㄹㅇㄴ', 'ㄹㄷㅇㅈㄹㄷㅇㅈㅇㄴㄹㄴㅇㄹㅇㄴㄹㅇㄹㄴ', '', 1, 0, 0, 0, 'tmp', 0, '2018-07-28 08:46:06', 'test3@test.com', '이름2'),
	(26, 'ㄴㅇㅁㄴㅁㅇㄴㅇㅁㄴㅁㅇ', 'ㅇㄹㄴㅇㅁㅁㄴㅇㅁㄴㅇㄴㅁㅇ', '', 1, 0, 0, 0, 'my', 0, '2018-07-28 08:46:09', 'test3@test.com', '이름2'),
	(27, 'title', '<img src="http://google.com"><a href="http://google.com">안hrefa녕 src</a>', '', 1, 0, 0, 0, 'my', 0, '2018-07-28 09:16:35', 'test3@test.com', '이름2'),
	(28, '철수야 내일 안산공고 와야해', '폰트어썸!', 'user2', 1, 1, 1, 1, 'send', 0, '2018-07-28 11:20:51', 'user1', 'user1'),
	(29, '영희야 내일 안산공고 와야해', '어썸!', 'user3', 0, 0, 0, 0, 'tmp', 0, '2018-07-28 11:21:07', 'user1', 'user1'),
	(30, '나에게 씁니다', '너무 써!', '', 1, 0, 0, 0, 'my', 0, '2018-07-28 11:21:34', 'user1', 'user1'),
	(31, '★지금 시작시 점핑 디G몬 증정★', 'ㄷㅈㅁ마스터즈 바로가기 -- >> <a href="//google.com">바로가기</a>\r\n<img src="https://www.w3schools.com/images/colorpicker.gif" />', 'user2', 1, 1, 1, 1, 'send', 1, '2018-07-28 11:24:01', 'user1', 'user1'),
	(32, '너에게 답장을 보낸다', '으아아', 'user1', 1, 0, 0, 0, 'tmp', 0, '2018-07-28 11:25:29', 'user2', 'user2'),
	(33, '너에게 답장을 보낸다', '으아아', 'user3', 1, 0, 0, 2, 'send', 0, '2018-07-28 11:25:47', 'user2', 'user2'),
	(34, '내게쓴 ', 'ㅁㄴㅇㅁㄴㅇㅁㄴㅇ', '', 0, 0, 0, 0, 'my', 0, '2018-07-28 11:27:34', 'user2', 'user2'),
	(35, 'a태그', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\n<a href="//google.com">a tag is coming</a>\r\n<a href="//google.com">a tag is coming</a>\r\n<a href="//google.com">a tag is coming</a><a href="//google.com">a tag is coming</a><a href="//google.com">a tag is coming</a>\r\n\r\n<a href="//google.com">a tag is coming</a><a href="//google.com">a tag is coming</a>\r\nv\r\n<a href="//google.com">a tag is coming</a>\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'user1', 1, 1, 0, 0, 'send', 1, '2018-07-28 11:28:45', 'user2', 'user2'),
	(36, 'adasd', 'adssd', 'usre2', 0, 0, 0, 0, 'send', 0, '2018-07-28 11:36:07', 'user1', 'user1');
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;

-- 테이블 serverside.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 테이블 데이터 serverside.member:~8 rows (대략적) 내보내기
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`idx`, `email`, `name`, `pw`) VALUES
	(1, 'test@test.com', '이름', '1234'),
	(2, 'test2@test.com', '이름2', '1234'),
	(3, 'test3@test.com', '이름2', '1234'),
	(4, '', '', ''),
	(5, 'user1', 'user1', 'asd'),
	(6, 'user2', 'user2', 'asd'),
	(7, 'User1', 'User1', 'asd'),
	(8, 'user3', 'user3', 'asd');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
