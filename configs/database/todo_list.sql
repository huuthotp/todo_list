/*
Navicat MySQL Data Transfer

Source Server         : LocalHost
Source Server Version : 50067
Source Host           : localhost:3306
Source Database       : todo_list

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2018-08-02 22:51:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `est_list_works`
-- ----------------------------
DROP TABLE IF EXISTS `est_list_works`;
CREATE TABLE `est_list_works` (
  `id` int(11) NOT NULL auto_increment,
  `work_name` varchar(255) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `delete_flg` int(1) NOT NULL default '0',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of est_list_works
-- ----------------------------
INSERT INTO est_list_works VALUES ('1', 'Test1 2', '2018-08-01', '2018-08-01', '1', '1', '0000-00-00 00:00:00', '2018-08-02 12:05:05');
INSERT INTO est_list_works VALUES ('2', 'test2', '2018-08-02', '2018-08-02', '3', '0', '0000-00-00 00:00:00', '2018-08-02 12:15:34');
INSERT INTO est_list_works VALUES ('3', 'test3', '2018-08-03', '2018-08-05', '1', '1', '2018-08-02 10:23:42', '2018-08-02 12:45:33');
INSERT INTO est_list_works VALUES ('4', 'test2', '2018-08-02', '2018-08-04', '1', '1', '2018-08-02 12:08:33', '2018-08-02 12:14:48');
INSERT INTO est_list_works VALUES ('5', 'test2', '2018-08-02', '2018-08-04', '1', '1', '2018-08-02 12:09:36', '2018-08-02 12:14:51');
INSERT INTO est_list_works VALUES ('6', 'test26', '2018-08-02', '2018-08-04', '2', '1', '2018-08-02 12:10:10', '2018-08-02 12:45:31');
INSERT INTO est_list_works VALUES ('7', 'test2', '2018-08-02', '2018-08-04', '1', '1', '2018-08-02 12:10:32', '2018-08-02 12:45:27');
INSERT INTO est_list_works VALUES ('8', 'test2', '2018-08-02', '2018-08-01', '1', '1', '2018-08-02 12:45:09', '2018-08-02 12:56:29');
INSERT INTO est_list_works VALUES ('9', 'test3', '2018-08-02', '2018-08-01', '3', '0', '2018-08-02 12:45:46', '2018-08-02 12:45:46');
INSERT INTO est_list_works VALUES ('10', 'test2', '2018-08-03', '2018-08-05', '1', '0', '2018-08-02 12:56:07', '2018-08-02 12:56:07');

-- ----------------------------
-- Table structure for `est_status`
-- ----------------------------
DROP TABLE IF EXISTS `est_status`;
CREATE TABLE `est_status` (
  `id` int(11) NOT NULL auto_increment,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of est_status
-- ----------------------------
INSERT INTO est_status VALUES ('1', 'Planning');
INSERT INTO est_status VALUES ('2', 'Doing');
INSERT INTO est_status VALUES ('3', 'Complete');
