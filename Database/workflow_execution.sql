-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2020 at 04:30 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `workflow_execution`
--

CREATE TABLE `workflow_execution` (
  `id` int(11) UNSIGNED NOT NULL,
  `instance_id` int(11) UNSIGNED NOT NULL,
  `request_params` longtext NOT NULL,
  `response_params` longtext NOT NULL,
  `execution_id` varchar(20) NOT NULL,
  `api_domain` varchar(100) NOT NULL,
  `auth_token` varchar(100) DEFAULT NULL,
  `workflow_diagram` text NOT NULL,
  `executed_by` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT 'NOT_STARTED = 0, IN_PROGRESS = 1, PASS = 2, FAIL = 3',
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workflow_execution`
--
ALTER TABLE `workflow_execution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workflow_fk_id` (`instance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workflow_execution`
--
ALTER TABLE `workflow_execution`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workflow_execution`
--
ALTER TABLE `workflow_execution`
  ADD CONSTRAINT `workflow_fk_id` FOREIGN KEY (`instance_id`) REFERENCES `workflow` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
