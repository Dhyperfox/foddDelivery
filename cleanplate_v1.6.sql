-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Jún 10. 14:29
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `food`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`) VALUES
(1, 'Pizzas', 'assets/img/C-Pizza.png'),
(2, 'Burgers', 'assets/img/C-Burger.png'),
(3, 'Soups', 'assets/img/C-Soup.png'),
(4, 'Meats', 'assets/img/C-Meat.png'),
(5, 'Desserts', 'assets/img/C-Dessert.png'),
(6, 'Drinks', 'assets/img/C-Drink.png');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foods`
--

CREATE TABLE `foods` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `food_desc` longtext NOT NULL,
  `portion` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `foods`
--

INSERT INTO `foods` (`food_id`, `food_name`, `category_id`, `food_desc`, `portion`, `price`, `img`) VALUES
(1, 'Test Pizza', 1, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 500, 950, 'assets/img/cat/pizzas/pizza-1.png'),
(4, 'Test Pizza 2', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam exercitationem illum laborum nam numquam obcaecati praesentium quaerat quibusdam quo reiciendis? Ad alias aliquam aliquid aperiam asperiores assumenda at consectetur dignissimos ducimus enim esse fugit harum id ipsum labore minima molestias nisi optio porro, quaerat quis recusandae reprehenderit sapiente sed sequi temporibus veniam! Atque eaque laudantium quaerat sequi veniam! A assumenda at aut blanditiis commodi corporis, cum debitis deserunt distinctio dolore ducimus eaque et ex excepturi id impedit incidunt itaque laboriosam natus perferendis, perspiciatis possimus quam quasi quibusdam quidem quo veniam vero? Eum exercitationem quas sapiente. Ab delectus ea veniam. Doloribus harum modi officiis praesentium quibusdam ratione sint tempora. Accusamus accusantium, aliquam aliquid assumenda commodi culpa cumque cupiditate dignissimos dolorem doloribus eligendi esse harum hic ipsam laboriosam, maiores maxime minima minus nulla pariatur perspiciatis placeat porro possimus quaerat, quibusdam repellat reprehenderit tempore vel velit voluptatem! Alias asperiores obcaecati vero? Aliquid assumenda cumque earum, eveniet explicabo illo nihil officia quasi ratione rem, sint sunt ullam voluptate. Consectetur doloremque et magnam non nostrum odit sed tempore totam veritatis. Ab debitis dignissimos dolor ducimus ea fugit nam quaerat sequi ullam veniam. Dignissimos ea eligendi enim eos ipsum laudantium non provident ratione, suscipit tenetur vitae.\r\n', 320, 1200, 'assets/img/cat/pizzas/pizza-1.png'),
(5, 'Test Pizza 3', 1, 'Lorem ipsum...', 560, 1230, 'assets/img/cat/pizzas/pizza-1.png'),
(7, 'Autumn Soup', 3, 'Simple autumn soup which tastes great.', 200, 350, 'assets/img/cat/soups/autumn-soup.png');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderdetail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `portion` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `price` int(5) NOT NULL,
  `date` date NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `permissions`
--

CREATE TABLE `permissions` (
  `perm_mod` varchar(5) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `perm_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `permissions`
--

INSERT INTO `permissions` (`perm_mod`, `perm_id`, `perm_desc`) VALUES
('USR', 1, 'Access users'),
('USR', 2, 'Create new users'),
('USR', 3, 'Update users'),
('USR', 4, 'Delete users');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `stars` tinyint(1) NOT NULL,
  `r_date` date NOT NULL,
  `rating_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `rating`
--

INSERT INTO `rating` (`rating_id`, `user_id`, `food_id`, `stars`, `r_date`, `rating_desc`) VALUES
(1, 22, 1, 5, '2021-06-02', 'Nagyon jó ez a pizza!'),
(2, 27, 1, 3, '2021-06-03', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(3, 'Courier'),
(4, 'Guest'),
(2, 'Registered user');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(11) NOT NULL,
  `perm_mod` varchar(5) NOT NULL,
  `perm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `perm_mod`, `perm_id`) VALUES
(1, 'USR', 1),
(1, 'USR', 2),
(1, 'USR', 3),
(1, 'USR', 4),
(2, 'USR', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(12) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city` varchar(15) NOT NULL,
  `zip` int(6) NOT NULL,
  `passwd` varchar(80) NOT NULL,
  `hash` varchar(80) NOT NULL,
  `validated` tinyint(1) DEFAULT 30,
  `date` date NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `address`, `city`, `zip`, `passwd`, `hash`, `validated`, `date`, `role_id`) VALUES
(22, '16219115', 'root@localhost.com', 1254595213, 'Marijina 14, Subotica, Serbia', 'Subotica', 24000, '$2y$10$0GQ.xw3l7si6rOIMyAOE4.fAlGUwBRk/WG/OwUUpGys4BaaQk0Sq6', '$2y$10$uRYns9JAdpvB0g4sDyGApesDZhIaiNhWDMHZZ2XV.dBvXGb9/Im7S', 1, '2021-05-03', 1),
(23, 'hyperfoxd', 'hyperfox12345@gmail.com', 1254595213, 'Marijina 14, Subotica, Serbia', 'Subotica', 24000, '$2y$10$MFMowes4QwkOYmO4fFXEn.bJQvlIpzXIJwiOmo/uLC.c83sYSUPTC', '$2y$10$kf6tMfs0qiuhigBeMVEVheoL7g4YsORIusRYxLf5JXy1iVfc6596i', 1, '0000-00-00', 2),
(25, 'ABC123', 'abc123@gmail.com', 2147483647, 'Berta István 25', 'Zenta', 24401, '$2y$10$dqX5sS7g0aSV2Cp4iNkUIuDj/gOqsFANsmPNPtNEMcKHjKUj0vj.G', '$2y$10$l5fr8CcklAMSVWMrKoW3Bef/1L.JsZGGiFGm7xCzDOMA1JgLbXmjy', 0, '0000-00-00', 4),
(26, 'pista', 'pista@gmail.com', 2147483647, 'Apád füle 69', 'Nincs', 55500, '$2y$10$ER80jgxiNq0ltAUl69.3kud6BWGk2RKvq42V62ZIi90RHkdjdl7sa', '$2y$10$cl36SaaCf98HO2ij.WfBkelxcXTkM6CX3G7MyYLGy854ybzRQCSSK', 0, '0000-00-00', 4),
(27, 'XenoNoise', 'knorbert95@gmail.com', 28761113, 'Berta István 25', 'Zenta', 24401, '$2y$10$sugMAAfY.t.zmmqhjDt4GOOyt9hFbmO/J..D6jSBmoOqADNAuduLu', '$2y$10$KHO2O.s2dIbBsaUVnSzn8eyiSo9b/WhB8DE369PMg0msu/.kSGx4S', 1, '0000-00-00', 2),
(29, 'TestUser', 'taroc23416@isecv.com', 28761113, 'Berta István 25', 'Zenta', 24401, '$2y$10$0XrP6IyDLnFnEdqjsgvr8.ig31kYKj/BFHKAB.UkALIEH/A0HoL8m', '$2y$10$cZOVjyuqdBseiSTEB96sfOouQnEVeND1rcRVwk1MkEaRbkP8XjRci', 0, '0000-00-00', 4);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- A tábla indexei `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- A tábla indexei `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderdetail_id`),
  ADD KEY `order_id` (`order_id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_mod`,`perm_id`);

--
-- A tábla indexei `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- A tábla indexei `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- A tábla indexei `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`perm_mod`,`perm_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `foods`
--
ALTER TABLE `foods`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`food_id`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`food_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
