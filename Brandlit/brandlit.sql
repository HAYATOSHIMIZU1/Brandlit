-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-08-15 16:02:09
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `brandlit`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL COMMENT '記事ID',
  `user_id` varchar(60) NOT NULL COMMENT 'ユーザーID',
  `category_id` varchar(60) NOT NULL COMMENT 'カテゴリーID',
  `title` varchar(60) NOT NULL COMMENT 'タイトル',
  `comment` varchar(60) NOT NULL COMMENT 'コメント',
  `evaluation` int(11) DEFAULT 0 COMMENT '評価数',
  `url` varchar(60) DEFAULT NULL COMMENT 'URL',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '投稿日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `article`
--

INSERT INTO `article` (`id`, `user_id`, `category_id`, `title`, `comment`, `evaluation`, `url`, `created_at`) VALUES
(3, '4', '2', 'ã‚·ãƒ£ãƒãƒ«', 'ã‹ã‚ã„ã„', 2, 'https://www.chanel.com/ja_JP/', '2021-07-26 13:51:39'),
(4, '8', '4', 'ã‚·ãƒ£ãƒãƒ«', 'ã™ã”ãã‹ã‚ã„ã„\r\n', 0, 'https://www.chanel.com/ja_JP/', '2021-07-26 11:36:38'),
(7, '12', '2', 'ã‚¸ã‚§ãƒ©ãƒ¼ãƒˆãƒ”ã‚±', 'å½¼æ°ã‹ã‚‰ã®èª•ç”Ÿæ—¥ãƒ—ãƒ¬ã‚¼ãƒ³ãƒˆã§ã‚¸ã‚§ãƒ©ãƒ”ã‚±ã®', 0, 'https://gelatopique.com/', '2021-07-26 13:53:58'),
(8, '13', '1', 'ãƒ¯ã‚³ãƒžãƒªã‚¢', 'å¤ã®ã‚·ãƒ£ãƒ„ã«ã‚ªã‚¹ã‚¹ãƒ¡ï¼', 2, 'https://www.pikey.co.jp/fs/shops/c/wackomaria', '2021-08-04 07:09:02'),
(9, '14', '1', 'ã‚«ãƒ¼ãƒãƒ¼ãƒˆ', 'å¤ç€å¥½ãã«ã¯ãŠã‚¹ã‚¹ãƒ¡ï¼', 0, 'https://carhartt-wip.jp/', '2021-07-27 04:38:18'),
(10, '15', '2', 'Dior', 'å¥³æ€§ã«ã¨ã£ã¦æ†§ã‚Œã®ãƒ–ãƒ©ãƒ³ãƒ‰ã§ã™ï¼', 0, 'https://www.dior.com/ja_jp', '2021-07-29 05:01:58'),
(11, '16', '1', 'ãƒ©ãƒ«ãƒ•ãƒ­ãƒ¼ãƒ¬ãƒ³', 'ã‚«ã‚¸ãƒ¥ã‚¢ãƒ«ã§ã‚‚ãƒ•ã‚©ãƒ¼ãƒžãƒ«ã§ã‚‚ã„ã‘ã‚‹ã‚ˆ', 0, 'https://www.ralphlauren.co.jp/', '2021-08-04 04:08:20'),
(12, '19', '1', 'ã‚«ãƒ¼ãƒãƒ¼ãƒˆ', 'ä»Šã¯ã‚„ã‚Šã®å¤ç€ãŒãŸãã•ã‚“è²©å£²ã—ã¦ã„ã¾ã™ï¼', 0, 'https://carhartt-wip.jp/', '2021-08-04 07:08:24');

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'カテゴリーID',
  `name` varchar(20) NOT NULL COMMENT 'カテゴリー名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, '20代(男性)'),
(2, '20代(女性)'),
(3, '30代(男性)'),
(4, '30代(女性)'),
(5, '40代以上(男性)'),
(6, '40代以上(女性)');

-- --------------------------------------------------------

--
-- テーブルの構造 `good`
--

CREATE TABLE `good` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `article_id` int(11) NOT NULL COMMENT '記事ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `good`
--

INSERT INTO `good` (`id`, `user_id`, `article_id`) VALUES
(1, 3, 1),
(2, 2, 1),
(3, 8, 2),
(4, 10, 2),
(5, 11, 3),
(6, 12, 3),
(7, 13, 6),
(8, 14, 6),
(9, 16, 8),
(10, 19, 8);

-- --------------------------------------------------------

--
-- テーブルの構造 `keep`
--

CREATE TABLE `keep` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `article_id` int(11) NOT NULL COMMENT '記事ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `keep`
--

