-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `phisek`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `admin_system`
-- 

CREATE TABLE `admin_system` (
  `idadmin` int(2) NOT NULL auto_increment,
  `adminuser` varchar(15) NOT NULL,
  `adminpass` varchar(15) NOT NULL,
  `adminname` varchar(15) NOT NULL,
  PRIMARY KEY  (`idadmin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `admin_system`
-- 

INSERT INTO `admin_system` VALUES (1, 'admin', '123456', 'phisek');
