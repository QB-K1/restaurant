-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 29 juin 2018 à 13:36
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `User_LastName` varchar(400) NOT NULL,
  `BookingDate` date NOT NULL,
  `BookingTime` time NOT NULL,
  `NumberOfSeats` int(11) NOT NULL,
  `CreationTimeStamp` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`Id`, `User_Id`, `User_LastName`, `BookingDate`, `BookingTime`, `NumberOfSeats`, `CreationTimeStamp`) VALUES
(1, 3, 'Test', '2019-03-03', '11:03:00', 2, '2018-05-24'),
(2, 3, 'Test', '2020-04-02', '10:15:00', 1, '2018-05-25');

-- --------------------------------------------------------

--
-- Structure de la table `meal`
--

DROP TABLE IF EXISTS `meal`;
CREATE TABLE IF NOT EXISTS `meal` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(400) NOT NULL,
  `Photo` varchar(40) NOT NULL,
  `QuantityInStock` int(11) NOT NULL,
  `BuyPrice` double NOT NULL,
  `SalePrice` double NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `meal`
--

INSERT INTO `meal` (`Id`, `Name`, `Description`, `Photo`, `QuantityInStock`, `BuyPrice`, `SalePrice`) VALUES
(1, 'Coca-Cola', 'Mmmm, le Coca-Cola avec 10 morceaux de sucres et tout plein de caféine !', 'coca.jpg', 72, 0.6, 3),
(2, 'Bagel Thon', 'Notre bagel est constitué d\'un pain moelleux avec des grains de sésame et du thon albacore, accompagné de feuilles de salade fraîche du jour  et d\'une sauce renversante :-)', 'bagel_thon.jpg', 18, 2.75, 5.5),
(3, 'Bacon Cheeseburger', 'Ce délicieux cheeseburger contient un steak haché viande française de 150g ainsi que d\'un buns grillé juste comme il faut, le tout accompagné de frites fraîches maison !', 'bacon_cheeseburger.jpg', 14, 6, 12.5),
(4, 'Carrot Cake', 'Le carrot cake maison ravira les plus gourmands et les puristes : tous les ingrédients sont naturels !\r\nÀ consommer sans modération', 'carrot_cake.jpg', 9, 3, 6.75),
(5, 'Donut Chocolat', 'Les donuts sont fabriqués le matin même et sont recouvert d\'une délicieuse sauce au chocolat !', 'chocolate_donut.jpg', 16, 3, 6.2),
(6, 'Dr. Pepper', 'Son goût sucré avec de l\'amande vous ravira !', 'drpepper.jpg', 53, 0.5, 2.9),
(7, 'Milkshake', 'Notre milkshake bien crémeux contient des morceaux d\'Oréos et est accompagné de crème chantilly et de smarties en guise de topping. Il éblouira vos papilles !', 'milkshake.jpg', 12, 2, 5.35),
(8, 'AngryGermanKid', 'Il a hanté vos nuits et vos jours depuis toutes ces années...', 'angry.gif', 1, 10, 1000000);

-- --------------------------------------------------------

--
-- Structure de la table `orderline`
--