INSERT INTO `keep` (`id`, `user_id`, `article_id`) VALUES
(1, 3, 1),
(2, 2, 1),
(3, 8, 2),
(4, 10, 2),
(5, 11, 3),
(6, 12, 3),
(7, 13, 6),
(8, 14, 6),
(9, 16, 8),
(10, 19, 8);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'ユーザーID',
  `name` varchar(20) NOT NULL COMMENT 'ユーザーネーム',
  `email` varchar(60) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(100) NOT NULL COMMENT 'パスワード'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'æ¸…æ°´å‹‡äºº', 'xxx@xxx', '$2y$10$cJx7mP0jhEFerLNsPRe7OeMeK9u4PJ7aXF40htx7bj5CfX/riH.Oi'),
(3, 'æ¸…æ°´ å‹‡äºº', 'a@gmai.com', '$2y$10$1eZ0OLVMvbG.dX8RFvbKsurKm3scBvokGvCF4yu/aSeydL6O6XWQS'),
(4, 'å±±ç”°ã€€å¤ªéƒŽ', 'a@yahoo.co.jp', '$2y$10$Bfdtq9Ht.2g8tGHQhinAz.odsbOFWyCIBb3VI0c7f.Xhdot1sAgyy'),
(6, 'ç®¡ç†è€…', 'admin@admin', '$2y$10$SD.7sxHVafg5bvMBoLqGJ.aOK/fbU3TgHoBzqVZpm9d73WZ3V5hYW'),
(7, 'ç®¡ç†è€…', 'admin@admin', '$2y$10$uOBIXOI9tTBkcS1Rn8zqDOeHECfVMgnafgcuNPLL10JuykbwC.mxy'),
(8, 'ç”°ä¸­èŠ±å­', 'hanako@yahoo.co.jp', '$2y$10$EX1F/SNSwW/r3CM/W83nX.RCmrm1LyxKoLqkqNJQo/QPMZugb8y1m'),
(9, 'ã—ã¿ãšã¯ã‚„ã¨', 'hayato@gmai.com', '$2y$10$olL4UNQj6k/l41ILDWLV4.6aFkXxEn5etyKwBxizkCMBWBmeuymCi'),
(10, 'éˆ´æœ¨å¤§å’Œ', 'yamato@gmai.com', '$2y$10$y7MsuLz5oBasyMpTF/sXWeqxU/bOcNxPnNKsvVT9vhFpTUUqyczse'),
(11, 'æ¸…æ°´å‹‡äºº', 'hayato_6480@yahoo.co.jp', '$2y$10$M9yvgWjxS00WRSzPkOfDdOdc.wgwsJr0LTzIQLh11g/Ha5tYVPFry'),
(12, 'éˆ´æœ¨ã›ã„ã‚‰', 'seira@gmail.com', '$2y$10$lGaosJSE6Wquo908hnW5eepXDGuBgOvq8lpOaJZM5JbCKyBU2fyjq'),
(13, 'æ¸¡é‚‰æ—¥å‘', 'hyuuga@gmail.com', '$2y$10$WiBA0LIyKWmWJQfyekkcGefX4NsTOeBi2hLsvjJRKQ3i.6DKvKdG6'),
(14, 'ä½è—¤é›„å¤ª', 'yuta@gmail.com', '$2y$10$F/lajaEPPaHIAJQQb93A6OUsUtNOPFfKfFyNxMH05mFehD2Lpccoq'),
(15, 'è¿‘è—¤ã²ã¨ã¿', 'hitomi@gmail.com', '$2y$10$v3tVF7.aj.0INM2DDdFyh.3fxDrv3VgF7r5sIga9pyt5KtsaXi6du'),
(16, 'ä¸‰è¼ªã¨ã†ã„', 'miwa@gmail.com', '$2y$10$zQTAvHNawf8Hljv6cb8NJO0jgYP1cv38o.3ApLuo.P109yvXl4Xy.'),
(17, 'æ¸…æ°´å‹‡äºº', 'hayato@gmai.com', '$2y$10$KjUh5dvOnimxvQvK.py5f.FZ.dKcMWmsyGnrzLkI732JKhB4rMRkO'),
(18, 'æ¸…æ°´å‹‡äºº', 'hayato_6480@yahoo.co.jp', '$2y$10$ogSxLBBn/EHbwz/ocJHsauUV5/biB57XBDDwtc7PVMlpxLUiFBxva'),
(19, 'æ¸…æ°´å‹‡äºº', 'shimizu@yahoo.co.jp', '$2y$10$uGGOtFiLbt173L3ZqAEbdeoj9QWQg4Kx.bCPjnRWquoZaClvecVrW'),
(20, 'å±±ç”°å¤ªéƒŽ', 'test@test', '$2y$10$YP6fv5R5x394qdAbbyLX3.Fyb8f5kHjvCdqbpwbVTFtAaKyWnt6Dm');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `keep`
--
ALTER TABLE `keep`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '記事ID', AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `good`
--
ALTER TABLE `good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `keep`
--
ALTER TABLE `keep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
