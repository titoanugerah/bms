/*
 Navicat Premium Data Transfer

 Source Server         : Prototype
 Source Server Type    : MySQL
 Source Server Version : 100203
 Source Host           : localhost:3306
 Source Schema         : iasent

 Target Server Type    : MySQL
 Target Server Version : 100203
 File Encoding         : 65001

 Date: 14/05/2020 05:13:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for asset
-- ----------------------------
DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `SN` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ModelId` int(11) NOT NULL,
  `UserId` int(11) NULL DEFAULT NULL,
  `LastLogId` int(11) NOT NULL,
  `PICId` int(11) NOT NULL,
  `Price` int(11) NULL DEFAULT 0,
  `IsExist` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset
-- ----------------------------
INSERT INTO `asset` VALUES (1, '2345678', 'By acs', 2, NULL, 35, 4, 1200000, 1);
INSERT INTO `asset` VALUES (2, NULL, 'For staff only', 1, NULL, 34, 3, 0, 1);
INSERT INTO `asset` VALUES (3, NULL, 'For staff only', 1, NULL, 33, 3, 0, 1);

-- ----------------------------
-- Table structure for assetlog
-- ----------------------------
DROP TABLE IF EXISTS `assetlog`;
CREATE TABLE `assetlog`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `AssetId` int(11) NULL DEFAULT NULL,
  `Status` int(2) NULL DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DateTime` timestamp(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of assetlog
-- ----------------------------
INSERT INTO `assetlog` VALUES (1, 1, 1, 'Order requst submited', 'nifnieni', '2020-05-03 16:04:23');
INSERT INTO `assetlog` VALUES (2, 2, 1, 'Tito Anugerah M selaku ITAdmin mengajukan permohonan pembelian asset', '3', '2020-05-03 16:13:55');
INSERT INTO `assetlog` VALUES (3, 3, 1, 'Tito Anugerah M selaku ITAdmin mengajukan permohonan pembelian asset', '3', '2020-05-03 16:13:55');
INSERT INTO `assetlog` VALUES (4, 2, 1, 'Tito Anugerah M selaku ITAdmin menghapus data asset ini ', 'Update by 3', '2020-05-07 14:09:04');
INSERT INTO `assetlog` VALUES (5, 2, 1, 'Tito Anugerah M selaku ITAdmin menghapus data asset ini ', 'Update by 3', '2020-05-07 14:12:20');
INSERT INTO `assetlog` VALUES (6, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:21:25');
INSERT INTO `assetlog` VALUES (7, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:48:39');
INSERT INTO `assetlog` VALUES (8, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:49:45');
INSERT INTO `assetlog` VALUES (9, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:50:10');
INSERT INTO `assetlog` VALUES (10, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:50:11');
INSERT INTO `assetlog` VALUES (11, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:50:11');
INSERT INTO `assetlog` VALUES (12, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:50:12');
INSERT INTO `assetlog` VALUES (13, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:51:39');
INSERT INTO `assetlog` VALUES (14, 1, 1, 'Tito Anugerah M selaku ITAdmin menghapus data asset ini ', 'Update by 3', '2020-05-07 14:51:57');
INSERT INTO `assetlog` VALUES (15, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:52:12');
INSERT INTO `assetlog` VALUES (16, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:53:22');
INSERT INTO `assetlog` VALUES (17, 0, NULL, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:53:33');
INSERT INTO `assetlog` VALUES (18, 1, 1, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:54:08');
INSERT INTO `assetlog` VALUES (19, 1, 1, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:54:22');
INSERT INTO `assetlog` VALUES (20, 1, 1, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:54:28');
INSERT INTO `assetlog` VALUES (21, 1, 1, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:54:36');
INSERT INTO `assetlog` VALUES (22, 1, 1, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 14:54:37');
INSERT INTO `assetlog` VALUES (23, 2, 1, 'Tito Anugerah M selaku ITAdmin memulihkan data asset ini ', 'Update by 3', '2020-05-07 15:03:25');
INSERT INTO `assetlog` VALUES (24, NULL, NULL, 'Tito Anugerah selaku Manager memulihkan data asset ini ', 'Update by 1', '2020-05-07 16:23:12');
INSERT INTO `assetlog` VALUES (25, NULL, NULL, 'Tito Anugerah selaku Manager memulihkan data asset ini ', 'Update by 1', '2020-05-07 16:23:25');
INSERT INTO `assetlog` VALUES (26, NULL, NULL, 'Tito Anugerah selaku Manager memulihkan data asset ini ', 'Update by 1', '2020-05-07 16:23:43');
INSERT INTO `assetlog` VALUES (27, 2, 3, 'Tito Anugerah selaku Manager menyetujui permohonan pengadaan asset ini ', 'Approve by 1', '2020-05-09 16:23:20');
INSERT INTO `assetlog` VALUES (28, 2, 3, 'Tito Anugerah selaku Manager menyetujui permohonan pengadaan asset ini ', 'Approve by 1', '2020-05-09 16:24:05');
INSERT INTO `assetlog` VALUES (29, 1, 3, 'Tito Anugerah selaku Manager menyetujui permohonan pengadaan asset ini ', 'Approve by 1', '2020-05-10 12:32:57');
INSERT INTO `assetlog` VALUES (30, 3, 3, 'Tito Anugerah selaku Manager menyetujui permohonan pengadaan asset ini ', 'Approve by 1', '2020-05-10 12:32:57');
INSERT INTO `assetlog` VALUES (31, 1, 5, 'Alfalah Okdinda selaku GeneralManager menyetujui permohonan pengadaan asset ini ', 'Approve by 6', '2020-05-10 16:34:30');
INSERT INTO `assetlog` VALUES (32, 2, 5, 'Alfalah Okdinda selaku GeneralManager menyetujui permohonan pengadaan asset ini ', 'Approve by 6', '2020-05-10 16:34:32');
INSERT INTO `assetlog` VALUES (33, 3, 5, 'Alfalah Okdinda selaku GeneralManager menyetujui permohonan pengadaan asset ini ', 'Approve by 6', '2020-05-10 16:34:36');
INSERT INTO `assetlog` VALUES (34, 2, 7, 'Putri Maulani selaku ITPIC berhasil melakukan registrasi asset ini dengan Nomor Seri = 6VJJZM2', 'Registered by 4', '2020-05-10 17:14:30');
INSERT INTO `assetlog` VALUES (35, 1, 7, 'Putri Maulani selaku ITPIC berhasil melakukan registrasi asset ini dengan Nomor Seri = 2345678', 'Registered by 4', '2020-05-10 21:57:33');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `PICId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES (1, 'LG', 'Remain', 5, 1);
INSERT INTO `brand` VALUES (2, 'Dell', 'Dellelala', 4, 1);
INSERT INTO `brand` VALUES (3, 'Samsung', '', 4, 1);
INSERT INTO `brand` VALUES (4, 'Apple', '', 4, 1);
INSERT INTO `brand` VALUES (5, 'Sony', '', 4, 1);
INSERT INTO `brand` VALUES (6, 'Raspberry', '', 4, 1);
INSERT INTO `brand` VALUES (7, 'Epson', '', 4, 1);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `GeneralManagerId` int(11) NOT NULL,
  `AdminId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (1, 'IS PROMOTION', 'TEST', 6, 2, 1);
INSERT INTO `department` VALUES (2, 'Logistics', 'Test Logistic', 3, 2, 1);

-- ----------------------------
-- Table structure for division
-- ----------------------------
DROP TABLE IF EXISTS `division`;
CREATE TABLE `division`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ManagerId` int(11) NOT NULL,
  `DepartmentId` int(11) NOT NULL,
  `AdminId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of division
-- ----------------------------
INSERT INTO `division` VALUES (1, 'PMS', 'yowww', 1, 1, 2, 1);
INSERT INTO `division` VALUES (22, 'System Development', 'LALALA', 1, 1, 2, 1);

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Type` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'PFA',
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (1, 'Laptop', 'lala', 'PFA', 1);
INSERT INTO `item` VALUES (2, 'Printer Thermal', 'Printer ', 'PFA', 1);
INSERT INTO `item` VALUES (3, 'Paket Komputer', 'CPU + Mouse + Keyboard ', 'PFA', 1);
INSERT INTO `item` VALUES (4, 'Ponsel', '', 'PFA', 1);

-- ----------------------------
-- Table structure for model
-- ----------------------------
DROP TABLE IF EXISTS `model`;
CREATE TABLE `model`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ItemId` int(11) NOT NULL,
  `BrandId` int(11) NOT NULL,
  `PICId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model
-- ----------------------------
INSERT INTO `model` VALUES (1, 'Business Latitude 5490s', 'Prosesor: Intel Core i5-8350U\nRAM: 4GB DDR4\nHDD: 1TB\nNvidia GeForce MX130 2GB\nUkuran Layar: 14 Inch FHD\nSistem Operasi: Win 10 pro 64 Bit', 'Model_1.jpg', 'Main Notebook', 1, 2, 4, 1);
INSERT INTO `model` VALUES (2, 'iPhone X 256GB', 'Prosesor: Apple A11 Bionic Hexa-core (2x Monsoon + 4x Mistral)\nRAM: 3GB\nLebar Layar: 5.8 inch\nKamera Depan: 7 MP\nKamera Belakang: 12 MP + 12 MP\nBaterai: 2716 mAh\nSensor: Face ID\nSistem Operasi: iOS 11', 'Model_2.jpg', 'Untuk General Manager', 4, 4, 4, 1);

-- ----------------------------
-- Table structure for request
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `RequestDate` timestamp(0) NULL DEFAULT current_timestamp(0),
  `PIC AssetId` int(11) NULL DEFAULT NULL,
  `LastLogId` int(11) NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `CheckAdminUserDate` date NULL DEFAULT NULL,
  `CheckManagerUserDate` date NULL DEFAULT NULL,
  `CheckAdminISPDate` date NULL DEFAULT NULL,
  `CheckManagerISPDate` date NULL DEFAULT NULL,
  `ConfirmGMDate` date NULL DEFAULT NULL,
  `ApproveSGMDate` date NULL DEFAULT NULL,
  `ApproveISPMgrDate` date NULL DEFAULT NULL,
  `ApproveISPGMDate` date NULL DEFAULT NULL,
  `ApproveISPSGMDate` date NULL DEFAULT NULL,
  `ReceivedUserAdminDate` date NULL DEFAULT NULL,
  `ReceiveUserDate` date NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for requestdetail
-- ----------------------------
DROP TABLE IF EXISTS `requestdetail`;
CREATE TABLE `requestdetail`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `RequestId` int(11) NULL DEFAULT NULL,
  `ItemId` int(11) NULL DEFAULT NULL,
  `ModelId` int(11) NULL DEFAULT NULL,
  `Purpose` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Reason` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Status` int(2) NULL DEFAULT NULL,
  `AssetId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Fullname` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Ext` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Role` int(2) NOT NULL DEFAULT 1,
  `AdminId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'titoanugerah@gmail.com', 'Tito Anugerah', '', 'https://lh3.googleusercontent.com/a-/AOh14GjhiOOPKbxpV2Vqi7s74J8I5NiMg1weY6mdkDLj4g', 5, 2, 1);
INSERT INTO `user` VALUES (2, 'mgfirdausi@student.ce.undip.ac.id', 'Maulida Goldy Firdausi', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GjQ2uL0zt_JaTZnx0rAoUkulIchWOsqLyzCCxrF', 2, 2, 1);
INSERT INTO `user` VALUES (3, 'titoanugerah@student.undip.ac.id', 'Tito Anugerah M', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GjUf1qTRGYH017ERdk6avyDH5r261BWBfmfWJB6', 3, 2, 1);
INSERT INTO `user` VALUES (4, 'putrimaulanii20@gmail.com', 'Putri Maulani', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GiMfjN0Sa9JBohMox9E4aU7vTdQgaS6bzBk_2z1', 4, 2, 1);
INSERT INTO `user` VALUES (5, 'dedpyb@gmail.com', 'Alfalah Okdinda', NULL, 'https://lh4.googleusercontent.com/-DbmfUs99NSU/AAAAAAAAAAI/AAAAAAAAAAA/AAKWJJMrHBH5QwmMIE9OHP_CLM5T4xlnNA/photo.jpg', 1, 2, 1);
INSERT INTO `user` VALUES (6, 'falahodn@100tahun.id', 'Alfalah Okdinda', NULL, 'https://lh4.googleusercontent.com/-DbmfUs99NSU/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucleTFs7tfSpK0ityYKledJhMRDnKw/photo.jpg', 6, 2, 1);

-- ----------------------------
-- Table structure for usergeneralmanager
-- ----------------------------
DROP TABLE IF EXISTS `usergeneralmanager`;
CREATE TABLE `usergeneralmanager`  (
  `Id` int(11) NOT NULL,
  `DepartmentId` int(11) NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usergeneralmanager
-- ----------------------------
INSERT INTO `usergeneralmanager` VALUES (6, 1);

-- ----------------------------
-- Table structure for usermanager
-- ----------------------------
DROP TABLE IF EXISTS `usermanager`;
CREATE TABLE `usermanager`  (
  `Id` int(11) NOT NULL,
  `DivisionId` int(11) NOT NULL,
  PRIMARY KEY (`Id`, `DivisionId`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usermanager
-- ----------------------------
INSERT INTO `usermanager` VALUES (1, 1);
INSERT INTO `usermanager` VALUES (1, 22);

-- ----------------------------
-- Table structure for userstaff
-- ----------------------------
DROP TABLE IF EXISTS `userstaff`;
CREATE TABLE `userstaff`  (
  `Id` int(11) NOT NULL,
  `DivisionId` int(11) NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of userstaff
-- ----------------------------
INSERT INTO `userstaff` VALUES (2, 1);
INSERT INTO `userstaff` VALUES (3, 1);
INSERT INTO `userstaff` VALUES (4, 1);
INSERT INTO `userstaff` VALUES (5, 1);

-- ----------------------------
-- Table structure for webconf
-- ----------------------------
DROP TABLE IF EXISTS `webconf`;
CREATE TABLE `webconf`  (
  `Id` int(1) NOT NULL,
  `Name` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Slogan` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Host` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Port` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Crypto` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DevMode` int(1) NULL DEFAULT NULL,
  `Theme` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Background` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of webconf
-- ----------------------------
INSERT INTO `webconf` VALUES (1, 'IASENT', '', 'WebConf_1.jpeg', 'smtp.office365.com', 'admin@sipmaft.com', 'teknik@2019', '587', 'TLS', 0, 'secondary', 'purple');

-- ----------------------------
-- View structure for viewasset
-- ----------------------------
DROP VIEW IF EXISTS `viewasset`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewasset` AS SELECT
	a.Id,
	a.SN,
	a.ModelId,
	g.Id as ItemId,
	g.`Name` as Item,
	g.Type as ItemType,
	c.`Name` AS Model,
	c.BrandId,
	d.`Name` AS Brand,
	c.Image AS ModelImage,
	a.Price,
	a.UserId,
	b.Fullname AS UserName,
	b.Email AS UserEmail,
	b.Ext AS UserExt,
	b.Image AS UserImage,
	a.LastLogId,
	e.Description AS LastLog,
	e.Remark AS LastLogRemark,
	e.`Status`, 
	a.PICId,
	f.Fullname AS PICName,
	f.Email AS PICEmail,
	f.Ext AS PICExt,
	f.Image AS PICImage,
	h.Department,
	h.DepartmentId,
	a.Remark,
	a.IsExist
FROM
	`Asset` AS a
	LEFT JOIN `User` AS b ON ( a.UserId = b.Id )
	INNER JOIN `Model` AS c ON ( a.ModelId = c.Id )
	INNER JOIN `Brand` AS d ON ( c.BrandId = d.Id )
	INNER JOIN `Item` AS g ON ( g.Id = c.ItemId )
	INNER JOIN `AssetLog` AS e ON ( a.LastLogId = e.Id )
	INNER JOIN `User` AS f ON ( a.PICId = f.Id )
  INNER JOIN `ViewMember` as h ON (f.Id = h.Id) ;

-- ----------------------------
-- View structure for viewdivision
-- ----------------------------
DROP VIEW IF EXISTS `viewdivision`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewdivision` AS SELECT
	DISTINCT(`a`.`Id`) AS `Id`,
	`a`.`Name` AS `Division`,
	`a`.`Description` AS `Description`,
	`a`.`ManagerId` AS `ManagerId`,
	`c`.`Fullname` AS `Manager`,
	`a`.`DepartmentId` AS `DepartmentId`,
	`b`.`Name` AS `Department`,
	`b`.`GeneralManagerId` AS `GeneralManagerId`,
	`e`.`Fullname` AS `GeneralManager`,
	`a`.`AdminId` AS `AdminId`,
	`g`.`Fullname` AS `Admin`,
	`a`.`IsExist` AS `IsExist` 
FROM
	(
		( ( ( ( ( `division` `a` JOIN `department` `b` ) JOIN `user` `c` ) JOIN `usermanager` `d` ) JOIN `user` `e` ) JOIN `usergeneralmanager` `f` )
		JOIN `user` `g` 
	) 
WHERE
	(
		( `a`.`DepartmentId` = `b`.`Id` ) 
		AND ( `a`.`ManagerId` = `c`.`Id` ) 
		AND ( `c`.`Id` = `d`.`Id` ) 
		AND ( `e`.`Id` = `b`.`GeneralManagerId` ) 
		AND ( `e`.`Id` = `f`.`Id` ) 
	AND ( `b`.`AdminId` = `g`.`Id` ) 
	) ;

-- ----------------------------
-- View structure for viewmember
-- ----------------------------
DROP VIEW IF EXISTS `viewmember`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewmember` AS SELECT DISTINCT
	`a`.`Id` AS `Id`,
	ifnull( `a`.`Fullname`, concat( '(', `a`.`Email`, ') Unverified' ) ) AS `Fullname`,
	`a`.`Email` AS `Email`,
	`a`.`Ext` AS `Ext`,
	`a`.`Image` AS `Image`,
	`a`.`Role` AS `Role`,
	`a`.`IsExist` AS `IsExist`,
	`c`.`Id` AS `DivisionId`,
	`c`.`Name` AS `Division`,
	`c`.`DepartmentId` AS `DepartmentId`,
	`f`.`Name` as `Department` 
FROM
	( ( ( ( `user` `a` JOIN `userstaff` `b` ) JOIN `division` `c` ) JOIN `usermanager` `d` ) JOIN `usergeneralmanager` `e` ) JOIN department as f 
WHERE
	(
	IF
		(
			( `a`.`Role` = 6 ),
			( `e`.`Id` = `a`.`Id` ),
		IF
			(
				( `a`.`Role` = 5 ),
				( `d`.`Id` = `a`.`Id` ),
			IF
				( ( `a`.`Role` <= 4 ), ( `b`.`Id` = `a`.`Id` ), '' ) 
			) 
		) 
	AND
	IF
		(
			( `a`.`Role` = 6 ),
			( `d`.`DivisionId` = `c`.`Id` ),
		IF
			(
				( `a`.`Role` = 5 ),
				( `d`.`DivisionId` = `c`.`Id` ),
			IF
				( ( `a`.`Role` <= 4 ), ( `b`.`DivisionId` = `c`.`Id` ), '' ) 
			) 
		) 
	)
	and
	c.DepartmentId = f.Id
	GROUP BY Id ;

-- ----------------------------
-- View structure for viewmodel
-- ----------------------------
DROP VIEW IF EXISTS `viewmodel`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewmodel` AS select 
	a.Id,
	a.`Name`,
	a.Description,
	a.Image,
	a.Remark,
	a.ItemId,
	c.`Name` as 'Item',
	c.Type as 'Type',
	a.BrandId,
	b.`Name` as 'Brand',
	a.PICId,
	a.IsExist
from 
	model as a,
	brand as b,
	item as c
	
WHERE
 a.ItemId = c.Id
 and
 a.BrandId = b.Id ;

SET FOREIGN_KEY_CHECKS = 1;
