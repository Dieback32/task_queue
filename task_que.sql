-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 03:21 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_que`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `firstname`, `lastname`, `user_photo`) VALUES
(1, 'Kirk', 'Hamment', '8e5c4e0f6b58ae763ed3f60dbda4f332.jpeg'),
(2, 'James', 'Hetfield', '3251c8fba5bfec8bf23adbc8c9971d1d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee_task`
--

CREATE TABLE `employee_task` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `urgency` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `started` bigint(20) NOT NULL,
  `status` int(1) NOT NULL,
  `deadline` datetime NOT NULL,
  `completed` bigint(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_task`
--

INSERT INTO `employee_task` (`id`, `project_id`, `employee_id`, `task_name`, `description`, `urgency`, `category`, `started`, `status`, `deadline`, `completed`) VALUES
(3, 1, 2, 'Barcode ticket generator', 'Generate random barcode ticket for every ticket', 4, 1, 1528895940, 0, '0000-00-00 00:00:00', 0),
(4, 1, 2, 'Admin design', 'Admin wireframe', 5, 1, 0, 3, '0000-00-00 00:00:00', 0),
(6, 1, 1, 'Ajax', 'Create a modal using ajax', 3, 2, 0, 0, '2018-06-28 01:00:00', 0),
(8, 1, 1, 'sample', 'sadfsdf', 2, 3, 0, 0, '0000-00-00 00:00:00', 0),
(9, 1, 2, 'test', 'test 101', 5, 4, 0, 2, '2018-06-30 02:00:00', 0),
(11, 1, 2, 'New Task', 'sample data', 4, 1, 0, 0, '2018-06-30 09:00:00', 0),
(12, 1, 2, 'test1111', 'testest', 1, 1, 0, 0, '0000-00-00 00:00:00', 0),
(13, 1, 2, 'wew', 'wew', 2, 1, 0, 0, '0000-00-00 00:00:00', 0),
(14, 1, 2, 'sssss', 'ddfdfd', 1, 1, 0, 0, '0000-00-00 00:00:00', 0),
(15, 1, 1, 'ssdfdfdf', 'asdfsadf', 1, 1, 0, 0, '0000-00-00 00:00:00', 0),
(16, 1, 2, 'asfd', 'sadfsdf', 1, 1, 0, 0, '0000-00-00 00:00:00', 0),
(17, 1, 2, 'asdffe3e434', 'sadf34343', 5, 2, 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `status` int(1) NOT NULL,
  `unread` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `project_id`, `task_id`, `sender_id`, `receiver_id`, `time`, `status`, `unread`) VALUES
(2, 2, 1, 11, 0, 2, 1530280987, 0, 0),
(3, 2, 1, 12, 0, 2, 1530282658, 0, 0),
(4, 2, 1, 13, 0, 2, 1530283287, 0, 0),
(5, 2, 1, 14, 0, 2, 1530283603, 0, 0),
(6, 2, 1, 15, 0, 1, 1530283721, 1, 0),
(7, 2, 1, 16, 0, 2, 1530283730, 0, 0),
(8, 2, 1, 17, 0, 2, 1530293799, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ucm_link` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `description`, `ucm_link`, `status`) VALUES
(1, 'Online Billing System', 'Electric Bill, Water Bill and Internet Bill', 'http://3wcorner.com/clientarea/customer.customer_admin_open/job.job_admin?customer_id=4&customer_type_id=0&job_id=341#', 0),
(2, 'Online Reservation System', 'Reservation', 'samplelink.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`id`, `project_id`, `category`) VALUES
(1, 1, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `task_comment`
--

CREATE TABLE `task_comment` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authorization` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `employee_id`, `username`, `password`, `authorization`, `status`) VALUES
(1, 1, 'kirk.hammett', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0),
(3, 2, 'james.h', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0),
(4, 0, 'admin', '0192023a7bbd73250516f069df18b500', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_task`
--
ALTER TABLE `employee_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_comment`
--
ALTER TABLE `task_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_task`
--
ALTER TABLE `employee_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_comment`
--
ALTER TABLE `task_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
