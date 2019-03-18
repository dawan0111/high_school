-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-09-27 03:46
-- 서버 버전: 10.1.35-MariaDB
-- PHP 버전: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `serverside12`
--
CREATE DATABASE IF NOT EXISTS `serverside12` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `serverside12`;

-- --------------------------------------------------------

--
-- 테이블 구조 `ani`
--

CREATE TABLE `ani` (
  `idx` int(11) NOT NULL,
  `l_bg` text COLLATE utf8_bin NOT NULL,
  `img1` text COLLATE utf8_bin NOT NULL,
  `img2` text COLLATE utf8_bin NOT NULL,
  `img3` text COLLATE utf8_bin NOT NULL,
  `r_bg` text COLLATE utf8_bin NOT NULL,
  `delay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `ani`
--

INSERT INTO `ani` (`idx`, `l_bg`, `img1`, `img2`, `img3`, `r_bg`, `delay`) VALUES
(1, '000000', '20180925142209610_home-bg07.jpg', '20180925142350518_gallery_5.jpg', '20180925142353823_portfolio-img8.jpg', '000000', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `memberidx` int(11) NOT NULL,
  `bds_idx` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hit` int(11) NOT NULL,
  `file` text NOT NULL,
  `writer` text AS (IF(memberIdx = 1, '관리자', '전라남도')) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `memberidx`, `bds_idx`, `title`, `text`, `datetime`, `hit`, `file`) VALUES
