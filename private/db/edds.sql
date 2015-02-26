/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : edds

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-02-19 21:02:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `event_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `updated_at` int(11) NOT NULL,
  `event_thumbnail_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `media_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `news_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `updated_at` int(11) NOT NULL,
  `news_thumbnail_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for playlist
-- ----------------------------
DROP TABLE IF EXISTS `playlist`;
CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`playlist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for playlist_media
-- ----------------------------
DROP TABLE IF EXISTS `playlist_media`;
CREATE TABLE `playlist_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `sort_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
