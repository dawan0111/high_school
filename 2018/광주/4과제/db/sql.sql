

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `memberidx` int(11) NOT NULL,
  `bds_idx` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL,
  `hit` int(11) NOT NULL,
  `file` text NOT NULL
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
(23, 1, 6, '해빔목포비빔밥', '', '2018-06-17 15:39:57', 0, '7.jpg>'),
(24, 1, 6, '광장미가', '40년 식당 운영의 내공을 자랑하는 엄마의 손맛을 그대로 이어 받은 여수 토박이 주인장이 투철한 프로정신으로 운영하며, 막걸리 식초로 만든 서대회와 싱싱한 바다 장어를 이용하여 담백하고 시원한 국물 맛이 일품인 장어탕이 주메뉴다.\r\n최고의 재료를 이용 최선의 서비스로 최대의 만족을 느끼게 하고 싶은 주인장의 신념이 빛을 발하며, 관광객의 발길이 끊이지 않는 곳이다. 산지에서 직송되어온 지역 특산물과 국산 양념류 고집으로 안심 먹거리를 제공하며, 담백한 보양식으로 많이 찾는 장어탕은 전국 어디서나 택배 주문이 가능하다. \r\n좌수영 음식 문화거리에 위치하고 있으며, 연중무휴로 운영되고 150여 명 수용이 가능한 1~2층의 넓은 공간을 자랑한다.', '2018-06-17 15:40:56', 0, '66.jpg>');



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



INSERT INTO `board_set` (`idx`, `name`, `type`, `line_cnt`, `page_cnt`, `list_set`, `view_set`, `upload_cnt`, `upload_size`) VALUES
(6, '자유게시판', 2, 1, 5, '1>3>4', '', 3, 2),
(7, '공지사항', 1, 1, 10, '1>3>4', '1>5>9', 3, 2),
(8, '갤러리', 3, 1, 8, '', '', 3, 2);

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

--
-- 덤프된 테이블의 인덱스
--

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
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- 테이블의 AUTO_INCREMENT `board_set`
--
ALTER TABLE `board_set`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
