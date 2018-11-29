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
-- โครงสร้างตาราง `register`
-- 

CREATE TABLE `register` (
  `idregister` int(10) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass1` varchar(10) NOT NULL,
  `address` longtext NOT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY  (`idregister`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `register`
-- 

