/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `name` varchar(255) NOT NULL DEFAULT '0',
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `menu` (`id`, `name`) VALUES
                                      (6, 'Статьи'),
                                      (7, 'Колхоз');

DROP TABLE IF EXISTS `menu_item`;
CREATE TABLE IF NOT EXISTS `menu_item` (
                                           `id` int NOT NULL AUTO_INCREMENT,
                                           `menu_id` int NOT NULL DEFAULT '0',
                                           `name` varchar(255) NOT NULL DEFAULT '',
                                           `parent` tinyint(1) NOT NULL DEFAULT (0),
                                           `position` int NOT NULL DEFAULT '999',
                                           `link` varchar(255) DEFAULT '#',
                                           PRIMARY KEY (`id`),
                                           KEY `FK_menu_item_menu` (`menu_id`),
                                           CONSTRAINT `FK_menu_item_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `menu_item` (`id`, `menu_id`, `name`, `parent`, `position`, `link`) VALUES
                                                                                    (8, 6, 'New item 1', 0, 0, '#'),
                                                                                    (28, 6, 'New item 2', 0, 1, '#'),
                                                                                    (38, 7, 'Председатель', 0, 0, '#'),
                                                                                    (39, 7, 'Агроном', 0, 2, '#'),
                                                                                    (40, 7, 'Доярка', 0, 5, '#'),
                                                                                    (41, 7, 'Слесарь', 0, 4, '#'),
                                                                                    (42, 7, 'Бухгалтер', 0, 1, '#'),
                                                                                    (43, 7, 'Тракторист', 0, 3, '#'),
                                                                                    (46, 7, 'Пастух', 0, 6, '#');

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `title` varchar(255) DEFAULT NULL,
                                      `content` text,
                                      `date` timestamp NULL DEFAULT (now()),
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `page` (`id`, `title`, `content`, `date`) VALUES
                                                          (1, 'Как настроить Docker Swarm 1', '<p>В статье разбирается настройка кластера Docker Swarm, подключение менеджеров и воркеров, а также распространённые ошибки. frffrefefref</p>', '2025-09-05 18:47:28'),
                                                          (2, 'Symfony: работа с кэшем', 'Обзор компонентов кэширования в Symfony, примеры использования Psr16Cache и рекомендации по хранению данных.', '2025-08-20 17:20:58'),
                                                          (3, 'Traefik против Nginx', '<p>Сравнение возможностей двух популярных прокси: автоматическое получение SSL, маршрутизация и балансировка нагрузки.</p>', '2025-08-25 17:01:19'),
                                                          (4, 'CI/CD в GitLab', 'Пошаговая настройка пайплайнов, автоматический деплой и лучшие практики для проектов на PHP и Node.js.', '2025-08-20 17:20:58'),
                                                          (5, 'Мониторинг через Grafana ', '<p>Как подключить Prometheus к Grafana, визуализировать метрики и настроить алерты для продакшен окружения.</p>', '2025-08-25 17:51:57');

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                                      `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
                                      `date` timestamp NULL DEFAULT (now()),
                                      PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `post` (`id`, `title`, `content`, `date`) VALUES
                                                          (1, 'First Postrthytruyik 1', '<p>This is the content of the very first post. Welcome to thrthhe blog!</p>', '2025-09-05 18:49:00'),
                                                          (2, 'Tech News ', '<p>Today we discuss the latest trends in AI, cloud computing, and cybersecurity.</p>', '2025-08-27 10:32:16'),
                                                          (3, 'Travel Diary', 'Visited the mountains this weekend. The view was breathtaking and refreshing.', '2025-08-25 16:51:43'),
                                                          (4, 'Cooking Tips', 'Here are 5 quick and easy pasta recipes you can make in under 20 minutes.', '2025-08-25 16:51:43');

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
                                         `id` int NOT NULL DEFAULT (0),
                                         `name` varchar(255) DEFAULT NULL,
                                         `key_field` varchar(100) DEFAULT NULL,
                                         `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                                         `section` varchar(50) DEFAULT NULL,
                                         PRIMARY KEY (`id`),
                                         UNIQUE KEY `name` (`name`),
                                         UNIQUE KEY `key_field` (`key_field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `setting` (`id`, `name`, `key_field`, `value`, `section`) VALUES
                                                                          (0, 'Theme', 'theme', 'monaco', 'theme'),
                                                                          (1, 'Name site', 'name_site', 'Блог Сотникова С. Н. (Gizya)', 'general'),
                                                                          (2, 'Description', 'description', 'Example description', 'general'),
                                                                          (3, 'Admin email', 'admin_email', 'gizya_85@mail.ru', 'general'),
                                                                          (4, 'Language', 'language', 'en', 'general');

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `email` varchar(255) DEFAULT NULL,
                                      `password` varchar(32) DEFAULT NULL,
                                      `role` enum('admin','moderator','user') DEFAULT NULL,
                                      `hash` varchar(32) DEFAULT NULL,
                                      `data_reg` datetime DEFAULT (now()),
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `email`, `password`, `role`, `hash`, `data_reg`) VALUES
    (1, 'gizya_85@mail.ru', 'b59c67bf196a4758191e42f76670ceba', NULL, 'b59c67bf196a4758191e42f76670ceba', '2025-08-17 14:52:15');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
