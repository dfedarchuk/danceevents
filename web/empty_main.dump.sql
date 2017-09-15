-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 192.168.1.248    Database: basecode_release_empty_main
-- ------------------------------------------------------
-- Server version	5.6.36

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
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated` datetime NOT NULL,
  `entered` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `facebook_username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `foreignaccount` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faillogin_count` int(11) NOT NULL DEFAULT '0',
  `faillogin_datetime` datetime DEFAULT NULL,
  `importID` int(11) NOT NULL DEFAULT '0',
  `domain_importID` int(11) DEFAULT NULL,
  `importID_event` int(11) NOT NULL DEFAULT '0',
  `domain_importID_event` int(11) DEFAULT NULL,
  `is_sponsor` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `has_profile` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'y',
  `publish_contact` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `notify_traffic_listing` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'n',
  `complementary_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `newsletter` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `stripe_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B28B6F38F85E0677` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Account_Activation`
--

DROP TABLE IF EXISTS `Account_Activation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account_Activation` (
  `account_id` int(11) NOT NULL,
  `unique_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entered` date NOT NULL,
  PRIMARY KEY (`account_id`,`unique_key`),
  KEY `account_id` (`account_id`),
  KEY `unique_key` (`unique_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account_Activation`
--

LOCK TABLES `Account_Activation` WRITE;
/*!40000 ALTER TABLE `Account_Activation` DISABLE KEYS */;
/*!40000 ALTER TABLE `Account_Activation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Account_Domain`
--

DROP TABLE IF EXISTS `Account_Domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account_Domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_domain` (`account_id`,`domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account_Domain`
--

LOCK TABLES `Account_Domain` WRITE;
/*!40000 ALTER TABLE `Account_Domain` DISABLE KEYS */;
/*!40000 ALTER TABLE `Account_Domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contact` (
  `account_id` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `entered` datetime NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `importID` int(11) DEFAULT '0',
  `importID_event` int(11) DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Control_Cron`
--

