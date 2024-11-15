# ************************************************************
# Sequel Ace SQL dump
# Version 20077
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: pembayaran_listrik_db
# Generation Time: 2024-11-15 09:42:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;




# Dump of table level
# ------------------------------------------------------------

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id_level` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;

INSERT INTO `level` (`id_level`, `nama_level`)
VALUES
	(1,'administrator'),
	(2,'pelanggan');

/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pelanggan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nomor_kwh` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_tarif` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `fk_pelanggan_tarif` (`id_tarif`),
  CONSTRAINT `fk_pelanggan_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif`)
VALUES
	(1,'pelanggan1','*C7D0944DC7222D2F6EF2D567F34D6C6C28655285',11111,'Pelanggan Pertama','Jl. Pelanggan, No. 1, Kota Pelanggan',1),
	(2,'pelanggan2','*CFEEFFB1CA77BFB05A10448FE86F5EE620DEA9AF',22222,'Pelanggan Kedua','Jl. Pelanggan, No. 2, Kota Pelanggan',2),
	(3,'pelanggan3','*2AEC5195F194D66457F7141C88F5AFE0ADB95229',33333,'Pelanggan Ketiga','Jl. Pelanggan, No. 3, Kota Pelanggan',3),
	(4,'pelanggan4','*640278B8775528ADFA8372755BD0BAD80BFB1509',44444,'Pelanggan Keempat','Jl. Pelanggan, No. 4, Kota Pelanggan',4),
	(5,'pelanggan5','*F548F2ACA99C7ABAB5C74053AB812CDE57FD8F44',55555,'Pelanggan Kelima','Jl. Pelanggan, No. 5, Kota Pelanggan',5),
	(6,'bukanyohana','*294CA321B76B21C5933A16B4803DF7155B0C5144',100922,'Bukan Yohana','Jl. AaBeCe No. 123',5);

/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pembayaran
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tagihan` int(11) unsigned DEFAULT NULL,
  `id_pelanggan` int(11) unsigned DEFAULT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `bulan_bayar` int(11) DEFAULT NULL,
  `biaya_admin` double DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `id_user` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `fk_pembayaran_tagihan` (`id_tagihan`),
  KEY `fk_pembayaran_pelanggan` (`id_pelanggan`),
  KEY `fk_pembayaran_user` (`id_user`),
  CONSTRAINT `fk_pembayaran_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pembayaran_tagihan` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pembayaran_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `tanggal_pembayaran`, `bulan_bayar`, `biaya_admin`, `total_bayar`, `id_user`)
VALUES
	(1,1,1,'2024-11-14 18:48:32',11,30835.2,339187.2,1),
	(2,2,1,'2024-11-14 20:37:14',11,38720,425920,1);

/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table penggunaan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penggunaan`;

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) unsigned DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `meter_awal` float DEFAULT NULL,
  `meter_akhir` float DEFAULT NULL,
  PRIMARY KEY (`id_penggunaan`),
  KEY `fk_penggunaan_pelanggan` (`id_pelanggan`),
  CONSTRAINT `fk_penggunaan_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `penggunaan` WRITE;
/*!40000 ALTER TABLE `penggunaan` DISABLE KEYS */;

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`)
VALUES
	(1,1,1,2024,999,123),
	(2,1,2,2024,1200,100);

/*!40000 ALTER TABLE `penggunaan` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `after_penggunaan_insert` AFTER INSERT ON `penggunaan` FOR EACH ROW BEGIN
	INSERT INTO tagihan(id_penggunaan, id_pelanggan, bulan, tahun, jumlah_meter, status)
	VALUES(NEW.id_penggunaan, NEW.id_pelanggan, NEW.bulan, NEW.tahun, (NEW.meter_awal-NEW.meter_akhir), "Belum Dibayar");
END */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `after_penggunaan_update` AFTER UPDATE ON `penggunaan` FOR EACH ROW BEGIN
	UPDATE tagihan SET bulan=NEW.bulan, tahun=NEW.tahun, jumlah_meter=(NEW.meter_awal-NEW.meter_akhir) WHERE id_penggunaan=NEW.id_penggunaan;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table tagihan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tagihan`;

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_penggunaan` int(11) unsigned DEFAULT NULL,
  `id_pelanggan` int(11) unsigned DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `jumlah_meter` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `fk_tagihan_penggunaan` (`id_penggunaan`),
  KEY `fk_tagihan_pelanggan` (`id_pelanggan`),
  CONSTRAINT `fk_tagihan_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_tagihan_penggunaan` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tagihan` WRITE;
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`)
VALUES
	(1,1,1,1,2024,876,'Sudah Dibayar'),
	(2,2,1,2,2024,1100,'Konfirmasi Pembayaran');

/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tarif
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tarif`;

