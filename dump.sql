-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.4.6 - MySQL Community Server - GPL
-- Операционная система:         Linux
-- HeidiSQL Версия:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица cms.page
DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `title` varchar(255) DEFAULT NULL,
                                      `content` text,
                                      `date` timestamp NULL DEFAULT (now()),
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы cms.page: ~5 rows (приблизительно)
INSERT IGNORE INTO `page` (`id`, `title`, `content`, `date`) VALUES
                                                                 (1, 'Как настроить Docker Swarm', '<p>В статье разбирается настройка кластера Docker Swarm, подключение менеджеров и воркеров, а также распространённые ошибки. frffrefefref</p>', '2025-08-25 17:51:49'),
                                                                 (2, 'Symfony: работа с кэшем', 'Обзор компонентов кэширования в Symfony, примеры использования Psr16Cache и рекомендации по хранению данных.', '2025-08-20 17:20:58'),
                                                                 (3, 'Traefik против Nginx', '<p>Сравнение возможностей двух популярных прокси: автоматическое получение SSL, маршрутизация и балансировка нагрузки.</p>', '2025-08-25 17:01:19'),
                                                                 (4, 'CI/CD в GitLab', 'Пошаговая настройка пайплайнов, автоматический деплой и лучшие практики для проектов на PHP и Node.js.', '2025-08-20 17:20:58'),
                                                                 (5, 'Мониторинг через Grafana ', '<p>Как подключить Prometheus к Grafana, визуализировать метрики и настроить алерты для продакшен окружения.</p>', '2025-08-25 17:51:57');

-- Дамп структуры для таблица cms.post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                                      `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
                                      `date` timestamp NULL DEFAULT (now()),
                                      PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы cms.post: ~4 rows (приблизительно)
INSERT IGNORE INTO `post` (`id`, `title`, `content`, `date`) VALUES
                                                                 (1, 'First Postrthytruyik', '<p>This is the content of the very first post. Welcome to thrthhe blog!</p>', '2025-08-27 10:26:47'),
                                                                 (2, 'Tech News ', '<p>Today we discuss the latest trends in AI, cloud computing, and cybersecurity.</p>', '2025-08-27 10:32:16'),
                                                                 (3, 'Travel Diary', 'Visited the mountains this weekend. The view was breathtaking and refreshing.', '2025-08-25 16:51:43'),
                                                                 (4, 'Cooking Tips', 'Here are 5 quick and easy pasta recipes you can make in under 20 minutes.', '2025-08-25 16:51:43');

-- Дамп структуры для таблица cms.setting
DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
                                         `id` int NOT NULL DEFAULT (0),
                                         `name` varchar(255) DEFAULT NULL,
                                         `key_field` varchar(100) DEFAULT NULL,
                                         `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                                         PRIMARY KEY (`id`),
                                         UNIQUE KEY `name` (`name`),
                                         UNIQUE KEY `key_field` (`key_field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы cms.setting: ~4 rows (приблизительно)
INSERT IGNORE INTO `setting` (`id`, `name`, `key_field`, `value`) VALUES
                                                                      (1, 'Name site', 'name_site', 'cms'),
                                                                      (2, 'Description', 'description', 'Example description'),
                                                                      (3, 'Admin email', 'admin_email', 'gizya_85@mail.ru'),
                                                                      (4, 'Language', 'language', 'english');

-- Дамп структуры для таблица cms.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `email` varchar(255) DEFAULT NULL,
                                      `password` varchar(32) DEFAULT NULL,
                                      `role` enum('admin','moderator','user') DEFAULT NULL,
                                      `hash` varchar(32) DEFAULT NULL,
                                      `data_reg` datetime DEFAULT (now()),
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы cms.user: ~1 rows (приблизительно)
INSERT IGNORE INTO `user` (`id`, `email`, `password`, `role`, `hash`, `data_reg`) VALUES
                                                                                      (1, 'gizya_85@mail.ru', 'b59c67bf196a4758191e42f76670ceba', NULL, 'b59c67bf196a4758191e42f76670ceba', '2025-08-17 14:52:15'),
                                                                                      (31, 'test@admin.com', 'c81e728d9d4c2f636f067f89cc14862c', 'user', 'new', '2025-08-27 10:25:36'),
                                                                                      (32, 'test@admin.com', 'e4da3b7fbbce2345d7772b0674a318d5', 'user', 'new', '2025-08-27 10:27:04'),
                                                                                      (33, 'test@admin.com', 'e4da3b7fbbce2345d7772b0674a318d5', 'user', 'new', '2025-08-27 10:32:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
