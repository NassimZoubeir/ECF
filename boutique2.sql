-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 06 juil. 2023 à 07:45
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique2`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_Article` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_Article`, `nom`, `description`) VALUES
(1, 'aut', 'Delectus quaerat deserunt quae tempore voluptatem itaque ipsa.'),
(2, 'quibusdam', 'Necessitatibus voluptas adipisci voluptas sint dolores voluptas natus.'),
(3, 'debitis', 'Illo dicta sed culpa voluptatem accusantium et voluptatem.'),
(4, 'velit', 'Repellendus neque rem possimus.'),
(5, 'explicabo', 'Laudantium et eum commodi rerum quo sint et atque.'),
(6, 'veniam', 'Itaque dolore ipsum necessitatibus est architecto illum necessitatibus.'),
(7, 'numquam', 'Sed similique doloremque enim quaerat dolor omnis.'),
(8, 'quam', 'Officia error ut tempora.'),
(9, 'voluptatibus', 'Aliquid fuga consequuntur non quaerat velit soluta.'),
(10, 'molestiae', 'Aliquid aut cum sed eos error distinctio tempore.'),
(11, 'asperiores', 'Natus doloribus molestias ut harum.'),
(12, 'totam', 'Rem eius in asperiores qui pariatur.'),
(13, 'dignissimos', 'Id quasi sit fuga totam quis.'),
(14, 'laudantium', 'Laudantium fugiat placeat molestiae non et laudantium rerum provident.'),
(15, 'ut', 'Voluptatem non dolores blanditiis minima nulla.'),
(16, 'non', 'Aut officia quia est id aliquam vero aut.'),
(17, 'laudantium', 'Reprehenderit rem architecto reprehenderit id similique consequatur.'),
(18, 'fugiat', 'Amet explicabo praesentium molestias unde nesciunt maxime vero culpa.'),
(19, 'nemo', 'Veniam beatae doloribus quisquam voluptates.'),
(20, 'occaecati', 'Earum vel exercitationem eos sed et.');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_Commentaire` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_Utilisateur` int(11) NOT NULL,
  `id_Liste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_Commentaire`, `description`, `date`, `id_Utilisateur`, `id_Liste`) VALUES
(1, 'Itaque quo maxime et dicta ea facilis dolores.', '2004-02-20', 7, 5),
(2, 'Eaque est eum molestiae reiciendis ut consequuntur consequatur repudiandae.', '1984-03-25', 3, 2),
(3, 'Illo et consequatur sit et consequatur maxime.', '2013-09-02', 2, 2),
(4, 'Nostrum amet maiores nostrum unde id laboriosam.', '1988-09-08', 3, 2),
(5, 'Et eos ut aut iusto nulla at beatae.', '1972-04-16', 3, 2),
(6, 'Iste vel ut consectetur nihil occaecati.', '2011-10-21', 6, 1),
(7, 'Non cum omnis aliquam non molestiae voluptate.', '2006-11-07', 10, 5),
(8, 'Cupiditate corporis et deserunt et culpa minima.', '1981-09-24', 10, 2),
(9, 'Molestias inventore numquam voluptatem consectetur nesciunt.', '1996-05-21', 8, 1),
(10, 'Maxime quo saepe non illo sit harum nihil.', '2000-05-29', 5, 3),
(11, 'Aut perferendis ut incidunt hic aut.', '2021-09-26', 4, 3),
(12, 'Aut quidem deleniti mollitia eligendi.', '1973-02-02', 4, 1),
(13, 'Voluptates nihil dolore et eius exercitationem.', '2021-10-10', 9, 5),
(14, 'Ut velit nulla sint sunt tempore architecto ut.', '2017-11-08', 2, 4),
(15, 'Ut aliquid quis blanditiis modi reiciendis est dicta.', '1985-10-19', 2, 5),
(16, 'Voluptates aut perspiciatis cupiditate consequuntur cupiditate repudiandae.', '2007-04-22', 3, 1),
(17, 'Dicta minima saepe voluptas.', '2020-09-20', 4, 2),
(18, 'Rerum culpa dolores voluptate hic est.', '1988-02-12', 6, 3),
(19, 'Error earum aut et molestias dolorem aut aspernatur.', '1988-11-17', 2, 5),
(20, 'In ea quia tempora tempora.', '2009-01-20', 3, 3),
(21, 'Consequatur a aspernatur commodi fuga neque.', '1987-03-14', 8, 3),
(22, 'Iusto fuga error quasi ea nesciunt.', '2004-02-15', 1, 5),
(23, 'Laudantium incidunt assumenda voluptatibus pariatur maxime ad impedit.', '1976-07-09', 6, 3),
(24, 'Et cupiditate animi omnis voluptates consequatur.', '1980-04-01', 5, 2),
(25, 'Et omnis et rerum placeat doloremque.', '1991-07-26', 2, 1),
(26, 'Odit eum ex harum iure blanditiis.', '1982-09-04', 2, 4),
(27, 'Necessitatibus cum occaecati eveniet eius.', '2002-07-23', 1, 3),
(28, 'Soluta vel omnis deleniti nam eveniet consectetur.', '1999-11-27', 7, 1),
(29, 'Cum earum incidunt et error.', '2000-09-13', 9, 2),
(30, 'Labore quod aspernatur eveniet ducimus consequatur et quo.', '2002-10-02', 5, 1),
(31, 'Qui esse quisquam corrupti maiores nostrum ipsam.', '2017-01-05', 5, 2),
(32, 'Aut sint qui fugiat recusandae aut.', '2009-10-29', 1, 2),
(33, 'Iure aut nihil et dolor ut magni.', '2013-12-15', 5, 1),
(34, 'Aut dicta similique qui aut sit.', '2006-01-18', 7, 4),
(35, 'Autem in nesciunt quia accusamus.', '1991-06-28', 1, 5),
(36, 'Ut iste qui illum et.', '1978-05-09', 3, 4),
(37, 'Aut voluptas deleniti odit vero fuga.', '1976-06-22', 9, 4),
(38, 'Aut ratione praesentium facilis nemo.', '1985-02-01', 2, 2),
(39, 'Id enim voluptas qui ipsa ea quas.', '2009-02-19', 6, 2),
(40, 'Voluptatum omnis id doloribus quia ut sed.', '2001-03-12', 8, 2),
(41, 'Reprehenderit tempora maiores nisi labore rerum.', '1980-02-06', 7, 3),
(42, 'Id sint ratione magni ipsa non cumque.', '1984-06-13', 3, 1),
(43, 'Voluptas maiores nisi quae soluta veniam.', '2001-08-30', 9, 4),
(44, 'Accusantium nihil enim impedit rerum voluptas harum.', '2010-09-12', 9, 1),
(45, 'Quia ipsum vitae id amet voluptatem.', '1987-02-17', 4, 5),
(46, 'Ut voluptas eligendi exercitationem.', '1971-11-05', 6, 1),
(47, 'Deserunt pariatur neque eveniet voluptas deleniti in.', '2006-06-07', 7, 4),
(48, 'Atque quia quidem odit eos dignissimos.', '1996-02-06', 5, 2),
(49, 'Dignissimos velit praesentium voluptatem velit.', '1972-09-10', 9, 4),
(50, 'Ipsa sequi et atque sit voluptatem veritatis.', '2023-04-13', 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `id_Liste` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_Utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`id_Liste`, `nom`, `description`, `date`, `id_Utilisateur`) VALUES
(1, 'laboriosam', 'Aut sequi rerum ab laborum id ratione ut odio.', '1977-12-18', 8),
(2, 'ut', 'Aut aliquid sed saepe corporis quia quia sunt.', '1973-12-19', 10),
(3, 'voluptatem', 'Exercitationem a tempore dolorem exercitationem exercitationem quo quibusdam.', '2000-05-29', 7),
(4, 'est', 'Aut dolores delectus repellat vitae eos et.', '2020-05-10', 1),
(5, 'numquam', 'Earum nihil aut libero quod sint repellendus fugiat.', '2003-09-20', 5);

-- --------------------------------------------------------

--
-- Structure de la table `liste_has_article`
--

CREATE TABLE `liste_has_article` (
  `id_Liste` int(11) NOT NULL,
  `id_Article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `liste_has_article`
