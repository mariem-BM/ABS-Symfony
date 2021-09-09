-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2021 at 12:18 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abs3`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `publication_date` datetime DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `readmore` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `picture`, `title`, `content`, `publication_date`, `last_update_date`, `is_published`, `readmore`, `slug`) VALUES
(3, 'imgpsh_fullsize_anim-6138c0e409d52.png', '1st insight', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', NULL, NULL, 1, 'Read more', ''),
(4, 'ia-61386ebd3bcbb.svg', '2nd insight', 'Lorem Ipsum is simply dummy\r\ntext of the printing Lorem Ipsum is simply dummy\r\ntext of the printing ….', NULL, NULL, 1, 'Read more...', ''),
(5, 'moteurrecommandation700-61386ecdcf4d4.svg', '3rd insight', 'Lorem Ipsum is simply dummy\r\ntext of the printing Lorem Ipsum is simply dummy\r\ntext of the printing ….', NULL, NULL, 1, 'Read more...', ''),
(6, 'tech-61386f495f856.svg', '.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco', NULL, NULL, 1, 'Read more...', ''),
(7, 'ia-6136309e662fa.png', '..', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco', NULL, NULL, 1, 'ili yji', ''),
(8, 'moteurrecommandation700-61386f63ab26b.svg', '...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labo', NULL, NULL, 1, 'Read more...', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210901192209', '2021-09-03 09:19:03', 440);

-- --------------------------------------------------------

--
-- Table structure for table `formulaire`
--

DROP TABLE IF EXISTS `formulaire`;
CREATE TABLE IF NOT EXISTS `formulaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `pagesdetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_pages` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `titre`, `description`, `pagesdetails`, `img_pages`) VALUES
(4, 'Artificial Intelligence', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\naccusantium doloremque laudan\r\ntium totam rem aperiam.', 'Work with us', 'group13328-6130a190ce1f4.png'),
(5, 'Expert & solid team for happy clients', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\naccusantium doloremque laudan\r\ntium totam rem aperiam', 'See Our Story', 'group1290-6138e07bcbeef.png'),
(6, 'REVOLUTIONS BRING DISRUPTIONS AND DISRUPTIONS BRING OPPORTUNITIES', 'REVOLUTIONS BRING DISRUPTIONS AND DISRUPTIONS BRING OPPORTUNITIES', 'Work with us', 'slider1-61386a7ea4f67.svg'),
(7, 'International Digital Services Company (ESN)', 'Founded in 2012, ABSHORE has a rich and varied experience in the\r\nprovision of services and participates in all phases of the project, from the\r\nstudy of needs to maintenance, including design, development,\r\ndeployment and construction. \'exploitation.\r\n\r\nABSHORE supports its clients in the areas of Performance Management,\r\nDigital Transformation and Big Data.\r\n\r\nEstablished in Tunisia and France, ABSHORE contributes to major\r\ninternational account projects, and offers its services both nearshore and\r\non site with its partners and customer', 'See our Story', '4-6138e08a15d59.png'),
(8, 'Asma Brini                                Chief  executive officer', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque\r\n            laudan tium totam rem aperiam.\r\n            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque\r\n            laudan tium totam rem aperiam.', 'See the Team', 'icon1-613880d6c3103.png'),
(9, 'CONTACT US', 'ABSHORE TUNISIE\r\n6, rue du Lac Tibériade – 1er étage\r\nBureau N°02, 1053 Les Berges du Lac,\r\nTunis, Tunisie', 'Get direction', 'placeholder-6130af78361e8.png'),
(10, 'CONTACT US', 'ABSHORE FRANCE\r\n41 Rue de la Découverte, 31670 ,\r\nLabège, France', 'Get direction', 'placeholder-6130c4cb5281d.png');

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

DROP TABLE IF EXISTS `references`;
CREATE TABLE IF NOT EXISTS `references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `references`
--

INSERT INTO `references` (`id`, `ref_nom`, `img_ref`) VALUES
(8, 'biat', 'logo_biat_fr_3150x150-61386da84e47e.svg'),
(9, 'orange', 'orangelogovector150x150-61386ddb05804.svg'),
(10, 'Fitting Box', 'logofittingbox150x150-61386dea282a3.svg'),
(11, 'TFI', 'tf1-61386df385b75.svg'),
(12, 'SFR', 'sfrlogo150x150-61386dfde87ad.svg'),
(13, 'FIFA', 'fifalogo150x150-61386e090618b.svg'),
(17, 'orange2', 'orangelogovector150x150-61386e121d531.svg'),
(18, 'Fitting Box2', 'logofittingbox150x150-61386e1dc86b7.svg'),
(19, 'biat2', 'logo_biat_fr_3150x150-61386e2709d3d.svg'),
(20, 'fifa2', 'fifalogo150x150-61386e327e0b3.svg'),
(21, 'sfr2', 'sfrlogo150x150-61386e3ef0721.svg'),
(22, 'tf12', 'tf1-61386e4913402.svg'),
(23, 'fifa3', 'fifalogo150x150-61386e5570d3b.svg');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `nom`, `description`, `details`, `img`) VALUES
(15, 'data science', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', 'See more', '001process-612e1be2dba9d.png'),
(16, 'Business Intelligence', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', 'See more', '002socialmedia-612e1c433e5ce.png'),
(17, 'Web Design', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', 'See more', '003responsive-612e1c614c1f3.png'),
(18, 'Web developpement', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', 'See more', '007analysis-612e1c8094722.png'),
(19, 'Artifical Intelligence', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', 'See more', '004socialmedia1-612e1c9ec9319.png'),
(20, 'DevOps', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', 'See more', '008computer-612e1cb738c39.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(1, 'mariembenmassoud123@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$S1hxbG1Wb1VWa20vZ0VyOA$zgEq9NdoLr0B8nAd4fZDsBs8NB3Ad58SlDRXY8uw4W0', 'Maryem', 'BM');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
