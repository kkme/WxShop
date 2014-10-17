-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014-10-13 15:40:47
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `store_id`, `name`, `type_id`, `originalPrice`, `retailPrice`, `headerImg`, `description`, `quantity`, `remainingQuantity`, `sellQuantity`, `time`, `status`) VALUES
(3, 11, '自动添加的商品，请删除1', 0, 9.9, 9.9, 'example.jpg', '这是系统自动添加的商品，请及时删除', 7, 1, 0, 1413177809, 1),
(4, 11, '自动添加的商品，请删除2', 0, 9.9, 9.9, 'example.jpg', '这是系统自动添加的商品，请及时删除', 7, 1, 0, 1413177819, 1),
(5, 11, '自动添加的商品，请删除3', 0, 9.9, 9.9, 'example.jpg', '这是系统自动添加的商品，请及时删除', 7, 1, 0, 1413177829, 1),
(6, 11, '自动添加的商品，请删除4', 0, 9.9, 9.9, 'example.jpg', '这是系统自动添加的商品，请及时删除', 7, 1, 0, 1413177839, 1);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `pay` float NOT NULL COMMENT '支付金额',
  `pay_status` tinyint(1) NOT NULL COMMENT '０：尚未支付，１：支付完成',
  `store_status` tinyint(1) NOT NULL COMMENT '０：收到订单尚未发货\n１：已发货',
  `time` int(11) NOT NULL COMMENT '订单创建时间',
  `status` tinyint(1) NOT NULL COMMENT '０：订单创建，交易尚未完成\n１：交易成功',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `store`
--

INSERT INTO `store` (`id`, `password`, `title`, `intro`, `avatar`, `shoper_ID`, `shoper_name`, `shoper_phone`, `address`, `time`, `status`) VALUES
(11, 'e10adc3949ba59abbe56e057f20f883e', '格子铺', '测试商家', '543b61b2890ea.jpg', '123456789', '张三', '18943125835', '吉林大学', 1413177778, 1);

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL COMMENT '分类id',
  `store_id` int(11) NOT NULL COMMENT '所属商家',
  `name` varchar(45) NOT NULL COMMENT '类别名',
  `time` varchar(45) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分类表';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
