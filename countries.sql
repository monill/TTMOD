-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 15-Fev-2018 às 18:32
-- Versão do servidor: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `track`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `iso_code` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso_code`) VALUES
(1, 'Afghanistan', 'AFG'),
(2, 'Åland Islands', 'ALA'),
(3, 'Albania', 'ALB'),
(4, 'Algeria', 'DZA'),
(5, 'American Samoa', 'ASM'),
(6, 'Andorra', 'AND'),
(7, 'Angola', 'AGO'),
(8, 'Anguilla', 'AIA'),
(9, 'Antarctica', 'ATA'),
(10, 'Antigua and Barbuda', 'ATG'),
(11, 'Argentina', 'ARG'),
(12, 'Armenia', 'ARM'),
(13, 'Aruba', 'ABW'),
(14, 'Australia', 'AUS'),
(15, 'Austria', 'AUT'),
(16, 'Azerbaijan', 'AZE'),
(17, 'Bahamas', 'BHS'),
(18, 'Bahrain', 'BHR'),
(19, 'Bangladesh', 'BGD'),
(20, 'Barbados', 'BRB'),
(21, 'Belarus', 'BLR'),
(22, 'Belgium', 'BEL'),
(23, 'Belize', 'BLZ'),
(24, 'Benin', 'BEN'),
(25, 'Bermuda', 'BMU'),
(26, 'Bhutan', 'BTN'),
(27, 'Bolivia', 'BOL'),
(28, 'Bonaire, Saint Eustatius And Saba', 'BES'),
(29, 'Bosnia and Herzegovina', 'BIH'),
(30, 'Botswana', 'BWA'),
(31, 'Bouvet Island', 'BVT'),
(32, 'Brazil', 'BRA'),
(33, 'British Indian Ocean Territory', 'IOT'),
(34, 'Brunei', 'BRN'),
(35, 'Bulgaria', 'BGR'),
(36, 'Burkina Faso', 'BFA'),
(37, 'Burundi', 'BDI'),
(38, 'Cabo Verde', 'CPV'),
(39, 'Cambodia', 'KHM'),
(40, 'Cameroon', 'CMR'),
(41, 'Canada', 'CAN'),
(42, 'Cayman Islands', 'CYM'),
(43, 'Central African Republic', 'CAF'),
(44, 'Chad', 'TCD'),
(45, 'Chile', 'CHL'),
(46, 'China', 'CHN'),
(47, 'Christmas Island', 'CXR'),
(48, 'Cocos (Keeling) Islands', 'CCK'),
(49, 'Colombia', 'COL'),
(50, 'Comoros', 'COM'),
(51, 'Congo', 'COG'),
(52, 'Cook Islands', 'COK'),
(53, 'Costa Rica', 'CRI'),
(54, 'Côte dIvoire', 'CIV'),
(55, 'Croatia', 'HRV'),
(56, 'Cuba', 'CUB'),
(57, 'Curaçao', 'CUW'),
(58, 'Cyprus', 'CYP'),
(59, 'Czech Republic', 'CZE'),
(60, 'Democratic Republic of the Congo', 'ZAR'),
(61, 'Denmark', 'DNK'),
(62, 'Djibouti', 'DJI'),
(63, 'Dominica', 'DMA'),
(64, 'Dominican Republic', 'DOM'),
(65, 'Ecuador', 'ECU'),
(66, 'Egypt', 'EGY'),
(67, 'El Salvador', 'SLV'),
(68, 'Equatorial Guinea', 'GNQ'),
(69, 'Eritrea', 'ERI'),
(70, 'Estonia', 'EST'),
(71, 'Ethiopia', 'ETH'),
(72, 'European Union', 'EUR'),
(73, 'Falkland Islands (Malvinas)', 'FLK'),
(74, 'Faroe Islands', 'FRO'),
(75, 'Fiji', 'FJI'),
(76, 'Finland', 'FIN'),
(77, 'France', 'FRA'),
(78, 'French Guiana', 'GUF'),
(79, 'French Polynesia', 'PYF'),
(80, 'French Southern and Antarctic Lands', 'ATF'),
(81, 'Gabon', 'GAB'),
(82, 'Georgia', 'GEO'),
(83, 'Germany', 'DEU'),
(84, 'Ghana', 'GHA'),
(85, 'Gibraltar', 'GIB'),
(86, 'Greece', 'GRC'),
(87, 'Greenland', 'GRL'),
(88, 'Grenada', 'GRD'),
(89, 'Guadeloupe', 'GLP'),
(90, 'Guam', 'GUM'),
(91, 'Guatemala', 'GTM'),
(92, 'Guernsey', 'GGY'),
(93, 'Guinea', 'GIN'),
(94, 'Guinea-Bissau', 'GNB'),
(95, 'Guyana', 'GUY'),
(96, 'Haiti', 'HTI'),
(97, 'Heard Island And McDonald Islands', 'HMD'),
(98, 'Honduras', 'HND'),
(99, 'Hong Kong', 'HKG'),
(100, 'Hungary', 'HUN'),
(101, 'Iceland', 'ISL'),
(102, 'India', 'IND'),
(103, 'Indonesia', 'IDN'),
(104, 'Iran', 'IRN'),
(105, 'Iraq', 'IRQ'),
(106, 'Ireland', 'IRL'),
(107, 'Isle of Man', 'IMN'),
(108, 'Israel', 'ISR'),
(109, 'Italy', 'ITA'),
(110, 'Jamaica', 'JAM'),
(111, 'Japan', 'JPN'),
(112, 'Jersey', 'JEY'),
(113, 'Jordan', 'JOR'),
(114, 'Kazakhstan', 'KAZ'),
(115, 'Kenya', 'KEN'),
(116, 'Kiribati', 'KIR'),
(117, 'Kuwait', 'KWT'),
(118, 'Kyrgyzstan', 'KGZ'),
(119, 'Laos', 'LAO'),
(120, 'Latvia', 'LVA'),
(121, 'Lebanon', 'LBN'),
(122, 'Lesotho', 'LSO'),
(123, 'Liberia', 'LBR'),
(124, 'Libya', 'LBY'),
(125, 'Liechtenstein', 'LIE'),
(126, 'Lithuania', 'LTU'),
(127, 'Luxembourg', 'LUX'),
(128, 'Macao', 'MAC'),
(129, 'Macedonia', 'MKD'),
(130, 'Madagascar', 'MDG'),
(131, 'Malawi', 'MWI'),
(132, 'Malaysia', 'MYS'),
(133, 'Maldives', 'MDV'),
(134, 'Mali', 'MLI'),
(135, 'Malta', 'MLT'),
(136, 'Marshall Islands', 'MHL'),
(137, 'Martinique', 'MTQ'),
(138, 'Mauritania', 'MRT'),
(139, 'Mauritius', 'MUS'),
(140, 'Mayotte', 'MYT'),
(141, 'Mexico', 'MEX'),
(142, 'Micronesia', 'FSM'),
(143, 'Moldova', 'MDA'),
(144, 'Monaco', 'MCO'),
(145, 'Mongolia', 'MNG'),
(146, 'Montenegro', 'MNE'),
(147, 'Montserrat', 'MSR'),
(148, 'Morocco', 'MAR'),
(149, 'Mozambique', 'MOZ'),
(150, 'Myanmar', 'MMR'),
(151, 'Namibia', 'NAM'),
(152, 'Nauru', 'NRU'),
(153, 'Nepal', 'NPL'),
(154, 'Netherlands', 'NLD'),
(155, 'New Caledonia', 'NCL'),
(156, 'New Zealand', 'NZL'),
(157, 'Nicaragua', 'NIC'),
(158, 'Niger', 'NER'),
(159, 'Nigeria', 'NGA'),
(160, 'Niue', 'NIU'),
(161, 'Norfolk Island', 'NFK'),
(162, 'North Korea', 'PRK'),
(163, 'Northern Mariana Islands', 'MNP'),
(164, 'Norway', 'NOR'),
(165, 'Oman', 'OMN'),
(166, 'Pakistan', 'PAK'),
(167, 'Palau', 'PLW'),
(168, 'Palestinian Territory, Occupied', 'PSE'),
(169, 'Panama', 'PAN'),
(170, 'Papua New Guinea', 'PNG'),
(171, 'Paraguay', 'PRY'),
(172, 'Peru', 'PER'),
(173, 'Philippines', 'PHL'),
(174, 'Pitcairn Islands', 'PCN'),
(175, 'Poland', 'POL'),
(176, 'Portugal', 'PRT'),
(177, 'Puerto Rico', 'PRI'),
(178, 'Qatar', 'QAT'),
(179, 'Réunion', 'REU'),
(180, 'Romania', 'ROU'),
(181, 'Russia', 'RUS'),
(182, 'Rwanda', 'RWA'),
(183, 'Saint Barthélemy', 'BLM'),
(184, 'Saint Helena, Ascension and Tristan da Cunha', 'SHN'),
(185, 'Saint Kitts and Nevis', 'KNA'),
(186, 'Saint Lucia', 'LCA'),
(187, 'Saint Martin', 'MAF'),
(188, 'Saint Pierre and Miquelon', 'SPM'),
(189, 'Saint Vincent and the Grenadines', 'VCT'),
(190, 'Samoa', 'WSM'),
(191, 'San Marino', 'SMR'),
(192, 'Sao Tome and Principe', 'STP'),
(193, 'Saudi Arabia', 'SAU'),
(194, 'Senegal', 'SEN'),
(195, 'Serbia', 'SRB'),
(196, 'Seychelles', 'SYC'),
(197, 'Sierra Leone', 'SLE'),
(198, 'Singapore', 'SGP'),
(199, 'Sint Maarten', 'SXM'),
(200, 'Slovakia', 'SVK'),
(201, 'Slovenia', 'SVN'),
(202, 'Solomon Islands', 'SLB'),
(203, 'Somalia', 'SOM'),
(204, 'South Africa', 'ZAF'),
(205, 'South Georgia and the South Sandwich Islands', 'SGS'),
(206, 'South Korea', 'KOR'),
(207, 'South Sudan', 'SSD'),
(208, 'Spain', 'ESP'),
(209, 'Sri Lanka', 'LKA'),
(210, 'Sudan', 'SDN'),
(211, 'Suriname', 'SUR'),
(212, 'Svalbard and Jan Mayen', 'SJM'),
(213, 'Swaziland', 'SWZ'),
(214, 'Sweden', 'SWE'),
(215, 'Switzerland', 'CHE'),
(216, 'Syria', 'SYR'),
(217, 'Taiwan', 'TWN'),
(218, 'Tajikistan', 'TJK'),
(219, 'Tanzania', 'TZA'),
(220, 'Thailand', 'THA'),
(221, 'The Gambia', 'GMB'),
(222, 'Timor-Leste', 'TLS'),
(223, 'Togo', 'TGO'),
(224, 'Tokelau', 'TKL'),
(225, 'Tonga', 'TON'),
(226, 'Trinidad and Tobago', 'TTO'),
(227, 'Tunisia', 'TUN'),
(228, 'Turkey', 'TUR'),
(229, 'Turkmenistan', 'TKM'),
(230, 'Turks and Caicos Islands', 'TCA'),
(231, 'Tuvalu', 'TUV'),
(232, 'Uganda', 'UGA'),
(233, 'Ukraine', 'UKR'),
(234, 'United Arab Emirates', 'ARE'),
(235, 'United Kingdom', 'GBR'),
(236, 'United States', 'USA'),
(237, 'United States Minor Outlying Islands', 'UMI'),
(238, 'United States Virgin Islands', 'VIR'),
(239, 'Uruguay', 'URY'),
(240, 'Uzbekistan', 'UZB'),
(241, 'Vanuatu', 'VUT'),
(242, 'Vatican City State', 'VAT'),
(243, 'Venezuela', 'VEN'),
(244, 'Viet Nam', 'VNM'),
(245, 'Virgin Islands', 'VGB'),
(246, 'Wallis and Futuna', 'WLF'),
(247, 'Western Sahara', 'ESH'),
(248, 'Yemen', 'YEM'),
(249, 'Zambia', 'ZMB'),
(250, 'Zimbabwe', 'ZWE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=251;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
