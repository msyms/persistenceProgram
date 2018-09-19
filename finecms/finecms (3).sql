-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?09 �?19 �?08:52
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `finecms`
--

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_block`
--

CREATE TABLE IF NOT EXISTS `fn_1_block` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '资料块名称',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='资料块表' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_category`
--

CREATE TABLE IF NOT EXISTS `fn_1_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tid` tinyint(1) NOT NULL COMMENT '栏目类型，0单页，1模块，2外链',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `mid` varchar(20) NOT NULL COMMENT '模块目录',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `domain` varchar(50) NOT NULL COMMENT '绑定域名',
  `letter` char(1) NOT NULL COMMENT '首字母',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `pcatpost` tinyint(1) NOT NULL COMMENT '是否父栏目发布',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `content` mediumtext NOT NULL COMMENT '单页内容',
  `permission` text COMMENT '会员权限',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `tid` (`tid`),
  KEY `show` (`show`),
  KEY `dirname` (`dirname`),
  KEY `module` (`pid`,`displayorder`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='栏目表' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_form`
--

CREATE TABLE IF NOT EXISTS `fn_1_form` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `table` varchar(50) NOT NULL COMMENT '表名',
  `setting` text COMMENT '配置信息',
  PRIMARY KEY (`id`),
  UNIQUE KEY `table` (`table`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='表单模型表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fn_1_form`
--

INSERT INTO `fn_1_form` (`id`, `name`, `table`, `setting`) VALUES
(1, '留言', 'liuyan', '{"post":"1","code":"1","send":"","template":"","rt_url":""}');

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_form_liuyan`
--

CREATE TABLE IF NOT EXISTS `fn_1_form_liuyan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `uid` int(10) unsigned DEFAULT '0' COMMENT '录入者uid',
  `author` varchar(100) DEFAULT NULL COMMENT '录入者账号',
  `inputip` varchar(30) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) unsigned NOT NULL COMMENT '录入时间',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序值',
  `tableid` smallint(5) unsigned NOT NULL COMMENT '附表id',
  `neirong` mediumtext,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `inputtime` (`inputtime`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='留言表单表' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_form_liuyan_data_0`
--

CREATE TABLE IF NOT EXISTS `fn_1_form_liuyan_data_0` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned DEFAULT '0' COMMENT '录入者uid',
  UNIQUE KEY `id` (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言表单附表';

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_index`
--

CREATE TABLE IF NOT EXISTS `fn_1_index` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL COMMENT '作者uid',
  `mid` varchar(20) NOT NULL COMMENT '模块目录',
  `catid` tinyint(3) unsigned NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `inputtime` int(10) unsigned NOT NULL COMMENT '录入时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `uid` (`uid`),
  KEY `catid` (`catid`),
  KEY `status` (`status`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='内容索引表' AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_news`
--

CREATE TABLE IF NOT EXISTS `fn_1_news` (
  `id` int(10) unsigned NOT NULL,
  `catid` smallint(5) unsigned NOT NULL COMMENT '栏目id',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `hits` mediumint(8) unsigned DEFAULT NULL COMMENT '浏览数',
  `uid` mediumint(8) unsigned NOT NULL COMMENT '作者id',
  `author` varchar(50) NOT NULL COMMENT '作者名称',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `tableid` smallint(5) unsigned NOT NULL COMMENT '附表id',
  `inputip` varchar(15) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) unsigned NOT NULL COMMENT '录入时间',
  `updatetime` int(10) unsigned NOT NULL COMMENT '更新时间',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL,
  `favorites` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `uid` (`uid`),
  KEY `catid` (`catid`),
  KEY `status` (`status`),
  KEY `inputtime` (`inputtime`),
  KEY `updatetime` (`updatetime`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型主表';

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_news_data_0`
--

CREATE TABLE IF NOT EXISTS `fn_1_news_data_0` (
  `id` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL COMMENT '作者uid',
  `catid` smallint(5) unsigned NOT NULL COMMENT '栏目id',
  `content` mediumtext COMMENT '内容',
  UNIQUE KEY `id` (`id`),
  KEY `uid` (`uid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型附表';

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_tag`
--

CREATE TABLE IF NOT EXISTS `fn_1_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT '0' COMMENT '父级id',
  `name` varchar(200) NOT NULL COMMENT '关键词名称',
  `code` varchar(200) NOT NULL COMMENT '关键词代码（拼音）',
  `pcode` varchar(255) DEFAULT NULL,
  `hits` mediumint(8) unsigned NOT NULL COMMENT '点击量',
  `url` varchar(255) DEFAULT NULL COMMENT '关键词url',
  `childids` varchar(255) NOT NULL COMMENT '子类集合',
  `content` text NOT NULL COMMENT '关键词描述',
  `total` int(10) NOT NULL COMMENT '点击数量',
  `displayorder` int(10) NOT NULL COMMENT '排序值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `letter` (`code`,`hits`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='关键词库表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `fn_1_tag`
--

INSERT INTO `fn_1_tag` (`id`, `pid`, `name`, `code`, `pcode`, `hits`, `url`, `childids`, `content`, `total`, `displayorder`) VALUES
(1, 0, '标签测试', 'test', NULL, 18, '', '', '1', 0, 0),
(2, 0, '中国', 'zhongguo', '', 0, '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_weixin`
--

CREATE TABLE IF NOT EXISTS `fn_1_weixin` (
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信属性参数表';

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_weixin_follow`
--

CREATE TABLE IF NOT EXISTS `fn_1_weixin_follow` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `status` (`status`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信粉丝同步表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_weixin_menu`
--

CREATE TABLE IF NOT EXISTS `fn_1_weixin_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `value` text NOT NULL,
  `displayorder` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信菜单表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_1_weixin_user`
--

CREATE TABLE IF NOT EXISTS `fn_1_weixin_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL COMMENT '会员id',
  `username` varchar(100) NOT NULL,
  `groupid` int(10) NOT NULL,
  `openid` varchar(50) NOT NULL COMMENT '唯一id',
  `nickname` text NOT NULL COMMENT '微信昵称',
  `sex` tinyint(1) unsigned DEFAULT NULL COMMENT '性别',
  `city` varchar(30) DEFAULT NULL COMMENT '城市',
  `country` varchar(30) DEFAULT NULL COMMENT '国家',
  `province` varchar(30) DEFAULT NULL COMMENT '省',
  `language` varchar(30) DEFAULT NULL COMMENT '语言',
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '头像地址',
  `subscribe_time` int(10) unsigned NOT NULL COMMENT '关注时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `subscribe_time` (`subscribe_time`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信粉丝表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_admin`
--

CREATE TABLE IF NOT EXISTS `fn_admin` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `realname` varchar(50) DEFAULT NULL COMMENT '管理员姓名',
  `usermenu` text COMMENT '自定义面板菜单，序列化数组格式',
  `color` text COMMENT '定制权限',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fn_admin`
--

INSERT INTO `fn_admin` (`uid`, `realname`, `usermenu`, `color`) VALUES
(1, '网站创始人', '', 'blue');

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment`
--

CREATE TABLE IF NOT EXISTS `fn_attachment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `siteid` tinyint(3) unsigned NOT NULL COMMENT '站点id',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `tableid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '附件副表id',
  `download` mediumint(8) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `filesize` int(10) unsigned NOT NULL COMMENT '文件大小',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filemd5` varchar(50) NOT NULL COMMENT '文件md5值',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `author` (`author`),
  KEY `relatedtid` (`related`),
  KEY `fileext` (`fileext`),
  KEY `filemd5` (`filemd5`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_0`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_0` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表0';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_1`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_1` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表1';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_2`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_2` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表2';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_3`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_3` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表3';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_4`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_4` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表4';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_5`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_5` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表5';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_6`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_6` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表6';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_7`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_7` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表7';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_8`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_8` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表8';

-- --------------------------------------------------------

--
-- 表的结构 `fn_attachment_9`
--

CREATE TABLE IF NOT EXISTS `fn_attachment_9` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表9';

-- --------------------------------------------------------

--
-- 表的结构 `fn_customer`
--

CREATE TABLE IF NOT EXISTS `fn_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `salerId` int(11) NOT NULL COMMENT '销售id',
  `debtTime` int(11) NOT NULL COMMENT '欠款时间',
  `meetTime` int(11) NOT NULL COMMENT '回访时间',
  `knot` int(11) NOT NULL COMMENT '回款',
  `debtBucket` int(11) NOT NULL,
  `debtMoney` decimal(10,2) NOT NULL,
  `depositBucket` int(11) NOT NULL,
  `remark` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `fn_customer`
--

INSERT INTO `fn_customer` (`id`, `cname`, `phone`, `address`, `salerId`, `debtTime`, `meetTime`, `knot`, `debtBucket`, `debtMoney`, `depositBucket`, `remark`) VALUES
(1, '测试A', '18509898918', '胶州', 3, 15, 15, 700, 1, '11.00', 1, 0),
(2, '测试B', '15111111112', '胶州', 4, 10, 10, 1030, 2, '0.00', 2, 0),
(3, '测试C', '15111111112', '胶州', 0, 0, 0, 0, 0, '0.00', 0, 0),
(4, '测试D', '18509898918', '胶州', 2, 15, 15, 100, 1, '101.00', 1, 0),
(5, '测试E', '18509898918', '胶州', 2, 10, 10, 300, 0, '0.00', 0, 0),
(6, '测试F', '15111111112', '胶州', 4, 10, 10, 260, 0, '0.00', 0, 0),
(10, '测试懂', '18509898911', '胶州时', 3, 14, 14, 0, 0, '0.00', 0, 0),
(9, '测A', '18509898918', '加州', 4, 15, 15, 0, 0, '0.00', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_customer_price`
--

CREATE TABLE IF NOT EXISTS `fn_customer_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(20) NOT NULL COMMENT '单位',
  `price` decimal(10,2) NOT NULL COMMENT '单价',
  `customerId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `fn_customer_price`
--

INSERT INTO `fn_customer_price` (`id`, `unit`, `price`, `customerId`) VALUES
(1, '桶装水', '5.00', 1),
(2, '瓶装水', '5.00', 1),
(3, '2L冰红茶', '34.00', 2),
(4, '2L绿茶', '36.00', 2),
(5, '2L绿茶', '6.00', 3),
(6, '2L红茶', '7.00', 3),
(7, '大桶水', '5.00', 4),
(8, '2L绿茶', '36.00', 4),
(9, '2L绿茶', '36.00', 10),
(10, '大桶水', '2.00', 10),
(11, '大桶水', '2.00', 5),
(12, '大桶水', '2.00', 6),
(13, '大桶水', '2.00', 9);

-- --------------------------------------------------------

--
-- 表的结构 `fn_field`
--

CREATE TABLE IF NOT EXISTS `fn_field` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '字段别名语言',
  `fieldname` varchar(50) NOT NULL COMMENT '字段名称',
  `fieldtype` varchar(50) NOT NULL COMMENT '字段类型',
  `relatedid` smallint(5) unsigned NOT NULL COMMENT '相关id',
  `relatedname` varchar(50) NOT NULL COMMENT '相关表',
  `isedit` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可修改',
  `ismain` tinyint(1) unsigned NOT NULL COMMENT '是否主表',
  `issystem` tinyint(1) unsigned NOT NULL COMMENT '是否系统表',
  `ismember` tinyint(1) unsigned NOT NULL COMMENT '是否会员可见',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可搜索',
  `disabled` tinyint(1) unsigned NOT NULL COMMENT '禁用？',
  `setting` text NOT NULL COMMENT '配置信息',
  `displayorder` tinyint(3) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `list` (`relatedid`,`disabled`,`issystem`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='字段表' AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `fn_field`
--

INSERT INTO `fn_field` (`id`, `name`, `fieldname`, `fieldtype`, `relatedid`, `relatedname`, `isedit`, `ismain`, `issystem`, `ismember`, `issearch`, `disabled`, `setting`, `displayorder`) VALUES
(8, '主题', 'title', 'Text', 4, 'module', 1, 1, 1, 1, 1, 0, '{"option":{"width":400,"fieldtype":"VARCHAR","fieldlength":"255"},"validate":{"xss":1,"required":1,"formattr":"onblur=\\"check_title();get_keywords(''keywords'');\\""}}', 0),
(9, '缩略图', 'thumb', 'File', 4, 'module', 1, 1, 1, 1, 1, 0, '{"option":{"ext":"jpg,gif,png","size":10,"width":400,"fieldtype":"VARCHAR","fieldlength":"255"}}', 0),
(10, '关键字', 'keywords', 'Text', 4, 'module', 1, 1, 1, 1, 1, 0, '{"option":{"width":400,"fieldtype":"VARCHAR","fieldlength":"255"},"validate":{"xss":1,"formattr":" data-role=\\"tagsinput\\""}}', 0),
(11, '描述', 'description', 'Textarea', 4, 'module', 1, 1, 1, 1, 1, 0, '{"option":{"width":500,"height":60,"fieldtype":"VARCHAR","fieldlength":"255"},"validate":{"xss":1,"filter":"dr_clearhtml"}}', 0),
(12, '内容', 'content', 'Ueditor', 4, 'module', 1, 0, 1, 1, 1, 0, '{"option":{"mode":1,"width":"90%","height":400},"validate":{"xss":1,"required":1}}', 0),
(25, '内容', 'neirong', 'Ueditor', 1, 'form-1', 1, 1, 0, 1, 0, 0, '{"option":{"width":"100%","height":"200","autofloat":"0","autoheight":"0","autodown":"0","page":"0","mode":"1","tool":"''bold'', ''italic'', ''underline''","mode2":"1","tool2":"''bold'', ''italic'', ''underline''","mode3":"1","tool3":"''bold'', ''italic'', ''underline''","value":""},"validate":{"required":"1","pattern":"","errortips":"","xss":"1","check":"","filter":"","tips":"","formattr":""},"is_right":"0"}', 0),
(23, '主题', 'title', 'Text', 1, 'form-1', 1, 1, 1, 1, 1, 0, '{"option":{"width":400,"fieldtype":"VARCHAR","fieldlength":"255"},"validate":{"xss":1,"required":1}}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_linkage`
--

CREATE TABLE IF NOT EXISTS `fn_linkage` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '菜单名称',
  `type` tinyint(1) unsigned NOT NULL,
  `code` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `module` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='联动菜单表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fn_linkage`
--

INSERT INTO `fn_linkage` (`id`, `name`, `type`, `code`) VALUES
(1, '中国地区', 0, 'address');

-- --------------------------------------------------------

--
-- 表的结构 `fn_linkage_data_1`
--

CREATE TABLE IF NOT EXISTS `fn_linkage_data_1` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site` mediumint(5) unsigned NOT NULL COMMENT '站点id',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) DEFAULT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `cname` varchar(30) NOT NULL COMMENT '别名',
  `child` tinyint(1) unsigned DEFAULT '0' COMMENT '是否有下级',
  `hidden` tinyint(1) unsigned DEFAULT '0' COMMENT '前端隐藏',
  `childids` text COMMENT '下级所有id',
  `displayorder` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cname` (`cname`),
  KEY `hidden` (`hidden`),
  KEY `list` (`site`,`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='联动菜单数据表' AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `fn_linkage_data_1`
--

INSERT INTO `fn_linkage_data_1` (`id`, `site`, `pid`, `pids`, `name`, `cname`, `child`, `hidden`, `childids`, `displayorder`) VALUES
(1, 1, 0, '0', '北京', 'beijing', 0, 0, '1', 0),
(2, 1, 0, '0', '天津', 'tianjin', 0, 0, '2', 0),
(3, 1, 0, '0', '上海', 'shanghai', 0, 0, '3', 0),
(4, 1, 0, '0', '重庆', 'chongqing', 0, 0, '4', 0),
(5, 1, 0, '0', '黑龙江', 'heilongjiang', 0, 0, '5', 0),
(6, 1, 0, '0', '吉林', 'jilin', 0, 0, '6', 0),
(7, 1, 0, '0', '辽宁', 'liaoning', 0, 0, '7', 0),
(8, 1, 0, '0', '河北', 'hebei', 0, 0, '8', 0),
(9, 1, 0, '0', '河南', 'henan', 0, 0, '9', 0),
(10, 1, 0, '0', '山东', 'shandong', 0, 0, '10', 0),
(11, 1, 0, '0', '江苏', 'jiangsu', 0, 0, '11', 0),
(12, 1, 0, '0', '山西', 'shanxi', 0, 0, '12', 0),
(13, 1, 0, '0', '陕西', 'shanxi1', 0, 0, '13', 0),
(14, 1, 0, '0', '甘肃', 'gansu', 0, 0, '14', 0),
(15, 1, 0, '0', '四川', 'sichuan', 0, 0, '15', 0),
(16, 1, 0, '0', '青海', 'qinghai', 0, 0, '16', 0),
(17, 1, 0, '0', '湖南', 'hunan', 0, 0, '17', 0),
(18, 1, 0, '0', '湖北', 'hubei', 0, 0, '18', 0),
(19, 1, 0, '0', '江西', 'jiangxi', 0, 0, '19', 0),
(20, 1, 0, '0', '安徽', 'anhui', 0, 0, '20', 0),
(21, 1, 0, '0', '浙江', 'zhejiang', 0, 0, '21', 0),
(22, 1, 0, '0', '福建', 'fujian', 0, 0, '22', 0),
(23, 1, 0, '0', '广东', 'guangdong', 0, 0, '23', 0),
(24, 1, 0, '0', '广西', 'guangxi', 0, 0, '24', 0),
(25, 1, 0, '0', '贵州', 'guizhou', 0, 0, '25', 0),
(26, 1, 0, '0', '云南', 'yunnan', 0, 0, '26', 0),
(27, 1, 0, '0', '海南', 'hainan', 0, 0, '27', 0),
(28, 1, 0, '0', '内蒙古', 'neimenggu', 0, 0, '28', 0),
(29, 1, 0, '0', '新疆', 'xinjiang', 0, 0, '29', 0),
(30, 1, 0, '0', '宁夏', 'ningxia', 0, 0, '30', 0),
(31, 1, 0, '0', '西藏', 'xicang', 0, 0, '31', 0),
(32, 1, 0, '0', '香港', 'xianggang', 0, 0, '32', 0),
(33, 1, 0, '0', '澳门', 'aomen', 0, 0, '33', 0),
(34, 1, 0, '0', '台湾', 'taiwan', 0, 0, '34', 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_mail_smtp`
--

CREATE TABLE IF NOT EXISTS `fn_mail_smtp` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `host` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `port` mediumint(8) unsigned NOT NULL,
  `displayorder` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮件账户表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_member`
--

CREATE TABLE IF NOT EXISTS `fn_member` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(40) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '加密密码',
  `salt` char(10) NOT NULL COMMENT '随机加密码',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `phone` char(20) NOT NULL COMMENT '手机号码',
  `avatar` varchar(255) NOT NULL COMMENT '头像地址',
  `money` decimal(10,2) unsigned NOT NULL COMMENT 'RMB',
  `freeze` decimal(10,2) unsigned NOT NULL COMMENT '冻结RMB',
  `spend` decimal(10,2) unsigned NOT NULL COMMENT '消费RMB总额',
  `score` int(10) unsigned NOT NULL COMMENT '虚拟币',
  `experience` int(10) unsigned NOT NULL COMMENT '经验值',
  `adminid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理组id',
  `groupid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `levelid` smallint(5) unsigned NOT NULL COMMENT '会员级别',
  `overdue` int(10) unsigned NOT NULL COMMENT '到期时间',
  `regip` varchar(15) NOT NULL COMMENT '注册ip',
  `regtime` int(10) unsigned NOT NULL COMMENT '注册时间',
  `randcode` mediumint(6) unsigned NOT NULL COMMENT '随机验证码',
  `ismobile` tinyint(1) unsigned DEFAULT NULL COMMENT '手机认证标识',
  PRIMARY KEY (`uid`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `groupid` (`groupid`),
  KEY `adminid` (`adminid`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fn_member`
--

INSERT INTO `fn_member` (`uid`, `email`, `username`, `password`, `salt`, `name`, `phone`, `avatar`, `money`, `freeze`, `spend`, `score`, `experience`, `adminid`, `groupid`, `levelid`, `overdue`, `regip`, `regtime`, `randcode`, `ismobile`) VALUES
(1, '', 'admin', 'ac7cd59472be180b81c7551b92925f03', 'b3967a0e93', '测试人员', '15111111112', '', '9999.00', '0.00', '0.00', 10000, 10000, 1, 0, 4, 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_member_data`
--

CREATE TABLE IF NOT EXISTS `fn_member_data` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `complete` tinyint(1) unsigned NOT NULL COMMENT '完善资料标识',
  `is_auth` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '实名认证标识',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fn_member_data`
--

INSERT INTO `fn_member_data` (`uid`, `complete`, `is_auth`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_member_oauth`
--

CREATE TABLE IF NOT EXISTS `fn_member_oauth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL COMMENT '会员uid',
  `oid` varchar(255) NOT NULL COMMENT 'OAuth返回id',
  `oauth` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `expire_at` int(10) unsigned NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员OAuth2授权表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fn_module`
--

CREATE TABLE IF NOT EXISTS `fn_module` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `site` text COMMENT '站点划分',
  `dirname` varchar(50) NOT NULL COMMENT '目录名称',
  `share` tinyint(1) unsigned DEFAULT NULL COMMENT '是否共享模块',
  `extend` tinyint(1) unsigned DEFAULT NULL COMMENT '是否是扩展模块',
  `sitemap` tinyint(1) unsigned DEFAULT NULL COMMENT '是否生成地图',
  `setting` text COMMENT '配置信息',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁用？',
  `displayorder` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dirname` (`dirname`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模块表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `fn_module`
--

INSERT INTO `fn_module` (`id`, `site`, `dirname`, `share`, `extend`, `sitemap`, `setting`, `disabled`, `displayorder`) VALUES
(4, '{"name":"\\u6587\\u7ae0","urlrule":"4","search_title":"[\\u7b2c{page}\\u9875{join}][{keyword}{join}][{param}{join}]{modulename}{join}{SITE_NAME}","search_keywords":"","search_description":"","use":1}', 'news', 0, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_saler`
--

CREATE TABLE IF NOT EXISTS `fn_saler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `carNo` varchar(20) NOT NULL,
  `type` int(11) NOT NULL COMMENT '销售分类 1：水厂 2：仓库',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `fn_saler`
--

INSERT INTO `fn_saler` (`id`, `name`, `remark`, `phone`, `carNo`, `type`) VALUES
(4, '销售C', '', '18509898917', '鲁B-1234', 2),
(2, '销售A', '', '18509898918', '鲁B-123', 1),
(3, '销售B', '', '18509898918', '鲁B-123', 0),
(5, '销售D', '', '18509898918', '鲁B-123', 2);

-- --------------------------------------------------------

--
-- 表的结构 `fn_saler_bill`
--

CREATE TABLE IF NOT EXISTS `fn_saler_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salerId` int(11) NOT NULL,
  `salerName` varchar(20) NOT NULL,
  `bucketNum` int(11) NOT NULL,
  `drinkNum` int(11) NOT NULL COMMENT '饮料',
  `bottleNum` int(11) NOT NULL,
  `checker` varchar(20) NOT NULL,
  `saleTime` date NOT NULL,
  `remark` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  KEY `id_3` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `fn_saler_bill`
--

INSERT INTO `fn_saler_bill` (`id`, `salerId`, `salerName`, `bucketNum`, `drinkNum`, `bottleNum`, `checker`, `saleTime`, `remark`) VALUES
(1, 2, '测试1', 50, 0, 0, '', '2018-09-17', ''),
(2, 3, '测试2', 200, 0, 0, '', '2018-09-01', ''),
(3, 2, '销售A', 0, 200, 0, '', '2018-09-18', ''),
(4, 4, '测试3', 80, 0, 0, '', '2018-09-08', ''),
(5, 5, '测试3', 80, 0, 0, '', '2018-09-01', '');

-- --------------------------------------------------------

--
-- 表的结构 `fn_saler_bill_detail`
--

CREATE TABLE IF NOT EXISTS `fn_saler_bill_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `priceId` int(11) NOT NULL,
  `bucketNum` int(11) NOT NULL,
  `drinkNum` int(11) NOT NULL COMMENT '饮料',
  `bottleNum` int(11) NOT NULL,
  `backBucketNum` int(11) NOT NULL,
  `knot` decimal(10,2) NOT NULL COMMENT '结款',
  `debt` decimal(10,2) NOT NULL,
  `depositBucket` int(11) NOT NULL COMMENT '押桶',
  `remark` varchar(50) NOT NULL,
  `debtBucket` int(11) NOT NULL COMMENT '欠桶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `fn_saler_bill_detail`
--

INSERT INTO `fn_saler_bill_detail` (`id`, `billId`, `customerId`, `priceId`, `bucketNum`, `drinkNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `remark`, `debtBucket`) VALUES
(1, 1, 1, 1, 20, 0, 0, 20, '100.00', '1.00', 0, '', 0),
(2, 1, 6, 12, 30, 0, 0, 0, '60.00', '0.00', 0, '', 0),
(3, 2, 6, 12, 100, 0, 0, 100, '200.00', '0.00', 0, '', 0),
(4, 2, 5, 11, 100, 0, 0, 100, '200.00', '0.00', 0, '', 0),
(5, 4, 1, 1, 20, 0, 0, 0, '100.00', '0.00', 0, '', 0),
(6, 5, 5, 11, 50, 0, 0, 0, '100.00', '0.00', 0, '', 0),
(7, 4, 4, 7, 20, 0, 0, 0, '100.00', '100.00', 0, '', 0),
(8, 3, 1, 1, 0, 100, 0, 0, '500.00', '0.00', 0, '', 0),
(9, 3, 2, 3, 0, 30, 0, 0, '1020.00', '0.00', 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `fn_saler_fuel`
--

CREATE TABLE IF NOT EXISTS `fn_saler_fuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salerId` int(11) NOT NULL,
  `rise` int(11) NOT NULL COMMENT '加油量',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `date` date NOT NULL,
  `remark` varchar(100) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fn_saler_fuel`
--

INSERT INTO `fn_saler_fuel` (`id`, `salerId`, `rise`, `money`, `date`, `remark`) VALUES
(1, 1, 10, '100.00', '2018-09-02', ''),
(2, 1, 100, '100.00', '2018-09-15', '嘉禾');

-- --------------------------------------------------------

--
-- 表的结构 `fn_site`
--

CREATE TABLE IF NOT EXISTS `fn_site` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '站点名称',
  `domain` varchar(50) NOT NULL COMMENT '站点域名',
  `setting` text NOT NULL COMMENT '站点配置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='站点表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fn_site`
--

INSERT INTO `fn_site` (`id`, `name`, `domain`, `setting`) VALUES
(1, 'FineCMS', 'test.finecms.net', '{"SITE_CLOSE":"0","SITE_CLOSE_MSG":"\\u7f51\\u7ad9\\u5347\\u7ea7\\u4e2d....","SITE_NAME":"FineCMS","SITE_TIME_FORMAT":"Y-m-d H:i","SITE_LANGUAGE":"zh-cn","SITE_THEME":"default","SITE_TEMPLATE":"default","SITE_TIMEZONE":"8","SITE_DOMAINS":"","SITE_REWRITE":"6","SITE_MOBILE_OPEN":"1","SITE_MOBILE":"","SITE_SEOJOIN":"_","SITE_TITLE":"FineCMS\\u516c\\u76ca\\u8f6f\\u4ef6","SITE_KEYWORDS":"\\u514d\\u8d39cms,\\u5f00\\u6e90cms","SITE_DESCRIPTION":"\\u516c\\u76ca\\u8f6f\\u4ef6\\u4ea7\\u54c1\\u4ecb\\u7ecd","SITE_IMAGE_RATIO":"1","SITE_IMAGE_WATERMARK":"0","SITE_IMAGE_VRTALIGN":"top","SITE_IMAGE_HORALIGN":"left","SITE_IMAGE_VRTOFFSET":"","SITE_IMAGE_HOROFFSET":"","SITE_IMAGE_TYPE":"0","SITE_IMAGE_OVERLAY":"default.png","SITE_IMAGE_OPACITY":"","SITE_IMAGE_FONT":"default.ttf","SITE_IMAGE_COLOR":"","SITE_IMAGE_SIZE":"","SITE_IMAGE_TEXT":"","SITE_DOMAIN":"www.gyb.com","SITE_IMAGE_CONTENT":0}');

-- --------------------------------------------------------

--
-- 表的结构 `fn_urlrule`
--

CREATE TABLE IF NOT EXISTS `fn_urlrule` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL COMMENT '规则类型',
  `name` varchar(50) NOT NULL COMMENT '规则名称',
  `value` text NOT NULL COMMENT '详细规则',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='URL规则表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `fn_urlrule`
--

INSERT INTO `fn_urlrule` (`id`, `type`, `name`, `value`) VALUES
(1, 3, '栏目规则测试', '{"share_list":"{dirname}-list.html","share_list_page":"{dirname}-list-{page}.html","share_show":"{dirname}-show-{id}.html","share_show_page":"{dirname}-show-{id}-{page}.html","share_search":"","share_search_page":"","tags":""}'),
(2, 4, '站点URL测试', '{"share_list":"","share_list_page":"","share_show":"","share_show_page":"","share_search":"search.html","share_search_page":"search\\/{param}.html","tags":"tag\\/{tag}.html"}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
