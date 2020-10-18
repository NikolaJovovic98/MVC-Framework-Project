-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2020 at 10:44 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcinternetdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `user_id`, `body`, `date`) VALUES
(1, 13, 7, 'This is really good article ! I like it.', '2020-10-10 20:04:08'),
(4, 14, 1, 'Php is very very useful in order of creating MVC framework', '2020-10-10 21:38:36'),
(7, 13, 6, 'Well you should write more articles about this topic to be honest I think this is very short...', '2020-10-10 21:50:49'),
(8, 13, 4, 'Cmon guys cut me some slack !', '2020-10-10 22:03:31'),
(9, 13, 4, 'Hhahahha totally agree !', '2020-10-10 22:07:09'),
(10, 15, 4, 'Wow wow wow partner !', '2020-10-10 22:17:07'),
(11, 15, 4, 'Da ljubav je grijeh ne bi bilo pogresnih do ludila je do samoga bola zavolih i kad se u po bola pretvori u strah do mene i nje ostace onaj isti trag...', '2020-10-10 22:30:08'),
(12, 13, 4, 'Hey everybody how are you !', '2020-10-10 22:32:05'),
(13, 14, 4, 'Pavle totalni debil...', '2020-10-10 22:46:31'),
(24, 18, 14, 'Borko borko !', '2020-10-11 20:52:20'),
(25, 18, 14, 'Remind me what is love and for just a moment to be in love', '2020-10-11 20:56:21'),
(28, 14, 1, 'Model View Controller', '2020-10-12 16:55:07'),
(29, 13, 11, 'I&#39;ve been thinking about you', '2020-10-12 20:24:54'),
(31, 13, 1, 'Il mio nome e Giorgio pero tutti mi chiamano Gio', '2020-10-13 21:35:22'),
(32, 17, 1, 'Breaking us down', '2020-10-16 17:44:00'),
(33, 18, 7, 'Molto bene !', '2020-10-18 15:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `user_id` int(11) NOT NULL,
  `following_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`user_id`, `following_user_id`) VALUES
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(7, 8),
(7, 9),
(7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `synopsis` varchar(200) NOT NULL,
  `body` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `synopsis`, `body`) VALUES
(13, 7, 'How to create news article.', 'In this example we will show you steps of creating article for CRUD news.', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discov'),
(14, 7, 'Php tutorial MVC', 'How to create simple MVC framework ?', 'Kontroleri sluze za interakciju sa korisnikom i jedina komponenta koja suradjuje sa Modelom dakle korisnik zahtijeva stvari od kontrolera koji te stvari pronalazi u Modelu,kontroleri su zasluzni i za redirektovanje na druge stranice rad sa url-om vracanje view-a i slicno.Dakle logika je da kod kontrolera imamo odredjene metode tj akcije te metode se zasnivaju na CRUD tj create read update delete metodama svaki kontroler bi trebalo da ima ove metode ...npr metoda index sluzi za prikazivanje svih user-a ...metoda show sluzi za prikazivanje jednog user-a ...dakle u toj metodi pravimo odgovarajuci model i podatke toga modela smjestamo u neku varijablu koju prosljedjujemo view-u dakle u metodu vr'),
(15, 7, 'Build Your Own Framework!', 'Did you ever wonder how frameworks work ? Click to learn !', 'MVC - Model - View - Controller\r\n\r\nDakle, korisnik salje zahtijev kontroleru, zatim kontroler uzima podatke iz modela,vracu se u kontroler i on ih prosljedjuje view-u koji ih na kraju prikazuje korisniku nazad.\r\n\r\nKontroleri sluze za interakciju sa korisnikom i jedina komponenta koja suradjuje sa Modelom dakle korisnik zahtijeva stvari od kontrolera koji te stvari pronalazi u Modelu,kontroleri su zasluzni i za redirektovanje na druge stranice rad sa url-om vracanje view-a i slicno.Dakle logika je da kod kontrolera imamo odredjene metode tj akcije te metode se zasnivaju na CRUD tj create read update delete metodama svaki kontroler bi trebalo da ima ove metode ...npr metoda index sluzi za prikazivanje svih user-a ...metoda show sluzi za prikazivanje jednog user-a ...dakle u toj metodi pravimo odgovarajuci model i podatke toga modela smjestamo u neku varijablu koju prosljedjujemo view-u dakle u metodu vracemo odgovarajuci view zajedno sa podacima.\r\n\r\nModel je mjesto dje su podaci smjesteni on sluzi za interakciju sa podacima izmedju baze podataka.Dakle u modelu radimo stvari kao sto su upiti...model ima svoju instancu baze podataka tako da ima sve njene metode i preko modela radimo upite tj SELECT INSERT itd te metode modela kasnije u kontroleru koristimo nad modelom kojim smo tamo stvorili\r\n\r\nView je ono sto korisnik vidi na ekranu tj html nema baza podataka i nikakve logike oni nista ne znaju o Modelu vec im se prosljedjuju podaci iz kontrolera i onda je view zasluzan za prikazivanje tih podataka u odgovarajucem html formatu \r\n\r\nMVC modelom pravimo razliku izmedju dijela sajta zaduzenog za prikaz podataka i dijela sajta zaduzenog sa radom sa podacima \r\n\r\nPored ova tri pojma moramo implementirati jos neke kao sto su DATABASE tj mjesto dje cemo se konektovati na bazu podataka i dje cemo imati neke osnovne metode sa radom sa bazom ...moramo imati i ROUTE/CORE tj mjesto dje cemo implementirati logiku rutovanja naseg sajta dakle ukoliko imamo url localhost/mvcprojekat/users/index to znaci da trebamo da odradimo da ce se users tretirati kao kontroler a index kao metoda toga kontrolera tako da idemo logikom da je $url (localhost/mvcprojekat/users/index) uzimamo kao niz pa je $url[0]=kontroler $url[1]=akcija/metoda toga kontrolera $url[2] je neki parametar npr to je id od usera tako da moze biti localhost/mvcprojekat/users/show/4 u prevodu kontroler je users akcija je show a parametar je 4 u prevodu prikazi usera sa id-jem 4'),
(17, 1, 'How deep is your love ?', 'Cause we&#39;re living in the world of blues...continue to article.', '&#34;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&#34;\r\n\r\nSection 1.10.33 of &#34;de Finibus Bonorum et Malorum&#34;, written by Cicero in 45 BC\r\n&#34;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&#34;\r\n\r\n1914 translation by H. Rackham\r\n&#34;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&#34;'),
(18, 8, 'Medvjed Borko zdrav kao puce', 'Samo dva dana nakon postavljanja zamki, medvjed je uhvaćen u Pivi, a nakon stavljanja ogrlice kojom će pratiti njegovo kretanje i buđenja iz anestezije, z', 'Dva sata kasnije, dešava se ono što svi čekaju. I dalje niko nije siguran da li se alarm oglasio jer se u zamku uhvatio medvjed, jer može da bude i divlja svinja, ali - svi su na nogama i u rekordnom roku dogovaraju polazak za Borje, u Parku prirode (PP) “Piva”, gdje je dva dana ranije postavljena zamka.\r\n\r\nVeć oko 22 sata, Reljić, Nataša Barbić, doktorand Veterinarskog fakulteta Sveučilišta u Zagrebu, gdje je, iako živi u Australiji, gdje ih nema, izabrala da izučava medvjede, sreli su se u Plužinama sa nadzornikom PP “Piva” Ivanom Krunićem.\r\n\r\nIstovremeno, iz Podgorice je krenuo Aleksandar Perović, koji u Centru za zaštitu i proučavanje ptica (CZIP) od 2012. radi na programu istraživanja krupnih zvijeri. Za njega, ova nedjelja je posebna.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'dzona98', 'dzona@gmail.com', '$2y$10$WAn9JtPzDFBElijfWHmnCuZQm7oK4ZkyExIFxEwsl62.O6HfsbJ66'),
(4, 'pavle98', 'paka@gmail.com', '$2y$10$YAWWC4/tBgdZtQi4sqveEelXsg7PvfW/ad9LydsAblcjPCt2ZFuqS'),
(5, 'zlatko66', 'zlatkojov@yahoo.com', '$2y$10$j8zfNb6LsaQM/yRegh4jZeVvfOgzZ8V9.VXEaOWM5S0JefezRWqDy'),
(6, 'ranka72', 'ranka@gmail.com', '$2y$10$OJmKiDa5ApsJYuYTI3yeD.OdsjX3yYtTjdqJGMoEIFDWG3DqkznGe'),
(7, 'dybala1897', 'paolo@yahoo.com', '$2y$10$q3USrubSwj0c.caELHMX8uTYYOUj.9ON53a68OJAr7pZS2n91Reqa'),
(8, 'chiesa91', 'fchiesa@hotmail.com', '$2y$10$4lTujq5d1K.XtqdFDLYHP.z.NbHwIrLG68bjHO77/VJ6Vr5wPIFp.'),
(9, 'moratatata', 'alvaro@gmail.com', '$2y$10$6LhMMwUBPjFddA0cR9YJeOJ/NhfD488QvCz.w1Iur9.VMYCUE60NO'),
(10, 'bonucci88', 'leobony@yahoo.com', '$2y$10$vHfAKte0OClf1ginr5aj9e4d3dWZcpnoR.a6YX59J4zqaTRRxrmT.'),
(11, 'chielloKingKong', 'chiello@outlock.com', '$2y$10$9VNfsUBWCCsbkCqySPmoAuUyQG9EvYH4w9iVBrVT9v5vdKInqOEL6'),
(12, 'davidG', 'gilmour@pink.com', '$2y$10$ipl22J96Cm7mluRpNM/nMupAPxrysYaVPP.KXici2yxraI21duqUi'),
(13, 'delboy', 'dell@gmail.com', '$2y$10$NQr0xpDM18iO885dFoKiuea2gc.irtDd3CKvITzKnnSiQlwjOclFC'),
(14, 'robin99', 'robinwilliams@gmail.com', '$2y$10$1gzTR.sH2SEzc4aPupdl5.nO1t/QwwBA1Z8mcLrIQLyAiCf.Fyz7y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_NewsID` (`news_id`),
  ADD KEY `FK_UsersID` (`user_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`user_id`,`following_user_id`),
  ADD KEY `following_user_id` (`following_user_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserID` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_NewsID` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UsersID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