(5, 1, 7, '홈페이지 메뉴얼', '홈페이지 리뉴얼 되었습니다 많은 관심 부탁 드립니다.', '2018-06-08 15:54:33', 13, ''),
(7, 1, 6, '전남관광명소에 오신것을 환영합니다.', '전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.전남관광명소에 오신것을 환영합니다.', '2018-06-17 15:14:21', 0, '360x220_p1326646619010-1.jpg>'),
(10, 1, 7, '2018 전라남도 관광사진 공모전', '천혜의 자연환경과 전남만의 독특한 문화 등 차별성 있는 관광자원을 발굴하고 홍보하고자 「2018 전라남도 관광사진 공모전」을 공고합니다..\r\n\r\n파일 다운로드 : 2018 전라남도 관광사진 공모전 공고문 1부.hwp', '2018-06-17 15:28:56', 1, 'bireonggil8[1].jpg>'),
(11, 1, 7, '2018 『남도여행 으뜸상품』 공모 공고 ', '우리 도에서는 전남 관광자원의 매력을 잘 드러낼 2018년 남도여행 으뜸상품을 다음과 같이 공모하오니 전국 여행업체의 많은 관심과 참여를 바랍니다.\r\n\r\n\r\n파일 다운로드 : 2018 『남도여행 으뜸상품』하반기 공모 공고.hwp', '2018-06-17 15:30:18', 0, 'bireonggil9[1].jpg>'),
(12, 1, 7, '전라남도 관광마케팅사업 위탁 운영자 모집공고', '전라남도 관광마케팅사업 위탁 운영자 모집공고\r\n\r\n전라남도 사무의 민간위탁 조례 제5조 및 전라남도 관광진흥에 관한 \r\n조례 제10조, 제11조의 규정에 따라 전라남도 관광업무 위탁 운영자를 다음과 같이 공개모집합니다.\r\n\r\n파일 다운로드 : 전라남도 관광마케팅사업 위탁 운영자 모집공고.hwp', '2018-06-17 15:30:48', 0, '1200x1_1499674760[1].jpg>'),
(13, 1, 7, '2017 전라남도 관광사진 공모전 공고', '천혜의 자연환경과 전남만의 독특한 문화 등 차별성 있는 관광자원을 발굴하고 홍보하고자 \r\n\r\n「2017 전라남도 관광사진 공모전」을 개최하오니 많은 참여 바랍니다.\r\n\r\n\r\n\r\n\r\n파일 다운로드 : 2017_전라남도_관광사진_공모전_공고.hwp', '2018-06-17 15:32:31', 1, '33.gif>'),
(14, 1, 7, '2017 전라남도 관광사진 공모전 공고 ', '천혜의 자연환경과 전남만의 독특한 문화 등 차별성 있는 관광자원을 발굴하고 홍보하고자 \r\n\r\n「2017 전라남도 관광사진 공모전」을 개최하오니 많은 참여 바랍니다.', '2018-06-17 15:32:55', 0, '360x220_p1326646619010-1.jpg>'),
(16, 1, 8, '톱머리 해변', '', '2018-06-17 15:36:49', 0, '3.jpg>'),
(17, 1, 8, '돌머리해수욕장', '', '2018-06-17 15:36:58', 0, 'masterimg_jpg.jpg>'),
(18, 1, 8, '하트해변', '', '2018-06-17 15:37:18', 0, '2.jpg>'),
(20, 1, 8, '우전해변', '', '2018-06-17 15:37:56', 0, '3.jpg>'),
(21, 1, 6, '미황횟집', '', '2018-06-17 15:39:29', 0, '5.jpg>'),
(22, 1, 6, '독천식당', '', '2018-06-17 15:39:43', 0, '6.jpg>'),
(23, 1, 6, '해빔목포비빔밥', '', '2018-06-17 15:39:57', 1, '7.jpg>'),
(26, 1, 6, 'ㅇㄴㅁㅇㅁㄴㅇ', 'ㅇㄴㅁㅇㄴㅁㄹㅇㅇㄶㄴㅇㄹㄴㅁㅇㄴㅁ', '2018-09-25 15:52:04', 0, '>2018092515520427_home-bg07.jpg>'),
(27, 1, 6, 'ㅇㅁㄴㅇㅁㄴㅇ', 'ㅇㄴㅁㄹㄴㅁㅇㅇㄹㄴㅁㅇㅁㄴ', '2018-09-25 15:52:34', 0, '>20180925155234225_13_1.jpg>'),
(28, 1, 6, 'ㅇㅁㄴㅇㅁㄴㅇ', 'ㅇㄴㅁㄹㄴㅁㅇㅇㄹㄴㅁㅇㅁㄴ', '2018-09-25 15:52:41', 0, '20180925155241806_13_1.jpg>>20180925155241984_portfolio-img8.jpg'),
(29, 1, 6, 'ㅇㅁㄴㅇㅁㄴㅇㅋㅋㅋㅋㅋ', 'ㅇㄴㅁㄹㄴㅁㅇㅇㄹㄴㅁㅇㅁㄴㅍㅊㅇㄶㅇㄹㄶㄹㅇㅎㅇㄴㄹㄴ', '2018-09-25 15:53:02', 4, '20180925160731206_portfolio-img6.jpg>20180925160731241_home-bg07.jpg>20180925155302683_portfolio-img8.jpg'),
(31, 2, 7, '아리랑열차 (A-Train 특별할인 안내문)', '아리랑열차 (A-Train 특별할인 안내문)dffddfsdsffddsf', '2018-09-25 16:29:52', 4, ''),
(32, 2, 7, '완도군 장보고대교 개통에 따른 요금할인업소 안내', '완도군 장보고대교 개통에 따른 요금할인업소 안내jmjkjj', '2018-09-25 16:29:52', 2, ''),
(33, 2, 7, '2018년 차(음식)만들기 체험관광 단체버스 지원(일부) ', '2018년 차(음식)만들기 체험관광 단체버스 지원(일부) ', '2018-09-25 16:29:52', 0, ''),
(34, 2, 7, '무안공항 7월 운항 스케줄', '무안공항 7월 운항 스케줄', '2018-09-25 16:29:52', 0, ''),
(35, 2, 7, '대한민국 테마여행 10선 ', '대한민국 테마여행 10선 ', '2018-09-25 16:29:52', 1, ''),
(36, 2, 7, '2018년 관광진흥유공자 포상 신청 안내 ', '2018년 관광진흥유공자 포상 신청 안내 ', '2018-09-25 16:29:52', 0, ''),
(37, 2, 7, '관광식당지정관련안내 ', '관광식당지정관련안내 ', '2018-09-25 16:29:52', 0, ''),
(38, 2, 7, '\"2016 찾아가는 경기관광박람회\" 안내 ', '\"2016 찾아가는 경기관광박람회\" 안내 ', '2018-09-25 16:29:52', 0, '');

-- --------------------------------------------------------

--
-- 테이블 구조 `board_set`
--

