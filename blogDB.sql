-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 06:33 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` date NOT NULL,
  `updated` date DEFAULT NULL,
  `metatitle` varchar(255) DEFAULT NULL,
  `urlslug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userID`, `title`, `body`, `created`, `updated`, `metatitle`, `urlslug`) VALUES
(1, 1, 'First Post', '&lt;p&gt;Meta Desc2ssa&lt;/p&gt;\r\n', '2021-11-14', '2021-11-14', NULL, NULL),
(8, 1, 'Second Post and new edited', '&lt;p&gt;Second Post with editing&lt;/p&gt;\r\n', '2021-11-14', '2021-11-14', 'second post', 'second_post_and_new_edited'),
(9, 1, 'Third Post', '&lt;ul&gt;\r\n	&lt;li&gt;This is a third post&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Gudluck have fun&lt;/p&gt;\r\n', '2021-11-14', NULL, NULL, NULL),
(10, 1, '4', '&lt;p&gt;Fourth s(edited)&lt;/p&gt;\r\n', '2021-11-14', '2021-11-14', NULL, NULL),
(11, 1, '5', '&lt;p&gt;First 5&lt;/p&gt;\r\n', '2021-11-14', NULL, NULL, NULL),
(12, 1, 'test6', '&lt;p&gt;testing 6&lt;/p&gt;\r\n', '2021-11-14', NULL, '', 'test6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`) VALUES
(1, 'blog', 'blog@blog.com', '$2y$10$O2rPhOSJQNyN1OjB9lyOZudhGPH86/b/BbIDYlaY5bx7u7yyVMJL.', '2020-12-09 10:31:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
