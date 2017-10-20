-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2017 at 10:37 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tech_devices_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `Departments`
--

CREATE TABLE IF NOT EXISTS `Departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `college` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Departments`
--

INSERT INTO `Departments` (`id`, `name`, `college`) VALUES
(1, 'computer science', 'SCD'),
(2, 'Statistics', 'Math'),
(3, 'Design', 'Art'),
(4, 'Econmics', 'Engineering'),
(5, 'Drama', 'Art'),
(6, 'Biology', 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `Device`
--

CREATE TABLE IF NOT EXISTS `Device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceName` varchar(20) NOT NULL,
  `deviceType` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11011017 ;

--
-- Dumping data for table `Device`
--

INSERT INTO `Device` (`id`, `deviceName`, `deviceType`, `price`, `status`) VALUES
(1, 'VGA adaptor', 'computer', 20, 'available'),
(2, 'Swagbook', 'Laptop', 6969, 'available'),
(3, 'iPad', 'Tablet', 250, 'checked ou'),
(4, 'Gameboy Color', 'computer', 5, 'checked ou'),
(5, 'Water', 'Drink', 10, 'available'),
(6, 'Iphone 10', 'Paper Weight', 1000, 'Checked-ou'),
(7, 'SNES', 'Console', 9001, 'available'),
(8, 'Charge 2', 'Fitness Tracker', 150, 'Checkout-o'),
(81, 'Charge 2', 'Fitness Tracker', 150, 'Checkout-o'),
(101101, 'Tomodachi', 'Handheld', 45, 'available'),
(11011011, 'Windows XP', 'computer', 1000, 'available'),
(11011013, '1DS', 'Handheld', 100, 'available'),
(11011016, 'Iphone 10', 'Paper Weight', 1000, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE IF NOT EXISTS `Staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`id`, `firstName`, `lastName`) VALUES
(1, 'Dave', 'Jones'),
(2, 'Dana', 'Smith');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(15) NOT NULL,
  `deptId` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20012928 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `firstName`, `lastName`, `email`, `phone`, `role`, `deptId`) VALUES
(1, 'Ana', 'Pena', 'anpena@csumb.edu', '5106754572', 'Student', 1),
(2, 'Harlan', 'Cheer', 'hcheer@csumb.edu', '6665551234', 'Student', 1),
(3, 'Westley', 'Mixon', 'Wmixon@gmail.com', '5412610792', 'Student', 1),
(4, 'John', 'Cena', 'JCena@areyousureaboutthat.com', '123-321-6534', 'Volunteer', 0),
(6, 'Utsab', 'Saha', 'utsab.k.saha@gmail.com', '510-304-1234', 'Faculty', 1),
(200, 'kyle', 'K', 'nope@gmail.com', '111-222-3333', 'student', 0),
(201, 'Augustus', 'Gloop', 'agloop@yaya.edu', '805-555-5555', 'student', 1),
(202, 'Ravi', 'Singh', 'rasingh@csumb.edu', '408-630-5681', 'Student', 1),
(203, 'Nicolas', 'Cage', 'cagerage@hotmail.com', '555-420-4589', 'Faculty', 2),
(666, 'Overlord', 'Trump', 'fakenews@aol.com', '999-999-9999', 'None', 1),
(20012883, 'Faby', 'Pena', 'faby.9467@gmai.com', '5107775643', 'Student', 3),
(20012885, 'Andrew', 'Gutierrez', 'andgutierrez@csumb.edu', '8317763710', 'Student', 1),
(20012887, 'Cthulu', 'Darklord', 'cthulu@landofsnow.com', '8315553464', 'Professor', 5),
(20012888, 'Karl', 'Marx', 'KarlMarx@ussr.com', '123-456-7890', 'Professor', 3),
(20012889, 'Your', 'Mom', 'yourMom@gmail.com', '650-833-9230', 'Mom', 3),
(20012890, 'Jason', 'Kirn', 'jkirn@csumb.edu', '650-625-0920', 'student', 2),
(20012893, 'Your', 'Mama', 'dacrib@whodis.edu', '922-801-4322', 'Faculty', 2),
(20012894, 'BillyBob', 'Thortan', 'TheBest@around.edu', '5838130014', 'Dean', 4),
(20012896, 'Pickle', 'Rick', 'XxRickPicklexX@myspace.com', '6966966969', 'Student', 6),
(20012898, 'Andrew ', 'Diesh', 'adiesh@csumb.edu', '8319177143', 'student', 1),
(20012899, 'Josh', 'Welch', 'jwelch@csumb.edu', '666-867-5309', 'Student', 1),
(20012900, 'Dominic', 'Fajilan', 'DFajilan@csumb.edu', '831-123-4567', 'Student', 1),
(20012901, 'ooo', 'bb', 'fakeemail@gmail.com', '123-456-7890', 'Student', 1),
(20012902, 'H', 'HAMM', 'h@gmail.com', '123-456-7890', 'student', 1),
(20012903, 'John', 'Doe', 'JohnDoe@gmail.com', '1-800-WHOTHIS', 'Faculty', 1),
(20012904, 'Brittany', 'Arnold', 'barnold@csumb.edu', '559-241-4391', 'Student', 1),
(20012905, 'Bob', 'Marley', 'onelove@gmail.com', '800-420-0000', 'GOAT', 1),
(20012906, 'Brock', 'Obama', 'imgoingtousemyfryingpan@adryin', '123-123-1234', 'Faculty', 2),
(20012907, 'Angel', 'Ortiz', 'aortizmedina@csumb.edu', '8311234567', 'Student', 44),
(20012908, 'Brittany', 'Arnold', 'barnold@csumb.edu', '559-241-4391', 'Student', 1),
(20012909, 'Bob', 'Marley', 'onelove@gmail.com', '800-420-0000', 'GOAT', 1),
(20012910, 'H', 'HAMM', 'h@gmail.com', '123-456-7890', 'student', 1),
(20012911, 'John', 'Doe', 'JohnDoe@gmail.com', '1-800-WHOTHIS', 'Faculty', 1),
(20012912, 'Alice', 'Smith', 'alicesmith@gmail.com', '1234567890', 'Student', 1),
(20012913, 'John', 'Doe', 'JohnDoe@gmail.com', '1-800-WHOTHIS', 'Faculty', 1),
(20012914, 'John', 'Doe', 'JohnDoe@gmail.com', '1-800-WHOTHIS', 'Faculty', 1),
(20012915, 'Rick', 'Sanchez', 'RickstheGreatest@yournot.com', '666-123-4567', 'Professor', 1),
(20012916, 'Nas', 'Escobar', 'nescobar@gmail.com', '5555555555', 'student', 6),
(20012917, 'Jason', 'Ferrer', 'jferrer@csumb.edu', '(123) 456-7890', 'student', 1),
(20012918, 'Negan', 'NoClue', 'baseballbat@glen''shead.eyepop', '(333) 333-3333', 'someone', 3),
(20012921, 'Serown', 'Kail', 'Skail@fakemail.gov', '(555)111-9999', 'Student', 5),
(20012922, 'john', 'Kedjeski', 'notMyEmail@1.fake', '389-190-7303', 'Teacher', 1),
(20012923, 'Serown', 'Kail', 'Skail@fakemail.gov', '(555)111-9999', 'Student', 5),
(20012924, 'john', 'Kedjeski', 'notMyEmail@1.fake', '389-190-7303', 'Teacher', 1),
(20012925, 'Serown', 'Kail', 'Skail@fakemail.gov', '(555)111-9999', 'Student', 5),
(20012926, 'john', 'Kedjeski', 'notMyEmail@1.fake', '389-190-7303', 'Teacher', 1),
(20012927, 'Gabe', 'Gaerlan', 'ggaerlan@csumb.edu', '777-777-7777', 'Student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `User_Device`
--

CREATE TABLE IF NOT EXISTS `User_Device` (
  `checkoutId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `deviceId` int(11) NOT NULL,
  `checkoutDate` date NOT NULL,
  `dueDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `loandedBy` smallint(6) NOT NULL,
  `receivedBy` smallint(6) NOT NULL,
  PRIMARY KEY (`checkoutId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `User_Device`
--

INSERT INTO `User_Device` (`checkoutId`, `userId`, `deviceId`, `checkoutDate`, `dueDate`, `returnDate`, `loandedBy`, `receivedBy`) VALUES
(1, 6, 2, '2017-10-10', '2017-10-18', '0000-00-00', 1, 0),
(2, 20012898, 3, '2017-10-11', '2017-10-18', '0000-00-00', 2, 0),
(3, 20012900, 7, '2017-10-10', '2018-10-10', '0000-00-00', 1, 0),
(4, 203, 6, '2017-10-10', '2017-10-17', '0000-00-00', 1, 0),
(5, 3, 2, '2017-10-10', '2017-10-17', '0000-00-00', 1, 0),
(6, 4269, 11011013, '2017-10-01', '2017-10-31', '0000-00-00', 1, 0),
(7, 20012927, 2, '2017-10-10', '2017-10-18', '2018-09-05', 1, 0),
(8, 20012907, 7, '2017-10-04', '2017-10-18', '2017-10-24', 1, 2),
(9, 4269, 11011013, '2017-10-01', '2017-10-31', '0000-00-00', 1, 0),
(10, 20012890, 7, '2017-10-10', '2017-10-24', '0000-00-00', 2, 0),
(11, 203, 6, '2017-10-10', '2017-10-17', '0000-00-00', 1, 0),
(12, 1, 1, '2017-10-18', '2017-10-24', '2017-10-19', 1, 1),
(13, 6, 3, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;