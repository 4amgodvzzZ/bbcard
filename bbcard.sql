/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : bbcard

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 27/08/2018 16:30:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bb_t_account
-- ----------------------------
DROP TABLE IF EXISTS `bb_t_account`;
CREATE TABLE `bb_t_account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `balance` double(50, 2) DEFAULT 0.00 COMMENT '账户余额',
  `status` int(5) DEFAULT 1 COMMENT '1=正常  2=失效',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户账户表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of bb_t_account
-- ----------------------------
INSERT INTO `bb_t_account` VALUES (1, 4, 22.00, 1);
INSERT INTO `bb_t_account` VALUES (2, 18, 0.00, 1);

-- ----------------------------
-- Table structure for bb_t_card
-- ----------------------------
DROP TABLE IF EXISTS `bb_t_card`;
CREATE TABLE `bb_t_card`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardnum` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cardpassword` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `denomination_id` int(11) DEFAULT NULL COMMENT '面值',
  `salestatus` int(5) DEFAULT 1 COMMENT '1=待售，2=已售出，3=面额不符，4=无效卡密',
  `cardtype_id` int(11) DEFAULT NULL COMMENT '卡种',
  `createtime` datetime(0) DEFAULT NULL COMMENT '供货时间',
  `saletime` datetime(0) DEFAULT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `xxx`(`cardtype_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户卡表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bb_t_card
-- ----------------------------
INSERT INTO `bb_t_card` VALUES (1, '1654654541341346', '445465', 4, 1, 1, 1, '2018-08-13 14:32:24', '2018-08-13 14:32:26');
INSERT INTO `bb_t_card` VALUES (2, '87875757', '445465', 4, 1, 2, 5, '2018-08-13 14:32:27', '2018-08-13 14:32:29');
INSERT INTO `bb_t_card` VALUES (3, '87875757', '445465', 4, 1, 2, 3, '2018-08-13 14:32:30', '2018-08-13 14:32:32');
INSERT INTO `bb_t_card` VALUES (4, '87875757', '445465', 4, 1, 4, 1, '2018-08-13 14:32:33', '2018-08-13 14:32:34');
INSERT INTO `bb_t_card` VALUES (5, '87875757', '445465', 4, 1, 3, 6, '2018-08-13 14:32:36', '2018-08-13 14:32:37');
INSERT INTO `bb_t_card` VALUES (6, '87875757', '445465', 4, 1, 2, 1, '2018-08-13 14:32:42', '2018-08-13 14:32:43');
INSERT INTO `bb_t_card` VALUES (7, '87875757', '445465', 4, 2, 2, 2, '2018-08-13 14:32:39', '2018-08-13 14:32:44');
INSERT INTO `bb_t_card` VALUES (8, '87875757', '4454659999', 4, 3, 3, 1, '2018-08-13 14:32:48', '2018-08-13 14:32:46');
INSERT INTO `bb_t_card` VALUES (9, '87875757', '5555555555', 4, 1, 2, 4, '2018-08-13 14:32:51', '2018-08-13 14:32:52');
INSERT INTO `bb_t_card` VALUES (10, '444444444', '445465xfsdfsdf', 4, 1, 2, 1, '2018-08-13 14:32:49', '2018-08-13 14:32:54');
INSERT INTO `bb_t_card` VALUES (11, 'cccccc', '445465xxxxxx', 4, 1, 2, 3, '2018-08-13 14:32:56', '2018-08-13 14:32:59');
INSERT INTO `bb_t_card` VALUES (12, 'cccccc', '445465xxxxxx', 4, 1, 2, 1, '2018-08-13 14:33:01', '2018-08-13 14:33:02');
INSERT INTO `bb_t_card` VALUES (13, 'cccccc', '445465xxxxxx', 4, 1, 2, 1, '2018-08-13 14:33:03', '2018-08-13 14:33:06');

-- ----------------------------
-- Table structure for bb_t_cardtype
-- ----------------------------
DROP TABLE IF EXISTS `bb_t_cardtype`;
CREATE TABLE `bb_t_cardtype`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `type` int(5) DEFAULT NULL COMMENT '1=油卡，2=话费卡',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '卡种类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bb_t_cardtype
-- ----------------------------
INSERT INTO `bb_t_cardtype` VALUES (1, '中石化', 1);
INSERT INTO `bb_t_cardtype` VALUES (2, '中石油省卡', 1);
INSERT INTO `bb_t_cardtype` VALUES (3, '中石油', 1);
INSERT INTO `bb_t_cardtype` VALUES (4, '移动', 2);
INSERT INTO `bb_t_cardtype` VALUES (5, '联通', 2);
INSERT INTO `bb_t_cardtype` VALUES (6, '电信', 2);

