/*
Navicat MySQL Data Transfer

Source Server         : admin
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : blogss

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-14 17:38:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `xl_admin_nav`
-- ----------------------------
DROP TABLE IF EXISTS `xl_admin_nav`;
CREATE TABLE `xl_admin_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单表',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '所属菜单',
  `name` varchar(15) DEFAULT '' COMMENT '菜单名称',
  `mca` varchar(255) DEFAULT '' COMMENT '模块、控制器、方法',
  `ico` varchar(20) DEFAULT '' COMMENT 'font-awesome图标',
  `order_number` int(11) unsigned DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_admin_nav
-- ----------------------------
INSERT INTO `xl_admin_nav` VALUES ('1', '0', '内容管理', 'Admin/ShowArc/Article', 'fa-list-ul', '1');
INSERT INTO `xl_admin_nav` VALUES ('3', '1', '文章列表', 'Admin/Article/index', '', null);
INSERT INTO `xl_admin_nav` VALUES ('5', '0', '用户管理', 'Admin/ShowRule/Rule', 'fa-users', '4');
INSERT INTO `xl_admin_nav` VALUES ('4', '0', '回收站管理', 'Admin/ShowRecycle/Recycle', 'fa-trash', '3');
INSERT INTO `xl_admin_nav` VALUES ('6', '0', '网站设置', 'Admin/ShowConfig/Config', 'fa-cogs', '5');
INSERT INTO `xl_admin_nav` VALUES ('2', '0', '碎言评论', 'Admin/ShowChat/Chat', 'fa-comments', '2');

-- ----------------------------
-- Table structure for `xl_article`
-- ----------------------------
DROP TABLE IF EXISTS `xl_article`;
CREATE TABLE `xl_article` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章表主键',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `author` varchar(15) NOT NULL DEFAULT '' COMMENT '作者',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `content` mediumtext NOT NULL COMMENT '文章内容',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` char(255) NOT NULL DEFAULT '' COMMENT '描述',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '文章是否显示 1是 0否',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1是 0否',
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶 1是 0否',
  `is_original` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否原创',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `cid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_article
-- ----------------------------

-- ----------------------------
-- Table structure for `xl_article_pic`
-- ----------------------------
DROP TABLE IF EXISTS `xl_article_pic`;
CREATE TABLE `xl_article_pic` (
  `ap_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '图片路径',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属文章id',
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_article_pic
-- ----------------------------

-- ----------------------------
-- Table structure for `xl_article_tag`
-- ----------------------------
DROP TABLE IF EXISTS `xl_article_tag`;
CREATE TABLE `xl_article_tag` (
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章id',
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_article_tag
-- ----------------------------
INSERT INTO `xl_article_tag` VALUES ('1', '1');
INSERT INTO `xl_article_tag` VALUES ('1', '3');
INSERT INTO `xl_article_tag` VALUES ('2', '1');
INSERT INTO `xl_article_tag` VALUES ('2', '3');
INSERT INTO `xl_article_tag` VALUES ('3', '1');
INSERT INTO `xl_article_tag` VALUES ('3', '3');

-- ----------------------------
-- Table structure for `xl_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `xl_auth_group`;
CREATE TABLE `xl_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL COMMENT '规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of xl_auth_group
-- ----------------------------
INSERT INTO `xl_auth_group` VALUES ('1', '超级管理', '1', '1,2,4,6,9,10,11,12,13,14,15,16,17,18,19,20,21,22,24,25,26,31,27,28,29,30,32,52,33,34,53,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,54,55,59,56,57,58');
INSERT INTO `xl_auth_group` VALUES ('2', '文章管理', '1', '1,2,4,6,9,10,11');

-- ----------------------------
-- Table structure for `xl_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `xl_auth_group_access`;
CREATE TABLE `xl_auth_group_access` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of xl_auth_group_access
-- ----------------------------
INSERT INTO `xl_auth_group_access` VALUES ('88', '1');
INSERT INTO `xl_auth_group_access` VALUES ('89', '2');
INSERT INTO `xl_auth_group_access` VALUES ('92', '2');

-- ----------------------------
-- Table structure for `xl_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `xl_auth_rule`;
CREATE TABLE `xl_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of xl_auth_rule
-- ----------------------------
INSERT INTO `xl_auth_rule` VALUES ('1', '0', 'Admin/Index/index', '后台首页', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('2', '1', 'Admin/Index/welcome', '欢迎界面', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('4', '0', 'Admin/ShowArc/Article', '文章管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('10', '6', 'Admin/Article/add', '添加文章', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('6', '4', 'Admin/Article/index', '显示文章', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('9', '6', 'Admin/Article/edit', '修改文章', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('11', '6', 'Admin/Article/delete', '删除文章', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('12', '4', 'Admin/Tag/index', '标签管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('13', '12', 'Admin/Tag/add', '添加标签', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('14', '12', 'Admin/Tag/edit', '修改标签', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('15', '12', 'Admin/Tag/delete', '删除标签', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('16', '4', 'Admin/Category/index', '分类管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('17', '16', 'Admin/Category/sort', '分类排序', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('18', '16', 'Admin/Category/add', '分类添加', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('19', '16', 'Admin/Category/edit', '分类修改', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('20', '16', 'Admin/Category/delete', '分类删除', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('21', '0', 'Admin/ShowRule/Rule', '用户管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('22', '21', 'Admin/Rule/index', '权限管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('24', '22', 'Admin/Rule/add', '添加权限', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('25', '22', 'Admin/Rule/edit', '修改权限', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('26', '22', 'Admin/Rule/delete', '删除权限', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('27', '21', 'Admin/Rule/group', '用户组列表', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('28', '27', 'Admin/Rule/add_group', '添加用户组', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('29', '27', 'Admin/Rule/edit_group', '修改用户组', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('30', '27', 'Admin/Rule/delete_group', '删除用户组', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('31', '22', 'Admin/Rule/rule_group', '分配权限', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('32', '27', 'Admin/Rule/check_user', '添加成员', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('33', '21', 'Admin/Rule/admin_user_list', '管理员列表', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('34', '33', 'Admin/Rule/add_admin', '管理员添加', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('35', '0', 'Admin/ShowRecycle/Recycle', '回收站管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('36', '35', 'Admin/Recycle/article', '已删文章', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('37', '35', 'Admin/Recycle/comment', '已删评论', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('38', '35', 'Admin/Recycle/chat', '已删随言碎语', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('39', '35', 'Admin/Recycle/link', '已删友情链接', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('40', '0', 'Admin/ShowConfig/Config', '网站设置', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('41', '40', 'Admin/Config/index', '网站信息', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('42', '41', 'Admin/Config/change_password', '修改密码', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('43', '40', 'Admin/Link/index', '友情链接', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('44', '43', 'Admin/Link/add', '添加友情链接', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('45', '43', 'Admin/Link/edit', '修改友情链接', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('46', '0', 'Admin/ShowNav/Nav', '菜单管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('47', '46', 'Admin/Nav/index', '菜单列表', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('48', '47', 'Admin/Nav/add', '菜单添加', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('49', '47', 'Admin/Nav/edit', '菜单修改', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('50', '47', 'Admin/Nav/delete', '菜单删除', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('51', '47', 'Admin/Nav/order', '菜单排序', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('52', '27', 'Admin/Rule/add_user_to_group', '添加用户到用户组', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('53', '33', 'Admin/Rule/edit_admin', '修改管理员', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('54', '0', 'Admin/ShowChat/Chat', '碎言评论', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('55', '54', 'Admin/Comment/index', '评论管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('56', '54', 'Admin/Chat/index', '随言碎语管理', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('57', '56', 'Admin/Chat/add', '随言碎语添加', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('58', '56', 'Admin/Chat/edit', '随言碎语修改', '1', '1', '');
INSERT INTO `xl_auth_rule` VALUES ('59', '55', 'Admin/Comment/change_status', '审核', '1', '1', '');

-- ----------------------------
-- Table structure for `xl_category`
-- ----------------------------
DROP TABLE IF EXISTS `xl_category`;
CREATE TABLE `xl_category` (
  `cid` tinyint(2) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类主键id',
  `cname` varchar(15) NOT NULL DEFAULT '' COMMENT '分类名称',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键词',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '父级栏目id',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_category
-- ----------------------------
INSERT INTO `xl_category` VALUES ('1', 'php', 'php', 'php', '0', '0');
INSERT INTO `xl_category` VALUES ('2', '前端', '前端', '前端\r\n', '1', '0');
INSERT INTO `xl_category` VALUES ('3', 'Linux', 'Linux', 'Linux', '3', '0');

-- ----------------------------
-- Table structure for `xl_chat`
-- ----------------------------
DROP TABLE IF EXISTS `xl_chat`;
CREATE TABLE `xl_chat` (
  `chid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '碎言id',
  `date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表时间',
  `content` text NOT NULL COMMENT '内容',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`chid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_chat
-- ----------------------------
INSERT INTO `xl_chat` VALUES ('1', '1475401618', '测试12', '1', '0');

-- ----------------------------
-- Table structure for `xl_comment`
-- ----------------------------
DROP TABLE IF EXISTS `xl_comment`;
CREATE TABLE `xl_comment` (
  `cmtid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `ouid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论用户id 关联oauth_user表的id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1：文章评论',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `aid` int(10) unsigned NOT NULL COMMENT '文章id',
  `content` text NOT NULL COMMENT '内容',
  `date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论日期',
  `status` tinyint(1) unsigned NOT NULL COMMENT '1:已审核 0：未审核',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`cmtid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `xl_config`
-- ----------------------------
DROP TABLE IF EXISTS `xl_config`;
CREATE TABLE `xl_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置项键名',
  `value` text COMMENT '配置项键值 1表示开启 0 关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_config
-- ----------------------------
INSERT INTO `xl_config` VALUES ('1', 'WEB_NAME', '小林博客');
INSERT INTO `xl_config` VALUES ('2', 'WEB_KEYWORDS', '小林博客,技术博客,个人博客,xlblog');
INSERT INTO `xl_config` VALUES ('3', 'WEB_DESCRIPTION', '小林个人技术博客,小林博客官方网站');
INSERT INTO `xl_config` VALUES ('4', 'WEB_STATUS', '1');
INSERT INTO `xl_config` VALUES ('5', 'ADMIN_PASSWORD', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `xl_config` VALUES ('6', 'WATER_TYPE', '1');
INSERT INTO `xl_config` VALUES ('7', 'TEXT_WATER_WORD', 'missxiaolin.com');
INSERT INTO `xl_config` VALUES ('8', 'TEXT_WATER_TTF_PTH', './Public/static/font/ariali.ttf');
INSERT INTO `xl_config` VALUES ('9', 'TEXT_WATER_FONT_SIZE', '15');
INSERT INTO `xl_config` VALUES ('10', 'TEXT_WATER_COLOR', '#008CBA');
INSERT INTO `xl_config` VALUES ('11', 'TEXT_WATER_ANGLE', '0');
INSERT INTO `xl_config` VALUES ('12', 'TEXT_WATER_LOCATE', '9');
INSERT INTO `xl_config` VALUES ('13', 'IMAGE_WATER_PIC_PTAH', './Upload/image/logo/logo.png');
INSERT INTO `xl_config` VALUES ('14', 'IMAGE_WATER_LOCATE', '9');
INSERT INTO `xl_config` VALUES ('15', 'IMAGE_WATER_ALPHA', '80');
INSERT INTO `xl_config` VALUES ('16', 'WEB_CLOSE_WORD', '网站升级中，请稍后访问。');
INSERT INTO `xl_config` VALUES ('17', 'WEB_ICP_NUMBER', '浙ICP备16034842号');
INSERT INTO `xl_config` VALUES ('18', 'ADMIN_EMAIL', '462441355@qq.com');
INSERT INTO `xl_config` VALUES ('19', 'COPYRIGHT_WORD', '本文为小林原创文章,转载无需和我联系,但请注明来自小林博客missxiaolin.com');
INSERT INTO `xl_config` VALUES ('20', 'QQ_APP_ID', '');
INSERT INTO `xl_config` VALUES ('21', 'CHANGYAN_APP_ID', 'cyrKRbJ5N');
INSERT INTO `xl_config` VALUES ('22', 'CHANGYAN_CONF', 'prod_c654661caf5ab6da98742d040413815b');
INSERT INTO `xl_config` VALUES ('23', 'WEB_STATISTICS', '');
INSERT INTO `xl_config` VALUES ('24', 'CHANGEYAN_RETURN_COMMENT', '');
INSERT INTO `xl_config` VALUES ('25', 'AUTHOR', '小林');
INSERT INTO `xl_config` VALUES ('26', 'QQ_APP_KEY', '');
INSERT INTO `xl_config` VALUES ('27', 'CHANGYAN_COMMENT', '');
INSERT INTO `xl_config` VALUES ('28', 'BAIDU_SITE_URL', '');
INSERT INTO `xl_config` VALUES ('29', 'DOUBAN_API_KEY', '');
INSERT INTO `xl_config` VALUES ('30', 'DOUBAN_SECRET', '');
INSERT INTO `xl_config` VALUES ('31', 'RENREN_API_KEY', '');
INSERT INTO `xl_config` VALUES ('32', 'RENREN_SECRET', '');
INSERT INTO `xl_config` VALUES ('33', 'SINA_API_KEY', '');
INSERT INTO `xl_config` VALUES ('34', 'SINA_SECRET', '');
INSERT INTO `xl_config` VALUES ('35', 'KAIXIN_API_KEY', '');
INSERT INTO `xl_config` VALUES ('36', 'KAIXIN_SECRET', '');
INSERT INTO `xl_config` VALUES ('37', 'SOHU_API_KEY', '');
INSERT INTO `xl_config` VALUES ('38', 'SOHU_SECRET', '');
INSERT INTO `xl_config` VALUES ('39', 'GITHUB_CLIENT_ID', '');
INSERT INTO `xl_config` VALUES ('40', 'GITHUB_CLIENT_SECRET', '');
INSERT INTO `xl_config` VALUES ('41', 'IMAGE_TITLE_ALT_WORD', '小林博客');
INSERT INTO `xl_config` VALUES ('42', 'EMAIL_SMTP', '');
INSERT INTO `xl_config` VALUES ('43', 'EMAIL_USERNAME', '');
INSERT INTO `xl_config` VALUES ('44', 'EMAIL_PASSWORD', '');
INSERT INTO `xl_config` VALUES ('45', 'EMAIL_FROM_NAME', '');
INSERT INTO `xl_config` VALUES ('46', 'COMMENT_REVIEW', '1');
INSERT INTO `xl_config` VALUES ('47', 'COMMENT_SEND_EMAIL', '0');
INSERT INTO `xl_config` VALUES ('48', 'EMAIL_RECEIVE', '');

-- ----------------------------
-- Table structure for `xl_link`
-- ----------------------------
DROP TABLE IF EXISTS `xl_link`;
CREATE TABLE `xl_link` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `lname` varchar(50) NOT NULL DEFAULT '' COMMENT '链接名',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '文章是否显示 1是 0否',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1是 0否',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_link
-- ----------------------------
INSERT INTO `xl_link` VALUES ('1', '后盾网', 'http://www.houdunwang.com/', '0', '1', '0');

-- ----------------------------
-- Table structure for `xl_oauth_user`
-- ----------------------------
DROP TABLE IF EXISTS `xl_oauth_user`;
CREATE TABLE `xl_oauth_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的本站用户id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1：QQ  2：新浪微博 3：豆瓣 4：人人 5：开心网',
  `nickname` varchar(30) NOT NULL DEFAULT '' COMMENT '第三方昵称',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `openid` varchar(40) NOT NULL DEFAULT '' COMMENT '第三方用户id',
  `access_token` varchar(255) NOT NULL DEFAULT '' COMMENT 'access_token token',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '绑定时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `login_times` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_oauth_user
-- ----------------------------

-- ----------------------------
-- Table structure for `xl_tag`
-- ----------------------------
DROP TABLE IF EXISTS `xl_tag`;
CREATE TABLE `xl_tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签主键',
  `tname` varchar(10) NOT NULL DEFAULT '' COMMENT '标签名',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_tag
-- ----------------------------
INSERT INTO `xl_tag` VALUES ('1', '快乐');
INSERT INTO `xl_tag` VALUES ('3', '美好');
INSERT INTO `xl_tag` VALUES ('4', '高兴');

-- ----------------------------
-- Table structure for `xl_users`
-- ----------------------------
DROP TABLE IF EXISTS `xl_users`;
CREATE TABLE `xl_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) unsigned DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) unsigned NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xl_users
-- ----------------------------
INSERT INTO `xl_users` VALUES ('88', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', null, '1', '1449199996', '', '0');
INSERT INTO `xl_users` VALUES ('89', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', null, '1', '1449199996', '', '0');
INSERT INTO `xl_users` VALUES ('92', 'admin6', 'e10adc3949ba59abbe56e057f20f883e', '', '', null, '0', '1', '1475314854', '', '0');
