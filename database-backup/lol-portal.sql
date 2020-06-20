-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Cze 2020, 14:48
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `lol-portal`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buffs`
--

CREATE TABLE `buffs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `icon` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `buffs`
--

INSERT INTO `buffs` (`id`, `name`, `description`, `duration`, `icon`) VALUES
(1, 'Hand_Of_Baron', 'Grants Empowered Recall Empowered Recall and nearby allied minions are greatly empowered. Gives 12 − 48 (based on minutes) bonus attack damage and 20 − 80 (based on minutes) ability power determined by the time the Baron is slain.', 180, 'https://vignette.wikia.nocookie.net/leagueoflegends/images/f/fc/Hand_of_Baron_buff.png/revision/latest?cb=20171223024258'),
(2, 'Eye_Of_The_Herald', 'PASSIVE - GLIMPSE OF THE VOID: The holder of this buff has Empowered Recall Empowered Recall. This passive is lost when the Eye is crushed.\nCONSUME - HERALD\'S CALL: Crushing the Eye of the Herald instigates a 1 second channel. If successful, you summon an allied Rift HeraldSquare Rift Herald to siege enemy structures. If interrupted, the Eye is lost. Herald\'s Call gets a 3-second cooldown if the holder of the Eye is in combat with non-minions.', 240, 'https://vignette.wikia.nocookie.net/leagueoflegends/images/c/c9/Eye_of_the_Herald_buff.png/revision/latest?cb=20171221180152'),
(3, 'Crest_Of_Cinders', 'PASSIVE: Basic attacks against non-turret units Slow icon slow by 10 / 15 / 25% (based on level) (percentage halved to 5 / 7.5 / 12.5% (based on level) when the basic attack is Ranged role ranged) for 3 seconds, and burns the target for 12 − 114 (based on level) Hybrid penetration icon true damage, applied in 3 ticks over 2 seconds, with the 1st tick of damage occurring on-hit and the next 2 ticks occurring each second thereafter. Applying this damage effect while a target is already affected by it refreshes the 2-second burn duration, but does not deal the on-hit damage.', 120, 'https://vignette.wikia.nocookie.net/leagueoflegends/images/0/07/Crest_of_Cinders_buff.png/revision/latest?cb=20191119112522'),
(4, 'Crest_Of_Insights', 'PASSIVE: Grants 10% Cooldown reduction icon cooldown reduction. If your champion uses Mana resource mana, restores 5 mana (a flat rate) plus 1% of maximum mana per second; if your champion uses Energy resource energy, instead restores 5 energy (a flat rate) plus 1% of maximum energy per second. If slain by an enemy Champion icon champion, this buff transfers to the killer.', 120, 'https://vignette.wikia.nocookie.net/leagueoflegends/images/6/6f/Crest_of_Insight_buff.png/revision/latest?cb=20191119112549');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `champions`
--

