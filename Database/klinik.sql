-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table klinik.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table klinik.admin: ~3 rows (approximately)
INSERT INTO `admin` (`id`, `username`, `password`) VALUES
	(1, 'admins', '202cb962ac59075b964b07152d234b70'),
	(5, 'admin_klinik1', '202cb962ac59075b964b07152d234b70'),
	(6, 'ok', '202cb962ac59075b964b07152d234b70');

-- Dumping structure for table klinik.dokter
CREATE TABLE IF NOT EXISTS `dokter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table klinik.dokter: ~3 rows (approximately)
INSERT INTO `dokter` (`id`, `nama`, `spesialis`, `no_hp`) VALUES
	(5, 'dr. Muhammad Fawwaz Zildan ', 'Kulit', '0886767699'),
	(7, 'dr. Andi', 'Kanker', '09293930494'),
	(9, 'dr. Ilham Budiyanto', 'Tulang', '0833332992');

-- Dumping structure for table klinik.pasien
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table klinik.pasien: ~2 rows (approximately)
INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_hp`) VALUES
	(5, 'Rizkyss', 'Jakarta Barat ', '09383848'),
	(6, 'Ahmad', 'Kalimantan Timur', '0938383838');

-- Dumping structure for table klinik.pelayanan_medis
CREATE TABLE IF NOT EXISTS `pelayanan_medis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pasien_id` int DEFAULT NULL,
  `dokter_id` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keluhan` text,
  `biaya` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `dokter_id` (`dokter_id`),
  CONSTRAINT `pelayanan_medis_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`),
  CONSTRAINT `pelayanan_medis_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table klinik.pelayanan_medis: ~7 rows (approximately)
INSERT INTO `pelayanan_medis` (`id`, `pasien_id`, `dokter_id`, `tanggal`, `keluhan`, `biaya`) VALUES
	(6, 6, 5, '2026-04-08', 'Gatal Perih', 100000),
	(9, 5, 7, '2026-06-23', '122', 1233),
	(10, 5, 5, '2026-06-01', 'sakit', 2040400),
	(11, 6, 7, '2026-06-01', 'kdokdo', 300000),
	(12, 5, 5, '2026-06-15', 'eqeq', 3333),
	(13, 6, 5, '2026-06-30', 'aw', 10),
	(14, 5, 5, '2026-06-01', 'jiwa', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
