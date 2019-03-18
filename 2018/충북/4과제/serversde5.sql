-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-08-07 07:32
-- 서버 버전: 10.1.34-MariaDB
-- PHP 버전: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `serverside`
--
CREATE DATABASE IF NOT EXISTS `serverside` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `serverside`;

-- --------------------------------------------------------

--
-- 테이블 구조 `buy`
--

CREATE TABLE `buy` (
  `idx` int(11) NOT NULL,
  `p_name` text COLLATE utf8_bin NOT NULL,
  `pidx` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `p_phone` text COLLATE utf8_bin NOT NULL,
  `midx` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `phone`, `type`) VALUES
(1, 'seller1', 'seller11', '판매자1', '01011111234', '판매자'),
(2, 'seller2', 'seller22', '판매자2', '01022222234', '판매자'),
(3, 'seller3', 'seller33', '판매자3', '01033333234', '판매자'),
(4, 'seller4', 'seller44', '판매자4', '01044444234', '판매자'),
(5, 'seller5', 'seller55', '판매자5', '01055555234', '판매자'),
(6, 'seller6', 'seller66', '판매자6', '01066666234', '판매자'),
(9, 'test1234', '12345678', '변경', '01012345678', '구매자');

-- --------------------------------------------------------

--
-- 테이블 구조 `notebook`
--

