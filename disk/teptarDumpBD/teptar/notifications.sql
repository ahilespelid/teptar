/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `receiver` int(11) DEFAULT NULL,
  KEY `Индекс 1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COMMENT='Уведомления';

/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `sender`, `datetime`, `message`, `seen`, `receiver`) VALUES
	(1, 4, '2022-05-19 19:13:31', 'Сообщение уведомления для района Грозненский', 1, 26),
	(2, 4, '2022-05-19 19:13:31', 'Сообщение уведомления для района Грозненский', 1, 26),
	(3, 4, '2022-02-19 19:13:31', 'Сообщение уведомления для района Грозненский', 1, 22),
	(4, 4, '2022-02-19 19:13:31', 'Сообщение уведомления для района Грозненский', 1, 26),
	(5, 4, '2022-02-19 12:08:22', 'Сообщение уведомления для района Грозненский', 1, 7),
	(6, 8, '2022-01-04 19:13:31', 'Сообщение уведомления для района Курчалоевский', 1, 22),
	(7, 16, '2022-01-04 19:13:31', 'Сообщение уведомления для района Шатойский', 1, 26),
	(8, 4, '2022-05-19 14:11:31', 'Сообщение уведомления для района Грозненский', 1, 7),
	(9, 11, '2022-05-19 19:13:31', 'Сообщение уведомления для района Ножай-Юртовский', 1, 22),
	(10, 11, '2022-03-26 19:13:31', 'Сообщение уведомления для района Ножай-Юртовский', 1, 26),
	(11, 4, '2022-04-09 18:59:31', 'Сообщение уведомления для района Грозненский', 1, 7),
	(12, 11, '2022-04-09 19:13:31', 'Сообщение уведомления для района Ножай-Юртовский', 1, 26),
	(13, 10, '2022-04-09 19:13:31', 'Сообщение уведомления для района Наурский', 1, 22),
	(14, 10, '2022-04-09 19:13:31', 'Сообщение уведомления для района Наурский', 1, 22),
	(15, 10, '2022-02-17 19:13:31', 'Сообщение уведомления для района Наурский', 1, 26),
	(16, 17, '2022-02-17 19:13:31', 'Сообщение уведомления для района Шелковской', 1, 26),
	(17, 4, '2022-06-21 13:42:31', 'Сообщение уведомления для района Грозненский', 1, 7),
	(18, 3, '2022-06-21 19:13:31', 'Сообщение уведомления для района Веденский', 1, 26),
	(19, 18, '2022-06-06 19:13:31', 'Сообщение уведомления от Министерства Образования', 1, 7),
	(20, 3, '2022-07-01 19:13:31', 'Сообщение уведомления для района Веденский', 1, 22),
	(21, 7, '2022-07-01 19:13:31', 'Сообщение уведомления для района Итум-Калинский', 1, 26),
	(22, 4, '2022-07-01 12:25:31', 'Сообщение уведомления для района Грозненский', 1, 7),
	(23, 7, '2022-02-05 19:13:31', 'Сообщение уведомления для района Итум-Калинский', 1, 26),
	(24, 9, '2022-02-05 19:13:31', 'Сообщение уведомления для района Надтеречный', 1, 26),
	(25, 4, '2022-02-05 19:13:31', 'Сообщение уведомления для района Грозненский', 1, 7),
	(26, 9, '2022-01-25 19:13:31', 'Сообщение уведомления для района Надтеречный', 1, 26),
	(27, 1, '2022-04-15 19:13:31', 'Сообщение уведомления для района Аргун', 1, 26),
	(28, 4, '2022-02-22 21:13:24', 'Сообщение уведомления для района Грозненский', 1, 7),
	(29, 5, '2022-03-26 19:16:30', 'Сообщение уведомления для района Грозный', 1, 26),
	(30, 5, '2022-03-26 19:16:30', 'Сообщение уведомления для района Грозный', 1, 22),
	(31, 26, '2022-08-10 20:15:28', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Тест', 1, 7),
	(32, 26, '2022-08-10 20:15:28', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Тест', 1, 22),
	(33, 26, '2022-08-10 20:15:28', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Тест', 0, 23),
	(34, 26, '2022-08-10 20:15:28', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Тест', 0, 24),
	(35, 26, '2022-08-10 20:17:23', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(36, 26, '2022-08-10 20:17:23', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(37, 26, '2022-08-10 20:17:23', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(38, 26, '2022-08-10 20:17:23', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(39, 26, '2022-08-15 20:18:18', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(40, 26, '2022-08-15 20:18:18', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(41, 26, '2022-08-15 20:18:18', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(42, 26, '2022-08-15 20:18:18', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(43, 26, '2022-08-15 20:25:12', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: fgsdhfsdf', 1, 7),
	(44, 26, '2022-08-15 20:25:12', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: fgsdhfsdf', 1, 22),
	(45, 26, '2022-08-15 20:25:12', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: fgsdhfsdf', 0, 23),
	(46, 26, '2022-08-15 20:25:12', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: fgsdhfsdf', 0, 24),
	(47, 26, '2022-08-15 20:26:01', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: sfgdfdsfgsd', 1, 7),
	(48, 26, '2022-08-15 20:26:01', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: sfgdfdsfgsd', 1, 22),
	(49, 26, '2022-08-15 20:26:01', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: sfgdfdsfgsd', 0, 23),
	(50, 26, '2022-08-15 20:26:01', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: sfgdfdsfgsd', 0, 24),
	(51, 26, '2022-08-15 20:38:50', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(52, 26, '2022-08-15 20:38:51', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(53, 26, '2022-08-15 20:38:51', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(54, 26, '2022-08-15 20:38:51', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(55, 26, '2022-08-15 20:39:46', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(56, 26, '2022-08-15 20:39:46', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(57, 26, '2022-08-15 20:39:46', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(58, 26, '2022-08-15 20:39:46', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(59, 26, '2022-08-15 20:40:35', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(60, 26, '2022-08-15 20:40:35', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(61, 26, '2022-08-15 20:40:35', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(62, 26, '2022-08-15 20:40:35', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(63, 26, '2022-08-15 20:41:06', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(64, 26, '2022-08-15 20:41:06', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(65, 26, '2022-08-15 20:41:06', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(66, 26, '2022-08-15 20:41:06', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(67, 26, '2022-08-15 21:11:53', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: прар', 1, 7),
	(68, 26, '2022-08-15 21:11:53', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: прар', 1, 22),
	(69, 26, '2022-08-15 21:11:53', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: прар', 0, 23),
	(70, 26, '2022-08-15 21:11:53', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: прар', 0, 24),
	(71, 26, '2022-08-15 21:11:53', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: прар', 0, 32),
	(72, 26, '2022-08-15 21:12:25', 'Министерство экономики утвердило «Отчет за 2022»', 1, 7),
	(73, 26, '2022-08-15 21:12:25', 'Министерство экономики утвердило «Отчет за 2022»', 1, 22),
	(74, 26, '2022-08-15 21:12:25', 'Министерство экономики утвердило «Отчет за 2022»', 0, 23),
	(75, 26, '2022-08-15 21:12:25', 'Министерство экономики утвердило «Отчет за 2022»', 0, 24),
	(76, 26, '2022-08-15 21:12:25', 'Министерство экономики утвердило «Отчет за 2022»', 0, 32),
	(77, 26, '2022-08-15 21:37:34', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики', 1, 7),
	(78, 26, '2022-08-15 21:37:34', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики', 1, 22),
	(79, 26, '2022-08-15 21:37:34', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики', 0, 23),
	(80, 26, '2022-08-15 21:37:34', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики', 0, 24),
	(81, 26, '2022-08-15 21:37:34', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики', 0, 32),
	(82, 26, '2022-08-15 22:13:23', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики ', 1, 7),
	(83, 26, '2022-08-15 22:13:23', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики ', 1, 22),
	(84, 26, '2022-08-15 22:13:23', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики ', 0, 23),
	(85, 26, '2022-08-15 22:13:23', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики ', 0, 24),
	(86, 26, '2022-08-15 22:13:23', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: Это последний комментарий при отправке отчета на доработку от министерства экономики ', 0, 32),
	(87, 26, '2022-08-16 15:44:01', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: hjdggdfhgfhfghdf', 1, 7),
	(88, 26, '2022-08-16 15:44:02', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: hjdggdfhgfhfghdf', 1, 22),
	(89, 26, '2022-08-16 15:44:02', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: hjdggdfhgfhfghdf', 0, 23),
	(90, 26, '2022-08-16 15:44:02', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: hjdggdfhgfhfghdf', 0, 24),
	(91, 26, '2022-08-16 15:44:02', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: hjdggdfhgfhfghdf', 0, 32),
	(92, 33, '2022-08-16 21:51:48', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: safd', 1, 7),
	(93, 33, '2022-08-16 21:51:48', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: safd', 1, 22),
	(94, 33, '2022-08-16 21:51:48', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: safd', 0, 23),
	(95, 33, '2022-08-16 21:51:48', 'Министерство экономики отправило «Отчет за 2022» на доработку по следующей причине: safd', 0, 24),
	(96, 1, '2022-08-17 21:10:30', 'Служба поддержки ответила на ваше обращение, перейдите во вкладку «Служба поддержки» чтобы посмотреть ответ.', 1, 26),
	(97, 1, '2022-08-17 21:12:20', 'Служба поддержки ответила на ваше обращение, перейдите во вкладку «Служба поддержки» чтобы посмотреть ответ.', 1, 22),
	(98, 1, '2022-08-17 21:15:27', 'Служба поддержки ответила на ваше обращение, перейдите во вкладку «Служба поддержки» чтобы посмотреть ответ.', 1, 22),
	(99, 1, '2022-08-18 14:56:10', 'Служба поддержки ответила на ваше обращение, перейдите во вкладку «Служба поддержки» чтобы посмотреть ответ.', 1, 22),
	(100, 1, '2022-08-18 14:59:00', 'Служба поддержки ответила на ваше обращение, перейдите во вкладку «Служба поддержки» чтобы посмотреть ответ.', 1, 22);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