-- ----------------------------
-- Table structure for bb_t_denomination
-- ----------------------------
DROP TABLE IF EXISTS `bb_t_denomination`;
CREATE TABLE `bb_t_denomination`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardtype_id` int(11) DEFAULT NULL,
  `costprice` double(10, 2) DEFAULT NULL COMMENT '原价',
  `rulingprice` double(10, 2) DEFAULT NULL COMMENT '收卡价',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '卡面值，现价表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of bb_t_denomination
-- ----------------------------
INSERT INTO `bb_t_denomination` VALUES (1, 1, 50.00, 49.25);
INSERT INTO `bb_t_denomination` VALUES (2, 1, 100.00, 99.00);
INSERT INTO `bb_t_denomination` VALUES (3, 1, 200.00, 198.20);
INSERT INTO `bb_t_denomination` VALUES (4, 1, 500.00, 496.00);
INSERT INTO `bb_t_denomination` VALUES (5, 1, 1000.00, 992.00);
INSERT INTO `bb_t_denomination` VALUES (6, 2, 50.00, 49.25);
INSERT INTO `bb_t_denomination` VALUES (7, 2, 50.00, 49.25);
INSERT INTO `bb_t_denomination` VALUES (8, 2, 100.00, 99.00);
INSERT INTO `bb_t_denomination` VALUES (9, 2, 100.00, 99.00);
INSERT INTO `bb_t_denomination` VALUES (10, 3, 200.00, 198.20);
INSERT INTO `bb_t_denomination` VALUES (11, 3, 200.00, 198.20);
INSERT INTO `bb_t_denomination` VALUES (12, 3, 500.00, 496.00);
INSERT INTO `bb_t_denomination` VALUES (13, 3, 1000.00, 992.00);
INSERT INTO `bb_t_denomination` VALUES (15, 3, 1000.00, 992.00);
INSERT INTO `bb_t_denomination` VALUES (16, 4, 50.00, 49.25);
INSERT INTO `bb_t_denomination` VALUES (17, 5, 500.00, 496.00);
INSERT INTO `bb_t_denomination` VALUES (18, 4, 500.00, 496.00);
INSERT INTO `bb_t_denomination` VALUES (19, 6, 50.00, 49.00);

-- ----------------------------
-- Table structure for bb_t_salerecords
-- ----------------------------
DROP TABLE IF EXISTS `bb_t_salerecords`;
CREATE TABLE `bb_t_salerecords`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '销售记录表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for bb_t_user
-- ----------------------------
DROP TABLE IF EXISTS `bb_t_user`;
CREATE TABLE `bb_t_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `creadtetime` datetime(0) DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bb_t_user
-- ----------------------------
INSERT INTO `bb_t_user` VALUES (4, '17673098929', 'eyJpdiI6Ik5xZlVJdEpwMzlncnFIYW16eWFHVWc9PSIsInZhbHVlIjoiMkEyNk5Hanh3N1pTelwvODB0ZEtcL1JRPT0iLCJtYWMiOiI4MmExZTliMDJmZjA1YmFjYzkyMWRmYTU0NDM0Njg5ZDA3NjMxYTg4Njc1ODllYjJlNzVlN2NiNjI5N2MxMzA2In0=', '2018-08-09 04:08:53');
INSERT INTO `bb_t_user` VALUES (18, '18888888888', 'eyJpdiI6InBUSEc5WkxwU1VqU2tIc0NVb21ucHc9PSIsInZhbHVlIjoiSzRLeGFmNmM0S2NIRUVcL01IK2h0dnc9PSIsIm1hYyI6ImRjM2ZlM2EzNGY3ZWRjMGM1ZTRlY2Y4ZThhMzlmZGFjYTVjMzBiZjM4ZGRmMjQ4NDdhZTMzNjkxNWE0NmJmZDIifQ==', '2018-08-10 09:08:54');

SET FOREIGN_KEY_CHECKS = 1;
