-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2018 at 01:54 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bygdacasino`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `opprettTransaksjon` (IN `brukerNavn` VARCHAR(255), IN `penger` INTEGER, IN `beskrivelse` VARCHAR(255))  BEGIN
  INSERT INTO transaksjoner (brukernavn, beskrivelse, transaksjon)
  VALUES (brukerNavn, beskrivelse, penger);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brukere`
--

CREATE TABLE `brukere` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `brukernavn` varchar(255) DEFAULT NULL,
  `epost` varchar(255) DEFAULT NULL,
  `fdato` date NOT NULL,
  `penger` mediumint(9) DEFAULT '0',
  `passord` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brukere`
--

INSERT INTO `brukere` (`id`, `brukernavn`, `epost`, `fdato`, `penger`, `passord`) VALUES
(1, 'Xavier', 'augue.id.ante@purusgravidasagittis.co.uk', '1995-01-01', 2779, 'WVC52NGO0PB'),
(2, 'Aristotle', 'sit.amet@dolorquam.org', '1995-01-01', 6025, 'WKK72GLH0WY'),
(3, 'Noble', 'diam.Pellentesque@Etiam.edu', '1995-01-01', 2035, 'FGE49EME1NG'),
(4, 'Lucius', 'augue@loremsit.net', '1995-01-01', 1781, 'LJT78FIC3ZT'),
(5, 'Eagan', 'sem.magna.nec@ultrices.ca', '1995-01-01', 4298, 'VUC21YBV6LS'),
(6, 'Merrill', 'Nunc.lectus@arcu.ca', '1995-01-01', 7797, 'YQL98YLJ5OH'),
(7, 'Leroy', 'risus.odio@milaciniamattis.ca', '1995-01-01', 3190, 'EZA65XHK6QW'),
(8, 'Karleigh', 'in.sodales.elit@accumsanneque.co.uk', '1995-01-01', 9854, 'MLZ35CQE6KL'),
(9, 'Kimberly', 'quis@dapibus.org', '1995-01-01', 5280, 'PLA46AGU8VX'),
(10, 'Lareina', 'velit.eget@urnaUttincidunt.edu', '1995-01-01', 7831, 'ZNQ76FPZ4CR'),
(11, 'Stephen', 'libero@porttitorerosnec.ca', '1995-01-01', 6639, 'RSB75IAI2BJ'),
(12, 'Deacon', 'luctus.sit@vehiculaaliquetlibero.ca', '1995-01-01', 5202, 'KZJ51PKE3MT'),
(13, 'Kareem', 'et.commodo@Curabiturconsequat.co.uk', '1995-01-01', 9965, 'AEM89BXU7KJ'),
(14, 'Justina', 'eu.nibh.vulputate@Nullamlobortisquam.net', '1995-01-01', 45, 'TRR05VFU2JM'),
(15, 'Armand', 'sodales@eunibh.com', '1995-01-01', 8390, 'PDQ75HNY6ZQ'),
(16, 'Calista', 'interdum.ligula@orci.co.uk', '1995-01-01', 7331, 'HJG95QQN1LR'),
(17, 'Ivory', 'arcu.Morbi.sit@aliquetdiamSed.com', '1995-01-01', 3931, 'KJI51HMT8FB'),
(18, 'Mara', 'amet.ante@ipsumdolorsit.ca', '1995-01-01', 2734, 'QMF82ARG2CN'),
(19, 'Gannon', 'nibh.Phasellus@fringillaporttitorvulputate.co.uk', '1995-01-01', 190, 'QQC09GVJ3BN'),
(20, 'Louis', 'natoque@eueros.edu', '1995-01-01', 3410, 'HBV73ZUG6NQ'),
(21, 'Belle', 'eu.enim.Etiam@purusDuiselementum.co.uk', '1995-01-01', 8440, 'MVF51JZV5ZV'),
(22, 'Alfonso', 'Donec.porttitor@feugiat.ca', '1995-01-01', 3679, 'ZVN62RNX2SE'),
(23, 'Tyrone', 'Cras.pellentesque.Sed@rhoncusNullam.ca', '1995-01-01', 8281, 'FTL53RPP7EV'),
(24, 'Lavinia', 'Aenean@antelectus.com', '1995-01-01', 6126, 'ZNI26YTI7NG'),
(25, 'Regan', 'lectus@ligula.edu', '1995-01-01', 6463, 'XWF10SJJ4AH'),
(26, 'Nehru', 'magna.Praesent@duiinsodales.org', '1995-01-01', 3148, 'JDS85BGK5GI'),
(27, 'Audra', 'malesuada.ut@et.ca', '1995-01-01', 4144, 'PDG13FVK2ZK'),
(28, 'Laura', 'magna@magnanecquam.net', '1995-01-01', 5998, 'SQV99OUR6PK'),
(29, 'Sonia', 'sit.amet.diam@magnaDuisdignissim.edu', '1995-01-01', 4725, 'UPZ45BBW1AT'),
(30, 'Uriah', 'lacus@antedictummi.net', '1995-01-01', 916, 'MII19KWQ1DW'),
(31, 'Hadassah', 'Nunc@ullamcorper.co.uk', '1995-01-01', 1334, 'WCO90OQZ3AZ'),
(32, 'Dean', 'augue.malesuada.malesuada@id.co.uk', '1995-01-01', 5904, 'IPT55SXP7AG'),
(33, 'Kirk', 'metus.Vivamus@aliquet.edu', '1995-01-01', 311, 'YNR05JFT4SV'),
(34, 'Byron', 'magnis@ipsumSuspendisse.net', '1995-01-01', 7889, 'NWD44QVK2VI'),
(35, 'Maile', 'Duis.risus.odio@luctus.co.uk', '1995-01-01', 1745, 'IMC88XGB6AA'),
(36, 'Lara', 'euismod.urna@necmauris.org', '1995-01-01', 1045, 'XHX60ZQA3AN'),
(37, 'Tucker', 'hymenaeos@mi.net', '1995-01-01', 1644, 'SOY31QNP8KA'),
(38, 'Mannix', 'consequat@tristiquesenectuset.ca', '1995-01-01', 3506, 'LFS21ZUF7YZ'),
(39, 'Lucius', 'turpis@DonectinciduntDonec.org', '1995-01-01', 2702, 'QPV40GZA1SF'),
(40, 'Sophia', 'vulputate.lacus.Cras@tortor.org', '1995-01-01', 1075, 'YSL84AOG6NG'),
(41, 'Fulton', 'ante.ipsum.primis@lobortis.ca', '1995-01-01', 619, 'IYL43TKW4FY'),
(42, 'Clare', 'gravida.nunc.sed@Praesentinterdumligula.org', '1995-01-01', 6313, 'MQG41XEZ2US'),
(43, 'Dahlia', 'non.hendrerit.id@massaInteger.edu', '1995-01-01', 1978, 'WME97JSV8CU'),
(44, 'Natalie', 'nisi@mienimcondimentum.org', '1995-01-01', 5773, 'KHX89MEV5FD'),
(45, 'Quyn', 'feugiat.metus@disparturient.net', '1995-01-01', 3833, 'LUH24UWT0LC'),
(46, 'Maxine', 'Nunc.mauris.elit@Vestibulumaccumsan.org', '1995-01-01', 1859, 'VEN45TXX3VU'),
(47, 'Kim', 'Suspendisse.dui.Fusce@ategestas.edu', '1995-01-01', 5863, 'RAA22AOV7NF'),
(48, 'Nathan', 'metus@tellusNunclectus.com', '1995-01-01', 4392, 'JEX97AOB4YC'),
(49, 'Celeste', 'Suspendisse.non@vellectus.org', '1995-01-01', 4148, 'UJK51FUV5SQ'),
(50, 'Reece', 'taciti.sociosqu@consequat.com', '1995-01-01', 5918, 'OOD27FKZ9XT'),
(51, 'Skyler', 'rhoncus@estNuncullamcorper.com', '1995-01-01', 8937, 'ABJ52GKL5HP'),
(52, 'Kay', 'mauris@at.com', '1995-01-01', 5174, 'XUU30LLN7OR'),
(53, 'Madison', 'dignissim@Nullamfeugiat.ca', '1995-01-01', 2997, 'HND99DKL0UB'),
(54, 'Sonia', 'volutpat@anequeNullam.com', '1995-01-01', 7247, 'ZTQ11WUG2NB'),
(55, 'Martin', 'a.scelerisque.sed@placerat.org', '1995-01-01', 885, 'OOO71UYU8FK'),
(56, 'Gannon', 'Duis@ornareelit.ca', '1995-01-01', 1959, 'WEL34GKV3RD'),
(57, 'Libby', 'Morbi.non.sapien@maurisaliquameu.org', '1995-01-01', 1117, 'YXP15EXH2MB'),
(58, 'Ira', 'ante.lectus.convallis@seddictum.ca', '1995-01-01', 3546, 'XYR37RVX6HB'),
(59, 'Hanna', 'Aliquam.rutrum.lorem@quamdignissim.edu', '1995-01-01', 2481, 'GXA59HBX7IR'),
(60, 'Abbot', 'Aliquam.nec.enim@lacinia.co.uk', '1995-01-01', 6169, 'STD98UMS4CZ'),
(61, 'Julian', 'euismod.mauris@gravidanuncsed.edu', '1995-01-01', 2342, 'HLJ10ZBT9NQ'),
(62, 'Ray', 'sagittis.augue@convallis.co.uk', '1995-01-01', 8346, 'EFT39QYM1BQ'),
(63, 'Flavia', 'ante.iaculis.nec@Donecdignissim.co.uk', '1995-01-01', 9210, 'QPF41MYZ4DH'),
(64, 'Porter', 'Sed.id@aliquet.co.uk', '1995-01-01', 5303, 'JWQ08DXQ6YH'),
(65, 'Charlotte', 'sem@vitae.edu', '1995-01-01', 3495, 'OSC37JUZ1LO'),
(66, 'August', 'dui.nec.urna@estmauris.com', '1995-01-01', 2394, 'KDF73SXB6ZV'),
(67, 'Justina', 'Duis@etnetus.com', '1995-01-01', 2761, 'NUD31BXX3FG'),
(68, 'Trevor', 'lorem@morbitristiquesenectus.org', '1995-01-01', 1053, 'VRR38BBF6MQ'),
(69, 'Paula', 'nulla.Integer.urna@justoProin.org', '1995-01-01', 1622, 'QBJ41SBD8FG'),
(70, 'Cooper', 'Proin.non@Seddiam.org', '1995-01-01', 2987, 'ECZ72NAK3JP'),
(71, 'Devin', 'ullamcorper.viverra.Maecenas@arcu.ca', '1995-01-01', 4478, 'NQY68BMH0XZ'),
(72, 'Serena', 'Fusce.mi@sedturpis.co.uk', '1995-01-01', 8306, 'UTU03IXO2JM'),
(73, 'Idona', 'Donec@euismod.org', '1995-01-01', 1842, 'XIB36ZTM3GP'),
(74, 'Kenyon', 'lacus.pede@Integervulputate.org', '1995-01-01', 67, 'YTJ57MQH5GO'),
(75, 'Cadman', 'est.ac@rhoncusidmollis.net', '1995-01-01', 6133, 'KNF09SBW2TI'),
(76, 'Chloe', 'Cras.dictum.ultricies@a.com', '1995-01-01', 5819, 'NUM68JML1WO'),
(77, 'Iola', 'at@laoreetliberoet.net', '1995-01-01', 5528, 'VNY07MZC7PS'),
(78, 'Sade', 'ipsum.Suspendisse.sagittis@luctus.ca', '1995-01-01', 114, 'JJA09PSL5NH'),
(79, 'Hyatt', 'et@quamCurabitur.co.uk', '1995-01-01', 4845, 'COI84DBW5TC'),
(80, 'Joel', 'bibendum.Donec@pedenec.com', '1995-01-01', 7789, 'MBH00KDJ9QO'),
(81, 'Nash', 'diam@semsemper.edu', '1995-01-01', 4515, 'AHJ55OLA3EX'),
(82, 'Hamish', 'mi@amagna.net', '1995-01-01', 3327, 'ERJ35ZKQ6CG'),
(83, 'September', 'nunc@sagittissemper.org', '1995-01-01', 2389, 'UZE48EIM4NX'),
(84, 'Elijah', 'lorem.auctor@Etiam.ca', '1995-01-01', 9588, 'QGS94KYR9AE'),
(85, 'Michael', 'neque@Donecdignissim.edu', '1995-01-01', 5472, 'CEW38GHU1DO'),
(86, 'Ryan', 'Donec@seddui.com', '1995-01-01', 2563, 'DWK86ZZH6XO'),
(87, 'Ishmael', 'sit@necurnaet.net', '1995-01-01', 155, 'TBW66UYB6EV'),
(88, 'Indigo', 'Quisque.imperdiet.erat@accumsansedfacilisis.com', '1995-01-01', 1531, 'WEG11MCR9FD'),
(89, 'Karleigh', 'tristique.ac@augueut.co.uk', '1995-01-01', 367, 'KXF20KHJ5DE'),
(90, 'Asher', 'egestas.blandit.Nam@mauris.org', '1995-01-01', 2033, 'ESJ34CLM9AX'),
(91, 'Hiram', 'leo.Morbi.neque@Cras.co.uk', '1995-01-01', 3797, 'FON93GBE3LE'),
(92, 'Bradley', 'venenatis@actellusSuspendisse.org', '1995-01-01', 6960, 'XIU54VAR2VF'),
(93, 'Troy', 'Nullam.feugiat@fermentumfermentum.edu', '1995-01-01', 8781, 'ZIC82JKQ1PB'),
(94, 'Troy', 'ullamcorper@feugiatSednec.co.uk', '1995-01-01', 5127, 'FHY22ADR3QS'),
(95, 'Dai', 'semper.pretium.neque@natoquepenatibuset.com', '1995-01-01', 2765, 'OKE82IJN4ZV'),
(96, 'Harding', 'magna@egetodioAliquam.edu', '1995-01-01', 9796, 'VRS69LGJ5FT'),
(97, 'Quinn', 'feugiat.non@Nuncullamcorpervelit.net', '1995-01-01', 1813, 'JUB14HPE5ZB'),
(98, 'Erasmus', 'Aliquam.auctor@magnanecquam.com', '1995-01-01', 9819, 'TYM22BBZ9HZ'),
(99, 'Sylvester', 'ac.orci.Ut@facilisisvitaeorci.co.uk', '1995-01-01', 5549, 'FBL41QSH6SO'),
(100, 'Camden', 'Suspendisse.sed.dolor@mollisvitaeposuere.com', '1995-01-01', 8932, 'REC96QWN2UY'),
(119, 'Ole', 'ole@gmail.com', '1888-02-22', 8375, '202cb962ac59075b964b07152d234b70'),
(120, 'Per', 'per@gmail.com', '1992-02-22', 23050, '202cb962ac59075b964b07152d234b70'),
(121, 'Danay', 'd@gmail.com', '1774-02-02', 1600, '202cb962ac59075b964b07152d234b70'),
(122, 'Svein', 's@live.no', '1993-02-22', 19550, '202cb962ac59075b964b07152d234b70'),
(123, 'Bjã¸rn', 'bjorn@gmail.com', '1964-06-23', 10400, '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `highscore`
--

CREATE TABLE `highscore` (
  `brukernavn` varchar(100) NOT NULL,
  `spillnavn` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `dato` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `highscore`
--

INSERT INTO `highscore` (`brukernavn`, `spillnavn`, `score`, `dato`) VALUES
('Bjã¸rn', 'Blackjack', 500, '2018-04-20 01:54:12'),
('Bjã¸rn', 'Coinflip', 200, '2018-04-20 01:53:51'),
('Bjã¸rn', 'Jackpot', 1200, '2018-04-20 01:54:28'),
('Danay', 'Blackjack', 2000, '2018-04-20 01:36:42'),
('Danay', 'Coinflip', 100, '2018-04-20 01:37:02'),
('Danay', 'Jackpot', 1200, '2018-04-20 01:37:15'),
('Ole', 'Blackjack', 1050, '2018-04-20 01:33:39'),
('Ole', 'Coinflip', 500, '2018-04-20 01:34:06'),
('Ole', 'Jackpot', 2400, '2018-04-20 01:34:22'),
('Per', 'Blackjack', 1400, '2018-04-20 01:35:13'),
('Per', 'Coinflip', 2000, '2018-04-20 01:35:31'),
('Per', 'Jackpot', 150, '2018-04-20 01:35:40'),
('Svein', 'Blackjack', 2750, '2018-04-20 01:38:17'),
('Svein', 'Coinflip', 2000, '2018-04-20 01:38:41'),
('Svein', 'Jackpot', 300, '2018-04-20 01:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `spill`
--

CREATE TABLE `spill` (
  `spillnavn` varchar(255) NOT NULL,
  `utgitt` tinyint(1) NOT NULL DEFAULT '0',
  `ikon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spill`
--

INSERT INTO `spill` (`spillnavn`, `utgitt`, `ikon`) VALUES
('50Cent', 0, NULL),
('777WIN', 0, NULL),
('Ace of spades', 0, NULL),
('Angels Of Hell', 0, NULL),
('Battlefield and Crime', 0, NULL),
('Battleflight', 0, NULL),
('Bingo', 0, NULL),
('Blackjack', 1, 'BlackJack.png'),
('Blood and Skeletons', 0, NULL),
('Brutalstorm', 0, NULL),
('Century and Galaxy', 0, NULL),
('City and Guns', 0, NULL),
('Coinflip', 1, 'Coinstack.png'),
('Coins Of Arabia', 0, NULL),
('Cybershot', 0, NULL),
('Dataspace', 0, NULL),
('Diamondtime', 0, NULL),
('Dragonpoint', 0, NULL),
('Drømmefangeren', 0, NULL),
('Fire and Honor', 0, NULL),
('Firkløver', 0, NULL),
('Freedom and Mortals', 0, NULL),
('Fruit Fun', 0, NULL),
('Gjett prisen', 0, NULL),
('Godlike', 0, NULL),
('Golden Shower', 0, NULL),
('Harefot', 0, NULL),
('Hestesko', 0, NULL),
('Hit The Joker', 0, NULL),
('Hunt For Silver', 0, NULL),
('Hvem er hvem', 0, NULL),
('Insane Blood', 0, NULL),
('Jackpot', 1, 'spillemaskin.png'),
('Kodebugs', 0, NULL),
('Ladybugs', 0, NULL),
('Lotto', 0, NULL),
('Lucky dice', 0, NULL),
('Lucky seven', 0, NULL),
('Løs gåten', 0, NULL),
('Man Of Fortune', 0, NULL),
('Maze and Force', 0, NULL),
('Mega Crazy Action Experience', 0, NULL),
('Nano Adventures', 0, NULL),
('Party Spin', 0, NULL),
('Poker high stakes', 0, NULL),
('Poker low stakes', 0, NULL),
('Poker medium stakes', 0, NULL),
('Rabbit Smashers 2000', 0, NULL),
('Ran banken', 0, NULL),
('Red evil', 0, NULL),
('Red Jack', 0, NULL),
('Regnbuen', 0, NULL),
('Regularbugs', 0, NULL),
('Roulette', 0, NULL),
('Skeletons and Pain', 0, NULL),
('Soul Money', 0, NULL),
('Space Barrage', 0, NULL),
('Spacetime', 0, NULL),
('Spinnhjulet', 0, NULL),
('Stjerneskudd', 0, NULL),
('Super Lucky Toad', 0, NULL),
('Svindelen', 0, NULL),
('Telleren', 0, NULL),
('Tikkende bombe', 0, NULL),
('Tre på rad', 0, NULL),
('True value', 0, NULL),
('Turkish Nights', 0, NULL),
('Vote or die', 0, NULL),
('Wild South', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksjoner`
--

