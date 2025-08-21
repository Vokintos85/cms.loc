-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.4.6 - MySQL Community Server - GPL
-- Операционная система:         Linux
-- HeidiSQL Версия:              12.11.0.7073
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы cms.page: ~5 rows (приблизительно)
INSERT IGNORE INTO `page` (`id`, `title`, `content`, `date`) VALUES
                                                                 (1, 'Как настроить Docker Swarm', 'В статье разбирается настройка кластера Docker Swarm, подключение менеджеров и воркеров, а также распространённые ошибки.', '2025-08-20 17:20:58'),
                                                                 (2, 'Symfony: работа с кэшем', 'Обзор компонентов кэширования в Symfony, примеры использования Psr16Cache и рекомендации по хранению данных.', '2025-08-20 17:20:58'),
                                                                 (3, 'Traefik против Nginx', 'Сравнение возможностей двух популярных прокси: автоматическое получение SSL, маршрутизация и балансировка нагрузки.', '2025-08-20 17:20:58'),
                                                                 (4, 'CI/CD в GitLab', 'Пошаговая настройка пайплайнов, автоматический деплой и лучшие практики для проектов на PHP и Node.js.', '2025-08-20 17:20:58'),
                                                                 (5, 'Мониторинг через Grafana', 'Как подключить Prometheus к Grafana, визуализировать метрики и настроить алерты для продакшен окружения.', '2025-08-20 17:20:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы cms.user: ~18 rows (приблизительно)
INSERT IGNORE INTO `user` (`id`, `email`, `password`, `role`, `hash`, `data_reg`) VALUES
                                                                                      (1, 'admin@cms.loc', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '81dc9bdb52d04dc20036dbd8313ed055', '2025-08-17 14:52:15');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
