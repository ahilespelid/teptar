/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `deadline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Конец срока сдачи отчета';

/*!40000 ALTER TABLE `deadline` DISABLE KEYS */;
INSERT INTO `deadline` (`id`, `date`, `name`, `year`) VALUES
	(1, '2018-04-19 21:27:00', 'Отчет 2018 за 2017', 2017),
	(2, '2019-04-19 21:27:00', 'Отчет 2019 за 2018', 2018),
	(3, '2020-04-19 21:27:00', 'Отчет 2020 за 2019', 2019),
	(4, '2021-04-19 21:27:00', 'Отчет 2021 за 2020', 2020),
	(5, '2022-04-19 21:27:00', 'Отчет 2022 за 2021', 2021),
	(6, '2023-04-19 21:27:00', 'Отчет за 2022', 2022);
/*!40000 ALTER TABLE `deadline` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
