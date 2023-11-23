-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 12:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justbfitness`
--

-- --------------------------------------------------------

-- Create the justbfitness database
CREATE DATABASE IF NOT EXISTS justbfitness;

-- Use the justbfitness database
USE justbfitness;

-- Table structure for table `group`

CREATE TABLE `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `rights`

CREATE TABLE `rights` (
  `rights_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  PRIMARY KEY (`rights_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `user`

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `additional_note` text DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `group_rights`

CREATE TABLE `group_rights` (
  `group_id` int(11) NOT NULL,
  `rights_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`, `rights_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `availability`

CREATE TABLE `availability` (
  `availability_id` int(11) NOT NULL AUTO_INCREMENT,
  `available_from` time DEFAULT NULL,
  `available_to` time DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`availability_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `timeslots`

CREATE TABLE `timeslots` (
  `timeslot_id` int(11) NOT NULL AUTO_INCREMENT,
  `timeslot_start` time DEFAULT NULL,
  `timeslot_end` time DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `availability_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`timeslot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `booking`

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_date` datetime DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `timeslot_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD KEY `timeslot_id` (`timeslot_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `group_rights`
--
ALTER TABLE `group_rights`
  ADD KEY `rights_id` (`rights_id`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD KEY `availability_id` (`availability_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD KEY `group_id` (`group_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`);

--
-- Constraints for table `group_rights`
--
ALTER TABLE `group_rights`
  ADD CONSTRAINT `group_rights_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`),
  ADD CONSTRAINT `group_rights_ibfk_2` FOREIGN KEY (`rights_id`) REFERENCES `rights` (`rights_id`);

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD CONSTRAINT `timeslots_ibfk_1` FOREIGN KEY (`availability_id`) REFERENCES `availability` (`availability_id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`timeslot_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

-- Sample data for the 'group' table
INSERT INTO `group` (`group_name`) VALUES
('Client'),
('Admin');

-- Sample data for the 'rights' table
INSERT INTO `rights` (`action_name`, `class_name`) VALUES
('create', 'user'),
('read', 'user'),
('update', 'user'),
('delete', 'user'),
('create', 'booking'),
('read', 'booking'),
('update', 'booking'),
('delete', 'booking'),
('create', 'availability'),
('read', 'availability'),
('update', 'availability'),
('delete', 'availability'),
('create', 'timeslots'),
('read', 'timeslots'),
('update', 'timeslots'),
('delete', 'timeslots');


-- Sample data for the 'group_rights' table

-- Group 1 (Client)
INSERT INTO `group_rights` (`group_id`, `rights_id`) VALUES
(1, 1),  -- create user
(1, 2),  -- read user
(1, 3),  -- update user
(1, 4),  -- delete user
(1, 5),  -- create booking
(1, 6),  -- read booking
(1, 8),  -- delete booking
(1, 10), -- read availability
(1, 14); -- read timeslots

-- Group 2 (Admin)
INSERT INTO `group_rights` (`group_id`, `rights_id`) VALUES
(2, 1),  -- create user
(2, 2),  -- read user
(2, 3),  -- update user
(2, 4),  -- delete user
(2, 6),  -- read booking
(2, 7),  -- update booking
(2, 8),  -- delete booking
(2, 9),  -- create availability
(2, 10), -- read availability
(2, 11), -- update availability
(2, 12), -- delete availability
(2, 13), -- create timeslots
(2, 14), -- read timeslots
(2, 15), -- update timeslots
(2, 16); -- delete timeslots

-- Sample data for the 'user' table
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `group_id`) VALUES
('Justin', 'Eberwein', 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3', 2), -- password: admin
('John', 'Doe', 'client@example.com', '62608e08adc29a8d6dbc9754e659f125', 1);       -- password: client

-- Sample data for the 'availability' table
INSERT INTO `availability` (`available_from`, `available_to`, `day`, `user_id`) VALUES
('06:30:00', '23:30:00', 'Monday', 1);


-- Sample data for the 'timeslots' table based on the provided on availability
-- Availability (Monday)
INSERT INTO `timeslots` (`timeslot_start`, `timeslot_end`, `is_available`, `availability_id`) VALUES
('06:30:00', '07:30:00', 1, 1),
('07:30:00', '08:30:00', 1, 1),
('08:30:00', '09:30:00', 1, 1),
('09:30:00', '10:30:00', 1, 1),
('10:30:00', '11:30:00', 1, 1),
('11:30:00', '12:30:00', 1, 1),
('12:30:00', '13:30:00', 1, 1),
('13:30:00', '14:30:00', 1, 1),
('14:30:00', '15:30:00', 1, 1),
('15:30:00', '16:30:00', 1, 1),
('16:30:00', '17:30:00', 1, 1),
('17:30:00', '18:30:00', 1, 1),
('18:30:00', '19:30:00', 1, 1),
('19:30:00', '20:30:00', 1, 1),
('20:30:00', '21:30:00', 1, 1),
('21:30:00', '22:30:00', 1, 1),
('22:30:00', '23:30:00', 1, 1);

-- Sample data for the 'booking' table based on the provided timeslots
-- Booking for Availability 1 (Monday)
INSERT INTO `booking` (`booking_date`, `appointment_date`, `timeslot_id`, `user_id`) VALUES
(NOW(), '2023-11-20', 1, 1),
(NOW(), '2023-11-21', 4, 1),
(NOW(), '2023-11-20', 6, 1),
(NOW(), '2023-11-25', 10, 1),
(NOW(), '2023-11-30', 13, 1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

