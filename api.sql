-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 31 2021 г., 17:04
-- Версия сервера: 8.0.26-0ubuntu0.20.04.2
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `host`
--

CREATE TABLE `host` (
  `id` int NOT NULL COMMENT 'id',
  `mac` varchar(17) COLLATE utf8_bin NOT NULL COMMENT 'mac адрес',
  `hostname` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Сетевое имя',
  `ip` varchar(15) COLLATE utf8_bin NOT NULL COMMENT 'IP адрес',
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата обновления',
  `dynamic` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Динамический?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Таблица устройств';

--
-- Дамп данных таблицы `host`
--

INSERT INTO `host` (`id`, `mac`, `hostname`, `ip`, `update_date`, `dynamic`) VALUES
(1, '48:8F:5A:CC:1B:76', 'cAP_Office_01_Stolovka', '192.168.60.254', '2021-08-30 11:21:17', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ModelPrinters`
--

CREATE TABLE `ModelPrinters` (
  `id` int NOT NULL,
  `model` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Модель принтера',
  `snmp` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Строка поиска SNNP',
  `trim` int NOT NULL COMMENT 'Обрезка',
  `search` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Поиск по HOST'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `ModelPrinters`
--

INSERT INTO `ModelPrinters` (`id`, `model`, `snmp`, `trim`, `search`) VALUES
(1, 'Brother', '1.3.6.1.2.1.43.10.2.1.4.1.1', 43, 'BRN%'),
(2, 'HP', '1.3.6.1.2.1.43.10.2.1.4.1.1', 43, 'NPI3%'),
(3, 'Phaser', '.1.3.6.1.4.1.253.8.53.13.2.1.6.1.20.1', 50, 'XRX%'),
(4, 'Ricoh', '.1.3.6.1.4.1.367.3.2.1.2.19.1.0', 44, 'RNP%'),
(5, 'Konica Minolta', '1.3.6.1.4.1.18334.1.1.1.5.7.2.1.1.0', 49, 'KMBT%'),
(6, 'Kyocera', '1.3.6.1.2.1.43.11.1.1.7', 50, 'KM%');

-- --------------------------------------------------------

--
-- Структура таблицы `StatsPrinters`
--

CREATE TABLE `StatsPrinters` (
  `id` int NOT NULL,
  `counts` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Пробег',
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата обновления',
  `hostname` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Hostname'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `StatsPrinters`
--

INSERT INTO `StatsPrinters` (`id`, `counts`, `update_date`, `hostname`) VALUES
(1, '0', '2021-08-31 17:00:02', 'BRN3C2AF45B78C1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mac` (`mac`),
  ADD KEY `mac_2` (`mac`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `ModelPrinters`
--
ALTER TABLE `ModelPrinters`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `StatsPrinters`
--
ALTER TABLE `StatsPrinters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `host`
--
ALTER TABLE `host`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT для таблицы `ModelPrinters`
--
ALTER TABLE `ModelPrinters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `StatsPrinters`
--
ALTER TABLE `StatsPrinters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
