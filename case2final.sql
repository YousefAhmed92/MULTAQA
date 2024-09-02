-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 04:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `case2final`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency_messages`
--

CREATE TABLE `agency_messages` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency_messages`
--

INSERT INTO `agency_messages` (`id`, `message`) VALUES
(27, 'Freelancer has accepted your project. project1 , and 650 dollar has been transferred to the freelancer\'s account.'),
(28, 'Freelancer has accepted your project. project3 , and 1100 dollar has been transferred to the freelancer\'s account.'),
(32, 'Freelancer has accepted your project. pro8 , and 650 dollar has been transferred to the freelancer\'s account.'),
(34, 'Freelancer has accepted your project. pro8 , and 650 dollar has been transferred to the freelancer\'s account.'),
(35, 'Freelancer has accepted your project. opeartion 3000 , and 156 dollar has been transferred to the freelancer\'s account.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(14, 'voice over'),
(15, 'developer'),
(16, 'content creator'),
(17, 'analyst'),
(18, 'design');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `business_descroption` varchar(255) NOT NULL,
  `pin` int(11) NOT NULL,
  `drive` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `email`, `password`, `country`, `phone_no`, `business_descroption`, `pin`, `drive`) VALUES
(1, 'CSS Company ', 'CSScompany@gmail.com', 'Ss.123', 'Egypt', '1034896542', '', 0, 'link1'),
(9, 'fatmasaid', 'fatma.said283@gmail.com', '$2y$10$g5SrtoUCqhb99pDcfjy/Yexqgb8SNNRVdrAXwujgxk94Q.RQEhy6K', 'United Arab Emirates', '1110078550', 'discription', 0, ''),
(10, 'zaid', 'ziad17099@gmail.com', '$2y$10$iSbazNGMETXq48SCJpV0X.aQi7kgo0i/IjzNGdakzHPw2LGS.PBbS', 'Kuwait', '1110078550', 'abcdd', 0, ''),
(11, 'yousef ahmed ibrahim', 'yousefahmed462003@gmail.com', '$2y$10$FYzwR.QDhiLlP1zHtHaZfeeoIRR/6XF2O6s7BMhn16tD//hw89Su.', 'egypt agian 44', '1129351876', 'backend', 0, ''),
(12, 'sunnycompany', 'sunrise20345@gmail.com', '$2y$10$qzxwtKrTNR36LFJh.WN5d.cbMCie9dKbYGHSroaSk1MospJNXvzEa', 'United Arab Emirates', '+971585741326', 'full stack company ', 5513, 'https://drive.google.com/drive/folders/1TF1DZmqK1ViL88p3NDxL_SmlqhuhPaSx'),
(13, 'Fatema Wael company', 'fatemawael2004@gmail.com', '$2y$10$lZTVEGZc5/Hy8Po2gU8Fb.2JFd6arelgYxkYtTpoFcyzGxMzphUo.', 'Egypt', '1277542771', 'ecommerce company', 1111, 'link4');

-- --------------------------------------------------------

--
-- Table structure for table `doneprojects`
--

