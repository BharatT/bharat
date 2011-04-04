-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2011 at 07:05 PM
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

CREATE TABLE `break_even_login` (
  `be_username` varchar(50) NOT NULL,
  `be_password` varchar(50) NOT NULL,
  `be_companyname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `break_even_login`
--

INSERT INTO `break_even_login` (`be_username`, `be_password`, `be_companyname`) VALUES
('administrator', 'password', 'admin'),
('greg', 'test', 'testG'),
('wendy', 'test', 'testW');



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
  `be_job_name` varchar(100) default NULL,
  `be_time_period` int(10) default NULL,
  `be_company` varchar(100) default NULL,
  PRIMARY KEY  USING BTREE (`be_seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `break_even_data`
--