CREATE TABLE `notebook` (
  `idx` int(11) NOT NULL,
  `user_name` text COLLATE utf8_bin NOT NULL,
  `user_id` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `price` text COLLATE utf8_bin NOT NULL,
  `tag` text COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin NOT NULL,
  `point` int(11) NOT NULL,
  `code` text COLLATE utf8_bin NOT NULL,
  `company` text COLLATE utf8_bin NOT NULL,
  `carry` int(11) NOT NULL,
  `real_price` int(11) AS (REPLACE(price, ",", "")) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `notebook`
--

INSERT INTO `notebook` (`idx`, `user_name`, `user_id`, `name`, `price`, `tag`, `image`, `point`, `code`, `company`, `carry`) VALUES
(1, '자1', 'seller1', '재고보유/특가195만/에이수스 GE73-8RF Raider', '19,500', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 멋진 노트북, 인치 19', '20180807111554_218.jpg', 1000, 'GE73-8RF', '에이수스', 0),
(2, '판매자3', 'seller3', '(GI)LG전자 터치그램 13Z970-TR3IK 무선마우스', '958,000', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 싱글, 가벼운 노트북, 인치 24', 'img45.jpg', 1500, '13Z970-TR3IK', 'LG', 2500),
(3, '판매자6', 'seller6', '(특가36만)레노버 320-15IAP 7세대 펜티엄', '358,990', 'CPU 펜티엄, RAM 1G, ROM 250GB, 코어 듀얼, 인기있는 노트북, 인치 17', 'img53.jpg', 1500, '320-15IAP', '레노버', 2500),
(4, '판매자5', 'seller5', '[ASUS] X540UA-DM141(초콜릿블랙)(7세대 코어i3-7100U)', '398,990', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 듀얼, 멋진 노트북, 인치 24', 'img38.jpg', 1000, 'X540UA-DM141', '에이수스', 2500),
(5, '판매자2', 'seller2', '[HP] 15-BS142TU HP가성비노트북/8세대/i5쿼드/SSD', '539,000', 'CPU intel I5, RAM 4G, ROM 1TB, 코어 듀얼, 가성비좋은 노트북, 인치 24', 'img25.jpg', 1000, '15-BS142TU', 'HP', 0),
(6, '판매자5', 'seller5', '[HP] HP 17-X019DS/인텔쿼드 N3710/4GB/1TB/17형/윈10', '494,500', 'CPU 펜티엄, RAM 4G, ROM 128GB, 코어 옥타, 인기있는 노트북, 인치 19', 'img58.jpg', 1500, '17-X019DS', 'HP', 2500),
(7, '판매자2', 'seller2', '[HP] HP PRO BOOK 450 G5 LIMITED9 i7/930MX/WIN10', '1,858,990', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 멋진 노트북, 인치 15', 'img13.jpg', 1000, 'G5-LIMITED9', 'HP', 2500),
(8, '판매자1', 'seller1', '[HP] ITKET / HP ZBook 17 G3 M9L93AV / E3-1535M / 8GB', '4,130,000', 'CPU 제온, RAM 8G, ROM 1TB, 코어 쿼드, 게이밍 노트북, 인치 24', 'img61.jpg', 1500, 'M9L93AV', 'HP', 2500),
(9, '판매자2', 'seller2', '[ideapad] 레노버 320s-13IKB NVMe 1TB 가성비노트북', '680,000', 'CPU intel I3, RAM 2G, ROM 1TB, 코어 듀얼, 인기있는 노트북, 인치 22', 'img42.jpg', 1000, '320s-13IKB', '레노버', 2500),
(10, '판매자5', 'seller5', '[Ideapad] 특가62만 8세대 레노버노트북 320S-14IKBR GEN8 PRO', '628,000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 멋진 노트북, 인치 22', 'img26.jpg', 1000, '320S-14IKBR', '레노버', 2500),
(11, '판매자5', 'seller5', '[LG전자] (Y) LG 울트라 PC 15UD470-GX38K i3 7세대 당일발송', '630,000', 'CPU intel I3, RAM 2G, ROM 128GB, 코어 싱글, 예쁜 노트북, 인치 19', 'img34.jpg', 1000, '15UD470-GX38K', 'LG', 2500),
(12, '판매자1', 'seller1', '[LG전자] LG 노트북 14Z980-GA5IK (i5-8250U 3.4GHz / 4GB /  Full HD / Win 10)', '612,000', 'CPU intel I5, RAM 4G, ROM 128GB, 코어 싱글, 멋진 노트북, 인치 24', 'img27.jpg', 1500, '14Z980-GA5IK', 'LG', 0),
(13, '판매자1', 'seller1', '[LG전자] LG 울트라북 15U570-KA55K 최저가 판매', '784,000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 가성비좋은 노트북, 인치 19', 'img22.jpg', 1000, '15U570-KA55K', 'LG', 3500),
(14, '판매자3', 'seller3', '[ROG] (레어사은품)ASUS ROG 8세대 게이밍 GM501GS-EI005T', '2,998,980', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 옥타, 인기있는 노트북, 인치 17', 'img65.jpg', 1500, 'GM501GS-EI005T', '에이수스', 2500),
(15, '판매자5', 'seller5', '[레노버] (특가35만)레노버 320-15IAP 7세대 펜티엄', '350,000', 'CPU 펜티엄, RAM 1G, ROM 250GB, 코어 듀얼, 심플한 노트북, 인치 17', 'img53.jpg', 1500, '320-15IAP', '레노버', 2500),
(16, '판매자2', 'seller2', '[레노버] Lenovo 모바일 워크스테이션 ThinkPad P51-01FKR', '2,998,000', 'CPU 제온, RAM 8G, ROM 1TB, 코어 옥타, 게이밍 노트북, 인치 22', 'img59.jpg', 1000, 'P51-01FKR', '레노버', 3500),
(17, '판매자4', 'seller4', '[레노버] 액티브펜포함 8세대 CPU) YOGA520 81C80059KR 요가520', '1,289,000', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 인기있는 노트북, 인치 15', 'img14.jpg', 1000, '520-14IKB', '레노버', 2500),
(18, '판매자4', 'seller4', '[레노버] 특가58만 / 슬림노트북 320s-14IKBR GEN8 Pro', '589,000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 가성비좋은 노트북, 인치 22', 'img26.jpg', 1000, '320S-14IKBR', '레노버', 2500),
(19, '판매자2', 'seller2', '[레어사은품]ASUS ROG 8세대 게이밍 GM501GS-EI005T', '2,998,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 옥타, 게이밍 노트북, 인치 17', 'img64.jpg', 1000, 'GM501GS-EI005T', '에이수스', 3500),
(20, '판매자5', 'seller5', '[비보북] ASUS VIVOBOOK X510UA-BQ492 i5/4GB/화이트', '649,900', 'CPU intel I5, RAM 4G, ROM 128GB, 코어 듀얼, 가성비좋은 노트북, 인치 19', 'img29.jpg', 1500, 'X510UA-BQ492', '에이수스', 0),
(21, '판매자4', 'seller4', '[비보북] ASUS 비보북 플립TP301UA-C4151T 360회전 128GB WIN10', '950,000', 'CPU intel I3, RAM 4G, ROM 250GB, 코어 듀얼, 가성비좋은 노트북, 인치 22', 'img69.jpg', 1500, 'TP301UA-C4151T', '에이수스', 2500),
(22, '판매자1', 'seller1', '[삼성전자] 삼성 노트북 NT300E5M-K24W 최저가 판매', '592,000', 'CPU 펜티엄, RAM 1G, ROM 1TB, 코어 옥타, 예쁜 노트북, 인치 22', 'img55.jpg', 1500, 'NT300E5M-K24W', '삼성', 2500),
(23, '판매자4', 'seller4', '[에이수스] 3종사은품)ASUS 비보북 X510UA-BQ492/8세대/듀얼하드', '648,990', 'CPU intel I5, RAM 4G, ROM 128GB, 코어 듀얼, 가벼운 노트북, 인치 19', 'img29.jpg', 1000, 'X510UA-BQ492', '에이수스', 2500),
(24, '판매자2', 'seller2', '[에이수스] GE73-8RF Raider', '1,950,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 예쁜 노트북, 인치 19', 'img2.jpg', 1500, 'GE73-8RF', '에이수스', 2500),
(25, '판매자2', 'seller2', '[에이수스] ORG ASUS E402NA-FA041T 노트북/윈10/펜티엄', '339,000', 'CPU 펜티엄, RAM 1G, ROM 500GB, 코어 듀얼, 가벼운 노트북, 인치 24', 'img56.jpg', 1000, 'ASUS E402NA-FA041T', '에이수스', 2500),
(26, '판매자4', 'seller4', '[에이수스] X540UA-DM141(초콜릿블랙)(7세대 코어i3-7100U FHD 인텔HD620 윈도우미포함)', '398,000', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 듀얼, 예쁜 노트북, 인치 24', 'img37.jpg', 1000, 'X540UA-DM141', '에이수스', 3500),
(27, '판매자4', 'seller4', '[에이수스] 재고보유/8세대CPU/1TB무상UP)MSI GE73-8RF Raider', '1,996,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 게이밍 노트북, 인치 19', 'img2.jpg', 1000, 'GE73-8RF', '에이수스', 2500),
(28, '판매자3', 'seller3', '[에이수스] 하드1TB/MSI GE73 8RF/i7-8750H/GTX1070', '1,996,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 가성비좋은 노트북, 인치 19', 'img1.jpg', 1500, 'GE73-8RF', '에이수스', 2500),
(29, '판매자2', 'seller2', '[파빌리온] CB083TX HP게이밍노트북/i7쿼드', '979,500', 'CPU intel I7, RAM 4G, ROM 250GB, 코어 쿼드, 멋진 노트북, 인치 15', 'img7.jpg', 1000, '15-cb083TX', 'HP', 0),
(30, '판매자4', 'seller4', '[프로북] HP 프로북 450 G4-W7C92AV /7세대 펜티엄 Full-HD', '399,000', 'CPU 펜티엄, RAM 1G, ROM 500GB, 코어 옥타, 가성비좋은 노트북, 인치 24', 'img52.jpg', 1500, 'G4-W7C92AV', 'HP', 3500),
(31, '판매자1', 'seller1', '[한성컴퓨터] EX58 BOSSMONSTER Lv.87 7K70 Gsync 144/게이밍', '2,527,000', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 가성비좋은 노트북, 인치 19', 'img66.jpg', 1500, 'EX58', '한성컴퓨터', 2500),
(32, '판매자3', 'seller3', '[한성컴퓨터] XH58 BossMonster Hero Ti8100', '854,000', 'CPU intel I3, RAM 8G, ROM 128GB, 코어 싱글, 가성비좋은 노트북, 인치 24', 'img70.jpg', 1000, 'XH58', '한성컴퓨터', 2500),
(33, '판매자5', 'seller5', '[한성컴퓨터] 노트북 H57 DGA4560/카비레이크', '479,000', 'CPU 펜티엄, RAM 2G, ROM 250GB, 코어 싱글, 예쁜 노트북, 인치 17', 'img57.jpg', 1500, 'H57', '한성컴퓨터', 2500),
(34, '판매자6', 'seller6', '[한성컴퓨터] 노트북 U58 ForceRecon 6757S/8세대/i5/4G', '579,000', 'CPU intel I5, RAM 4G, ROM 128GB, 코어 듀얼, 가성비좋은 노트북, 인치 22', 'img24.jpg', 1500, 'U58', '한성컴퓨터', 2500),
(35, '판매자2', 'seller2', '[한성컴퓨터] 노트북 X57K BOSSMONSTER Lv.74', '801,000', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 옥타, 예쁜 노트북, 인치 15', 'img6.jpg', 1500, 'X57K', '한성컴퓨터', 2500),
(36, '판매자5', 'seller5', '[한성컴퓨터] 한성EX58 BOSSMONSTER Lv.87 7K70 Gsync 144/게이밍', '2,549,000', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 멋진 노트북, 인치 19', 'img66.jpg', 1500, 'EX58', '한성컴퓨터', 2500),
(37, '판매자4', 'seller4', '[한성컴퓨터] 한성H57 DGA4560/울트라북', '478,990', 'CPU 펜티엄, RAM 2G, ROM 250GB, 코어 싱글, 심플한 노트북, 인치 17', 'img57.jpg', 1000, 'H57', '한성컴퓨터', 3500),
(38, '판매자1', 'seller1', '[한성컴퓨터] 한성U38 ForceRecon 6427S/가벼운/울트라북', '415,000', 'CPU 펜티엄, RAM 1G, ROM 1TB, 코어 싱글, 멋진 노트북, 인치 22', 'img50.jpg', 1000, 'U38', '한성컴퓨터', 3500),
(39, '판매자3', 'seller3', '[한성컴퓨터] 한성X57K BOSSMONSTER Lv.74', '801,050', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 옥타, 가성비좋은 노트북, 인치 15', 'img5.jpg', 1500, 'X57K', '한성컴퓨터', 0),
(40, '판매자5', 'seller5', '15ZD980-GX50K 무선마우스 키스킨 가방증정 빠른배송', '1,350,000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 예쁜 노트북, 인치 22', 'img67.jpg', 1500, '15ZD980-GX50K', 'LG', 2500),
(41, '판매자6', 'seller6', '190만원대 구매+MSoffice NT900X5T-X716A', '1,999,000', 'CPU intel I7, RAM 4G, ROM 250GB, 코어 싱글, 멋진 노트북, 인치 19', 'img63.jpg', 1500, 'NT900X5T-X716A', '삼성', 0),
(42, '판매자2', 'seller2', '2017 노트북9 Always NT900X3Y-KD5S (기본)', '1,041,000', 'CPU intel I5, RAM 4G, ROM 250GB, 코어 듀얼, 인기있는 노트북, 인치 15', 'img16.jpg', 1000, 'NT900X3Y-KD5S', '삼성', 0),
(43, '판매자3', 'seller3', '2018 울트라PC 15U480-LA10K (기본)', '615,000', 'CPU 펜티엄, RAM 8G, ROM 128GB, 코어 싱글, 심플한 노트북, 인치 19', 'img54.jpg', 1000, '15U480-LA10K', 'LG', 3500),
(44, '판매자1', 'seller1', '8세대i5슬림메탈/나노베젤/S510UN-BQ083', '898,000', 'CPU intel I5, RAM 4G, ROM 250GB, 코어 쿼드, 멋진 노트북, 인치 17', 'img17.jpg', 1500, 'S510UN-BQ083', '에이수스', 3500),
(45, '판매자4', 'seller4', '8세대i5슬림메탈/나노베젤/S510UN-BQ083', '899,000', 'CPU intel I5, RAM 4G, ROM 250GB, 코어 쿼드, 인기있는 노트북, 인치 17', 'img17.jpg', 1500, 'S510UN-BQ083', '에이수스', 0),
(46, '판매자1', 'seller1', 'ASUS E402NA 윈도우10 슬림노트북 스타일리쉬 디자인!', '332,000', 'CPU 펜티엄, RAM 4G, ROM 128GB, 코어 듀얼, 예쁜 노트북, 인치 19', 'img49.jpg', 1000, 'E402NA-FA040T', '에이수스', 2500),
(47, '판매자6', 'seller6', 'ASUS E402NA 윈도우10 슬림노트북 스타일리쉬 디자인!', '349,000', 'CPU 펜티엄, RAM 1G, ROM 500GB, 코어 듀얼, 가성비좋은 노트북, 인치 24', 'img56.jpg', 1500, 'ASUS E402NA-FA041T', '에이수스', 0),
(48, '판매자5', 'seller5', 'ASUS FX503VM-E4100 인텔 i7 / GTX1060 탑재', '1,188,990', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 쿼드, 멋진 노트북, 인치 15', 'img11.jpg', 1000, 'FX503VM-E4100', '에이수스', 0),
(49, '판매자3', 'seller3', 'ASUS VIVOBOOK TP301UA-C4151T', '830,000', 'CPU intel I3, RAM 4G, ROM 250GB, 코어 듀얼, 가벼운 노트북, 인치 22', 'img69.jpg', 1500, 'TP301UA-C4151T', '에이수스', 2500),
(50, '판매자6', 'seller6', 'ASUS VIVOBOOK X540UA-DM141 7세대 i3 풀HD / SSD / 괴물노트북!', '398,990', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 듀얼, 가성비좋은 노트북, 인치 24', 'img39.jpg', 1500, 'X540UA-DM141', '에이수스', 0),
(51, '판매자3', 'seller3', 'ASUS 바이퍼 FX503VM-E4100/i7/GTX1060/게이밍노트북', '1,176,000', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 쿼드, 게이밍 노트북, 인치 15', 'img11.jpg', 1500, 'FX503VM-E4100', '에이수스', 2500),
(52, '판매자6', 'seller6', 'ASUS 비보북 S510UN-BQ083', '899,000', 'CPU intel I5, RAM 4G, ROM 250GB, 코어 쿼드, 게이밍 노트북, 인치 17', 'img19.jpg', 0, 'S510UN-BQ083', '에이수스', 0),
(53, '판매자3', 'seller3', 'ASUS/1.7KG/8thS510UN-BQ083', '899,000', 'CPU intel I5, RAM 4G, ROM 250GB, 코어 쿼드, 가성비좋은 노트북, 인치 17', 'img18.jpg', 1500, 'S510UN-BQ083', '에이수스', 2500),
(54, '판매자6', 'seller6', 'EH58 BossMonster STORM81W/게이밍/GTX1060/윈10', '1,262,000', 'CPU intel I3, RAM 2G, ROM 250GB, 코어 싱글, 게이밍좋은 노트북, 인치 17', 'img40.jpg', 1500, 'EH58', '한성컴퓨터', 2500),
(55, '판매자3', 'seller3', 'EX58 BOSSMONSTER Lv.87 7K70 Gsync 144/게이밍', '2,549,000', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 게이밍 노트북, 인치 19', 'img66.jpg', 1000, 'EX58', '한성컴퓨터', 0),
(56, '판매자5', 'seller5', 'HFT/ HP ZBook 17 G3 M9L93AV', '4,432,030', 'CPU 제온, RAM 8G, ROM 1TB, 코어 쿼드, 멋진 노트북, 인치 24', 'img61.jpg', 1500, 'M9L93AV', 'HP', 2500),
(57, '판매자1', 'seller1', 'HP 14-bp013tu 인텔i3/SSD128GB/Win10탑재', '508,000', 'CPU intel I3, RAM 2G, ROM 128GB, 코어 옥타, 가성비좋은 노트북, 인치 19', 'img41.jpg', 1000, '14-bp013tu', 'HP', 3500),
(58, '판매자3', 'seller3', 'HP 15-CB083TX i7/GTX1050 게이밍노트북/IPS패널', '979,000', 'CPU intel I7, RAM 4G, ROM 250GB, 코어 쿼드, 가성비좋은 노트북, 인치 15', 'img7.jpg', 1500, '15-cb083TX', 'HP', 2500),
(59, '판매자6', 'seller6', 'HP 17-X019DS (해외 리퍼비시)', '497,080', 'CPU 펜티엄, RAM 4G, ROM 128GB, 코어 옥타, 심플한 노트북, 인치 19', 'img58.jpg', 1500, '17-X019DS', 'HP', 0),
(60, '판매자1', 'seller1', 'HP 17-X019DS/인텔쿼드 N3710/4GB/1TB/17형/윈10', '494,000', 'CPU 펜티엄, RAM 4G, ROM 128GB, 코어 옥타, 가성비좋은 노트북, 인치 19', 'img58.jpg', 1000, '17-X019DS', 'HP', 3500),
(61, '판매자1', 'seller1', 'HP i3 올인원 노트북 15-bs563TU/SSD128', '418,000', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 옥타, 가성비좋은 노트북, 인치 24', 'img32.jpg', 1000, '15-BS563TU', ' HP', 3500),
(62, '판매자1', 'seller1', 'HP PRO BOOK 450 G5 LIMITED9', '1,832,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 예쁜 노트북, 인치 15', 'img13.jpg', 1000, 'G5-LIMITED9', 'HP', 2500),
(63, '판매자4', 'seller4', 'HP 가성비 i3 올인원 노트북 15-bs563TU / SSD128GB', '419,000', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 옥타, 멋진 노트북, 인치 24', 'img32.jpg', 1500, '15-BS563TU', ' HP', 2500),
(64, '판매자2', 'seller2', 'HP 프로북 450 G4-W7C92AV /7세대 펜티엄 Full-HD', '399,000', 'CPU 펜티엄, RAM 1G, ROM 500GB, 코어 옥타, 가벼운 노트북, 인치 24', 'img52.jpg', 1500, 'G4-W7C92AV', 'HP', 2500),
(65, '판매자1', 'seller1', 'HP게이밍노트북/i7쿼드/GTX1050/NVME', '969,000', 'CPU intel I7, RAM 4G, ROM 250GB, 코어 쿼드, 심플한 노트북, 인치 15', 'img7.jpg', 1500, '15-cb083TX', 'HP', 2500),
(66, '판매자4', 'seller4', 'Lenovo 모바일 워크스테이션 ThinkPad P51-01FKR', '2,999,000', 'CPU 제온, RAM 8G, ROM 1TB, 코어 옥타, 인기있는 노트북, 인치 22', 'img60.jpg', 1500, 'P51-01FKR', '레노버', 2500),
(67, '판매자1', 'seller1', 'LG 15UD480-GX5FK 1TB HDD(최저가판매)', '874,000', 'CPU intel I5, RAM 4G, ROM 1TB, 코어 쿼드, 심플한 노트북, 인치 17', 'img20.jpg', 1000, '15UD480-GX5FK', 'LG', 3500),
(68, '판매자6', 'seller6', 'LG 15UD480-GX5FK/1TB HDD', '889,290', 'CPU intel I5, RAM 4G, ROM 1TB, 코어 쿼드, 예쁜 노트북, 인치 17', 'img21.jpg', 1500, '15UD480-GX5FK', 'LG', 2500),
(69, '판매자5', 'seller5', 'LG 올데이 그램 13Z970-TR3IK터치스크린kg', '1,160,490', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 싱글, 멋진 노트북, 인치 24', 'img46.jpg', 1500, '13Z970-TR3IK', 'LG', 2500),
(70, '판매자3', 'seller3', 'LG 울트라PC 15U570-KA55K 엘지正品', '799,290', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 멋진 노트북, 인치 19', 'img22.jpg', 1500, '15U570-KA55K', 'LG', 2500),
(71, '판매자5', 'seller5', 'LG 울트라PC 15U570-KA55K 엘지正品 (파우치+무선마우스+키스킨)', '799,500', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 인기있는 노트북, 인치 19', 'img23.jpg', 1500, '15U570-KA55K', 'LG', 0),
(72, '판매자2', 'seller2', 'LG올뉴그램 15Z980-GA56K 윈도우10탑재 8세대 8G/512G', '1,760,730', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 인기있는 노트북, 인치 15', 'img4.jpg', 1500, '15Z980-GA56K', 'LG', 2500),
(73, '판매자3', 'seller3', 'LG올뉴그램 15Z980-GA56K 파우치+무선마우스+키스킨', '1,760,730', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 가벼운 노트북, 인치 15', 'img4.jpg', 1000, '15Z980-GA56K', 'LG', 0),
(74, '판매자5', 'seller5', 'LG올뉴그램 윈도우10/8세대/8G/512G', '1,760,800', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 게이밍 노트북, 인치 15', 'img4.jpg', 1500, '15Z980-GA56K', 'LG', 0),
(75, '판매자6', 'seller6', 'LG울트라PC 15U480-LA10K 윈도우10/광시야각', '649,000', 'CPU 펜티엄, RAM 8G, ROM 128GB, 코어 싱글, 가성비좋은 노트북, 인치 19', 'img54.jpg', 1500, '15U480-LA10K', 'LG', 2500),
(76, '판매자2', 'seller2', 'LG울트라PC 15UD780-PX70K 가방+무선마우스 증정', '1,438,990', 'CPU intel I7, RAM 4G, ROM 500GB, 코어 듀얼, 인기있는 노트북, 인치 17', 'img62.jpg', 1500, '15UD780-PX70K', 'LG', 0),
(77, '판매자4', 'seller4', 'LG울트라PC GT 15UD780-PX70K 게이밍', '1,438,990', 'CPU intel I7, RAM 4G, ROM 500GB, 코어 듀얼, 멋진 노트북, 인치 17', 'img62.jpg', 1000, '15UD780-PX70K', 'LG', 2500),
(78, '판매자6', 'seller6', 'LG전자 15ZD980-GX50K +키스킨+무선마우스+일반파우치', '1,460,750', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 심플한 노트북, 인치 22', 'img67.jpg', 1500, '15ZD980-GX50K', 'LG', 2500),
(79, '판매자4', 'seller4', 'LG전자 2018 그램 15Z980-GA56K (기본) ENW', '1,760,730', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 가성비좋은 노트북, 인치 15', 'img3.jpg', 1000, '15Z980-GA56K', 'LG', 0),
(80, '판매자1', 'seller1', 'LG전자 2018 울트라PC GT 15UD780-PX70K (기본) ENW', '1,370,000', 'CPU intel I7, RAM 4G, ROM 500GB, 코어 듀얼, 게이밍 노트북, 인치 17', 'img62.jpg', 1500, '15UD780-PX70K', 'LG', 2500),
(81, '판매자6', 'seller6', 'LG전자 울트라PC 15UD470-GX38K 재고보유 당일 발송', '652,060', 'CPU intel I3, RAM 2G, ROM 128GB, 코어 싱글, 인기있는 노트북, 인치 19', 'img35.jpg', 1500, '15UD470-GX38K', 'LG', 2500),
(82, '판매자1', 'seller1', 'MSoffice증정 NT900X5T-X716A', '1,862,000', 'CPU intel I7, RAM 4G, ROM 250GB, 코어 싱글, 심플한 노트북, 인치 19', 'img63.jpg', 1500, 'NT900X5T-X716A', '삼성', 2500),
(83, '판매자6', 'seller6', 'MS오피스/노트북Pen NT930QAA-K28A', '1,160,690', 'CPU 펜티엄, RAM 8G, ROM 250GB, 코어 옥타, 심플한 노트북, 인치 17', 'img48.jpg', 1500, 'NT930QAA-K28A', '삼성', 0),
(84, '판매자3', 'seller3', 'NT500R3M-K54S-7 (+WIN7PRO 64/32 선택 정품 탑제 )', '678,000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 옥타, 게이밍 노트북, 인치 17', 'img28.jpg', 1000, 'NT500R3M-K54S', '삼성', 2500),
(85, '판매자4', 'seller4', 'NT930QAA-K58 빌트인 S펜 / 터치스크린', '1,495,000', 'CPU intel I5, RAM 4G, ROM 1TB, 코어 듀얼, 심플한 노트북, 인치 24', 'img68.jpg', 1000, 'NT930QAA-K58', '삼성', 2500),
(86, '판매자5', 'seller5', 'NT930QAA-K58 오피스마우스파우치쿠폰포함', '1,633,950', 'CPU intel I5, RAM 4G, ROM 1TB, 코어 듀얼, 예쁜 노트북, 인치 24', 'img68.jpg', 1500, 'NT930QAA-K58', '삼성', 2500),
(87, '판매자5', 'seller5', 'WB ASUS E402NA-FA040T 노트북/윈10/펜티엄', '348,000', 'CPU 펜티엄, RAM 4G, ROM 128GB, 코어 듀얼, 멋진 노트북, 인치 19', 'img49.jpg', 1500, 'E402NA-FA040T', '에이수스', 2500),
(88, '판매자3', 'seller3', 'WB ASUS E402NA-FA041T 노트북/펜티엄', '349,000', 'CPU 펜티엄, RAM 1G, ROM 500GB, 코어 듀얼, 멋진 노트북, 인치 24', 'img56.jpg', 1000, 'ASUS E402NA-FA041T', '에이수스', 2500),
(89, '판매자1', 'seller1', 'X57K BOSSMONSTER Lv.74', '800,000', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 옥타, 멋진 노트북, 인치 15', 'img5.jpg', 1500, 'X57K', '한성컴퓨터', 3500),
(90, '판매자4', 'seller4', 'X57K BOSSMONSTER Lv.74/게이밍/1050', '801,050', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 옥타, 게이밍 노트북, 인치 15', 'img5.jpg', 1000, 'X57K', '한성컴퓨터', 0),
(91, '판매자4', 'seller4', '가방증정 HP14-bp013tu 6세대i3/SSD128GB/Win10', '509,900', 'CPU intel I3, RAM 2G, ROM 128GB, 코어 옥타, 인기있는 노트북, 인치 19', 'img41.jpg', 1500, '14-bp013tu', 'HP', 0),
(92, '판매자4', 'seller4', '게임북특가 720s-15IKB Superior/GTX1050Ti', '1,450,000', 'CPU intel I7, RAM 8G, ROM 250GB, 코어 쿼드, 멋진 노트북, 인치 15', 'img9.jpg', 1500, '720s-15IKB', '레노버', 2500),
(93, '판매자2', 'seller2', '노트북 XH57 BossMonster Hero7100 게이밍', '690,000', 'CPU intel I3, RAM 2G, ROM 1TB, 코어 싱글, 게이밍 노트북, 인치 22', 'img30.jpg', 1000, 'XH57', '한성컴퓨터', 2500),
(94, '판매자6', 'seller6', '노트북H57 DGA4560/울트라북', '479,000', 'CPU 펜티엄, RAM 2G, ROM 250GB, 코어 싱글, 인기있는 노트북, 인치 17', 'img57.jpg', 1500, 'H57', '한성컴퓨터', 0),
(95, '판매자2', 'seller2', '노트북U38 ForceRecon 6427S/가벼운/울트라북', '418,990', 'CPU 펜티엄, RAM 1G, ROM 1TB, 코어 싱글, 심플한 노트북, 인치 22', 'img51.jpg', 1500, 'U38', '한성컴퓨터', 0),
(96, '판매자5', 'seller5', '대박특가 NT800G5M-X78S/A 삼성게이밍노트북 총알배송', '1,404,000', 'CPU intel I7, RAM 8G, ROM 250GB, 코어 쿼드, 멋진 노트북, 인치 15', 'img10.jpg', 1500, 'NT800G5M-X78S', '삼성', 0),
(97, '판매자4', 'seller4', '레노버 320s-13IKB NVMe 1TB 노트북추천 윈10탑재', '749,000', 'CPU intel I3, RAM 2G, ROM 1TB, 코어 듀얼, 가성비좋은 노트북, 인치 22', 'img43.jpg', 1500, '320s-13IKB', '레노버', 3500),
(98, '판매자6', 'seller6', '레노버 320s-13IKB NVMe 1TB 대학생 가성비노트북', '749,000', 'CPU intel I3, RAM 2G, ROM 1TB, 코어 듀얼, 멋진 노트북, 인치 22', 'img44.jpg', 1500, '320s-13IKB', '레노버', 0),
(99, '판매자6', 'seller6', '레노버 YOGA520 81C80059KR 요가520', '1,319,000', 'CPU intel I7, RAM 8G, ROM 500GB, 코어 쿼드, 가벼운 노트북, 인치 15', 'img15.jpg', 1500, '520-14IKB', '레노버', 0),
(100, '판매자3', 'seller3', '레노버 그레잇북 720S-13IKB i3 Gold Air', '738,000', 'CPU intel I3, RAM 2G, ROM 250GB, 코어 듀얼, 예쁜 노트북, 인치 17', 'img33.jpg', 1000, '720S-13IKB', '레노버', 2500),
(101, '판매자6', 'seller6', '레노버노트북 320S-14IKBR Gen8 Pro NVMe 슬롯탑재/i5/4G', '628,000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 싱글, 인기있는 노트북, 인치 22', 'img26.jpg', 1500, '320S-14IKBR', '레노버', 0),
(102, '판매자3', 'seller3', '삼성 / Odyssey NT800G5M-X78S / 실재고보유', '1,403,000', 'CPU intel I7, RAM 8G, ROM 250GB, 코어 쿼드, 게이밍 노트북, 인치 15', 'img10.jpg', 1000, 'NT800G5M-X78S', '삼성', 2500),
(103, '판매자3', 'seller3', '삼성 노트북 NT300E5M-K24W 최저가 판매', '598,570', 'CPU 펜티엄, RAM 1G, ROM 1TB, 코어 옥타, 멋진 노트북, 인치 22', 'img55.jpg', 1000, 'NT300E5M-K24W', '삼성', 0),
(104, '판매자2', 'seller2', '삼성 노트북 Pen NT930QAA-K28A+한컴오피스증정 GAON', '1,105,000', 'CPU 펜티엄, RAM 8G, ROM 250GB, 코어 옥타, 가벼운 노트북, 인치 17', 'img47.jpg', 1000, 'NT930QAA-K28A', '삼성', 0),
(105, '판매자1', 'seller1', '삼성 노트북9 Always NT900X3I-A38A 최대 30시간/ 995g', '903,000', 'CPU intel I3, RAM 2G, ROM 1TB, 코어 옥타, 가벼운 노트북, 인치 22', 'img36.jpg', 1000, 'NT900X3I-A38A', '삼성', 2500),
(106, '판매자5', 'seller5', '삼성 노트북9 Always NT900X3Y-KD5S 초경량 799g+이지충전 80분 완벽충전', '1,049,000', 'CPU intel I5, RAM 4G, ROM 250GB, 코어 듀얼, 가벼운 노트북, 인치 15', 'img16.jpg', 1500, 'NT900X3Y-KD5S', '삼성', 0),
(107, '판매자2', 'seller2', '삼성 노트북9 Always NT900X5T-X716A 2018 아카데미 신제품런칭', '1,999,000', 'CPU intel I7, RAM 4G, ROM 250GB, 코어 싱글, 가성비좋은 노트북, 인치 19', 'img63.jpg', 1000, 'NT900X5T-X716A', '삼성', 2500),
(108, '판매자4', 'seller4', '삼성전자 노트북3 NT300E5M-K24W (기본)', '598,570', 'CPU 펜티엄, RAM 1G, ROM 1TB, 코어 옥타, 심플한 노트북, 인치 22', 'img55.jpg', 1500, 'NT300E5M-K24W', '삼성', 2500),
(109, '판매자2', 'seller2', '슬림게이밍북 720s-15IKB Superior', '1,449,000', 'CPU intel I7, RAM 8G, ROM 250GB, 코어 쿼드, 게이밍 노트북, 인치 15', 'img8.jpg', 1000, '720s-15IKB', '레노버', 0),
(110, '판매자5', 'seller5', '에이수스 GE73 8RF/i7-8750H/GTX1070', '1,996,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 가성비좋은 노트북, 인치 19', 'img1.jpg', 1000, 'GE73-8RF', '에이수스', 2500),
(111, '판매자6', 'seller6', '재고?/에이수스 GE73 8RF/i7-8750H', '1,996,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 멋진 노트북, 인치 19', 'img1.jpg', 1500, 'GE73-8RF', '에이수스', 2500),
(112, '판매자3', 'seller3', '최종64만원)ASUS 비보북 X510UA-BQ492/8세대 i5/슬림', '648,000', 'CPU intel I5, RAM 4G, ROM 128GB, 코어 듀얼, 예쁜 노트북, 인치 19', 'img29.jpg', 1000, 'X510UA-BQ492', '에이수스', 3500),
(113, '판매자5', 'seller5', '특가 게이밍노트북 720s-15 Superior', '1,451,000', 'CPU intel I7, RAM 8G, ROM 250GB, 코어 쿼드, 예쁜 노트북, 인치 15', 'img8.jpg', 1500, '720s-15IKB', '레노버', 0),
(114, '판매자1', 'seller1', '프로북 450 G4-W7C92AV (SSD 128GB)', '399,000', 'CPU 펜티엄, RAM 1G, ROM 500GB, 코어 옥타, 인기있는 노트북, 인치 24', 'img52.jpg', 1000, 'G4-W7C92AV', 'HP', 0),
(115, '판매자2', 'seller2', '한성컴퓨터 EX58 BOSSMONSTER Lv.87 7K70 Gsync 144 WIN', '2,659,000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 옥타, 게이밍 노트북, 인치 15', 'img12.jpg', 1500, 'EX58', '한성컴퓨터', 2500),
(116, '판매자2', 'seller2', '한성컴퓨터 H57 DGA4560 (1TB)', '461,000', 'CPU 펜티엄, RAM 2G, ROM 250GB, 코어 싱글, 멋진 노트북, 인치 17', 'img57.jpg', 1000, 'H57', '한성컴퓨터', 2500),
(117, '판매자5', 'seller5', '한성컴퓨터 X57K BossMonster Lv.74', '802,000', 'CPU intel I7, RAM 8G, ROM 128GB, 코어 옥타, 가성비좋은 노트북, 인치 15', 'img6.jpg', 1000, 'X57K', '한성컴퓨터', 2500),
(118, '판매자5', 'seller5', '한성컴퓨터 XH57 BossMonster Hero7100', '719,000', 'CPU intel I3, RAM 2G, ROM 1TB, 코어 싱글, 인기있는 노트북, 인치 22', 'img31.jpg', 1500, 'XH57', '한성컴퓨터', 0),
(119, '판매자6', 'seller6', '한성컴퓨터 XH58 BossMonster Hero Ti8100', '859,000', 'CPU intel I3, RAM 8G, ROM 128GB, 코어 싱글, 인기있는 노트북, 인치 24', 'img70.jpg', 1500, 'XH58', '한성컴퓨터', 2500),
(120, '판매자2', 'seller2', '14ZD960-GX7BK (Win10정품+복원F11) Win7/10PRO가능', '1667000', 'CPU intel I7, RAM 1G, ROM 128GB, 코어 듀얼, 가벼운 노트북, 인치 15', 'img71.jpg', 1000, '14ZD960-GX7BK', 'LG', 3500),
(121, '판매자4', 'seller4', 'LG그램 14ZD960-GX7BK 윈도10 (설치) 빠른배송', '1667500', 'CPU intel I7, RAM 1G, ROM 128GB, 코어 듀얼, 가성비좋은 노트북, 인치 15', 'img71.jpg', 1000, '14ZD960-GX7BK', 'LG', 2500),
(122, '판매자5', 'seller5', '[LG전자] LG그램 14ZD960-GX7BK 윈도10 (설치) 빠른배송', '1667800', 'CPU intel I7, RAM 1G, ROM 128GB, 코어 듀얼, 게이밍 노트북, 인치 15', 'img71.jpg', 1500, '14ZD960-GX7BK', 'LG', 2500),
(123, '판매자6', 'seller6', 'LG그램 14ZD960-GX7BK 윈도10 (설치) 빠른배송', '1669000', 'CPU intel I7, RAM 1G, ROM 128GB, 코어 듀얼, 멋진 노트북, 인치 15', 'img71.jpg', 1500, '14ZD960-GX7BK', 'LG', 0),
(124, '판매자1', 'seller1', '씽크패드8세대 T480 20L5A00RKR 정품가방 무선K,B증정', '1439000', 'CPU intel I5, RAM 2G, ROM 250GB, 코어 싱글, 심플한 노트북, 인치 17', 'img72.jpg', 1000, 'T480-20L5A00RKR', '레노버', 3500),
(125, '판매자3', 'seller3', '8세대 씽크패드 출시기념 상품증정 T480 20L5A00RKR', '1439500', 'CPU intel I5, RAM 2G, ROM 250GB, 코어 싱글, 예쁜 노트북, 인치 17', 'img73.jpg', 1000, 'T480-20L5A00RKR', '레노버', 2500),
(126, '판매자4', 'seller4', '[씽크패드] 씽크패드 T480 20L5A00RKR 8세대 정품가방 무선KB 증정', '1439900', 'CPU intel I5, RAM 2G, ROM 250GB, 코어 싱글, 인기있는 노트북, 인치 17', 'img74.jpg', 1500, 'T480-20L5A00RKR', '레노버', 2500),
(127, '판매자6', 'seller6', '[삼성노트북9] 799g초경량 삼성노트북9 Always NT900X3Y-A38A', '895000', 'CPU intel I3, RAM 4G, ROM 500GB, 코어 옥타, 가벼운 노트북, 인치 19', 'img75.jpg', 1500, 'NT900X3Y-A38A', '삼성', 2500),
(128, '판매자4', 'seller4', '[특가163만]ASUS 게이밍 GL503VM-GZ254T 페이커에디션', '1638000', 'CPU intel I7, RAM 8G, ROM 1TB, 코어 쿼드, 가성비좋은 노트북, 인치 22', 'img76.jpg', 1500, 'GL503VM-GZ254T', '에이수스', 2500),
(129, '판매자5', 'seller5', '노트북 U38 ForceRecon 6457SW,8세대,i5,울트라북', '720000', 'CPU intel I5, RAM 4G, ROM 500GB, 코어 옥타, 인기있는 노트북, 인치 24', 'img77.jpg', 1000, 'U38', '한성컴퓨터', 3500),
(130, '판매자1', 'seller1', 'HP 오멘 15-CE028TX 게이밍노트북', '1368000', 'CPU intel I7, RAM 2G, ROM 250GB, 코어 싱글, 게이밍 노트북, 인치 22', 'img78.jpg', 1500, '15-CE028TX', 'HP', 2500),
(131, '판매자6', 'seller6', '[LG전자] LG 노트북 그램 터치스크린 15Z980-TA5IK', '1544000', 'CPU intel I5, RAM 1G, ROM 128GB, 코어 듀오, 가벼운 노트북, 인치 19', 'img79.jpg', 1000, '15Z980-TA5IK', 'LG', 0),
(132, '판매자2', 'seller2', '레노버320-15ISK Win10 탑재 노트북', '495000', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 싱글, 멋진 노트북, 인치 17', 'img80.jpg', 1000, '320-15ISK', '레노버', 3500),
(133, '판매자4', 'seller4', '레노버 인텔i3/SSD 500G/Full-HD/320-15ISK i3 WIN10', '495328', 'CPU intel I3, RAM 2G, ROM 500GB, 코어 싱글, 인기있는 노트북, 인치 17', 'img81.jpg', 1500, '320-15ISK', '레노버', 3500),
(134, '판매자5', 'seller5', '8세대 삼성 노트북 Pen NT940X5N-X716S i7/터치/16g', '1919000', 'CPU intel I7, RAM 4G, ROM 1TB, 코어 쿼드, 게이밍 노트북, 인치 22', 'img82.jpg', 1000, 'NT940X5N-X716S', '삼성', 2500),
(135, '판매자4', 'seller4', '8세대 코어i5 M2 256GB ASUS 노트북 X542UA-DM831', '555000', 'CPU intel I5, RAM 8G, ROM 250GB, 코어 옥타, 예쁜 노트북, 인치 15', 'img83.jpg', 1500, 'X542UA-DM831', '에이수스', 3500),
(136, '판매자2', 'seller2', '[한성컴퓨터] 노트북 한성 U45 ForceRecon 6757S/8세대/i5/4G', '572000', 'CPU intel I5, RAM 4G, ROM 128GB, 코어 싱글, 멋진 노트북, 인치 24', 'img84.jpg', 1000, 'U45', '한성컴퓨터', 2500),
(138, '판매자1', 'seller1', '호', '5,000', '굿,와', '20180807111712_622.jpg', 3000, 'AA', '우리', 200);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `notebook`
--
ALTER TABLE `notebook`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `buy`
--
ALTER TABLE `buy`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `notebook`
--
ALTER TABLE `notebook`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
