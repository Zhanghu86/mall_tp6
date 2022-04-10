# Host: localhost  (Version: 5.5.53)
# Date: 2022-04-01 23:40:45
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "mall_admin_user"
#

CREATE TABLE `mall_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '0' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '0' COMMENT '密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1、正常 0、待审核 99 删除',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(100) NOT NULL DEFAULT '0' COMMENT '最后登录ip',
  `operate_user` varchar(100) NOT NULL DEFAULT '' COMMENT '操作人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`(20))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "mall_admin_user"
#

INSERT INTO `mall_admin_user` VALUES (1,'admin','eaf4d576c83c7e3e70d1cf42f771c4d5',1,0,0,1648349317,'127.0.0.1','');

#
# Structure for table "mall_user"
#

CREATE TABLE `mall_user` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT '',
  `phone_number` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `ltype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `username` (`username`(20))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "mall_user"
#

INSERT INTO `mall_user` VALUES (0,'mall-15712124421','15712124421','',0,1,0,1648353371,1648353371,1,'');
