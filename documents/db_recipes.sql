-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2022 at 03:42 AM
-- Server version: 5.7.11
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Entrée'),
(2, 'Plat Principal'),
(3, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `t_comment`
--

CREATE TABLE `t_comment` (
  `idComment` int(11) NOT NULL,
  `comName` tinytext NOT NULL,
  `comEmail` tinytext NOT NULL,
  `comSubject` tinytext NOT NULL,
  `comMessage` mediumtext NOT NULL,
  `fkRecipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_comment`
--

INSERT INTO `t_comment` (`idComment`, `comName`, `comEmail`, `comSubject`, `comMessage`, `fkRecipe`) VALUES
(7, 'Serghei Diulgherov', 'sergheidiulgherov@gmail.com', 'Testing website', 'efsf', 2),
(8, 'Serghei Diulgherov', 'sergheidiulgherov@gmail.com', 'Testing website', 'Test de commentaire 2.0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_rating`
--

CREATE TABLE `t_rating` (
  `idRating` int(11) NOT NULL,
  `ratRating` decimal(2,1) NOT NULL,
  `fkRecipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_rating`
--

INSERT INTO `t_rating` (`idRating`, `ratRating`, `fkRecipe`) VALUES
(43, '1.0', 8),
(44, '5.0', 8),
(45, '3.0', 8),
(46, '1.0', 8),
(47, '1.0', 8),
(48, '5.0', 1),
(49, '3.0', 10);

-- --------------------------------------------------------

--
-- Table structure for table `t_recipe`
--

CREATE TABLE `t_recipe` (
  `idRecipe` int(11) NOT NULL,
  `recTitle` varchar(255) NOT NULL,
  `recIngredients` mediumtext NOT NULL,
  `recPreparation` mediumtext NOT NULL,
  `recImage` varchar(255) DEFAULT NULL,
  `fkCategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_recipe`
--

INSERT INTO `t_recipe` (`idRecipe`, `recTitle`, `recIngredients`, `recPreparation`, `recImage`, `fkCategory`) VALUES
(1, 'Shifu', 'Pain au pavot, 120g de poulet pané maison (CH), cheddar, tomate snackée, iceberg et une délicieuse sauce aigre-douce maison.\r\n', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'shifu.jpeg', 2),
(2, 'Aïron man', 'Pain au pavot, 160g de boeuf local, tomme au piment d’espelette, carottes, chou blanc et notre délicieuse aïoli maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'aironMan.jpeg', 2),
(3, 'Jacky', 'Pain au pavot, 160g de boeuf local, chorizo, fromage Pepper Jack, confit d’oignons, salade et notre délicieuse chipotle mayo maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'jacky.jpeg', 2),
(4, 'Rösticlette', 'Pain au pavot, 160g de boeuf local et sa croûte aux poivres, fromage à raclette, galette de rösti, roquette et une délicieuse sauce maison aux champignons.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'rostiRaclette.jpeg', 2),
(5, 'Honeywood', 'Pain  au pavot, 120g de poulet pané maison (CH), double gruyère AOC, tomate, oignons, iceberg et une délicieuse moutarde au miel maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'honeyWood.jpeg', 2),
(6, 'Patrick', 'Pain au pavot, 160g de boeuf local, composée d’oignons rouges maison, salade et une délicieuse sauce au poivre vert maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'patrick.jpeg', 2),
(7, 'Yukimura', 'Pain au pavot, 120g de poulet pané maison (CH), pickles de choux et carottes, iceberg et une délicieuse sauce Teriyaki maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'yukimura.jpeg', 2),
(8, 'Geronimo', 'Pain au pavot, 160g de bison, bacon au sirop d’érable, cheddar, confit d’oignons, salade et une délicieuse sauce BBQ maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'geronimo.jpeg', 2),
(9, 'Chicken Mcfly', 'Pain au pavot, 120g de poulet pané maison (CH), iceberg et sauce McFly.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'chickenMcFly.jpeg', 2),
(10, 'Gilbear', 'Pain au pavot, 160g de bœuf local, croûte aux poivres, bacon, tomme à l’ail des ours, confit d’oignons, roquettes et une délicieuse sauce moutarde à l’ancienne & miel fait maison.', 'Selon cuisson demandée, Cuire la viande. Après l\'avoir retournée, Mettre le fromage.\r\nBaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nMettre la sauce, les tomates, viande et la salade. C\'est prêt', 'gilbear.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `useUsername` varchar(50) NOT NULL,
  `usePassword` varchar(255) NOT NULL,
  `useAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`idUser`, `useUsername`, `usePassword`, `useAdmin`) VALUES
(1, 'root', '$2y$10$XjZiB/ixhBOiPt/zqVI.oujQqW/QpbyM.oaKtEv1lj8VKDYFMhZK.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `fkRecipe` (`fkRecipe`);

--
-- Indexes for table `t_rating`
--
ALTER TABLE `t_rating`
  ADD PRIMARY KEY (`idRating`),
  ADD KEY `fkRecipe` (`fkRecipe`);

--
-- Indexes for table `t_recipe`
--
ALTER TABLE `t_recipe`
  ADD PRIMARY KEY (`idRecipe`),
  ADD KEY `fkCategory` (`fkCategory`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_rating`
--
ALTER TABLE `t_rating`
  MODIFY `idRating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `t_recipe`
--
ALTER TABLE `t_recipe`
  MODIFY `idRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `t_comment_ibfk_1` FOREIGN KEY (`fkRecipe`) REFERENCES `t_recipe` (`idRecipe`);

--
-- Constraints for table `t_rating`
--
ALTER TABLE `t_rating`
  ADD CONSTRAINT `t_rating_ibfk_1` FOREIGN KEY (`fkRecipe`) REFERENCES `t_recipe` (`idRecipe`);

--
-- Constraints for table `t_recipe`
--
ALTER TABLE `t_recipe`
  ADD CONSTRAINT `t_recipe_ibfk_1` FOREIGN KEY (`fkCategory`) REFERENCES `t_category` (`idCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
