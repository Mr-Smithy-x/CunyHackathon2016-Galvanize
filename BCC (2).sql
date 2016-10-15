-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2016 at 12:06 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `BCC`
--

-- --------------------------------------------------------

--
-- Table structure for table `Announcement`
--

CREATE TABLE IF NOT EXISTS `Announcement` (
  `anmt_id` int(11) NOT NULL,
  `anmt_title` text NOT NULL,
  `anmt_content` text NOT NULL,
  `anmt_author_id` int(11) NOT NULL,
  `anmt_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `anmt_header_img` text NOT NULL,
  `anmt_gallery_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='This table is for the announcements';

--
-- Dumping data for table `Announcement`
--

INSERT INTO `Announcement` (`anmt_id`, `anmt_title`, `anmt_content`, `anmt_author_id`, `anmt_creation`, `anmt_header_img`, `anmt_gallery_id`) VALUES
(1, 'October 2 - October 8, 2016', 'No Classes On October 2, 2016, October 3, 2016 and October 4, 2016. \r\n\r\nThursday (October 6, 2016) follows a Monday Schedule. \r\n\r\nWednesday is a *Regular Wednesday* and Friday is a *Regular Friday*.', 21, '2016-09-29 21:25:35', 'http://i.imgur.com/lMQ9qvN.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Clubs`
--

CREATE TABLE IF NOT EXISTS `Clubs` (
  `club_id` int(11) NOT NULL,
  `club_title` text NOT NULL,
  `club_description` text NOT NULL,
  `club_president_id` int(11) NOT NULL,
  `club_school_code` int(11) NOT NULL DEFAULT '2692',
  `club_officer_1` int(11) NOT NULL,
  `club_officer_2` int(11) NOT NULL,
  `club_officer_3` int(11) NOT NULL,
  `club_general_email` text NOT NULL,
  `club_start` time NOT NULL DEFAULT '00:00:00',
  `club_end` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Clubs`
--

INSERT INTO `Clubs` (`club_id`, `club_title`, `club_description`, `club_president_id`, `club_school_code`, `club_officer_1`, `club_officer_2`, `club_officer_3`, `club_general_email`, `club_start`, `club_end`) VALUES
(1, 'Computer Science', 'Join the computer science club today!', 1, 2692, 2, 3, 4, 'CharltonSmith@outlook.com', '12:00:00', '14:00:00'),
(2, 'Film & Media', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 5, 2692, 3, 4, 1, '', '12:00:00', '14:00:00'),
(3, 'Drama & Dancing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 2692, 1, 3, 4, 'loremipsum@bcc.cuny.edu', '12:00:00', '14:00:00'),
(4, 'Music Club', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 2692, 4, 3, 2, 'CharltonSmith@outlook.com', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Majors`
--

CREATE TABLE IF NOT EXISTS `Majors` (
  `major_id` int(11) NOT NULL,
  `major_title` text NOT NULL,
  `major_category` enum('ART','MEDICAL','SOCIAL','SCIENCE','HISTORY','MATH','BUSINESS','ENGLISH','ENGINEERING') NOT NULL,
  `major_file_link` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COMMENT='Table for majors';

--
-- Dumping data for table `Majors`
--

INSERT INTO `Majors` (`major_id`, `major_title`, `major_category`, `major_file_link`) VALUES
(1, 'Computer Science', 'SCIENCE', 'http://www.bcc.cuny.edu/degree-programs/degrees/as/computer_science_as.pdf'),
(2, 'Mathematics', 'MATH', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AS/mathematics_as.pdf'),
(3, 'Engineering Science', 'SCIENCE', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AS/engineering_science_as.pdf'),
(4, 'Business Administration: Computer Programming', 'BUSINESS', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AS/business_administration_as.pdf'),
(5, 'Computer Information Systems', 'BUSINESS', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/computer_information_systems_aas.pdf'),
(6, 'Computer Information System: Computer Programming', 'BUSINESS', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/computer_information_systems_aas.pdf'),
(7, 'Computer Information Systems: Web Development', 'BUSINESS', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/computer_information_systems_aas.pdf'),
(8, 'Electronic Engineering', 'ENGINEERING', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/electronic_engineering_technology_aas.pdf'),
(9, 'Telecommunications Technology', 'ENGINEERING', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/telecommunications_technology_aas.pdf'),
(10, 'Digital Arts: Graphic Design', 'ART', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/digital_arts_aas.pdf'),
(11, 'Digital Arts: Web Design', 'ART', 'http://www.bcc.cuny.edu/Degree-Programs/degrees/AAS/digital_arts_aas.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `ScheduleDates`
--

CREATE TABLE IF NOT EXISTS `ScheduleDates` (
  `schd_id` int(11) NOT NULL,
  `schd_start_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `schd_end_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `schd_title` text,
  `schd_description` text,
  `location` text NOT NULL,
  `schd_article_id` int(11) DEFAULT '0',
  `schd_link` text,
  `schd_image` text
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ScheduleDates`
--

INSERT INTO `ScheduleDates` (`schd_id`, `schd_start_date`, `schd_end_date`, `schd_title`, `schd_description`, `location`, `schd_article_id`, `schd_link`, `schd_image`) VALUES
(1, '2016-10-02 00:00:00', '2016-10-04 23:59:59', 'No Class', 'No Classes Scheduled\n- Rosh Hashana ', '', 0, NULL, NULL),
(2, '2016-10-02 00:00:00', '2016-10-02 23:59:59', 'No Class', 'No Classes Scheduled - Islamic New Year', '', 0, NULL, NULL),
(4, '2016-10-06 00:00:00', '2016-10-06 23:59:59', 'Monday Schedule', 'Classes Follow A Monday Schedule', '', 0, NULL, NULL),
(5, '2016-10-10 00:00:00', '2016-10-10 23:59:59', 'No Classes Scheduled', 'Columbus Day', '', 0, NULL, NULL),
(6, '2016-10-11 00:00:00', '2016-10-11 23:59:59', 'No Classes Scheduled', 'No Classes Scheduled\r\n- Asura', '', 0, NULL, NULL),
(7, '2016-10-12 00:00:00', '2016-10-12 23:59:59', 'No Classes Scheduled', 'Yom Kippur', '', 0, NULL, NULL),
(8, '2016-10-13 00:00:00', '2016-10-20 23:59:59', 'MidTerm Exams!', 'Mid Term Examination period!', '', 0, 'https://www.bcc.cuny.edu/collegecalendar/?dMode=m&vDate=10/13/2016', 'http://i.imgur.com/lwB2GmG.png'),
(9, '2016-10-14 00:00:00', '2016-10-14 23:59:59', 'Tuesday Schedule', 'Classes follow a Tuesday schedule', '', 0, NULL, 'http://i.imgur.com/fMB9vga.png'),
(10, '2016-10-20 12:00:00', '2016-10-20 14:00:00', 'IOC Meeting!', '12:00 PM - 2:00 PM\nIOC Meeting Roscoe C. Brown Student Center Room 310', 'Roscoe C. Brown Student Center Room 310', 0, NULL, 'http://i.imgur.com/i7hIlEg.png'),
(11, '2016-11-24 00:00:00', '2016-11-27 00:00:00', 'College Closed', 'College Closed No School', '', 0, NULL, NULL),
(12, '2016-11-10 00:00:00', '2016-11-10 23:59:59', 'Last Day', 'Last day to withdraw from a course with a grade of W', '', 0, NULL, NULL),
(13, '2016-10-27 12:00:00', '2016-10-27 15:00:00', 'Academic & Professional Development Fair', 'Academic & Professional Development Fair Colston Hall Lower Level', 'Colston Hall Lower Level', 0, NULL, NULL),
(14, '2016-10-16 12:00:00', '2016-10-16 16:00:00', 'Architecture & Arts Festival', 'Architecture & Arts Festival/Open House New York (This event is free and open to the public) RSVP at www.bcc.cuny.edu/ArchFest)', '', 0, 'http://www.bcc.cuny.edu/ArchFest', 'https://www.bcc.cuny.edu/Support-BCC/images/events/archFest-2016.jpg'),
(15, '2016-10-20 12:00:00', '2016-10-20 13:50:00', 'Faculty Council', 'Faculty Council', 'Meister Hall Room 228', 0, NULL, NULL),
(16, '2016-10-21 14:00:00', '2016-10-21 16:00:00', 'Student Government Association', 'Student Government Association ', 'Roscoe C. Brown Student Center Room 306', 0, NULL, NULL),
(17, '2016-10-24 16:00:00', '2016-10-24 17:30:00', 'Governance and Elections', 'Governance and Elections', 'Polowczyk Hall Room 321', 0, NULL, NULL),
(18, '2016-12-13 00:00:00', '2016-12-13 23:59:59', 'Reading Day', 'Reading Day', '', 0, NULL, NULL),
(19, '2016-12-14 00:00:00', '2016-12-21 23:59:59', 'Final Examinations', 'Final Examinations - Day/Evening\r\nFinal Examinations - Weekends', '', 0, NULL, NULL),
(20, '2016-12-21 00:00:00', '2016-12-21 23:59:59', 'End Of Semester', 'End of Semester, Woohoo!', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `School`
--

CREATE TABLE IF NOT EXISTS `School` (
  `school_id` int(11) NOT NULL,
  `school_code` int(11) NOT NULL,
  `school_name` text NOT NULL,
  `school_lat` float NOT NULL,
  `school_lng` float NOT NULL,
  `school_address` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `School`
--

INSERT INTO `School` (`school_id`, `school_code`, `school_name`, `school_lat`, `school_lng`, `school_address`) VALUES
(1, 2692, 'Bronx Community College', 40.8565, 73.9106, '2155 University Ave, Bronx, NY 10453'),
(2, 2691, 'Borough Manhattan Community College', 40.7188, 74.0119, '199 Chambers St, New York, NY 10007'),
(3, 7273, 'Baruch College', 40.7402, 73.9834, '55 Lexington Ave, New York, NY 10010'),
(4, 2687, 'Brooklyn College', 40.631, 73.9544, '2900 Bedford Ave, Brooklyn, NY 11210'),
(5, 2688, 'City College', 40.82, 73.9493, '160 Convent Ave, New York, NY 10031'),
(6, 2698, 'College of Staten Island', 40.6018, 74.1485, '2800 Victory Boulevard, Staten Island, NY 10314'),
(7, 2689, 'Hunter College', 40.7685, 73.9657, '695 Park Ave, New York, NY 10065'),
(8, 2696, 'New York City College of Technology', 40.6955, 73.9875, '300 Jay St, Brooklyn, NY 11201');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(11) NOT NULL COMMENT 'User id',
  `user_firstname` varchar(30) NOT NULL COMMENT 'First name',
  `user_lastname` varchar(30) NOT NULL COMMENT 'Last name',
  `user_email` varchar(255) NOT NULL COMMENT 'User''s email',
  `user_password` varchar(255) NOT NULL,
  `user_profile_photo` varchar(200) NOT NULL DEFAULT 'http://www.myatithi.com/images/profile_placeholder.png',
  `user_splash_photo` varchar(200) NOT NULL DEFAULT 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg',
  `user_phone` varchar(255) NOT NULL COMMENT 'User''s phone #',
  `user_act_key` varchar(255) NOT NULL COMMENT 'User act key, could be used for security measures',
  `user_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The date they signed up',
  `user_permission` enum('USER','EDITOR','MODERATOR','ADMIN','PROFESSOR') NOT NULL DEFAULT 'USER' COMMENT 'Their role',
  `user_school_code` int(11) NOT NULL,
  `user_major_id` int(11) NOT NULL,
  `user_club_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='This is the user table';

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_profile_photo`, `user_splash_photo`, `user_phone`, `user_act_key`, `user_creation`, `user_permission`, `user_school_code`, `user_major_id`, `user_club_id`) VALUES
(1, 'Charlton', 'Smith', 'charltonsmith@outlook.com', 'BPejJjdutiOwUhcNRfkFbg==', 'http://www.myatithi.com/images/profile_placeholder.png', 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg', '9142948648', '0cd45aeb0405b978aa16364274553e52', '2016-10-15 22:05:11', 'USER', 2692, 1, 1),
(2, 'Cj', 'Smith', 'charltonsmith4@gmail.com', 'YBQbgBJmwH+4tkNn4pbXEw==', 'http://www.myatithi.com/images/profile_placeholder.png', 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg', '9142948648', '2f6f2945aaf7691ea84f042c6b156d43', '2016-10-15 17:39:52', 'USER', 2691, 0, 2),
(3, 'Charles', 'Smith', 'dudek12l@gmail.com', 'SwvQV6+rvSw0lNWPk3Lyiw==', 'http://www.myatithi.com/images/profile_placeholder.png', 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg', '9142948648', 'dbac5bfdb52512373cc38f5192110e03', '2016-10-15 17:39:58', 'USER', 2692, 0, 1),
(4, 'Chap', 'man', 'dudek13l@gmail.com', 'SwvQV6+rvSw0lNWPk3Lyiw==', 'http://www.myatithi.com/images/profile_placeholder.png', 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg', '9142948648', '92581d01f82a94984b7e000dca595a9a', '2016-10-15 17:40:01', 'USER', 7273, 0, 3),
(5, 'George', 'Washington', 'charltonsmith@rentah.com', 'LJX6q7PavwFSdxPawaG8Qw==', 'http://www.myatithi.com/images/profile_placeholder.png', 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg', '9142948648', 'f04ea18b566f3e05ca32bb562f270a69', '2016-10-15 17:39:47', 'USER', 2687, 0, 1),
(29, 'abobakr', 'bin alhag', 'abobakrbin@gmail.com', '02cWm9Nta+e72VUSnukvTQ==', 'http://www.myatithi.com/images/profile_placeholder.png', 'https://writingcommunitycollege.files.wordpress.com/2014/10/img_2710.jpg', '9293407140', 'dfe064033103fc4a8d2db68a6a553923', '2016-10-15 21:36:30', 'USER', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Announcement`
--
ALTER TABLE `Announcement`
  ADD PRIMARY KEY (`anmt_id`);

--
-- Indexes for table `Clubs`
--
ALTER TABLE `Clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `Majors`
--
ALTER TABLE `Majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `ScheduleDates`
--
ALTER TABLE `ScheduleDates`
  ADD PRIMARY KEY (`schd_id`);

--
-- Indexes for table `School`
--
ALTER TABLE `School`
  ADD PRIMARY KEY (`school_id`),
  ADD UNIQUE KEY `school_code` (`school_code`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Announcement`
--
ALTER TABLE `Announcement`
  MODIFY `anmt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Clubs`
--
ALTER TABLE `Clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Majors`
--
ALTER TABLE `Majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ScheduleDates`
--
ALTER TABLE `ScheduleDates`
  MODIFY `schd_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `School`
--
ALTER TABLE `School`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User id',AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