CREATE TABLE `doneprojects` (
  `doneproject_id` int(11) NOT NULL,
  `doneproject` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

CREATE TABLE `freelancer` (
  `freelancer_id` int(11) NOT NULL,
  `freelancer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` longtext DEFAULT NULL,
  `national_id` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price/hour` int(11) NOT NULL,
  `available hours per day` int(11) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `graduate` varchar(255) NOT NULL,
  `year of xp` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `hide` int(11) DEFAULT NULL,
  `subcategory_id` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `count_view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`freelancer_id`, `freelancer_name`, `email`, `password`, `image`, `national_id`, `birthdate`, `description`, `price/hour`, `available hours per day`, `skills`, `graduate`, `year of xp`, `cat_id`, `hide`, `subcategory_id`, `pin`, `count_view`) VALUES
(26, 'fatmasaid', 'fatma.said283@gmail.com', '$2y$10$ESB.Sui/gine.fVP2W8vuexheE4dQvL05zp8cmxEWeq2eG9ZqowVe', 'profatma.jpeg', '30303132100664', '2003-03-13', ' im a hard working persona', 300, 6, 'HTML/CSS/PHP/ ERD,USECASE expert', '', 3, 15, NULL, 9, 1332, 8),
(27, 'Fatema Alzahraa Wael', 'fatemawael2004@gmail.com', '$2y$10$JV6XgiSy50idu5gVSfoVX.VReX0XEJdOjHPb5N6ubSZn5KHP13Vnm', '', '30407280106809', '2004-07-28', ' sss', 50, 8, '', 'graduate', 10, 15, NULL, 9, 1111, 1),
(28, 'sunzz', 'sunrise20345@gmail.com', '$2y$10$1zqC.cPpwtJOfqjBkObSi.3h3qjO7pqLPKdujOG.ZoKEKkaBIgxma', NULL, '30303132100664', '2003-03-13', NULL, 12, 4, NULL, 'graduate', 5, 15, NULL, 10, 2222, 0);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_messages`
--

CREATE TABLE `freelancer_messages` (
  `message_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer_messages`
--

INSERT INTO `freelancer_messages` (`message_id`, `freelancer_id`, `project_id`, `message`, `created_at`) VALUES
(1, 27, 11, 'Your request to work on the project has been approved.', '2024-08-29 08:29:55'),
(2, 27, 23, 'Your request to work on the project has been approved.', '2024-08-29 10:49:55'),
(3, 27, 25, 'Your request to work on the project has been approved.', '2024-08-29 11:39:57'),
(4, 26, 27, 'Your request to work on the project has been approved.', '2024-09-01 15:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `link_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `freelancer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`link_id`, `link`, `freelancer_id`) VALUES
(2, 'https://www.youtube.com/watch?v=hE0Lav4MZDM', 26),
(3, 'https://www.youtube.com/watch?v=hE0Lav4MZDM', 26),
(4, 'https://www.youtube.com/watch?v=hE0Lav4MZDM', 26),
(5, 'https://www.youtube.com/watch?v=hE0Lav4MZDM', 26),
(6, 'https://www.youtube.com/watch?v=hE0Lav4MZDM', 26),
(7, 'https://www.youtube.com/watch?v=hE0Lav4MZDM', 26);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `credit card` varchar(255) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `descriptionP` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `descriptionP`, `hours`, `cat_id`, `client_id`, `status`, `type`) VALUES
(9, 'project1', 'easy', 13, 15, 13, 'to do', 'team'),
(11, 'project2', 'good', 12, 15, 13, 'to do', 'individual'),
(19, 'project3', 'IT', 22, 15, 13, 'to do', 'team'),
(23, 'project4', 'IT', 14, 15, 13, 'to do', 'team'),
(24, 'pro8', 'good', 13, 15, 9, 'to do', 'individual'),
(25, 'pro9', 'easy', 14, 15, 9, 'to do', 'team'),
(26, 'task management website', 'we want a new task management website for our company to achieve productivity more efficiently', 13, 15, 12, 'to do', 'individual'),
(27, 'consultation over financial documents', 'we need second opinion consultation over our cash flow statement and income statement', 2, 17, 12, 'to do', 'individual'),
(28, 'a new logo design', 'we need a new logo design for our new rebranding next year', 15, 15, 12, 'to do', 'individual'),
(29, 'wedding invitation webpage', 'we want a wedding invitation webpage with interactive animation and a countdown to the wedding include this location to the wedding party:https://maps.app.goo.gl/N63YdMjd4nqB38no9', 7, 15, 12, 'to do', 'individual'),
(30, 'admin interface', 'we need an admin interface for our upcoming project the most needed category is development and then analyst and content creators ', 24, 15, 12, 'to do', 'team'),
(31, 'online marketing campaign', 'for our next rebranding we need a new marketing startegy and consulatation needed categories are marketing analyst ,financial analyst ,development and content creators.', 30, 17, 12, 'to do', 'team'),
(32, ' UX/UI Design and Prototyping', 'We need a talented UX/UI designer to create wireframes, prototypes, and high-fidelity designs for a new SaaS product. The focus will be on creating an intuitive and engaging user experience.', 60, 15, 12, 'to do', 'team'),
(33, 'Mobile-Responsive Redesign', 'Our client needs a complete redesign of their existing website to be fully mobile-responsive. The goal is to enhance user experience across all devices and improve site performance', 120, 15, 12, 'to do', 'team'),
(34, 'pppp', 'ssss', 44, 16, 13, 'to do', 'team');

-- --------------------------------------------------------

--
-- Table structure for table `projectcategories`
--

CREATE TABLE `projectcategories` (
  `client_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project member`
--

CREATE TABLE `project member` (
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'to do'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project member`
--

INSERT INTO `project member` (`member_id`, `project_id`, `status`) VALUES
(26, 19, 'done'),
(26, 23, 'done'),
(26, 27, 'done'),
(27, 9, 'done'),
(27, 11, 'done'),
(27, 19, 'done'),
(27, 23, 'to do'),
(27, 24, 'to do'),
(28, 26, 'to do');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `freelancer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating`, `feedback`, `freelancer_id`, `client_id`) VALUES
(1, 4, 'professiona', 27, 1),
(2, 5, 'she\'s amazing 10/10', 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `request from client`
--

CREATE TABLE `request from client` (
  `request from client_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request from client`
--

INSERT INTO `request from client` (`request from client_id`, `status`, `from`, `to`, `project_id`) VALUES
(1, 'yes', 13, 27, 9),
(8, 'yes', 12, 28, 26),
(9, 'pending', 12, 26, 33);

-- --------------------------------------------------------

--
-- Table structure for table `request from freelancer`
--

CREATE TABLE `request from freelancer` (
  `request_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request from freelancer`
--

INSERT INTO `request from freelancer` (`request_id`, `status`, `from`, `to`, `project_id`) VALUES
(7, 'pending', 27, 13, 11),
(8, 'pending', 27, 13, 23),
(11, 'pending', 26, 13, 19),
(13, 'Approved', 26, 12, 27),
(14, 'pending', 26, 12, 26),
(15, 'pending', 26, 12, 30);

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `sample_id` int(11) NOT NULL,
  `sample_name` longtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `freelancer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`sample_id`, `sample_name`, `description`, `freelancer_id`) VALUES
(1, 'sample1', 'good', 27),
(2, 'sam2', 'yes', 27),
(3, 'sam3', 'no', 27),
(5, 'CV.txt', 'my work samples ', 26),
(6, 'Fatma Said Saad CV G10-A.docx', 'sample of my work from april,2024', 26);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `sub_name`, `category_id`) VALUES
(7, 'voice over', 14),
(9, 'backend developer', 15),
(10, 'frontend developer', 15),
(11, 'content creator', 16),
(12, 'market research analyst', 17),
(13, 'financial analyst', 17),
(14, 'business intelligence analyst', 17),
(15, 'fashion graphic designer', 18),
(16, 'voice actor', 14);

-- --------------------------------------------------------

--
-- Table structure for table `team comment`
--

CREATE TABLE `team comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency_messages`
--
ALTER TABLE `agency_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `doneprojects`
--
ALTER TABLE `doneprojects`
  ADD PRIMARY KEY (`doneproject_id`,`freelancer_id`,`client_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `freelancer_id` (`freelancer_id`,`client_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`freelancer_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `freelancer_messages`
--
ALTER TABLE `freelancer_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_cat_id` (`cat_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `projectcategories`
--
ALTER TABLE `projectcategories`
  ADD PRIMARY KEY (`client_id`,`project_id`,`category_id`),
  ADD KEY `project_id` (`project_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `project member`
--
ALTER TABLE `project member`
  ADD PRIMARY KEY (`member_id`,`project_id`),
  ADD KEY `member_id` (`member_id`,`project_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `rating_ibfk_1` (`freelancer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `request from client`
--
ALTER TABLE `request from client`
  ADD PRIMARY KEY (`request from client_id`),
  ADD KEY `from` (`from`),
  ADD KEY `to` (`to`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `request from freelancer`
--
ALTER TABLE `request from freelancer`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `freelancer_id` (`from`),
  ADD KEY `client_id` (`to`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `team comment`
--
ALTER TABLE `team comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency_messages`
--
ALTER TABLE `agency_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doneprojects`
--
ALTER TABLE `doneprojects`
  MODIFY `doneproject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `freelancer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `freelancer_messages`
--
ALTER TABLE `freelancer_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `projectcategories`
--
ALTER TABLE `projectcategories`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project member`
--
ALTER TABLE `project member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request from client`
--
ALTER TABLE `request from client`
  MODIFY `request from client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request from freelancer`
--
ALTER TABLE `request from freelancer`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `team comment`
--
ALTER TABLE `team comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doneprojects`
--
ALTER TABLE `doneprojects`
  ADD CONSTRAINT `doneprojects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doneprojects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doneprojects_ibfk_3` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD CONSTRAINT `freelancer_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freelancer_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancer_messages`
--
ALTER TABLE `freelancer_messages`
  ADD CONSTRAINT `freelancer_messages_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freelancer_messages_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projectcategories`
--
ALTER TABLE `projectcategories`
  ADD CONSTRAINT `projectcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projectcategories_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projectcategories_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project member`
--
ALTER TABLE `project member`
  ADD CONSTRAINT `project member_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project member_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request from client`
--
ALTER TABLE `request from client`
  ADD CONSTRAINT `request from client_ibfk_1` FOREIGN KEY (`from`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request from client_ibfk_2` FOREIGN KEY (`to`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request from client_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`);

--
-- Constraints for table `request from freelancer`
--
ALTER TABLE `request from freelancer`
  ADD CONSTRAINT `request from freelancer_ibfk_1` FOREIGN KEY (`from`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request from freelancer_ibfk_2` FOREIGN KEY (`to`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request from freelancer_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request from freelancer_ibfk_4` FOREIGN KEY (`from`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request from freelancer_ibfk_5` FOREIGN KEY (`to`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sample`
--
ALTER TABLE `sample`
  ADD CONSTRAINT `sample_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