CREATE TABLE `transaksjoner` (
  `transaksjonsNr` int(8) NOT NULL,
  `brukernavn` varchar(255) NOT NULL,
  `beskrivelse` varchar(255) NOT NULL,
  `transaksjon` int(9) NOT NULL,
  `dato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksjoner`
--

INSERT INTO `transaksjoner` (`transaksjonsNr`, `brukernavn`, `beskrivelse`, `transaksjon`, `dato`) VALUES
(1, 'Ole', 'Innskudd + BONUS', 6500, '2018-04-20 13:33:29'),
(2, 'Ole', 'Blackjack', -525, '2018-04-20 13:33:37'),
(3, 'Ole', 'Blackjack', 1050, '2018-04-20 13:33:39'),
(4, 'Ole', 'Coinflip', -500, '2018-04-20 13:34:02'),
(5, 'Ole', 'Coinflip', -500, '2018-04-20 13:34:03'),
(6, 'Ole', 'Coinflip', 500, '2018-04-20 13:34:06'),
(7, 'Ole', 'Coinflip', -500, '2018-04-20 13:34:08'),
(8, 'Ole', 'Jackpot', -100, '2018-04-20 13:34:15'),
(9, 'Ole', 'Jackpot', 150, '2018-04-20 13:34:18'),
(10, 'Ole', 'Jackpot', -100, '2018-04-20 13:34:19'),
(11, 'Ole', 'Jackpot', 2400, '2018-04-20 13:34:22'),
(12, 'Per', 'Innskudd + BONUS', 20500, '2018-04-20 13:34:57'),
(13, 'Per', 'Blackjack', -1000, '2018-04-20 13:35:04'),
(14, 'Per', 'Blackjack', 1000, '2018-04-20 13:35:06'),
(15, 'Per', 'Blackjack', -700, '2018-04-20 13:35:10'),
(16, 'Per', 'Blackjack', 1400, '2018-04-20 13:35:13'),
(17, 'Per', 'Coinflip', 2000, '2018-04-20 13:35:31'),
(18, 'Per', 'Jackpot', -100, '2018-04-20 13:35:37'),
(19, 'Per', 'Jackpot', 150, '2018-04-20 13:35:40'),
(20, 'Per', 'Jackpot', -100, '2018-04-20 13:35:40'),
(21, 'Per', 'Jackpot', -100, '2018-04-20 13:35:44'),
(22, 'Danay', 'Innskudd + BONUS', 50500, '2018-04-20 13:36:33'),
(23, 'Danay', 'Blackjack', -1000, '2018-04-20 13:36:40'),
(24, 'Danay', 'Blackjack', 2000, '2018-04-20 13:36:42'),
(25, 'Danay', 'Coinflip', -51000, '2018-04-20 13:36:58'),
(26, 'Danay', 'Coinflip', 100, '2018-04-20 13:37:02'),
(27, 'Danay', 'Jackpot', -100, '2018-04-20 13:37:09'),
(28, 'Danay', 'Jackpot', -100, '2018-04-20 13:37:12'),
(29, 'Danay', 'Jackpot', 1200, '2018-04-20 13:37:15'),
(30, 'Svein', 'Innskudd + BONUS', 20500, '2018-04-20 13:37:59'),
(31, 'Svein', 'Blackjack', -700, '2018-04-20 13:38:06'),
(32, 'Svein', 'Blackjack', -600, '2018-04-20 13:38:11'),
(33, 'Svein', 'Blackjack', 600, '2018-04-20 13:38:13'),
(34, 'Svein', 'Blackjack', -1100, '2018-04-20 13:38:17'),
(35, 'Svein', 'Blackjack', 2750, '2018-04-20 13:38:17'),
(36, 'Svein', 'Jackpot', -100, '2018-04-20 13:38:27'),
(37, 'Svein', 'Jackpot', 300, '2018-04-20 13:38:30'),
(38, 'Svein', 'Jackpot', -100, '2018-04-20 13:38:30'),
(39, 'Svein', 'Coinflip', -2000, '2018-04-20 13:38:40'),
(40, 'Svein', 'Coinflip', 2000, '2018-04-20 13:38:41'),
(41, 'Svein', 'Coinflip', -2000, '2018-04-20 13:38:43'),
(42, 'Bjã¸rn', 'Innskudd + BONUS', 10500, '2018-04-20 13:53:44'),
(43, 'Bjã¸rn', 'Coinflip', 200, '2018-04-20 13:53:51'),
(44, 'Bjã¸rn', 'Blackjack', -1000, '2018-04-20 13:54:03'),
(45, 'Bjã¸rn', 'Blackjack', -400, '2018-04-20 13:54:08'),
(46, 'Bjã¸rn', 'Blackjack', -500, '2018-04-20 13:54:11'),
(47, 'Bjã¸rn', 'Blackjack', 500, '2018-04-20 13:54:12'),
(48, 'Bjã¸rn', 'Blackjack', -400, '2018-04-20 13:54:15'),
(49, 'Bjã¸rn', 'Blackjack', 400, '2018-04-20 13:54:17'),
(50, 'Bjã¸rn', 'Jackpot', -100, '2018-04-20 13:54:25'),
(51, 'Bjã¸rn', 'Jackpot', 1200, '2018-04-20 13:54:28');

--
-- Triggers `transaksjoner`
--
DELIMITER $$
CREATE TRIGGER `upd_bruker` BEFORE INSERT ON `transaksjoner` FOR EACH ROW BEGIN
	IF ( NEW.transaksjon >= 5000) THEN
		IF (STRCMP(NEW.beskrivelse, 'Innskudd')=0) THEN
			SET NEW.beskrivelse = 'Innskudd + BONUS';
			SET NEW.transaksjon = NEW.transaksjon + 500;
			UPDATE brukere 
			SET brukere.penger = brukere.penger + NEW.transaksjon
        WHERE brukernavn = NEW.brukernavn;		    
		ELSE 
			UPDATE brukere 
			SET brukere.penger = brukere.penger + NEW.transaksjon
	    	WHERE brukernavn = NEW.brukernavn;
		END IF;
	ELSE UPDATE brukere SET brukere.penger = brukere.penger + NEW.transaksjon
		WHERE brukernavn = NEW.brukernavn;
	END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brukere`
--
ALTER TABLE `brukere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brukernavn` (`brukernavn`);

--
-- Indexes for table `highscore`
--
ALTER TABLE `highscore`
  ADD PRIMARY KEY (`brukernavn`,`spillnavn`);

--
-- Indexes for table `spill`
--
ALTER TABLE `spill`
  ADD PRIMARY KEY (`spillnavn`);

--
-- Indexes for table `transaksjoner`
--
ALTER TABLE `transaksjoner`
  ADD PRIMARY KEY (`transaksjonsNr`),
  ADD KEY `brukernavn` (`brukernavn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brukere`
--
ALTER TABLE `brukere`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `transaksjoner`
--
ALTER TABLE `transaksjoner`
  MODIFY `transaksjonsNr` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksjoner`
--
ALTER TABLE `transaksjoner`
  ADD CONSTRAINT `transaksjoner_ibfk_1` FOREIGN KEY (`brukernavn`) REFERENCES `brukere` (`brukernavn`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `bursdag_bonus` ON SCHEDULE EVERY 1 DAY STARTS '2018-04-16 21:33:55' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	UPDATE brukere
	SET penger = penger + 75
	WHERE (STRCMP(SUBSTRING(fdato, 6, LENGTH(fdato)), SUBSTRING(CURDATE(), 6, LENGTH(CURDATE())) ) = 0);
END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
