-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-09-25 06:04
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
-- 데이터베이스: `serverside11`
--
CREATE DATABASE IF NOT EXISTS `serverside11` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `serverside11`;

-- --------------------------------------------------------

--
-- 테이블 구조 `basket`
--

CREATE TABLE `basket` (
  `idx` int(11) NOT NULL,
  `food_idx` int(11) NOT NULL,
  `s_user_idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `lavel` int(11) NOT NULL,
  `buy_date` datetime NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `basket`
--

INSERT INTO `basket` (`idx`, `food_idx`, `s_user_idx`, `user_idx`, `quantity`, `lavel`, `buy_date`, `date`) VALUES
(4, 2, 2, 1, 5, 2, '2018-09-24 10:41:52', '2018-09-24'),
(5, 3, 2, 1, 5, 2, '2018-09-24 10:41:52', '2018-09-24'),
(6, 4, 3, 1, 5, 2, '2018-09-24 10:41:52', '2018-09-24'),
(7, 2, 2, 1, 10, 2, '2018-09-24 12:37:05', '2018-09-24'),
(8, 3, 2, 1, 5, 2, '2018-09-24 12:37:05', '2018-09-24'),
(9, 4, 3, 1, 10, 2, '2018-09-25 12:43:24', '2018-09-25');

-- --------------------------------------------------------

--
-- 테이블 구조 `food`
--

CREATE TABLE `food` (
  `idx` int(11) NOT NULL,
  `food_name` text COLLATE utf8_bin NOT NULL,
  `food_price` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `del` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `food`
--

INSERT INTO `food` (`idx`, `food_name`, `food_price`, `create_date`, `del`, `user_idx`) VALUES
(1, '치킨', 5000, '2018-09-24 09:57:30', 1, 2),
(2, '양념치킨', 3000, '2018-09-24 09:58:57', 0, 2),
(3, '치이킨', 5000, '2018-09-24 10:00:38', 0, 2),
(4, '돈가스', 9000, '2018-09-24 10:01:09', 1, 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `offset` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `id`, `name`, `pw`, `type`, `phone`, `offset`) VALUES
(1, 'aaaa', '시민', 'asdf1234', 1, '0101-1234-4567', '76,40'),
(2, 'bbbb', '가계', 'asdf1234', 2, '0101-1234-5678', '435,43'),
(3, 'cccc', '가계둞', 'asdf1234', 2, '0101-1234-5678', '197,88'),
(5, 'master', '관리자', '1234', 3, '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `idx` int(11) NOT NULL,
  `user_id` text COLLATE utf8_bin NOT NULL,
  `user_name` text COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `star` int(11) NOT NULL,
  `buy_date` datetime NOT NULL,
  `s_user_idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `review`
--

INSERT INTO `review` (`idx`, `user_id`, `user_name`, `content`, `star`, `buy_date`, `s_user_idx`, `user_idx`, `create_date`) VALUES
(1, 'aaaa', '시민', '취\r\n킨', 4, '2018-09-24 10:41:52', 2, 1, '2018-09-24 11:13:39'),
(2, 'aaaa', '시민', 'aaa', 4, '2018-09-25 12:43:24', 3, 1, '2018-09-25 12:48:38'),
(3, 'aaaa', '시민', 'aaaaa', 5, '2018-09-24 10:41:52', 3, 1, '2018-09-25 12:48:44'),
(4, 'aaaa', '시민', 'aaaaaaaaaaaaaa', 5, '2018-09-24 12:37:05', 2, 1, '2018-09-25 12:48:56');

-- --------------------------------------------------------

--
-- 테이블 구조 `store`
--

CREATE TABLE `store` (
  `idx` int(11) NOT NULL,
  `store_name` text COLLATE utf8_bin NOT NULL,
  `logo` text COLLATE utf8_bin NOT NULL,
  `kind` text COLLATE utf8_bin NOT NULL,
  `user_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `store`
--

INSERT INTO `store` (`idx`, `store_name`, `logo`, `kind`, `user_idx`) VALUES
(3, '치킨', '201809240954432495_logo_19.png', '치킨', 2),
(4, '돼지방구', '201809241001034007_logo_7.png', '일식', 3);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `basket`
--
ALTER TABLE `basket`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `food`
--
ALTER TABLE `food`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `store`
--
ALTER TABLE `store`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
