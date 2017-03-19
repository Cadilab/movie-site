-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2017 at 11:52 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(78) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Akcioni'),
(2, 'Animirani'),
(3, 'Avantura'),
(4, 'Biografija'),
(5, 'Komedija'),
(6, 'Krimi'),
(7, 'Dokumentarni'),
(8, 'Drama'),
(9, 'Porodicni'),
(10, 'Fantazija'),
(11, 'Horor'),
(12, 'Mjuzikl'),
(13, 'Misterija'),
(14, 'Romantika'),
(15, 'Sci-fi'),
(16, 'Sportski'),
(17, 'Triler'),
(18, 'Ratni'),
(19, 'Vestern');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `hash_id` int(11) NOT NULL,
  `user` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `hash_id`, `user`, `comment`) VALUES
(1, 1489841050, 'Cadilab', 'onako nije los film ali gledao sam i boljih'),
(2, 1489850890, 'cadilab', 'fafsaf'),
(3, 1489850890, 'cadilab', 'not bad for a comedy :D'),
(4, 1489785148, 'cadilab', 'not bad\r\n'),
(5, 1489863090, 'cadilab', 'first comment');

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `episode_hash` int(11) NOT NULL,
  `episode_name` text NOT NULL,
  `season` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `episode_description` text NOT NULL,
  `embed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `serie_id`, `episode_hash`, `episode_name`, `season`, `episode`, `episode_description`, `embed`) VALUES
(1, 1489869879, 0, 'Test', 1, 1, 'fsafasfas', 'openload.com/embed//test'),
(2, 1489869879, 0, 'dfafasf', 1, 2, 'dsadasdas', 'openload.com/embed//test');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `categories` text NOT NULL,
  `hash` varchar(128) NOT NULL,
  `thumb_location` text NOT NULL,
  `actors` text NOT NULL,
  `embed_code` text NOT NULL,
  `year` int(11) NOT NULL,
  `rating` varchar(24) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `categories`, `hash`, `thumb_location`, `actors`, `embed_code`, `year`, `rating`, `views`) VALUES
(1, 'fdf', 'fsdf', 'Akcioni Komedija Drama Fantazija', '1489863090', 'thumbnail_photos/1489863090_movie.jpg', 'frf', 'https://openload.co/embed/Tjfh-Ic2ZVE/', 2015, '7.4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `movie_categories`
--

CREATE TABLE `movie_categories` (
  `id` int(11) NOT NULL,
  `movie_hash` int(11) NOT NULL,
  `category` varchar(76) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_categories`
--

INSERT INTO `movie_categories` (`id`, `movie_hash`, `category`) VALUES
(1, 1489863090, 'Akcioni'),
(2, 1489863090, 'Komedija'),
(3, 1489863090, 'Drama'),
(4, 1489863090, 'Fantazija');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `hash` int(11) NOT NULL,
  `name` text NOT NULL,
  `thumb_location` text NOT NULL,
  `description` text NOT NULL,
  `year` int(11) NOT NULL,
  `rating` varchar(24) NOT NULL,
  `categories` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `hash`, `name`, `thumb_location`, `description`, `year`, `rating`, `categories`) VALUES
(1, 1489869879, 'gfd', 'thumbnail_photos/1489869879_show.jpg', 'gd', 2017, '5.3', 'Akcioni Drama Mjuzikl');

-- --------------------------------------------------------

--
-- Table structure for table `show_categories`
--

CREATE TABLE `show_categories` (
  `id` int(11) NOT NULL,
  `serie_hash` int(11) NOT NULL,
  `category` varchar(76) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `show_categories`
--

INSERT INTO `show_categories` (`id`, `serie_hash`, `category`) VALUES
(1, 1489869879, 'Akcioni'),
(2, 1489869879, 'Drama'),
(3, 1489869879, 'Mjuzikl');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(75) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `username`, `email`) VALUES
(1, '$2y$10$xdDyY3fsQTDB9a6I3GfbN.N8jZ3Sv4fbZfbeAusZi8maSr2u64K1e', 'cadilab', 'cadilab97@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_categories`
--
ALTER TABLE `movie_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `show_categories`
--
ALTER TABLE `show_categories`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `movie_categories`
--
ALTER TABLE `movie_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `show_categories`
--
ALTER TABLE `show_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
