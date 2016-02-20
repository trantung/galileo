-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: company
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL,
  `image_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_us`
--

LOCK TABLES `about_us` WRITE;
/*!40000 ALTER TABLE `about_us` DISABLE KEYS */;
INSERT INTO `about_us` VALUES (1,NULL,'Slogan.jpg',1,'Giới thiệu về chúng tôi','<p style=\"text-align:justify\"><strong>Công ty Cổ phần Truyền thông ABC &ndash; ABC Communications</strong> được thành lập vào tháng 8/2004 là doanh nghiệp hoạt động trong lĩnh vực truyền thông, quảng cáo và các dịch vụ viễn thông tại Việt Nam. Sản phẩm &ndash; Dịch vụ của chúng tôi bao gồm: Phát triển phần mềm; Thiết kế và lập trình website; Phát triển ứng dụng cho điện thoại di động; Cung cấp hạ tầng thanh toán cho các dịch vụ giá trị gia tăng trên nền tảng điện thoại di động&hellip;</p>\r\n',NULL,'2016-02-19 19:51:51','2016-01-25 13:38:16','2016-02-19 19:51:51'),(2,NULL,'Slogan.jpg',2,'About us','<p style=\"text-align:justify\"><strong>ABC Communications JSC.,</strong> is the first enterprise in Vietnam are permitted to provide value-added services, digital content services to customers on mobile networks and network information Internet. ABC products include applications, games, utility software, ... for mobile phone users in particular and the Internet in general.</p>\r\n',NULL,'2016-02-19 19:51:51','2016-01-25 13:38:16','2016-02-19 19:51:51'),(3,NULL,'Qua cau.png',3,'2004','<p>ABC Communications đã được thành lập</p>\r\n',NULL,NULL,'2016-01-25 13:39:09','2016-02-19 20:11:27'),(4,NULL,'Qua cau.png',4,'2004','<p>ABC Communications has been established</p>\r\n',NULL,NULL,'2016-01-25 13:39:09','2016-01-28 21:24:03'),(5,NULL,NULL,3,'2009','<p>Kỷ niệm 5 năm thành lập</p>\r\n',NULL,NULL,'2016-01-25 13:39:43','2016-01-28 21:22:21'),(6,NULL,NULL,4,'2009','<p>Celebrating 5 years anniversary</p>\r\n',NULL,NULL,'2016-01-25 13:39:43','2016-01-28 21:25:29'),(7,NULL,NULL,5,'Định hướng','<p style=\"text-align:justify\">Định hướng của chúng tôi là: Nghiên cứu, phát triển các sản phẩm phần mềm đáp ứng công nghệ mới trong lĩnh vực viễn thông, công nghệ thông tin</p>\r\n\r\n<p style=\"text-align:justify\">Xây dựng và triển khai các dịch vụ giá trị gia tăng trên nền công nghệ 3G cho mạng điện thoại di động</p>\r\n\r\n<p style=\"text-align:justify\">Xây dựng hệ thống quảng cáo E-Marketing</p>\r\n\r\n<p style=\"text-align:justify\">Đầu tư mở rộng hợp tác kinh doanh ra các nước trong khu vực.</p>\r\n',NULL,NULL,'2016-01-25 13:40:37','2016-02-19 20:16:37'),(8,NULL,NULL,6,'ORIENTATIONS','<p style=\"text-align:justify\">Our orientations is: Researching, developping software products to meet new technology in the fields of telecommunication, information technology; Constructing and deploying value-added services on 3G technology for mobile phone network; Constructing the E-Marketing advertising system; Investing to expand business cooperation to the countries in the area.</p>\r\n',NULL,NULL,'2016-01-25 13:40:37','2016-02-18 22:02:01'),(9,NULL,NULL,3,'&nbsp2014','<p>2014&nbsp;Kỷ niệm 10 năm thành lập</p>\r\n',NULL,NULL,'2016-01-28 21:25:19','2016-02-19 20:15:15'),(10,NULL,NULL,4,'2014','<p>Celebrating 10 years anniversary</p>\r\n',NULL,NULL,'2016-01-28 21:25:19','2016-02-19 20:15:15'),(11,NULL,NULL,1,'Chúng tôi','<p style=\"text-align:justify\"><p>Công ty Cổ phần Truyền thông ABC &ndash; ABC Communications</p> được thành lập vào tháng 8/2004<strong>, </strong>là doanh nghiệp hoạt động trong lĩnh vực truyền thông, quảng cáo và các dịch vụ viễn thông tại Việt Nam. Sản phẩm &ndash; Dịch vụ của chúng tôi bao gồm: Phát triển phần mềm; Thiết kế và lập trình website; Phát triển ứng dụng cho điện thoại di động; Cung cấp hạ tầng thanh toán cho các dịch vụ giá trị gia tăng trên nền tảng điện thoại di động&hellip;</p>\r\n\r\n<p style=\"text-align:justify\">Với đội ngũ cán bộ trẻ, năng động, sáng tạo và đầy nhiệt huyết cùng với trang thiết bị hiện đại, chúng tôi luôn hướng tới những Sản phẩm &ndash; Dịch vụ có chất lượng cao, đáp ứng những yêu cầu khác nhau của khách hàng.</p>\r\n\r\n<p style=\"text-align:justify\">Sự cầu thị, luôn lắng nghe ý kiến sẻ chia của khách hàng, sự linh hoạt trong từng mô hình hợp tác kinh doanh và sự tỉ mỉ trong phong cách làm việc đã tạo nên dấu ấn khác biệt đối với những Sản phẩm &ndash; Dịch vụ chúng tôi tham gia.</p>\r\n\r\n<p style=\"text-align:justify\">Với phương châm <em>&ldquo; Không ngừng tiến bước&rdquo;</em>, chúng tôi đã và đang nỗ lực không ngừng về nhân lực, vật lực để xây dựng nên uy tín, thương hiệu, niềm tin với khách hàng với những Sản phẩm &ndash; Dịch vụ chúng tôi cung cấp.</p>\r\n\r\n<p style=\"text-align:justify\">Chính sự tin tưởng và ủng hộ của khách hàng trong suốt những năm qua đã là nguồn động viên lớn lao trên bước đường phát triển của chúng tôi. Dựa vào đó chúng tôi biết rằng cần phải hoàn thiện hơn nữa các Sản phẩm &ndash; Dịch vụ để luôn xứng đáng với niềm tin mà khách hàng đã trao gửi.</p>\r\n\r\n<p style=\"text-align:justify\">Hy vọng rằng, chúng tôi sẽ luôn được đồng hành, cùng khách hàng gặt hái thêm nhiều thành công hơn trên con đường phía trước.</p>\r\n',NULL,NULL,'2016-02-19 19:53:14','2016-02-19 20:15:51'),(12,NULL,NULL,2,'About us','',NULL,NULL,'2016-02-19 19:53:15','2016-02-19 19:53:15');
/*!40000 ALTER TABLE `about_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,1,'trantunghn196@gmail.com','$2y$10$RKg9.9F.Ksu2TO4cebpAbe3Y4R2uJMzATNHvXn6LANGDTKQIpoS5.','tung1984','BxHBhYHRiQrbwIsJRM7sQlCB3RLW3RmOKDXn6IBfTDo0ygd9duUoIZWBKAKg',NULL,'2016-01-25 13:15:31','2016-01-28 13:47:39'),(2,2,'giangdt@abc-group.vn','$2y$10$jGmToR.4HT.hI4FUmYP2resEj1ScNucU63cOQtvl3DkdR/TCA9B8e','giangdt',NULL,NULL,'2016-02-19 19:06:01','2016-02-19 19:06:01');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bottom_texts`
--

DROP TABLE IF EXISTS `bottom_texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bottom_texts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bottom_texts`
--

LOCK TABLES `bottom_texts` WRITE;
/*!40000 ALTER TABLE `bottom_texts` DISABLE KEYS */;
INSERT INTO `bottom_texts` VALUES (1,2,'SALES DEPARTMENT','Liên hệ với chúng tôi ngay hôm nay','http://choinhanh.vn/',NULL,'2016-01-25 13:15:32','2016-02-03 15:22:04'),(2,2,'SALES DEPARTMENT','Please contact us now','http://choinhanh.vn/',NULL,'2016-01-25 13:15:32','2016-02-03 15:22:04');
/*!40000 ALTER TABLE `bottom_texts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `lat` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `long` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,NULL,'<p>CÔNG TY CỔ PHẦN TRUYỀN THÔNG ABC</p>\r\n\r\n<p>Địa chỉ: Số 5B/55 đường Huỳnh Thúc Kháng, Phường Láng Hạ, Quận Đống Đa, Hà Nội, Việt Nam</p>\r\n\r\n<p>Tel: (84-4) 37754334 - Fax: (84-4) 37754556</p>\r\n','21.017905','105.809192','lien-he',NULL,'2016-01-25 13:15:32','2016-01-28 19:34:15'),(2,NULL,'<p>ABC COMMUNICATIONS</p>\r\n\r\n<p>Address: No 5B/55 Huynh Thuc Khang Str., Lang Ha Ward, Dong Da Dist, Hanoi, Vietnam</p>\r\n\r\n<p>Tel: (84-4) 3.7754334 - Fax: (84-4) 37754556</p>\r\n','21.017905','105.809192','contact',NULL,'2016-01-25 13:15:32','2016-01-28 19:34:15');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `des_contents`
--

DROP TABLE IF EXISTS `des_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `des_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `des_contents`
--

LOCK TABLES `des_contents` WRITE;
/*!40000 ALTER TABLE `des_contents` DISABLE KEYS */;
INSERT INTO `des_contents` VALUES (1,'gioi-thieu-trang-chu','VỀ CHÚNG TÔI','<p style=\"text-align:justify\"><strong>Công ty Cổ phần Truyền thông ABC &ndash; ABC Communications</strong> được thành lập vào tháng 8/2004<strong>, </strong>là doanh nghiệp hoạt động trong lĩnh vực truyền thông, quảng cáo và các dịch vụ viễn thông tại Việt Nam. Sản phẩm &ndash; Dịch vụ của chúng tôi bao gồm: Phát triển phần mềm; Thiết kế và lập trình website; Phát triển ứng dụng cho điện thoại di động; Cung cấp hạ tầng thanh toán cho các dịch vụ giá trị gia tăng trên nền tảng điện thoại di động&hellip;</p>\r\n\r\n<p style=\"text-align:justify\">Với đội ngũ cán bộ trẻ, năng động, sáng tạo và đầy nhiệt huyết cùng với trang thiết bị hiện đại, chúng tôi luôn hướng tới những Sản phẩm &ndash; Dịch vụ có chất lượng cao, đáp ứng những yêu cầu khác nhau của khách hàng.</p>\r\n\r\n<p style=\"text-align:justify\">Sự cầu thị, luôn lắng nghe ý kiến sẻ chia của khách hàng, sự linh hoạt trong từng mô hình hợp tác kinh doanh và sự tỉ mỉ trong phong cách làm việc đã tạo nên dấu ấn khác biệt đối với những Sản phẩm &ndash; Dịch vụ chúng tôi tham gia.</p>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 19:55:12'),(2,'about-us-home','home about-us','<p><strong>ABC Communicaton, JSC</strong> is operating in communication, advertisement, event organization and telecommunication services in Vietnam. With young, active, creative and full of enthusiasm staffs, ABC always desires to provide the most useful information and best services for clients.</p>\r\n',NULL,'2016-01-25 13:15:32','2016-01-26 14:01:00');
/*!40000 ALTER TABLE `des_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `introduces`
--

DROP TABLE IF EXISTS `introduces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `introduces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `css` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `introduces`
--

LOCK TABLES `introduces` WRITE;
/*!40000 ALTER TABLE `introduces` DISABLE KEYS */;
INSERT INTO `introduces` VALUES (1,'fa fa-bar-chart',1,'Sứ mệnh','<p><span style=\"font-size:14px\">Nỗ lực hết mình để mang đến cho khách hàng những Sản phẩm - Dịch vụ chất lượng nhất</span></p>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 19:46:13'),(2,'fa fa-bar-chart',1,'Mission Statement','<ul>\r\n	<li>Bussiness Telecommunication Services</li>\r\n	<li>Services of Television Entertainment 1900xxxx, 8xx8</li>\r\n	<li>Supplying Content Services.</li>\r\n	<li>Supplying Callcenter &nbsp;Services.</li>\r\n	<li>Organizing Event, Advertisement Programs</li>\r\n	<li>Producing Software</li>\r\n</ul>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 16:16:52'),(3,'fa fa-wrench',2,'Tầm nhìn','<p><span style=\"font-size:14px\">Mong muốn trở thành doanh nghiệp hàng đầu Việt Nam trong lĩnh vực xây dựng phần mềm và phát triển các ứng dụng cho điện thoại di động</span></p>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 20:19:31'),(4,'fa fa-wrench',2,'Vision','<ul>\r\n	<li>CallCenter, IP Contact Center</li>\r\n	<li>IVR</li>\r\n	<li>Web Portal</li>\r\n	<li>SMS Gateway</li>\r\n	<li>MMS Gateway</li>\r\n</ul>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 16:25:48'),(5,'fa fa-phone',3,'Giá trị cốt lõi','<p style=\"text-align:justify\"><span style=\"font-size:14px\">Con người là tài sản quý giá, là nguồn lực cạnh tranh; Hợp tác cùng phát triển, hài hòa lợi ích với khách hàng</span></p>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 20:28:08'),(6,'fa fa-phone',3,'Core Values','<ul>\r\n	<li style=\"text-align:justify\">The first company is allowed to provide Value Added Services on mobile in Vietnam</li>\r\n	<li style=\"text-align:justify\">Experienced staff</li>\r\n	<li style=\"text-align:justify\">Modern system and equipments</li>\r\n	<li style=\"text-align:justify\">Good financial capacity</li>\r\n	<li style=\"text-align:justify\">Wide communications network</li>\r\n	<li style=\"text-align:justify\">Cooperative relationships with domestic and abroad partners</li>\r\n</ul>\r\n',NULL,'2016-01-25 13:15:32','2016-02-19 16:32:45');
/*!40000 ALTER TABLE `introduces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `model_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relate_id` int(11) DEFAULT NULL,
  `relate_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,1,1,1,'TypeAboutUs',2,'TypeAboutUs',NULL,'2016-01-25 13:15:32','2016-02-19 20:06:03'),(2,2,2,3,'TypeAboutUs',4,'TypeAboutUs',NULL,'2016-01-25 13:15:32','2016-02-19 20:06:22'),(3,1,3,5,'TypeAboutUs',6,'TypeAboutUs',NULL,'2016-01-25 13:15:32','2016-02-19 20:06:35'),(4,1,1,1,'TypeNew',2,'TypeNew',NULL,'2016-01-25 13:15:32','2016-02-03 19:23:02'),(5,1,2,3,'TypeNew',4,'TypeNew',NULL,'2016-01-25 13:15:32','2016-01-25 13:15:32'),(6,2,1,1,'AdminNew',2,'AdminNew',NULL,'2016-01-25 13:15:32','2016-01-28 21:53:23'),(7,2,2,3,'AdminNew',4,'AdminNew',NULL,'2016-01-25 13:15:32','2016-01-28 14:22:46'),(8,2,NULL,1,'BottomText',2,'BottomText',NULL,'2016-01-25 13:15:32','2016-02-03 15:22:04'),(9,2,NULL,1,'Contact',2,'Contact',NULL,'2016-01-25 13:15:32','2016-01-28 19:34:15'),(10,2,NULL,1,'Introduce',2,'Introduce',NULL,'2016-01-25 13:15:32','2016-01-25 13:15:32'),(11,2,NULL,3,'Introduce',4,'Introduce',NULL,'2016-01-25 13:15:32','2016-01-25 13:15:32'),(12,2,NULL,5,'Introduce',6,'Introduce',NULL,'2016-01-25 13:15:32','2016-01-25 13:15:32'),(13,2,3,5,'TypeNew',6,'TypeNew',NULL,'2016-01-25 13:29:10','2016-02-03 19:23:07'),(14,2,1,5,'AdminNew',6,'AdminNew',NULL,'2016-01-25 13:31:07','2016-02-19 20:47:45'),(15,2,2,7,'AdminNew',8,'AdminNew',NULL,'2016-01-25 13:31:52','2016-02-19 20:46:51'),(16,2,3,9,'AdminNew',10,'AdminNew',NULL,'2016-01-25 13:32:12','2016-02-19 20:46:28'),(17,NULL,NULL,1,'AboutUs',2,'AboutUs','2016-02-19 19:51:51','2016-01-25 13:38:16','2016-02-19 19:51:51'),(18,NULL,NULL,3,'AboutUs',4,'AboutUs',NULL,'2016-01-25 13:39:09','2016-01-25 13:39:09'),(19,NULL,NULL,5,'AboutUs',6,'AboutUs',NULL,'2016-01-25 13:39:43','2016-01-25 13:39:43'),(20,NULL,NULL,7,'AboutUs',8,'AboutUs',NULL,'2016-01-25 13:40:37','2016-01-25 13:40:37'),(21,2,2,11,'AdminNew',12,'AdminNew',NULL,'2016-01-25 13:43:34','2016-01-28 21:57:36'),(22,2,1,13,'AdminNew',14,'AdminNew',NULL,'2016-01-25 13:44:08','2016-01-28 22:02:38'),(23,2,1,15,'AdminNew',16,'AdminNew',NULL,'2016-01-28 14:09:15','2016-01-28 15:23:59'),(24,2,3,17,'AdminNew',18,'AdminNew',NULL,'2016-01-28 15:17:00','2016-01-28 15:17:48'),(25,NULL,NULL,9,'AboutUs',10,'AboutUs',NULL,'2016-01-28 21:25:19','2016-01-28 21:25:19'),(26,NULL,NULL,11,'AboutUs',12,'AboutUs',NULL,'2016-02-19 19:53:15','2016-02-19 19:53:15'),(27,2,4,19,'AdminNew',20,'AdminNew',NULL,'2016-02-19 20:32:54','2016-02-19 20:45:57');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2015_11_16_020926_create_type_news_table',1),('2015_11_16_020949_create_news_table',1),('2015_11_16_021117_create_roles_table',1),('2016_01_12_135210_create_admins_table',1),('2016_01_14_113458_create_slide_table',1),('2016_01_14_144252_create_language_table',1),('2016_01_14_144514_create_contact_table',1),('2016_01_14_144527_create_about_us_table',1),('2016_01_14_154330_create_introduce_table',1),('2016_01_15_140637_insert_about_us_type',1),('2016_01_15_140706_insert_about_us_type_id',1),('2016_01_15_141047_create_bottom_text_table',1),('2016_01_15_141345_create_customer_table',1),('2016_01_15_141805_insert_more_field_type_news',1),('2016_01_21_101720_create_des_content_table',1),('2016_01_21_105625_insert_slug_into_descontent',1),('2016_01_21_120220_insert_css_into_introduce',1),('2016_01_21_133237_insert_position_into_language',1),('2016_01_21_151853_insert_status_into_language',1),('2016_01_22_113535_insert_status_bottom_text',1),('2016_01_22_133450_insert_image_url_into_slide',1),('2016_01_23_131911_insert_sort_into_aboutus',1),('2016_01_23_151204_insert_position_into_type_about_us',1),('2016_01_23_152341_sort_into_type_aboutus',1),('2016_01_23_153626_position_into_type_new',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_new_id` int(11) DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,1,'Thông báo lịch nghỉ Tết Nguyên đán Bính Thân 2016','thong-bao-lich-nghi-tet-nguyen-dan-binh-than-2016','<div>Công ty Cổ phần Truyền thông ABC xin thông báo tới toàn thể nhân viên lịch nghỉ Tết Nguyên đán 2016 và lịch làm bù như sau:</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>1. Lịch nghỉ: Bắt đầu nghỉ từ ngày 6/2/2016 (thứ 7) và đi làm trở lại vào ngày 15/2/2016 (thứ 2)</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>2. Lịch làm bù: Do thời gian nghỉ tết có 2 thứ 7 không thuộc diện được nghỉ nên sẽ tiến hành làm bù vào 23/1 và 30/1.</div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\">&nbsp;</div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\"><img alt=\"\" src=\"/ckfinder/userfiles/images/THIEP1_2016.jpg\" style=\"height:339px; margin-left:150px; margin-right:150px; width:500px\" /></div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\">&nbsp;</div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\">Kính chúc năm mới<strong> HẠNH PHÚC - AN KHANG - THỊNH VƯỢNG</strong></div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\">&nbsp;</div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\">&nbsp;</div>\r\n\r\n<div style=\"font-family:arial,sans-serif;font-size:13.3333px\">&nbsp;</div>\r\n','Ecard 2016.jpg',NULL,NULL,'2016-01-25 13:15:32','2016-01-28 21:53:23'),(2,2,'Happy New Year','happy-new-year','<p>Happy New Year</p>\r\n','Ecard 2016.jpg',NULL,NULL,'2016-01-25 13:15:32','2016-01-28 21:53:23'),(3,3,'TUYỂN NHÂN VIÊN SEO - MARKETING ONLINE','tuyen-nhan-vien-seo-marketing-online','<p><strong>1. Mô tả công việc</strong><br />\r\n&bull; Nghiên cứu từ khóa, phối hợp với chuyên viên phát triển nội dung, chuyên viên thiết kế triển khai các hoạt động tối ưu Onpage<br />\r\n&bull; Cập nhật thuật toán Google, các tools phục vụ cho hoạt động SEO<br />\r\n&bull; Phối hợp chuyên viên phát triển nội dung để triển khai website &amp; blog vệ tinh<br />\r\n&bull; Lên kế hoạch và triển khai quảng cáo Google Adwords, Facebook Ads cho các sản phẩm, thương hiệu, chiến dịch của công ty<br />\r\n&bull; Theo dõi và tối ưu các chiến dịch quảng cáo.<br />\r\n&bull; Đẩy các từ khóa lên TOP<br />\r\n&bull; Kết hợp các kênh marketing nhằm tăng traffic cho website<br />\r\n&bull; Thực hiện công việc liên quan đến viral marketing<br />\r\n&bull; Viết bài PR quảng bá dịch vụ, sản phẩm<br />\r\n&bull; Đưa bài lên các diễn đàn, blog, mạng xã hội&hellip; nhằm quảng bá sản phẩm, dịch vụ của công ty.</p>\r\n\r\n<p><strong>2. Yêu cầu công việc</strong><br />\r\n&bull; Có tối thiểu 01 năm kinh nghiệm trong hoạt động SEO &amp; Online Marketing.<br />\r\n&bull; Thành thạo, hiểu biết chuyên sâu về marketing online, mạng xã hội (SEO/ SEM/ Social Media/ Forum Seeding/ Email Marketing&hellip;)<br />\r\n&bull; Có hiểu biết sâu sắc về thuật toán Google và các công cụ cơ bản nhất trong lĩnh vực như: Webmaster Tools, Analytics.<br />\r\n&bull; Có hiểu biết về các công cụ tối ưu hóa khác cho hoạt động SEO là một lợi thế lớn<br />\r\n&bull; Hiểu biết về Social Network<br />\r\n&bull; Có kinh nghiệm quản trị web, xây dựng blog.<br />\r\n&bull; Có khả năng viết, biên tập tin bài chuẩn SEO.<br />\r\n&bull; Có khả năng tổng hợp, nghiên cứu, phân tích thị trường<br />\r\n&bull; Có khả năng lên kế hoạch và triển khai thực hiện SEO cho các nhóm từ khóa website liên quan đến sản phẩm, dịch vụ cung cấp.<br />\r\n&bull; Biết tối ưu hóa các chiến dịch quảng cáo google adwords là một lợi thế<br />\r\n&bull; Có kinh nghiệm tìm kiếm, phân tích từ khóa<br />\r\n&bull; Có kỹ năng giao tiếp tốt, linh hoạt, chủ động, sáng tạo trong công việc, có khả năng làm việc độc lập và theo nhóm.</p>\r\n\r\n<p><strong>3. Chế độ đãi ngộ</strong><br />\r\n&bull; Được tạo điều kiện làm việc để sáng tạo và có cơ hội để phát huy tối đa năng lực bản thân.<br />\r\n&bull; Mức lương, thưởng cạnh tranh; thưởng nóng cá nhân xuất sắc, thưởng lễ tết, thưởng cuối năm&hellip;<br />\r\n&bull; Môi trường làm việc chuyên nghiệp, năng động, thân thiện, cơ hội thăng tiến cao.<br />\r\n&bull; Được hưởng đầy đủ các chế độ đãi ngộ đối với người lao động theo Luật Lao động Việt Nam: BHXH, BHYT&hellip;</p>\r\n\r\n<p><strong>4. Hồ sơ ứng tuyển</strong><br />\r\n&bull; Đơn xin việc<br />\r\n&bull; CV mô tả kinh nghiệm làm việc<br />\r\n&bull; Các bằng cấp, chứng chỉ liên quan</p>\r\n\r\n<p><strong>5. Hạn nộp hồ sơ: 31/01/2016</strong><br />\r\nỨng viên quan tâm, vui lòng gửi CV qua địa chỉ email: tuyendung@abc-group.vn.</p>\r\n','banmerbang.jpg',NULL,NULL,'2016-01-25 13:15:32','2016-01-28 14:22:46'),(4,4,'MARKETING ONLINE','marketing-online','','banmerbang.jpg',NULL,NULL,'2016-01-25 13:15:32','2016-01-28 14:22:46'),(5,5,'Phát triển phần mềm','phat-trien-phan-mem','<p style=\"text-align:justify\">Xã hội ngày càng phát triển, nhu cầu sử dụng các thiết bị, phần mềm thông minh ngày một lớn, bởi vậy để đáp ứng nhu cầu đó <em>Abc Communications</em> mở rộng dịch vụ phát triển phầm mềm để hỗ trợ doanh nghiệp trong mọi hoạt động.</p>\r\n\r\n<p style=\"text-align:justify\">Là đơn vị có bề dày trong lĩnh vực truyền thông &ndash; CNTT<em> Abc Communications</em> tự tin sẽ cung cấp&nbsp;những phần mềm ưu việt nhất đem tới khả năng tiếp cận công nghệ một cách thấu đáo. Chúng tôi thiết kế và tùy biến các nền tảng công nghệ, cũng như xây dựng nên các phần mềm chuyên dụng, các hệ thống nhúng phù hợp với từng đặc trưng cụ thể, từng nghiệp vụ, hơn thế còn giúp khách hàng tiếp cận công nghệ một cách hiệu quả và tối ưu.</p>\r\n\r\n<p style=\"text-align:justify\">Công nghệ phát triển của<em> Abc Communications</em> dựa trên nền tảng Java, đảm bảo phát triển tương thích trên ứng dụng web, desktop, mobile,&hellip; cũng như tích hợp hoàn toàn với các hệ thống cơ sở dữ liệu Oracle, PostgreSQL, SQL Server, &hellip;</p>\r\n\r\n<p style=\"text-align:justify\">Sở hữu đội ngũ nhân lực giàu kinh nghiệm, trình độ chuyên môn cao, hiểu biết sâu về nhiều ngành nghề, hiện nay <em>Abc Communications</em> đã và đang triển khai thực hiện phát triển các phần mềm chuyên biệt cho một số doanh nghiệp lớn tại Việt Nam trên mọi lĩnh vực.</p>\r\n\r\n<p style=\"text-align:justify\">Đến với <em>Abc Communications</em> bạn sẽ có một nền tảng công nghệ vững chắc, với quy trình hiện đại chuyên nghiệp.</p>\r\n\r\n<p style=\"text-align:justify\"><strong><em>&quot;Abc Communications - lựa chọn hoàn hảo cho mọi&nbsp;doanh nghiệp&quot;</em></strong></p>\r\n','software-development-1000x666.jpg',NULL,NULL,'2016-01-25 13:31:07','2016-02-19 20:47:45'),(6,6,'Software Development','software-development','<p>With experienced consultants and developing solutions on demand software for organizations and businesses, we are confident in the ability to grasp the business analysis, design development capacity of our systems and we commit to provide the most suitable solution for organizations and businesses with time and reasonable cost.</p>\r\n','software-development-1000x666.jpg',NULL,NULL,'2016-01-25 13:31:07','2016-02-19 20:13:38'),(7,5,'Phát triển ứng dụng di động','phat-trien-ung-dung-di-dong','<p style=\"text-align:justify\">Công nghệ di động không chỉ dừng ở việc nhắn tin, trao đổi, kết bạn mà còn phục vụ nhu cầu trò chuyện, bỏ phiếu, đăng ký, đánh giá, các hệ thống khẩn cấp, marketing hay các mục đích thống kê.</p>\r\n\r\n<p style=\"text-align:justify\"><em>Abc Communications</em> là đơn vị chuyên cung cấp các phần mềm phát triển ứng dụng di động và porting, tối ưu hóa tính cơ động cho khách hàng giúp họ truy cập các nguồn thông tin sẵn có chỉ trong giây lát, kết nối real-time với các thiết bị tự động chuyên dụng như M2M, hệ thống GPS, cổng tích hợp SMSC, tương thích và tích hợp với các hệ thống thông tin hiện có, kết nối GPRS và các dịch vụ theo khu vực, các tính năng thân thiện, hỗ trợ hình ảnh, video, âm thanh...và nhiều tính năng khác.</p>\r\n\r\n<p style=\"text-align:justify\">Người dùng có thể truy cập vào các hệ thống thông tin thời gian thực bất cứ khi nào, bất cứ nơi đâu và từ bất kì thiết bị nào, không chỉ sử dụng với mục đích giải trí, một số người cũng có thể mang về lợi nhuận cho mình khi cung cấp nội dung chất lượng.</p>\r\n\r\n<p style=\"text-align:justify\">Với đội ngũ nhân lực có kinh nghiệm trong phát triển các ứng dụng cho thiết bị di động trên tất cả các platform chính như Java/J2ME, WAP, Blackberry&hellip; dịch vụ chuyên nghiệp, hiện đại, làm việc sát sao với khách hàng tập trung phân tích nhu cầu di động và đưa ra các giải pháp phù hợp với nhu cầu công việc chúng tôi cam kết&nbsp;đáp ứng&nbsp;đúng mục tiêu kinh doanh của khách hàng, cung cấp các giải pháp xử lý tốt nhất và kinh tế nhất.</p>\r\n\r\n<p style=\"text-align:justify\">Ngày nay muốn giành lợi thế cạnh tranh cần phải cung cấp cho khách hàng các dịch vụ nhanh chóng, chất lượng và tiên tiến. Chính vì lẽ đó, ngày càng có nhiều người lựa chọn các giải pháp di động. Công nghệ di động nhanh, tiện lợi, và phổ biến cho phép mọi người, từ nhân viên, quản lý hay khách hàng...làm việc cùng nhau, truy cập tới các nguồn thông tin bất cứ lúc nào, từ bất cứ nơi đâu.</p>\r\n\r\n<p style=\"margin-left:36pt; text-align:justify\"><strong><em>Hãy đến với chúng tôi, Abc Communications &ndash; nơi gửi gắm những ý tưởng đột phá!</em></strong></p>\r\n','Noi dung so.jpg',NULL,NULL,'2016-01-25 13:31:52','2016-02-19 20:44:01'),(8,6,'','','<p>We create products that bring coherence between users with mobile devices. Each product is a combination of human values, knowledge and entertainment.</p>\r\n','Noi dung so.jpg',NULL,NULL,'2016-01-25 13:31:52','2016-02-19 20:44:01'),(9,5,'Thiết kế website','thiet-ke-website','<p style=\"text-align:justify\">Website là bộ mặt của doanh nghiệp, là nơi trưng bày và giới thiệu thông tin, sản phẩm, dịch vụ tới mọi đối tượng. Có thể nói rằng đây chính là yếu tố tiên quyết góp phần thúc đẩy phát triển sản xuất và kinh doanh, bởi lẽ website là nơi mua bán gặp gỡ,&nbsp;trao đổi thông tin, phản hồi thông tin của doanh nghiệp với khách hàng và ngược lại.</p>\r\n\r\n<p style=\"text-align:justify\"><em>Abc Communicatons</em> đơn vị có nhiều năm kinh nghiệm trong lĩnh vực truyền thông &ndash; CNTT đặc biệt là thiết kế và lập trình website. Với phương thức thiết kế và điều hướng website độc đáo, <em>Abc Communications</em> &nbsp;luôn nỗ lực xây dựng các website có tính năng riêng biệt cho từng khách hàng, đưa ra nhiều phương án, tư vấn giúp khách hàng có lựa chọn hợp lí.&nbsp;Sự chỉnh chu trong thiết kế cùng các công cụ quản lý và tối ưu hóa tìm kiếm hiệu quả giúp website của doanh nghiệp hoạt động tốt nhất.</p>\r\n\r\n<p style=\"text-align:justify\">Quy trình làm việc chuyên nghiệp hiện đại:</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\">Phân tích bối cảnh kinh doanh và yêu cầu khách hàng à Xây dựng hồ sơ thiết kế website</li>\r\n	<li style=\"text-align:justify\">Cung cấp cho khách hàng quyền truy cập hệ thống để theo dõi tiến độ</li>\r\n	<li style=\"text-align:justify\">Upload kết quả theo kế hoạch lên web server</li>\r\n	<li style=\"text-align:justify\">Phát hành Beta nghiệm thu</li>\r\n	<li style=\"text-align:justify\">Đóng gói và triển khai trên server khách hàng.</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">Với đội ngũ thiết kế, lập trình, viết nội dung, đồ họa, video, biên tập ảnh và chuyên gia SEO tài năng kinh nghiệm <em>Abc Communications</em> cam kết xây dựng hình ảnh trực tuyến mạnh nhất, mức phí hợp lý nhất.</p>\r\n','web[1].jpg',NULL,NULL,'2016-01-25 13:32:12','2016-02-19 20:46:28'),(10,6,'','-20','<p>With experience and extensive knowledge of expertise and relationships close cooperation with the media, we are a trusted partner of customers in developing the communications plan and brand development.</p>\r\n','web[1].jpg',NULL,NULL,'2016-01-25 13:32:12','2016-02-19 20:46:28'),(11,1,'Thay đổi giờ làm việc','thay-doi-gio-lam-viec','<div>Xin thông báo đến toàn thể nhân viên công ty về việc thay đổi giờ làm việc buổi sáng đối với những ngày nhiệt độ dưới 10 độ C:<br />\r\n&nbsp;</div>\r\n\r\n<div>Do hiện nay tình hình thời tiết rét đậm, rét hại, nhiệt độ buổi sáng xuống thấp nên lãnh đạo Công ty quyết định cho phép mọi người được đến muộn 30 phút vào buổi sáng (tức 8h30) đối với nhũng ngày nhiệt độ dưới 10 độ C.<br />\r\n<br />\r\nMọi người theo dõi nhiệt độ qua bản tin thời tiết trên VTV1 vào lúc 6h20 buổi sáng hàng ngày để làm căn cứ.</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<p>Trân trọng thông báo.</p>\r\n','cold-dog.jpg',NULL,NULL,'2016-01-25 13:43:34','2016-01-28 21:57:37'),(12,2,'Time','time','<p>News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002News 002</p>\r\n','cold-dog.jpg',NULL,NULL,'2016-01-25 13:43:34','2016-01-28 21:57:37'),(13,1,'Nội quy công ty áp dụng từ ngày 14/11/2015','noi-quy-cong-ty-ap-dung-tu-ngay-14112015','<div>\r\n<div>\r\n<div>Dựa trên bản &quot;Quy định dành cho Cán bộ ABCG&quot; được ban hành và áp dụng từ ngày 01/01/2015, nay Công ty có sửa đổi, điều chỉnh một số nội dung trong quy định này và áp dụng chính thức kể từ ngày 14/11/2015.<br />\r\n&nbsp;</div>\r\n\r\n<div>Các quy định cụ thể được thể hiện tại các tài liệu:&nbsp; &quot;Quy định dành cho cán bộ ABCG&quot; và &quot;Nội dung điều chỉnh, bổ sung nội quy ABCG&quot;<br />\r\n&nbsp;</div>\r\n\r\n<div>Đề nghị mọi người xem và thực hiện đúng quy định này.</div>\r\n</div>\r\n</div>\r\n\r\n<p>Trân trọng thông báo.</p>\r\n\r\n<p>&nbsp;\r\n<div>\r\n<div><img class=\"CToWUd\" src=\"https://ci6.googleusercontent.com/proxy/RnNZfQn2o2xpggJQqefCOervMbPIci5mujDPJnvl43kv6Rtxjyh5gHN_JKVzeU-aaGz3pePFgxfoAAtZJZNx8mveVTc-11j98EfuAJVcumUenA=s0-d-e1-ft#https://ssl.gstatic.com/ui/v1/icons/mail/images/cleardot.gif\" /></div>\r\n</div>\r\n</p>\r\n','regulation.jpg',NULL,NULL,'2016-01-25 13:44:08','2016-01-28 22:02:38'),(14,2,'Regulations','regulations','<p>Regulations</p>\r\n','regulation.jpg',NULL,NULL,'2016-01-25 13:44:08','2016-01-28 22:02:38'),(15,3,'TUYỂN GẤP TRƯỞNG PHÒNG KỸ THUẬT','tuyen-gap-truong-phong-ky-thuat','<p><strong>1. Mô tả công việc:</strong><br />\r\n- Tham gia thiết kế và lập trình các giải pháp liên quan các hệ thống viễn thông; các hệ thống thanh toán, các dịch vụ VAS trên mạng di động 3G&hellip;;<br />\r\n- Tham gia triển khai vận hành hỗ trợ các dịch vụ;<br />\r\n- Các công việc khác theo sự phân công của Ban Lãnh đạo Công ty.<br />\r\n- Quản lý và chịu trách nhiệm các công việc chuyên môn của Phòng Kỹ thuật<br />\r\n- Chịu trách nhiệm quản lý, hướng dẫn, phân công công việc cho các thành viên của Phòng Kỹ thuật.<br />\r\n- Thực hiện kiểm soát và duy trì hoạt động ổn định cho hệ thống hạ tầng kỹ thuật của Công ty.<br />\r\n- Nghiên cứu và đề xuất các phương án tổ chức và hoàn thiện bộ máy Phòng Kỹ thuật<br />\r\n- Tham mưu cho Ban Lãnh đạo về các hoạt động liên quan đến mảng Kỹ thuật nhằm góp phần giúp hệ thống kỹ thuật công ty ổn định, phát triển.<br />\r\n<br />\r\n<strong>2. Yêu cầu kỹ năng:</strong><br />\r\n- Đã từng lập trình C<br />\r\n- Làm python là một lợi thế<br />\r\n- Database: ít nhất biết My SqL hoặc Oracle, Mongo DB, Redis.<br />\r\n- Ngoại ngữ: tiếng Anh (đọc, hiểu) tốt<br />\r\n- Tốt nghiệm Đại học chuyên ngành Công nghệ thông tin<br />\r\n- Có 2 năm kinh nghiệm trở lên về lập trình Server Java và J2EE (Servlets, Web Services, xử lý đa luồng...)<br />\r\n- Kinh nghiệm thực tiễn với webserver framework (Tomcat, JBoss)<br />\r\n- Có kiến thức về lập trình hướng đối tượng, cấu trúc dữ liệu, thuật toán&hellip;<br />\r\n- Có kinh nghiệm về hệ thống quản trị database như: MySQL, SQL Server, Oracle Server<br />\r\n- Đã từng qua Hibernate, Connection Pool, JSON.<br />\r\n- Kiến thức căn bản về lập trình web như: HTML, CSS, Javascript, &hellip;..<br />\r\nƯu tiên các ứng viên:<br />\r\n- Đã từng tích hợp các hợp các hệ thống thanh toán (sms, thẻ cào, internet banking) hoặc làm qua về cách tích hợp một SDK có chức năng thanh toán là một lợi thế.<br />\r\n- Đã từng tham gia phát triển các dự án lớn (+100.000 users).<br />\r\n- Có kinh nghiệm về tích hợp các social network như Facebook, Google.<br />\r\n- Có 3 năm kinh nghiệm trở lên ở vị trí Trưởng phòng/ Trưởng nhóm.</p>\r\n\r\n<p><img alt=\"\" src=\"/ckfinder/userfiles/images/cto1.jpg\" style=\"height:320px; margin-left:150px; margin-right:150px; width:639px\" /><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>3. Chế độ đãi ngộ:</strong><br />\r\n- Được tạo điều kiện làm việc để sáng tạo và có cơ hội để phát huy tối đa năng lực bản thân.<br />\r\n- Môi trường làm việc chuyên nghiệp, năng động, thân thiện, cơ hội thăng tiến cao.<br />\r\n- Được hưởng đầy đủ các chế độ đãi ngộ đối với người lao động theo Luật Lao động Việt Nam: BHXH, BHYT&hellip;<br />\r\n<br />\r\n<strong>4. Hồ sơ ứng tuyển gồm:</strong><br />\r\n- Đơn xin việc<br />\r\n- Sơ yếu lý lịch<br />\r\n- Giấy khám sức khỏe<br />\r\n- Các bằng cấp, chứng chỉ liên quan<br />\r\nỨng viên quan tâm, vui lòng nộp CV qua đia chỉ email: tuyendung@abc-group.vn hoặc liên hệ qua điện thoại: 04 3775 4334 - máy lẻ 12.</p>\r\n','We_Need_You_-_AGM_and_Annual_Members_Event_-_reduced.jpg',NULL,NULL,'2016-01-28 14:09:15','2016-01-28 15:23:59'),(16,4,'CTO','cto','','We_Need_You_-_AGM_and_Annual_Members_Event_-_reduced.jpg',NULL,NULL,'2016-01-28 14:09:15','2016-01-28 15:23:59'),(17,3,'TUYỂN DỤNG BIÊN TẬP VIÊN','tuyen-dung-bien-tap-vien','<p><strong>1. Yêu cầu công việc</strong><br />\r\n&bull; Đam mê và có kiến thức về game, am hiểu về mini game và game online là một lợi thế.<br />\r\n&bull; Có kinh nghiệm về đánh giá game, phân tích số liệu liên quan tới người dùng với những sở thích và thị hiếu quốc tế khác nhau.<br />\r\n&bull; Kỹ năng viết tốt, đặc biệt là xử lý tin/ bài theo văn phong game.<br />\r\n&bull; Sử dụng thành thạo với các dịch vụ trực tuyến (Mạng xã hội, Forum, Social Game, Game online)<br />\r\n&bull; Sử dụng thành thạo các phần mềm văn phòng như Word, Excel, Power Point và Internet.<br />\r\n&bull; Ưu tiên tốt nghiệp hoặc đang theo học các ngành xã hội như: Báo chí, Ngữ văn,&hellip;<br />\r\n&bull; Có trách nhiệm và khả năng làm việc nhóm.<br />\r\n&bull; Mức lương thỏa thuận tùy năng lực.</p>\r\n\r\n<p><strong>2. Chế độ đãi ngộ</strong><br />\r\n&bull; Được tạo điều kiện làm việc để sáng tạo và có cơ hội để phát huy tối đa năng lực bản thân.<br />\r\n&bull; Mức lương, thưởng cạnh tranh; thưởng nóng cá nhân xuất sắc, thưởng lễ tết, thưởng cuối năm&hellip;<br />\r\n&bull; Môi trường làm việc chuyên nghiệp, năng động, thân thiện, cơ hội thăng tiến cao.<br />\r\n&bull; Được hưởng đầy đủ các chế độ đãi ngộ đối với người lao động theo Luật Lao động Việt Nam: BHXH, BHYT&hellip;</p>\r\n\r\n<p><strong>3. Hồ sơ ứng tuyển gồm</strong><br />\r\n&bull; Đơn xin việc<br />\r\n&bull; CV mô tả kinh nghiệm làm việc<br />\r\n&bull; Các bằng cấp, chứng chỉ liên quan</p>\r\n\r\n<p><strong>4. Hạn nộp hồ sơ: 31/01/2016</strong><br />\r\nỨng viên quan tâm, vui lòng gửi CV qua địa chỉ email: tuyendung@abc-group.vn.</p>\r\n','Bien tap vien.jpg',NULL,NULL,'2016-01-28 15:17:00','2016-01-28 15:17:48'),(18,4,'EDITOR','editor','','Bien tap vien.jpg',NULL,NULL,'2016-01-28 15:17:00','2016-01-28 15:17:48'),(19,5,'Gia công phần mềm','gia-cong-phan-mem','<p>Mọi doanh nghiệp đều cần đến các dịch vụ phần mềm nhưng bản thân lại không có đủ nguồn lực để thực hiện bởi vậy &ldquo;gia công phần mềm&rdquo; là phương án tối ưu nhất.</p>\r\n\r\n<p>Gia công phần mềm (OutSourcing) đã đang và sẽ trở thành xu thế phổ biến. Sự phát triển của CNTT kéo theo sự thay đổi trong công nghệ phần mềm điều đó đồng nghĩa với việc doanh nghiệp cũng cần có kế hoạch để hoạt động an toàn và hiệu quả hơn. Hầu hết các doanh nghiệp đều cần các dịch vụ phần mềm bất kể quy mô như thế nào. Thực tế họ không có đủ nguồn lực để thực hiện bởi vậy &quot;gia công phần mềm&quot; là phương án hợp lí nhất.</p>\r\n\r\n<p>Nhờ đến đơn vị thứ 2 hỗ trợ gia công phần mềm sẽ đem lại rất nhiều lợi ích:</p>\r\n\r\n<ul>\r\n	<li>Tiết kiệm chi phí.</li>\r\n	<li>Tiết kiệm nguồn lực.</li>\r\n	<li>Tiết kiệm thời gian.</li>\r\n	<li>Tiết kiệm công sức quản lý.</li>\r\n</ul>\r\n\r\n<p><em>Abc Communicatons</em> là đơn vị chuyên cung cấp các dịch vụ công nghệ đa dạng tập trung vào gia công và phát triển phần mềm, bằng kinh nghiệm, đội ngũ nhân lực chất lượng cao, quy trình làm việc hiện đại &ndash; chuyên nghiệp, sự tận tâm và tinh thần trách nhiệm, chúng tôi hy vọng sẽ làm hài lòng tất cả quý khách hàng. Với <em>Abc Communications</em> thành công của bạn chính là niềm vui và món quà ý nghĩa với chúng tôi.</p>\r\n\r\n<p><em>Abc Communicatons &ndash; bạn đồng hành tin cậy của mọi doanh nghiệp.</em></p>\r\n','gia-cong-phan-mem.png',NULL,NULL,'2016-02-19 20:32:54','2016-02-19 20:45:57'),(20,6,'','-18','','gia-cong-phan-mem.png',NULL,NULL,'2016-02-19 20:32:54','2016-02-19 20:45:57');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','Role is Admin',NULL,'2016-01-25 13:15:31','2016-01-25 13:15:31'),(2,'Editor','Role is Editor',NULL,'2016-01-25 13:15:31','2016-01-25 13:15:31'),(3,'Seo','Role is Seo',NULL,'2016-01-25 13:15:31','2016-01-25 13:15:31');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

LOCK TABLES `slide` WRITE;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
INSERT INTO `slide` VALUES (1,'s1.jpg',1,'',NULL,'','2016-01-26 13:47:31','2016-01-25 13:26:50','2016-01-26 13:47:31'),(2,'s1.jpg',1,'',NULL,'','2016-01-25 19:21:01','2016-01-25 13:27:33','2016-01-25 19:21:01'),(3,'p1.jpg',2,'Viettel',NULL,'',NULL,'2016-01-25 13:27:41','2016-01-28 16:31:00'),(4,'p2.jpg',2,'',NULL,'','2016-01-28 16:29:46','2016-01-25 13:27:49','2016-01-28 16:29:46'),(5,'p1.jpg',2,'',NULL,'','2016-01-28 16:29:42','2016-01-25 13:27:56','2016-01-28 16:29:42'),(6,'p2.jpg',2,'',NULL,'','2016-01-28 16:29:38','2016-01-25 13:28:02','2016-01-28 16:29:38'),(7,'Viettel.jpg',2,'Viettel',NULL,'','2016-01-28 16:29:30','2016-01-25 13:28:07','2016-01-28 16:29:30'),(8,'Vietnamobile_Logo.svg.png',2,'Vietnamobile',NULL,'',NULL,'2016-01-25 13:28:13','2016-01-28 16:19:55'),(9,'Mobifone.jpg',2,'Mobifone',NULL,'',NULL,'2016-01-25 13:28:20','2016-01-28 16:18:43'),(10,'Vinaphone.jpg',2,'Vinaphone',NULL,'',NULL,'2016-01-25 13:28:27','2016-01-28 16:22:17'),(11,'cubes_dice_multicolored_106942_1024x768.jpg',1,'Test',NULL,'','2016-01-25 19:07:39','2016-01-25 19:07:18','2016-01-25 19:07:39'),(12,'playstation_sony_joystick_consoles_101956_1366x768.jpg',1,'Test 1',NULL,'http://choinhanh.vn/',NULL,'2016-01-25 19:18:21','2016-01-28 19:35:43'),(13,'gadget_tablet_smartphone_icons_touch_screen_99974_1366x768.jpg',1,'Test 2',NULL,'http://choinhanh.vn/',NULL,'2016-01-25 19:20:33','2016-01-28 19:38:17'),(14,'android_red_robot_shape_hi-tech_15010_2560x1024.jpg',1,'Test 3',NULL,'http://choinhanh.vn/',NULL,'2016-01-26 13:46:34','2016-01-28 19:38:23'),(15,'macbook_apple_laptop_camera_cup_99153_2560x1024.jpg',1,'Test 4',NULL,'http://choinhanh.vn/',NULL,'2016-01-26 13:50:21','2016-01-28 19:38:30'),(16,'apple_iphone_6s_drops_surface_106139_2560x1024.jpg',1,'Test 5',NULL,'http://choinhanh.vn/',NULL,'2016-01-26 13:54:13','2016-01-28 19:38:35'),(17,'mwork-logo-720x316.jpg',2,'Mwork',NULL,'',NULL,'2016-01-28 16:32:31','2016-01-28 16:32:52'),(18,'Puretech.png',2,'Puretech',NULL,'',NULL,'2016-01-28 16:36:23','2016-01-28 16:36:23'),(19,'Mimopay.png',2,'Mimopay',NULL,'',NULL,'2016-01-28 16:42:41','2016-01-28 16:42:55'),(20,'Boyaa.png',2,'Boyaa',NULL,'',NULL,'2016-01-28 16:45:38','2016-01-28 16:45:38');
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_about_us`
--

DROP TABLE IF EXISTS `type_about_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_about_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_shadow` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_about_us`
--

LOCK TABLES `type_about_us` WRITE;
/*!40000 ALTER TABLE `type_about_us` DISABLE KEYS */;
INSERT INTO `type_about_us` VALUES (1,1,1,'về chúng tôi','',NULL,NULL,'2016-01-25 13:15:32','2016-02-18 22:03:27'),(2,1,1,'About Us','',NULL,NULL,'2016-01-25 13:15:32','2016-02-19 20:06:03'),(3,2,2,'Lịch sử','',NULL,NULL,'2016-01-25 13:15:32','2016-02-19 20:06:22'),(4,2,2,'Our history','',NULL,NULL,'2016-01-25 13:15:32','2016-02-19 20:06:22'),(5,1,3,'Định hướng','',NULL,NULL,'2016-01-25 13:15:32','2016-02-19 20:06:35'),(6,1,3,'ORIENTATIONS','',NULL,NULL,'2016-01-25 13:15:32','2016-02-19 20:06:35');
/*!40000 ALTER TABLE `type_about_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_news`
--

DROP TABLE IF EXISTS `type_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_news`
--

LOCK TABLES `type_news` WRITE;
/*!40000 ALTER TABLE `type_news` DISABLE KEYS */;
INSERT INTO `type_news` VALUES (1,1,NULL,'Tin tức','tin-tuc',NULL,'2016-01-25 13:15:32','2016-01-25 13:29:48'),(2,1,NULL,'News','news',NULL,'2016-01-25 13:15:32','2016-01-25 13:29:48'),(3,NULL,NULL,'Tuyển dụng','tuyen-dung',NULL,'2016-01-25 13:15:32','2016-01-25 13:15:32'),(4,NULL,NULL,'Carrier','carrier',NULL,'2016-01-25 13:15:32','2016-01-25 13:15:32'),(5,3,NULL,'Dịch vụ','dich-vu',NULL,'2016-01-25 13:29:10','2016-02-03 19:16:31'),(6,3,NULL,'Services','services',NULL,'2016-01-25 13:29:10','2016-01-25 13:29:10');
/*!40000 ALTER TABLE `type_news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-19 20:24:25
