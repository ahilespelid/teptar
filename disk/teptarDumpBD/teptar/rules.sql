/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL,
  `uin` text DEFAULT NULL,
  `subject_role` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `page` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `right` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` (`id`, `uin`, `subject_role`, `name`, `page`, `comment`, `right`) VALUES
	(1, '30', 'Boss, Admin', 'Видеть список районов.', 'Страница Главная', 'Глава Региона', NULL),
	(2, '30', 'Boss, Admin', 'Видеть список показателей.', 'Страница Главная', 'Глава Региона', NULL),
	(3, '30', 'Boss, Admin', 'Видеть общий рейтинг всего региона по показателям.', 'Страница Главная', 'Глава Региона', NULL),
	(4, '30', 'Boss, Admin', 'Видеть рейтинг всех районов по конкретному показателю.', 'Страница Главная', 'Глава Региона', NULL),
	(5, '30', 'Boss, Admin', 'Видеть систему блокчейна по конкретному отчету и району.', 'Страница Главная', 'Глава Региона', NULL),
	(6, '30', 'Boss, Admin', 'Может сформировать отчет за выбранное время по всему региону.', 'Страница Главная', 'Глава Региона', NULL),
	(7, '24', 'Boss, Admin', 'Видеть список районов.', 'Страница Рейтинг', 'Министерство Экономики', NULL),
	(8, '24', 'Boss, Admin', 'Видеть список показателей.', 'Страница Рейтинг', 'Министерство Экономики', NULL),
	(9, '24', 'Boss, Admin', 'Видеть общий рейтинг всего региона по показателям.', 'Страница Рейтинг', 'Министерство Экономики', NULL),
	(10, '24', 'Boss, Admin', 'Видеть рейтинг всех районов по конкретному показателю.', 'Страница Рейтинг', 'Министерство Экономики', NULL),
	(11, '24', 'Boss, Admin', 'Видеть систему блокчейна по конкретному отчету и району.', 'Страница Рейтинг', 'Министерство Экономики', NULL),
	(12, '24', 'Boss, Admin', 'Может сформировать отчет за выбранное время по всему региону.', 'Страница Рейтинг', 'Министерство Экономики', NULL),
	(13, '24,30', 'Boss, Admin', 'Видеть, место на котором находится район в текущем году, чем за предыдущий.', 'Информационная страница Района', 'Глава Региона, Министерство Экономики', NULL),
	(14, '24,30', 'Boss, Admin', 'Видеть рейтинг всех районов по конкретному показателю и видеть на каком месте район находится среди других районов по этому показателю.', 'Информационная страница Района', 'Глава Региона, Министерство Экономики', NULL),
	(15, '24,30', 'Boss, Admin', 'Видеть данные (индекс) по конкретному показателю (при просмотре показателя по конкретному району).', 'Информационная страница Района', 'Глава Региона, Министерство Экономики', NULL),
	(16, '24,30', 'Boss, Admin', 'Видеть систему блокчейна по конкретному отчету и дате.', 'Информационная страница Района', 'Глава Региона, Министерство Экономики', NULL),
	(17, '24,30', 'Boss, Admin', 'Может сформировать отчет за выбранное время по Району.', 'Информационная страница Района', 'Глава Региона, Министерство Экономики', NULL),
	(18, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30', 'Boss, Staff, Admin', 'Видеть информацию о Районе или Министерстве (список сотрудников, численность, главу и прочее). ', 'Информационная страница Района или Министерства', 'Все Министерства, Районы и Глава Региона', NULL),
	(19, '18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр списка районов и данные по их отчетам.', 'Страница Главная', 'Министерство', NULL),
	(20, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр списка отчетов у Района.', 'Страница список отчетов Района', 'Министерство и Районы', NULL),
	(21, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Выгрузить отчет(ы) в word и pdf. ', 'Страница список отчетов Района', 'Министерство и Районы', NULL),
	(22, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', 'Boss, Admin', 'Создать новый отчет.', 'Страница создания отчета', 'Район Boss', NULL),
	(23, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', 'Boss, Staff, Admin', 'Отправить отчет на проверку.', 'Просмотр своего отчета', 'Район', NULL),
	(24, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', 'Boss, Staff, Admin', 'Редактировать описание.', 'Просмотр своего отчета', 'Район', NULL),
	(25, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', 'Boss, Staff, Admin', 'Повторно отправить отчет на проверку.', 'Просмотр своего отчета', 'Район', NULL),
	(26, '24', 'Boss, Staff, Admin', 'Принять отчет. ', 'Просмотр отчета Района', 'Министерство Экономики', NULL),
	(27, '24', 'Boss, Staff, Admin', 'Оставить замечание к отчету. ', 'Просмотр отчета Района', 'Министерство Экономики', NULL),
	(28, '24', 'Boss, Staff, Admin', 'Отклонить отчет (Отправить на доработку).', 'Просмотр отчета Района', 'Министерство Экономики', NULL),
	(29, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр общей таблицы. ', 'Страница таблицы в отчете Района', 'Министерство и Районы', NULL),
	(30, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр сводной таблицы. ', 'Страница таблицы в отчете Района', 'Министерство и Районы', NULL),
	(31, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Изменения в сводной таблице (у каждого министерство свои поля для ввода, по которым оно вводит данные). ', 'Страница таблицы в отчете Района', 'Министерство и Районы', NULL),
	(32, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Сохранить изменения.', 'Страница таблицы в отчете Района', 'Министерство и Районы', NULL),
	(33, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', 'Boss, Admin', 'Выбор действия и ввод согласованных данных по показателям.', 'Страница таблицы в отчете Района', 'Район', NULL),
	(34, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Создать новую папку. ', 'Страница Диск', 'Министерство и Районы', NULL),
	(35, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Загрузить файл. ', 'Страница Диск', 'Министерство и Районы', NULL),
	(36, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Переименовать файлы и папки (которые загрузил или создал сам). ', 'Страница Диск', 'Министерство и Районы', NULL),
	(37, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Удалить файлы и папки (которые загрузил сам пользователь).', 'Страница Диск', 'Министерство и Районы', NULL),
	(38, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр уведомлений. ', 'Страница Уведомлений', 'Министерство и Районы', NULL),
	(39, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Admin', 'Регистрация сотрудника.', 'Страница Регистрации', 'Министерство и Районы', NULL),
	(40, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Admin', 'Подать заявку на удаление сотрудника. ', 'Профиль сотрудника', 'Министерство и Районы', NULL),
	(41, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30', 'Boss, Staff, Admin', 'Просмотр профиль пользователя.', 'Профиль пользователя', 'Все Министерства, Районы и Глава Региона', NULL),
	(42, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Редактировать профиль.', 'Личный профиль пользователя', 'Министерство и Районы', NULL),
	(43, '24', 'Boss, Admin', 'Редактировать профиль (Изменить изображение, сгенерировать пароль).', 'Личный профиль пользователя', 'Глава Региона', NULL),
	(44, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр контактной информации администрации портала.', 'Страница Служба поддержки', 'Министерство и Районы', NULL),
	(45, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Возможность связаться с администрацией, через форму обратной связи.', 'Страница Служба поддержки', 'Министерство и Районы', NULL),
	(46, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Boss, Staff, Admin', 'Просмотр контактной информации Министерств и Районов.', 'Страница Контакт-центр', 'Министерство и Районы', NULL);
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;