-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2022 at 03:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `css`
--

CREATE TABLE `css` (
  `id_css` int(11) NOT NULL,
  `name_css` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `css`
--

INSERT INTO `css` (`id_css`, `name_css`) VALUES
(1, 'Bootstrap4'),
(2, 'Bootstrap4 - Vue'),
(3, 'Bootstrap4 - Php'),
(4, 'Dart Getx Validator Form');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `version_name` varchar(200) NOT NULL,
  `desc_update` text NOT NULL,
  `entry_user` varchar(100) NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id_faq`, `version_name`, `desc_update`, `entry_user`, `entry_date`) VALUES
(7, '1.0.0', '<p>Clear CRUD Dasar</p>\n', 'Admin', '2021-11-04 02:20:40'),
(8, '1.0.1', '<p>- Fixing Framework details</p>\n\n<p>- form generator&nbsp;</p>\n\n<p>- Kurang eksekusi Query</p>\n', 'Admin', '2021-11-04 03:48:28'),
(9, '1.0.2', '<p>- Update CRUD Ci4 Native&nbsp;</p>\n\n<p>- Method CI4: Cread,Read,Update,Delete,CRUD done!</p>\n', 'Admin', '2021-11-04 10:01:16'),
(10, '1.0.3', '<p>- Update Generator Model Codeigniter 4 : Model</p>\n', 'Admin', '2021-11-04 10:19:41'),
(11, '1.0.5', '<p>- Update vuex,</p>\n\n<p>- Update Axios</p>\n\n<p>- Update Method Vue Function</p>\n\n<p>- Update Generator Form Vue&nbsp;</p>\n', 'Admin', '2021-11-19 18:33:59'),
(12, '1.0.6', 'Update Generator Controller dan Model untuk CI4', 'Admin', '2021-11-20 15:44:01'),
(13, '1.1.0', 'Update Codeigniter api dynamic model crud dll', 'Admin', '2022-07-16 09:25:54'),
(14, '1.1.1', 'Update command feature&nbsp;<br><br>Support :<br>1. Sequelize Migration<br><br>other in progress', 'Admin', '2022-07-16 13:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `framework`
--

CREATE TABLE `framework` (
  `id_framework` int(11) NOT NULL,
  `name_framework` varchar(100) NOT NULL,
  `id_lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `framework`
--

INSERT INTO `framework` (`id_framework`, `name_framework`, `id_lang`) VALUES
(5, 'Codeigniter4', 2),
(6, 'Laravel', 2),
(7, 'Lumen', 2),
(8, 'Native', 2),
(9, 'Codeigniter3', 2),
(10, 'Express Knex', 3),
(11, 'Gin Gorm', 4),
(12, 'Codeigniter4 - API', 2),
(13, 'Vue - Vuex', 3),
(14, 'Vue - Vue2', 3),
(15, 'Axios', 3),
(16, 'MariaDB', 7),
(18, ' NuxtJS - Axios', 3),
(19, 'Flutter', 5),
(20, 'Sequelize', 3);

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `id_function` int(11) NOT NULL,
  `id_framework` int(11) NOT NULL,
  `id_method` int(11) NOT NULL,
  `route` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`id_function`, `id_framework`, `id_method`, `route`) VALUES
