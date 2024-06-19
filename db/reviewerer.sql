-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2024 at 09:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reviewerer`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(64) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
('0', 'Mydło \"Dove\"'),
('1', 'Spółdzielnia Mieszkaniowa \"Budex\"'),
('2', 'Restauracja \"Bistro u Grubego\"'),
('3', 'Żabka Żyrardów'),
('4', 'Robot Kuchenny \"Kucharz 3000 Deluxe\"');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `user_id` varchar(64) NOT NULL,
  `product_id` varchar(64) NOT NULL,
  `id` varchar(64) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(128) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `score` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`user_id`, `product_id`, `id`, `date`, `title`, `description`, `score`) VALUES
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', '0', '3635bfdc-a772-4f72-98f3-82f8aa7cf572', '2024-06-19', 'Czyściutkie!', 'Polecam mydło, najlepsze na rynku, kiedyś miałem takie szare ale to jest dużo lepsze!', 80),
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', '3', '6ccfede4-471d-4188-99a2-60d194a085e6', '2024-06-16', 'Polecam', 'fajnie', 33),
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', '4', 'a46566e7-e869-47ee-8e83-aa38f58e64b4', '2024-06-19', 'super robot', 'sam gotuje, sprząta i myje, w kuchni nie ma już co robić tylko jeść, jeść i jeść!!!', 100),
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', '1', 'beedeccd-b878-4fa1-a0a8-471972975d5f', '2024-06-19', 'a mi się podoba', 'dali dobrą cenę i wszystko się zgadza, mieszkanie jak tralala', 100),
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', '2', 'c6e7edc1-56a3-4066-9906-f5052c8c0e4c', '2024-06-19', 'Baaardzo wartościowe miejsce', 'dobre ceny 👍', 100),
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', '1', 'fae7bfb3-11c1-4ddb-b11f-922c4f2b960c', '2024-06-19', 'scam', 'oszukali mnie na mieszkanie, wszystko opłacone a nie wydali kluczy i kontakt się urwał, unikać!!!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(8) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
('44b6b2af-1957-4f9f-8fd9-643e2503e460', 'aha', 'aaaa@aa.io', '123123123', 'user'),
('6a3ac85c-e5ba-4dd8-b18f-1780bd250f56', 'admin', 'admin@admin.io', '$2y$10$3KpLHiS.3OB4y4fHhFmCiOSjSHYqMJsPh73mdsO65/jFkV8CAdp/G', 'admin'),
('e93ffb84-ef54-404f-959c-efd1121ce48f', 'test', 'testhash@test.ai', '$2y$10$M5NYB/HA0TPKAtpSdYmbLuAEE3nMpUgdWQcADXIhnoh0.OERnIEVC', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
