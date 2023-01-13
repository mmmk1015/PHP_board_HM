-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 13 日 06:37
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsf_d12_02`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `diary_table`
--

CREATE TABLE `diary_table` (
  `id` int(11) NOT NULL,
  `title_name` varchar(45) NOT NULL,
  `category` tinyint(1) NOT NULL,
  `difficulty` tinyint(1) NOT NULL DEFAULT 2,
  `voltage` mediumint(9) NOT NULL,
  `howto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `diary_table`
--

INSERT INTO `diary_table` (`id`, `title_name`, `category`, `difficulty`, `voltage`, `howto`) VALUES
(2, 'aaaa', 2, 3, 200, 'konnnitiha\r\n'),
(3, '嗚呼あああ', 2, 3, 200, 'こんにちhあ'),
(4, 'aaaa', 3, 3, 100, 'aiueo'),
(5, 'eeee', 0, 2, 1, 'eeee');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `diary_table`
--
ALTER TABLE `diary_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `diary_table`
--
ALTER TABLE `diary_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
