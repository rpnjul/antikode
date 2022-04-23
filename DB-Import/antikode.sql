/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : antikode

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 23/04/2022 13:55:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES (1, 'Prima Freshmart', '/logo/a2e99ca04177f4787b0cb842be2ae03b.png', '/banner/60e79df4f2872d8aec25e9145d068ff2.jpg', '2022-04-21 15:19:46', '2022-04-22 14:53:19');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2022_04_20_133450_create_brand_table', 1);
INSERT INTO `migrations` VALUES (2, '2022_04_20_133505_create_outlet_table', 1);
INSERT INTO `migrations` VALUES (3, '2022_04_20_133525_create_product_table', 1);

-- ----------------------------
-- Table structure for outlet
-- ----------------------------
DROP TABLE IF EXISTS `outlet`;
CREATE TABLE `outlet`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of outlet
-- ----------------------------
INSERT INTO `outlet` VALUES (1, 1, 'Prima Freshmart Kampung Tengah', '/picture/9fd020e62e9f5d67af04c62bfaf1ecda.png', 'JL.Kayumanis RT.008/003 No.4', '106.85903181778669', '-6.2883301000002545', '2022-04-21 15:20:45', '2022-04-22 13:29:35');
INSERT INTO `outlet` VALUES (2, 1, 'Prima Freshmart Condet', '/picture/prima_freshmart_15_31_oktober_2020_2_jpg.jpg', 'JL.Kayumanis RT.008/003 No.4', '106.85212480050076', '-6.288110244715005', '2022-04-21 15:21:42', '2022-04-21 15:21:42');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `outlet_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (14, 1, 1, 'CP Ayam Size 2 Frozen', '/products/baa226c60d67e6bddded4e5974a69860.jpg', 100000, '2022-04-22 13:49:03', '2022-04-22 13:49:03');
INSERT INTO `product` VALUES (15, 1, 1, 'CP Ayam Size 1 Frozen', '/products/372cbc4ab311ec6aedfb15ed81ba6b38.jpg', 75000, '2022-04-22 13:49:21', '2022-04-22 13:49:21');
INSERT INTO `product` VALUES (17, 1, 1, 'FIESTA Paha Tanpa Tulang & Kulit', '/products/7d81ceed8b8363b5327a8ae528fc1783.jpg', 71500, '2022-04-22 13:56:15', '2022-04-22 13:56:15');
INSERT INTO `product` VALUES (18, 1, 1, 'FIESTA Ayam Premium 0,9 - 1 Kg', '/products/3b59ca95c5257ea81b6ef1124f1a5311.jpg', 41000, '2022-04-22 15:11:42', '2022-04-22 15:11:42');

SET FOREIGN_KEY_CHECKS = 1;
