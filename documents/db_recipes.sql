-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 11 avr. 2022 à 09:22
-- Version du serveur :  5.7.11
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_recipes`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_administrator`
--

CREATE TABLE `t_administrator` (
  `idAdministrator` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `name`) VALUES
(1, 'Entrée'),
(2, 'Plat Principal'),
(3, 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `t_recipe`
--

CREATE TABLE `t_recipe` (
  `idRecipe` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` mediumtext NOT NULL,
  `preparation` mediumtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `fkCategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_recipe`
--

INSERT INTO `t_recipe` (`idRecipe`, `title`, `ingredients`, `preparation`, `image`, `fkCategory`) VALUES
(1, 'Shifu', 'Pain au pavot, 120g de poulet pané maison (CH), cheddar, tomate snackée, iceberg et une délicieuse sauce aigre-douce maison.\r\n', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage.\r\nbaisser la cuisson et commencer à dresser le burger en dorant le pain.\r\nmettre la sauce, les tomates, viande et la salade. C\'est prêt', 'shifu.jpeg', 2),
(2, 'Aïron man', 'Pain au pavot, 160g de boeuf local, tomme au piment d’espelette, carottes, chou blanc et notre délicieuse aïoli maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage.\r\n	baisser la cuisson et commencer à dresser le burger en dorant le pain.\r\n	mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'aironMan.jpeg', 2),
(3, 'Jacky', 'Pain au pavot, 160g de boeuf local, chorizo, fromage Pepper Jack, confit d’oignons, salade et notre délicieuse chipotle mayo maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'jacky.jpeg', 2),
(4, 'Rösticlette', 'Pain au pavot, 160g de boeuf local et sa croûte aux poivres, fromage à raclette, galette de rösti, roquette et une délicieuse sauce maison aux champignons.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'rostiRaclette.jpeg', 2),
(5, 'Honeywood', 'Pain  au pavot, 120g de poulet pané maison (CH), double gruyère AOC, tomate, oignons, iceberg et une délicieuse moutarde au miel maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'honeyWood.jpeg', 2),
(6, 'Patrick', 'Pain au pavot, 160g de boeuf local, composée d’oignons rouges maison, salade et une délicieuse sauce au poivre vert maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'patrick.jpeg', 2),
(7, 'Yukimura', 'Pain au pavot, 120g de poulet pané maison (CH), pickles de choux et carottes, iceberg et une délicieuse sauce Teriyaki maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'yukimura.jpeg', 2),
(8, 'Geronimo', 'Pain au pavot, 160g de bison, bacon au sirop d’érable, cheddar, confit d’oignons, salade et une délicieuse sauce BBQ maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'geronimo.jpeg', 2),
(9, 'Chicken Mcfly', 'Pain au pavot, 120g de poulet pané maison (CH), iceberg et sauce McFly.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'chickenMcFly.jpeg', 2),
(10, 'Gilbear', 'Pain au pavot, 160g de bœuf local, croûte aux poivres, bacon, tomme à l’ail des ours, confit d’oignons, roquettes et une délicieuse sauce moutarde à l’ancienne & miel fait maison.', 'Selon cuisson demandée, cuire la viande. Après l\'avoir retournée, mettre le fromage. Baisser la cuisson et commencer à dresser le burger en dorant le pain. Mettre la sauce, les tomates, viande et la salade. C\'est prêt', 'gilbear.jpeg', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_administrator`
--
ALTER TABLE `t_administrator`
  ADD PRIMARY KEY (`idAdministrator`);

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `t_recipe`
--
ALTER TABLE `t_recipe`
  ADD PRIMARY KEY (`idRecipe`),
  ADD KEY `fkCategory` (`fkCategory`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_administrator`
--
ALTER TABLE `t_administrator`
  MODIFY `idAdministrator` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_recipe`
--
ALTER TABLE `t_recipe`
  MODIFY `idRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_recipe`
--
ALTER TABLE `t_recipe`
  ADD CONSTRAINT `t_recipe_ibfk_1` FOREIGN KEY (`fkCategory`) REFERENCES `t_category` (`idCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
