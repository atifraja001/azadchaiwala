-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 03:42 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azadchaiwala_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_students` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `course_id`, `name`, `start_date`, `end_date`, `start_time`, `end_time`, `total_students`, `created_at`) VALUES
(2, 1, 'March 2020', '2020-02-01', '2020-03-31', '09:00:00', '13:00:00', 10, '2020-01-06 06:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `order_number` smallint(6) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `course_picture` varchar(100) NOT NULL,
  `youtube_embed` text NOT NULL,
  `lecture_hours_per_day` int(11) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `fee` int(11) NOT NULL,
  `course_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `order_number`, `teacher_id`, `course_name`, `slug`, `course_picture`, `youtube_embed`, `lecture_hours_per_day`, `duration`, `semester`, `fee`, `course_description`, `created_at`) VALUES
(1, 1, 4, 'PHP Programming', 'php-programming', '123123123123.jpg', '', 4, '2 Months', '2 (One Month Each)', 200000, 'We all use websites and majority of these websites are built in PHP. Thus making PHP the Internets most favorite programming language. This course is for those wanting to start at a beginner level and work their way up to a mid level programmer. A junior PHP developer can easily get a job for 30,000 Rupees per month and a medium level developer in excess of 45,000 rupees per month.\r\n\r\nAny senior web developer will tell you that you can learn programming in 40 one hour lessons, but we are offering you over 175 hours of mentor-ship and hands on training.', '2020-01-01 10:10:32'),
(2, 2, 2, 'VIDEO EDITING, VIDEOGRAPHY &amp; FREELANCING', 'video-editing-videography-freelancing', '157803630016669984705e0eec4b7dbc1.jpg', '', 4, '2 Weeks', '2 (One Week Each)', 40000, 'We take you from a beginner to medium level video editor and by becoming a Video Editor/Videographer, within 14 days you will be ready to run your own social media video production business, be it making videos for clients or running your own YouTube Channel. A Video Editor with Medium to advance level skills can easily get a job for 25,000-40,000 Rupees per month in Pakistan or earn in excess of 45,000 per month as a half decent freelancer.', '2020-01-03 07:24:59'),
(3, 3, 3, 'GRAPHIC DESIGNING', 'graphic-designing', '15780437553472835675e0f096ad458c.jpg', '', 4, '5 Weeks', '5 (One Week Each)', 40000, 'We all use websites and majority of these websites are built in PHP. Thus making PHP the Internets most favorite programming language. This course is for those wanting to start at a beginner level and work their way up to a mid level programmer. A junior PHP developer can easily get a job for 30,000 Rupees per month and a medium level developer in excess of 45,000 rupees per month.\r\n\r\nAny senior web developer will tell you that you can learn programming in 40 one hour lessons, but we are offering you over 175 hours of mentor-ship and hands on training.', '2020-01-03 09:29:14'),
(4, 4, 5, 'REACT NATIVE APP DEVELOPMENT', 'react-native-app-development', '15789802837103749365e1d53bab5a6e.jpg', '', 4, '2 Months', '2(One month each)', 200000, 'We all use apps and now you can learn how to develop apps of your own, we will teach you to React Native so you can make apps for both Android &amp; iOS. Mid-level skillset App developers can easily expect a starting salary of 40,000 Rupees per month.', '2020-01-14 05:38:02'),
(5, 5, 6, 'SEARCH ENGINE OPTIMIZATION (SEO) COURSE', 'search-engine-optimization-seo-course-', '15789804672929037285e1d54730e255.jpg', '', 4, '3 Weeks', '3 (one week each)', 40000, 'Learn both free and paid online digital marketing &amp; social media marketing. A medium level digital marketing expert can easily get a job for minimum 25,000 Rupees per month. Expert digital marketers can sell their skills online for a lot higher.', '2020-01-14 05:41:07'),
(6, 6, 7, 'GAME DEVELOPMENT', 'game-development', '157898080549222945e1d55c527047.jpg', '', 4, '4 Months', '4 (one each month)', 400000, 'We will teach you how to develop games in UNITY 3D. Almost 50% of all games on the Android and Apple App stores are made with Unity. A mid level game developer can easily get a salary of 50,000 Rupees per month in Pakistan.', '2020-01-14 05:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `id` bigint(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `content_title` text NOT NULL,
  `duration` varchar(100) NOT NULL,
  `content_description` text NOT NULL,
  `position` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_content`
--

INSERT INTO `course_content` (`id`, `course_id`, `content_title`, `duration`, `content_description`, `position`, `created_at`) VALUES
(2, 1, 'Introduction', '5 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;How The Internet Works&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Web Servers&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Cloud Servers&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Network Basics&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;SVN, Git and GitHub&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2020-01-02 07:29:27'),
(4, 1, 'Document Markup (HTML &amp; CSS)', '16 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Markup Languages&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Creating &amp;amp; Saving HTML Files&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Page Layout&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Text Layout&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Navigation&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Graphics&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Tables &amp;amp; Divs&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Forms&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Canvas&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Media Support&amp;nbsp;&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Mobile Device Support (Compatibility)&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Tags to Avoid&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Rule Structure&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Layout Formatting&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Font and Text Decoration&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Responsive Styling&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 2, '2020-01-02 12:17:47'),
(5, 1, 'Scripting Languages (JavaScript &amp; PHP)', '23 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Server-Side and Client-Side Scripting&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Creating PHP Files&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;PHP Errors&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;PHP Output&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Data Storage&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Data Manipulation&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Email&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;File Interaction&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Structures&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Security&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Functions&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Objects and Classes&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;JavaScript Syntax&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;JavaScript Examples&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;jQuery&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 3, '2020-01-02 12:18:24'),
(6, 1, 'Persistent Data Storage', '10 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Database Types&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Data Relationships&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;MySQL Data Types&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Security&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Normalization&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;MySQL CRUD Action&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Advanced Queries&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 4, '2020-01-02 12:18:56'),
(7, 1, 'Capstone Project', '6 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Security&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Integration Examples&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Finishing Touches&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Final Project&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 5, '2020-01-02 12:19:37'),
(9, 2, 'Shoot a portfolio video for freelancing sites.', '1 Hour', '&lt;ul&gt;\r\n&lt;li&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Students will learn how to make their own portfolio video for freelancing sites also remove their &quot;camera shyness&quot;.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2020-01-03 09:13:13'),
(10, 2, 'How to begin using the software, how to setup and save first template.', '30 Minutes', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Project settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Project file auto save settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to save manually project file&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to export project files.&lt;/li&gt;\r\n&lt;/ul&gt;', 2, '2020-01-03 09:13:39'),
(11, 2, 'How to Use Timelines for video', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Sequence settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Tools that are used in timelines&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to import footage into timelines&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Different sizes/resolution sequence settings (like Facebook, YouTube, Instagram) etc.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to export video in different formats, settings &amp;amp; sizes.&lt;/li&gt;\r\n&lt;/ul&gt;', 3, '2020-01-03 09:14:09'),
(12, 2, 'How to add Transition Effects', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Where we need and don\'t need transition effects.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to apply transitions&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to create your own transitions.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use external or 3rd party transitions&lt;/li&gt;\r\n&lt;/ul&gt;', 4, '2020-01-03 09:14:43'),
(13, 2, 'Jump Cuts', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What are jump cuts, does &amp;amp; donts of jump cuts.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add jump cuts into your videos.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How stabilize a video.&lt;/li&gt;\r\n&lt;/ul&gt;', 5, '2020-01-03 09:15:24'),
(14, 2, 'What are Overlays and How to Use Overlays in timelines', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What are overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add multiple overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Why we need overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to activate/deactivate specific overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add logos inside a video.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to remove watermark &amp;amp; logo from videos.&lt;/li&gt;\r\n&lt;/ul&gt;', 6, '2020-01-03 09:15:43'),
(15, 2, 'Adding Text and Titles into videos', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add titles in to videos&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to animate titles and text&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add lower thirds (preset text animations)&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to play around with the size, shadows, strokes settings to enhance Texts &amp;amp; Titles.&lt;/li&gt;\r\n&lt;/ul&gt;', 7, '2020-01-03 09:16:12'),
(16, 2, 'Practical Demonstration of recording devices &amp; microphones', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Lapel microphones&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Rode microphones&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use of digital recording devices&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Different useful setting of recording devices&lt;/li&gt;\r\n&lt;/ul&gt;', 8, '2020-01-03 09:16:43'),
(17, 2, 'Adding voice overs, background music &amp; synchronizing recorded audio with footage', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to record voice overs&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add your own voice over in to the video&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How add background music into the videos&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to buy music or use free resources to attain music for your videos.&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YT Channel: Cinematic Sounds&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YT Channel: No Vlog No Copyright Music&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YT Channel: The Best Free Music&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YouTube Library&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to adjust sound settings.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;how to record sound externally from recorder&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;how to synchronize external audio with camera recorded audio&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to reduce audio noise.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to boost volume 10x&lt;/li&gt;\r\n&lt;/ul&gt;', 9, '2020-01-03 09:17:11'),
(18, 2, 'How to record &amp; edit multiple camera videos', '1.5 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to open multiple camera settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to change the angle from 1 camera to another&lt;/li&gt;\r\n&lt;/ul&gt;', 10, '2020-01-03 09:17:59'),
(19, 2, 'Motion Tracking', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is motion tracking&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Why and where we use motion tracking&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to blur and track faces automatically&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is keyframing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use keyframing&lt;/li&gt;\r\n&lt;/ul&gt;', 11, '2020-01-03 09:18:40'),
(20, 2, 'Green Screen (Chroma Keying)', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to setup a green screen&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;One video will be made live in front of students to be used in teaching.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to remove the background&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add an alternative background.&lt;/li&gt;\r\n&lt;/ul&gt;', 12, '2020-01-03 09:18:55'),
(21, 2, 'Colour correction &amp; color grading', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to deal with over or underexposed footage&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to change the mood of video by adding color grading&lt;/li&gt;\r\n&lt;/ul&gt;', 13, '2020-01-03 09:19:10'),
(22, 2, 'Practical Demonstration of different types of lights &amp; reflector setups', '1.5 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Knowledge of good lighting setups for videos&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of soft boxes&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of on camera &amp;amp; off camera flash lights&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of external subject lighting using LED &amp;amp; Ring lights.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use light reflectors &amp;amp; light modifier&lt;/li&gt;\r\n&lt;/ul&gt;', 14, '2020-01-03 09:19:32'),
(23, 2, 'Practical knowledge of DSLR cameras', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Hands on demo of Nikon &amp;amp; Canon DSLR cameras&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Most commonly used settings of DSLR cameras, such as Iso, Shutter speed, Aperture etc&lt;/li&gt;\r\n&lt;/ul&gt;', 15, '2020-01-03 09:20:12'),
(24, 2, 'Basic Knowledge of camera lenses', '1.5 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Nikon lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Canon lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is meant by f stops on lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is meant by mm on lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Differences between wide angle, pancake, telephoto lenses etc and their best usage.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use lenses on automatic and manual settings.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Difference between tele wide lenses and prime lenses.&lt;/li&gt;\r\n&lt;/ul&gt;', 16, '2020-01-03 09:20:30'),
(25, 2, 'Demonstration of DSLR, Drone &amp; Mobile Gimbals', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is a Gimbal&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use mobile/DSLR gimbals&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of gimbals&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Demonstration of &quot;How to fly a Drone?&quot;.&lt;/li&gt;\r\n&lt;/ul&gt;', 17, '2020-01-03 09:20:51'),
(26, 2, 'Demonstration of Teleprompter', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is a teleprompter&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to setup a teleprompter&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Practical demo and usage of teleprompter.&lt;/li&gt;\r\n&lt;/ul&gt;', 18, '2020-01-03 09:21:12'),
(27, 2, 'How to Film &amp; become a social media star.', '1.5 Hours', '&lt;ul&gt;\r\n&lt;li&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;4 of the most commonly used filming techniques to achieve cinematic look.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 19, '2020-01-03 09:21:54'),
(28, 2, 'Setting up your own YouTube channel.', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Max 3 minute video that students have made with all new skills learned.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Students will open their own YouTube channels and upload their first videos.&lt;/li&gt;\r\n&lt;/ul&gt;', 20, '2020-01-03 09:22:07'),
(29, 2, 'Lecture on how to use video editing skills to earn money.', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Learn how to use your newly learned skills to earn money&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How freelancing works&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Setup your first freelancer account.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;We tell you what kind of order description you get from clients&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Demonstrate to work on clients order descriptions&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to follow the order description&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Things which banned you permanently from freelancing sites.&lt;/li&gt;\r\n&lt;/ul&gt;', 21, '2020-01-03 09:22:25'),
(30, 2, 'Record and Edit Videos of:', '3 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to make CLONE or duplicate (Example: Showing twins in same frame).&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to make GHOST effect (Example: Transparent Ghost in horror movies).&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Sky replacement.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to make time lapsed video.&lt;/li&gt;\r\n&lt;/ul&gt;', 22, '2020-01-03 09:22:42'),
(31, 3, 'PhotoShop', '10 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Basics of Photoshop&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Introduction&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Background Removal&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Color Grading&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Change any Product Color&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Retouching&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Image Composition&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Making Mock-ups&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Use of brushes $ affects&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Working with Selections&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Scaling&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Knowing the Layers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Color Adjustments&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Output&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Settings&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2020-01-03 09:29:57'),
(32, 3, 'Corel DRAW &amp; Adobe Illustrator', '14 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Getting Started with Corel DRAW &amp;amp; Adobe Illustrator&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Introduction&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Tools &amp;amp; Techniques&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Types of logo&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Stationary Design&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Brochure, Banner, Leaflet.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;T-shirt Designing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Panaflex Printing&lt;/li&gt;\r\n&lt;/ul&gt;', 2, '2020-01-03 09:30:16'),
(33, 3, 'Graphic Drawing Tablet', '5 Days', '&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Learning to use graphic drawing tablets will give you an advantage over others in the job and freelancing marketplace. This skill will allow you to hand-draw images and graphics with the aid of a special pen-like stylus, similar to the way a person draws images with a pencil on paper. You will be able to make unique graphics such as logos, mascots &amp;amp; in game graphics that cannot be purchased or found anywhere else in the world.&lt;/span&gt;&lt;/p&gt;', 3, '2020-01-03 09:30:32'),
(34, 3, 'Capstone Project', '4 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Client Brief&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Content and Graphics&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Marketing Plan&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Look and feel&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printing &amp;amp; Scanning&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Types of Printers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printing Concepts&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printing Technologies&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printer Paper&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Post Press Print Project Finishing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Scanning&lt;/li&gt;\r\n&lt;/ul&gt;', 4, '2020-01-03 09:30:54'),
(35, 0, '01:00', ' 1', '', 0, '2020-01-03 12:16:03'),
(36, 6, 'Unity Engine overview', '1 Day', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Unity overview&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Engine Installation&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Making of 1st project&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2020-01-14 05:47:41'),
(37, 6, 'Introduction to programming language', '3 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Beginner C# concepts, like variables, &quot;if&quot; statements, arrays,loops cases and Methods.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;brief overview of OOP like encapsulation, polymorphism, abstraction and inheritance.&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2020-01-14 05:48:15'),
(38, 6, 'Learning about the The Unity Editor and Gameobject', '7 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Unity overview&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Engine Installation&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Making of 1st project&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Unity\'s Component System&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Unity Built in methods&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Scripts as Components&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Debugging a Unity Script in MonoDevelop&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Colliders and Physics Materials,&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Prefabs&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Booleans&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;If Statements&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Switch Statements&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Timer&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Spawning&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Tagged&lt;/li&gt;\r\n&lt;/ul&gt;', 3, '2020-01-14 05:48:39'),
(39, 6, 'Creating a GameScene', '1 Day', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;On provided problem statement.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Critical thinking&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Brainstorming&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Cognitive learning&lt;/li&gt;\r\n&lt;/ul&gt;', 4, '2020-01-14 05:49:06'),
(40, 6, 'Unity Input', '1 Day', '&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;In this module, you\'ll learn how we can process user input in our Unity games.&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Mouse Location Processing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Working for the Clampdown&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Keyboard Processing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Gamepad Processing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Spawn and Explode&lt;/li&gt;\r\n&lt;/ul&gt;', 5, '2020-01-14 05:49:29');
INSERT INTO `course_content` (`id`, `course_id`, `content_title`, `duration`, `content_description`, `position`, `created_at`) VALUES
(41, 6, 'Data Structures &amp; First Project in Unity', '5 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Arrays,&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Lists&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Iteration&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Unity overview&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Engine Installation&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Making of 1st project&lt;/li&gt;\r\n&lt;/ul&gt;', 6, '2020-01-14 05:49:54'),
(42, 6, 'Abstraction and Console App Classes', '2 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Abstraction in Code&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Designing the Class&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Fields and Properties&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;One Constructor&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Another Constructor&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Method&lt;/li&gt;\r\n&lt;/ul&gt;', 7, '2020-01-14 05:50:22'),
(43, 6, 'Methods and Unity Classes', '4 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Method Headers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Parameters and How They Work&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Passing Objects as Parameters&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Designing the Class&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Fields and Properties&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Methods&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Using in a Game&lt;/li&gt;\r\n&lt;/ul&gt;', 7, '2020-01-14 05:50:53'),
(44, 6, 'Strings, Text IO, and Audio', '3 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;The Char Data Type&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;String Basics&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;String Operations&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Text Output&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Text Input&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Audio Basics&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Adding an Audio Manager&lt;/li&gt;\r\n&lt;/ul&gt;', 9, '2020-01-14 05:51:22'),
(45, 6, 'Exceptions and File IO', '5 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What Are Exceptions?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Exception Handlers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Streams&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Text Files&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Game Configuration Data Files&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Using Game Configuration Data&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;PlayerPrefs&lt;/li&gt;\r\n&lt;/ul&gt;', 10, '2020-01-14 05:51:49'),
(46, 6, 'Inheritance and Polymorphism', '5 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What Is Polymorphism?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Family and Polymorphism&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Money and Polymorphism&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;The MonoBehaviour Class&lt;/li&gt;\r\n&lt;/ul&gt;', 11, '2020-01-14 05:52:22'),
(47, 6, 'Event Handling and Menus', '3 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Delegates and Event Handlers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;UnityEvent and UnityAction&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Adding an Event Manager&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Refactoring Teddy Bear Destruction&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Menu Buttons&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Adding a Simple Menu System&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Adding a Menu Manager&lt;/li&gt;\r\n&lt;/ul&gt;', 12, '2020-01-14 05:52:54'),
(48, 6, 'Design Patterns', '5 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Game Loop and Update Method&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Component&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Prototype&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Singleton&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Observer&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Mediator&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Object Pool&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;State&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Strategy&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Template Method&lt;/li&gt;\r\n&lt;/ul&gt;', 13, '2020-01-14 05:53:19'),
(49, 6, 'Individual Project', '13 Days', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Play Services &amp;amp; Ads Implementations&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Selection &amp;amp; presentation of final project&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Project Mentoring&amp;nbsp;&lt;/li&gt;\r\n&lt;/ul&gt;', 14, '2020-01-14 05:53:55'),
(50, 5, 'Scope of SEO Training Program', '30 Minutes', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Willing To Bring Top Ten Ranking in Search Engine (Google Yahoo and Bing)?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Thinking To Bring Thousands of Visitors on Your Website Daily?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Make Money Online sitting at home or own software house?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Looking For a Part Time Job?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Thinking to Start Your Online / Virtual / Website Businesses?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Looking for an Increase in Your Monthly and Annual Income?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Secure Your Future with Digital Marketing?&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;span style=&quot;box-sizing: border-box; font-weight: bolder; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What you will learn (Introduction) (30 Mins)&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What exactly is SEO and why do we need it?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How important is it to be on first page of SERPs&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Types of SEO&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How Search Engine Works?&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Website Analysis&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO with wordpress&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Google Ranking Factors&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2020-01-14 06:11:31'),
(51, 5, 'Keyword Research, Plugins for SEO', '1 Hour', '&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Types of Keywords and their importance&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Long-tail keywords&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Short Tail Keyword&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;LSI Keywords&lt;/li&gt;\r\n&lt;/ul&gt;', 2, '2020-01-14 06:12:04'),
(52, 5, 'Learning About Free Tools', '3 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Analytics&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Keyword Planner&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Website Analysis Tools&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Trend Analysis Tools&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Related keyword research tools&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Google Alerts&lt;/li&gt;\r\n&lt;/ul&gt;', 3, '2020-01-14 06:12:35'),
(53, 5, 'Onpage SEO', '3 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Website Structure Optimization&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Plan the hierarchy before developing the website&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Base your URL structure on the navigational hierarchy&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Use a wide-ranging internal linking structure&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Content Optimization&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Image Optimization&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Meta tag creation &amp;amp; optimization&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Sitemap creation&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Analytics Setup &amp;amp; Monitoring&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Robots.txt Optimization&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Google Analytics setup and management&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Keyword Density&lt;/li&gt;\r\n&lt;/ul&gt;', 4, '2020-01-14 06:12:59'),
(54, 5, 'Offpage SEO', '8 Hours', '&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Introduction to PA DA and PR What is off site optimization Off site factors&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Google Base Optimization (Google My Business)&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Reputation building&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Link Building&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Outbound Links&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Backlinks&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Article submission&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Press Release Creation&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Blog commenting&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Forum posting&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Search Engine Submission&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Reviews Link building&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Broken Link building&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Profile Link Building&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Guest Posting&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Classified ads&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Reciprocal Links&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Private Blog Network&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Photo Sharing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Video submission sites&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Slide submission sites&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Local Listings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Answer Questions&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Content Marketing Dos and Donts of Link Building Content Repurposing&lt;/li&gt;\r\n&lt;/ul&gt;', 5, '2020-01-14 06:13:54'),
(55, 5, 'Enable browser caching', '5 Hours', '&lt;ol style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Make Sure Your Website is Mobile-Friendly Googles Mobile-Friendly Test\r\n&lt;ul style=&quot;box-sizing: border-box; margin: 0px; list-style: outside none none; padding: 0px;&quot;&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;HubSpot Website Grader&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Bings Mobile Friendliness Test Tool&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;GTMetrix&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Create and Optimize Your XML Sitemap&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Once youve created the sitemap submit it to Google via Google Search Console. Login to your Google Search Console account and navigate to Sitemaps -&amp;gt; Add a new sitemap and then hit Submit.&lt;/span&gt;&lt;/p&gt;\r\n&lt;ol style=&quot;box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Page Speed Analysis (GTMetrix / YSlow / Google Page Speed)&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Optimize your site\'s images&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Enable browser caching This lets you temporarily store some data on a visitor\'s computer so they don\'t have to wait for it to load every time they visit your site.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Enable compression Enabling compression on your website can reduce HTML and CSS files by 50-70% and increase site speed significantly.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Optimize Internal Links&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Include Your Main Keywords in Image Alt Text&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Install an SSL Certificate for Your Website&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Google confirmed back in 2014 that SSL certificates aka HTTPS encryptions are now a ranking signal.&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul style=&quot;box-sizing: border-box; margin: 0px; list-style: outside none none; padding: 0px; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;URL Architecture&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Broken links&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;301 redirects&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box;&quot;&gt;Custom 404 Error pages&lt;/li&gt;\r\n&lt;/ul&gt;', 6, '2020-01-14 06:14:44'),
(56, 5, 'Technical Website Optimization', '5 Hours', '&lt;p&gt;&lt;span style=&quot;box-sizing: border-box; font-weight: bolder; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Make Sure Your Website is Mobile-Friendly&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Googles Mobile-Friendly Test&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;HubSpots Website Grader&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Bings Mobile Friendliness Test Tool&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;GTMetrix&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&lt;span style=&quot;box-sizing: border-box; font-weight: bolder;&quot;&gt;Create and Optimize Your XML Sitemap&lt;/span&gt;\r\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 26px;&quot;&gt;Once youve created the sitemap submit it to Google via Google Search Console. Login to your Google Search Console account and navigate to Sitemaps -&amp;gt; Add a new sitemap and then hit Submit.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Page Speed Analysis (GTMetrix / YSlow / Google Page Speed)&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Enable browser caching\r\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 26px;&quot;&gt;This lets you temporarily store some data on a visitors computer so they dont have to wait for it to load every time they visit your site.&lt;/p&gt;\r\n&lt;span style=&quot;box-sizing: border-box; font-weight: bolder;&quot;&gt;Enable compression&lt;/span&gt;\r\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 26px;&quot;&gt;Enabling compression on your website can reduce HTML and CSS files by 50-70% and increase site speed significantly.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Optimize Internal Links&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Include Your Main Keywords in Image Alt Text&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Install an SSL Certificate for Your Website&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&lt;span style=&quot;box-sizing: border-box; font-weight: bolder;&quot;&gt;Google confirmed back in 2014 that SSL certificates aka HTTPS encryptions are now a ranking signal.&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;URL Architecture&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Broken links&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;301 redirects&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Custom 404 Error pages&lt;/li&gt;\r\n&lt;/ul&gt;', 7, '2020-01-14 06:15:21'),
(57, 5, 'SOCIAL MEDIA OPTIMIZATION &amp; MARKETING', '5 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Social Networking Profile Optimizations&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Video Optimizations&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Blogging&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Blog Optimization&lt;/li&gt;\r\n&lt;/ul&gt;', 8, '2020-01-14 06:15:55'),
(58, 5, 'Online REPUTATION BUILDING', '2 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Authority building&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Trust building&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Relationship building&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Mentions&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Tagging&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Profile optimization&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Profile building&lt;/li&gt;\r\n&lt;/ul&gt;', 9, '2020-01-14 06:16:25'),
(59, 5, 'Google Advanced Queries for research , How to Make SEO Strategy , SEO Analysis', '10 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Website Analysis&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Competition Analysis&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Keyword Research&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Keyword Finalize&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Search Engine Optimization Strategy Analysis&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Initial Ranking analysis&lt;/li&gt;\r\n&lt;/ul&gt;', 10, '2020-01-14 06:17:34'),
(60, 5, 'Algorithm Updates , SEO Tracking , SEO Career Path', '5 Hours', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Google Analytics Custom Reports&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO job interview Training&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to find Online SEO Projects&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to win SEO bids&lt;/li&gt;\r\n&lt;/ul&gt;', 11, '2020-01-14 06:18:04'),
(61, 5, 'SEO Jobs and Career Opportunity', '1 Hour', '&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Trainee&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Link Building Expert&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Associate&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Executive&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Expert &amp;amp; SEO Team Lead&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Manager&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Strategist or Analyst&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;SEO Marketing Manager&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Director of Marketing&lt;/li&gt;\r\n&lt;/ul&gt;', 12, '2020-01-14 06:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `course_learn`
--

CREATE TABLE `course_learn` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_learn`
--

INSERT INTO `course_learn` (`id`, `course_id`, `detail`) VALUES
(2, 1, 'hello world'),
(3, 1, 'welcome to php');

-- --------------------------------------------------------

--
-- Table structure for table `course_tc`
--

CREATE TABLE `course_tc` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_tc`
--

INSERT INTO `course_tc` (`id`, `course_id`, `detail`) VALUES
(3, 1, 'I confirm that I know how to speak and read English.'),
(5, 1, 'I confirm that I know how to use a computer (mid to advance skills)'),
(6, 1, 'I confirm that I have doubled checked all the course details and any and all information I am providing is true.'),
(7, 2, 'I confirm that I know how to use a computer (mid to advance skills)'),
(8, 2, 'I confirm that I know how to speak and read English.'),
(9, 2, 'I confirm that I understand the course fee is 100% NON-REFUNDABLE or Transferable.'),
(10, 2, 'I confirm that I have doubled checked all the course details and any and all information I am providing is true.');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_receipt` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `batch_id`, `student_id`, `fee_receipt`, `status`, `created_at`) VALUES
(2, 2, 1, '6351563.png', 0, '2020-01-06 09:53:09'),
(3, 2, 2, '157831058317983708405e131bb67d5ff.png', 1, '2020-01-06 11:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `expense_title` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `expense_note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `created_at`) VALUES
(7, 'Why are your fees so expensive?', '&lt;p&gt;Our fees are not expensive at all, we value our knowledge and skill transfer capability a lot higher than the many fazool degrees people are willing to pay a minimum of 8 lakh rupees of their parents hard earned income, along with wasting many years of their lives all in all to come out at the other end with zero skills.&lt;/p&gt;\r\n&lt;p&gt;So in comparison to those fees, we are up to 95% cheaper and 1000000% more useful &amp;amp; we save you many years of your life which in itself is priceless. But still, if you cannot afford our fees. You are more than welcome to follow our curriculum, step by step and learn through YouTube. 90% of all successful IT professionals have taken this path and succeeded with great results. We wish everybody did this and universities and institutes like ours never needed to exist.&lt;/p&gt;', '2020-01-07 10:20:28'),
(8, 'What is your location?', 'We are based in Mirpur Azad Kashmir. Our exact location and contact details can be found here: https://AzadChaiwala.pk/contact-us', '2020-01-07 10:21:51'),
(9, 'Why are you not teaching all courses advertised?', '&lt;p&gt;The reason is that it is probably the first time in Pakistan that someone genuinely has stepped up to TEACH something genuinely practical, instead of the same old bullshit ratta maal.&lt;/p&gt;\r\n&lt;p&gt;By moving slowly we can ensure you have the best instructors and thus the best chance at succeeding in your chosen subject.&lt;/p&gt;\r\n&lt;p&gt;Plus historically whenever something has grown too fast, the quality of the product and service always drops and we don\'t want that for us. Especially we don\'t want to reach Azad Chaiwala.&lt;/p&gt;', '2020-01-07 10:22:39'),
(10, 'What is Your Bank Account Information?', '&lt;p&gt;Our Bank Account Information is as follows:&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Account Name:&lt;/strong&gt; Azad Chaiwala Institute&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Bank:&lt;/strong&gt; Dubai Islamic Bank&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Account Number:&lt;/strong&gt; 032045 4038006&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;SWIFT:&lt;/strong&gt; DUIBKKAXXX&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;IBAN:&lt;/strong&gt; PK25DUIB0000000454038006&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;IMPORTANT:&lt;/strong&gt; You must add reference STUDENT&amp;nbsp; NAME&amp;nbsp; When making any payment to us. Not doing so will cause unnecessary delay and you may miss out on your choice of the batch.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2020-01-07 10:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_messages`
--

CREATE TABLE `feedback_messages` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(255) NOT NULL,
  `image` text NOT NULL,
  `class` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(255) NOT NULL,
  `message` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `message`, `create_at`) VALUES
(1, '', '2020-01-08 15:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `person_image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `cnic` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `fname`, `date_of_birth`, `gender`, `cnic`, `picture`, `address`, `email`, `mobile_number`, `created_at`) VALUES
(1, 'Awais Liaqat', 'Liaqat Ali', '1975-03-01', 'male', '31303-5283320-5', '157787292712922187675e0c6e1f796aa.png', 'Liaqat Autos, Auto market', 'awaisliaqat5@gmail.com', '0315-6725415', '2020-01-01 10:02:07'),
(2, 'Awais Liaqat', 'Awais', '2020-01-06', 'male', '12132-1321321-3', '15783105228603025295e131b7a30eed.jpg', 'Liaqat Autos\r\nAuto market', 'awaisliaqat5@gmail.com', '0315-6725415', '2020-01-06 11:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `cnic` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `about` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `fname`, `date_of_birth`, `gender`, `cnic`, `picture`, `address`, `email`, `mobile_number`, `about`, `created_at`) VALUES
(1, 'Test Teacher', 'Test Father', '1973-03-03', 'male', '32132-1321321-3', '157787307313318697665e0c6eb1534a8.png', 'test', 'testemail@gmail.com', '0332-1321321', 'etstset', '2020-01-01 10:04:33'),
(2, 'Khizzar Ali', '', '1972-04-02', 'male', '32132-1321321-3', '157909819620377545615e1f2053e69dd.jpg', '', 'test@gmail.com', '0332-1321321', 'Khizzar is 24 years old, He started freelancing in 2016. He began working on UpWork first and the moved onto Fiverr. He has completed over 900 paid projects on Fiverr and over 100 projects on UpWork. He is proficient in Photoshop &amp; Video Editing. Overall he has 5 years experience in video editing and 2 year experience in photo editing.\r\n\r\nYou will find very few people in Pakistan that will be qualified enough to teach you Video Editing this well. Inshallah you will be in good hands and have a teacher for life to always answer industry specific questions whenever you need to. Good luck to you all.', '2020-01-15 14:23:15'),
(3, 'Ali Mir', '', '1974-04-03', 'male', '43213-2132132-1', '157909826915772941055e1f209ceb2fe.jpg', 'v', 'test@gmail.com', '0332-1321321', 'Ali Mir started his career back in 2012. He has a very wide skill base &amp; experience. He can teach almost every major Graphic Design Software. Hundreds of Students across the whole of Pakistan are today appointed in workplaces and freelancing, thanks to his training.', '2020-01-15 14:24:28'),
(4, 'Farooq Akram', '', '1972-03-03', 'male', '31321-3213232-1', '15790983242236523275e1f20d414107.jpg', '', 'tes12321t@gmail.com', '0321-3322313', 'Farooq Akram is a 34 years old programmer with over 14+ years of practical experience. Having worked on many projects, from simple CRUD application to IOT based web apps. Farooq has also worked with GIZ (The Technical Education Authority of Germany) to write course manuals for institutes. He has developed this course with the aim to put together something that works for everyone regardless of their age and level of education, this course will build you up from the basics all the way up to a respectable mid level coder. In Farooq\'s own words &quot;My full effort will go into equipping my students with skills that will give them a genuine feeling of achievement, open a multitude of in demand career paths for them, in the shortest time possible in the Computer Science &amp; Programming industry&quot;.', '2020-01-15 14:25:24'),
(5, 'Usama Liaqat', '', '1972-04-02', 'male', '35135-1321321-3', '157909839315696449035e1f2118d2fbb.jpg', '', 'aknelajn@gmamc.cimn', '0332-1321321', '', '2020-01-15 14:26:32'),
(6, 'Mudassir Iqbal', '', '1972-03-02', 'male', '35132-1321321-3', '157909850314902487145e1f21868bf47.jpg', '', 'awkejna.jkh.@j.k..cccccc', '0332-1321321', 'I am Mudassir Marketingwala, 27 years old. I am Google Certified Digital Marketer with over five years of experience. I\'ve helped more than 50 Businesses to grow with my skills. Skills like Online Marketing, Content Strategy, Social Media Marketing, and Lead Generation Services. Most of the clients are from overseas from Australia, Canada, United Kingdom, and Dubai. Businesses include e-Commerce, Apps Marketing/ASO, Softwares, and many more.\r\n\r\nI\'ll teach you one of the best courses available in Pakistan with my expertise. Inshallah, I\'ll always answer industry-specific questions whenever you need to. Good luck to you all.', '2020-01-15 14:28:22'),
(7, 'Abdul Qadir', '', '1973-03-03', 'male', '32132-1321321-3', '157909872620337255985e1f2265ab456.jpg', '', 'awe.ae.kawjl@k.ccc', '0322-3213213', 'Abdul Qadir (qualified as a computer systems engineer, though this has no positive or negative impact on his career path as an amazing game developer). He has been developing games at AceViral for over 4 years. 50+ of his games have accumulated more than 100m Game Plays on popular app stores like Google Play Store &amp; Apple App Store. His aim in teaching this course would be to set you on the right path to assimilate his achievements and then exceed it in a shorter period than it took himself. He will take on beginners and help them reach an intermediate level by the end of his course.', '2020-01-15 14:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$gRRl1r1EgtDjpllVbnR8IOhPpFGrx1I7CnATWLbKOESp86sevC7Z6', 'admin', '2020-01-01 09:46:59'),
(2, 'bilawalgul', '$2y$10$X6Pv25puMACa.WkAA2EJB.hLSS2vvr8wKpovN0iLMalUxVbTHQhLG', 'user', '2020-01-10 05:25:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_learn`
--
ALTER TABLE `course_learn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_tc`
--
ALTER TABLE `course_tc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_messages`
--
ALTER TABLE `feedback_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `course_learn`
--
ALTER TABLE `course_learn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_tc`
--
ALTER TABLE `course_tc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback_messages`
--
ALTER TABLE `feedback_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
