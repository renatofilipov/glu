/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50717
Source Host           : 127.0.0.1:3306
Source Database       : rfilipov

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2020-02-29 11:53:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submitterId` int(11) NOT NULL DEFAULT '0',
  `processorId` int(11) DEFAULT NULL,
  `dateTimeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateTimeStarted` timestamp NULL DEFAULT NULL,
  `dateTimeCompleted` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dateStarted` (`dateTimeStarted`),
  KEY `submitter` (`submitterId`),
  KEY `processor` (`processorId`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES ('1', '8', '505056254', '2020-02-25 08:28:20', '2020-02-29 16:19:51', '2020-02-29 16:58:05', '2');
INSERT INTO `tasks` VALUES ('2', '8', '1010320622', '2020-02-25 08:28:20', '2020-02-29 16:19:52', '2020-02-29 16:42:33', '2');
INSERT INTO `tasks` VALUES ('3', '8', '747110373', '2020-02-25 08:28:20', '2020-02-29 16:19:53', '2020-02-29 16:40:25', '2');
INSERT INTO `tasks` VALUES ('4', '8', '1427726759', '2020-02-25 08:28:20', '2020-02-29 16:19:53', '2020-02-29 16:53:10', '2');
INSERT INTO `tasks` VALUES ('5', '8', '51995706', '2020-02-25 08:28:20', '2020-02-29 16:19:56', '2020-02-29 16:42:22', '2');
INSERT INTO `tasks` VALUES ('6', '8', '1609492129', '2020-02-25 18:42:22', '2020-02-29 16:03:32', '2020-02-29 16:30:13', '2');
INSERT INTO `tasks` VALUES ('7', '8', '762496671', '2020-02-25 18:46:47', '2020-02-29 16:03:43', '2020-02-29 16:26:00', '2');
INSERT INTO `tasks` VALUES ('8', '8', '1777464911', '2020-02-25 19:08:22', '2020-02-29 16:03:47', '2020-02-29 16:51:07', '2');
INSERT INTO `tasks` VALUES ('9', '222', '269928744', '2020-02-25 21:23:26', '2020-02-29 16:15:51', '2020-02-29 16:41:57', '2');
INSERT INTO `tasks` VALUES ('11', '1', '2107306895', '2020-02-25 21:23:48', '2020-02-29 16:16:43', '2020-02-29 16:56:06', '2');
INSERT INTO `tasks` VALUES ('12', '1', '110484199', '2020-02-25 21:23:48', '2020-02-29 16:17:04', '2020-02-29 17:15:39', '2');
INSERT INTO `tasks` VALUES ('13', '1', '1457492037', '2020-02-25 21:23:48', '2020-02-29 16:18:00', '2020-02-29 16:41:42', '2');
INSERT INTO `tasks` VALUES ('15', '1', '1695841291', '2020-02-25 21:29:58', '2020-02-29 16:18:10', '2020-02-29 16:44:40', '2');
INSERT INTO `tasks` VALUES ('16', '1', '2046414154', '2020-02-25 21:29:58', '2020-02-29 16:19:00', '2020-02-29 17:07:10', '2');
INSERT INTO `tasks` VALUES ('17', '1', null, '2020-02-25 21:29:58', null, null, '0');
INSERT INTO `tasks` VALUES ('49', '1', null, '2020-02-27 21:57:36', null, null, '0');
INSERT INTO `tasks` VALUES ('51', '1', null, '2020-02-27 21:58:07', null, null, '0');
INSERT INTO `tasks` VALUES ('70', '1', null, '2020-02-28 21:24:52', null, null, '0');
INSERT INTO `tasks` VALUES ('71', '1', null, '2020-02-28 21:25:02', null, null, '0');
INSERT INTO `tasks` VALUES ('76', '1', null, '2020-02-29 10:32:47', null, null, '0');
INSERT INTO `tasks` VALUES ('99', '1', null, '2020-02-29 10:43:06', null, null, '0');
INSERT INTO `tasks` VALUES ('108', '1', null, '2020-02-29 11:14:00', null, null, '0');
INSERT INTO `tasks` VALUES ('109', '1', null, '2020-02-29 11:17:28', null, null, '0');
INSERT INTO `tasks` VALUES ('110', '3', null, '2020-02-29 11:17:43', null, null, '0');
