# Host: localhost  (Version: 5.5.53)
# Date: 2022-04-12 20:52:14
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

INSERT INTO `mall_admin_user` VALUES (1,'admin','eaf4d576c83c7e3e70d1cf42f771c4d5',1,0,0,1649600582,'127.0.0.1','');

#
# Structure for table "mall_cate"
#

CREATE TABLE `mall_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `listorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

#
# Data for table "mall_cate"
#

INSERT INTO `mall_cate` VALUES (1,'手机',0,'',1649561113,1649561113,'',1,0),(2,'电脑',0,'',1649561119,1649561119,'',1,0),(6,'小米',1,'',1649564655,1649564655,'',1,0),(7,'华为',1,'',1649564667,1649564667,'',1,0),(8,'苹果',1,'',1649564680,1649564680,'',1,0),(9,'小米',2,'',1649565100,1649565100,'',1,0),(10,'华为',2,'',1649565189,1649565189,'',1,0),(11,'苹果',2,'',1649565393,1649565393,'',1,0),(12,'OPPO',1,'',1649574296,1649574296,'',1,0),(13,'服装',0,'',1649586270,1649601144,'',1,0),(14,'鞋帽',0,'',1649586305,1649601155,'',1,0),(15,'内衣',0,'',1649601091,1649601150,'',1,0);

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