CREATE TABLE `board_set` (
  `idx` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `line_cnt` int(11) NOT NULL,
  `page_cnt` int(11) NOT NULL,
  `list_set` varchar(255) NOT NULL,
  `view_set` varchar(255) NOT NULL,
  `upload_cnt` int(11) NOT NULL,
  `upload_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board_set`
--

INSERT INTO `board_set` (`idx`, `name`, `type`, `line_cnt`, `page_cnt`, `list_set`, `view_set`, `upload_cnt`, `upload_size`) VALUES
(6, '커뮤니티', 2, 1, 10, '1>3>4', '', 3, 2),
(7, '공지사항', 1, 1, 10, '1>3>4', '1>5>9', 3, 2),
(8, '갤러리', 3, 1, 8, '', '', 3, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `dan`
--

CREATE TABLE `dan` (
  `idx` int(11) NOT NULL,
  `top` text COLLATE utf8_bin NOT NULL,
  `bottom` text COLLATE utf8_bin NOT NULL,
  `bg` text COLLATE utf8_bin NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `dan`
--

INSERT INTO `dan` (`idx`, `top`, `bottom`, `bg`, `sort`) VALUES
(5, '', '', '', 1),
(6, '', '', '', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `dan_content`
--

CREATE TABLE `dan_content` (
  `idx` int(11) NOT NULL,
  `dan_idx` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `def_img` text COLLATE utf8_bin NOT NULL,
  `over_img` text COLLATE utf8_bin NOT NULL,
  `board` int(11) NOT NULL,
  `link` text COLLATE utf8_bin NOT NULL,
  `link_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `dan_content`
--

INSERT INTO `dan_content` (`idx`, `dan_idx`, `type`, `def_img`, `over_img`, `board`, `link`, `link_type`) VALUES
(1, 1, '', '', '', 0, '', 0),
(2, 2, 'banner', '20180925152216644_home-bg07.jpg', '20180925152216266_main.jpg', 7, 'http://www.naver.com', 1),
(3, 2, 'board', '', '', 6, '', 0),
(7, 5, 'board', '', '', 7, '', 0),
(8, 5, 'board', '', '', 6, '', 0),
(9, 5, 'board', '', '', 8, '', 0),
(10, 6, 'banner', '20180925162628968_gallery_2.jpg', '20180925162628289_img1.jpg', 0, 'http://www.naver.com', 2),
(11, 6, 'board', '', '', 8, '', 0),
(12, 6, 'board', '', '', 6, '', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `lv` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `userid`, `username`, `pw`, `lv`, `nickname`, `email`) VALUES
(1, 'root', '관리자', 'root', 1, 'admin', 'admin@admin.com');

-- --------------------------------------------------------

--
-- 테이블 구조 `menu`
--

CREATE TABLE `menu` (
  `idx` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `active` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `ok` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `board` int(11) NOT NULL,
  `html` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `menu`
--

INSERT INTO `menu` (`idx`, `name`, `active`, `parent`, `sort`, `ok`, `type`, `board`, `html`) VALUES
(4, '동부권 관광명소', 1, 0, 0, 1, '', 0, '0'),
(5, '남부권 관광명소', 1, 0, 1, 1, '', 0, '0'),
(6, '서부권 관광명소', 1, 0, 2, 1, '', 0, '0'),
(7, '공지사항', 1, 0, 3, 1, '', 0, '0'),
(8, '지리산 10경', 1, 4, 0, 1, 'html', 0, '6. 지리산 10경\r\n수십여 개의 높고 낮은 산봉우리들로 이루어진 지리산에서는 계절별로 다양한 모습들을 볼 수 있다. 지리산 등산지도를 처음으로 제작하여 배포했던 지리산 산악회는 지난 1972년 가장 대표적인 자연경관 10곳을 들어 \"지리산 10경\"으로 발표하였다. '),
(9, '내장산 국립공원', 1, 4, 1, 1, 'html', 0, '8. 내장산 국립공원\r\n산 안에 숨겨진 것이 무궁무진하다.\' 하여 붙여진 이름이 내장산(內藏山)이다. 가을이면 온통 선홍빛 단풍으로 지천을 물들이는 내장산은 찾는 이의 가슴에 진한 추억을 남기는 \"호남의 금강\"이다. 이다. 불타는 단풍터널과 도덕폭포, 금선폭포가 이루어내는 황홀경은 단풍 비경의 대명사로 손색이 없다. 해마다 단풍 천지를 이루는 가을뿐만 아니라 봄에는 철쭉과 벚꽃, 여름에는 짙고 무성한 녹음으로, 겨울에는 바위 절벽의 멋진 비경과 아름다운 설경, 그리고 사계절 내내 갖가지 야생화가 흐드러지게 만개하여 오가는 사람들을 감동시킨다. 내장산국립공원은 \"호남의 5대 명산\"인 내장산을 비롯하여 남쪽으로 이어진 백암산, 그리고 내장사, 백양사 등 유서 깊은 사찰과 함께 전봉준 장군이 체포되기 전에 마지막으로 거쳐 간 입암산성까지를 포괄하는데, \"봄 백양, 가을 내장\"이란 말처럼 비경의 연속이다. '),
(10, '담양 메타세쿼이아길', 1, 4, 2, 1, 'html', 0, '9. 담양 메타세쿼이아길\r\n* 이국적 풍경으로 한국의 아름다운 길로 뽑힌 곳 *\r\n이 길을 가다보면 이국적인 풍경에 심취해 나도 모르는 사이에 남도의 길목으로 빠져들고 만다. 초록빛 동굴을 통과하다보면 이곳을 왜 ‘꿈의 드라이브코스’라 부르는지 실감하게 될 것이다. 이러한 아름다움으로 인해 산림청과‘생명의 숲 가꾸기운동본부’ 등에서 주관한 ‘2002 아름다운 거리숲’ 대상을 수상했고, 2006년 건설교통부 선정 ‘한국의 아름다운 길 100선’의 최우수상을 수상하기도 했다'),
(11, '순천만 국가정원', 1, 5, 3, 1, 'html', 0, '1. 순천만국가정원 \r\n순천만을 보호하기 위하여 조성한 순천만국가정원은 순천 도사동 일대 정원부지 112만㎡(34만 평)에는 나무 505종 79만 주와 꽃 113종 315만 본이 식재됐다. 튤립과 철쭉 등이 꽃망울을 터뜨려 장관을 이루고 있다. 나눔의 숲 주변 3만㎡는 유채꽃 단지로 조성했는데, 5월 중순 일제히 만개해 \'노란 물결\'을 이룰 예정이다.\r\n정원 내에 식당이 있으며, 음식 반입도 허용된다. 시는 주요 동선에 팽나무와 느티나무 등 5만 주를 심어 자연 그늘막을 만들었다. 20일 개장과 함께 순천만 정원과 순천문학관 구간(4.64㎞)을 오가는 소형 무인궤도 열차(PRT)도 운행을 시작한다. 정원을 충분히 둘러본 탐방객은 PRT를 타고 문학관으로 이동해 하차한 뒤 순천만 초입 무진교까지 1.2㎞ 거리를 갈대열차로 옮겨 타 이동하면 된다.'),
(12, '보길도', 1, 5, 4, 1, 'html', 0, '7. 보길도\r\n완도국제항으로부터 12km 되는 거리에 있는 보길도는 일찌기 고산 윤선도가 배를 타고 제주도로 가던 중 심한 태풍을 피하기 위해 이곳에 들렀다가 수려한 산수에 매료되어, 이곳 동명을 부용동이라고 명명하고 머물 것을 결심했던 곳이다. 10여 년을 머물면서 세연정, 낙서재 등 건물 25동을 짓고 전원 생활을 즐겼으며, 그의 유명한 작품 \"어부사시사\"도 이곳에서 태어났다. 이 섬에는 은빛모래 혹은 자갈밭이 펼쳐진 해수욕장이 세 곳 있어, 여름피서지로도 인기가 있다. 그 중 섬 남쪽에 위치한 예송리 해수욕장은 모래없이 작은 자갈밭이 1.4km나 펼쳐져 있어 천연기념물 제40호인 예송리 상록수림과 어우러져 더욱 아름답다. 아열대성 식물이 무성하게 자라 투명한 바다와 신비스런 조화를 이루며, 특히 보길도로 향하는 남해 뱃길에는 푸른 바다 위에 크고 작은 섬들이 펼쳐져 있어, 아름다움을 더한다. '),
(13, '보성 녹차밭 대한 다원', 1, 5, 5, 1, 'html', 0, '10.보성녹차밭 대한다원 \r\n전남 보성에 있는 대한다업 (주)보성다원을 관광농원으로 개방한 곳으로 1957년에 시작해 반세기를 내다보는 내력있는 차 관광농원이다. 대한다업에서는 1959년 해발 350m 보성 오선봉 주변에 대단위의 녹차밭을 조성하고 있으며, 현재 연간 녹차 120톤 이상을 생산하고 있다. 대한다업(주)는 봉산리에 있는 보성다원 제 1다원과 회천리에 있는 제 2다원이 있으며, 제1다원은 국내 유일 차 관광농원으로 지정운영되고 있다. 연간 다녀가는 관광객수도 100만명이 넘고 있으며, 각종 CF촬영과, 영화촬영지로도 유명하며, 영화 \"선물\"의 촬영 장소였던 울창한 삼나무숲 오솔길로 걸어오르는 차밭은 991,740m²(30여만 평) 규모의 대단위 차농원으로 장관을 이뤄놓고 있다. 2003년 7월에는 KBS드라마 \'여름향기\'가 촬영되기도 하였다.'),
(14, '홍도', 1, 6, 6, 1, 'html', 0, '2. 홍도\r\n대한민국 전라남도 신안군 서부 해상에 있는 섬. 행정구역상 흑산면에 속한다. 목포에서 서쪽으로 약 107km 지점에 있다. 주위에는 단옷섬·방구여·아랫제비여·진섬·앞여·높은섬·띠섬·탑섬 등 20여 개의 부속섬이 있다. 해질 무렵이면 섬 전체가 붉게 물든다고 해서 홍도라고 했다. \r\n섬의 전체적인 모양은 북북동에서 남남서 방향으로 길게 뻗어 있으며, 기반암은 규암과 사암이 대부분이고, 부분적으로 역암과 셰일을 협재한다. 최고봉은 깃대봉(368m)이며, 남서쪽으로 양산봉(231m)이 솟아 있고, 섬 전체가 200m 내외의 급경사의 산지로 되어 있다. 해안선은 드나듦이 비교적 심한 편으로 남쪽과 북쪽이 깊게 만입되어 있다. 해안은 대부분 암석해안으로 해식애와 해식동(海蝕洞), 시스택(sea stack) 등의 해안지형이 발달하여 뛰어난 경관을 이루고 있다. '),
(15, '흑산도', 1, 6, 7, 1, 'html', 0, '4. 흑산도\r\n우리나라 행정구역상 최서남단 해역에 위치한 섬으로 목포에서 서남방 해상 92.7㎞(동경 125도 26′, 북위 34도 41′) 떨어진 곳에 있다. 바닷물이 푸르다 못해 검다 해서 흑산도라 불리우고, 섬의 면적은 19.7㎢, 해안선길이는 41.8㎞에 달하는 제법 큰 섬이다. 산지가 대부분을 차지하기 때문에 논농사는 전무한 실정이고, 수산업과 관광산업에 크게 의존하고 있다. 흑산도 예리항은 동지나해와 서남단 인근 어장의 전진기지로 중국어선들이 많이 입출항하고 있고 대규모 관광개발이 활발히 진행되고 있으며, 최서남단 소흑산도(가거도)는 어업전진기지로 개발되고 있다. '),
(16, '삼학도', 1, 6, 8, 1, 'html', 0, '5. 삼학도\r\n* 목포의 역사와 전설이 있는 섬, 삼학도 * \r\n지금은 매립되어 육지가 되었으나 삼학도는 유달산과 함께 목포 사람들의 꿈이었고 미래였다. 망망대해로 낭군을 떠나보낸 아낙들의 외로움이 녹아있고, 고깃배를 기다리는 상인들의 희망이 달려있으며 이승을 하직하고 저승으로 건너는 망자들의 한이 녹아있는 곳이다. 이렇듯 삼학도는 목포사람들의 희로애락과 함께 산 시민의 서러움이 엉켜있는 곳이다. 1872년 ‘무안목포진’에 표시된 삼학가 처음으로 지도에 그려졌다. 이유는 군사요충지 목포진은 세종 1439년 설치되었고, 성이 완성된 것은 1502년. 목포진을 운영하기 위해서는 땔감이 필요했기 때문이다. 삼학도는 땔나무를 제공했던 중요한 장소였다. 이러한 중요한 삼학도가 1895년 일본인에게 불법으로 판매된 사건이 있었다. 일본인 삽곡용랑은 옛 목포 관리 ‘김득추’를 이용해서 삼학도를 매입했다. 개항 2년전 (개항: 1897년 )인데, 개항 후 밝혀져 처벌하고 환수까지는 시간이 걸렸다. 결국 1910년 국권침탈이 되면서 삼학도와 고하도는 일본인 땅이 되고 말았는데 이 사건은 ‘삼학도 토지암매사건’으로 일본인이 목포 토지를 침탈한 대표적인 예이다. '),
(17, '공지사항', 1, 7, 9, 1, 'board', 7, '0');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `ani`
--
ALTER TABLE `ani`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `board_set`
--
ALTER TABLE `board_set`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `dan`
--
ALTER TABLE `dan`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `dan_content`
--
ALTER TABLE `dan_content`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `ani`
--
ALTER TABLE `ani`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- 테이블의 AUTO_INCREMENT `board_set`
--
ALTER TABLE `board_set`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `dan`
--
ALTER TABLE `dan`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `dan_content`
--
ALTER TABLE `dan_content`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
