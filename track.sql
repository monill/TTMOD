-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2018 at 06:07 PM
-- Server version: 10.2.8-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `bruteforces`
--

DROP TABLE IF EXISTS `bruteforces`;
CREATE TABLE IF NOT EXISTS `bruteforces` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip` varchar(70) NOT NULL,
  `alltimes` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `alldate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

DROP TABLE IF EXISTS `estates`;
CREATE TABLE IF NOT EXISTS `estates` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `uf` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `name`, `uf`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapá', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Paraná', 'PR'),
(17, 'Pernambuco', 'PE'),
(18, 'Piauí', 'PI'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rio Grande do Sul', 'RS'),
(22, 'Rondônia', 'RO'),
(23, 'Roraima', 'RR'),
(24, 'Santa Catarina', 'SC'),
(25, 'São Paulo', 'SP'),
(26, 'Sergipe', 'SE'),
(27, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(200) NOT NULL,
  `categ_id` int(11) UNSIGNED NOT NULL,
  `style` varchar(30) DEFAULT NULL,
  `answer` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categ_id` (`categ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `categ_id`, `style`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is this bittorrent all about anyway? How do I get the files? ', 1, NULL, 'Check out <a href=\"http://www.btfaq.com/\">Brian\'s BitTorrent FAQ and Guide</a>', '2018-01-28 13:13:17', '2018-01-28 13:13:17'),
(2, 'I registered an account but did not receive the confirmation e-mail!', 2, NULL, 'You can use <a href=\"account-delete.php\">this form</a> to delete the account so you can re-register.\r\nNote though that if you didn\'t receive the email the first time it will probably not\r\nsucceed the second time either so you should really try another email address.', '2018-01-28 13:20:16', '2018-01-28 13:20:16'),
(3, 'Why is my port number reported as \"---\"? (And why should I care?)', 2, NULL, 'The tracker has determined that you are firewalled or NATed and cannot accept incoming connections.\r\n<br />\r\n<br />\r\nThis means that other peers in the swarm will be unable to connect to you, only you to them. Even worse,\r\nif two peers are both in this state they will not be able to connect at all. This has obviously a\r\ndetrimental effect on the overall speed.\r\n<br />\r\n<br />\r\nThe way to solve the problem involves opening the ports used for incoming connections\r\n(the same range you defined in your client) on the firewall and/or configuring your\r\nNAT server to use a basic form of NAT\r\nfor that range instead of NAPT (the actual process differs widely between different router models.\r\nCheck your router documentation and/or support forum. You will also find lots of information on the\r\nsubject at <a href=\"http://portforward.com/\">PortForward</a>).', '2018-01-28 13:21:36', '2018-01-28 13:21:36'),
(4, 'I\'ve lost my user name or password! Can you send it to me?', 2, NULL, 'Please use <a href=\"account-recover.php\">this form</a> to have the login details mailed back to you.', '2018-01-28 13:22:40', '2018-01-28 13:22:40'),
(5, 'Can you delete my account?', 2, NULL, 'You cannot delete your own account, please ask a member of staff', '2018-01-28 13:23:12', '2018-01-28 13:23:12'),
(6, 'So, what\'s MY ratio?', 2, NULL, 'Click on your <a href=\"account.php\">profile</a>, then on your user name (at the top).<br />\r\n<br />\r\nIt\'s important to distinguish between your overall ratio and the individual ratio on each torrent\r\nyou may be seeding or leeching. The overall ratio takes into account the total uploaded and downloaded\r\nfrom your account since you joined the site. The individual ratio takes into account those values for each torrent.<br />\r\n<br />\r\nYou may see two symbols instead of a number: &quot;Inf.&quot;, which is just an abbreviation for Infinity, and\r\nmeans that you have downloaded 0 bytes while uploading a non-zero amount (ul/dl becomes infinity); &quot;---&quot;,\r\nwhich should be read as &quot;non-available&quot;, and shows up when you have both downloaded and uploaded 0 bytes\r\n(ul/dl = 0/0 which is an indeterminate amount).', '2018-01-28 13:23:51', '2018-01-28 13:23:51'),
(7, 'Why is my IP displayed on my details page?', 2, NULL, 'Only you and the site moderators can view your IP address and email. Regular users do not see that information.', '2018-01-28 13:24:27', '2018-01-28 13:24:27'),
(8, 'Help! I cannot login!?', 2, NULL, 'This problem sometimes occurs with MSIE. Close all Internet Explorer windows and open Internet Options in the control panel. Click the Delete Cookies button. You should now be able to login.', '2018-01-28 13:24:58', '2018-01-28 13:24:58'),
(9, 'My IP address is dynamic. How do I stay logged in?', 2, NULL, 'You do not have to anymore. All you have to do is make sure you are logged in with your actual IP when starting a torrent session. After that, even if the IP changes mid-session, the seeding or leeching will continue and the statistics will update without any problem.', '2018-01-28 13:25:43', '2018-01-28 13:25:43'),
(10, 'Most common reason for stats not updating', 3, NULL, '<ul>\r\n<li>The user is cheating. (a.k.a. &quot;Summary Ban&quot;)</li>\r\n<li>The server is overloaded and unresponsive. Just try to keep the session open until the server responds again. (Flooding the server with consecutive manual updates is not recommended.)</li>\r\n</ul>', '2018-01-28 15:32:50', '2018-01-28 15:32:50'),
(11, 'How does NAT/ICS change the picture?', 3, NULL, 'This is a very particular case in that all computers in the LAN will appear to the outside world as having the same IP. We must distinguish\r\nbetween two cases:<br />\r\n<br />\r\n<b>1.</b> <i>You are the single  user in the LAN</i><br />\r\n<br />\r\nYou should use the same account in all the computers.<br />\r\n<br />\r\nNote also that in the ICS case it is preferable to run the BT client on the ICS gateway. Clients running on the other computers\r\nwill be unconnectable (their ports will be listed as &quot;---&quot;, as explained elsewhere in the FAQ) unless you specify\r\nthe appropriate services in your ICS configuration (a good explanation of how to do this for Windows XP can be found\r\n<a href=\"http://www.microsoft.com/downloads/details.aspx?FamilyID=1dcff3ce-f50f-4a34-ae67-cac31ccd7bc9&amp;displaylang=en\">here</a>).\r\nIn the NAT case you should configure different ranges for clients on different computers and create appropriate NAT rules in the router. (Details vary widely from router to router and are outside the scope of this FAQ. Check your router documentation and/or support forum.)<br />\r\n<br />\r\n<br />\r\n<b>2.</b> <i>There are multiple users in the LAN</i><br />\r\n<br />\r\nAt present there is no way of making this setup always work properly.\r\nEach torrent will be associated with the user who last accessed the site from within\r\nthe LAN before the torrent was started.\r\nUnless there is cooperation between the users mixing of statistics is possible.\r\n(User A accesses the site, downloads a .torrent file, but does not start the torrent immediately.\r\nMeanwhile, user B accesses the site. User A then starts the torrent. The torrent will count\r\ntowards user B\'s statistics, not user A\'s.)\r\n<br />\r\n<br />\r\nIt is your LAN, the responsibility is yours. Do not ask us to ban other users\r\nwith the same IP, we will not do that. (Why should we ban <i>him</i> instead of <i>you</i>?)', '2018-01-28 15:33:40', '2018-01-28 15:33:40'),
(12, 'Best practices', 3, NULL, '<ul>\r\n<li>If a torrent you are currently leeching/seeding is not listed on your profile, just wait or force a manual update.</li>\r\n<li>Make sure you exit your client properly, so that the tracker receives &quot;event=completed&quot;.</li>\r\n<li>If the tracker is down, do not stop seeding. As long as the tracker is back up before you exit the client the stats should update properly.</li>\r\n</ul>', '2018-01-28 15:34:32', '2018-01-28 15:34:32'),
(13, 'May I use any bittorrent client?', 3, NULL, 'Yes. The tracker now updates the stats correctly for all bittorrent clients. However, we still recommend\r\nthat you <b>avoid</b> the following clients:<br />\r\n<br />\r\n\r\n<ul>\r\n<li>BitTorrent++</li>\r\n<li>Nova Torrent</li>\r\n<li>TorrentStorm</li>\r\n</ul>\r\n\r\n<br />\r\nThese clients do not report correctly to the tracker when canceling/finishing a torrent session.\r\nIf you use them then a few MB may not be counted towards\r\nthe stats near the end, and torrents may still be listed in your profile for some time after you have closed the client.<br />\r\n<br />\r\nAlso, clients in alpha or beta version should be avoided.', '2018-01-28 15:35:31', '2018-01-28 15:35:31'),
(14, 'Why is a torrent I\'m leeching/seeding listed several times in my profile?', 3, NULL, 'If for some reason (e.g. pc crash, or frozen client) your client exits improperly and you restart it, it will have a new peer_id, so it will show as a new torrent. The old one will never receive a \"event=completed\" or \"event=stopped\" and will be listed until some tracker timeout. Just ignore it, it will eventually go away.', '2018-01-28 15:36:16', '2018-01-28 15:36:16'),
(15, 'I\'ve finished or cancelled a torrent. Why is it still listed in my profile?', 3, NULL, 'Some clients, notably TorrentStorm and Nova Torrent, do not report properly to the tracker when canceling or finishing a torrent. In that case the tracker will keep waiting for some message - and thus listing the torrent as seeding or leeching - until some timeout occurs. Just ignore it, it will eventually go away.', '2018-01-28 15:36:43', '2018-01-28 15:36:43'),
(16, 'Why do I sometimes see torrents I\'m not leeching in my profile!?', 3, NULL, 'When a torrent is first started, the tracker uses the IP to identify the user. Therefore the torrent will become associated with the user who last accessed the site from that IP. If you share your IP in some way (you are behind NAT/ICS, or using a proxy), and some of the persons you share it with are also users, you may occasionally see their torrents listed in your profile. (If they start a torrent session from that IP and you were the last one to visit the site the torrent will be associated with you). Note that now torrents listed in your profile will always count towards your total stats.', '2018-01-28 15:37:14', '2018-01-28 15:37:14'),
(17, 'Why can\'t I upload torrents?', 4, NULL, 'Only specially authorized users (<font color=\"#4040c0\"><b>Uploaders</b></font>) have permission to upload torrents.', '2018-01-28 15:38:26', '2018-01-28 15:38:26'),
(18, 'What criteria must I meet before I can join the <font color=\"#4040c0\">Uploader</font> team?', 4, NULL, 'You must be able to provide releases that:<br />\r\n<ul>\r\n<li>include a proper NFO</li>\r\n<li>are genuine scene releases. If it\'s not on <a href=\"http://www.nforce.nl\">NFOrce</a> then forget it! (except music).</li>\r\n<li>are not older than seven (7) days.</li>\r\n<li>have all files in original format (usually 14.3 MB RARs)</li>\r\n<li>you\'ll be able to seed, or make sure are well-seeded, for at least 24 hours.</li>\r\n<li>you should have atleast 2MBit upload bandwith.</li>\r\n</ul>\r\n\r\n<br />\r\nIf you think you can match these criteria do not hesitate to <a href=\"staff.php\">contact</a> one of the administrators.<br />\r\n<b>Remember!</b> Write your application carefully! Be sure to include your UL speed and what kind of stuff you\'re planning to upload.<br />\r\nOnly well written letters with serious intent will be considered.', '2018-01-28 15:39:33', '2018-01-28 15:39:33'),
(19, 'How do I use the files I\'ve downloaded?', 5, NULL, 'Check out <a href=\"videoformats.php\">this guide</a>.', '2018-01-28 15:41:49', '2018-01-28 15:41:49'),
(20, 'Downloaded a movie and don\'t know what CAM/TS/TC/SCR means?', 5, NULL, 'Check out <a href=\"videoformats.php\">this guide.</a>', '2018-01-28 15:42:27', '2018-01-28 15:42:27'),
(21, 'Why did an active torrent suddenly disappear?', 5, NULL, 'There may be three reasons for this:<br />\r\n(<b>1</b>) The torrent may have been out-of-sync with the site\r\n<a href=\"rules.php\">rules</a>.<br />\r\n(<b>2</b>) The uploader may have deleted it because it was a bad release.\r\nA replacement will probably be uploaded to take its place.<br />\r\n(<b>3</b>) Torrents are automatically deleted after 28 days.', '2018-01-28 15:43:02', '2018-01-28 15:43:02'),
(22, 'How do I resume a broken download or reseed something?', 5, NULL, 'Open the .torrent file. When your client asks you for a location, choose the location of the existing file(s) and it will resume/reseed the torrent.', '2018-01-28 15:43:39', '2018-01-28 15:43:39'),
(23, 'Why do my downloads sometimes stall at 99%?', 5, NULL, 'The more pieces you have, the harder it becomes to find peers who have pieces you are missing. That is why downloads sometimes slow down or even stall when there are just a few percent remaining. Just be patient and you will, sooner or later, get the remaining pieces.', '2018-01-28 15:44:06', '2018-01-28 15:44:06'),
(24, 'What are these \"a piece has failed an hash check\" messages?', 5, NULL, 'Bittorrent clients check the data they receive for integrity. When a piece fails this check it is\r\nautomatically re-downloaded. Occasional hash fails are a common occurrence, and you shouldn\'t worry.<br />\r\n<br />\r\nSome clients have an (advanced) option/preference to \'kick/ban clients that send you bad data\' or\r\nsimilar. It should be turned on, since it makes sure that if a peer repeatedly sends you pieces that\r\nfail the hash check it will be ignored in the future.', '2018-01-28 15:44:49', '2018-01-28 15:44:49'),
(25, 'The torrent is supposed to be 100MB. How come I downloaded 120MB?', 5, NULL, 'See the hash fails topic. If your client receives bad data it will have to redownload it, therefore the total downloaded may be larger than the torrent size. Make sure the \"kick/ban\" option is turned on to minimize the extra downloads.', '2018-01-28 15:45:22', '2018-01-28 15:45:22'),
(26, 'Why do I get a \"Not authorized (xx h) - READ THE FAQ\" error?', 5, NULL, 'From the time that each <b>new</b> torrent is uploaded to the tracker, there is a period of time that\r\nsome users must wait before they can download it.<br />\r\nThis delay in downloading will only affect users with a low ratio, and users with low upload amounts.<br />\r\n<br />\r\n<table class=\"table_table\" cellspacing=\"3\" cellpadding=\"5\" align=\"center\">\r\n <tr>\r\n    <td class=\"table_col1\"><b>Ratio below</b></td>\r\n    <td class=\"table_col2\" align=\"center\"><font color=\"#bb0000\">0.50</font></td>\r\n    <td class=\"table_col2\">and/or upload below</td>\r\n    <td class=\"table_col1\" align=\"center\">5.0GB</td>\r\n    <td class=\"table_col2\">delay of</td>\r\n    <td class=\"table_col1\" align=\"center\">48h</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Ratio below</b></td>\r\n    <td class=\"table_col2\"><font color=\"#A10000\">0.65</font></td>\r\n    <td class=\"table_col1\">and/or upload below</td>\r\n    <td class=\"table_col2\">6.5GB</td>\r\n    <td class=\"table_col1\">delay of</td>\r\n    <td class=\"table_col2\">24h</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Ratio below</b></td>\r\n    <td class=\"table_col2\"><font color=\"#880000\">0.80</font></td>\r\n    <td class=\"table_col1\">and/or upload below</td>\r\n    <td class=\"table_col2\">8.0GB</td>\r\n    <td class=\"table_col1\">delay of</td>\r\n    <td class=\"table_col2\">12h</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Ratio below</b></td>\r\n    <td class=\"table_col2\"><font color=\"#6E0000\">0.95</font></td>\r\n    <td class=\"table_col1\">and/or upload below</td>\r\n    <td class=\"table_col2\">9.5GB</td>\r\n    <td class=\"table_col1\">delay of</td>\r\n    <td class=\"table_col2\">06h</td>\r\n </tr>\r\n</table>\r\n<br />\r\n\"<b>And/or</b>\" means any or both. Your delay will be the <b>largest</b> one for which you meet <b>at least</b> one condition.<br />\r\n<br />\r\nThis applies to new users as well, so opening a new account will not help. Note also that this\r\nworks at tracker level, you will be able to grab the .torrent file itself at any time.<br />\r\n<br />\r\n<!--The delay applies only to leeching, not to seeding. If you got the files from any other source and\r\nwish to seed them you may do so at any time irrespectively of your ratio or total uploaded.<br />-->\r\nN.B. Due to some users exploiting the \'no-delay-for-seeders\' policy we had to change it. The delay\r\nnow applies to both seeding and leeching. So if you are subject to a delay and get the files from\r\nsome other source you will not be able to seed them until the delay has elapsed.', '2018-01-28 15:46:04', '2018-01-28 15:46:04'),
(27, 'Why do I get a \"rejected by tracker - Port xxxx is blacklisted\" error?', 5, NULL, 'Your client is reporting to the tracker that it uses one of the default bittorrent ports\r\n(6881-6889) or any other common p2p port for incoming connections.<br />\r\n<br />\r\nThis tracker does not allow clients to use ports commonly associated with p2p protocols.\r\nThe reason for this is that it is a common practice for ISPs to throttle those ports\r\n(that is, limit the bandwidth, hence the speed). <br />\r\n<br />\r\nThe blocked ports list include, but is not neccessarily limited to, the following:<br />\r\n<br />\r\n  <table border=\"0\" cellspacing=\"3\" cellpadding=\"5\" class=\"table_table\" align=\"center\">\r\n  <tr>\r\n    <td class=\"table_col1\"><b>Direct Connect</b></td>\r\n    <td class=\"table_col2\">411 - 413</td>\r\n  </tr>\r\n  <tr>\r\n    <td class=\"table_col1\"><b>Kazaa</b></td>\r\n    <td class=\"table_col2\">1214</td>\r\n  </tr>\r\n  <tr>\r\n    <td class=\"table_col1\"><b>eDonkey</b></td>\r\n    <td class=\"table_col2\">4662</td>\r\n  </tr>\r\n  <tr>\r\n    <td class=\"table_col1\"><b>Gnutella</b></td>\r\n    <td class=\"table_col2\">6346 - 6347</td>\r\n  </tr>\r\n  <tr>\r\n    <td class=\"table_col1\"><b>BitTorrent</b></td>\r\n    <td class=\"table_col2\">6881 - 6889</td>\r\n </tr>\r\n</table>\r\n<br />\r\nIn order to use use our tracker you must  configure your client to use\r\nany port range that does not contain those ports (a range within the region 49152 through 65535 is preferable,\r\ncf. <a href=\"http://www.iana.org/assignments/port-numbers\">IANA</a>). Notice that some clients,\r\nlike Azureus 2.0.7.0 or higher, use a single port for all torrents, while most others use one port per open torrent. The size\r\nof the range you choose should take this into account (typically less than 10 ports wide. There\r\nis no benefit whatsoever in choosing a wide range, and there are possible security implications). <br />\r\n<br />\r\nThese ports are used for connections between peers, not client to tracker.\r\nTherefore this change will not interfere with your ability to use other trackers (in fact it\r\nshould <i>increase</i> your speed with torrents from any tracker, not just ours). Your client\r\nwill also still be able to connect to peers that are using the standard ports.\r\nIf your client does not allow custom ports to be used, you will have to switch to one that does.<br />\r\n<br />\r\nDo not ask us, or in the forums, which ports you should choose. The more random the choice is the harder\r\nit will be for ISPs to catch on to us and start limiting speeds on the ports we use.\r\nIf we simply define another range ISPs will start throttling that range also. <br />\r\n<br />\r\nFinally, remember to forward the chosen ports in your router and/or open them in your\r\nfirewall, should you have them.', '2018-01-28 15:46:52', '2018-01-28 15:46:52'),
(28, 'What\'s this \"IOError - [Errno13] Permission denied\" error?', 5, NULL, 'If you just want to fix it reboot your computer, it should solve the problem.\r\nOtherwise read on.<br />\r\n<br />\r\nIOError means Input-Output Error, and that is a file system error, not a tracker one.\r\nIt shows up when your client is for some reason unable to open the partially downloaded\r\ntorrent files. The most common cause is two instances of the client to be running\r\nsimultaneously:\r\nthe last time the client was closed it somehow didn\'t really close but kept running in the\r\nbackground, and is therefore still\r\nlocking the files, making it impossible for the new instance to open them.<br />\r\n<br />\r\nA more uncommon occurrence is a corrupted FAT. A crash may result in corruption\r\nthat makes the partially downloaded files unreadable, and the error ensues. Running\r\nscandisk should solve the problem. (Note that this may happen only if you\'re running\r\nWindows 9x - which only support FAT - or NT/2000/XP with FAT formatted hard drives.\r\nNTFS is much more robust and should never permit this problem.)', '2018-01-28 15:47:52', '2018-01-28 15:47:52'),
(29, 'What\'s this \"TTL\" in the browse page?', 5, NULL, 'The torrent\'s Time To Live, in hours. It means the torrent will be deleted\r\nfrom the tracker after that many hours have elapsed (yes, even if it is still active).\r\nNote that this a maximum value, the torrent may be deleted at any time if it\'s inactive.', '2018-01-28 15:48:46', '2018-01-28 15:48:46'),
(30, 'Do not immediately jump on new torrents', 6, NULL, 'The download speed mostly depends on the seeder-to-leecher ratio (SLR). Poor download speed is\r\nmainly a problem with new and very popular torrents where the SLR is low.<br />\r\n<br />\r\n(Proselytising sidenote: make sure you remember that you did not enjoy the low speed.\r\n<b>Seed</b> so that others will not endure the same.)<br />\r\n<br />\r\nThere are a couple of things that you can try on your end to improve your speed:<br />\r\n<br />In particular, do not do it if you have a slow connection. The best speeds will be found around the\r\nhalf-life of a torrent, when the SLR will be at its highest. (The downside is that you will not be able to seed\r\nso much. It\'s up to you to balance the pros and cons of this.)', '2018-01-28 15:50:08', '2018-01-28 15:50:08'),
(31, 'Limit your upload speed', 6, NULL, 'The upload speed affects the download speed in essentially two ways:<br />\r\n<ul>\r\n    <li>Bittorrent peers tend to favour those other peers that upload to them. This means that if A and B\r\n    are leeching the same torrent and A is sending data to B at high speed then B will try to reciprocate.\r\n    So due to this effect high upload speeds lead to high download speeds.</li>\r\n\r\n    <li>Due to the way TCP works, when A is downloading something from B it has to keep telling B that\r\n        it received the data sent to him. (These are called acknowledgements - ACKs -, a sort of &quot;got it!&quot; messages).\r\n        If A fails to do this then B will stop sending data and wait. If A is uploading at full speed there may be no\r\n        bandwidth left for the ACKs and they will be delayed. So due to this effect excessively high upload speeds lead\r\n        to low download speeds.</li>\r\n</ul>\r\n\r\nThe full effect is a combination of the two. The upload should be kept as high as possible while allowing the\r\nACKs to get through without delay. <b>A good thumb rule is keeping the upload at about 80% of the theoretical\r\nupload speed.</b> You will have to fine tune yours to find out what works best for you. (Remember that keeping the\r\nupload high has the additional benefit of helping with your ratio.) <br />\r\n<br />\r\nIf you are running more than one instance of a client it is the overall upload speed that you must take into account.\r\nSome clients (e.g. Azureus) limit global upload speed, others (e.g. Shad0w\'s) do it on a per torrent basis.\r\nKnow your client. The same applies if you are using your connection for anything else (e.g. browsing or ftp),\r\nalways think of the overall upload speed.', '2018-01-28 15:54:56', '2018-01-28 15:54:56'),
(32, 'Limit the number of simultaneous connections ', 6, NULL, 'Some operating systems (like Windows 9x) do not deal well with a large number of connections, and may even crash. Also some home routers (particularly when running NAT and/or firewall with stateful inspection services) tend to become slow or crash when having to deal with too many connections. There are no fixed values for this, you may try 60 or 100 and experiment with the value. Note that these numbers are additive, if you have two instances of a client running the numbers add up. \r\n', '2018-01-28 15:55:32', '2018-01-28 15:55:32'),
(33, 'Limit the number of simultaneous uploads', 6, NULL, 'Isn\'t this the same as above? No. Connections limit the number of peers your client is talking to and/or downloading from. Uploads limit the number of peers your client is actually uploading to. The ideal number is typically much lower than the number of connections, and highly dependent on your (physical) connection.', '2018-01-28 15:56:02', '2018-01-28 15:56:02'),
(34, 'Just give it some time', 6, NULL, 'As explained above peers favour other peers that upload to them. When you start leeching a new torrent you have nothing to offer to other peers and they will tend to ignore you. This makes the starts slow, in particular if, by change, the peers you are connected to include few or no seeders. The download speed should increase as soon as you have some pieces to share.', '2018-01-28 15:56:38', '2018-01-28 15:56:38'),
(35, 'Why is my browsing so slow while leeching?', 6, NULL, 'The download speed mostly depends on the seeder-to-leecher ratio (SLR). Poor download speed is\r\nmainly a problem with new and very popular torrents where the SLR is low.<br />\r\n<br />\r\n(Proselytising sidenote: make sure you remember that you did not enjoy the low speed.\r\n<b>Seed</b> so that others will not endure the same.)<br />\r\n<br />\r\nThere are a couple of things that you can try on your end to improve your speed:<br />\r\n<br />In particular, do not do it if you have a slow connection. The best speeds will be found around the\r\nhalf-life of a torrent, when the SLR will be at its highest. (The downside is that you will not be able to seed\r\nso much. It\'s up to you to balance the pros and cons of this.)', '2018-01-28 15:57:12', '2018-01-28 15:57:12'),
(36, 'What is a proxy?', 7, NULL, 'Basically a middleman. When you are browsing a site through a proxy your requests are sent to the proxy and the proxy\r\nforwards them to the site instead of you connecting directly to the site. There are several classifications\r\n(the terminology is far from standard):<br />\r\n<br />\r\n\r\n\r\n<table cellspacing=\"3\" cellpadding=\"3\" class=\"table_table\" align=\"center\">\r\n <tr>\r\n    <td class=\"table_col1\"><b>Transparent</b></td>\r\n    <td class=\"table_col2\">A transparent proxy is one that needs no configuration on the clients. It works by automatically redirecting all port 80 traffic to the proxy. (Sometimes used as synonymous for non-anonymous.)</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Explicit/Voluntary</b></td>\r\n    <td class=\"table_col2\">Clients must configure their browsers to use them.</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Anonymous</b></td>\r\n    <td class=\"table_col2\">The proxy sends no client identification to the server. (HTTP_X_FORWARDED_FOR header is not sent; the server does not see your IP.)</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Highly Anonymous</b></td>\r\n    <td class=\"table_col2\">The proxy sends no client nor proxy identification to the server. (HTTP_X_FORWARDED_FOR, HTTP_VIA and HTTP_PROXY_CONNECTION headers are not sent; the server doesn\'t see your IP and doesn\'t even know you\'re using a proxy.)</td>\r\n </tr>\r\n <tr>\r\n    <td class=\"table_col1\"><b>Public</b></td>\r\n    <td class=\"table_col2\">(Self explanatory)</td>\r\n </tr>\r\n</table>\r\n<br />\r\nA transparent proxy may or may not be anonymous, and there are several levels of anonymity.', '2018-01-28 15:58:21', '2018-01-28 15:58:21'),
(37, 'How do I find out if I\'m behind a (transparent/anonymous) proxy?', 7, NULL, 'Try <a href=\"http://proxyjudge.org\">ProxyJudge</a>. It lists the HTTP headers that the server where it is running\r\nreceived from you. The relevant ones are HTTP_CLIENT_IP, HTTP_X_FORWARDED_FOR and REMOTE_ADDR.<br />\r\n<br />\r\n<br />\r\n<b>Why is my port listed as &quot;---&quot; even though I\'m not NAT/Firewalled?</b><a name=\"prox3\"></a><br />\r\n<br />\r\nThe tracker is quite smart at finding your real IP, but it does need the proxy to send the HTTP header\r\nHTTP_X_FORWARDED_FOR. If your ISP\'s proxy does not then what happens is that the tracker will interpret the proxy\'s IP\r\naddress as the client\'s IP address. So when you login and the tracker tries to connect to your client to see if you are\r\nNAT/firewalled it will actually try to connect to the proxy on the port your client reports to be using for\r\nincoming connections. Naturally the proxy will not be listening on that port, the connection will fail and the\r\ntracker will think you are NAT/firewalled.', '2018-01-28 15:58:55', '2018-01-28 15:58:55'),
(38, 'Can I bypass my ISP\'s proxy?', 7, NULL, 'If your ISP only allows HTTP traffic through port 80 or blocks the usual proxy ports then you would need to use something\r\nlike <a href=\"http://www.socks.permeo.com\">socks</a> and that is outside the scope of this FAQ.<br />\r\n<br />\r\nOtherwise you may try the following:<br />\r\n<ul>\r\n    <li>Choose any public <b>non-anonymous</b> proxy that does <b>not</b> use port 80\r\n    (e.g. from <a href=\"http://tools.rosinstrument.com/proxy\">this</a>,\r\n    <a href=\"http://www.proxy4free.com/index.html\">this</a> or\r\n    <a href=\"http://www.samair.ru/proxy\">this</a> list).</li>\r\n\r\n    <li>Configure your computer to use that proxy. For Windows XP, do <i>Start</i>, <i>Control Panel</i>, <i>Internet Options</i>,\r\n    <i>Connections</i>, <i>LAN Settings</i>, <i>Use a Proxy server</i>, <i>Advanced</i> and type in the IP and port of your chosen\r\n    proxy. Or from Internet Explorer use <i>Tools</i>, <i>Internet Options</i>, ...<br /></li>\r\n\r\n    <li>(Facultative) Visit <a href=\"http://proxyjudge.org\">ProxyJudge</a>. If you see an HTTP_X_FORWARDED_FOR in\r\n    the list followed by your IP then everything should be ok, otherwise choose another proxy and try again.<br /></li>\r\n\r\n    <li>Visit this site. Hopefully the tracker will now pickup your real IP (check your profile to make sure).</li>\r\n</ul>\r\n<br />\r\nNotice that now you will be doing all your browsing through a public proxy, which are typically quite slow.\r\nCommunications between peers do not use port 80 so their speed will not be affected by this, and should be better than when\r\nyou were &quot;unconnectable&quot;.', '2018-01-28 15:59:33', '2018-01-28 15:59:33'),
(39, 'How do I make my bittorrent client use a proxy?', 7, NULL, 'Just configure Windows XP as above. When you configure a proxy for Internet Explorer you\r\nre actually configuring a proxy for\r\nall HTTP traffic (thank Microsoft and their &quot;IE as part of the OS policy&quot; ). On the other hand if you use another\r\nbrowser (Opera/Mozilla/Firefox) and configure a proxy there you\'ll be configuring a proxy just for that browser. We don\'t\r\nknow of any BT client that allows a proxy to be specified explicitly.', '2018-01-28 16:00:10', '2018-01-28 16:00:10'),
(40, 'Why can\'t I signup from behind a proxy?', 7, NULL, 'It is our policy not to allow new accounts to be opened from behind a proxy.', '2018-01-28 16:00:38', '2018-01-28 16:00:38'),
(41, 'Maybe my address is blacklisted?', 8, NULL, 'The site blocks addresses listed in the (former) <a href=\"http://methlabs.org/\">PeerGuardian</a>\r\ndatabase, as well as addresses of banned users. This works at Apache/PHP level, it\'s just a script that\r\nblocks <i>logins</i> from those addresses. It should not stop you from reaching the site. In particular\r\nit does not block lower level protocols, you should be able to ping/traceroute the server even if your\r\naddress is blacklisted. If you cannot then the reason for the problem lies elsewhere.<br />\r\n<br />\r\nIf somehow your address is indeed blocked in the PG database do not contact us about it, it is not our\r\npolicy to open <i>ad hoc</i> exceptions. You should clear your IP with the database maintainers instead.', '2018-01-28 16:01:38', '2018-01-28 16:01:38'),
(42, 'Your ISP blocks the site\'s address', 8, NULL, '(In first place, it\'s unlikely your ISP is doing so. DNS name resolution and/or network problems are the usual culprits.)\r\n<br />\r\nThere\'s nothing we can do.\r\nYou should contact your ISP (or get a new one). Note that you can still visit the site via a proxy, follow the instructions\r\nin the relevant section. In this case it doesn\'t matter if the proxy is anonymous or not, or which port it listens to.<br />\r\n<br />\r\nNotice that you will always be listed as an &quot;unconnectable&quot; client because the tracker will be unable to\r\ncheck that you\'re capable of accepting incoming connections.', '2018-01-28 16:02:08', '2018-01-28 16:02:08'),
(43, 'You can try these:', 9, NULL, 'Post in the <a href=\"forums.php\">Forums</a>, by all means. You\'ll find they\r\nare usually a friendly and helpful place,\r\nprovided you follow a few basic guidelines:\r\n<ul>\r\n<li>Make sure your problem is not really in this FAQ. There\'s no point in posting just to be sent\r\nback here.</li>\r\n<li>Before posting read the sticky topics (the ones at the top). Many times new information that\r\nstill hasn\'t been incorporated in the FAQ can be found there.</li>\r\n<li>Help us in helping you. Do not just say \"it doesn\'t work!\". Provide details so that we don\'t\r\nhave to guess or waste time asking. What client do you use? What\'s your OS? What\'s your network setup? What\'s the exact\r\nerror message you get, if any? What are the torrents you are having problems with? The more\r\nyou tell the easiest it will be for us, and the more probable your post will get a reply.</li>\r\n<li>And needless to say: be polite. Demanding help rarely works, asking for it usually does\r\nthe trick.</li></ul>', '2018-01-28 16:02:47', '2018-01-28 16:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categs`
--

DROP TABLE IF EXISTS `faq_categs`;
CREATE TABLE IF NOT EXISTS `faq_categs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `style` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq_categs`
--

INSERT INTO `faq_categs` (`id`, `name`, `style`, `created_at`, `updated_at`) VALUES
(1, 'Site information', 'bg-primary', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(2, 'User information', 'bg-info', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(3, 'Stats', 'bg-success', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(4, 'Uploading', 'bg-warning', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(5, 'Downloading', 'bg-light', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(6, 'How can I improve my download speed?', 'bg-secondary', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(7, 'My ISP uses a transparent proxy. What should I do?', 'bg-danger', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(8, 'Why can\'t I connect? Is the site blocking me?', 'bg-danger', '2018-01-28 11:45:12', '2018-01-28 11:45:12'),
(9, 'What if I can\'t find the answer to my problem here?', 'bg-light', '2018-01-28 11:45:12', '2018-01-28 11:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
CREATE TABLE IF NOT EXISTS `guests` (
  `ip` varchar(70) NOT NULL,
  `time` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

DROP TABLE IF EXISTS `invites`;
CREATE TABLE IF NOT EXISTS `invites` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(200) NOT NULL,
  `code` varchar(45) NOT NULL,
  `expires_on` date NOT NULL,
  `accepted_by` int(11) UNSIGNED DEFAULT NULL,
  `accepted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from_userid` (`user_id`),
  KEY `accepted_by` (`accepted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

DROP TABLE IF EXISTS `layouts`;
CREATE TABLE IF NOT EXISTS `layouts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `named` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `position` enum('left','middle','right') NOT NULL,
  `description` varchar(200) NOT NULL,
  `enabled` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `sort` tinyint(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `named`, `name`, `position`, `description`, `enabled`, `sort`) VALUES
(1, 'Donation Methods', 'donate', 'right', 'Description here...', 1, 11),
(2, 'Invites', 'invite', 'right', 'Description here...', 1, 2),
(4, 'User Block', 'user', 'left', 'Description here...', 1, 1),
(5, 'RSS', 'rss', 'right', 'Description here...', 1, 0),
(6, 'Latest Torrents', 'latestuploads', 'right', 'Description here...', 1, 1),
(7, 'Advanced Statistics', 'advancestats', 'left', 'Description here...', 1, 5),
(8, 'Server Load', 'serverload', 'right', 'Description here...', 1, 5),
(9, 'Users online', 'usersonline', 'middle', 'Description here...', 1, 1),
(10, 'Main categories', 'maincats', 'left', 'Description here...', 1, 3),
(13, 'Latest Posters', 'latestimages', 'right', 'Description here...', 1, 7),
(14, 'Most Active Torrents', 'mostactivetorrents', 'left', 'Description here...', 1, 10),
(16, 'Newest Members', 'newestmember', 'right', 'Description here...', 1, 8),
(18, 'Seeders Wanted', 'seedwanted', 'left', 'Description here...', 1, 7),
(20, 'Powered By', 'poweredby', 'right', 'Description here...', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `ip` varchar(70) NOT NULL,
  `browser` varchar(190) NOT NULL,
  `os_system` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` int(11) UNSIGNED NOT NULL,
  `receiver` int(11) UNSIGNED NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `readed` tinyint(1) NOT NULL DEFAULT 0,
  `wherein` enum('inbox','outbox') NOT NULL,
  `whereout` enum('inbox','outbox') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `message`, `readed`, `wherein`, `whereout`, `created_at`) VALUES
(3, 1, 7, 'Testing Inbox', 'ajsdkjaskjda skjd askldjasklj dkdajsdka sjkd asjkld askld asjkld jasd jas djaksl djas djaslk djaskldj askldj askldjakls dasjkldj askjld aklsjd askljd akslj daskl jdakls djkasl djklas jdkals jdklas jdkasjd kasljd kaslj dklas dkas dkals jdkals d', 1, 'inbox', 'outbox', '2018-02-01 23:39:00'),
(4, 7, 2, 'Testing Outbox', 'ajsdkjaskjda skjd askldjasklj dkdajsdka sjkd asjkld askld asjkld jasd jas djaksl djas djaslk djaskldj askldj askldjakls dasjkldj askjld aklsjd askljd akslj daskl jdakls djkasl djklas jdkals jdklas jdkasjd kasljd kaslj dklas dkas dkals jdkals d', 1, 'outbox', 'inbox', '2018-02-03 08:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Testingd...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec feugiat nunc eget neque iaculis, ac iaculis diam laoreet. Maecenas porta pulvinar nulla lacinia imperdiet. Nam et dignissim ex. Phasellus pretium tempor erat non accumsan. Nullam at nunc ipsum. Donec lorem libero, convallis id orci ut, fringilla vestibulum justo. Fusce sit amet lobortis turpis.', '2018-01-29 17:58:50', '2018-01-29 17:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `perm_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perm_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`perm_id`, `perm_desc`) VALUES
(1, 'viewtorrents'),
(2, 'edittorrents'),
(3, 'deletetorrents'),
(4, 'uploadtorrents'),
(5, 'downloadtorrents'),
(6, 'viewusers'),
(7, 'editusers'),
(8, 'deleteusers'),
(9, 'createusers'),
(10, 'viewnews'),
(11, 'editnews'),
(12, 'deletenews'),
(13, 'createnews'),
(14, 'viewforum'),
(15, 'editforum'),
(16, 'deleteforum'),
(17, 'createtopic'),
(18, 'chataccess'),
(19, 'viewpoll'),
(20, 'editpoll'),
(21, 'deletepoll'),
(22, 'createpoll');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

DROP TABLE IF EXISTS `poll_answers`;
CREATE TABLE IF NOT EXISTS `poll_answers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` int(11) UNSIGNED NOT NULL,
  `answer` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poll_polls`
--

DROP TABLE IF EXISTS `poll_polls`;
CREATE TABLE IF NOT EXISTS `poll_polls` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` int(11) UNSIGNED NOT NULL,
  `answer_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `from_ip` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poll_questions`
--

DROP TABLE IF EXISTS `poll_questions`;
CREATE TABLE IF NOT EXISTS `poll_questions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int(11) UNSIGNED NOT NULL,
  `question` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `expery_at` datetime DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` int(11) UNSIGNED NOT NULL,
  `link_id` int(11) UNSIGNED NOT NULL,
  `type` enum('torrent','forum','user','comment') NOT NULL,
  `reason` varchar(255) NOT NULL,
  `dealt_by` int(11) UNSIGNED DEFAULT NULL,
  `solved` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  KEY `link_id` (`link_id`),
  KEY `dealt_by` (`dealt_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `added_by`, `link_id`, `type`, `reason`, `dealt_by`, `solved`, `created_at`, `updated_at`) VALUES
(1, 7, 5, 'torrent', 'this is my', NULL, 'no', '2018-02-22 22:13:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'member'),
(2, 'memberplus'),
(3, 'vip'),
(4, 'uploader'),
(5, 'moderator'),
(6, 'moderatorplus'),
(7, 'admin'),
(8, 'boss');

-- --------------------------------------------------------

--
-- Table structure for table `role_perms`
--

DROP TABLE IF EXISTS `role_perms`;
CREATE TABLE IF NOT EXISTS `role_perms` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `perm_id` int(11) UNSIGNED NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `perm_id` (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_perms`
--

INSERT INTO `role_perms` (`role_id`, `perm_id`) VALUES
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(7, 11),
(7, 12),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(7, 17),
(7, 18);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

DROP TABLE IF EXISTS `rules`;
CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'General Rules', '<b> Breaking these rules can and will get you banned! </b> <br>\n\n- We are a English only site, so please only talk in english! <br />\n\n- Do not defy the moderators expressed wishes! <br />\n\n- Respect staff members at all given times. <br>\n\n- No aggressive behavior, flaming, defamation, advertising, requesting, pictures and text which include racism/nudity/sexism/religion or foul language in Personal Messages. <br>\n\n- No query regarding ranks, if we feel like you deserve it you will be promoted. <br>', NULL, NULL),
(2, 'Forum Rules', '- No other language than English. <br>\n- No aggressive behaviour or flaming or defamation. <br />\n- No trashing of other peoples topics (i.e. SPAM). <br />\n- No links to warez or crack sites. <br />\n- No serials, CD keys, passwords or crack, trackers or money-making sites. <br />\n- No requesting if the release is over 7 days old. <br />\n- No bumping... (All bumped threads will be deleted.) <br />\n- No double posting. If you wish to post again, and yours is the last post in the thread please use the EDIT function,instead of posting a double. <br />\n- Please ensure all questions are posted in the correct section! <br />\n- No advertising. <br />\n- Mentioning other sites is allowed as long as you are not promoting it <br />\n- No requesting of downloads. <br />\n- No questions about when anything will be uploaded. <br />\n-No pictures with racism/nudity/sexism/religion are to be posted in the forum.\n[If you really need to post it, only post the link with a **18+** tag around it.] <br>\n- Use the search before posting anything, your thread will get locked if you dont. <br>', NULL, NULL),
(3, 'Moderating Rules', '- The most important rule!; Use your better judgement! <br />\n- Don\'t defy another mod in public, instead send a PM or make a post in the \"Site admin\". <br />\n- Be tolerant! give the user(s) a chance to reform. <br />\n- Don\'t act prematurely, Let the users make their mistake and THEN correct them. <br />\n- Try correcting any \"off topics\" rather then closing the thread. <br />\n- Move topics rather than locking / deleting them. <br />\n- Be tolerant when moderating the Chit-chat section. (give them some slack) <br />\n- If you lock a topic, Give a brief explanation as to why you\'re locking it. <br />\n- Before banning a user, Send him/her a PM and If they reply, put them on a 2 week trial. <br />\n- Don\'t ban a user until he or she has been a member for at least 4 weeks. <br />\n- Always state a reason (in the user comment box) as to why the user is being banned. <br />\n', NULL, NULL),
(4, 'Downloading Rules', '- Keep your overall ratio at or above 0.5 at all times! <br />\n\n- Cheating is not allowed, if either we or our system finds out you\'ll receive an immediate ban.  <br>\n\n- DHT and PEX (Peer Exchange) must be disabled on all clients. <br>\n\n- Banned clients are not allowed. Refer to the FAQs. <br>', NULL, NULL),
(5, 'Forum Guidelines', '- We advise you not to write any contact details e.g. address, email address or IP on the forum or in your profile for your own privacy. <br>\r\n\r\n- Whenever you have something to add and there hasnt been made a new post, use the edit function. This means no bumping as well. <br>\r\n\r\n- Posting in CAPS LOCK is very often taken as screaming and is therefore not appreciated. Nor is posting entire posts in a very huge size. <br>\r\n\r\n- Please ensure all threads are posted in the correct section! <br>', NULL, NULL),
(6, 'Avatar Rules', '- Do not use any avatar that may cause members to confuse you as a staff member. <br>\r\n\r\n- Your avatar may not include any racism/nudity/sexism/religion or something which is easily taken as an offence.\r\n[If you\'re in doubt whether something is appropriate or not feel free to message a staff member.] <br>\r\n\r\n- Maximum sizes are 200px x 300px. <br>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `torrents`
--

DROP TABLE IF EXISTS `torrents`;
CREATE TABLE IF NOT EXISTS `torrents` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `info_hash` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `poster` varchar(200) DEFAULT NULL,
  `image1` varchar(200) DEFAULT NULL,
  `image2` varchar(200) DEFAULT NULL,
  `image3` varchar(200) DEFAULT NULL,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `size` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `numfiles` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `comments` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `downs` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `times_completed` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `leechers` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `seeders` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `visible` enum('yes','no') NOT NULL DEFAULT 'no',
  `banned` enum('yes','no') NOT NULL DEFAULT 'no',
  `anon` enum('yes','no') NOT NULL DEFAULT 'no',
  `nfo` enum('yes','no') NOT NULL DEFAULT 'no',
  `announce` varchar(255) NOT NULL,
  `external` enum('yes','no') NOT NULL DEFAULT 'no',
  `freeleech` enum('yes','no') NOT NULL DEFAULT 'no',
  `thanks` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `uploader_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `uploader` (`uploader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `torrents`
--

INSERT INTO `torrents` (`id`, `info_hash`, `name`, `filename`, `description`, `poster`, `image1`, `image2`, `image3`, `category_id`, `size`, `numfiles`, `views`, `comments`, `downs`, `times_completed`, `leechers`, `seeders`, `visible`, `banned`, `anon`, `nfo`, `announce`, `external`, `freeleech`, `thanks`, `uploader_id`, `created_at`, `updated_at`) VALUES
(26, '4092b6c8cbc9ae7cec700a1ff1dc43a72ae31f28', '321membership', '321membership.rar', 'dasd', '', '', '', '', 6, 321737, 1, 3, 0, 4, 0, 0, 0, 'yes', 'no', 'no', 'no', 'http://devlop.net/announce', 'no', 'no', 0, 7, '2018-02-26 13:37:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `torrent_categories`
--

DROP TABLE IF EXISTS `torrent_categories`;
CREATE TABLE IF NOT EXISTS `torrent_categories` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `icon` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `torrent_categories`
--

INSERT INTO `torrent_categories` (`id`, `name`, `slug`, `icon`) VALUES
(1, 'Movies', 'movies', 'fa fa-film'),
(2, 'TV', 'tv', 'fa fa-television'),
(3, 'Music', 'music', 'fa fa-music'),
(4, 'E-Book', 'ebook', ''),
(5, 'XXX', 'xxx', ''),
(6, 'Applications', 'applications', '');

-- --------------------------------------------------------

--
-- Table structure for table `torrent_comments`
--

DROP TABLE IF EXISTS `torrent_comments`;
CREATE TABLE IF NOT EXISTS `torrent_comments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `ip` varchar(70) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `torrent_id` (`torrent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_completes`
--

DROP TABLE IF EXISTS `torrent_completes`;
CREATE TABLE IF NOT EXISTS `torrent_completes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `torrent_id` (`torrent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_files`
--

DROP TABLE IF EXISTS `torrent_files`;
CREATE TABLE IF NOT EXISTS `torrent_files` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `length` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `torrent_id` (`torrent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `torrent_files`
--

INSERT INTO `torrent_files` (`id`, `torrent_id`, `length`, `path`, `created_at`, `updated_at`) VALUES
(47, 26, 321737, '321membership.rar', '2018-02-26 13:37:28', '2018-02-26 13:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `torrent_peers`
--

DROP TABLE IF EXISTS `torrent_peers`;
CREATE TABLE IF NOT EXISTS `torrent_peers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `peer_id` varchar(45) NOT NULL,
  `ip` varchar(70) NOT NULL,
  `port` smallint(2) UNSIGNED NOT NULL,
  `uploaded` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `downloaded` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `to_go` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `seeder` enum('yes','no') NOT NULL DEFAULT 'no',
  `connectable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `client` varchar(70) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `passkey` varchar(45) NOT NULL,
  `started` datetime DEFAULT NULL,
  `lastaction` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `torrent_id` (`torrent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_ratings`
--

DROP TABLE IF EXISTS `torrent_ratings`;
CREATE TABLE IF NOT EXISTS `torrent_ratings` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `ip` varchar(70) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `torrent_id` (`torrent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(75) NOT NULL,
  `status` enum('confirmed','pending') NOT NULL DEFAULT 'pending',
  `banned` enum('yes','no') NOT NULL DEFAULT 'no',
  `privacy` enum('public','friends','private') NOT NULL DEFAULT 'public',
  `class` enum('member','memberplus','vip','uploader','moderator','moderatorplus','admin','boss') NOT NULL DEFAULT 'member',
  `dob` date DEFAULT '0000-00-00',
  `info` tinytext DEFAULT NULL,
  `acceptpms` enum('yes','no') NOT NULL DEFAULT 'yes',
  `codeactivation` varchar(45) DEFAULT NULL,
  `confirmresetpwd` enum('yes','no') DEFAULT NULL,
  `ip` varchar(70) NOT NULL,
  `signature` varchar(200) DEFAULT NULL,
  `avatar` varchar(190) DEFAULT '/imgs/default_avatar.jpg',
  `uploaded` bigint(20) NOT NULL DEFAULT 0,
  `downloaded` bigint(20) NOT NULL DEFAULT 0,
  `title` tinytext DEFAULT NULL,
  `estate_id` int(11) UNSIGNED NOT NULL,
  `sex` enum('na','female','male') DEFAULT NULL,
  `passkey` varchar(35) NOT NULL,
  `points` int(10) NOT NULL DEFAULT 1000,
  `invites` tinyint(3) UNSIGNED DEFAULT 0,
  `warn` enum('yes','no') NOT NULL DEFAULT 'no',
  `donated` decimal(10,2) NOT NULL DEFAULT 0.00,
  `maxslots` tinyint(5) UNSIGNED NOT NULL DEFAULT 1,
  `lastlogin` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `actived_at` datetime DEFAULT NULL,
  `resetpwd_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estate_id` (`estate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `passwd`, `status`, `banned`, `privacy`, `class`, `dob`, `info`, `acceptpms`, `codeactivation`, `confirmresetpwd`, `ip`, `signature`, `avatar`, `uploaded`, `downloaded`, `title`, `estate_id`, `sex`, `passkey`, `points`, `invites`, `warn`, `donated`, `maxslots`, `lastlogin`, `created_at`, `updated_at`, `actived_at`, `resetpwd_at`) VALUES
(1, 'System', 'system@track.org', '$2y$10$2VH1evFcDK1i8Bf1p4mUhOqMdpii1JxluNdeS2AxCgd2vciljo8i.', 'confirmed', 'no', 'private', 'moderatorplus', '0000-00-00', NULL, 'no', NULL, NULL, '::1', NULL, '/imgs/default_avatar.jpg', 0, 2, NULL, 17, 'na', '07cc694b9b3fc636710fa08b6922c42b', 1020, 0, 'no', '0.00', 4, '2018-01-24 13:50:08', '2017-08-10 16:55:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 'Bot', 'bot@track.org', '$2y$10$2VH1evFcDK1i8Bf1p4mUhOqMdpii1JxluNdeS2AxCgd2vciljo8i.', 'confirmed', 'no', 'private', 'admin', '0000-00-00', NULL, 'no', NULL, NULL, '::1', NULL, '/imgs/default_avatar.jpg', 0, 4, NULL, 17, 'na', '639ceb123a0b22b21b722d6cd9a0ee8e', 1030, 0, 'no', '0.00', 4, '2018-01-28 19:20:38', '2017-08-10 16:55:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(7, 'admin', 'me@me.com', '$2y$10$6tqHX2zZPPHW7wj7c1U8yO6Ty6fN3.yqUL2mH6Kbu3yeytMYMCdle', 'confirmed', 'no', 'public', 'admin', '0000-00-00', 'dasdasdasda', 'yes', NULL, 'yes', '::1', '', '/imgs/default_avatar.jpg', 0, 6, '', 25, 'male', '7627cb9027e713e301e83a8f13057055', 1800, 0, 'no', '0.00', 4, '2018-02-16 18:47:49', '2018-01-24 17:17:06', '2018-02-22 15:15:18', '2018-01-26 15:14:11', '2018-01-25 20:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 8),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_warnings`
--

DROP TABLE IF EXISTS `user_warnings`;
CREATE TABLE IF NOT EXISTS `user_warnings` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `warned_by` int(11) UNSIGNED NOT NULL,
  `type` varchar(45) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `expiry` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `warned_by` (`warned_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`categ_id`) REFERENCES `faq_categs` (`id`);

--
-- Constraints for table `invites`
--
ALTER TABLE `invites`
  ADD CONSTRAINT `invites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invites_ibfk_2` FOREIGN KEY (`accepted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD CONSTRAINT `poll_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `poll_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_polls`
--
ALTER TABLE `poll_polls`
  ADD CONSTRAINT `poll_polls_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `poll_answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poll_polls_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `poll_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poll_polls_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_questions`
--
ALTER TABLE `poll_questions`
  ADD CONSTRAINT `poll_questions_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`dealt_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `role_perms`
--
ALTER TABLE `role_perms`
  ADD CONSTRAINT `role_perms_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_perms_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`perm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `torrents`
--
ALTER TABLE `torrents`
  ADD CONSTRAINT `torrents_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `torrent_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `torrents_ibfk_2` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `torrent_comments`
--
ALTER TABLE `torrent_comments`
  ADD CONSTRAINT `torrent_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `torrent_comments_ibfk_2` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `torrent_completes`
--
ALTER TABLE `torrent_completes`
  ADD CONSTRAINT `torrent_completes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `torrent_completes_ibfk_2` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `torrent_files`
--
ALTER TABLE `torrent_files`
  ADD CONSTRAINT `torrent_files_ibfk_1` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `torrent_peers`
--
ALTER TABLE `torrent_peers`
  ADD CONSTRAINT `torrent_peers_ibfk_1` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torrent_peers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `torrent_ratings`
--
ALTER TABLE `torrent_ratings`
  ADD CONSTRAINT `torrent_ratings_ibfk_1` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torrent_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
