-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: d51765.mysql.zonevs.eu
-- Generation Time: Mar 27, 2020 at 01:18 PM
-- Server version: 10.2.31-MariaDB-log
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d51765sd98154`
--

-- --------------------------------------------------------

--
-- Table structure for table `kl_kaigukastid`
--

CREATE TABLE `kl_kaigukastid` (
  `id` int(11) NOT NULL,
  `kaigukast` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kl_kaigukastid`
--

INSERT INTO `kl_kaigukastid` (`id`, `kaigukast`) VALUES
(1, 'Manuaal'),
(2, 'Automaat');

-- --------------------------------------------------------

--
-- Table structure for table `kl_kasutajad`
--

CREATE TABLE `kl_kasutajad` (
  `id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kl_kasutajad`
--

INSERT INTO `kl_kasutajad` (`id`, `username`, `password`, `email`, `admin`) VALUES
(1, 'admin', '$2y$10$sj.zN9D2CdUBg.DjXaYPueaGBRyXft8p5c29ncKDUFScwyzPPGIKe', 'admin@localhost.local', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kl_keretyybid`
--

CREATE TABLE `kl_keretyybid` (
  `id` int(11) NOT NULL,
  `kere` varchar(32) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kl_keretyybid`
--

INSERT INTO `kl_keretyybid` (`id`, `kere`) VALUES
(1, 'Sedaan'),
(2, 'Universaal'),
(3, 'Luukpära'),
(4, 'Kabriolett'),
(5, 'Mahtuniversaal'),
(6, 'Kupee'),
(7, 'Limusiin'),
(8, 'Pikap'),
(9, 'Kombi'),
(10, 'Maastur'),
(11, 'Linnamaastur'),
(12, 'Mikrobuss'),
(13, 'Väikekaubik');

-- --------------------------------------------------------

--
-- Table structure for table `kl_kytused`
--

CREATE TABLE `kl_kytused` (
  `id` int(11) NOT NULL,
  `kytus` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kl_kytused`
--

INSERT INTO `kl_kytused` (`id`, `kytus`) VALUES
(1, 'Bensiin'),
(2, 'Diisel');

-- --------------------------------------------------------

--
-- Table structure for table `kl_ladu`
--

CREATE TABLE `kl_ladu` (
  `id` int(11) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `varuosa_id` int(11) NOT NULL,
  `kirjeldus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kl_margid`
--

CREATE TABLE `kl_margid` (
  `id` int(11) NOT NULL,
  `mark` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kl_margid`
--

INSERT INTO `kl_margid` (`id`, `mark`) VALUES
(1, 'Alfa Romeo'),
(2, 'Audi'),
(3, 'BMW'),
(4, 'Citroen'),
(5, 'Chrysler'),
(6, 'Dacia'),
(7, 'Fiat'),
(8, 'Ford'),
(9, 'GAZ'),
(10, 'Honda'),
(11, 'Hummer'),
(12, 'Hyundai'),
(13, 'Ikarus'),
(14, 'Isuzu'),
(15, 'Jaguar'),
(16, 'Jeep'),
(17, 'Kia'),
(18, 'Lada'),
(19, 'Land Rover'),
(20, 'Lexus'),
(21, 'Mazda'),
(22, 'Mercedes-Benz'),
(23, 'Mitsubishi'),
(24, 'Moskvits'),
(25, 'Nissan'),
(26, 'Opel'),
(27, 'Peugeot'),
(28, 'Renault'),
(29, 'Saab'),
(30, 'SEAT'),
(31, 'Subaru'),
(32, 'Suzuki'),
(33, 'Skoda'),
(34, 'Toyota'),
(35, 'Volkswagen'),
(36, 'Volvo'),
(37, 'Chevrolet'),
(38, 'Dodge'),
(39, 'Daewoo');

-- --------------------------------------------------------

--
-- Table structure for table `kl_pildid`
--

CREATE TABLE `kl_pildid` (
  `id` int(11) NOT NULL,
  `tyyp` int(11) NOT NULL,
  `pilt` longblob NOT NULL,
  `pilt_url` varchar(128) NOT NULL,
  `tyyp_id` int(11) NOT NULL,
  `unix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kl_soidukid`
--

CREATE TABLE `kl_soidukid` (
  `id` int(11) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `mudel` varchar(64) NOT NULL,
  `keretahis` varchar(128) NOT NULL,
  `labisoit` int(11) NOT NULL DEFAULT 0,
  `mootor` varchar(64) NOT NULL,
  `kaigukast` int(11) NOT NULL,
  `kubatuur` int(11) NOT NULL,
  `voimsus` int(11) NOT NULL,
  `uste_arv` int(11) NOT NULL,
  `kere_id` int(11) NOT NULL,
  `valjalaske` varchar(32) NOT NULL,
  `kytus` int(11) NOT NULL,
  `informatsioon` text NOT NULL,
  `lammutatud` tinyint(1) NOT NULL DEFAULT 0,
  `unix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `kl_uudised`
--

CREATE TABLE `kl_uudised` (
  `id` int(11) NOT NULL,
  `unix` int(11) NOT NULL,
  `lisaja` int(11) NOT NULL,
  `pealkiri` varchar(256) NOT NULL,
  `sisu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kl_varuosad`
--

CREATE TABLE `kl_varuosad` (
  `id` int(11) NOT NULL,
  `nimetus` varchar(64) NOT NULL,
  `kirjeldus` text NOT NULL,
  `tootekood` varchar(128) NOT NULL,
  `hind` float NOT NULL,
  `asukoht` varchar(256) NOT NULL,
  `soiduk_id` int(11) NOT NULL,
  `markus` text NOT NULL,
  `unix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kl_varuosanimetused`
--

CREATE TABLE `kl_varuosanimetused` (
  `id` int(11) NOT NULL,
  `nimetus` varchar(128) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kl_varuosanimetused`
--

INSERT INTO `kl_varuosanimetused` (`id`, `nimetus`) VALUES
(1, 'Suunatuli eesmine vasak'),
(2, 'Suunatuli eesmine parem'),
(3, 'Udutuli eesmine vasak'),
(4, 'Udutuli eesmine parem'),
(5, 'Esituli vasak'),
(6, 'Esituli parem'),
(7, 'Iluvõre'),
(8, 'Kapott'),
(9, 'Esipaneel'),
(10, 'Tiib eesmine vasak'),
(11, 'Tiib eesmine parem'),
(12, 'Logar eesmine vasak'),
(13, 'Logar eesmine parem'),
(14, 'Pesur, esituli vasak'),
(15, 'Pesur, esituli parem'),
(16, 'Esikaitseraua tala'),
(17, 'Esikaitseraud komplektne'),
(18, 'Poolraam eesmine vasak'),
(19, 'Poolraam eesmine parem'),
(20, 'Esiklaas'),
(21, 'Radiaator, konditsioneer'),
(22, 'Radiaator, jahutus'),
(23, 'Jahutusventilaator elektriline'),
(24, 'Paisupaak'),
(25, 'Intercooler'),
(26, 'Tagaluuk'),
(27, 'Tagaluugi käepide'),
(28, 'Tagaluugi reflektorpaneel / dekoorpaneel'),
(29, 'Tagatuli tiival vasak'),
(30, 'Tagatuli tiival parem'),
(31, 'Tagatuli luugil vasak'),
(32, 'Tagatuli luugil parem'),
(33, 'Tagakaitseraua tala'),
(34, 'Tagakaitseraud komplektne'),
(35, 'Tagapaneel'),
(36, 'Tiib, tagumine vasak'),
(37, 'Tiib, tagumine parem'),
(38, 'Logar tagumine vasak'),
(39, 'Logar tagumine parem'),
(40, 'Tiivalaiendi tagumine vasak'),
(41, 'Tiivalaiendi tagumine parem'),
(42, 'Veokast'),
(43, 'Veokasti kate'),
(44, 'Tagaklaas'),
(45, 'Tagaluugi lukusti'),
(46, 'Paarisuks vasak'),
(47, 'Paarisuks parem'),
(48, 'Paarisukse klaas vasak'),
(49, 'Paarisukse klaas parem'),
(50, 'Paarisukse lukusti vasak'),
(51, 'Paarisukse lukusti parem'),
(52, 'Kojamehe mootor, tagaklaas'),
(53, 'Kojamehe mootor, paarisuks vasak'),
(54, 'Kojamehe mootor, paarisuks parem'),
(55, 'Haagisekonks'),
(56, 'Astmelaud vasak'),
(57, 'Antenn'),
(58, 'Küljelaiendi vasak'),
(59, 'Kere küljeklaas tagumine vasak'),
(60, 'Tankimisluuk'),
(61, 'Uks eesmine vasak'),
(62, 'Uks tagumine vasak'),
(63, 'Ukseklaas eesmine vasak'),
(64, 'Ukseklaas tagumine vasak'),
(65, 'Lükandukse klaas vasak'),
(66, 'Lükanduks vasak'),
(67, 'Lükandukse klaas vasak'),
(68, 'Lüliti, aknatõstuki pealüliti'),
(69, 'Aknatõstuk kompl. eesmine vasak'),
(70, 'Aknatõstuk kompl. eesmine parem'),
(71, 'Aknatõstuk kompl. tagumine vasak'),
(72, 'Aknatõstuk kompl. tagumine parem'),
(73, 'Ukse käepide välimine eesmine vasak'),
(74, 'Ukse käepide välimine eesmine parem'),
(75, 'Ukse käepide välimine tagumine vasak'),
(76, 'Ukse käepide välimine tagumine parem'),
(77, 'Lükandukse käepide välimine vasak'),
(78, 'Lükandukse käepide välimine parem'),
(79, 'Küljepeegel vasak'),
(80, 'Küljepeegel parem'),
(81, 'Ukselukusti eesmine vasak'),
(82, 'Ukselukusti eesmine parem'),
(83, 'Ukselukusti tagumine vasak'),
(84, 'Ukselukusti tagumine parem'),
(85, 'Lükandukse lukusti vasak'),
(86, 'Lükandukse lukusti parem'),
(87, 'Juhtplokk, mootor'),
(88, 'Lüliti, aknatõstuki pealüliti'),
(89, 'Juhtplokk, käigukast'),
(90, 'Näidikute komplekt'),
(91, 'Displei armatuuris'),
(92, 'Lüliti, püsikiirusehoidja'),
(93, 'Lüliti, pardaarvuti'),
(94, 'Joystick'),
(95, 'Lüliti, estitulede pealüliti'),
(96, 'Lüliti, suunatuled'),
(97, 'Lüliti, kojamehed'),
(98, 'Lülitid, sooja-külma õhu armatuuris'),
(99, 'Lüliti, mf rool vasak'),
(100, 'Lüliti, mf rool parem'),
(101, 'Kaubiku vahesein'),
(102, 'Katuseluuk'),
(103, 'Katuseluugi mootor'),
(104, 'Mütsiriiul / Pagasiruumi kate'),
(105, 'Gaasipedaal'),
(106, 'Rooliratas'),
(107, 'Roolisammas'),
(108, 'Turvapadja kontaktlint'),
(109, 'Põranda jalamatt / komplekt'),
(110, 'Põranda jalamatt / juhi'),
(111, 'Käetugi eesmine'),
(112, 'Istmed komplekt'),
(113, 'Tagaiste / ühekohaline'),
(114, 'Juhiiste'),
(115, 'Kindalaegas'),
(116, 'Armatuurlaud'),
(117, 'Õhurest salongis eesmine vasak'),
(118, 'Õhurest salongis eesmine parem'),
(119, 'Õhurest salongis eesmine keskmine'),
(120, 'Salongivalgustus ees'),
(121, 'Tahavaatepeegel salongis'),
(122, 'Laepolster'),
(123, 'Autotelefon'),
(124, 'Tüüner, tv'),
(125, 'Tüüner, raadio'),
(126, 'Raadio'),
(127, 'CD vahetaja / box'),
(128, 'Gps navigaator plaadilugeja'),
(129, 'Turvavöö eesmine vasak'),
(130, 'Turvavöö eesmine parem'),
(131, 'Turvavöö tagumine vasak'),
(132, 'Turvavöö tagumine keskmine'),
(133, 'Turvavöö tagumine parem'),
(134, 'Turvavöö vastus eesmine vasak'),
(135, 'Turvavöö vastus eesmine parem'),
(136, 'Turvavöö vastus tagumine vasak'),
(137, 'Turvavöö vastus tagumine parem'),
(138, 'Turvavöö vastus tagumine keskm.'),
(139, 'Turvakardin vasak'),
(140, 'Turvakardin parem'),
(141, 'Turvapadi, rool'),
(142, 'Juhtplokk, turvapadi'),
(143, 'Salongi ventilaator'),
(144, 'Salongi ventilaatori reostaat'),
(145, 'Süütelukk'),
(146, 'Süüteluku kontaktplaat'),
(147, 'Käiguvahetushoovastik / tross'),
(148, 'Käiguvahetusmehhanism / kuliss'),
(149, 'Käigukangi nahk'),
(150, 'Käigukangi nupp'),
(151, 'Tungraud'),
(152, 'Kaitsmekarp'),
(153, 'Esisilla õõtshoob alumine vasak'),
(154, 'Esisilla õõtshoob alumine parem'),
(155, 'Esisilla õõtshoob ülemine vasak'),
(156, 'Esisilla õõtshoob ülemine parem'),
(157, 'Amortisaator eesmine vasak'),
(158, 'Amortisaator eesmine parem'),
(159, 'Käändtelg eesmine vasak'),
(160, 'Käändtelg eesmine parem'),
(161, 'Rummulukk eesmine vasak'),
(162, 'Rummulukk eesmine parem'),
(163, 'Vedru eesmine vasak'),
(164, 'Vedru eesmine parem'),
(165, 'Stabilisaatori varras esisild'),
(166, 'Tala, esisild'),
(167, 'Roolilatt / Roolikarp'),
(168, 'Pidurisuport eesmine vasak'),
(169, 'Pidurisuport eesmine parem'),
(170, 'Veovõll eesmine vasak'),
(171, 'Veovõll eesmine parem'),
(172, 'Diferentsiaal esisild'),
(173, 'Tala, tagasild'),
(174, 'Tagasilla õõtshoob alumine vasak'),
(175, 'Tagasilla õõtshoob alumine parem'),
(176, 'Tagasilla õõtshoob ülemine vasak'),
(177, 'Tagasilla õõtshoob ülemine parem'),
(178, 'Amortisaator tagumine vasak'),
(179, 'Amortisaator tagumine parem'),
(180, 'Käändtelg tagumine vasak'),
(181, 'Käändtelg tagumine parem'),
(182, 'Vedru tagumine vasak'),
(183, 'Vedru tagumine parem'),
(184, 'Stabilisaatori varras tagasild'),
(185, 'Pidurisuport tagumine vasak'),
(186, 'Pidurisuport tagumine parem'),
(187, 'Diferentsiaal tagasild'),
(188, 'Veovõll tagumine vasak'),
(189, 'Veovõll tagumine parem'),
(190, 'Väljalaskekollektor'),
(191, 'Sisselaskekollektor'),
(192, 'Kütusepump diisel'),
(193, 'Pihusti'),
(194, 'Segusiiber'),
(195, 'Andur, nukkvõlli asend'),
(196, 'Andur, väntvõlli asend'),
(197, 'Süütepool'),
(198, 'Jagaja'),
(199, 'Generaator'),
(200, 'Starter'),
(201, 'Konditsioneeri kompressor'),
(202, 'Turbo'),
(203, 'Mootor'),
(204, 'Mootori kate'),
(205, 'Rihmaratas, väntvõll'),
(206, 'Rihmapinguti'),
(207, 'Roolivõimendi pump'),
(208, 'Hooratas'),
(209, 'Õhk / Nivoovedrustuse kompressor'),
(210, 'ABS agregaat (pump+juhtplokk)'),
(211, 'Pidurivõimendi'),
(212, 'Pidurivedeliku paak'),
(213, 'Piduri peasilinder'),
(214, 'Kütuserõhu regulaator'),
(215, 'Õhukulumõõtja'),
(216, 'Õhupuhasti (õhufiltri korpus)'),
(217, 'Õhuresonaator'),
(218, 'Akukast'),
(219, 'Kaitsmekarp'),
(220, 'Kondits. toru radiaatorist kompressorisse'),
(221, 'Kondits. toru kompressorist kuivatisse'),
(222, 'Kondits. toru kuivatist salongi'),
(223, 'Kondits. toru salongist radiaatorisse'),
(224, 'Lisasoojendusseade'),
(225, 'EGR klapp'),
(226, 'Roolivõimendi õli paak'),
(227, 'Kojameeste mootor, esiklaas'),
(228, 'Pesuripump, esiklaas'),
(229, 'Kojamehe vars, esiklaas vasak'),
(230, 'Kojamehe vars, esiklaas parem'),
(231, 'Kojameeste mehhanism, esiklaas'),
(232, 'Käigukast'),
(233, 'Vahekast'),
(234, 'Katus'),
(235, 'Katusereelingud kompl.'),
(236, 'Katusereelingu ristitala'),
(237, 'Suusaboks'),
(238, 'Antenn'),
(239, 'Summuti tagumine'),
(240, 'Summuti eesmine'),
(241, 'Summuti keskmine'),
(242, 'Heitgaaside jahuti'),
(243, 'Kütuse jahuti'),
(244, 'Kere alusraam'),
(245, 'Kardaan komplektne'),
(246, 'Kütusepaak'),
(247, 'Varuratta hoidik kere all'),
(248, 'Mootoriruumi põhjakaitse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kl_kaigukastid`
--
ALTER TABLE `kl_kaigukastid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_kasutajad`
--
ALTER TABLE `kl_kasutajad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_keretyybid`
--
ALTER TABLE `kl_keretyybid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_kytused`
--
ALTER TABLE `kl_kytused`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_ladu`
--
ALTER TABLE `kl_ladu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_margid`
--
ALTER TABLE `kl_margid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_pildid`
--
ALTER TABLE `kl_pildid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_soidukid`
--
ALTER TABLE `kl_soidukid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_uudised`
--
ALTER TABLE `kl_uudised`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_varuosad`
--
ALTER TABLE `kl_varuosad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kl_varuosanimetused`
--
ALTER TABLE `kl_varuosanimetused`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kl_kaigukastid`
--
ALTER TABLE `kl_kaigukastid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kl_kasutajad`
--
ALTER TABLE `kl_kasutajad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kl_keretyybid`
--
ALTER TABLE `kl_keretyybid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kl_kytused`
--
ALTER TABLE `kl_kytused`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kl_ladu`
--
ALTER TABLE `kl_ladu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kl_margid`
--
ALTER TABLE `kl_margid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kl_pildid`
--
ALTER TABLE `kl_pildid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kl_soidukid`
--
ALTER TABLE `kl_soidukid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kl_uudised`
--
ALTER TABLE `kl_uudised`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kl_varuosad`
--
ALTER TABLE `kl_varuosad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kl_varuosanimetused`
--
ALTER TABLE `kl_varuosanimetused`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
