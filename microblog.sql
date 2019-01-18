-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2019 at 07:44 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(2000) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `plusone` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `message`, `user`, `date`, `plusone`) VALUES
(3, 'I am testing this website\'s database. Be careful it might bug a lot.', 'Julien', '2018-10-03 13:11:36', 0),
(4, 'Normally I can edit any messages. You can correct yourself. However, do not type anything silly: I\'m watching.', 'Julien', '2018-10-03 13:11:56', 0),
(5, 'By the way, @Jean. What are you doing this evening?', 'Julien', '2018-10-03 13:12:13', 0),
(6, '@Julien Nothing much, but I\'m trying to have some rest. This job is killing me.', 'Jean', '2018-10-03 13:13:03', 0),
(14, 'I\'m thonking so hard right now', 'Thonker', '2018-11-21 14:47:38', 3),
(17, 'Adding some messages to test the new pages features.', 'Julien', '2019-01-18 09:28:05', 0),
(18, 'What\'s brown and sticky? A stick.', 'Julien', '2019-01-18 09:29:28', 0),
(19, 'There are two types of people in the world: those who finish their jokes.', 'Julien', '2019-01-18 09:30:15', 0),
(20, 'Did you know? To find this website\'s name I took a custom emoji from Discord and replaced the star icon (which wouldn\'t show on Google Chrome) from the base theme. Then, \"Thonk Social\" came in mind.', 'Julien', '2019-01-18 09:49:08', 0),
(21, 'Did you know? The \"+1\" system came from Google Plus (Google+) which is Google\'s own social network. I didn\'t want to use \"Like\" or \"Favourite\" names, nor use \"Vote\".', 'Julien', '2019-01-18 09:50:44', 0),
(22, 'That\'s the 11th message on this website.', 'Julien', '2019-01-18 10:12:28', 0),
(23, 'Another message to fill the pages more so I get more than just three pages.\r\n', 'Julien', '2019-01-18 10:12:39', 0),
(24, 'I\'m so happy the pages system work. This is so great!', 'Julien', '2019-01-18 10:12:54', 0),
(25, 'It wasn\'t quite easy to do as it involved something I never knew in SQL. Thanks to some tutorials I now have something fully functional. Hurray!', 'Julien', '2019-01-18 10:13:18', 0),
(26, 'Now to work on the +1 system which is quite broken at the moment, which is quite sad.', 'Julien', '2019-01-18 10:13:35', 1),
(27, '16th message! Yay! Four pages now!', 'Julien', '2019-01-18 10:13:48', 3),
(33, '&lt;script&gt;alert(&quot;professional h4x0r&quot;);&lt;/script&gt; doesn\\\'t work, as you can see.', 'Julien', '2019-01-18 19:56:01', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`) VALUES
(2, 'Julien', 'random@email.com', '$2y$10$Ob2RvTcDoulfcp203Po2bOC6wXX.LHZ0LmM3Q3N3uGXYqKCHvypw2'),
(3, 'Thonker', 'not@anemail.com', '$2y$10$4eJXFteAofJLSX364JgU/OywlUDi5qAt35Ngohd2rebTPrtpxJ9Iu'),
(4, 'Jean', 'jean@jean.com', '$2y$10$qfDxpKU/x1p8R/WlAVBm3Oftop754t5y0S1Uyw8uUv0AmXg1kn1Nu'),
(5, 'Michel', 'bidon@ok.com', '$2y$10$XIXdKWLCfFz5D17VRJhAquz.3gR8WFjHHNDl./5K6LWYr/7yDrlfe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
