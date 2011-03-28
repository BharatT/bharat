 Server: localhost     Database: mysql     Table: break_even_data "InnoDB free: 4096 kB"
 

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
