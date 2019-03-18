-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-02-01 08:07
-- 서버 버전: 10.1.29-MariaDB
-- PHP 버전: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `serverside3`
--
CREATE DATABASE IF NOT EXISTS `serverside3` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `serverside3`;

-- --------------------------------------------------------

--
-- 테이블 구조 `buy`
--

CREATE TABLE `buy` (
  `idx` int(11) NOT NULL,
  `pidx` int(11) NOT NULL,
  `buyprice` int(11) NOT NULL,
  `coupon` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` text COLLATE utf8_bin NOT NULL,
  `cprt` int(11) NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `buy`
--

INSERT INTO `buy` (`idx`, `pidx`, `buyprice`, `coupon`, `stock`, `date`, `type`, `cprt`, `id`) VALUES
(1, 1, 1500, 0, 42, '2018-01-30 16:40:58', 'buy', 0, 'admin'),
(2, 2, 3000, 0, 49, '2018-01-30 16:41:13', 'buy', 0, 'admin'),
(3, 4, 400, 0, 4, '2018-01-30 16:45:42', 'buy', 0, 'admin');

-- --------------------------------------------------------

--
-- 테이블 구조 `coupon`
--

CREATE TABLE `coupon` (
  `idx` int(11) NOT NULL,
  `prt` text COLLATE utf8_bin NOT NULL,
  `disabled` int(11) NOT NULL,
  `midx` int(11) NOT NULL
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
  `gender` text COLLATE utf8_bin NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `gender`, `age`) VALUES
(1, 'admin', '123', '관리자', 'male', 10);

-- --------------------------------------------------------

--
-- 테이블 구조 `product`
--

CREATE TABLE `product` (
  `idx` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `file` text COLLATE utf8_bin NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `product`
--

INSERT INTO `product` (`idx`, `name`, `file`, `type`, `price`, `stock`, `sale`) VALUES
(1, '한라봉', '한라봉.png', '신선식품', 1500, 308, 0),
(2, '레드향', '레드향.png', '신선식품', 3000, 301, 0),
(3, '천혜향', '천혜향.png', '신선식품', 2000, 60, 0),
(4, '밀감', '밀감.png', '신선식품', 400, 146, 0),
(5, '제주 감귤초콜릿', '제주감귤초콜릿.png', '가공식품', 5000, 30, 0),
(6, '제주 녹차초콜릿', '제주녹차초콜릿.png', '가공식품', 5200, 40, 0),
(7, '감귤제리', '감귤제리.jpg', '가공식품', 3500, 20, 0),
(8, '올레길 자연치즈', '치즈.jpg', '가공식품', 5000, 35, 0),
(9, '제키스 감귤칩', '감귤칩.jpg', '가공식품', 2500, 40, 0),
(10, '제주 흑돼지', '제주흑돼지.png', '건강식품', 45000, 30, 0),
(11, '제주 조릿대 진액', '조릿대.jpg', '건강식품', 3500, 20, 0),
(12, '제주 말뼈환', '마력천.jpg', '건강식품', 40000, 30, 0),
(13, '제주본 황철 액기스', '황철.jpg', '건강식품', 35000, 20, 0),
(14, '떠나요 제주 버스패키지', '패키지2.png', '여행/체험권', 400000, 15, 0),
(15, '제주도 2박3일 패키지', '패키지1.png', '여행/체험권', 300000, 20, 0),
(16, '열기구 체험권', '이용권1.png', '여행/체험권', 25000, 30, 0),
(17, '행글라이더 체험권', '이용권2.png', '여행/체험권', 20000, 20, 0),
(18, '그랑블루 요트투어', '패키지3.jpg', '여행/체험권', 450000, 15, 0),
(19, '돌하르방 열쇠고리', '돌하르방.png', '기타', 1500, 80, 0),
(20, '제주바다 캔들', '캔들.jpg', '기타', 4500, 50, 0),
(21, '스노우볼', '스노우볼.jpg', '기타', 5500, 30, 0),
(22, '동백오일', '동백오일.jpg', '기타', 15000, 40, 0),
(23, '제주 폰케이스', '폰케이스.jpg', '기타', 18000, 50, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `view`
--

CREATE TABLE `view` (
  `idx` int(11) NOT NULL,
  `pidx` int(11) NOT NULL,
  `gender` text COLLATE utf8_bin NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `view`
--

INSERT INTO `view` (`idx`, `pidx`, `gender`, `age`) VALUES
(1, 1, 'male', 10),
(2, 2, 'male', 10),
(3, 2, 'male', 10),
(4, 1, 'male', 10),
(5, 4, 'male', 10);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `buy`
--
ALTER TABLE `buy`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `coupon`
--
ALTER TABLE `coupon`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 테이블의 AUTO_INCREMENT `view`
--
ALTER TABLE `view`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