DROP TABLE IF EXISTS `orderline`;
CREATE TABLE IF NOT EXISTS `orderline` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `QuantityOrdered` int(11) NOT NULL,
  `Meal_Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL,
  `PriceEach` double NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `orderline`
--

INSERT INTO `orderline` (`Id`, `QuantityOrdered`, `Meal_Id`, `Order_Id`, `PriceEach`) VALUES
(1, 12, 5, 9, 6.2),
(2, 1, 8, 9, 1000000),
(4, 18, 3, 9, 12.5),
(5, 4, 4, 9, 6.75),
(6, 12, 5, 10, 6.2),
(7, 1, 8, 10, 1000000),
(9, 18, 3, 10, 12.5),
(10, 4, 4, 10, 6.75),
(11, 78, 7, 10, 5.35),
(12, 12, 5, 11, 6.2),
(13, 1, 8, 11, 1000000),
(15, 18, 3, 11, 12.5),
(16, 4, 4, 11, 6.75),
(17, 78, 7, 11, 5.35),
(18, 12, 5, 12, 6.2),
(19, 1, 8, 12, 1000000),
(21, 18, 3, 12, 12.5),
(22, 4, 4, 12, 6.75),
(23, 78, 7, 12, 5.35),
(24, 12, 5, 13, 6.2),
(25, 1, 8, 13, 1000000),
(27, 18, 3, 13, 12.5),
(28, 4, 4, 13, 6.75),
(29, 78, 7, 13, 5.35),
(30, 12, 5, 14, 6.2),
(31, 1, 8, 14, 1000000),
(33, 18, 3, 14, 12.5),
(34, 4, 4, 14, 6.75),
(35, 78, 7, 14, 5.35),
(36, 12, 5, 15, 6.2),
(37, 1, 8, 15, 1000000),
(39, 18, 3, 15, 12.5),
(40, 4, 4, 15, 6.75),
(41, 78, 7, 15, 5.35),
(42, 12, 5, 16, 6.2),
(43, 1, 8, 16, 1000000),
(45, 18, 3, 16, 12.5),
(46, 4, 4, 16, 6.75),
(47, 78, 7, 16, 5.35),
(48, 12, 5, 17, 6.2),
(49, 1, 8, 17, 1000000),
(51, 18, 3, 17, 12.5),
(52, 4, 4, 17, 6.75),
(53, 78, 7, 17, 5.35),
(54, 12, 5, 18, 6.2),
(55, 1, 8, 18, 1000000),
(57, 18, 3, 18, 12.5),
(58, 4, 4, 18, 6.75),
(59, 78, 7, 18, 5.35),
(60, 12, 5, 19, 6.2),
(61, 1, 8, 19, 1000000),
(63, 18, 3, 19, 12.5),
(64, 4, 4, 19, 6.75),
(65, 78, 7, 19, 5.35),
(66, 12, 5, 20, 6.2),
(67, 1, 8, 20, 1000000),
(69, 18, 3, 20, 12.5),
(70, 4, 4, 20, 6.75),
(71, 78, 7, 20, 5.35),
(72, 12, 5, 21, 6.2),
(73, 1, 8, 21, 1000000),
(75, 18, 3, 21, 12.5),
(76, 4, 4, 21, 6.75),
(77, 78, 7, 21, 5.35),
(78, 12, 5, 22, 6.2),
(79, 1, 8, 22, 1000000),
(81, 18, 3, 22, 12.5),
(82, 4, 4, 22, 6.75),
(83, 78, 7, 22, 5.35),
(84, 12, 5, 23, 6.2),
(85, 1, 8, 23, 1000000),
(87, 18, 3, 23, 12.5),
(88, 4, 4, 23, 6.75),
(89, 78, 7, 23, 5.35),
(90, 12, 5, 24, 6.2),
(91, 1, 8, 24, 1000000),
(93, 18, 3, 24, 12.5),
(94, 4, 4, 24, 6.75),
(95, 78, 7, 24, 5.35),
(96, 12, 5, 25, 6.2),
(97, 1, 8, 25, 1000000),
(99, 18, 3, 25, 12.5);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `TotalAmount` double DEFAULT NULL,
  `TaxRate` int(11) NOT NULL,
  `TaxAmount` double DEFAULT NULL,
  `CreationTimeStamp` date NOT NULL,
  `CompleteTimeStamp` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`Id`, `User_Id`, `TotalAmount`, `TaxRate`, `TaxAmount`, `CreationTimeStamp`, `CompleteTimeStamp`) VALUES
(5, 3, NULL, 20, NULL, '2018-05-31', NULL),
(6, 3, NULL, 20, NULL, '2018-05-31', NULL),
(7, 3, NULL, 20, NULL, '2018-05-31', NULL),
(8, 3, NULL, 20, NULL, '2018-05-31', NULL),
(9, 3, NULL, 20, NULL, '2018-05-31', NULL),
(10, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(11, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(12, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(13, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(14, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(15, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(16, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(17, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(18, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(19, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(20, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(21, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(22, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(23, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(24, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(25, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(26, 3, 1001393.7, 20, 200278.74, '2018-05-31', '2018-05-31'),
(27, 3, NULL, 20, NULL, '2018-06-01', NULL),
(28, 3, 1001399.7, 20, 200279.94, '2018-06-01', '2018-06-01'),
(29, 3, NULL, 20, NULL, '2018-06-01', NULL),
(30, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(31, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(32, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(33, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(34, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(35, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(36, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(37, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(38, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(39, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(40, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(41, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(42, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(43, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(44, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(45, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(46, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(47, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(48, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(49, 3, 25, 20, 5, '2018-06-01', '2018-06-01'),
(50, 3, 25, 20, 5, '2018-06-01', '2018-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(800) NOT NULL,
  `FirstName` varchar(800) NOT NULL,
  `DOB` date NOT NULL,
  `Address` varchar(800) NOT NULL,
  `City` varchar(800) NOT NULL,
  `ZipCode` char(5) NOT NULL,
  `Phone` char(10) NOT NULL,
  `Email` varchar(800) NOT NULL,
  `Password` varchar(800) NOT NULL,
  `CreationTimeStamp` date NOT NULL,
  `LastLoginTimeStamp` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id`, `LastName`, `FirstName`, `DOB`, `Address`, `City`, `ZipCode`, `Phone`, `Email`, `Password`, `CreationTimeStamp`, `LastLoginTimeStamp`) VALUES
(3, 'Test', 'Login', '1929-01-16', 'Login Street', 'LoginVillle', '17485', '1564165165', 'login@test.fr', '$2y$11$e1277656f2ebc2c0fe36feOzi/XT7qkL2qLZPjlQd0rA3B.fHoyuu', '2018-05-24', NULL),
(4, 'jack', 'fsdfsdf', '1920-03-01', 'fdsfsdfs', 'fsdfsdfs', '11212', '1456153148', 'test2@gmail.fr', '$2y$11$df84438dd869a406baba9u0QJYsLqnhp0NoJbglRWszqG3llkovsu', '2018-05-29', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
