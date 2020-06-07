-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2020 at 04:57 PM
-- Server version: 10.3.22-MariaDB-1
-- PHP Version: 7.3.15-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `pk_id` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `beginAt` date NOT NULL,
  `fk_teacher` int(11) NOT NULL,
  `fk_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`pk_id`, `courseName`, `description`, `beginAt`, `fk_teacher`, `fk_module`) VALUES
(1, 'development', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas condimentum velit et dui aliquet, pulvinar bibendum nulla sagittis. Nulla rutrum. ', '2020-02-01', 52, 1),
(2, 'Comptability', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas condimentum velit et dui aliquet, pulvinar bibendum nulla sagittis. Nulla rutrum. ', '2020-09-01', 51, 2),
(3, 'gymnastic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas condimentum velit et dui aliquet, pulvinar bibendum nulla sagittis. Nulla rutrum. ', '2020-06-04', 51, 2),
(4, 'mathematics', 'Lorem ipsum dolor sit amet, consectetur adipiscing', '2020-06-18', 51, 3),
(5, 'Organisation des entreprises', 'Lorem ipsum dolor sit amet, consectetur adipiscing', '2020-06-26', 51, 3);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `pk_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`pk_id`, `name`) VALUES
(1, 'dev_2020'),
(3, 'test'),
(2, 'useless_modules');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Professeur'),
(2, 'Eleve');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `pk_id` int(11) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fk_role` int(11) NOT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `session_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`pk_id`, `lastname`, `firstname`, `email`, `password`, `fk_role`, `session_token`, `session_time`) VALUES
(51, 'bruce', 'lee', 'bruce@lee', '$2y$10$7kxt26qHCAwdiCh2YiDisuL80AR35P3wjvjn7onEiyqOKexutNGPm', 1, 'c21234eae6b245a2.1591113439', '2020-06-02 16:57:19'),
(52, 'Benjamin', 'Delbar', 'ben@delbar.be', '$2y$10$jTWt1dbCJGiSpWayIaxSreCtA6JtruhACnF2kBbt3Fa3i.Txia39K', 1, 'eaed9f84a46044a9.1591540801', '2020-06-07 15:40:01'),
(53, 'Khalid', 'Elouiali', 'kelo@ifosup', '$2y$10$KjEmvCYp4.zShht2jt2d7u5qRR2WBcHMV/MOVTLSzUAwlBtfC8VyG', 2, '0', '0'),
(54, 'coco', 'coco', 'coco@coco', '$2y$10$VDFwpfu3uMoaaQfGZ6k.cerluJR2AvcxS4ESejBxEZ9fc8A1T973a', 2, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `FK_teacher` (`fk_teacher`),
  ADD KEY `FK_modules` (`fk_module`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`pk_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_role` (`fk_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `FK_modules` FOREIGN KEY (`fk_module`) REFERENCES `modules` (`pk_id`),
  ADD CONSTRAINT `FK_teacher` FOREIGN KEY (`fk_teacher`) REFERENCES `users` (`pk_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_role` FOREIGN KEY (`fk_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
