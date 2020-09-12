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

 Date: 25/06/2020 03:48:57
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
  `PO` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ModelId` int(11) NOT NULL,
  `UserId` int(11) NULL DEFAULT NULL,
  `LastLogId` int(11) NOT NULL,
  `PICId` int(11) NOT NULL,
  `IsExist` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset
-- ----------------------------
INSERT INTO `asset` VALUES (1, ' QWERT', ' 12.143.99 ', NULL, 2, NULL, 1, 1, 1);
INSERT INTO `asset` VALUES (2, ' asdfgh', ' 12.143.99 ', NULL, 2, NULL, 2, 1, 1);
INSERT INTO `asset` VALUES (3, ' zxcvb', ' 12.143.99 ', NULL, 2, NULL, 3, 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of assetlog
-- ----------------------------
INSERT INTO `assetlog` VALUES (1, 1, 1, 'Randy Salmansur selaku IT Asset berhasil melakukan registrasi asset ini dengan Nomor Seri =  QWERT', 'Registered by 1', '2020-06-25 03:43:46');
INSERT INTO `assetlog` VALUES (2, 2, 1, 'Randy Salmansur selaku IT Asset berhasil melakukan registrasi asset ini dengan Nomor Seri =  asdfgh', 'Registered by 1', '2020-06-25 03:44:22');
INSERT INTO `assetlog` VALUES (3, 3, 1, 'Randy Salmansur selaku IT Asset berhasil melakukan registrasi asset ini dengan Nomor Seri =  zxcvb', 'Registered by 1', '2020-06-25 03:44:22');

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (1, 'IS Promotion', 'Bagian IT Epson', 1);
INSERT INTO `department` VALUES (2, 'Printer Design', 'Bagian Engineering  Epson', 1);

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (1, 'Laptop', 'Digunakan Sebagai kegiatan operasional kantor', 1);
INSERT INTO `item` VALUES (2, 'Ponsel', 'Digunakan Sebagai alat Komunikasi bisnis', 1);
INSERT INTO `item` VALUES (3, 'Ponsel', 'Digunakan Sebagai alat Komunikasi bisnis', 0);

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
  `PICId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model
-- ----------------------------
INSERT INTO `model` VALUES (1, 'Dell Latitude 3470', 'Ram : 8 GB', NULL, 'Staf Model', 1, 1, 1);
INSERT INTO `model` VALUES (2, 'Samsung J2', 'Ram : 16 GB', NULL, 'Staf Model', 2, 1, 1);

-- ----------------------------
-- Table structure for request
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NULL DEFAULT NULL,
  `AdminId` int(11) NULL DEFAULT NULL,
  `ItemId` int(11) NULL DEFAULT NULL,
  `ModelExpectation` int(11) NULL DEFAULT NULL,
  `Purpose` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LastLogId` int(11) NULL DEFAULT NULL,
  `IsExist` int(1) NULL DEFAULT 1,
  `Type` int(1) NULL DEFAULT 0,
  `AssetId` int(32) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for requestlog
-- ----------------------------
DROP TABLE IF EXISTS `requestlog`;
CREATE TABLE `requestlog`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `RequestId` int(11) NULL DEFAULT NULL,
  `Status` int(2) NULL DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Remark` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DateTime` timestamp(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IsITAsset` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'IT Asset', NULL, NULL);
