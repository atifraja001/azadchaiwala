-- Simple Backup SQL Dump
-- Version 1.0.3
-- https://www.github.com/coderatio/simple-backup/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2020 at 10:48 AM
-- MYSQL Server Version: 5.5.5-10.4.10-MariaDB
-- PHP Version: 7.3.12
-- Developer: Josiah O. Yahaya
-- Copyright: Coderatio

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00"

--
-- Database: `azadchaiwala_new`
-- Total Tables: 14
--

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `batches`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_students` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `batches` VALUES (2,1,'March 2020','2020-02-01','2020-03-31','09:00:00','13:00:00',10,'2020-01-06 06:21:11');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `batches` with 1 row(s)
--

--
-- Table structure for table `contact_messages`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `contact_messages` VALUES (1,'','','','','2020-01-08 12:23:24'),(2,'','','','','2020-01-08 12:23:45'),(3,'Awais Liaqat','awaisliaqat5@gmail.com','test','test','2020-01-08 12:24:35'),(4,'Awais Liaqat','awaisliaqat5@gmail.com','asd','asd','2020-01-09 05:00:52'),(5,'Awais Liaqat','awaisliaqat5@gmail.com','testset','setset','2020-01-09 05:03:15'),(6,'Awais Liaqat','awaisliaqat5@gmail.com','teateat','aet eat ea eat tea','2020-01-09 05:03:53'),(7,'Awais Liaqat','awaisliaqat5@gmail.com','test','setset','2020-01-09 05:05:03'),(8,'Awais Liaqat','awaisliaqat5@gmail.com','test','set','2020-01-09 05:05:17'),(9,'Awais Liaqat','awaisliaqat5@gmail.com','test','setset','2020-01-09 05:12:54'),(10,'Awais Liaqat','awaisliaqat5@gmail.com','test','setset','2020-01-09 05:15:27'),(11,'Awais Liaqat','awaisliaqat5@gmail.com','test','setsetse','2020-01-09 05:17:30'),(12,'Awais Liaqat','awaisliaqat5@gmail.com','yesy','setsetse','2020-01-10 11:33:02'),(13,'Awais Liaqat','awaisliaqat5@gmail.com','etste','tsetset','2020-01-10 11:33:27'),(14,'Awais Liaqat','awaisliaqat5@gmail.com','gfd','gfdg','2020-01-10 11:34:34');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `contact_messages` with 14 row(s)
--

--
-- Table structure for table `courses`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `courses` VALUES (1,1,1,'PHP Programming','php-programming','123123123123.jpg','FXlyIeKR4qw',4,'2 Months','2 (One Month Each)',200000,'We all use websites and majority of these websites are built in PHP. Thus making PHP the Internets most favorite programming language. This course is for those wanting to start at a beginner level and work their way up to a mid level programmer. A junior PHP developer can easily get a job for 30,000 Rupees per month and a medium level developer in excess of 45,000 rupees per month.\r\n\r\nAny senior web developer will tell you that you can learn programming in 40 one hour lessons, but we are offering you over 175 hours of mentor-ship and hands on training.','2020-01-01 10:10:32'),(2,2,1,'Video Editing, Videography &amp; Freelancing','video-editing-videography-freelancing','157803630016669984705e0eec4b7dbc1.jpg','FXlyIeKR4qw',4,'2 Weeks','2 (One Week Each)',40000,'We all use websites and majority of these websites are built in PHP. Thus making PHP the Internets most favorite programming language. This course is for those wanting to start at a beginner level and work their way up to a mid level programmer. A junior PHP developer can easily get a job for 30,000 Rupees per month and a medium level developer in excess of 45,000 rupees per month.\r\n\r\nAny senior web developer will tell you that you can learn programming in 40 one hour lessons, but we are offering you over 175 hours of mentor-ship and hands on training.','2020-01-03 07:24:59'),(3,3,1,'Graphic Designing','graphic-designing','15780437553472835675e0f096ad458c.jpg','FXlyIeKR4qw',4,'5 Weeks','5 (One Week Each)',40000,'We all use websites and majority of these websites are built in PHP. Thus making PHP the Internets most favorite programming language. This course is for those wanting to start at a beginner level and work their way up to a mid level programmer. A junior PHP developer can easily get a job for 30,000 Rupees per month and a medium level developer in excess of 45,000 rupees per month.\r\n\r\nAny senior web developer will tell you that you can learn programming in 40 one hour lessons, but we are offering you over 175 hours of mentor-ship and hands on training.','2020-01-03 09:29:14');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `courses` with 3 row(s)
--

--
-- Table structure for table `course_content`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_content` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `content_title` text NOT NULL,
  `duration` varchar(100) NOT NULL,
  `content_description` text NOT NULL,
  `position` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_content`
--

LOCK TABLES `course_content` WRITE;
/*!40000 ALTER TABLE `course_content` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `course_content` VALUES (2,1,'Introduction','5 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;How The Internet Works&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Web Servers&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Cloud Servers&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Network Basics&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;SVN, Git and GitHub&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',1,'2020-01-02 07:29:27'),(4,1,'Document Markup (HTML &amp; CSS)','16 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Markup Languages&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Creating &amp;amp; Saving HTML Files&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Page Layout&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Text Layout&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Navigation&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Graphics&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Tables &amp;amp; Divs&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Forms&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Canvas&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Media Support&amp;nbsp;&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Mobile Device Support (Compatibility)&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Tags to Avoid&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Rule Structure&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Layout Formatting&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Font and Text Decoration&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Responsive Styling&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',2,'2020-01-02 12:17:47'),(5,1,'Scripting Languages (JavaScript &amp; PHP)','23 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Server-Side and Client-Side Scripting&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Creating PHP Files&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;PHP Errors&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;PHP Output&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Data Storage&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Data Manipulation&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Email&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;File Interaction&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Structures&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Security&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Functions&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Objects and Classes&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;JavaScript Syntax&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;JavaScript Examples&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;jQuery&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',3,'2020-01-02 12:18:24'),(6,1,'Persistent Data Storage','10 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Database Types&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Data Relationships&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;MySQL Data Types&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Security&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Normalization&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;MySQL CRUD Action&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Advanced Queries&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Assessments&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',4,'2020-01-02 12:18:56'),(7,1,'Capstone Project','6 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Security&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Integration Examples&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Finishing Touches&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Final Project&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',5,'2020-01-02 12:19:37'),(9,2,'Shoot a portfolio video for freelancing sites.','1 Hour','&lt;ul&gt;\r\n&lt;li&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Students will learn how to make their own portfolio video for freelancing sites also remove their &quot;camera shyness&quot;.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',1,'2020-01-03 09:13:13'),(10,2,'How to begin using the software, how to setup and save first template.','30 Minutes','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Project settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Project file auto save settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to save manually project file&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to export project files.&lt;/li&gt;\r\n&lt;/ul&gt;',2,'2020-01-03 09:13:39'),(11,2,'How to Use Timelines for video','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Sequence settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Tools that are used in timelines&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to import footage into timelines&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Different sizes/resolution sequence settings (like Facebook, YouTube, Instagram) etc.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to export video in different formats, settings &amp;amp; sizes.&lt;/li&gt;\r\n&lt;/ul&gt;',3,'2020-01-03 09:14:09'),(12,2,'How to add Transition Effects','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Where we need and don\'t need transition effects.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to apply transitions&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to create your own transitions.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use external or 3rd party transitions&lt;/li&gt;\r\n&lt;/ul&gt;',4,'2020-01-03 09:14:43'),(13,2,'Jump Cuts','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What are jump cuts, does &amp;amp; donts of jump cuts.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add jump cuts into your videos.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How stabilize a video.&lt;/li&gt;\r\n&lt;/ul&gt;',5,'2020-01-03 09:15:24'),(14,2,'What are Overlays and How to Use Overlays in timelines','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What are overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add multiple overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Why we need overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to activate/deactivate specific overlays&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add logos inside a video.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to remove watermark &amp;amp; logo from videos.&lt;/li&gt;\r\n&lt;/ul&gt;',6,'2020-01-03 09:15:43'),(15,2,'Adding Text and Titles into videos','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add titles in to videos&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to animate titles and text&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add lower thirds (preset text animations)&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to play around with the size, shadows, strokes settings to enhance Texts &amp;amp; Titles.&lt;/li&gt;\r\n&lt;/ul&gt;',7,'2020-01-03 09:16:12'),(16,2,'Practical Demonstration of recording devices &amp; microphones','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Lapel microphones&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Rode microphones&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use of digital recording devices&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Different useful setting of recording devices&lt;/li&gt;\r\n&lt;/ul&gt;',8,'2020-01-03 09:16:43'),(17,2,'Adding voice overs, background music &amp; synchronizing recorded audio with footage','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to record voice overs&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add your own voice over in to the video&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How add background music into the videos&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to buy music or use free resources to attain music for your videos.&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YT Channel: Cinematic Sounds&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YT Channel: No Vlog No Copyright Music&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YT Channel: The Best Free Music&lt;br style=&quot;box-sizing: border-box;&quot; /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; - YouTube Library&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to adjust sound settings.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;how to record sound externally from recorder&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;how to synchronize external audio with camera recorded audio&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to reduce audio noise.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to boost volume 10x&lt;/li&gt;\r\n&lt;/ul&gt;',9,'2020-01-03 09:17:11'),(18,2,'How to record &amp; edit multiple camera videos','1.5 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to open multiple camera settings&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to change the angle from 1 camera to another&lt;/li&gt;\r\n&lt;/ul&gt;',10,'2020-01-03 09:17:59'),(19,2,'Motion Tracking','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is motion tracking&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Why and where we use motion tracking&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to blur and track faces automatically&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is keyframing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use keyframing&lt;/li&gt;\r\n&lt;/ul&gt;',11,'2020-01-03 09:18:40'),(20,2,'Green Screen (Chroma Keying)','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to setup a green screen&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;One video will be made live in front of students to be used in teaching.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to remove the background&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to add an alternative background.&lt;/li&gt;\r\n&lt;/ul&gt;',12,'2020-01-03 09:18:55'),(21,2,'Colour correction &amp; color grading','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to deal with over or underexposed footage&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to change the mood of video by adding color grading&lt;/li&gt;\r\n&lt;/ul&gt;',13,'2020-01-03 09:19:10'),(22,2,'Practical Demonstration of different types of lights &amp; reflector setups','1.5 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Knowledge of good lighting setups for videos&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of soft boxes&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of on camera &amp;amp; off camera flash lights&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of external subject lighting using LED &amp;amp; Ring lights.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use light reflectors &amp;amp; light modifier&lt;/li&gt;\r\n&lt;/ul&gt;',14,'2020-01-03 09:19:32'),(23,2,'Practical knowledge of DSLR cameras','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Hands on demo of Nikon &amp;amp; Canon DSLR cameras&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Most commonly used settings of DSLR cameras, such as Iso, Shutter speed, Aperture etc&lt;/li&gt;\r\n&lt;/ul&gt;',15,'2020-01-03 09:20:12'),(24,2,'Basic Knowledge of camera lenses','1.5 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Nikon lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Canon lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is meant by f stops on lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is meant by mm on lenses&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Differences between wide angle, pancake, telephoto lenses etc and their best usage.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use lenses on automatic and manual settings.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Difference between tele wide lenses and prime lenses.&lt;/li&gt;\r\n&lt;/ul&gt;',16,'2020-01-03 09:20:30'),(25,2,'Demonstration of DSLR, Drone &amp; Mobile Gimbals','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is a Gimbal&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to use mobile/DSLR gimbals&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Best usage of gimbals&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Demonstration of &quot;How to fly a Drone?&quot;.&lt;/li&gt;\r\n&lt;/ul&gt;',17,'2020-01-03 09:20:51'),(26,2,'Demonstration of Teleprompter','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;What is a teleprompter&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to setup a teleprompter&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Practical demo and usage of teleprompter.&lt;/li&gt;\r\n&lt;/ul&gt;',18,'2020-01-03 09:21:12'),(27,2,'How to Film &amp; become a social media star.','1.5 Hours','&lt;ul&gt;\r\n&lt;li&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;4 of the most commonly used filming techniques to achieve cinematic look.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;',19,'2020-01-03 09:21:54'),(28,2,'Setting up your own YouTube channel.','1 Hour','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Max 3 minute video that students have made with all new skills learned.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Students will open their own YouTube channels and upload their first videos.&lt;/li&gt;\r\n&lt;/ul&gt;',20,'2020-01-03 09:22:07'),(29,2,'Lecture on how to use video editing skills to earn money.','2 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Learn how to use your newly learned skills to earn money&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How freelancing works&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Setup your first freelancer account.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;We tell you what kind of order description you get from clients&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Demonstrate to work on clients order descriptions&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to follow the order description&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Things which banned you permanently from freelancing sites.&lt;/li&gt;\r\n&lt;/ul&gt;',21,'2020-01-03 09:22:25'),(30,2,'Record and Edit Videos of:','3 Hours','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to make CLONE or duplicate (Example: Showing twins in same frame).&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to make GHOST effect (Example: Transparent Ghost in horror movies).&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Sky replacement.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;How to make time lapsed video.&lt;/li&gt;\r\n&lt;/ul&gt;',22,'2020-01-03 09:22:42'),(31,3,'PhotoShop','10 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Basics of Photoshop&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Introduction&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Background Removal&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Color Grading&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Change any Product Color&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Retouching&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Image Composition&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Making Mock-ups&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Use of brushes $ affects&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Working with Selections&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Scaling&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Knowing the Layers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Color Adjustments&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Output&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Settings&lt;/li&gt;\r\n&lt;/ul&gt;',1,'2020-01-03 09:29:57'),(32,3,'Corel DRAW &amp; Adobe Illustrator','14 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Getting Started with Corel DRAW &amp;amp; Adobe Illustrator&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Introduction&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Tools &amp;amp; Techniques&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Types of logo&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Stationary Design&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Brochure, Banner, Leaflet.&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;T-shirt Designing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Panaflex Printing&lt;/li&gt;\r\n&lt;/ul&gt;',2,'2020-01-03 09:30:16'),(33,3,'Graphic Drawing Tablet','5 Days','&lt;p&gt;&lt;span style=&quot;color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Learning to use graphic drawing tablets will give you an advantage over others in the job and freelancing marketplace. This skill will allow you to hand-draw images and graphics with the aid of a special pen-like stylus, similar to the way a person draws images with a pencil on paper. You will be able to make unique graphics such as logos, mascots &amp;amp; in game graphics that cannot be purchased or found anywhere else in the world.&lt;/span&gt;&lt;/p&gt;',3,'2020-01-03 09:30:32'),(34,3,'Capstone Project','4 Days','&lt;ul&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Client Brief&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Content and Graphics&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Marketing Plan&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Look and feel&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printing &amp;amp; Scanning&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Types of Printers&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printing Concepts&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printing Technologies&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Printer Paper&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Post Press Print Project Finishing&lt;/li&gt;\r\n&lt;li style=&quot;box-sizing: border-box; color: #505050; font-family: \'Roboto Condensed\', sans-serif; font-size: 16px; background-color: #ffffff;&quot;&gt;Scanning&lt;/li&gt;\r\n&lt;/ul&gt;',4,'2020-01-03 09:30:54'),(35,0,'01:00',' 1','',0,'2020-01-03 12:16:03');
/*!40000 ALTER TABLE `course_content` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `course_content` with 32 row(s)
--

--
-- Table structure for table `course_tc`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_tc`
--