CREATE TABLE `champions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `icon` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `champions`
--

INSERT INTO `champions` (`id`, `name`, `title`, `icon`, `description`) VALUES
(1, 'Annie', 'the Dark Child', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Annie.png', 'Dangerous, yet disarmingly precocious, Annie is a child mage with immense pyromantic power. Even in the shadows of the mountains north of Noxus, she is a magical outlier. Her natural affinity for fire manifested early in life through unpredictable...'),
(2, 'Olaf', 'the BROserker', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Olaf.png', 'An unstoppable force of destruction, the axe-wielding Olaf wants nothing but to die in glorious combat. Hailing from the brutal Freljordian peninsula of Lokfar, he once received a prophecy foretelling his peaceful passing—a coward\'s fate, and a great...'),
(31, 'Cho\'Gath', 'the Terror of the Void', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Chogath.png', 'From the moment Cho\'Gath first emerged into the harsh light of Runeterra\'s sun, the beast was driven by the most pure and insatiable hunger. A perfect expression of the Void\'s desire to consume all life, Cho\'Gath\'s complex biology quickly converts...'),
(42, 'Corki', 'the Daring Bombardier', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Corki.png', 'The yordle pilot Corki loves two things above all others: flying, and his glamorous mustache... though not necessarily in that order. After leaving Bandle City, he settled in Piltover and fell in love with the wondrous machines he found there. He...'),
(51, 'Caitlyn', 'the Sheriff of Piltover', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Caitlyn.png', 'Renowned as its finest peacekeeper, Caitlyn is also Piltover\'s best shot at ridding the city of its elusive criminal elements. She is often paired with Vi, acting as a cool counterpoint to her partner\'s more impetuous nature. Even though she carries a...'),
(53, 'Blitzcrank', 'the Great Steam Golem', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Blitzcrank.png', 'Blitzcrank is an enormous, near-indestructible automaton from Zaun, originally built to dispose of hazardous waste. However, he found this primary purpose too restricting, and modified his own form to better serve the fragile people of the Sump...'),
(63, 'Brand', 'the Burning Vengeance', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Brand.png', 'Once a tribesman of the icy Freljord named Kegan Rodhe, the creature known as Brand is a lesson in the temptation of greater power. Seeking one of the legendary World Runes, Kegan betrayed his companions and seized it for himself—and, in an instant, the...'),
(69, 'Cassiopeia', 'the Serpent\'s Embrace', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Cassiopeia.png', 'Cassiopeia is a deadly creature bent on manipulating others to her sinister will. Youngest and most beautiful daughter of the noble Du Couteau family of Noxus, she ventured deep into the crypts beneath Shurima in search of ancient power. There, she was...'),
(75, 'Nasus', 'the Curator of the Sands', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Nasus.png', 'Nasus is an imposing, jackal-headed Ascended being from ancient Shurima, a heroic figure regarded as a demigod by the people of the desert. Fiercely intelligent, he was a guardian of knowledge and peerless strategist whose wisdom guided the ancient...'),
(164, 'Camille', 'the Steel Shadow', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Camille.png', 'Weaponized to operate outside the boundaries of the law, Camille is the Principal Intelligencer of Clan Ferros—an elegant and elite agent who ensures the Piltover machine and its Zaunite underbelly runs smoothly. Adaptable and precise, she views sloppy...'),
(201, 'Braum', 'the Heart of the Freljord', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Braum.png', 'Blessed with massive biceps and an even bigger heart, Braum is a beloved hero of the Freljord. Every mead hall north of Frostheld toasts his legendary strength, said to have felled a forest of oaks in a single night, and punched an entire mountain into...'),
(268, 'Azir', 'the Emperor of the Sands', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Azir.png', 'Azir was a mortal emperor of Shurima in a far distant age, a proud man who stood at the cusp of immortality. His hubris saw him betrayed and murdered at the moment of his greatest triumph, but now, millennia later, he has been reborn as an Ascended...'),
(432, 'Bard', 'the Wandering Caretaker', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Bard.png', 'A traveler from beyond the stars, Bard is an agent of serendipity who fights to maintain a balance where life can endure the indifference of chaos. Many Runeterrans sing songs that ponder his extraordinary nature, yet they all agree that the cosmic...'),
(433, 'Nautilus', 'the Titan of the Depths1', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Nautilus.png', 'A lonely legend as old as the first piers sunk in Bilgewater, the armored goliath known as Nautilus roams the dark waters off the coast of the Blue Flame Isles. Driven by a forgotten betrayal, he strikes without warning, swinging his enormous anchor to...'),
(434, 'Nidalee', 'the Bestial Huntress', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Nidalee.png', 'Raised in the deepest jungle, Nidalee is a master tracker who can shapeshift into a ferocious cougar at will. Neither wholly woman nor beast, she viciously defends her territory from any and all trespassers, with carefully placed traps and deft spear...'),
(435, 'Nocturne', 'the Eternal Nightmare', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Nocturne.png', 'A demonic amalgamation drawn from the nightmares that haunt every sentient mind, the thing known as Nocturne has become a primordial force of pure evil. It is liquidly chaotic in aspect, a faceless shadow with cold eyes and armed with wicked-looking...'),
(436, 'Nunu', 'the Yeti Rider', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Nunu.png', 'Frolicking through the hills of the Freljord, Nunu and Willump make an unlikely pair, but many travellers would swear they have seen the yeti with a fearless boy clinging to his back. Though Nunu may have tamed the beast\'s heart, Willump\'s anger remains...');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `monsters`
--

CREATE TABLE `monsters` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `gold` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `spawntime` int(11) NOT NULL,
  `respawntime` int(11) NOT NULL,
  `hp` float DEFAULT NULL,
  `armor` float DEFAULT NULL,
  `spellblock` float DEFAULT NULL,
  `attackdamage` float DEFAULT NULL,
  `attackspeedoffset` float DEFAULT NULL,
  `movespeed` float DEFAULT NULL,
  `buff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `monsters`
--

