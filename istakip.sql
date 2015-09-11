# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: mtahir.net (MySQL 5.5.42-cll)
# Database: mtahir_istakip
# Generation Time: 2015-09-11 12:49:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `fixed_top_menu` int(1) unsigned NOT NULL DEFAULT '0',
  `fixed_left_menu` int(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `theme` varchar(50) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `group_id`, `fixed_top_menu`, `fixed_left_menu`, `username`, `password`, `email`, `name`, `avatar`, `theme`)
VALUES
	(12,1,1,1,'admin','7c20ba8ef9eb3dff71201c1fb1f5c29c','info@mtahir.net','Tahir Hasan','uploads/pictures/image_avatars_253138-1920x1200_02.10.2014_05_45_40.jpg','default');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admins_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins_groups`;

CREATE TABLE `admins_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `admins_groups` WRITE;
/*!40000 ALTER TABLE `admins_groups` DISABLE KEYS */;

INSERT INTO `admins_groups` (`id`, `title`)
VALUES
	(1,'Root');

/*!40000 ALTER TABLE `admins_groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admins_groups_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins_groups_permissions`;

CREATE TABLE `admins_groups_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `page` varchar(50) DEFAULT NULL,
  `permission` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `var` (`permission`),
  KEY `page` (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `admins_groups_permissions` WRITE;
/*!40000 ALTER TABLE `admins_groups_permissions` DISABLE KEYS */;

INSERT INTO `admins_groups_permissions` (`id`, `group_id`, `page`, `permission`)
VALUES
	(1,1,'admins_groups.list',1),
	(2,1,'admins_groups.add',1),
	(3,1,'admins_groups.edit',1),
	(4,1,'admins_groups.delete',1),
	(5,1,'admins.list',1),
	(6,1,'admins.add',1),
	(7,1,'admins.edit',1),
	(8,1,'admins.delete',1),
	(9,1,'database_backups.list',1),
	(10,1,'database_backups.add',1),
	(11,1,'database_backups.delete',1);

/*!40000 ALTER TABLE `admins_groups_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admins_online
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins_online`;

CREATE TABLE `admins_online` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` datetime NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `admins_online` WRITE;
/*!40000 ALTER TABLE `admins_online` DISABLE KEYS */;

INSERT INTO `admins_online` (`id`, `admin_id`, `update_time`, `ip`)
VALUES
	(19,1,'2015-09-10 13:00:11','78.189.215.97');

/*!40000 ALTER TABLE `admins_online` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table istatistikler
# ------------------------------------------------------------

DROP TABLE IF EXISTS `istatistikler`;

CREATE TABLE `istatistikler` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `yil` int(4) unsigned NOT NULL DEFAULT '0',
  `ay` int(2) unsigned NOT NULL DEFAULT '0',
  `baslanan_proje` int(4) unsigned NOT NULL DEFAULT '0',
  `biten_proje` int(4) unsigned NOT NULL DEFAULT '0',
  `baslanan_proje_toplam_fiyat` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `biten_proje_toplam_fiyat` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `toplam_odenen_fiyat` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `ay_yil` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table musteriler
# ------------------------------------------------------------

DROP TABLE IF EXISTS `musteriler`;

CREATE TABLE `musteriler` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(150) NOT NULL,
  `firma` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefon` varchar(150) NOT NULL,
  `kullanici_adi` varchar(150) NOT NULL,
  `sifre` varchar(150) NOT NULL,
  `proje_toplam` decimal(10,2) NOT NULL,
  `toplam_odeme` decimal(10,2) NOT NULL,
  `toplam_borc` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table odemeler
# ------------------------------------------------------------

DROP TABLE IF EXISTS `odemeler`;

CREATE TABLE `odemeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `musteri_id` int(11) NOT NULL DEFAULT '0',
  `proje_id` int(11) NOT NULL DEFAULT '0',
  `odeme_tarihi` date NOT NULL,
  `tutar` decimal(10,2) NOT NULL,
  `aciklama` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `musteri_id` (`musteri_id`),
  KEY `proje_id` (`proje_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table projeler
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projeler`;

CREATE TABLE `projeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `musteri_id` int(11) NOT NULL DEFAULT '0',
  `proje_durum` int(2) NOT NULL DEFAULT '0',
  `odeme_durum` int(1) NOT NULL DEFAULT '0',
  `baslangic_tarih` date NOT NULL,
  `bitis_tarih` date NOT NULL,
  `proje_ad` varchar(150) NOT NULL,
  `proje_detay` text NOT NULL,
  `fiyat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `odenen_tutar` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kalan_tutar` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `musteri_id` (`musteri_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
