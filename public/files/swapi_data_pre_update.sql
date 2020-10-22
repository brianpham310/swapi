# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.27-0ubuntu0.18.04.1)
# Database: dev-jedi
# Generation Time: 2020-10-22 10:00:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table characters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `characters`;

CREATE TABLE `characters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `mass` decimal(8,2) DEFAULT NULL,
  `hair_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skin_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeworld_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `species_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `characters` WRITE;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;

INSERT INTO `characters` (`id`, `name`, `height`, `mass`, `hair_color`, `skin_color`, `birth_year`, `gender`, `homeworld_name`, `species_name`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'Tion Medon',206.00,80.00,'none','grey','unknown','male','Utapau','Pau\'an',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(2,'Bossk',190.00,113.00,'none','green','53BBY','male','Trandosha','Trandoshan',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(3,'Ackbar',180.00,83.00,'none','brown mottle','41BBY','male','Mon Cala','Mon Calamari',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(4,'Wicket Systri Warrick',88.00,20.00,'brown','brown','8BBY','male','Endor','Ewok',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(5,'Nien Nunb',160.00,68.00,'none','grey','unknown','male','Sullust','Sullustan',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(6,'Poggle the Lesser',183.00,80.00,'none','green','unknown','male','Geonosis','Geonosian',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(7,'Barriss Offee',166.00,50.00,'black','yellow','40BBY','female','Mirial','Mirialan',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(8,'Zam Wesell',168.00,55.00,'blonde','fair, green, yellow','unknown','female','Zolan','Clawdite',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(9,'Dexter Jettster',198.00,102.00,'none','brown','unknown','male','Ojom','Besalisk',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(10,'Nute Gunray',191.00,90.00,'none','mottled green','unknown','male','Cato Neimoidia','Neimodian',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(11,'Sebulba',112.00,40.00,'none','grey, red','unknown','male','Malastare','Dug',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(12,'Greedo',173.00,74.00,'n/a','green','44BBY','male','Rodia','Rodian',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(13,'Ki-Adi-Mundi',198.00,82.00,'white','pale','92BBY','male','Cerea','Cerean',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(14,'Kit Fisto',196.00,87.00,'none','green','unknown','male','Glee Anselm','Nautolan',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(15,'Plo Koon',188.00,80.00,'none','orange','22BBY','male','Dorin','Kel Dor',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(16,'Darth Maul',175.00,80.00,'none','red','54BBY','male','Dathomir','Zabrak',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(17,'Ayla Secura',178.00,55.00,'none','blue','48BBY','female','Ryloth','Twi\'lek',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(18,'Ratts Tyerel',79.00,15.00,'none','grey, blue','unknown','male','Aleen Minor','Aleena',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(19,'Dud Bolt',94.00,45.00,'none','blue, grey','unknown','male','Vulpter','Vulptereen',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(20,'Ben Quadinaros',163.00,65.00,'none','grey, green, yellow','unknown','male','Tund','Toong',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(21,'Wat Tambor',193.00,48.00,'none','green, grey','unknown','male','Skako','Skakoan',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(22,'Shaak Ti',178.00,57.00,'none','red, blue, white','unknown','female','Shili','Togruta',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(23,'Grievous',216.00,159.00,'none','brown, white','unknown','male','Kalee','Kaleesh',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48'),
	(24,'Tarfful',234.00,136.00,'brown','brown','unknown','male','Kashyyyk','Wookie',NULL,'2020-10-22 09:58:48','2020-10-22 09:58:48');

/*!40000 ALTER TABLE `characters` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