CREATE TABLE `tarif` (
  `id_tarif` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `daya` float DEFAULT NULL,
  `tarifperkwh` double DEFAULT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tarif` WRITE;
/*!40000 ALTER TABLE `tarif` DISABLE KEYS */;

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarifperkwh`)
VALUES
	(1,450,352),
	(2,900,455),
	(3,1300,708),
	(4,2200,760),
	(5,3500,900),
	(8,7000,1800);

/*!40000 ALTER TABLE `tarif` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_admin` varchar(50) DEFAULT NULL,
  `id_level` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_user_level` (`id_level`),
  CONSTRAINT `fk_user_level` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_admin`, `id_level`)
VALUES
	(1,'administrator','*9F880DA1329B4B497F247AA25727CCDD5F4DD2E0','administrator',1),
	(2,'administrator2','*AF15C03D6245CF4B1ED47D01134F88D5178F7D0D','administrator2',2);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of view informasi_penggunaan_listrik
# ------------------------------------------------------------

DROP TABLE IF EXISTS `informasi_penggunaan_listrik`; DROP VIEW IF EXISTS `informasi_penggunaan_listrik`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `informasi_penggunaan_listrik`
AS SELECT
   `penggunaan`.`id_penggunaan` AS `id_penggunaan`,
   `penggunaan`.`id_pelanggan` AS `id_pelanggan`,
   `penggunaan`.`bulan` AS `bulan`,
   `penggunaan`.`tahun` AS `tahun`,
   `penggunaan`.`meter_awal` AS `meter_awal`,
   `penggunaan`.`meter_akhir` AS `meter_akhir`,
   `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`,
   `pelanggan`.`nomor_kwh` AS `nomor_kwh`,
   `pelanggan`.`username` AS `username`
FROM (`penggunaan` join `pelanggan` on(`penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`));


--
-- Dumping routines (PROCEDURE) for database 'pembayaran_listrik_db'
--
DELIMITER ;;

# Dump of PROCEDURE list_pelanggan_by_daya
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `list_pelanggan_by_daya` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `list_pelanggan_by_daya`(IN _daya INT)
BEGIN
    SELECT pelanggan.id_pelanggan, pelanggan.username, pelanggan.nomor_kwh, pelanggan.nama_pelanggan, pelanggan.alamat, tarif.* FROM pelanggan
	INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
	WHERE tarif.daya = _daya;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
DELIMITER ;

--
-- Dumping routines (FUNCTION) for database 'pembayaran_listrik_db'
--
DELIMITER ;;

# Dump of FUNCTION total_all_penggunaan_listrik_per_bulan
# ------------------------------------------------------------

/*!50003 DROP FUNCTION IF EXISTS `total_all_penggunaan_listrik_per_bulan` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 FUNCTION `total_all_penggunaan_listrik_per_bulan`(_id_pelanggan INT, _bulan INT, _tahun INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
   SET @meter_awal := 0;
   SET @meter_akhir := 0;
   SELECT meter_awal FROM penggunaan WHERE id_pelanggan = _id_pelanggan AND bulan = _bulan AND tahun = _tahun LIMIT 1 INTO @meter_awal;
   SELECT meter_akhir FROM penggunaan WHERE id_pelanggan = _id_pelanggan AND bulan = _bulan AND tahun = _tahun LIMIT 1 INTO @meter_akhir;
   RETURN @meter_awal - @meter_akhir;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
DELIMITER ;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
