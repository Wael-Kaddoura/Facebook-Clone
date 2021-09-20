-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2021 at 10:43 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocked_users`
--

INSERT INTO `blocked_users` (`id`, `user_id`, `blocked_user_id`) VALUES
(6, 1, 11),
(8, 7, 1),
(9, 1, 7),
(10, 1, 12),
(11, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `sender_id`, `reciever_id`) VALUES
(23, 1, 2),
(24, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `notification_body` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `reciever_id`, `notification_body`) VALUES
(33, 1, 2, 'Sent you a friend request!'),
(34, 1, 8, 'Sent you a friend request!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`) VALUES
(1, 'Wael', 'Kaddoura', 'wael.kad01@gmail.com', '1832633776f3716459705ab30ec06da0f7da07806e7d28d98a0f65582482d716', '0'),
(2, 'Hassan', 'Moussa', 'hassan.moussa@gmail.com', 'e4166670d01707ab9f86f9408fe1b034ce9aac1df7c773e77b30487e283f1ab0', '0'),
(3, 'Test', 'Test', 'test1@gmail.com', '937e8d5fbb48bd4949536cd65b8d35c426b80d2f830c5c308e2cdec422ae2244', '0'),
(4, 'Imad', 'Mostafa', 'imad.mostafa@gmail.com', '17b0503165205cb676f166d7efb79b50e6dcc9363745c509e772eb35372a33ef', '0'),
(5, 'Mohammad', 'Kaddoura', 'mhmd.kad@gmail.com', 'ed5660db36e30606a37a65d4c297ee0a23448550115495e739bea94f5f59db29', '0'),
(6, 'Mohammad', 'Ali', 'mohd.yasir.alali@gmail.com', 'ed5660db36e30606a37a65d4c297ee0a23448550115495e739bea94f5f59db29', '0'),
(7, 'Abed', 'Raee', 'abedraee@gmail.com', 'e559b1237d0aedcb3f6a91c2c4b221dbdd70c8dbbf0149fd02136f28396fbd98', '0'),
(8, 'Lara', 'Monir', 'laramonir@gmail.com', '118eebe37feed23d2e6cb8708e9052ffd61d8f9ecd64caf1b4e6bdeffe99efe0', '1'),
(9, 'Fadi', 'Hassan', 'fadihassan@gmail.com', 'd9326c7f2f517cd7cf99bfc69aa4a6c069dc1cc14d0d25aba4f240bfd0d01a46', '0'),
(10, 'Zeinab', 'Ali', 'zeinabali@gmail.com', '5c01b2c6a8781a020b546e52b2fbddac86b99f3556c226fa60d52269c9fd604a', '1'),
(11, 'Nour', 'Mohammad', 'nourmohammad@gmail.com', 'c4f52d0b9e6571378acf16f4282696eeb56454926f6dd3ec36fefdb7dbff07b6', '1'),
(12, 'Leah', 'Ahmad', 'liaahmad@gmail.com', '4f7df72c04363cb47654f50308f6f11103802d3b87f5595f515d24065cae871a', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_friends`
--

CREATE TABLE `users_friends` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `friend_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_friends`
--
ALTER TABLE `users_friends`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_friends`
--
ALTER TABLE `users_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
