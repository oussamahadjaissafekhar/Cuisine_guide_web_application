-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2023 at 09:37 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `UserName`, `Password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `calorieseuil`
--

DROP TABLE IF EXISTS `calorieseuil`;
CREATE TABLE IF NOT EXISTS `calorieseuil` (
  `calorieSeuilId` int(10) NOT NULL,
  `calorieSeuil` int(11) NOT NULL,
  UNIQUE KEY `calorieSeuikId` (`calorieSeuilId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calorieseuil`
--

INSERT INTO `calorieseuil` (`calorieSeuilId`, `calorieSeuil`) VALUES
(1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorieId` int(11) NOT NULL,
  `categorieNom` varchar(50) NOT NULL,
  UNIQUE KEY `categorieId` (`categorieId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`categorieId`, `categorieNom`) VALUES
(1, 'dessert'),
(2, 'plat'),
(3, 'boisson'),
(4, 'entree');

-- --------------------------------------------------------

--
-- Table structure for table `diaporama`
--

DROP TABLE IF EXISTS `diaporama`;
CREATE TABLE IF NOT EXISTS `diaporama` (
  `diaporamaId` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  UNIQUE KEY `diapo` (`diaporamaId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diaporama`
--

INSERT INTO `diaporama` (`diaporamaId`, `type`, `id`) VALUES
(5, 'recipe', 12),
(3, 'recipe', 2),
(2, 'new', 4),
(1, 'recipe', 18),
(4, 'recipe', 6),
(6, 'recipe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

DROP TABLE IF EXISTS `holiday`;
CREATE TABLE IF NOT EXISTS `holiday` (
  `HolidayID` int(11) NOT NULL,
  `Holiday` varchar(50) NOT NULL,
  `HolidayDescription` varchar(150) NOT NULL,
  PRIMARY KEY (`HolidayID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`HolidayID`, `Holiday`, `HolidayDescription`) VALUES
(1, 'Aidel-Fitr', ''),
(2, 'El-Mawlid', ''),
(3, 'marriage', ''),
(4, 'Yennayer', ''),
(5, 'Achoura', ''),
(6, 'Ramadane', '');

-- --------------------------------------------------------

--
-- Table structure for table `holidayrecipe`
--

DROP TABLE IF EXISTS `holidayrecipe`;
CREATE TABLE IF NOT EXISTS `holidayrecipe` (
  `HolidayRecipeID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `HolidayID` int(11) NOT NULL,
  PRIMARY KEY (`HolidayRecipeID`),
  KEY `FK_2` (`RecipeID`),
  KEY `FK_3` (`HolidayID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidayrecipe`
--

INSERT INTO `holidayrecipe` (`HolidayRecipeID`, `RecipeID`, `HolidayID`) VALUES
(3, 5, 6),
(2, 13, 6),
(1, 11, 3),
(4, 4, 6),
(5, 12, 6),
(6, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `IngredientID` int(11) NOT NULL,
  `IngredientName` varchar(50) NOT NULL,
  `Saison` varchar(200) NOT NULL,
  `Halthy` varchar(11) NOT NULL,
  `ImageIngredient` varchar(45) NOT NULL,
  `Calorie` float NOT NULL,
  `Glucide` float NOT NULL,
  `Lipide` float NOT NULL,
  `Proteine` float NOT NULL,
  `Vitamine` float NOT NULL,
  PRIMARY KEY (`IngredientID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`IngredientID`, `IngredientName`, `Saison`, `Halthy`, `ImageIngredient`, `Calorie`, `Glucide`, `Lipide`, `Proteine`, `Vitamine`) VALUES
