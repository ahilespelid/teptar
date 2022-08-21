/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `message` text DEFAULT NULL,
  `answered` tinyint(1) DEFAULT NULL,
  `answerFor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='Страница служба поддержка';

/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` (`id`, `id_user`, `date`, `message`, `answered`, `answerFor`) VALUES
	(5, 7, '2022-08-15 18:16:32', 'Привет', 1, NULL),
	(6, 7, '2022-08-15 18:17:03', 'Как дела?', 1, NULL),
	(7, 22, '2022-08-15 19:25:41', 'Здравствуйте, куда я попал?', 0, NULL),
	(8, 22, '2022-08-15 19:25:49', 'Помогите', 0, NULL),
	(9, 1, '2022-08-17 19:31:57', 'Здравствуйте', NULL, 5),
	(10, 1, '2022-08-17 19:55:48', 'Все хорошо, у вас как?', NULL, 6),
	(11, 1, '2022-08-17 20:20:51', 'Здравствуйте, как добавить отчет?', 0, NULL),
	(12, 1, '2022-08-17 20:41:21', 'Тестирую', 1, NULL),
	(13, 1, '2022-08-17 20:42:06', 'Закончил?', NULL, 12),
	(22, 22, '2022-08-18 14:58:51', 'гшщшщ-=', 1, NULL),
	(23, 1, '2022-08-18 14:59:00', 'гшщ', NULL, 22),
	(18, 22, '2022-08-17 21:14:43', 'Привет, как добавить сотрудника?', 1, NULL),
	(19, 1, '2022-08-17 21:15:27', 'Нажмите на пункт меню «Добавить сотрудника»', NULL, 18),
	(20, 22, '2022-08-18 14:55:56', 'Муса', 1, NULL),
	(21, 1, '2022-08-18 14:56:10', 'Ок', NULL, 20);
/*!40000 ALTER TABLE `support` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
