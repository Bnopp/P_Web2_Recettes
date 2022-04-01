-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 28 mars 2022 à 09:15
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

CREATE DATABASE db_recipes;

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
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_recipe`
--

INSERT INTO `t_recipe` (`idRecipe`, `title`, `ingredients`, `preparation`, `image`) VALUES
(1, 'Croustillants de chèvre chaud, noix et magrets séchés', '4 rocamadours\r\n4 feuilles de pâte filo\r\n50 g de beurre fondu\r\n4 poignées de mâche ou trévise flamme\r\n100 g de magrets séchés\r\n12 noix fraîches décortiquées\r\n¼ de céleri boule épluché et lavé\r\n12,5 cl de vinaigre de cidre ou de noix\r\n37 cl d’huile d’olive\r\n62 g de miel\r\nQuelques baies de sichuan vert en poudre\r\nFleur de sel et poivre du moulin', '1.\r\nSur votre plan de travail, déposez 1 feuille de filo, nappez de beurre fondu et déposez au centre le rocamadour. Pliez la feuille autour du fromage et laissez de côté. Déposez sur la plaque et enfournez 8 minutes.\r\n\r\n2.\r\nMélangez le vinaigre et l’huile d’olive. Ajoutez le miel. Coupez les cerneaux de noix en petits morceaux et le céleri en fines lamelles à l’aide de la mandoline. Plongez les lamelles de céleri dans un bain d’eau avec des glaçons. Réservez dans une assiette.\r\n\r\n3.\r\nPlongez les croustillants dans l’huile chaude et laissez-les dorer. Égouttez-les et déposez-les sur une assiette recouverte d’un papier absorbant.\r\n\r\n4.\r\nAssaisonnez la salade et les lamelles de céleri avec la vinaigrette. Déposez-la dans un plat de présentation. Ajoutez les cerneaux de noix et les tranches de magrets. Ajoutez par-dessus les croustillants de chèvre et parsemez d’un peu de baies de sichuan en poudre.', 'croustillant-de-chevre-chaud.jpeg');

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
  ADD PRIMARY KEY (`idRecipe`);

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
  MODIFY `idRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