INSERT INTO `monsters` (`id`, `name`, `icon`, `description`, `gold`, `exp`, `spawntime`, `respawntime`, `hp`, `armor`, `spellblock`, `attackdamage`, `attackspeedoffset`, `movespeed`, `buff_id`) VALUES
(1, 'Krug', 'https://vignette.wikia.nocookie.net/leagueoflegends/images/f/fe/Ancient_KrugSquare.png', 'Krugs are magical fusion of flora, fauna, and rock native to Summoner\'s Rift. Despite its rock like appearance, its behavior is very much of an animal reminiscent of a bear, wolf, or a beetle. .', 421, 37, 102, 120, 1250, 10, 15, 80, -15, 185, NULL),
(2, 'Murk_Wolf', 'https://vignette.wikia.nocookie.net/leagueoflegends/images/d/d6/Greater_Murk_WolfSquare.png', '  Murk Wolves are mammalian creatures that are magically altered by runic magical energy scattered across the Summoner\'s Rift. They usually live near caves and dense forest growths. The color of their fur varies upon how much a murk wolf was altered by magical energy in the womb, ether a light brown color or a murky gray color.', 55, 65, 90, 120, 130, 10, 0, 70, 0.62, 450, NULL),
(3, 'Raptor', 'https://vignette.wikia.nocookie.net/leagueoflegends/images/9/94/Crimson_RaptorSquare.png', 'Raptors are an avian species native to Summoner\'s Rift. While incapable of flight, they have large strong back legs and large front teeth used for hunting. This species tends to its young until they can fend for themselves against larger predators. When born their feathers are the predominantly blue-greenish color, once they mature their obtain the Crimson RaptorSquare Crimson Raptor look', 42, 20, 90, 120, 570, 30, 30, 20, 0.64, 350, NULL),
(4, 'Gromp', 'https://vignette.wikia.nocookie.net/leagueoflegends/images/e/e8/GrompSquare.png', 'Frogs are amphibious creatures that inhabit specific magical locations, such as Summoner\'s Rift. Although frogs are a common sight, an amalgamation of a frog specimen and a magical anomaly borne the monsters known as GrompSquare Gromp. These monsters are hardy and tough and its hide can deflect the sharpest of blades and the strongest of spells', 105, 135, 102, 120, 2100, 0, 15, 70, 1.04, 330, NULL),
(5, 'Elder_Dragon', 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/champion/Aatrox.png', 'Elder Dragon is a much more powerful caliber of dragon, requiring multiple champions to secure quickly.', 250, 650, 2100, 600, 6400, 120, 70, 150, 0.5, 330, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `hp` float DEFAULT NULL,
  `hpperlevel` float DEFAULT NULL,
  `mp` float DEFAULT NULL,
  `mpperlevel` float DEFAULT NULL,
  `movespeed` float DEFAULT NULL,
  `armor` float DEFAULT NULL,
  `armorperlevel` float DEFAULT NULL,
  `spellblock` float DEFAULT NULL,
  `spellblockperlevel` float DEFAULT NULL,
  `attackrange` float DEFAULT NULL,
  `hpregen` float DEFAULT NULL,
  `hpregenperlevel` float DEFAULT NULL,
  `mpregen` float DEFAULT NULL,
  `mpregenperlevel` float DEFAULT NULL,
  `crit` float DEFAULT NULL,
  `critperlevel` float DEFAULT NULL,
  `attackdamage` float DEFAULT NULL,
  `attackdamageperlevel` float DEFAULT NULL,
  `attackspeedoffset` float DEFAULT NULL,
  `attackspeedperlevel` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `statistics`
--

INSERT INTO `statistics` (`id`, `hp`, `hpperlevel`, `mp`, `mpperlevel`, `movespeed`, `armor`, `armorperlevel`, `spellblock`, `spellblockperlevel`, `attackrange`, `hpregen`, `hpregenperlevel`, `mpregen`, `mpregenperlevel`, `crit`, `critperlevel`, `attackdamage`, `attackdamageperlevel`, `attackspeedoffset`, `attackspeedperlevel`) VALUES
(2, 597.24, 93, 315.6, 42, 350, 35, 3, 32.1, 1.25, 125, 8.5, 0.9, 7.466, 0.575, 2, 0, 681, 3.5, -0.1, 2.7),
(42, 518, 87, 350.16, 34, 325, 28, 3.5, 30, 0.5, 550, 5.5, 0.55, 7.424, 0.55, 0, 0, 60, 3, -0.02, 2.3),
(75, 561.2, 90, 325.6, 42, 350, 34, 3.5, 32.1, 1.25, 125, 9, 0.9, 7.44, 0.5, 0, 0, 67, 3.5, -0.02, 3.48),
(122, 582.24, 100, 263, 37.5, 340, 39, 4, 32.1, 1.25, 175, 10, 0.95, 6.6, 0.35, 0, 0, 64, 5, 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'winiarski.seba@gmail.com', 'fdsgsdfg'),
(2, 'hjkghj@gmail.com', 'hgjfgh'),
(3, 'antelius14@gmail.com', 'fsdfasdf'),
(4, 'test@test.com', 'test'),
(5, 'testo@testo.com', 'test'),
(6, 'test2@test.com', 'test'),
(7, 'test8@gmail.com', 'test'),
(8, 'test11@test.com', 'test'),
(9, 'test12@test.com', 'test'),
(12, 'test14@gmail.com', 'test'),
(13, 'test412@test.com', 'test'),
(14, 'testeo@testo.com', 'test'),
(15, 'testo12@testo.com', 'test'),
(16, 'test23o@testo.com', 'test');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `buffs`
--
ALTER TABLE `buffs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `champions`
--
ALTER TABLE `champions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `monsters`
--
ALTER TABLE `monsters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buff_id` (`buff_id`);

--
-- Indeksy dla tabeli `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `champions`
--
ALTER TABLE `champions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35346;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