(42, 'café d\'extrait de vanille', 'Printemps', '5', 'Images/ingredientImages/cafe-vanille', 12, 0.53, 0, 0, 0),
(8, 'miel', 'Hiver,Printemps,Ete,Automne', '5', 'Images/ingredientImages/miel.png', 1229, 70, 0, 0.4, 0),
(9, 'farine', 'Hiver,Printemps,Ete,Automne', '5', 'Images/ingredientImages/farine.png', 343, 70, 0, 70, 0),
(10, 'oeuf', 'Hiver,Printemps,Ete,Automne', '5', 'Images/ingredientImages/oeuf.png', 75, 0.5, 0, 7, 0),
(11, 'levure chimique', 'Hiver,Printemps,Ete,Automne', '5', '', 53, 0, 0, 0, 0),
(12, 'huile de tournesol', 'Hiver,Printemps,Ete,Automne', '5', '', 884, 0, 0, 0, 0),
(13, 'extrait de vanille', 'Hiver,Printemps,Ete,Automne', '5', '', 288, 0, 0, 0.1, 0),
(14, 'sel', 'Hiver,Printemps,Ete,Automne', '5', '', 288, 0, 0, 0.1, 0),
(15, 'semoule moyenne', 'Hiver,Printemps,Ete,Automne', '5', '', 120, 0, 0, 3.75, 0),
(16, 'noix de coco', 'Hiver,Printemps,Ete,Automne', '5', '', 365, 0, 0, 3.33, 0),
(17, 'lait', 'Hiver,Printemps,Ete,Automne', '5', '', 152, 5, 0, 8, 0),
(18, 'canelle', 'Hiver,Printemps,Ete,Automne', '5', '', 247, 0, 0, 4, 0),
(19, 'feuilles de bricks', 'Hiver,Printemps,Ete,Automne', '5', '', 51, 0.04, 0, 1.41, 0),
(20, 'citron', 'Hiver,Printemps', '5', '', 0, 0, 0, 29, 0),
(21, 'chapelure', 'Hiver,Printemps,Ete,Automne', '5', '', 395, 6, 0, 5, 0),
(22, 'riz', 'Hiver,Printemps,Ete,Automne', '5', '', 130, 0.1, 0, 2.7, 0),
(23, 'pomme', 'Ete', '5', '', 55, 10, 0, 0.3, 0),
(24, 'cafe', 'Hiver,Printemps,Ete,Automne', '5', '', 5, 0, 0, 0.3, 0),
(25, 'fromage blanc', 'Hiver,Printemps,Ete,Automne', '5', '', 98, 0, 0, 11, 0),
(26, 'biscuits', 'Hiver,Printemps,Ete,Automne', '5', '', 353, 14, 0, 7, 0),
(27, 'cacao', 'Hiver,Printemps,Ete,Automne', '5', '', 353, 14, 0, 22.4, 0),
(28, 'safran', 'Hiver,Printemps,Ete,Automne', '5', '', 352, 14, 0, 11.4, 0),
(29, 'pommes de terre', 'Hiver,Printemps,Ete,Automne', '5', '', 77, 0.03, 0, 4.6, 0),
(30, 'ail', 'Hiver,Printemps,Ete,Automne', '5', '', 111, 0, 0, 0.3, 0),
(31, 'pouliot', 'Hiver', '5', '', -1, -1, 0, -2, 0),
(32, 'paprika', 'Hiver,Printemps,Ete,Automne', '5', '', 282, 0, 0, 14, 0),
(33, 'poivre', 'Hiver,Printemps,Ete,Automne', '5', '', 20, 56, 0, 0.9, 0),
(34, 'tomate', 'Ete', '5', '', 18, 2, 0, 0.9, 0),
(35, 'oignon', 'Hiver,Printemps,Ete,Automne', '5', '', 40, 0, 0, 1.1, 0),
(36, 'poivron', 'Hiver,Printemps,Ete,Automne', '5', '', 20, 0, 0, 0.9, 0),
(37, 'courgette', 'Ete,Automne', '5', '', 17, 0, 0, 1.2, 0),
(38, 'gruyère', 'Hiver,Printemps,Ete,Automne', '5', '', 413, 0.4, 0, 30, 0),
(39, 'creme fraiche', 'Hiver,Printemps,Ete,Automne', '5', '', 149, 15.4, 0, 2.56, 0),
(40, 'couscous', 'Hiver,Printemps,Ete,Automne', '5', '', 112, 55.19, 0, 3.8, 0),
(41, 'lavande', 'Printemps', '5', '', -1, -1, 0, -1, 0),
(7, 'cheveux d\'ange', 'Hiver,Printemps,Ete,Automne', '5', '', 365, 3.5, 0, 12, 0),
(6, 'eau de fleur d\'oranger', 'Hiver,Printemps,Ete,Automne', '5', '', 0, 0, 0, 0, 0),
(5, 'eau', 'Hiver,Printemps,Ete,Automne', '5', '', 0, 0, 0, 0, 0),
(4, 'amande', 'Hiver,Printemps,Ete,Automne', '5', '', 600, 4.4, 0, 22.6, 0),
(3, 'sucre', 'Hiver,Printemps,Ete,Automne', '5', '', 387, 99.91, 0, 0, 0),
(2, 'beure', 'Hiver,Printemps,Ete,Automne', '5', '', 102, 16, 0, 0.12, 0),
(1, 'semoule grosse', 'Hiver,Printemps,Ete,Automne', '5', '', 120, 0, 0, 3.75, 0),
(43, 'chocolat noire', 'Printemps', '5', 'Images/ingredientImages/chocolat-noire.png', 530, 59, 30, 6, 0),
(44, 'crème liquide', 'Printemps', '5', 'Images/ingredientImages/crème liquide.png', 144, 5, 12, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ingredientrecette`
--

DROP TABLE IF EXISTS `ingredientrecette`;
CREATE TABLE IF NOT EXISTS `ingredientrecette` (
  `IngredientRecette` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `IngredientID` int(11) NOT NULL,
  `Quantite` int(11) DEFAULT NULL,
  `UniteQuantite` varchar(45) NOT NULL,
  `CoockingMethod` varchar(50) NOT NULL,
  PRIMARY KEY (`IngredientRecette`),
  KEY `FK_2` (`RecipeID`),
  KEY `FK_3` (`IngredientID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredientrecette`
--

INSERT INTO `ingredientrecette` (`IngredientRecette`, `RecipeID`, `IngredientID`, `Quantite`, `UniteQuantite`, `CoockingMethod`) VALUES
(10, 5, 6, 500, 'ml', ''),
(11, 6, 3, 125, 'g', ''),
(12, 6, 10, 3, '', ''),
(13, 6, 9, 125, 'g', ''),
(14, 6, 11, 50, 'g', ''),
(15, 6, 12, 70, 'g', ''),
(16, 6, 13, 5, 'g', ''),
(17, 7, 3, 400, 'g', ''),
(18, 7, 10, 2, '', ''),
(19, 7, 17, 220, 'ml', ''),
(20, 7, 9, 500, 'g', ''),
(21, 7, 16, 100, 'g', ''),
(22, 7, 11, 50, 'g', ''),
(23, 7, 12, 220, 'ml', ''),
(24, 8, 6, 500, 'ml', ''),
(25, 8, 4, 125, 'g', ''),
(26, 8, 18, 100, 'g', ''),
(27, 8, 3, 400, 'g', ''),
(28, 8, 8, 500, 'g', ''),
(9, 5, 8, 300, 'g', ''),
(8, 5, 4, 150, 'g', ''),
(7, 5, 3, 30, 'g', ''),
(6, 4, 6, 7, 'ml', ''),
(5, 4, 5, 1000, 'ml', ''),
(4, 4, 4, 30, 'g', ''),
(3, 4, 3, 200, 'g', ''),
(2, 4, 2, 125, 'g', ''),
(1, 4, 1, 500, 'g', ''),
(29, 10, 22, 100, 'g', ''),
(30, 10, 3, 150, 'g', ''),
(31, 10, 17, 1000, 'ml', ''),
(32, 10, 18, 20, 'g', ''),
(33, 11, 9, 250, 'g', ''),
(34, 11, 2, 150, 'g', ''),
(35, 11, 3, 100, 'g', ''),
(36, 11, 14, 2, 'g', ''),
(37, 11, 10, 1, '', ''),
(38, 11, 13, 1, 'g', ''),
(39, 12, 26, 20, 'g', ''),
(40, 12, 2, 150, 'g', ''),
(41, 12, 3, 100, 'g', ''),
(42, 12, 27, 100, 'g', ''),
(43, 12, 10, 3, '', ''),
(44, 12, 24, 100, 'g', ''),
(45, 13, 26, 20, 'g', ''),
(46, 13, 2, 150, 'g', ''),
(47, 13, 9, 250, 'g', ''),
(48, 13, 5, 25, 'ml', ''),
(49, 13, 11, 6, 'g', ''),
(50, 13, 24, 100, 'g', ''),
(51, 13, 28, 2, 'g', ''),
(52, 13, 8, 100, 'g', ''),
(53, 13, 3, 150, 'g', ''),
(54, 13, 12, 1000, 'ml', ''),
(55, 14, 29, 1000, 'g', ''),
(56, 14, 30, 60, 'g', ''),
(57, 14, 31, 400, 'g', ''),
(58, 14, 32, 40, 'g', ''),
(59, 14, 11, 6, 'g', ''),
(60, 14, 33, 300, 'g', ''),
(61, 14, 12, 50, 'ml', ''),
(62, 14, 10, 1, '', ''),
(63, 14, 5, 500, 'ml', ''),
(64, 15, 34, 1000, 'g', ''),
(65, 15, 30, 60, 'g', ''),
(66, 15, 14, 5, 'g', ''),
(67, 15, 10, 4, '', ''),
(68, 15, 35, 300, 'g', ''),
(69, 15, 36, 500, 'g', ''),
(70, 15, 33, 50, 'g', ''),
(71, 15, 12, 50, 'ml', ''),
(72, 16, 37, 1000, 'g', ''),
(73, 16, 10, 3, 'g', ''),
(74, 16, 38, 100, 'g', ''),
(75, 16, 14, 5, 'g', ''),
(76, 16, 39, 250, 'g', ''),
(77, 16, 2, 50, 'g', ''),
(78, 16, 33, 50, 'g', ''),
(79, 17, 40, 500, 'g', ''),
(80, 17, 41, 300, 'g', ''),
(81, 17, 12, 200, 'ml', ''),
(82, 17, 14, 15, 'g', ''),
(83, 5, 7, 400, 'g', ''),
(84, 24, 12, 30, 'kg', ''),
(85, 24, 10, 4, 'ty', ''),
(86, 20, 42, 165, 'g', ''),
(87, 20, 43, 1, 'c', ''),
(88, 21, 43, 200, 'g', ''),
(89, 21, 44, 200, 'cl', ''),
(90, 21, 17, 80, 'cl', '');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `LikeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  PRIMARY KEY (`LikeID`),
  KEY `FK_2` (`UserID`),
  KEY `FK_3` (`RecipeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`LikeID`, `UserID`, `RecipeID`) VALUES
(1, 1, 6),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `NoteID` int(11) NOT NULL,
  `Note` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  PRIMARY KEY (`NoteID`,`Note`),
  KEY `FK_2` (`UserID`),
  KEY `FK_3` (`RecipeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`NoteID`, `Note`, `UserID`, `RecipeID`) VALUES
(3, 5, 3, 13),
(2, 2, 2, 13),
(1, 5, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `IdElement` int(11) NOT NULL,
  `MenuElement` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`IdElement`, `MenuElement`) VALUES
(1, 'Acceuil'),
(2, 'Recette Idee'),
(3, 'News'),
(4, 'Healthy'),
(5, 'Saisons'),
(6, 'Fetes'),
(7, 'Nutrition');

-- --------------------------------------------------------

--
-- Table structure for table `new`
--

DROP TABLE IF EXISTS `new`;
CREATE TABLE IF NOT EXISTS `new` (
  `NewID` int(11) NOT NULL,
  `ImageNew` varchar(50) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `NewTitle` varchar(100) NOT NULL,
  `Video` varchar(150) NOT NULL,
  `NewDescription` varchar(10000) NOT NULL,
  PRIMARY KEY (`NewID`),
  KEY `FK_2` (`AdminID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new`
--

INSERT INTO `new` (`NewID`, `ImageNew`, `AdminID`, `NewTitle`, `Video`, `NewDescription`) VALUES
(1, 'Images/newsImages/new1.png', 1, 'Chef Bilal zappe Oum Walid et Hicham Cook !', '', 'Personnes - Dans une declaration inattendue, le chef Bilal a zappe Oum Walid et Hichem Cook lorsqu\'il a presente son choix du meilleur restaurateur d\'Algérie. Retrouvez ses propos juste en dessous.En effet, le spécialiste de la gastronomie algérienne et française participait hier à l\'émission Dima Hna\". Cette dernière est diffusée sur la chaîne de télévision Beur TV. Au cours de son intervention, il a répondu à une série de questions relatives à son carrière dans le monde de la restauration.Le chef Bilal a également fait son choix sur le meilleur restaurateur d\'Algérie, sautant Oum Walid et Hicham Cook.À la surprise générale, il a ignoré Hichem Cook et Oum Walid.Ce dernier est, pour rappel, , la youtubeuse culinaire la plus suivie de notre pays. Elle s\'est, en effet, forgé une célébrité phénoménale sur les réseaux sociaux. Son savoir-faire attire l\'admiration. Il faut dire que ses recettes sont reprises quotidiennement par des milliers de ses abonnés sur les différentes plateformes./ $Au cours de la même émission, le chef Bilal a désigné le meilleur restaurateur algérien. Pour lui, la chef Samia Bouchenafa domine actuellement le monde culinaire féminin. Il est à noter que cette dernière réside actuellement de l\'autre côté. de la Méditerranée. Ses recettes ont été testées et approuvées par des spécialistes de renommée mondiale.\"'),
(2, 'Images/newsImages/new2.png', 1, 'Skikda : la fete traditionnelle de la fraise', '', 'La fete de la fraise a Skikda est un evenement culturel et sportif qui permet aux habitants et aux visiteurs de profiter d\'une foule d\'activites Un carnaval haut en couleurs parcourt les axes du centre-ville depuis le stade municipal le 20 août 1955 en passant par les Avenues pour arriver au siège du CPA , d\'une distance de 5km, avec des groupes folkloriques et des scouts devant une foule nombreuse massée le long des rues du centre-ville.La fête de la fraise célébrée chaque année à la mi-mai dans l\'ancienne Rusicada était également marquée par la présence de plusieurs troupes de fantasia venues de différentes wilayas, aux côtés des troupes locales de Skikda. Le clou du carnaval a été le passage du camion transformé en corbeille de fruits géante avec des fraises en \'reine du spectacle\'. Des gâteaux aux fraises ont été distribués au public pour rehausser l\'éclat de l\'ambiance. Fraise distribuée aux passants et soirées artistiques de la parcelle Stora. des expositions sur l\'artisanat, un jeu traditionnel appelé localement el-karmouzia et aussi le concours de Miss Fraise 2016. Un concours en rapport avec le cutter, à savoir le meilleur jus de fraise, les tartes, les confitures, la fraise met en valeur le meilleur balcon fleuri domestique, la meilleure photo de fraises naturelles et la meilleure présentation sur l\'histoire de la fraise. Des soirées artistiques avec des chanteurs locaux et nationaux animent les soirées.'),
(3, 'Images/newsImages/new3.png', 1, '10 meilleures huiles d\'olive pour cuisiner', '', 'Louee par les chefs et les nutritionnistes, l\'huile d\'olive a vu sa popularite monter en fleche au Royaume-Uni depuis les annees 1990 et en tant que nation, nous importons pres de 100 000 tonnes par an. Les tendances les plus récentes montrent une demande particulière pour l\'huile d\'olive extra vierge, qui - fabriquée à partir d\'olives pures et pressées à froid - est riche en vitamines, polyphénols et acides gras monosaturés, et conserve plus des avantages pour la santé associés que les huiles d\'olive mélangées et raffinées. trouve souvent dans les rayons des supermarchés. Ceci, combiné aux saveurs vibrantes et diverses de l\'huile d\'olive extra vierge, contribue à garantir son statut d\'élément essentiel du placard du magasin. éditeur d\'Olive Oil Times et fondateur de l\'International Olive Oil School, ajoutant que l\'huile d\'olive extra vierge étant un jus de fruit non raffiné, elle est affectée par le terroir dans lequel les olives sont cultivées, la variété d\'olive (ou cultivar) utilisée ainsi que d\'autres variables dans la culture, la récolte, la mouture et l\'emballage. \"L\'huile d\'olive extra vierge de haute qualité aura des arômes d\'olives fraîches avec des notes à base de plantes et le goût sera agréablement amer, avec des sensations qui persistent en harmonie en bouche, se terminant par un piquant poivré dans la gorge qui indique la présence de sain composés phénoliques. ”/ $Alors que les producteurs espagnols et italiens ont eu tendance à dominer, Cord note qu\'aujourd\'hui, les consommateurs peuvent trouver des huiles d\'olive exceptionnelles plus loin. \"La qualité globale de l\'huile d\'olive extra vierge produite dans le monde s\'est considérablement améliorée à mesure que les consommateurs sont mieux informés sur les bienfaits pour la santé du régime méditerranéen en général, et de l\'huile d\'olive extra vierge en particulier\", dit-il./$Alors, comment choisir un? Tout d\'abord, réfléchissez à la façon dont vous allez l\'utiliser. Le point de fumée relativement bas de l\'huile d\'olive extra vierge, entre 190 et 207 ° C, signifie qu\'elle ne convient pas à la friture et à la torréfaction à haute température, mais reste une option efficace pour la cuisson à feu doux et moyen. Cependant, étant donné les profils de saveur délicats de ces huiles, cela peut sembler un gaspillage et la plupart des chefs l\'utilisent plutôt pour la finition - vers la fin du processus de cuisson pour donner de la couleur, de la saveur et de la texture. C\'est aussi le choix parfait pour tremper, assaisonner les salades et comme condiment de déclaration. Il convient de noter que - contrairement au vin - l\'huile d\'olive ne s\'améliore pas avec l\'âge et qu\'il est préférable de la consommer dans les 18 mois, alors assurez-vous de vérifier la date de péremption.'),
(4, 'Images/newsImages/new4.png', 1, '\nLes croutons sont la meilleure partie de la salade !', 'videos/new1.mp4', 'Levez la main si vous pensez, ou avez deja pense, que la meilleure partie d\'une salade etait les croutons.Ils entrent à peine dans le saladier si c\'est un bon croûton », explique Tara Jensen, auteure de livres de cuisine et enseignante en pâtisserie. Ces morceaux de pain grillé – crouton est dérivé du mot français pour « petite croûte » – peuvent être difficiles à résister. Et pourquoi le feriez-vous ? Que vous souhaitiez réaliser les meilleurs croûtons pour le goûter, les salades ou les soupes, voici quelques points à retenir. Comment les aromatiser ? La graisse est cruciale pour la saveur en plus de la texture. L\'huile d\'olive extra vierge est un incontournable, et vous voulez vous assurer que vous utilisez quelque chose que vous aimez car c\'est un ingrédient si important. Pour \"aider à produire des croûtons super croquants et savoureux\", pensez à une quantité généreuse de beurre, surtout lorsqu\'il est cuit dans une poêle (voir ci-dessous), écrivait Andreas Viestad en 2010.');

-- --------------------------------------------------------

--
-- Table structure for table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `parametreId` int(11) NOT NULL,
  `parametreNom` varchar(100) NOT NULL,
  `parametreValue` int(11) NOT NULL,
  UNIQUE KEY `parametreId` (`parametreId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parametres`
--

INSERT INTO `parametres` (`parametreId`, `parametreNom`, `parametreValue`) VALUES
(2, 'calorieSeuil', 250),
(3, 'healthySeuil', 5),
(1, 'ingredientPourcentage', 70);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `RecipeID` int(11) NOT NULL,
  `Image` varchar(50) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Difficult` int(11) DEFAULT NULL,
  `PrepareTime` varchar(50) NOT NULL,
  `RestTime` varchar(50) NOT NULL,
  `CookingTime` varchar(50) NOT NULL,
  `TotalTime` varchar(50) NOT NULL,
  `Video` varchar(150) NOT NULL,
  `RecipeNom` text NOT NULL,
  `RecipeDescription` mediumtext NOT NULL,
  `Categorie` varchar(45) NOT NULL,
  `noteTotal` int(11) NOT NULL,
  `Saison` varchar(100) NOT NULL,
  `calorieTotal` int(11) NOT NULL,
  `confirmed` int(2) NOT NULL,
  PRIMARY KEY (`RecipeID`),
  KEY `FK_2` (`UserID`),
  KEY `FK_3` (`AdminID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`RecipeID`, `Image`, `AdminID`, `UserID`, `Difficult`, `PrepareTime`, `RestTime`, `CookingTime`, `TotalTime`, `Video`, `RecipeNom`, `RecipeDescription`, `Categorie`, `noteTotal`, `Saison`, `calorieTotal`, `confirmed`) VALUES
(1, 'Images/recipeImages/recipe3.png', NULL, NULL, 0, '00:20', '00:00', '00:40', '01:00', '', 'ragout d agneau aux pommes de terre', 'J ai prepare ce ragout d agneau aux pommes de terre pour le diner, et comme je vous ai toujours dit, je n aime pas prendre les photos la nuit car elles ne refletent pas trop la qualite du plat et surtout quand c est une sauce rouge.\n\nCe Ragout est juste un delice! Habituellement je fais mon ragout d’agneau avec des pommes de terre seulement, mais mon petit dernier aiment beaucoup les carottes, donc j’ai introduit ce légume au plat, et ça a donné encore plus de saveur au ragoût.', 'plat', 5, 'printemps', 320, 1),
(2, 'Images/recipeImages/recipe5.png', NULL, NULL, 0, '00:10', '00:00', '00:30', '00:40', '', 'Garantita algerienne', 'La Calentica se vend partout en Algerie par des marchands ambulants une sorte de street food elle se consomme chaude dans du pain. Le marchand passait dans des quartiers avec son charrette en criant haut et fort El-Karan El-karan :).', 'plat', 3, 'etes printemps', 293, 1),
(17, 'Images/recipeImages/recipe10.png', NULL, NULL, 0, '00:40', '00:00', '01:05', '', '', 'Khalouta', 'Plat Algerois Khalouta. Recette à base d\'aubergines courgette pomme de terre .foule yabesse 24h dans l\'eau faire bouillir ensuite mettre dans la marmite.', 'plat', 0, '', 0, 1),
(18, 'Images/recipeImages/recipe17.png', NULL, NULL, 0, '00:30:00', '00:00:00', '01:30:00', '', '', 'Batata Flieu', 'Le batata fliou est un ragoût de pommes de terre à la menthe pouliot1. C\'est un plat traditionnel algérien, originaire de la région de Blida, située dans la plaine de la Mitidja, zone marécageuse où pousse cette plante. Le mot batata est l\'équivalent du mot « patate » en arabe.', 'plat', 0, '', 1526, 1),
(16, 'Images/recipeImages/recipe10.png', NULL, NULL, 0, '00:30', '00:00', '01:00', '', '', 'Hamama', 'Ce plat ancestral est à base de semoule mélangée à des herbes sauvages comme le Halhal (lavande sauvage), Fliou (menthe de pouliot), Timersat (marrube noir), Benaâman (Coquelicot), Zeitra (Thym), Aklil (Romarin). Une fois que le printemps s’installe, la cueillette des plantes et ingrédients constituant ses ingrédients commence. C’est pour cette raison que ce plat est qualifié de couscous du printemps. On raconte que ce plat contenait jusqu’à 70 variétés de plantes et herbes lorsqu’il était préparé par les montagnardes', 'plat', 0, '', 2368, 1),
(15, 'Images/recipeImages/recipe19.png', NULL, NULL, 0, '00:05', '00:00', '00:30', '', '', 'Gratin Courgette', 'une recette à petit prix, simple et idéale pour accompagner vos viandes et poissons pour un repas léger et équilibré.', 'plat', 0, '', 1033, 1),
(14, 'Images/recipeImages/recipe18.png', NULL, NULL, 0, '00:10', '00:00', '00:30', '', '', 'Chakchouka', 'Il s\'agit d\'une sorte de poêlée de poivrons ou de piments verts ou rouges, tomates, oignons et à laquelle s\'ajoutent à la fin des œufs. Elle est proche de la frita et du pisto manchego, ou encore de la ojja.Le saksuka en Turquie est un plat différent, à base de légumes cuits dans l\'huile d\'olive. Il se mange froid et ne contient pas doeuf.', 'plat', 0, '', 1233, 1),
(13, 'Images/recipeImages/recipe17.png', NULL, NULL, 0, '00:30', '00:00', '01:30', '', '', 'Batata Flieu', 'Le batata fliou est un ragoût de pommes de terre à la menthe pouliot1. C\'est un plat traditionnel algérien, originaire de la région de Blida, située dans la plaine de la Mitidja, zone marécageuse où pousse cette plante. Le mot batata est l\'équivalent du mot « patate » en arabe.', 'plat', 0, '', 1526, 1),
(12, 'Images/recipeImages/recipe8.png', NULL, NULL, 0, '01:00', '00:00', '00:20', '', '', 'Zlabia', 'Zlabia, une pâtisserie type de l\'est algérien et de la Tunisie pour ramadan, à base de farine et de semoule ou farine seulement sel et eau qu\'on laisse un peu fermenter un à deux jours au frais pour obtenir un goût assez typique, au miel sans colorant ni autre additif à l\'origine.', 'dessert', 4, '', 11746, 1),
(11, 'Images/recipeImages/recipe16.png', NULL, NULL, 0, '00:10', '00:00', '00:10', '', '', 'Tiramisu', 'est un dessert italien aromatisé au café. Il est composé d\'un gâteau trempé dans du café, recouvert d\'un mélange fouetté d\'œufs, de sucre et de fromage mascarpone, aromatisé au cacao. La recette a été adaptée dans de nombreuses variétés de gâteaux et autres desserts. Ses origines sont souvent contestées entre les régions italiennes de la Vénétie et du Frioul-Vénétie Julienne.', 'dessert', 0, '', 1194, 1),
(10, 'Images/recipeImages/recipe15.png', NULL, NULL, 0, '00:10', '00:00', '00:10', '', '', 'Les Tartelettes', 'Petite tarte individuelle, sucrée ou salée, pouvant avoir une forme allongée.C\'est un dessert assez facile à réaliser : une pâte brisée, une couche de confiture', 'dessert', 0, '', 1481, 1),
(9, 'Images/recipeImages/recipe14.png', NULL, NULL, 0, '00:10', '01:00', '00:15', '', '', 'Mhalbi', 'Mhalbi ou M’halbi un entremet ou une crème au riz à l’algérienne, à base de poudre de riz. Un dessert frais incontournable des soirées ramadanesques qui s’annoncent chaudes cette année.', 'dessert', 0, '', 2280, 1),
(8, 'Images/recipeImages/recipe13.png', NULL, NULL, 0, '00:15', '00:10', '00:40', '', '', 'Khobz Tounes', 'Khobz el bey, ou encore khobz tounes, est un gâteau algérien à base d\'amandes et de chapelure ou de brioche émiettée, arrosé d\'un sirop sucré parfumé à l\'eau de fleur d\'oranger. Par sa texture, très fondante, il ressemble beaucoup aux babas au rhum.', 'dessert', 0, '', 0, 1),
(7, 'Images/recipeImages/recipe10.png', NULL, NULL, 0, '00:10', '00:00', '00:10', '', '', 'Cigar', 'Le bourek renna est une pâtisserie traditionnelle algérienne, à base de feuille de brick, fourrée avec une farce d\'amande, de noix de coco et de cannelle. Cette pâtisserie, en forme de cigare, est enrobée de miel après friture1.', 'dessert', 0, '', 8690, 1),
(6, 'Images/recipeImages/recipe12.png', NULL, NULL, 0, '00:10', '00:10', '00:35', '', '', 'Basboussa', 'asboussa ou Besboussa une délicieuse pâtisserie orientale, appelée aussi Namoura au Liban. Elle est préparée à base de semoule de sucre et de fruits secs au choix, pour ma part, j’ai choisi la noix de coco. Après cuisson cette pâtisserie est ensuite imbibée de sirop de sucre, qu’on peut aromatiser de cannelle, clous de girofle ou d’eau de fleur d’oranger.', 'dessert', 0, '', 6084, 1),
(5, 'Images/recipeImages/recipe11.png', NULL, NULL, 0, '00:02', '00:00', '00:30', '', '', 'Baba ', 'Le baba au rhum est un savarin servi imbibé d\'un sirop, généralement au rhum, et parfois fourré de crème fouettée ou de crème pâtissière. Il est le plus souvent confectionné en portions individuelles (un cylindre d\'environ 5 cm de haut, légèrement effilé) mais peut parfois être confectionné dans des formes plus grandes semblables à celles utilisées pour les Bundt cakes.', 'dessert', 0, '', 1797, 1),
(4, 'Images/recipeImages/recipe10.png', NULL, NULL, 0, '00:15', '00:00', '00:15', '', '', 'Ktayef', 'Les Qtaief sont une pâtisserie algerienne et orientale à base de cheveux d’anges de miel et de fruits secs. Se déguste le plus souvent pendant le ramadan. La farce est traditionnellement composée d’amandes et de noix, mais l’on peut utiliser d’autres fruits secs tel que les noisettes ou les pistaches.', 'dessert', 4, '', 4703, 1),
(3, 'Images/recipeImages/recipe9.png', NULL, NULL, 0, '00:15', '00:00', '01:00', '', '', 'Kalb El Louz', 'Kalb el louz est une pâtisserie très consistante, à base de semoule, d\'amandes, de fleur d\'oranger et très fondante grâce au sirop de miel (cherbette) dont elle est abondamment arrosée.\n\nElle ressemble dans sa forme à la basboussa du Levant, car elle est carrée et a des ingrédients similaires, mais elle a un goût et une méthode de préparation différents. Dans le passé, elle était farcie uniquement d\'amandes, ce qui est à l\'origine de son nom. De nos jours, les amandes sont remplacées par des cacahuètes, des pistaches ou des noisettes, et même du chocolat ', 'plat', 4, '', 1082, 1),
(19, 'Images/recipeImages/recipe20.png', NULL, NULL, 0, '00:10', '00:00', '00:8', '00:18', '', 'Chocolat chaud au Companion', 'Pour réchauffer, remonter le moral, partager un moment hors du temps ou démarrer la journée du bon pied, le chocolat chaud au Companion est imbattable. Le tout, sans efforts et sans risquer d’attacher ! Lancez-le d’une main, le robot chauffe et mélange pour préparer une boisson chaude divinement mousseuse, onctueuse et parfumée. Huit minutes plus tard, votre chocolat chaud est prêt à déguster.', 'boisson', 0, 'printemps,hiver,automne,etes', 1526, 1),
(20, 'Images/recipeImages/recipe21.png', NULL, NULL, 0, '00:15', '00:00', '00:10', '00:25', '', 'Chocolat viennois caramel au beurre salé et gingembre', 'Pour se réconforter en hiver, rien de tel que ce chocolat épicé! Gingembre ou cannelle vous apporteront un goût incomparable...', 'boisson', 0, 'printemps,hiver,automne,etes', 1526, 1),
(21, 'Images/recipeImages/recipe22.png', NULL, NULL, 0, '00:15', '00:00', '00:15', '00:30', '', 'Cappuccino de potiron en verrines', '', 'boisson', 0, 'printemps,hiver,automne,etes', 1526, 1),
(22, 'Images/recipeImages/recipe23.png', NULL, NULL, 0, '00:10', '00:00', '00:05', '00:15', '', 'Café liégeois', '', 'boisson', 0, 'printemps,hiver,automne,etes', 1526, 1),
(23, 'Images/recipeImages/recipe24.png', NULL, NULL, 0, '00:15', '00:00', '00:15', '00:30', '', 'Ghriba sablé fondant aux noisettes', 'Une recette gourmande de Ghriba sablé fondant aux noisettes (Gâteaux Aid 2022), un savoureux gâteau sec délicieux à souhait, parfumé délicatement à la vanille et garni de noisette. Ces petites gourmandises sont mes préférées, super bonnes et surtout facile et rapide à réaliser. Des biscuits sablés simples mais succulents, à préparer pour l’Aïd el fitr 2022 qui approche à grand pas. Une recette traditionnelle un peu revisitée de cette spécialité pâtissière préparée dans les pays du Maghreb (Algérie, Tunisie et au Maroc), l’Égypte et dans le Proche-Orient. La texture des ces biscuits est ultra friable aux saveurs de noisettes qu’apporte la purée de noisettes maison !', 'dessert', 0, 'printemps,hiver,automne,etes', 1526, 1),
(24, 'Images/recipeImages/recipe25.png', NULL, NULL, 0, '00:15', '00:00', '00:15', '00:30', '', 'Ghriba sablé fondant aux noisettes', 'Une recette gourmande de Ghriba sablé fondant aux noisettes (Gâteaux Aid 2022), un savoureux gâteau sec délicieux à souhait, parfumé délicatement à la vanille et garni de noisette. Ces petites gourmandises sont mes préférées, super bonnes et surtout facile et rapide à réaliser. Des biscuits sablés simples mais succulents, à préparer pour l’Aïd el fitr 2022 qui approche à grand pas. Une recette traditionnelle un peu revisitée de cette spécialité pâtissière préparée dans les pays du Maghreb (Algérie, Tunisie et au Maroc), l’Égypte et dans le Proche-Orient. La texture des ces biscuits est ultra friable aux saveurs de noisettes qu’apporte la purée de noisettes maison !', 'dessert', 0, 'printemps,hiver,automne,etes', 1526, 1);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `regionId` int(11) NOT NULL,
  `regionNom` varchar(50) NOT NULL,
  UNIQUE KEY `regionId` (`regionId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`regionId`, `regionNom`) VALUES
(1, 'nord'),
(2, 'sud'),
(3, 'est'),
(4, 'ouest');

-- --------------------------------------------------------

--
-- Table structure for table `regionrecipe`
--

DROP TABLE IF EXISTS `regionrecipe`;
CREATE TABLE IF NOT EXISTS `regionrecipe` (
  `regionRecipeId` int(11) NOT NULL,
  `recipeId` int(11) NOT NULL,
  `regionId` int(11) NOT NULL,
  UNIQUE KEY `regionRecipeId` (`regionRecipeId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regionrecipe`
--

INSERT INTO `regionrecipe` (`regionRecipeId`, `recipeId`, `regionId`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 2, 1),
(26, 29, 3),
(27, 29, 4),
(28, 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

DROP TABLE IF EXISTS `save`;
CREATE TABLE IF NOT EXISTS `save` (
  `SaveID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`SaveID`),
  KEY `FK_2` (`RecipeID`),
  KEY `FK_3` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`SaveID`, `RecipeID`, `UserID`) VALUES
(2, 6, 1),
(1, 8, 1),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `step`
--

DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
  `StepID` int(11) NOT NULL,
  `StepNumber` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL,
  `StepDescription` text NOT NULL,
  PRIMARY KEY (`StepID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`StepID`, `StepNumber`, `RecipeID`, `StepDescription`) VALUES
(1, 1, 2, 'faites revenir l\'oignon haché dans un peu d\'huile d\'olive jusqu\'à ce qu\'il devient translucide.'),
(2, 2, 2, 'ajoutez les morceaux de viande lavé et séché et laissez bien revenir.'),
(3, 3, 2, 'ajoutez le laurier, et assaisonez de sel et poivre noir, ajoutez la cannelle le paprika et le concentré de tomate.'),
(4, 4, 2, 'nettoyez les carottes et coupez les en rondelles.'),
(5, 5, 2, 'ajoutez à la viande et couvrez le tout d eau bouillante ( j utilise ici une cocotte minute, donc je ne mets pas trop d eau car la cuisson de la viande va être plus rapide)\r\n'),
(6, 6, 2, 'epluchez les pommes de terre et coupez les en grand quartiers'),
(7, 7, 2, 'quand la viande est presque cuite et tendre, ajoutez la pomme de terre.'),
(8, 8, 2, 'laissez bien cuire les pommes de terre.'),
(9, 9, 2, 'quand la sauce est bien onctueuse, retirez du feu, et régalez vous.'),
(10, 1, 3, 'Mélanger la farine de pois chiche ainsi que le sel dans un grand saladier'),
(11, 2, 3, 'Ajouter l’eau et mixer le tout.'),
(12, 3, 3, 'Dans un autre saladier ajouter les oeufs ainsi que le lait bien fouetter le tout.'),
(13, 4, 3, 'Verser dans la préparation de pois chiche et eau. Ajouter la moutarde et l’huile + (2 portion fromage vache qui rit) et bien mélanger (on peut mélanger au mixer). Couvrir et laisser reposer 1h'),
(14, 5, 3, 'Entre temps préchauffer le four à 200 C et placer un moule (en pyrex pour moi) pour le chauffer.'),
(15, 6, 3, 'Huiler le moule et verser la préparation. Ajouter 2 c-a-soupe d’huile et mélanger à la fourchette.'),
(16, 7, 3, 'Cuire durant 20 minutes (30 minutes pour moi tout dépend du four) dans un four à chaleur tournante (si vous n’avez pas de four à chaleur tournante en fin de cuisson allumer le grill).'),
(17, 1, 1, 'D’abord dans un verre à thé mettre la levure boulangère et le sucre puis le remplir d’eau tiède mélanger puis laisser agir 2 minutes environ le temps de préparer les autres ingrédients .'),
(18, 2, 1, 'Ensuite dans un grand bol, mettre la semoule fine, la farine, le sel mélanger à l’aide d’un fouet.'),
(19, 3, 1, 'Puis ajouter le mélange levure boulangère-sucre-eau et les deux verres à thé d’eau tiède'),
(20, 4, 1, 'Une fois le mélange est devenu homogène ajouter la levure chimique et mélanger .'),
(21, 5, 1, 'Après faire chauffer une poêle anti-adhésive, y verser l’équivalent d’une petite louche de pâte et laisser cuire la crêpe à feu moyen'),
(22, 6, 1, 'La crêpe est cuite lorsque toute la surface est recouverte de petits trous réguliers.'),
(23, 7, 1, 'Ensuite retirer la crêpe, essuyer la poêle et recommencer l’opération jusqu’à épuisement des ingrédients.'),
(24, 8, 1, 'Enfin disposer les baghrir après chaque cuisson sur un linge propre et les tartiner d’un peu de beurre tant qu’ils sont encore chauds pour qu’ils ne se dessèchent pas.'),
(25, 1, 9, 'gwf'),
(26, 1, 4, 'Mélangez la semoule, le beurre et le sucre. Bien sabler avec les mains'),
(27, 2, 4, 'Lancez la cuisson du sirop : Dans une grande casserole, mettre l’eau, le sucre . Portez à ébullition pendant 15 minutes'),
(28, 3, 4, 'Beurrez un moule de 24 cm et mettez-y votre'),
(29, 4, 4, 'Découpez à l’aide d’un couteau des carrés ou losanges et Piquez les carrés avec les amandes entières'),
(30, 5, 4, 'Enfournez dans un four préchauffé à 200°c pendant 1 heure, en tournant le plateau de temps en temps'),
(31, 6, 4, 'Dés sa sortie du four, arrosez avec le sirop'),
(32, 1, 5, 'Mélanger les amandes en poudre avec le sucre et un peu d\'eau de fleur d\'oranger'),
(33, 2, 5, 'Badigeonner généreusement de smen fondu le fond d\'un moule rond, pas trop profond'),
(34, 3, 5, 'Ouvrir un peu avec les doigts, les deux boules de ktayef pour les aérer.'),
(35, 4, 5, 'Saupoudrer les amandes en couche sur toute la surface et Arroser d\'eau de fleur d\'oranger, saupoudrer de cannelle et recouvrir avec la seconde couche de ktayef.'),
(36, 5, 5, 'Tasser encore un peu et arranger les bords avant d\'arroser de smen et Mettre au four 5-6 mn pour que la galette se tienne, puis la sortir et la retourner sur une assiette.'),
(37, 6, 5, 'Badigeonner encore une fois le fond du moule'),
(38, 7, 5, 'Remettre au four et laisser cuire, à four moyen. Entre temps, péparer un sirop et Sortir la galette du four quand elle a une jolie couleur dorée'),
(39, 8, 5, 'Remettre au four et laisser cuire, à four moyen. Entre temps, péparer un sirop'),
(40, 9, 5, 'Arroser la galette du mélange sirop/miel et la laisser 1h avant de la retourner. Laisser encore 1h pour qu\'elle s\'imprègne bien de miel, avant de la découper en carrés de la même taille et de la déguster.'),
(41, 1, 6, 'Préchauffez le four à 170°C'),
(42, 2, 6, 'Commencez par fouetter le sucre, les oeufs entiers et la vanille avec un batteur, le mélange doit doubler de volume et être bien mousseux'),
(43, 3, 6, 'Ajoutez l\'huile (ou du beurre fondu) et fouettez encore 1 minute'),
(44, 4, 6, 'Tamiser la farine, le sel et le levure chimique et mélangez délicatement avec une spatule'),
(45, 5, 6, 'Versez dans un moule à baba beurré ou dans des moules à muffin pour une version individuelle'),
(46, 6, 6, 'Enfournez pour 35-40 minutes à 170°C pour la version familiale, et 20 minutes pour les muffins'),
(47, 7, 6, 'Préparez le sirop 15 minutes avant la fin de la cuisson : faites un caramel dans une casserole chaude en mettant le sucre à fondre. Dès qu\'il prend une jolie couleur ambrée, retirer du feu. Ajoutez alors l\'eau bouillante en faisant très attention aux éclaboussures, et remettez sur le feu pour que le caramel fonde bien.'),
(48, 1, 7, 'On commence par préparer le sirop pour avoir le temps de tiédir. Mélanger l\'eau et le sucre dans une casserole, la mettre sur le feu puis laisser frémir une quinzaine de minutes, éteindre le feu pour enfin introduire l\'eau de fleur d\'oranger.'),
(49, 2, 7, 'Dans un saladier mélanger les ingrédients secs, à savoir, farine, semoule, levure, noix de coco et sucre.'),
(50, 3, 7, 'Dans un autre saladier, mélanger les oeufs, le lait et l\'huile, les introduire dans le premier mélange.'),
(51, 4, 7, 'Verser ce mélange dans un plat rectangulaire, le faire cuire au four à 180°C (350° F), la pointe d\'un couteau doit en ressortir sèche.'),
(52, 5, 7, 'Dès sa sortie du four, verser le sirop qui doit être impérativement tiède et laisser le gâteau absorber.'),
(53, 6, 7, 'Laissez le gâteau refroidir avant de le découper sinon il s\'effrite.'),
(54, 1, 8, 'Dans un saladier, mélanger les amandes, cannelle, le sucre.'),
(55, 2, 8, 'Ajouter l\'eau de fleur d\'oranger et le beurre fondu.'),
(56, 3, 8, 'Travailler bien jusqu’à obtenir une pâte maniable.'),
(57, 4, 8, 'Prélever de petites boules de pâte d\'amande, les rouler entre les mains pour former un bâtonnet, les déposer dans les feuilles de brick.'),
(58, 5, 8, 'Rouler les feuilles de brick pour former des cigares ou façonner des Briouates et Chauffer une petite quantité d\'huile et aussi le miel additionné d\'une c-a-soupe d\'eau de fleur d\'oranger.'),
(59, 6, 8, 'Plonger les cigares dans l\'huile chaude jusqu’à obtenir une couleur dorée (les faire dorer de tous les cotés ).'),
(60, 7, 8, 'Les égoutter dans une passoire et les plonger dans un miel chauffé.'),
(61, 1, 10, 'Moulez le riz avec le moulin à café et Versez le lait dans une casserole'),
(62, 2, 10, 'Ajoutez le sucre et les farines de riz obtenues'),
(63, 3, 10, 'Mettez sur feu douxMélangez en continu à l\'aide d\'une cuillère en bois, ( une trentaine de minutes à peut près )'),
(64, 4, 10, 'Retirez du feu et ajoutez la fleur d\'oranger et Mélangez bien'),
(65, 5, 10, 'Versez la préparation dans des ramequins ou des verrines Lissez la surface à l\'aide du dos d\'une petite cuillère'),
(66, 4, 11, 'Après ajoutez le lait chaud lentement au mélange tout en fouettant puis Remettez votre mélange dans la casserole puis portez doucement à ébullition en fouettant continuellement jusqu’à ce qu’il soit épais et crémeux et Retirez la casserole du feu et laissez-la refroidir'),
(67, 5, 11, 'Chauffez votre four à 180° et beurrez vos moules à mini tartes et Farinez un plan de travail, abaissez votre pâte avec le rouleau, étalez-la dans les moules et piquez le fond avec une fourchette'),
(68, 6, 11, 'Ensuite déposez en dessus des morceaux de papier sulfurisé avec un poids – haricots secs – et mettez au four pour 12 minutes'),
(69, 7, 11, 'Après retirez les haricots et le papier sulfurisé puis remettez au four pour une autre cuisson de 12 minutes, jusqu’à ce que la pâte soit dorée.'),
(70, 8, 11, 'Une fois votre pâte est cuite laissez-les refroidir complètement.et remplissez-les avec la crème pâtissière et lissez la surface avec une cuillère ou une spatule.'),
(71, 9, 11, 'Ensuite disposez en dessus votre sélection de tranches de fruits. et Enfin voila votre mini tartelette aux fruits, servez et bon appétit à tous'),
(72, 4, 12, 'Coupez le bout des biscuits afin qu \'ils adhèrent parfaitement à la paroi de votre plat. Utilisez les bouts pour compléter les trous au centre de votre tiramisu. Étalez une couche de crème au mascarpone au fond du plat, puis placez une couche de biscuits légèrement imbibés de café à l\' Amaretto.'),
(73, 1, 19, 'Dans un fait-tout, faites chauffer l’huile et l’ail écrasé, rajoutez les pommes de terre épluchées et coupées en quartiers ou en rondelles.Ajoutez le paprika, le poivre, salez.'),
(74, 2, 19, 'Incorporez la moitié du pouliot haché ou laissez les feuilles entières (selon goût) et faites revenir quelques instants jusqu’à ce que les pommes de terre commencent à romollir.'),
(75, 3, 19, 'Arrosez d’eau (pas trop car à la fin la sauce doit être réduite) et laissez cuire à couvert.Juste avant la fin de cuisson, introduisez le reste de pouliot.Récupérez une louche de sauce, laissez refroidir.'),
(76, 4, 19, 'Dès que le plat est prêt diluez le jaune d’oeuf dans la louche de sauce refroidie, versez sur les pommes de terre.Remuer et cuire encore quelques secondes et ce afin de lier la sauce, mais vous pouvez ne pas le rajouter et servir ainsi vos pommes de terre.'),
(77, 1, 15, 'Émincer l\'oignon et écraser l\'ail au presse ail. Faire cuire 15 minutes avec l\'huile et une cuillère à soupe d\'eau.'),
(78, 2, 15, 'Plonger les tomates dans une casserole d\'eau bouillante pendant 15 secondes et les sortir. Les éplucher, les couper en 6 et retirer la pulpe.'),
(79, 3, 15, 'Éplucher les poivrons en les plaçant 15 minutes sous le grill du four. Les nettoyer et les couper en petites lamelles.'),
(80, 4, 15, 'Ajouter les tomates et les poivrons dans la cocotte, saler et poivrer. Laisser mijoter environ 30 minutes.'),
(81, 5, 15, 'Au moment de servir, casser les oeufs sur les légumes et laisser cuire quelques minutes.'),
(82, 1, 16, 'Lavez les courgettes sans les éplucher.Essuyez - les et coupez - les en rondelles de 1 cm ou en gros cubes.'),
(83, 2, 16, 'Faites - les cuire 15 à 18 minutes dans 3 litres d \'eau bouillante salée. Égouttez dans une passoire et pressez-les avec une écumoire pour extraire le trop plein d\' eau.'),
(84, 3, 16, 'Versez les courgettes dans un plat à gratin beurré.Hachez - les grossièrement à la fourchette.'),
(85, 4, 16, 'Dans un saladier,battez les oeufs en omelette,ajoutez la crème,le gruyère râpé,le sel,le poivre et saupoudrez de muscade râpée.'),
(86, 1, 17, 'Piler les fleurs de lavande et les feuilles des  autres herbes, bien lavez. Égoutter les de leur eau, et passer au mixeur.'),
(87, 2, 17, 'Mettre dans une bassine, couvrir d\'eau, et laisser infuser toutes la nuit. Au matin presser les herbe. Réserver l\'eau.'),
(88, 3, 17, 'Dans une Djefna mettre une quantité de semoule, ajouter une poignée du mélange herbes et commencer à rouler pour former les petites graines du couscous, mouiller un peu avec l\'eau réserver.'),
(89, 4, 17, 'Passer une première fois au tamis  2-3 mm de diamètre.'),
(90, 5, 17, 'Frotter les graines du couscous avec les deux paumes de la mains, passer une 2ème fois dans un tamis, diamètre plus petits, Réserver de coté.'),
(91, 6, 17, 'recommencer les opérations 3-4-5 jusqu\'à épuisement de la semoule et des herbes. huiler à l\'huile.'),
(92, 7, 17, 'remplir le bas du couscoussier (kadra) avec l\'eau réserver,  mettre sur le feu, à ébullition, mettre le couscoussier rempli de couscous au dessus et faire cuire à la vapeur. Recommencer 4 fois l\'opération.'),
(93, 8, 17, 'Une fois terminer, huiler à l\'huile et servie avec du sucre cristallisé, sucre glace, du lait caillé ou du petit lait.'),
(94, 1, 20, 'Installez la lame pour pétrir et concasser puis déposez 40 g de chocolat dans le bol du Companion. Mixez 30 sec en vitesse 12, puis réservez\r\n'),
(95, 2, 20, 'Cassez le reste de chocolat dans le bol, ajoutez le lait et la vanille. Lancez 8 min à 95°C en vitesse 5.'),
(96, 3, 20, 'Mixez 20 sec en vitesse 11 pour faire mousser le mélange, puis versez-le dans des mugs ou des bols. Saupoudrez de chocolat râpé et dégustez sans attendre.'),
(97, 1, 23, 'Préparation de la chantilly: faire dissoudre le sucre dans la crème et verser dans un siphon. Enclencher la cartouche de gaz, secouer et réserver au frais pendant une heure minimum.'),
(98, 2, 23, 'Préparation du caramel : Verser le sucre dans une casserole et laisser fondre jusqu\'à caramélisation légère. Ajouter le beurre salé. Mélanger bien et ajouter doucement la crème liquide.'),
(99, 3, 23, 'Préparation du chocolat chaud : Faire chauffer le lait et la crème. Ajouter le chocolat râpé et le cacao et fouetter jusqu\'à l\'obtention d\'un chocolat onctueux. Servir bien chaud surmonté de chantilly, d\'une cuillère de caramel au beurre salé et saupoudré de gingembre.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Mail` varchar(45) NOT NULL,
  `Sexe` varchar(20) NOT NULL,
  `Birthday` date NOT NULL,
  `ProfilPicture` varchar(100) NOT NULL,
  `valider` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Nom`, `Prenom`, `Mail`, `Sexe`, `Birthday`, `ProfilPicture`, `valider`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', 'male', '1998-05-02', 'Images/profilePictures/profilePicture1.jpg', 1),
(3, 'AbdouBou', 'abdou', 'Abderrhmane', 'Boucenna', 'ja_boucenna@esi.dz', 'male', '2002-03-10', 'Images/profilePictures/profilePicture1.jpg', 1),
(2, 'Bossama', 'oussama', 'Oussama', 'Hadj Aissa Fekhar', 'jo_hadjaissafekhar@esi.dz', 'male', '2001-01-01', 'Images/profilePictures/profilePicture1.jpg', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
