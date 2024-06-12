-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 09:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animal_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `author` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `about`, `content`, `thumbnail`, `category`, `archive`, `created_at`, `author`) VALUES
(33, 'Panda', 'Novo otkriće', 'Otkrili smo novu vrstu', 'Slike/pandaa.jpg', 'wildlife', 0, '2024-06-12', 'Antonia Kasalo'),
(34, 'Opasne stvari za mace', 'Želite li znati što je opasno za vašu macu', 'Ove tri stvari su naj opasnije za macu', 'Slike/cat2.jpg', 'house_pets', 0, '2024-06-12', 'Antonia Kasalo'),
(35, 'Žirafa', 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'Etiam venenatis scelerisque elit a faucibus. Nulla vel eros vitae sapien tempor facilisis. Aenean scelerisque dictum odio quis tempor. Nam ut tellus eu lacus suscipit varius ut et sem. Vestibulum vel dapibus est. Donec id pulvinar sem, a varius est. Proin semper erat velit, vel varius magna dapibus euismod. Aliquam et orci pretium, faucibus augue vitae, lacinia mi.\\r\\n\\r\\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut porttitor dignissim tellus, efficitur placerat ante porttitor eu. Vestibulum euismod lectus nec nisl viverra placerat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque ut pretium sem, sed aliquet enim. Aliquam cursus urna ut consequat consectetur. Nullam convallis, lectus eget maximus lobortis, ex est placerat tortor, a faucibus nibh magna vel dui. Morbi a dolor sed turpis ullamcorper tempor et ut dolor. Nullam sed suscipit arcu.', 'Slike/giraffe1.jpg', 'wildlife', 0, '2024-06-12', 'Antonia Kasalo'),
(36, 'Losovi', 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'Etiam venenatis scelerisque elit a faucibus. Nulla vel eros vitae sapien tempor facilisis. Aenean scelerisque dictum odio quis tempor. Nam ut tellus eu lacus suscipit varius ut et sem. Vestibulum vel dapibus est. Donec id pulvinar sem, a varius est. Proin semper erat velit, vel varius magna dapibus euismod. Aliquam et orci pretium, faucibus augue vitae, lacinia mi.\\r\\n\\r\\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut porttitor dignissim tellus, efficitur placerat ante porttitor eu. Vestibulum euismod lectus nec nisl viverra placerat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque ut pretium sem, sed aliquet enim. Aliquam cursus urna ut consequat consectetur. Nullam convallis, lectus eget maximus lobortis, ex est placerat tortor, a faucibus nibh magna vel dui. Morbi a dolor sed turpis ullamcorper tempor et ut dolor. Nullam sed suscipit arcu.', 'Slike/moose.jpg', 'wildlife', 0, '2024-06-12', 'Antonia Kasalo'),
(38, 'Zecevi', 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'Etiam venenatis scelerisque elit a faucibus. Nulla vel eros vitae sapien tempor facilisis. Aenean scelerisque dictum odio quis tempor. Nam ut tellus eu lacus suscipit varius ut et sem. Vestibulum vel dapibus est. Donec id pulvinar sem, a varius est. Proin semper erat velit, vel varius magna dapibus euismod. Aliquam et orci pretium, faucibus augue vitae, lacinia mi.\\r\\n\\r\\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut porttitor dignissim tellus, efficitur placerat ante porttitor eu. Vestibulum euismod lectus nec nisl viverra placerat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque ut pretium sem, sed aliquet enim. Aliquam cursus urna ut consequat consectetur. Nullam convallis, lectus eget maximus lobortis, ex est placerat tortor, a faucibus nibh magna vel dui. Morbi a dolor sed turpis ullamcorper tempor et ut dolor. Nullam sed suscipit arcu.', 'Slike/bunny2.jpg', 'house_pets', 0, '2024-06-12', 'Antonia Kasalo'),
(39, 'Mala maca', 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'Etiam venenatis scelerisque elit a faucibus. Nulla vel eros vitae sapien tempor facilisis. Aenean scelerisque dictum odio quis tempor. Nam ut tellus eu lacus suscipit varius ut et sem. Vestibulum vel dapibus est. Donec id pulvinar sem, a varius est. Proin semper erat velit, vel varius magna dapibus euismod. Aliquam et orci pretium, faucibus augue vitae, lacinia mi.\\r\\n\\r\\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut porttitor dignissim tellus, efficitur placerat ante porttitor eu. Vestibulum euismod lectus nec nisl viverra placerat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque ut pretium sem, sed aliquet enim. Aliquam cursus urna ut consequat consectetur. Nullam convallis, lectus eget maximus lobortis, ex est placerat tortor, a faucibus nibh magna vel dui. Morbi a dolor sed turpis ullamcorper tempor et ut dolor. Nullam sed suscipit arcu.', 'Slike/cat1.jpg', 'house_pets', 0, '2024-06-12', 'Antonia Kasalo'),
(40, 'MAcka', 'Opis koji je 10 znakova', 'Veci opis', 'Slike/cat1.jpg', 'house_pets', 0, '2024-06-12', 'Admin'),
(41, 'Ime od 5 znaka', 'Opis od 10 znakova! ovo je novo', 'Veci opis', 'Slike/white-bengal-tiger-nature.jpg', 'wildlife', 0, '2024-06-12', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('user','reporter','admin') NOT NULL DEFAULT 'user',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `is_verified`, `verification_code`) VALUES
(57, 'Antonia Kasalo', '$2y$10$Bj2OrMRxFjfBBnqLQNxi8ura/beTsgStEebLw8o2YS.2vBGCa7Wpa', 'antonia.kasalo@gmail.com', 'admin', 1, '274647'),
(58, 'NormalUser', '$2y$10$Yx0G5G/0NxxDlsQiMlaGh.afuUOufL1tqfepkcTmdZaKVUr3aR50W', 'antonia.kasalo@gmail.com', 'user', 1, ''),
(59, 'Admin', '$2y$10$XC9d0y4PkFbmawxfVSO31OhaB.n.ppmGRZOyMQG.6eMufk/Wl4aPS', 'antonia.kasalo@gmail.com', 'admin', 1, '894662'),
(60, 'Reporter', '$2y$10$14o52MJ5RuAgwIWw0Goweu2tVoIl7Pdwsl9xfh0NMTdCC7kMkL3aK', 'antonia.kasalo@gmail.com', 'reporter', 1, '162056');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
