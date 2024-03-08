-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 04:30 AM
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
-- Database: `projectci`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `user_id`) VALUES
(1, 'Project 1 mastet edited', 'Desc project 1 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam quae eligendi cupiditate quibusdam placeat iusto quas corporis. Voluptatibus quidem voluptas odio laborum quos et ea, quae quia, libero explicabo a.', '2024-02-01', 1),
(2, 'Project 2 master', 'Desc project 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempora excepturi sint illo quaerat, cum accusantium autem odio eos architecto laborum illum consequatur eum aliquid impedit quas nihil reiciendis quidem?', '2024-03-02', 9),
(15, 'nuevo proyecto de Juan', 'asdasdasdasdasdasd', '2024-03-10', 10),
(16, 'Proyecto de Maria', 'lorem123ultra editadoultra editadoultra editado', '2024-03-10', 4),
(20, 'Project 2 master edit', 'qasdasda', '2024-02-14', 3),
(24, 'last project', 'last project \r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis necessitatibus placeat modi accusantium, fugit consectetur molestiae? Atque dolorum laboriosam deserunt? Error maxime aliquam possimus delectus voluptates minima facilis animi ea.', '2024-05-01', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(100) NOT NULL,
  `project_id` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `name`, `description`, `due_date`, `status`) VALUES
(1, 1, 'task 1 from project 1', 'Desc task 1 p 1 Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, veniam pariatur incidunt architecto maiores, eos dolorem iure optio vitae vel voluptatem, reprehenderit tenetur asperiores iste magni officiis adipisci voluptates perferendis?', '2024-03-08', 'in_progress'),
(3, 2, 'task 1 from project 2', 'Desc task 1 p 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur deserunt assumenda quod quidem quibusdam maiores laborum accusamus ducimus placeat aut! Veniam ullam eum magnam dolore laudantium assumenda accusantium hic vitae?', '2024-03-20', 'pending'),
(4, 2, 'task 2 from project 2 ahora mola', 'Desc task 2 p 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quisquam quis praesentium odit aperiam doloribus fugiat tempore dicta error. Blanditiis architecto eum minima, nam aspernatur inventore ipsam illum pariatur earum?', '2024-04-04', 'completed'),
(12, 1, 'task 2', 'EDITANDO AHORA BIENEDITANDO AHORA BIENEDITANDO AHORA BIEN', '2024-01-01', 'completed'),
(15, 1, 'Hola nueva tarea editada', 'Hola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tareaHola nueva tarea', '2024-03-21', 'pending'),
(18, 16, 'ultima tarea de maria editada por Admin', 'maria tienes que mejorar', '2024-03-07', 'completed'),
(22, 24, 'last Task', 'last Task \r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam explicabo error provident reiciendis rerum voluptatum sint ullam, autem molestiae! Molestias nam quia repellendus exercitationem vitae illum doloremque iste eius eveniet.', '2024-05-08', 'in_progress'),
(24, 20, 'test', 'test', '2024-03-06', 'in_progress');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('administrator','regular_user') DEFAULT 'regular_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Daniel', 'ddaprr@gmail.com', '$2y$04$ovRK9euMX82/ztVaPX2VsOqfx3tn2OsRjCWW82MFtmW6XUrZSKZb.', 'regular_user'),
(3, 'Daniel', 'daniel@gmail.com', '$2y$04$vX3LDvN15GGCHhdlj7mEweGwCZIivmrVSLO0uXgx1NF79E0qQPRo.', 'regular_user'),
(4, 'Maria', 'maria@gmail.com', '$2y$04$palRJcYg7ePPi/sPopyyAetCY3xyz8I/hTEI508l87HU4Yi9merXm', 'regular_user'),
(5, 'Alejandro', 'ale@gmail.com', '$2y$04$rX6ed1BuJp3g6K6PNLPtBeWn76O/jlYR03TP2WNCII4/mvqZ1oiFu', 'regular_user'),
(6, 'hola', 'hola@hola.com', '$2y$04$V62vX0r56JdQCzC1oCjVQu.AMqFma90fPvzJoUiUbFAzKaVY75vf.', 'regular_user'),
(9, 'Administrator', 'admin@admin.com', '$2y$04$aRaUYk9bWMIe1F0aNnef.us1R/KExLrrow3LSEqddjUpf33yNQuJO', 'administrator'),
(10, 'Juan', 'juan@juan.com', '$2y$04$B1OukgE7gbbh1p3YpviYP.SWe0bZ9VYTup4SeqdXbc3tpoCOk.kXe', 'regular_user'),
(13, 'admin', 'admin@gmail.com', '$2y$04$KkM11tKfRti9hS2TUrWuBu/I/hjexblHVGciKzNCrrcFV74cZ.LjC', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
