-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2013 at 05:19 p.m.
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `recordrater`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `albumID` int(11) NOT NULL AUTO_INCREMENT,
  `genreID` int(11) NOT NULL,
  `artistID` int(11) NOT NULL,
  `albumName` varchar(100) NOT NULL,
  `releaseDate` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  PRIMARY KEY (`albumID`),
  KEY `genreID` (`genreID`,`artistID`),
  KEY `artistID` (`artistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumID`, `genreID`, `artistID`, `albumName`, `releaseDate`, `description`, `picture`) VALUES
(1, 6, 1, 'Random Access Memories', '2013-05-17', 'Random Access Memories is the fourth studio album by French electronic music duo Daft Punk. It was released by the duo''s imprint Daft Life, under exclusive license to Columbia Records, on May 17, 2013.', 'daftpunk1.jpeg'),
(2, 7, 7, 'Blackbird', '2013-06-21', 'They''ve stayed faithful to their authentic, soulful sound, The first track, Blackbird, is wonderful. A great showpiece of their talent both instrumentally and vocally. Great Kiwi music! ', 'fatfreddysdrop1.jpg'),
(3, 1, 5, 'Unorthodox Jukebox', '2012-12-07', 'Unorthodox Jukebox is the second studio album by American recording artist Bruno Mars, released on December 6, 2012, by Atlantic Records. On December 4, 2012, the album was available to listen to in its entirety for a week before the release.', 'brunomars1.jpg'),
(4, 1, 8, 'The Love Club EP', '2013-03-08', 'Love Club, the official debut EP from precocious New Zealand-based singer/songwriter Ella Yelich O''Connor, who operates under the moniker Lorde, arrives on the heels of her infectious debut single "Royals".', 'lorde1.jpg'),
(5, 4, 3, 'Long Live ASAP', '2013-01-15', 'Long. Live. ASAP is the debut studio album by American rapper ASAP Rocky. It was released on January 15, 2013, by ASAP Worldwide, Polo Grounds Music, and RCA Records', 'asaprocky1.jpg'),
(6, 2, 4, '...Like Clockwork', '2013-06-03', '...Like Clockwork is the sixth studio album by American rock band Queens of the Stone Age, released on June 3, 2013 on Matador Records in the UK and on June 4 in the United States.', 'queensofthestoneage1.jpg'),
(7, 5, 2, 'Mosquito', '2013-04-12', 'Mosquito is the fourth studio album by American indie rock band Yeah Yeah Yeahs, released on April 12, 2013 by Interscope Records. The lead single "Sacrilege" was released on February 25, 2013.', 'yeahyeahyeahs1.jpg'),
(8, 3, 6, 'Babel', '2012-09-21', 'Babel is the second studio album by British indie folk band Mumford & Sons. As with Sigh No More, the album was produced by Markus Dravs', 'mumfordandsons1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `artistID` int(11) NOT NULL AUTO_INCREMENT,
  `artistName` varchar(100) NOT NULL,
  `artistBio` varchar(500) NOT NULL,
  PRIMARY KEY (`artistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistID`, `artistName`, `artistBio`) VALUES
(1, 'Daft Punk', 'Daft Punk is an electronic music duo consisting of French musicians Guy-Manuel de Homem-Christo and Thomas Bangalter.'),
(2, 'Yeah Yeah Yeahs', 'Yeah Yeah Yeahs are an American indie rock band formed in New York City in 2000. The group is composed of vocalist and pianist Karen O, guitarist and keyboardist Nick Zinner, and drummer Brian Chase.'),
(3, 'ASAP Rocky', 'Rakim Mayers, better known by his stage name, ASAP Rocky, is an American rapper. He is a member of the hip hop collective ASAP Mob, from which he adopted his moniker. Rocky released his debut mixtape Live. Love. ASAP in 2011 to critical acclaim.'),
(4, 'Queens of the Stone Age', 'Queens of the Stone Age is an American rock band from Palm Desert, California, United States, formed in 1996'),
(5, 'Bruno Mars', 'Peter Gene Hernandez, known by his stage name Bruno Mars, is an American singer-songwriter and record producer.'),
(6, 'Mumford & Sons', 'Mumford & Sons are an English folk rock band. The band consists of Marcus Mumford, Ben Lovett, Winston Marshall, and Ted Dwane.'),
(7, 'Fat Freddy''s Drop', 'Fat Freddy’s Drop are a New Zealand seven-piece band from Wellington, whose musical style has been characterised as any combination of dub, reggae, soul, jazz, rhythm and blues, and techno'),
(8, 'Lorde', 'Ella Yelich-O''Connor, known by her stage name Lorde, is a 16 year old New Zealand singer-songwriter. She released her first EP, The Love Club, online in December 2012. Her latest single is the song Tennis Court');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `genreID` int(11) NOT NULL AUTO_INCREMENT,
  `genreName` varchar(50) NOT NULL,
  PRIMARY KEY (`genreID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreID`, `genreName`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Country/Folk'),
(4, 'HipHop/RnB'),
(5, 'Indie'),
(6, 'Electronic'),
(7, 'Reggae/Soul');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `review` varchar(300) NOT NULL,
  `reviewDate` date NOT NULL,
  `rating` int(11) NOT NULL,
  `albumID` int(11) NOT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `userID` (`userID`),
  KEY `albumID` (`albumID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `userID`, `review`, `reviewDate`, `rating`, `albumID`) VALUES
(2, 2, 'When they let their guard down and find some genuine vulnerability, this quartet prove why they''ve rallied such a dedicated and large fanbase of adults - they just need to step up the somewhat paint-by-numbers folk pop that can emerge in between the hits.', '2013-07-08', 3, 8),
(3, 2, 'Yeah Yeah Yeahs have pushed themselves to new heights on Mosquito. They have crafted a sound that is new for them and unique in its context, but that falls neatly into what we have come to expect from a trio whose power and creativity runs consistently unchecked.', '2013-07-07', 4, 7),
(4, 2, 'Blackbird is proof once again that these seven reggae, dub, and oonst funkateers know what it takes to make an accomplished and solid album that you''ll be listening to for many years to come.', '2013-07-09', 5, 2),
(5, 2, 'It''s not quite Songs for the Deaf, but then that''s being picky, because ... Like Clockwork is bound to be one of the albums of the year - and by year''s end, with a little more playing, it''s likely to be the best.', '2013-07-04', 5, 6),
(6, 2, 'There are a handful of big tracks like ‘Touch’ (a marvellously OTT ‘Bohemian Rhapsody’-esque five-parter with ‘Shaft’-like guitars, horn sections and a child choir) and closer ‘Contact’ which goes from an astronaut describing something ‘out there’ to organs, drum solos and a crescendo that hits you ', '2013-07-02', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `adminStatus` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `password`, `adminStatus`) VALUES
(2, 'Sam', 'Birkhead', 'sam.birkhead@gmail.com', '12345', 1),
(3, 'Jono', 'B', 'jonob@gmail.com', '12345', 0),
(4, 'jack', 'asd', 'jack@gmail.com', '12345', 0),
(5, 'jack', 'asd', 'jack@gmail.com', '12345', 0),
(6, 'sasas', 'sassa', 'sasa@gmail.com', '12345', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`genreID`) REFERENCES `genre` (`genreID`),
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`artistID`) REFERENCES `artist` (`artistID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`albumID`) REFERENCES `album` (`albumID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