DROP TABLE IF EXISTS `Control_Cron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Control_Cron` (
  `domain_id` int(11) NOT NULL,
  `running` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `last_run_date` datetime NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`domain_id`,`type`),
  KEY `domain_id` (`domain_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Control_Cron`
--

LOCK TABLES `Control_Cron` WRITE;
/*!40000 ALTER TABLE `Control_Cron` DISABLE KEYS */;
INSERT INTO `Control_Cron` VALUES (1,'N','2013-03-07 16:53:18','count_article_category'),(1,'N','2013-03-07 16:53:24','count_classified_category'),(1,'N','2013-03-07 16:53:28','count_event_category'),(1,'N','2013-03-07 16:51:53','count_listing_category'),(1,'N','2013-03-07 16:53:13','count_post_tag'),(1,'N','0000-00-00 00:00:00','daily_maintenance'),(1,'N','2013-07-30 14:38:38','randomizer'),(1,'N','0000-00-00 00:00:00','renewal_reminder'),(1,'N','2012-11-26 16:03:26','report_rollup'),(1,'N','2013-01-24 08:38:48','sitemap'),(1,'N','2012-11-26 16:01:21','statisticreport'),(1,'N','2013-06-12 09:33:23','location_update'),(1,'N','0000-00-00 00:00:00','prepare_import_events'),(1,'N','0000-00-00 00:00:00','email_traffic'),(1,'N','0000-00-00 00:00:00','rollback_import'),(1,'N','0000-00-00 00:00:00','prepare_import'),(1,'N','0000-00-00 00:00:00','rollback_import_events'),(1,'N','2013-08-30 11:15:22','count_locations');
/*!40000 ALTER TABLE `Control_Cron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Control_Export_Event`
--

DROP TABLE IF EXISTS `Control_Export_Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Control_Export_Event` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `last_run_date` datetime NOT NULL,
  `total_event_exported` int(11) NOT NULL,
  `last_event_id` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `finished` varchar(1) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `running_cron` varchar(1) NOT NULL,
  `scheduled` varchar(1) NOT NULL,
  PRIMARY KEY (`id`,`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Control_Export_Event`
--

LOCK TABLES `Control_Export_Event` WRITE;
/*!40000 ALTER TABLE `Control_Export_Event` DISABLE KEYS */;
INSERT INTO `Control_Export_Event` VALUES (1,1,'0000-00-00 00:00:00',0,0,50000,'Y','','csv','N','N'),(2,1,'0000-00-00 00:00:00',0,0,10000,'Y','','csv - data','N','N');
/*!40000 ALTER TABLE `Control_Export_Event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Control_Export_Listing`
--

DROP TABLE IF EXISTS `Control_Export_Listing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Control_Export_Listing` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `last_run_date` datetime NOT NULL,
  `total_listing_exported` int(11) NOT NULL,
  `last_listing_id` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `finished` varchar(1) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `running_cron` varchar(1) NOT NULL,
  `scheduled` varchar(1) NOT NULL,
  PRIMARY KEY (`id`,`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Control_Export_Listing`
--

LOCK TABLES `Control_Export_Listing` WRITE;
/*!40000 ALTER TABLE `Control_Export_Listing` DISABLE KEYS */;
INSERT INTO `Control_Export_Listing` VALUES (1,1,'0000-00-00 00:00:00',0,0,50000,'Y','','csv','N','N'),(2,1,'0000-00-00 00:00:00',0,0,10000,'Y','','csv - data','N','N');
/*!40000 ALTER TABLE `Control_Export_Listing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Control_Export_MailApp`
--

DROP TABLE IF EXISTS `Control_Export_MailApp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Control_Export_MailApp` (
  `domain_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduled` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `running` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `last_run_date` datetime NOT NULL,
  `last_exportlog` int(11) NOT NULL,
  PRIMARY KEY (`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Control_Export_MailApp`
--

LOCK TABLES `Control_Export_MailApp` WRITE;
/*!40000 ALTER TABLE `Control_Export_MailApp` DISABLE KEYS */;
INSERT INTO `Control_Export_MailApp` VALUES (1,'N','N','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `Control_Export_MailApp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Control_Import_Event`
--

DROP TABLE IF EXISTS `Control_Import_Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Control_Import_Event` (
  `domain_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduled` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `running` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `last_run_date` datetime NOT NULL,
  `last_importlog` int(11) NOT NULL,
  PRIMARY KEY (`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Control_Import_Event`
--

LOCK TABLES `Control_Import_Event` WRITE;
/*!40000 ALTER TABLE `Control_Import_Event` DISABLE KEYS */;
INSERT INTO `Control_Import_Event` VALUES (1,'N','N','','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `Control_Import_Event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Control_Import_Listing`
--

DROP TABLE IF EXISTS `Control_Import_Listing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Control_Import_Listing` (
  `domain_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduled` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `running` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `last_run_date` datetime NOT NULL,
  `last_importlog` int(11) NOT NULL,
  PRIMARY KEY (`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Control_Import_Listing`
--

LOCK TABLES `Control_Import_Listing` WRITE;
/*!40000 ALTER TABLE `Control_Import_Listing` DISABLE KEYS */;
INSERT INTO `Control_Import_Listing` VALUES (1,'N','N','','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `Control_Import_Listing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cron_Log`
--

DROP TABLE IF EXISTS `Cron_Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cron_Log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL,
  `cron` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `history` text COLLATE utf8_unicode_ci NOT NULL,
  `finished` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cron_Log`
--

LOCK TABLES `Cron_Log` WRITE;
/*!40000 ALTER TABLE `Cron_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cron_Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Domain`
--

DROP TABLE IF EXISTS `Domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smaccount_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `database_host` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `database_port` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `database_username` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `database_password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `database_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `activation_status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `deleted_date` date NOT NULL,
  `article_feature` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `banner_feature` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `classified_feature` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `event_feature` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_info` (`url`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Domain`
--

LOCK TABLES `Domain` WRITE;
/*!40000 ALTER TABLE `Domain` DISABLE KEYS */;
/*!40000 ALTER TABLE `Domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Forgot_Password`
--

DROP TABLE IF EXISTS `Forgot_Password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Forgot_Password` (
  `account_id` int(11) NOT NULL,
  `unique_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entered` date NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`account_id`,`unique_key`),
  KEY `account_id` (`account_id`),
  KEY `unique_key` (`unique_key`),
  KEY `entered` (`entered`),
  KEY `section` (`section`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Forgot_Password`
--

LOCK TABLES `Forgot_Password` WRITE;
/*!40000 ALTER TABLE `Forgot_Password` DISABLE KEYS */;
/*!40000 ALTER TABLE `Forgot_Password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Image`
--

LOCK TABLES `Image` WRITE;
/*!40000 ALTER TABLE `Image` DISABLE KEYS */;
/*!40000 ALTER TABLE `Image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location_1`
--

DROP TABLE IF EXISTS `Location_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location_1`
--

LOCK TABLES `Location_1` WRITE;
/*!40000 ALTER TABLE `Location_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location_2`
--

DROP TABLE IF EXISTS `Location_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_1` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `country_id` (`location_1`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location_2`
--

LOCK TABLES `Location_2` WRITE;
/*!40000 ALTER TABLE `Location_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location_3`
--

DROP TABLE IF EXISTS `Location_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_2` int(11) NOT NULL,
  `location_1` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `state_id` (`location_2`),
  KEY `name` (`name`),
  KEY `location_2_level` (`location_1`,`location_2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location_3`
--

LOCK TABLES `Location_3` WRITE;
/*!40000 ALTER TABLE `Location_3` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location_4`
--

DROP TABLE IF EXISTS `Location_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_3` int(11) NOT NULL,
  `location_2` int(11) NOT NULL,
  `location_1` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `region_id` (`location_3`),
  KEY `friendly_url` (`friendly_url`),
  KEY `name` (`name`),
  KEY `location_3_level` (`location_1`,`location_2`,`location_3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location_4`
--

LOCK TABLES `Location_4` WRITE;
/*!40000 ALTER TABLE `Location_4` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location_5`
--

DROP TABLE IF EXISTS `Location_5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_4` int(11) NOT NULL,
  `location_3` int(11) NOT NULL,
  `location_2` int(11) NOT NULL,
  `location_1` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`location_4`),
  KEY `friendly_url` (`friendly_url`),
  KEY `name` (`name`),
  KEY `location_4_level` (`location_1`,`location_2`,`location_3`,`location_4`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location_5`
--

LOCK TABLES `Location_5` WRITE;
/*!40000 ALTER TABLE `Location_5` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Package`
--

DROP TABLE IF EXISTS `Package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `parent_domain` int(11) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `image_id` int(11) NOT NULL,
  `thumb_id` int(11) NOT NULL,
  `show_info` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `entered` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_domain` (`parent_domain`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Package`
--

LOCK TABLES `Package` WRITE;
/*!40000 ALTER TABLE `Package` DISABLE KEYS */;
/*!40000 ALTER TABLE `Package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PackageItems`
--

DROP TABLE IF EXISTS `PackageItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PackageItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PackageItems`
--

LOCK TABLES `PackageItems` WRITE;
/*!40000 ALTER TABLE `PackageItems` DISABLE KEYS */;
/*!40000 ALTER TABLE `PackageItems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PackageItemsLOG`
--

DROP TABLE IF EXISTS `PackageItemsLOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PackageItemsLOG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `old_items` text NOT NULL,
  `new_items` text NOT NULL,
  `updated` datetime NOT NULL,
  `smaccount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PackageItemsLOG`
--

LOCK TABLES `PackageItemsLOG` WRITE;
/*!40000 ALTER TABLE `PackageItemsLOG` DISABLE KEYS */;
/*!40000 ALTER TABLE `PackageItemsLOG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PackageModules`
--

DROP TABLE IF EXISTS `PackageModules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PackageModules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `parent_domain_id` int(11) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  `module_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_id` (`domain_id`),
  KEY `fk_PackageModules_Package1` (`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PackageModules`
--

LOCK TABLES `PackageModules` WRITE;
/*!40000 ALTER TABLE `PackageModules` DISABLE KEYS */;
/*!40000 ALTER TABLE `PackageModules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Profile`
--

DROP TABLE IF EXISTS `Profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Profile` (
  `account_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `facebook_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `personal_message` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Profile`
--

LOCK TABLES `Profile` WRITE;
/*!40000 ALTER TABLE `Profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `Profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Registration`
--

DROP TABLE IF EXISTS `Registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Registration` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`,`domain`,`date_time`),
  KEY `domain` (`domain`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Registration`
--

LOCK TABLES `Registration` WRITE;
/*!40000 ALTER TABLE `Registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `Registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RobotsFilter`
--

DROP TABLE IF EXISTS `RobotsFilter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RobotsFilter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=274 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RobotsFilter`
--

LOCK TABLES `RobotsFilter` WRITE;
/*!40000 ALTER TABLE `RobotsFilter` DISABLE KEYS */;
INSERT INTO `RobotsFilter` VALUES (1,'72.14.199.*'),(2,'74.125.75.*'),(3,'74.125.75.*'),(4,'92.235.213.*'),(5,'84 .58.171.*'),(6,'174.129.91.*'),(7,'202.93.76.*'),(8,'71.162.124.*'),(9,'66.24 9.73.*'),(10,'125.177.35.*'),(11,'207.44.196.*'),(12,'222.238.81.*'),(13,'66.249. 64.*'),(14,'66.249.71.*'),(15,'81.32.188.*'),(16,'65.57.245.*'),(17,'91.208.212.*'),(18,'208.78.176.*'),(19,'64.233.178.*'),(20,'141.51.167.*'),(21,'84.58.174.*'),(22,'84.58.96.*'),(23,'218.132.56.*'),(24,'213.91.216.*'),(25,'66.249.65.*'),(26,'6 6.249.70.*'),(27,'66.249.72.*'),(28,'64.178.97.*'),(29,'24.7.232.*'),(30,'82.47.1. *'),(31,'68.193.180.*'),(32,'60.10.2.*'),(33,'41.200.113.*'),(34,'198.184.0.*'),(35,'207.46.126.*'),(36,'207.46.127.*'),(37,'64.4.54.*'),(38,'65.54.233.*'),(39,'65.5 5.189.*'),(40,'205.209.134.*'),(41,'66.249.66.*'),(42,'66.249.67.*'),(43,'66.249. 68.*'),(44,'85.114.130.*'),(45,'66.230.157.*'),(46,'125.22.91.*'),(47,'202.160.17 8.*'),(48,'202.160.181.*'),(49,'202.160.185.*'),(50,'202.160.188.*'),(51,'202.160 .189.*'),(52,'203.209.252.*'),(53,'202.160.179.*'),(54,'66.228.165.*'),(55,'202.16 0.180.*'),(56,'202.160.183.*'),(57,'203.83.248.*'),(58,'217.11.235.*'),(59,'66.19 6.101.*'),(60,'66.196.65.*'),(61,'66.196.77.*'),(62,'66.196.90.*'),(63,'66.196.91 .*'),(64,'66.196.92.*'),(65,'66.228.167.*'),(66,'67.195.111.*'),(67,'67.195.112.*'),(68,'67.195.113.*'),(69,'67.195.115.*'),(70,'67.195.37.*'),(71,'67.195.44.*'),(72,'68.142.246.*'),(73,'68.142.249.*'),(74,'68.142.250.*'),(75,'68.142.251.*'),(76,'68.180.251.*'),(77,'72.30.101.*'),(78,'72.30.102.*'),(79,'72.30.103.*'),(80,'72.3 0.104.*'),(81,'72.30.107.*'),(82,'72.30.110.*'),(83,'72.30.111.*'),(84,'72.30.128 .*'),(85,'72.30.129.*'),(86,'72.30.131.*'),(87,'72.30.132.*'),(88,'72.30.133.*'),(89,'72.30.134.*'),(90,'72.30.135.*'),(91,'72.30.142.*'),(92,'72.30.161.*'),(93,'72. 30.177.*'),(94,'72.30.179.*'),(95,'72.30.214.*'),(96,'72.30.215.*'),(97,'72.30.21 6.*'),(98,'72.30.221.*'),(99,'72.30.226.*'),(100,'72.30.252.*'),(101,'72.30.54.*'),(102,'72.30.56.*'),(103,'72.30.61.*'),(104,'72.30.65.*'),(105,'72.30.78.*'),(106,'72.30.7 9.*'),(107,'72.30.81.*'),(108,'72.30.87.*'),(109,'72.30.97.*'),(110,'72.30.97.*'),(111,'7 2.30.98.*'),(112,'72.30.99.*'),(113,'74.6.11.*'),(114,'74.6.12.*'),(115,'74.6.130.*'),(116,'74.6.131.*'),(117,'74.6.16.*'),(118,'74.6.17.*'),(119,'74.6.18.*'),(120,'74.6.19.*'),(121,'74.6.20.*'),(122,'74.6.21.*'),(123,'74.6.22.*'),(124,'74.6.23.*'),(125,'74.6.24.*'),(126,'74.6.25.*'),(127,'74.6.26.*'),(128,'74.6.27.*'),(129,'74.6.28.*'),(130,'74.6.29. *'),(131,'74.6.30.*'),(132,'74.6.31.*'),(133,'74.6.65.*'),(134,'74.6.66.*'),(135,'74.6.67 .*'),(136,'74.6.68.*'),(137,'74.6.69.*'),(138,'74.6.7.*'),(139,'74.6.70.*'),(140,'74.6.71 .*'),(141,'74.6.72.*'),(142,'74.6.73.*'),(143,'74.6.74.*'),(144,'74.6.75.*'),(145,'74.6.7 6.*'),(146,'74.6.79.*'),(147,'74.6.8.*'),(148,'74.6.85.*'),(149,'74.6.86.*'),(150,'74.6.8 7.*'),(151,'74.6.9.*'),(152,'130.203.146.*'),(153,'80.131.221.*'),(154,'84.188.206.*'),(155,'68.142.215.*'),(156,'68.180.201.*'),(157,'69.147.127.*'),(158,'209.131.61.*'),(159,'202.165.97.*'),(160,'203.209.241.*'),(161,'209.191.122.*'),(162,'209.73.172.*'),(163,'209.73.174.*'),(164,'66.196.85.*'),(165,'68.180.203.*'),(166,'72.30.12.*'),(167,'65.55.4.*'),(168,'65.55.51.*'),(169,'89.146.29.*'),(170,'65.55.108.*'),(171,'65.55.21 7.*'),(172,'65.55.220.*'),(173,'65.55.230.*'),(174,'65.55.231.*'),(175,'65.54.112.*'),(176,'65.55.214.*'),(177,'65.55.216.*'),(178,'65.54.164.*'),(179,'65.55.212.*'),(180,'65 .55.213.*'),(181,'131.107.0.*'),(182,'202.96.51.*'),(183,'207.46.89.*'),(184,'207.46. 98.*'),(185,'207.68.146.*'),(186,'207.68.154.*'),(187,'207.68.157.*'),(188,'207.68.18 8.*'),(189,'219.141.219.*'),(190,'219.142.53.*'),(191,'64.4.8.*'),(192,'65.54.165.*'),(193,'65.54.188.*'),(194,'65.55.104.*'),(195,'65.55.107.*'),(196,'65.55.208.*'),(197,'65 .55.209.*'),(198,'65.55.210.*'),(199,'65.55.215.*'),(200,'65.55.232.*'),(201,'65.55.23 3.*'),(202,'65.55.234.*'),(203,'65.55.235.*'),(204,'65.55.246.*'),(205,'65.55.250.*'),(206,'65.55.252.*'),(207,'65.55.105.*'),(208,'65.55.120.*'),(209,'65.55.211.*'),(210,'65 .55.25.*'),(211,'65.55.37.*'),(212,'65.55.106.*'),(213,'65.55.115.*'),(214,'65.54.116 .*'),(215,'65.54.158.*'),(216,'207.46.119.*'),(217,'209.191.82.*'),(218,'209.191.123. *'),(219,'68.180.216.*'),(220,'69.147.79.*'),(221,'70.187.130.*'),(222,'129.215.4.*'),(223,'69.64.47.*'),(224,'88.248.8.*'),(225,'38.100.213.*'),(226,'66.214.230.*'),(227,'21 8.160.32.*'),(228,'218.160.34.*'),(229,'70.143.77.*'),(230,'209.249.86.*'),(231,'66.18 0.173.*'),(232,'124.83.179.*'),(233,'203.141.52.*'),(234,'211.14.11.*'),(235,'211.14. 8.*'),(236,'209.191.71.*'),(237,'209.191.83.*'),(238,'68.142.195.*'),(239,'206.190.43 .*'),(240,'68.142.210.*'),(241,'209.191.113.*'),(242,'216.39.60.*'),(243,'66.163.174. *'),(244,'66.163.175.*'),(245,'69.147.82.*'),(246,'98.136.119.*'),(247,'209.191.65.*'),(248,'66.94.238.*'),(249,'68.142.212.*'),(250,'209.131.41.*'),(251,'216.39.58.*'),(252,'66.94.237.*'),(253,'216.109.121.*'),(254,'66.218.65.*'),(255,'209.191.126.*'),(256,'2 16.145.53.*'),(257,'217.12.1.*'),(258,'217.146.191.*'),(259,'66.163.187.*'),(260,'66. 196.99.*'),(261,'66.94.229.*'),(262,'68.180.208.*'),(263,'216.39.51.*'),(264,'68.142. 230.*'),(265,'64.157.138.*'),(266,'202.46.19.*'),(267,'159.226.20.*'),(268,'221.3.100 .*'),(269,'67.202.33.*'),(270,'75.101.197.*'),(271,'75.101.199.*'),(272,'75.101.205.*'),(273,'75.101.251.*');
/*!40000 ALTER TABLE `RobotsFilter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SMAccount`
--

DROP TABLE IF EXISTS `SMAccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SMAccount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated` datetime NOT NULL,
  `entered` datetime NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iprestriction` text COLLATE utf8_unicode_ci NOT NULL,
  `faillogin_count` int(11) NOT NULL,
  `faillogin_datetime` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complementary_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SMAccount`
--

LOCK TABLES `SMAccount` WRITE;
/*!40000 ALTER TABLE `SMAccount` DISABLE KEYS */;
/*!40000 ALTER TABLE `SMAccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SQL_Log`
--

DROP TABLE IF EXISTS `SQL_Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SQL_Log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sql` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `execution_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SQL_Log`
--

LOCK TABLES `SQL_Log` WRITE;
/*!40000 ALTER TABLE `SQL_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `SQL_Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Setting`
--

DROP TABLE IF EXISTS `Setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Setting` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Setting`
--

LOCK TABLES `Setting` WRITE;
/*!40000 ALTER TABLE `Setting` DISABLE KEYS */;
INSERT INTO `Setting` VALUES ('sitemgr_username','sitemgr@demodirectory.com'),('sitemgr_password','e99a18c428cb38d5f260853678922e03'),('sitemgr_faillogin_count','0'),('sitemgr_faillogin_datetime','0000-00-00 00:00:00'),('sitemgr_first_login','yes'),('sitemgr_language','en_us'),('complementary_info','e3d35c82b32a48c1496241bc482f90a5');
/*!40000 ALTER TABLE `Setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20160418173923'),('20160513095648'),('20160523092234'),('20160718142934'),('20160722160734'),('20170118153934'),('20170327191426'),('20170330165707'),('20170503163302');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-14 15:48:13