--

INSERT INTO `liste_has_article` (`id_Liste`, `id_Article`) VALUES
(2, 9),
(3, 4),
(5, 18),
(5, 17),
(3, 13),
(5, 10),
(2, 13),
(5, 18),
(4, 13),
(5, 1),
(1, 17),
(1, 6),
(4, 18),
(1, 1),
(3, 3),
(4, 3),
(3, 2),
(3, 14),
(5, 19),
(2, 2),
(5, 19),
(4, 18),
(2, 11),
(2, 19),
(4, 19),
(3, 14),
(4, 7),
(2, 2),
(1, 12),
(2, 4),
(4, 11),
(3, 20),
(2, 1),
(5, 6),
(2, 9),
(1, 18),
(4, 10),
(3, 19),
(2, 17),
(3, 9),
(1, 7),
(1, 7),
(1, 17),
(5, 5),
(3, 12),
(5, 20),
(5, 7),
(3, 20),
(4, 18),
(5, 7),
(1, 18),
(1, 19),
(5, 15),
(2, 8),
(1, 6),
(5, 19),
(5, 1),
(3, 16),
(1, 15),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_Utilisateur` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mp` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `avatar` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_Utilisateur`, `nom`, `email`, `mp`, `isActive`, `role`, `avatar`) VALUES
(1, 'Neoma Rosenbaum', 'igerhold@crona.org', 'JS3cIHRm', 0, 1, 'http://www.schulist.com/dolorem-ratione-expedita-culpa-placeat-quaerat-voluptas-animi'),
(2, 'Prof. Nathanael VonRueden', 'zelda.keebler@yahoo.com', 'W3F/;iN', 0, 3, 'http://www.harvey.com/officiis-nisi-veritatis-corrupti-et-voluptatibus-rem'),
(3, 'Camille Dietrich', 'leannon.edmond@gmail.com', 'q(.KcZ\'', 1, 3, 'http://gerlach.com/vel-ab-in-tempora-aliquid'),
(4, 'Dovie Reichert', 'johnson.titus@yahoo.com', 'pFz\"gP.X[]*X', 0, 2, 'http://www.considine.com/corrupti-repudiandae-harum-quae-repellat-omnis.html'),
(5, 'Sedrick Witting', 'tkuhn@steuber.com', 'LWy^)cnl20r3!3De\'d2', 0, 2, 'http://www.walter.com/rerum-velit-repellendus-sint-commodi-tempora.html'),
(6, 'Clair Schinner', 'leola.corkery@hotmail.com', '?t1`yzp-\"y;=uQG,^', 1, 1, 'http://www.kirlin.org/'),
(7, 'Luigi Smitham', 'kerluke.ross@yahoo.com', '_h6;,(bRRM', 0, 2, 'http://www.ohara.com/voluptatem-vero-ad-voluptatum-officia-nulla-veniam'),
(8, 'Katarina Marvin IV', 'letitia.jacobs@hotmail.com', 'SMAjqkbhO', 0, 2, 'http://www.little.com/'),
(9, 'Mr. Aric Beer MD', 'kallie.abshire@schowalter.com', '9Q8w}V7E]/:40gM^L', 1, 1, 'http://wehner.org/voluptate-hic-voluptatem-a-minus'),
(10, 'Prof. Gerry Crooks', 'maude.bosco@hotmail.com', 'wPdx\\3$67ZF\"j5YzN.3', 0, 2, 'http://www.jenkins.com/');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_Article`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_Commentaire`),
  ADD KEY `fk_Commentaire_Utilisateur1_idx` (`id_Utilisateur`),
  ADD KEY `fk_Commentaire_Liste1_idx` (`id_Liste`);

--
-- Index pour la table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id_Liste`),
  ADD KEY `fk_Liste_Utilisateur1_idx` (`id_Utilisateur`);

--
-- Index pour la table `liste_has_article`
--
ALTER TABLE `liste_has_article`
  ADD KEY `fk_Liste_has_Article_Article1_idx` (`id_Article`),
  ADD KEY `fk_Liste_has_Article_Liste_idx` (`id_Liste`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_Utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_Commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `id_Liste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_Utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_Commentaire_Liste1` FOREIGN KEY (`id_Liste`) REFERENCES `liste` (`id_Liste`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Commentaire_Utilisateur1` FOREIGN KEY (`id_Utilisateur`) REFERENCES `utilisateur` (`id_Utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `fk_Liste_Utilisateur1` FOREIGN KEY (`id_Utilisateur`) REFERENCES `utilisateur` (`id_Utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `liste_has_article`
--
ALTER TABLE `liste_has_article`
  ADD CONSTRAINT `fk_Liste_has_Article_Article1` FOREIGN KEY (`id_Article`) REFERENCES `article` (`id_Article`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Liste_has_Article_Liste` FOREIGN KEY (`id_Liste`) REFERENCES `liste` (`id_Liste`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
