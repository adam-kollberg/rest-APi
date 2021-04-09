-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 09 apr 2021 kl 10:05
-- Serverversion: 10.4.17-MariaDB
-- PHP-version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cart_session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `cart_session_id`) VALUES
(86, 1, 1, 3),
(87, 2, 2, 5),
(88, 1, 3, 5),
(89, 1, 3, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `Orders`
--

INSERT INTO `Orders` (`id`, `session_id`, `total_price`) VALUES
(1, 3, 400),
(2, 5, 1200),
(3, 5, 1200),
(4, 5, 1200);

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `created`) VALUES
(1, 'hej', 'hejdååj', 400, '2021-03-19 09:43:20'),
(2, 'Dress', 'Nice dress for your store', 799, '2021-03-19 09:43:54'),
(4, 'dress', 'hello', 599, '2021-03-22 14:47:06'),
(5, 'productTitle', 'fin produkt', 500, '2021-03-29 12:36:36');

-- --------------------------------------------------------

--
-- Tabellstruktur `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `last_used` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `token`, `last_used`) VALUES
(1, 8, 'ffc09ae414ad217fd75b1517b99997148hello', 1616749419),
(2, 8, '6714b69c1627238674f4a83b7ea5a68f8hello', 1617012029),
(3, 8, 'b20685fb7100bfea91929689110bbe688hello', 1617016436),
(4, 8, '5b8f5d5557c1f4293f415e60ff8cc9f38hello', 1617022667),
(5, 8, '80cfc2c32072243b3f4286761014b2328hello', 1617176937);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(6, 'kalle123', 'kalle123@otlook.com=', 'superadmin', 'user'),
(7, 'adamski', 'larsa@web-it.nu', '121231', 'superadmin'),
(8, 'hello', 'kallekarlsson@web-it.nu', 'kollis', 'admin'),
(9, 'hello2', 'kallekula@web-it.nu', 'kollis', 'admin');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT för tabell `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