INSERT INTO `role` VALUES (2, 'MGR IT Asset', NULL, NULL);
INSERT INTO `role` VALUES (3, 'GM IT Asset', NULL, NULL);
INSERT INTO `role` VALUES (4, 'PIC Asset', NULL, NULL);
INSERT INTO `role` VALUES (5, 'Mgr PIC Asset', NULL, NULL);
INSERT INTO `role` VALUES (6, 'GM PIC Asset', NULL, NULL);

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
  `RoleId` int(11) NOT NULL DEFAULT 1,
  `DepartmentId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'al.salmansur@gmail.com', 'Randy Salmansur', '1234', 'https://lh3.googleusercontent.com/a-/AOh14GijQ5U8X-sCnOnju5Wmjo_3kDQoNk3NMZwW_qLp', 1, 1, 1);
INSERT INTO `user` VALUES (2, 'randysal.0000@gmail.com', NULL, '1111', NULL, 4, 2, 1);
INSERT INTO `user` VALUES (3, 'randysal.mgr@gmail.com', NULL, '1212', NULL, 2, 1, 1);
INSERT INTO `user` VALUES (4, 'randysal.gm@gmail.com', NULL, '3333', NULL, 3, 1, 1);
INSERT INTO `user` VALUES (5, 'randysal.mgr.user@gmail.com', NULL, '4444', NULL, 5, 2, 1);
INSERT INTO `user` VALUES (6, 'randysal.gm.user@gmail.com', NULL, '5555', NULL, 6, 2, 1);

-- ----------------------------
-- Table structure for user_copy1
-- ----------------------------
DROP TABLE IF EXISTS `user_copy1`;
CREATE TABLE `user_copy1`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Fullname` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Ext` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `RoleId` int(11) NOT NULL DEFAULT 1,
  `DepartmentId` int(11) NOT NULL,
  `IsExist` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_copy1
-- ----------------------------
INSERT INTO `user_copy1` VALUES (1, 'putrimaulanii20@gmail.com', 'Putri Maulani', '1215', 'https://lh3.googleusercontent.com/a-/AOh14GiMfjN0Sa9JBohMox9E4aU7vTdQgaS6bzBk_2z1', 1, 1, 1);
INSERT INTO `user_copy1` VALUES (2, 'randysal.0000@gmail.com', 'Rano Drani', '1515', 'https://lh3.googleusercontent.com/-__55DKKudmQ/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucl9Z2Ales19ubbv1qtfzRvEQ5pT7w/photo.jpg', 2, 1, 1);
INSERT INTO `user_copy1` VALUES (3, 'titoanugerah@student.undip.ac.id', 'Tito Anugerah M', '1350', 'https://lh3.googleusercontent.com/a-/AOh14GjUf1qTRGYH017ERdk6avyDH5r261BWBfmfWJB6', 3, 1, 1);
INSERT INTO `user_copy1` VALUES (4, 'klasterpenida2@gmail.com', 'dea dianti', '1214', 'https://lh4.googleusercontent.com/-07BrJ87jJq0/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucmQahcLtUebdDDkNDLCUcG5uiw2IQ/photo.jpg', 4, 2, 1);
INSERT INTO `user_copy1` VALUES (5, 'mgfirdausi@student.ce.undip.ac.id', 'Maulida Goldy Firdausi', '1212', 'https://lh3.googleusercontent.com/a-/AOh14GjQ2uL0zt_JaTZnx0rAoUkulIchWOsqLyzCCxrF', 5, 2, 1);
INSERT INTO `user_copy1` VALUES (6, 'titoanugerah@gmail.com', 'Tito Anugerah', '1234', 'https://lh3.googleusercontent.com/a-/AOh14GjhiOOPKbxpV2Vqi7s74J8I5NiMg1weY6mdkDLj4g', 6, 2, 1);
INSERT INTO `user_copy1` VALUES (7, 'titoanugerah27@gmail.com', 'tito anugerah', '1234', 'https://lh3.googleusercontent.com/-eWgVJgh--W8/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucnLwPEjhs1eZ5Rm_JkoHYUsEKVigQ/photo.jpg', 3, 1, 1);
INSERT INTO `user_copy1` VALUES (8, 'nnin@nin.com', NULL, '1233', NULL, 5, 2, 1);

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
DROP VIEW IF EXISTS `ViewAsset`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `ViewAsset` AS SELECT
`a`.`Id` AS `Id`,
`a`.`SN` AS `SN`,
`a`.`PO` AS `PO`,
`a`.`ModelId` AS `ModelId`,
`g`.`Id` AS `ItemId`,
`g`.`Name` AS `Item`,
`c`.`Name` AS `Model`,
`c`.`Description` AS `Description`,
`c`.`Image` AS `ModelImage`,
`a`.`UserId` AS `UserId`,
`b`.`Fullname` AS `UserName`,
`b`.`Email` AS `UserEmail`,
`b`.`Ext` AS `UserExt`,
`b`.`Image` AS `UserImage`,
`a`.`LastLogId` AS `LastLogId`,
`e`.`Description` AS `LastLog`,
`e`.`Remark` AS `LastLogRemark`,
`e`.`Status` AS `Status`,
`a`.`PICId` AS `PICId`,
`f`.`Fullname` AS `PICName`,
`f`.`Email` AS `PICEmail`,
`f`.`Ext` AS `PICExt`,
`f`.`Image` AS `PICImage`,
`h`.`Name` AS `Department`,
`h`.`Id` AS `DepartmentId`,
`a`.`Remark` AS `Remark`,
`a`.`IsExist` AS `IsExist` 
FROM
	(
		(
			(
				(
					(
						( `Asset` `a` LEFT JOIN `User` `b` ON ( `a`.`UserId` = `b`.`Id` ) )
						JOIN `Model` `c` ON ( `a`.`ModelId` = `c`.`Id` ) 
					)
					JOIN `Item` `g` ON ( `g`.`Id` = `c`.`ItemId` ) 
				)
				JOIN `AssetLog` `e` ON ( `a`.`LastLogId` = `e`.`Id` ) 
			)
			JOIN `User` `f` ON ( `a`.`PICId` = `f`.`Id` ) 
		)
	JOIN `Department` `h` ON ( `f`.`DepartmentId` = `h`.`Id` ) 
	) ;

-- ----------------------------
-- View structure for viewmember
-- ----------------------------
DROP VIEW IF EXISTS `ViewMember`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `ViewMember` AS SELECT
	a.Id,
	ifnull( `a`.`Fullname`, concat( '(', `a`.`Email`, ') Unverified' ) ) AS `Fullname`,
a.Email,
a.Ext,
a.Image,
a.RoleId,
c.`Name` as Role, 
a.DepartmentId,
b.`Name` as Department,
a.IsExist

FROM
User AS a,
Department AS b,
Role AS c
WHERE	
a.DepartmentId = b.Id 
and
a.RoleId = c.Id ;

-- ----------------------------
-- View structure for viewmodel
-- ----------------------------
DROP VIEW IF EXISTS `ViewModel`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `ViewModel` AS select 
	a.Id,
	a.`Name`,
	a.Description,
	a.Image,
	a.Remark,
	a.ItemId,
	c.`Name` as 'Item',
	a.PICId,
	a.IsExist
from 
	model as a,
	item as c
WHERE
 a.ItemId = c.Id 
 ORDER BY
 a.Id ;

-- ----------------------------
-- View structure for viewrequest
-- ----------------------------
DROP VIEW IF EXISTS `ViewRequest`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `ViewRequest` AS SELECT
	a.Id,
	a.ItemId,
	b.`Name` AS Item,
	a.ModelExpectation,
	c.`Name` as Model,
	c.Description,
	a.Remark,
	a.Purpose,
	a.UserId,
	e.Fullname as User,
	g.Id as DepartmentId,
	g.`Name` as Department, 
	a.LastLogId,
	f.Description as Log,
	f.`Status`,
	f.DateTime as LogTime,
	a.IsExist,
	a.Type,
	a.AssetId,
	h.SN
		
FROM
	Request AS a
	INNER JOIN Item AS b ON ( a.ItemId = b.Id )
	LEFT JOIN Model AS c ON ( a.ModelExpectation = c.Id )
	LEFT JOIN User as e ON (a.UserId = e.Id)
	INNER JOIN Department as g on (a.AdminId = g.AdminId)
	LEFT JOIN RequestLog as f on (a.LastLogId = f.Id) 
  LEFT JOIN Asset as h on (a.AssetId = h.id)	
GROUP BY Id ;

SET FOREIGN_KEY_CHECKS = 1;
