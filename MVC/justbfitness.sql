-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 10:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `weight_unit` varchar(10) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `height_unit` varchar(10) DEFAULT NULL,
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
('create', 'user'),   		-- 1
('read', 'user'),     		-- 2
('update', 'user'),   		-- 3
('delete', 'user'),   		-- 4
('edit', 'user'),     		-- 5
('add', 'user'),      		-- 6
('remove', 'user'),   		-- 7
('view', 'user'),     		-- 8
('list', 'user'),     		-- 9
('login', 'user'),    		-- 10
('register', 'user'), 		-- 11
('exit', 'user'),     		-- 12  
('reset', 'user'),    		-- 13
('logout', 'user'),   		-- 14
('create', 'booking'),		-- 15
('read', 'booking'),    	-- 16
('update', 'booking'),		-- 17
('delete', 'booking'),		-- 18
('add', 'booking'),     	-- 19
('remove', 'booking'),  	-- 20
('edit', 'booking'),    	-- 21
('view', 'booking'),    	-- 22
('list', 'booking'),    	-- 23
('create', 'availability'), 	-- 24
('read', 'availability'), 	-- 25
('update', 'availability'), 	-- 26
('delete', 'availability'), 	-- 27
('add', 'availability'),   	-- 28
('remove', 'availability'), 	-- 29
('edit', 'availability'),   	-- 30
('view', 'availability'),   	-- 31
('list', 'availability'),   	-- 32
('create', 'timeslots'),    	-- 33
('read', 'timeslots'),	    	-- 34
('update', 'timeslots'),    	-- 35
('delete', 'timeslots');    	-- 36


-- Sample data for the 'user' table
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `group_id`) VALUES
('Justin', 'Eberwein', 'enquiries@justbfitness.ca', '$2y$10$7RfKpmJRJ/pWF5zAuyapwOmWgPd4laVKKDaVxc4DKwafd0qXqgpjK', 2),
('Hibba', 'Qaraman', 'hibba@vanier.ca', '$2y$10$gIkG.G8ODriPXcnapgaMeey4X4Z4BT47SYobceFlBE/1F3XHKxrk.', 2),
('Nabil', 'Ramadan', 'nabil@vanier.ca', '$2y$10$icPKFq.T8slgflKEG/vMtuutIqyVlmMXE.SKR09hCDbHCOVq11seC', 2),
('Sadaf', 'Zakria', 'sadaf@vanier.ca', '$2y$10$D6uJBlcW3vVwgZY0mKIUAuEnIjNO3b7sMEzgc4cj5weuNfAMSbklK', 2),
('Peter', 'Fishman', 'peter@vanier.ca', '$2y$10$SndDQtScAkGqRUoySqPOuustv4asQzI4b5yC.dZ9s6mWeh5siwBCe', 2),
('John', 'Doe', 'john.doe@example.com', '$2y$10$utUZHQUWJ9I4zcIkMp9X/e0IkdLasHJ6yn2hVWGpUzllPcJw1kKoC', 1),
('Jane', 'Smith', 'jane.smith@outlook.com', '$2y$10$lcCHSh8bdh3GKjohujguPuYymORqy48nz/hU9zOtHds7j9Tn/0NW6', 1),
('Bob', 'Johnson', 'bob.johnson@hotmail.com', '$2y$10$L9tkbF.EqLqs9N8pYN652.ZN8/xnyKDLZu.tDtKp4INQuxy9koZVC', 1),
('Charlie', 'Brown', 'charlie.brown@gmail.com', '$2y$10$/ekwJlVsWsRtsu6wgOGoVeGsKpMna5ddpHCcNY.gwD5aMJu.1bbAa', 1),
('Alice', 'Williams', 'alice.williams@gmail.com', '$2y$10$00lUZYxzgPOWmmjEnIpeeeb1AGafmdFF/PIyUpZIvRo4mw.Zetu7.', 1);

-- Sample data for the 'group_rights' table

-- Group 1 (Client)
INSERT INTO `group_rights` (`group_id`, `rights_id`) VALUES
(1, 1),   -- create user
(1, 2),   -- read user
(1, 3),   -- update user
(1, 4),   -- delete user
(1, 5),   -- edit user
(1, 6),   -- remove user
(1, 10),  -- login user
(1, 15),  -- create booking
(1, 16),  -- read booking
(1, 18),  -- delete booking
(1, 19),  -- add booking
(1, 20),  -- remove booking
(1, 22),  -- view booking
(1, 23),  -- list booking
(1, 25),  -- read availability
(1, 31),  -- view availability
(1, 32),  -- list availability
(1, 34);  -- read timeslots

-- Group 2 (Admin)
INSERT INTO `group_rights` (`group_id`, `rights_id`) VALUES
(2, 1),   -- create user
(2, 2),   -- read user
(2, 3),   -- update user
(2, 4),   -- delete user
(2, 5),   -- edit user
(2, 6),   -- add user
(2, 7),   -- remove user
(2, 8),   -- view user
(2, 10),  -- login user
(2, 9),   -- list user
(2, 16),  -- read booking
(2, 17),  -- update booking
(2, 18),  -- delete booking
(2, 20),  -- remove booking
(2, 21),  -- edit booking
(2, 22),  -- view booking
(2, 23),  -- list booking
(2, 24),  -- create availability
(2, 25),  -- read availability
(2, 26),  -- update availability
(2, 27),  -- delete availability
(2, 28),  -- add availability
(2, 29),  -- remove availability
(2, 30),  -- edit availability
(2, 31),  -- view availability
(2, 32),  -- list availability
(2, 33),  -- create timeslots
(2, 34),  -- read timeslots
(2, 35),  -- update timeslots
(2, 36);  -- delete timeslots



-- Sample data for the 'availability' table
INSERT INTO `availability` (`available_from`, `available_to`, `day`, `user_id`) VALUES
('06:30:00', '23:30:00', 'Monday', 1);

-- Sample data for the 'timeslots' table based on the provided availability
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


-- Sample data for the 'booking' table based on the provided timeslots (only clients!!!)
INSERT INTO `booking` (`booking_date`, `appointment_date`, `timeslot_id`, `user_id`) VALUES
(NOW(), '2023-11-20', 1, 6),
(NOW(), '2023-11-21', 4, 6),
(NOW(), '2023-11-20', 6, 7),
(NOW(), '2023-11-25', 10, 7),
(NOW(), '2023-12-08', 13, 9),
(NOW(), '2023-12-21', 13, 9),
(NOW(), '2023-12-31', 13, 10);



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
