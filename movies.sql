-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2022 at 08:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `content` varchar(150) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `rating` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `comment_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `title` varchar(100) NOT NULL,
  `release_date` date DEFAULT NULL,
  `poster` varchar(100) NOT NULL,
  `synopsis` varchar(3000) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`title`, `release_date`, `poster`, `synopsis`, `movie_id`) VALUES
('Red Notice', '2021-11-12', 'red_notice.jpg', 'Lorsqu’Interpol déclenche une Alerte Rouge – destinée à traquer et capturer les criminels les plus recherchés au monde –, le FBI fait appel à son meilleur profiler, John Hartley. Il sillonne la planète jusqu’au jour où il se retrouve embarqué dans un braquage spectaculaire et contraint de s’associer au plus grand voleur d’œuvres d’art au monde Nolan Booth pour… arrêter la voleuse d’œuvres d’art la plus recherchée au monde, « le Fou ».\r\n', 2),
('Agents presque secrets', '2016-08-24', 'central_intelligence.jpg', 'Un ancien geek devenu agent d’élite à la CIA, revient chez lui à l’occasion de la réunion des anciens du lycée dont il était à l’époque le souffre-douleur. Se vantant d’être sur une affaire top secrète, il recrute alors pour le seconder le gars le plus populaire de sa promo d’alors, aujourd’hui comptable désabusé. Avant même que notre col blanc ne réalise ce dans quoi il s’est embarqué, il est trop tard pour faire marche arrière. Le voilà propulsé sans autre cérémonie par son nouveau « meilleur ami » dans le monde du contre-espionnage où, sous le feu croisé des balles et des trahisons, les statistiques de leur survie deviennent bien difficile à chiffrer… même pour un comptable.', 3),
('Mourir peut attendre', '2021-10-06', 'no_time_to_die.jpg', 'Dans MOURIR PEUT ATTENDRE, Bond a quitté les services secrets et coule des jours heureux en Jamaïque. Mais sa tranquillité est de courte durée car son vieil ami Felix Leiter de la CIA débarque pour solliciter son aide : il s\'agit de sauver un scientifique qui vient d\'être kidnappé. Mais la mission se révèle bien plus dangereuse que prévu et Bond se retrouve aux trousses d\'un mystérieux ennemi détenant de redoutables armes technologiques…', 4),
('Rocky', '1977-03-23', 'rocky.jpg', 'Dans les quartiers populaires de Philadelphie, Rocky Balboa collecte des dettes non payées pour Tony Gazzo, un usurier, et dispute de temps à autre, pour quelques dizaines de dollars, des combats de boxe sous l\'appellation de \"l\'étalon italien\". Cependant, Mickey, son vieil entraîneur, le laisse tomber. Son ami Paulie, qui travaille dans un entrepôt frigorifique, encourage Rocky à sortir avec sa soeur Adrian, une jeune vendeuse réservée d\'un magasin d\'animaux domestiques.\r\nPendant ce temps, Apollo Creed, le champion du monde de boxe catégorie poids lourd, recherche un nouvel adversaire pour remettre son titre en jeu. Son choix se portera sur Rocky.', 5),
('Rambo', '1983-03-02', '5296343.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'John Rambo, ancien combattant du Viêt-nam où il a gagné plusieurs médailles, est arrêté dans une petite ville pour vagabondage.Maltraité, il décide de fuir. La chasse à l’homme commence…', 14),
('Rocky II', '1980-02-06', '331381.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Après avoir fait trembler le champion Apollo Creed, Rocky Balboa obtient le droit de l\'affronter à nouveau. Apollo Creed ne supporte en effet pas d\'avoir été ainsi bousculé...', 31),
('Rocky III', '1983-01-12', '19106061.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Rocky Balboa est aujourd\'hui un champion respecté après sa victoire contre Apollo Creed. Mais lorsqu\'il perd contre un nouveau venu sur le circuit, c\'est Apollo Creed lui-même qui va venir à sa rescousse et lui redonner le goût du combat et de la victoire.\r\n', 32),
('Rocky IV', '1986-01-22', '198079.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Apollo Creed, ancien adversaire et dorénavant ami de Rocky Balboa, est tué sur le ring par le boxeur russe Ivan Drago. Se reprochant de n\'avoir pu sauver son camarade à temps, Rocky va demander un combat contre Ivan Drago afin de le venger. Une confrontation qui se déroulera sur le sol russe.', 33),
('Rocky V', '1990-12-19', '557323.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Des séquelles physiques irréversibles amènent Rocky Balboa à prendre sa retraite. Ruiné, il devient l\'entraîneur d\'un champion en devenir, Tommy Gunn. Mais celui-ci ne va pas rester insensible à l\'appât du gain et va quitter Rocky pour rejoindre les rangs d\'un coach plus fortuné.', 34),
('Rocky Balboa', '2007-01-24', '18708488.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Rocky Balboa, le légendaire boxeur, a depuis longtemps quitté le ring. De ses succès, il ne reste plus que des histoires qu\'il raconte aux clients de son restaurant. La mort de son épouse lui pèse chaque jour et son fils ne vient jamais le voir.\r\nLe champion d\'aujourd\'hui s\'appelle Mason Dixon, et tout le monde s\'accorde à le définir comme un tueur sans élégance ni coeur. Alors que les promoteurs lui cherchent désespérément un adversaire à sa taille, la légende de Rocky refait surface. L\'idée d\'opposer deux écoles, deux époques et deux titans aussi différents enflamme tout le monde. Pour Balboa, c\'est l\'occasion de ranimer les braises d\'une passion qui ne l\'a jamais quitté. L\'esprit d\'un champion ne meurt jamais...', 35),
('Le loup de Wall Street', '2013-12-25', '21060483_20131125114549726.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'L’argent. Le pouvoir. Les femmes. La drogue. Les tentations étaient là, à portée de main, et les autorités n’avaient aucune prise. Aux yeux de Jordan et de sa meute, la modestie était devenue complètement inutile. Trop n’était jamais assez…', 38),
('Casino Royale', '2006-11-22', '18674702.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Pour sa première mission, James Bond affronte le tout-puissant banquier privé du terrorisme international, Le Chiffre. Pour achever de le ruiner et démanteler le plus grand réseau criminel qui soit, Bond doit le battre lors d\'une partie de poker à haut risque au Casino Royale. La très belle Vesper, attachée au Trésor, l\'accompagne afin de veiller à ce que l\'agent 007 prenne soin de l\'argent du gouvernement britannique qui lui sert de mise, mais rien ne va se passer comme prévu.\r\nAlors que Bond et Vesper s\'efforcent d\'échapper aux tentatives d\'assassinat du Chiffre et de ses hommes, d\'autres sentiments surgissent entre eux, ce qui ne fera que les rendre plus vulnérables...', 39),
('Quantum Of Solace', '2008-10-31', '18996229.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Même s\'il lutte pour ne pas faire de sa dernière mission une affaire personnelle, James Bond est décidé à traquer ceux qui ont forcé Vesper à le trahir. En interrogeant Mr White, 007 et M apprennent que l\'organisation à laquelle il appartient est bien plus complexe et dangereuse que tout ce qu\'ils avaient imaginé...\r\nBond croise alors la route de la belle et pugnace Camille, qui cherche à se venger elle aussi. Elle le conduit sur la piste de Dominic Greene, un homme d\'affaires impitoyable et un des piliers de la mystérieuse organisation. Au cours d\'une mission qui l\'entraîne en Autriche, en Italie et en Amérique du Sud, Bond découvre que Greene manoeuvre pour prendre le contrôle de l\'une des ressources naturelles les plus importantes au monde en utilisant la puissance de l\'organisation et en manipulant la CIA et le gouvernement britannique...\r\n', 40),
('Skyfall', '2012-10-26', '20264212.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Lorsque la dernière mission de Bond tourne mal, plusieurs agents infiltrés se retrouvent exposés dans le monde entier. Le MI6 est attaqué, et M est obligée de relocaliser l’Agence. Ces événements ébranlent son autorité, et elle est remise en cause par Mallory, le nouveau président de l’ISC, le comité chargé du renseignement et de la sécurité. Le MI6 est à présent sous le coup d’une double menace, intérieure et extérieure. Il ne reste à M qu’un seul allié de confiance vers qui se tourner : Bond. Plus que jamais, 007 va devoir agir dans l’ombre. Avec l’aide d’Eve, un agent de terrain, il se lance sur la piste du mystérieux Silva, dont il doit identifier coûte que coûte l’objectif secret et mortel…', 41),
('007 Spectre', '2015-11-10', '344427.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Un message cryptique surgi du passé entraîne James Bond dans une mission très personnelle à Mexico puis à Rome, où il rencontre Lucia Sciarra, la très belle veuve d’un célèbre criminel. Bond réussit à infiltrer une réunion secrète révélant une redoutable organisation baptisée Spectre.\r\nPendant ce temps, à Londres, Max Denbigh, le nouveau directeur du Centre pour la Sécurité Nationale, remet en cause les actions de Bond et l’existence même du MI6, dirigé par M. Bond persuade Moneypenny et Q de l’aider secrètement à localiser Madeleine Swann, la fille de son vieil ennemi, Mr White, qui pourrait détenir le moyen de détruire Spectre. Fille de tueur, Madeleine comprend Bond mieux que personne…\r\nEn s’approchant du cœur de Spectre, Bond va découvrir qu’il existe peut-être un terrible lien entre lui et le mystérieux ennemi qu’il traque…', 42),
('Le Mans 66', '2019-11-13', '5193325.jpg-c_310_420_x-f_jpg-q_x-xxyxx (1).jpg', 'Basé sur une histoire vraie, le film suit une équipe d\'excentriques ingénieurs américains menés par le visionnaire Carroll Shelby et son pilote britannique Ken Miles, qui sont envoyés par Henry Ford II pour construire à partir de rien une nouvelle automobile qui doit détrôner la Ferrari à la compétition du Mans de 1966.', 43),
('Top Gun', '1986-09-17', '422779.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Jeune as du pilotage et tête brûlée d\'une école réservée à l\'élite de l\'aéronavale US (\"Top Gun\"), Pete Mitchell, dit \"Maverick\", tombe sous le charme d\'une instructrice alors qu\'il est en compétition pour le titre du meilleur pilote...', 44),
('L\'étoffe des Héros', '1984-04-25', '18456796.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'L\'histoire de spationautes, aventuriers et intrépides, dont le destin fut intimement lié à celui d\'une des plus extraordinaires aventures qu\'ait connu l\'humanité : la conquête spatiale.', 45),
('Nimitz, retour vers l\'enfer', '1980-07-09', '18941292.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Le porte-avions USS Nimitz se retrouve en plein milieu du Pacifique au coeur d\'une tempête électromagnétique. Peu après, l\'équipage capte sur les fréquences radios des enregistrements datant de la Seconde Guerre Mondiale, dans lesquels les emetteurs parlent de l\'armée allemande en URSS. Plus étrange, des avions de reconnaissance ramènent des clichés de Pearl Harbor mais intact...', 46),
('Le Vol de l\'intruder', '1991-01-19', '19137303.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Le difficile parcours de Jake Grafton, pilote de l\'aéronavale américaine pendant la guerre du Vietnam. Alors que son co-pilote est tué, il remet en question les frappes aériennes de l\'armée américaine, et en particulier les ordres donnés par son supérieur cynique Virgil Cole...', 47),
('Expendables : unité spéciale', '2010-08-18', '19472891.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Ce ne sont ni des mercenaires, ni des agents secrets. Ils choisissent eux-mêmes leurs missions et n\'obéissent à aucun gouvernement. Ils ne le font ni pour l\'argent, ni pour la gloire, mais parce qu\'ils aident les cas désespérés.\r\nDepuis dix ans, Izzy Hands, de la CIA, est sur les traces du chef de ces hommes, Barney Ross. Parce qu\'ils ne sont aux ordres de personne, il devient urgent de les empêcher d\'agir. Eliminer un général sud-américain n\'est pas le genre de job que Barney Ross accepte, mais lorsqu\'il découvre les atrocités commises sur des enfants, il ne peut refuser. Avec son équipe d\'experts, Ross débarque sur l\'île paradisiaque où sévit le tyran. Lorsque l\'embuscade se referme sur eux, il comprend que dans son équipe, il y a un traître.\r\n', 48),
('Overdrive', '2017-08-16', '279623.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg', 'Les frères Andrew et Garrett Foster sont des pilotes d\'exception, mais aussi des voleurs d\'exception. Leur spécialité : voler les voitures les plus chères au monde. A Marseille, ils parviennent à dérober une sublime BUGATTI 1937, joyau de l’exceptionnelle collection de Jacomo Morier, parrain de la Mafia locale.  Ce dernier décide alors d’utiliser leur talent à son profit contre son ennemi juré, Max Klemp. Mais s’ils acceptent de rentrer dans ce jeu, c’est qu’ils ont en réalité conçu un coup d’une audace inégalée.', 49);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nickname` varchar(30) NOT NULL,
  `email` varchar(254) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_movie_id` (`movie_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
