-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.38 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных profiru
CREATE DATABASE IF NOT EXISTS `profiru` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `profiru`;

-- Дамп структуры для таблица profiru.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы profiru.category: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
REPLACE INTO `category` (`id`, `name`) VALUES
	(3, 'Для дома'),
	(1, 'Новинки'),
	(4, 'Отдых'),
	(2, 'Спорт');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица profiru.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы profiru.items: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
REPLACE INTO `items` (`id`, `name`) VALUES
	(1, 'Боксёрская груша'),
	(2, 'Холодильник'),
	(3, 'Чайник'),
	(4, 'Мяч');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Дамп структуры для таблица profiru.ratio_category_items
CREATE TABLE IF NOT EXISTS `ratio_category_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` varchar(50) DEFAULT NULL,
  `id_item` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_category_id_item` (`id_category`,`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы profiru.ratio_category_items: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `ratio_category_items` DISABLE KEYS */;
REPLACE INTO `ratio_category_items` (`id`, `id_category`, `id_item`) VALUES
	(6, '1', '4'),
	(1, '2', '1'),
	(7, '2', '4'),
	(2, '3', '1'),
	(3, '3', '2'),
	(4, '3', '3'),
	(5, '4', '3');
/*!40000 ALTER TABLE `ratio_category_items` ENABLE KEYS */;

-- Дамп структуры для таблица profiru.tokens
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы profiru.tokens: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
REPLACE INTO `tokens` (`id`, `token`, `date`) VALUES
	(1, 'b9ed33f9ee1cacfeb224ce2a0e533eae', '2018-07-24 13:33:01'),
	(2, '328714046858f4e1cdd357db03bc0f5a', '2018-07-24 13:33:13'),
	(3, '7bbe1b51cc8aa8260e865abad1ab7ae8', '2018-07-24 13:36:33'),
	(4, 'eac46c5817cc5a5fa33292436c1e30fe', '2018-07-24 16:38:44'),
	(5, 'f0370080c4ab07104a6c53e8ef6de108', '2018-07-24 23:39:52');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;

-- Дамп структуры для таблица profiru.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT '',
  `password` varchar(50) DEFAULT '',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы profiru.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `login`, `password`) VALUES
	(1, 'admin', '123'),
	(2, 'tester', '123');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
