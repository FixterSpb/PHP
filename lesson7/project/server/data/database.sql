-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 29 2020 г., 15:50
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(10, 'dry6tyhr6dtxfh'),
(6, 'fgbvrhf'),
(7, 'fgbvrhfh'),
(8, 'fgbvrhfh8'),
(9, 'fuyjytujydrj'),
(11, 'thfyhcrt'),
(1, 'Евгений'),
(2, 'Роман'),
(5, 'чвркерикепи');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `id_cart` int NOT NULL,
  `id_product` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `id_cart`, `id_product`, `qty`) VALUES
(57, 3, 3, 12),
(59, 3, 6, 11),
(60, 3, 1, 3),
(61, 3, 2, 3),
(62, 3, 4, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `hash_cart` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `hash_cart`) VALUES
(1, '43da79cbbe2156b996af5da03f8b92b01064f440489099a542148ea578b42268'),
(3, '6240b0e6b8e9c569ea8f4ec0f4c683b74d20723f651b69bf00f103fa20ce639d'),
(2, 'ac6fdada77b46a2fa4f299b526ea0f8e52787c5001ecad40a16b62d0f8ca8e26');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `desc` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `price`, `desc`, `status`) VALUES
(1, 'Ноутбук HP Chromebook x360 14b-ca0000ur серебристый', 'php4AA2.jpg', 26999, 'Встречайте универсальный ноутбук Chromebook, который обеспечивает необходимые производительность и развлекательные функции благодаря лучшим приложениям Android и браузеру Chrome, а также аккумуляторной батарее с длительным временем работы. Сенсорный экран высокой четкости с узкими рамками и универсальная петля с углом разворота на 360°.', 'active'),
(2, 'Ноутбук Acer Aspire 3 A315-22-48FX черный', 'php689B.jpg', 28999, 'Это не просто ноутбук. Это ваш партнер по работе, который будет помогать вам в течение всего дня, куда бы вы ни отправились. Стильный корпус, выполненный из высокопрочного материала, никого не оставит равнодушным. Данный ноутбук - вариант для тех, кто привык окружить себя качественными и практичными устройствами.', 'active'),
(3, 'Ноутбук HP Laptop 15-dw1034ur серый', 'php96A1.jpg', 33999, 'Описание 15.6&quot; Ноутбук HP Laptop 15-dw1034ur серый\r\nНоутбук HP Laptop 15-dw1034ur представлен в классическом сером корпусе с диагональю 15.6&quot; и обладает удобным дизайном. Тонкий корпус и большой экран обеспечивают комфортное выполнение любых задач на этом устройстве. В основе ноутбука лежит система DOS, которая позволяет оценить все возможности устройства уже при первом его включении. Модуль Wi-Fi обеспечивает мгновенное подключение к беспроводным сетям и плавный веб-серфинг без задержек. Графическая подсистема аппарата представлена графическим адаптером Intel UHD, который отвечает за отображение графики на экране.', 'active'),
(4, 'Ультрабук Acer Spin 1 SP111-34N-P6VE серебристый', 'phpC0A0.jpg', 34999, '11.6&quot; Ультрабук Acer Spin 1 SP111-34N-P6VE в серебристом цвете – максимально компактное решение. Формат 11.6 дюйма все еще пользуется спросом среди покупателей. Тонкий корпус с толщиной 14.1 мм в сочетании с весом 1.25 кг позволяют постоянно носить устройство с собой. Его можно взять в поездку, положить даже в небольшой рюкзачок.\r\nВ ультрабук Acer Spin 1 SP111-34N-P6VE встроена литий-полимерная батарея с емкостью 4670 мА·ч. Процессор Intel Pentium Silver N5000 потребляет немного энергии и прекрасно справляется с вычислениями. Достигается высокая автономность – до 12 часов от одного заряда. Блок питания для ультрабука компактный, внешне он похож на сетевой адаптер для смартфона и несильно превышает его по габаритам.', 'active'),
(5, 'Ультрабук Acer Swift 1 SF114-32-P5YT серебристый', 'phpEDAD.jpg', 34999, 'Работайте продуктивно в течение всего дня с мощным тонким ноутбуком, который удобно брать с собой куда угодно.', 'active'),
(6, 'Ноутбук Lenovo IdeaPad 3 17ADA05 серый', 'php1D0B.jpg', 34999, 'помощника для работы и мультимедийных развлечений. В нем установлен 17.3-дюймовый экран TN с разрешающей способностью 1600x900 пикселей, на котором отображается четкая картинка с яркими и красочными цветами без бликов. Созданный на базе процессора AMD Athlon Silver 3050U и 4 ГБ системной памяти, портативный компьютер легко справляется с нетребовательными повседневными задачами.', 'active'),
(7, 'Ноутбук Acer Aspire 3 A315-23-R3RS черный', 'php637B.jpg', 35999, 'Этот ноутбук создан для тех, кто хочет получить надежное и производительное компьютерное устройство с наиболее востребованным функционалом. Данная модель полностью удовлетворяет данные требования. Надежный накопитель предоставляет вам возможности для долговременного хранения необходимой виртуальной информации. Устройство оборудовано веб-камерой и микрофоном, благодаря которым вы сможете организовывать видеоконференции с партнерами по бизнесу и коллегами по работе.', 'active'),
(8, 'Ноутбук Acer Aspire 3 A315-34-P1QV черный', 'php2076.jpg', 35999, 'востребованным функционалом. Данная модель полностью удовлетворяет данные требования. Надежный накопитель предоставляет вам возможности для долговременного хранения необходимой виртуальной информации. Устройство оборудовано веб-камерой и микрофоном, благодаря которым вы сможете организовывать видеоконференции с партнерами по бизнесу и коллегами по работе.', 'active'),
(9, 'Ноутбук Lenovo Ideapad S145-15AST черный', 'phpE474.jpg', 35999, 'Ноутбук Lenovo Ideapad S145-15AST в классическом черном корпусе из пластика обладает универсальным функционалом. Последний отвечает за возможность работы и отдыха за компьютером. TN+film-экран транслирует изображение с разрешением до 1920x1080 пикселей, что делает «картинку» соответствующей формату Full HD. Это значит, что она будет четкой и детализированной. Частота обновления экрана составляет 60 Гц. Дополняется изображение безупречным звучанием, транслируемым акустической системой Dolby Audio.', 'active'),
(10, 'Ноутбук HP Laptop 17-by2026ur черный', 'phpE7.jpg', 35999, 'Благодаря процессору Intel и графическому адаптеру этот ноутбук предоставляет возможности для просмотра веб-страниц, трансляции видео и выполнения множества других задач. Всесторонняя проверка качества гарантирует длительный срок службы устройства.', 'active'),
(11, 'пвач п', 'php1FB7.jpg', 3423, 'певкерантсеотмпэЭ\'&quot;', 'active');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `id_product` int NOT NULL,
  `id_auth` int NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `id_product`, `id_auth`, `message`) VALUES
(1, 1, 8, 'vgbdfuhvnxf'),
(2, 1, 1, 'Привет, мир'),
(3, 8, 1, 'Новый отзыв'),
(4, 16, 1, 'vgbdfuhvnxf'),
(5, 16, 1, 'vgbdfuhvnxf'),
(6, 16, 1, 'vgbdfuhvnxf'),
(7, 16, 1, 'vgbdfuhvnxf'),
(8, 16, 1, 'vgbdfuhvnxf'),
(9, 16, 1, 'vgbdfuhvnxf'),
(10, 16, 1, 'vgbdfuhvnxf'),
(11, 16, 1, 'vgbdfuhvnxf'),
(12, 16, 1, 'vgbdfuhvnxf'),
(13, 8, 1, 'Еще один отзыв'),
(14, 10, 9, 'tfjntynv h'),
(15, 10, 10, 'htrdhnct rxtrfgcnb '),
(16, 5, 1, 'gzsrefgvz'),
(17, 2, 11, 'dhrthtrdhbcf');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash_cart` (`hash_cart`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