(1, 5, 1, 'master/php/codeigniter4/create'),
(2, 5, 2, 'master/php/codeigniter4/read'),
(3, 5, 3, 'master/php/codeigniter4/update'),
(4, 5, 4, 'master/php/codeigniter4/delete'),
(5, 5, 6, 'master/php/codeigniter4/detail'),
(6, 5, 7, 'master/php/codeigniter4/crud'),
(7, 5, 8, 'master/php/codeigniter4/model'),
(8, 12, 1, 'master/php/ci4api/create'),
(9, 12, 2, 'master/php/ci4api/read'),
(10, 12, 3, 'master/php/ci4api/update'),
(11, 12, 4, 'master/php/ci4api/delete'),
(12, 12, 6, 'master/php/ci4api/detail'),
(13, 12, 7, 'master/php/ci4api/crud'),
(14, 12, 10, 'master/php/ci4api/validation'),
(15, 12, 9, 'master/php/ci4api/route'),
(16, 12, 8, 'master/php/ci4api/model'),
(17, 13, 18, 'master/js/vuex/getter'),
(18, 13, 19, 'master/js/vuex/mutation'),
(19, 14, 13, 'master/js/vue/addform'),
(20, 14, 14, 'master/js/vue/editform'),
(21, 15, 20, 'master/js/axios/get'),
(22, 15, 21, 'master/js/axios/post'),
(23, 15, 4, 'master/js/axios/delete'),
(24, 15, 7, 'master/js/axios/crud'),
(25, 12, 12, 'master/php/ci4api/controller'),
(26, 9, 2, 'master/php/codeigniter3/read'),
(27, 9, 1, 'master/php/codeigniter3/create'),
(28, 9, 3, 'master/php/codeigniter3/update'),
(29, 9, 6, 'master/php/codeigniter3/detail'),
(30, 9, 4, 'master/php/codeigniter3/delete'),
(31, 9, 7, 'master/php/codeigniter3/crud'),
(32, 9, 8, 'master/php/codeigniter3/model'),
(33, 18, 2, 'master/js/nuxtjsaxios/get'),
(34, 18, 1, 'master/js/nuxtjsaxios/post'),
(35, 18, 4, 'master/js/nuxtjsaxios/delete'),
(36, 18, 7, 'master/js/nuxtjsaxios/crud'),
(38, 15, 12, 'master/js/axios/crudvue'),
(39, 19, 22, 'master/dart/flutter/controller'),
(40, 19, 23, 'master/dart/flutter/service'),
(41, 19, 25, 'master/dart/flutter/maprequest'),
(42, 12, 26, 'master/php/ci4api/migration');

-- --------------------------------------------------------

--
-- Table structure for table `function_form`
--

CREATE TABLE `function_form` (
  `id_function` int(11) NOT NULL,
  `id_css` int(11) NOT NULL,
  `id_method` int(11) NOT NULL,
  `route` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `function_form`
--

INSERT INTO `function_form` (`id_function`, `id_css`, `id_method`, `route`) VALUES
(1, 2, 13, 'master/cssfunction/vue/add'),
(2, 1, 13, 'master/cssfunction/bootstrap/add'),
(3, 2, 15, 'master/cssfunction/vue/table');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id_lang` int(11) NOT NULL,
  `name_lang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id_lang`, `name_lang`) VALUES
(2, 'PHP'),
(3, 'JS'),
(4, 'Golang'),
(5, 'Dart'),
(6, 'C#'),
(7, 'MySQL'),
(8, 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id_method` int(11) NOT NULL,
  `name_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`id_method`, `name_method`) VALUES
(1, 'Create'),
(2, 'Read'),
(3, 'Update'),
(4, 'Delete'),
(6, 'Detail'),
(7, 'CRUD'),
(8, 'Model'),
(9, 'Route'),
(10, 'Validation'),
(11, 'Middleware'),
(12, 'Controller'),
(13, 'Add Form'),
(14, 'Edit Form'),
(15, 'Table Form'),
(16, 'Create SQL Table'),
(17, 'Entity'),
(18, 'Getter'),
(19, 'Mutation'),
(20, 'Get'),
(21, 'Post'),
(22, 'Getx Controller'),
(23, 'Http Service'),
(24, 'Getx Form Validator'),
(25, 'Map BodyRequest'),
(26, 'Migration');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `css`
--
ALTER TABLE `css`
  ADD PRIMARY KEY (`id_css`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indexes for table `framework`
--
ALTER TABLE `framework`
  ADD PRIMARY KEY (`id_framework`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`id_function`);

--
-- Indexes for table `function_form`
--
ALTER TABLE `function_form`
  ADD PRIMARY KEY (`id_function`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id_lang`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id_method`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `css`
--
ALTER TABLE `css`
  MODIFY `id_css` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `framework`
--
ALTER TABLE `framework`
  MODIFY `id_framework` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
  MODIFY `id_function` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `function_form`
--
ALTER TABLE `function_form`
  MODIFY `id_function` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id_lang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
