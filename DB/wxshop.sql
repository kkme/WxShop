-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014-10-17 17:05:45
-- 服务器版本: 5.5.38-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wxshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '管理员名',
  `password` varchar(45) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `time` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '０：未处理，１：已处理',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL COMMENT '对应store表的id',
  `name` varchar(45) NOT NULL COMMENT '商品名',
  `type_id` int(11) NOT NULL COMMENT '分类编号',
  `originalPrice` float NOT NULL COMMENT '原价',
  `retailPrice` float NOT NULL COMMENT '现价',
  `headerImg` varchar(45) NOT NULL COMMENT '标题图',
  `description` varchar(45) NOT NULL COMMENT '商品详情\n',
  `quantity` int(11) NOT NULL COMMENT '产品数量',
  `remainingQuantity` int(11) NOT NULL COMMENT '产品剩余量',
  `sellQuantity` int(11) NOT NULL COMMENT '销量　',
  `time` int(11) NOT NULL COMMENT '上架时间',
  `status` tinyint(1) NOT NULL COMMENT '０：下架，１：上架',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `store_id`, `name`, `type_id`, `originalPrice`, `retailPrice`, `headerImg`, `description`, `quantity`, `remainingQuantity`, `sellQuantity`, `time`, `status`) VALUES
(5, 11, 'HTC 8x', 6, 9.9, 9.9, '543def52ae8c2.jpg', '这是系统自动添加的商品，请及时删除', 7, 1, 0, 1413345113, 1),
(8, 11, '西装', 3, 0, 8.8, '543cd4b37967c.jpg', '最新西装一件', 0, 10, 0, 1413272785, 1),
(10, 11, '苹果手机1', 6, 0, 4888, '543ce505a79f7.jpg', '最新的苹果手机', 0, 99, 0, 1413340275, 1),
(12, 11, '锤子手机', 6, 0, 3999, '543ddccc01efa.jpg', '情怀手机', 0, 99, 0, 1413340404, 1),
(15, 14, 'HTC 8X', 10, 0, 1999, 'goodsImg_20130928092447328_8155033662.jpg', '最新款HTC机器', 0, 100, 0, 1413448541, 1),
(16, 14, '锤子手机', 11, 0, 3999, 'goodsImg_2014091915125431587_8794634495.jpg', '情怀手机', 0, 100, 0, 1413448579, 1),
(17, 14, '小米手机', 12, 0, 999, 'goodsImg_v54u2pyw2zru_1835819524.jpg', '屌丝品牌机', 0, 100, 0, 1413448623, 1);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `store_id` int(11) NOT NULL COMMENT '商家id',
  `count` int(11) NOT NULL COMMENT '商品数量',
  `total_price` varchar(45) NOT NULL COMMENT '总共价格\n',
  `consignee_name` varchar(45) NOT NULL COMMENT '收货人姓名',
  `consignee_phone` varchar(45) NOT NULL COMMENT '收货人手机号',
  `consignee_address` varchar(45) NOT NULL COMMENT '收货人地址',
  `consignee_comment` varchar(45) NOT NULL COMMENT '收货人留言',
  `time` int(11) NOT NULL COMMENT '订单创建时间',
  `status` tinyint(1) NOT NULL COMMENT '０：订单创建，交易尚未完成\n１：交易成功',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `user_id`, `goods_id`, `store_id`, `count`, `total_price`, `consignee_name`, `consignee_phone`, `consignee_address`, `consignee_comment`, `time`, `status`) VALUES
(1, 1, 17, 14, 2, '1998', '夏立波', '18943125835', '吉林农业大学四舍102', '给卖家留言（选填）', 1413516735, 0),
(2, 1, 17, 14, 2, '1998', '夏立波', '18943125835', '吉林农业大学四舍102', '给卖家留言（选填）', 1413517140, 0),
(3, 1, 17, 14, 2, '1998', '夏立波', '18943125835', '吉林农业大学四舍102', '给卖家留言（选填）', 1413517146, 1),
(4, 2, 15, 14, 1, '1999', '李博', '18943125836', '吉林大学', '请速度发货', 1413517214, 1),
(5, 1, 16, 14, 3, '11997', '张三', '18243007894', '吉大科技园', '请发黄色', 1413517346, 1);

-- --------------------------------------------------------

--
-- 表的结构 `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL COMMENT '店名',
  `intro` varchar(45) NOT NULL COMMENT '商家简介',
  `avatar` varchar(45) NOT NULL COMMENT '商家店标',
  `shoper_ID` varchar(45) NOT NULL COMMENT '商家身份证号',
  `shoper_name` varchar(45) NOT NULL COMMENT '商家名',
  `shoper_phone` varchar(45) NOT NULL COMMENT '商家手机号码',
  `address` varchar(45) NOT NULL COMMENT '商家所在地址',
  `time` int(11) NOT NULL COMMENT '注册时间',
  `status` smallint(6) NOT NULL COMMENT '０：注册但未激活，１：账号激活且可用，-1：账号被禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `store`
--

INSERT INTO `store` (`id`, `password`, `title`, `intro`, `avatar`, `shoper_ID`, `shoper_name`, `shoper_phone`, `address`, `time`, `status`) VALUES
(11, 'e10adc3949ba59abbe56e057f20f883e', '格子铺02', '测试商家', '543e2d601a125.jpg', '123456789', '张三', '18943125836', '吉林大学', 1413360998, 1),
(14, 'e10adc3949ba59abbe56e057f20f883e', '微信小店', '我的微信小店', 'avatar_507-082646_5674076117.jpg', '123', '张三', '18943125835', '吉林', 1413428170, 1);

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `store_id` int(11) NOT NULL COMMENT '所属商家',
  `name` varchar(45) NOT NULL COMMENT '类别名',
  `time` varchar(45) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品分类表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `type`
--

INSERT INTO `type` (`id`, `store_id`, `name`, `time`) VALUES
(2, 11, '最新女装', '1413266800'),
(3, 11, '最新男装', '1413266935'),
(4, 11, '最新童装', '1413266968'),
(6, 11, '科技产品', '1413275853'),
(10, 14, '科技产品', '1413448281'),
(11, 14, '汽车产品', '1413448294'),
(12, 14, '服装产品', '1413448311');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户主键\n',
  `open_id` varchar(45) NOT NULL COMMENT '在微信中表示open_id，手机浏览器生成后填入',
  `phone` varchar(45) NOT NULL COMMENT '用户手机号码，也是登陆账号',
  `password` varchar(45) NOT NULL COMMENT '密码',
  `name` varchar(45) NOT NULL COMMENT '用户名',
  `sex` tinyint(1) NOT NULL COMMENT '性别',
  `address` varchar(45) NOT NULL COMMENT '用户地址',
  `time` int(11) NOT NULL COMMENT '注册时间',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '０：注册但未激活，１：账号激活且可用，-1：账号被禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `open_id`, `phone`, `password`, `name`, `sex`, `address`, `time`, `status`) VALUES
(1, '', '18943125835', 'e10adc3949ba59abbe56e057f20f883e', '夏立波', 1, '吉林农业大学四舍102', 0, 1),
(2, '', '18943125836', 'e10adc3949ba59abbe56e057f20f883e', '李博', 1, '吉林农业大学四舍102', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
