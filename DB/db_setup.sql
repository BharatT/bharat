-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2011 at 04:27 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `break_even_data`
--

DROP TABLE IF EXISTS `break_even_data`;
CREATE TABLE `break_even_data` (
  `be_seq` int(10) NOT NULL auto_increment,
  `be_total_sale` int(10) NOT NULL,
  `be_cost_sale` int(10) default NULL,
  `be_fix_cost` int(10) NOT NULL,
  `be_avg_sale` int(10) NOT NULL,
  `be_conv_rate` int(10) default NULL,
  `be_date` date NOT NULL,
  `be_create_by` char(50) NOT NULL,
  `be_reason_total` varchar(100) default NULL,
  `be_reason_cost` varchar(100) default NULL,
  `be_reason_fix` varchar(100) default NULL,
  `be_reason_avg` varchar(100) default NULL,
  `be_reason_conv` varchar(100) default NULL,
  `be_time_period` int(10) default NULL,
  `be_company` varchar(100) default NULL,
  PRIMARY KEY  USING BTREE (`be_seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `break_even_data`
--

INSERT INTO `break_even_data` (`be_seq`, `be_total_sale`, `be_cost_sale`, `be_fix_cost`, `be_avg_sale`, `be_conv_rate`, `be_date`, `be_create_by`, `be_reason_total`, `be_reason_cost`, `be_reason_fix`, `be_reason_avg`, `be_reason_conv`, `be_time_period`, `be_company`) VALUES
(1, 500000, 120000, 226520, 2500, 25, '2011-03-15', 'test', 'total sale reason', 'cost sale reason test', 'test reason fixed cost', 'average sale reason test', 'test conversion rate', 12, 'test'),
(3, 500000, 120000, 220000, 2500, 25, '2011-03-16', 'test', 'test reason', 'test reason for sale', 'test reason fixed cost', 'test reason for average sale', '', 12, 'test');


-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2011 at 04:30 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `break_even_login`
--

DROP TABLE IF EXISTS `break_even_login`;
CREATE TABLE `break_even_login` (
  `be_username` varchar(50) NOT NULL,
  `be_password` varchar(50) NOT NULL,
  `be_companyname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `break_even_login`
--

INSERT INTO `break_even_login` (`be_username`, `be_password`, `be_companyname`) VALUES
('admin', 'password', 'test'),
('test', 'test', 'test'),
('adminUser', 'test', 'test');