LOCK TABLES `course_tc` WRITE;
/*!40000 ALTER TABLE `course_tc` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `course_tc` VALUES (2,1,'I confirm that I understand the course fee is 100% NON-REFUNDABLE or Transferable.'),(3,1,'I confirm that I know how to speak and read English.'),(5,1,'I confirm that I know how to use a computer (mid to advance skills)'),(6,1,'I confirm that I have doubled checked all the course details and any and all information I am providing is true.'),(7,2,'I confirm that I know how to use a computer (mid to advance skills)'),(8,2,'I confirm that I know how to speak and read English.'),(9,2,'I confirm that I understand the course fee is 100% NON-REFUNDABLE or Transferable.'),(10,2,'I confirm that I have doubled checked all the course details and any and all information I am providing is true.');
/*!40000 ALTER TABLE `course_tc` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `course_tc` with 8 row(s)
--

--
-- Table structure for table `enrollments`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_receipt` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `enrollments` VALUES (2,2,1,'6351563.png',1,'2020-01-06 09:53:09'),(3,2,2,'157831058317983708405e131bb67d5ff.png',0,'2020-01-06 11:36:22'),(5,2,3,'157865930714477844485e186dead7957.jpg',1,'2020-01-10 12:28:26'),(6,2,3,'157865935011744520205e186e15c4e82.jpg',1,'2020-01-10 12:29:09');
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `enrollments` with 4 row(s)
--

--
-- Table structure for table `expense`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_title` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `expense_note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `expense` with 0 row(s)
--

--
-- Table structure for table `faqs`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `faqs` with 0 row(s)
--

--
-- Table structure for table `feedback_messages`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_messages`
--

LOCK TABLES `feedback_messages` WRITE;
/*!40000 ALTER TABLE `feedback_messages` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `feedback_messages` VALUES (1,1,'Awais Liaqat','awaisliaqat5@gmail.com','testset','2020-01-09 05:59:33'),(2,1,'Awais Liaqat','awaisliaqat5@gmail.com','fsdfsf','2020-01-09 06:00:23'),(3,1,'Awais Liaqat','awaisliaqat5@gmail.com','testset','2020-01-09 06:02:26');
/*!40000 ALTER TABLE `feedback_messages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `feedback_messages` with 3 row(s)
--

--
-- Table structure for table `notification`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `notification` VALUES (1,'','2020-01-10 12:19:13');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `notification` with 1 row(s)
--

--
-- Table structure for table `reviews`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_name` varchar(255) NOT NULL,
  `person_image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `reviews` VALUES (5,'Hassan Durani','157839003711159445365e14521513985.jpg','Highly Recommend','2020-01-07 09:40:37'),(6,'Irfan Sabir Adv','15783900971606735255e1452507dd48.jpg','Brilliant effort for job promoting job creation in Mirpur, Pakistan.','2020-01-07 09:41:36');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `reviews` with 2 row(s)
--

--
-- Table structure for table `students`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `cnic` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `students` VALUES (1,'Awais Liaqat','Liaqat Ali','1975-03-01','male','31303-5283320-5','157787292712922187675e0c6e1f796aa.png','Liaqat Autos, Auto market','awaisliaqat5@gmail.com','0315-6725415','2020-01-01 10:02:07'),(2,'Awais Liaqat','Awais','2020-01-06','male','12132-1321321-3','15784829849940293245e15bd28062fa.jpg','Liaqat AutosAuto market','awaisliaqat5@gmail.com','0315-6725415','2020-01-06 11:35:22'),(3,'Kamran Malik','Malik Asghar','1972-01-02','male','33213-2132132-1','15786590306407078085e186cd65c6c9.jpg','Liaqat Autos, Auto market','awaisliaqat5@gmail.co','0315-6725415','2020-01-10 12:23:50');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `students` with 3 row(s)
--

--
-- Table structure for table `teachers`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `teachers` VALUES (1,'Test Teacher','Test Father','1973-03-03','male','32132-1321321-3','157787307313318697665e0c6eb1534a8.png','test','testemail@gmail.com','0332-1321321','etstset','2020-01-01 10:04:33');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `teachers` with 1 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'admin','$2y$10$KdtgN2Bmlv4y67lFHJpeJ.D/ESoPq2dWRt1LMUThWoCQidPuVz2tG','admin','2020-01-01 09:46:59'),(3,'testaccount2','$2y$10$goamzC.XiW/EZLVPVGjzZeYtPx15qb1SDWfHk5p7JFa996TDGLRAG','user','2020-01-08 09:44:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 13 Jan 2020 10:39:48 +0100
