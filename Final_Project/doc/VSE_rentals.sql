-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2018 at 07:04 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `VSE_rentals`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `password`) VALUES
(1, 'admin', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreId` int(11) NOT NULL,
  `genre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreId`, `genre`) VALUES
(1, 'Drama'),
(2, 'Romance'),
(3, 'Comedy'),
(4, 'Action'),
(5, 'Sci-fi'),
(6, 'Animation'),
(7, 'Adventure'),
(8, 'Horror'),
(9, 'Mystery'),
(10, 'Biography'),
(11, 'History'),
(12, 'Family'),
(13, 'Fantasy'),
(14, 'Crime');

-- --------------------------------------------------------

--
-- Table structure for table `genre_movie`
--

CREATE TABLE `genre_movie` (
  `id` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `genreId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre_movie`
--

INSERT INTO `genre_movie` (`id`, `movieId`, `genreId`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 1, 3),
(4, 3, 3),
(5, 3, 2),
(6, 4, 1),
(7, 4, 2),
(8, 5, 4),
(9, 5, 5),
(10, 6, 6),
(11, 6, 7),
(12, 6, 1),
(13, 7, 1),
(14, 8, 8),
(15, 8, 9),
(16, 9, 10),
(17, 9, 1),
(18, 9, 11),
(19, 10, 8),
(20, 10, 9),
(21, 11, 10),
(22, 11, 1),
(23, 11, 11),
(24, 12, 1),
(25, 21, 2),
(26, 13, 6),
(27, 13, 12),
(28, 13, 13),
(29, 14, 1),
(30, 15, 3),
(31, 15, 13),
(32, 16, 14),
(33, 16, 1),
(34, 17, 4),
(35, 17, 5),
(36, 18, 3),
(37, 18, 12),
(38, 19, 7),
(39, 19, 5),
(40, 20, 3),
(41, 20, 12),
(42, 12, 2),
(43, 22, 3),
(44, 22, 7),
(45, 22, 12),
(46, 22, 13),
(47, 23, 1),
(48, 23, 14),
(49, 24, 3),
(50, 25, 3),
(51, 25, 6),
(52, 25, 13),
(53, 26, 1),
(54, 26, 2),
(55, 26, 13),
(56, 27, 8),
(57, 27, 9),
(58, 28, 6),
(59, 28, 12),
(60, 29, 4),
(61, 29, 14),
(62, 29, 7),
(63, 30, 6),
(64, 30, 3),
(65, 31, 3),
(66, 32, 2),
(67, 32, 3),
(68, 33, 4),
(69, 33, 13),
(70, 33, 7);

-- --------------------------------------------------------

--
-- Table structure for table `rented`
--

CREATE TABLE `rented` (
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rented`
--

INSERT INTO `rented` (`name`, `email`) VALUES
('Raul Ramirez', 'rarev2max@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `idVid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `rating` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `trailer` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`idVid`, `name`, `rating`, `description`, `picture`, `price`, `trailer`) VALUES
(1, 'Dumb and Dumber', 'PG-13', 'The cross-country adventures of 2 good-hearted but incredibly stupid friends.', 'dumbAndDumber.jpg', 3.99, 'https://www.youtube.com/watch?v=MSu25pQ4iFw'),
(2, 'Forrest Gump', 'PG-13', 'The presidencies of Kennedy and Johnson, Vietnam, Watergate, and other history unfold through the perspective of an Alabama man with an IQ of 75.', 'forestgump.jpg', 5.99, 'https://www.youtube.com/watch?v=bLvqoHBptjg'),
(3, 'Clueless', 'PG-13', 'A rich high school student tries to boost a new pupil\'s popularity, but reckons without affairs of the heart getting in the way.', 'clueless.jpg', 5.99, 'https://www.youtube.com/watch?v=RS0KyTZ3Ie4'),
(4, 'Good Will Hunting', 'R', 'Will Hunting, a janitor at M.I.T., has a gift for mathematics, but needs help from a psychologist to find direction in his life.', 'goodwill.jpg', 2.99, 'https://www.youtube.com/watch?v=PaZVjZEFkRs'),
(5, 'The Matrix', 'R', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 'matrix.jpg', 4.89, 'https://www.youtube.com/watch?v=m8e-FF8MsqU'),
(6, 'Lion King', 'G', 'A Lion cub crown prince is tricked by a treacherous uncle into thinking he caused his father\'s death and flees into exile in despair, only to learn in adulthood his identity and his responsibilities.', 'lionking.jpg', 2.89, 'https://www.youtube.com/watch?v=hY7xBISLBIA'),
(7, 'The Shawshank Redemption', 'R', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'shawshank.jpg', 3.98, 'https://www.youtube.com/watch?v=6hB3S9bIaco'),
(8, 'Scream', 'R', 'A year after the murder of her mother, a teenage girl is terrorized by a new killer, who targets the girl and her friends by using horror films as part of a deadly game.', 'scream.jpg', 4.88, 'https://www.youtube.com/watch?v=AWm_mkbdpCA'),
(9, 'Schindler\'s List', 'R', 'In German-occupied Poland during World War II, Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazi Germans.', 'schindler.jpg', 5.99, 'https://www.youtube.com/watch?v=gG22XNhtnoY'),
(10, 'I Know What You Did Last Summer', 'R', 'Four young friends bound by a tragic accident are reunited when they find themselves being stalked by a hook-wielding maniac in their small seaside town.', 'summer.jpg', 1.99, 'https://www.youtube.com/watch?v=EcWK0M4VMjA'),
(11, 'Braveheart', 'R', 'When his secret bride is executed for assaulting an English soldier who tried to rape her, Sir William Wallace begins a revolt against King Edward I of England.', 'braveheart.jpg', 3.89, 'https://www.youtube.com/watch?v=1NJO0jxBtMo'),
(12, 'Titanic', 'PG-13', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', 'titanic.jpg', 5.99, 'https://www.youtube.com/watch?v=zCy5WQ9S4c0'),
(13, 'The Nightmare Before Christmas', 'PG', 'Jack Skellington, king of Halloween Town, discovers Christmas Town, but his attempts to bring Christmas to his home causes confusion.', 'nightmare.jpg', 3.99, 'https://www.youtube.com/watch?v=wr6N_hZyBCk'),
(14, 'Fight Club', 'R', 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.', 'liarliar.jpg', 2.5, 'https://www.youtube.com/watch?v=SUXWAEX2jlg'),
(15, 'The Mask', 'PG-13', 'Bank clerk Stanley Ipkiss is transformed into a manic superhero when he wears a mysterious mask.', 'mask.jpg', 3.99, 'https://www.youtube.com/watch?v=hOqVRwGVUkA'),
(16, 'Pulp Fiction', 'R', 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'pulp.jpg', 2.99, 'https://www.youtube.com/watch?v=s7EdQ4FqbhY'),
(17, 'Terminator 2: Judgement Day', 'R', 'A cyborg, identical to the one who failed to kill Sarah Connor, must now protect her teenage son, John Connor, from a more advanced and powerful cyborg.', 't2.jpg', 4.99, 'https://www.youtube.com/watch?v=-W8CegO_Ixw&t=28s'),
(18, 'Jingle All the Way', 'PG', 'A father vows to get his son a Turbo Man action figure for Christmas. However, every store is sold out of them, and he must travel all over town and compete with everybody else in order to find one.', 'jingle.jpg', 1.99, 'https://www.youtube.com/watch?v=jhJYMEzQA-Q'),
(19, 'Jurassic Park', 'PG-13', 'Thriller,During a preview tour, a theme park suffers a major power breakdown that allows its cloned dinosaur exhibits to run amok.', 'jurassic.jpg', 5.99, 'https://www.youtube.com/watch?v=lc0UehYemQA'),
(20, 'Home Alone', 'PG', 'An eight-year-old troublemaker must protect his house from a pair of burglars when he is accidentally left home alone by his family during Christmas vacation.', 'home.jpg', 4.89, 'https://www.youtube.com/watch?v=jEDaVHmw7r4'),
(21, 'Pretty Woman', 'R', 'A man in a legal but hurtful business needs an escort for some social events, and hires a beautiful prostitute he meets... only to fall in love.', 'prettyWoman.jpg', 3.99, 'https://www.youtube.com/watch?v=Wzii8IuL8lk&t=14s'),
(22, 'Jumanji', 'PG', 'When two kids find and play a magical board game, they release a man trapped for decades in it and a host of dangers that can only be stopped by finishing the game.', 'juman.jpg', 3.99, 'https://www.youtube.com/watch?v=DvQ-PGUr6SM'),
(23, 'Goodfellas', 'R', 'The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen Hill and his mob partners Jimmy Conway and Tommy DeVito in the Italian-American crime syndicate.', 'goodfellas.jpg', 4.99, 'https://www.youtube.com/watch?v=qo5jJpHtI1Y'),
(24, 'Wayne\'s World', 'PG-13', 'Two slacker friends try to promote their public-access cable show.', 'ww.jpg', 3.5, 'https://www.youtube.com/watch?v=OIuhsHpcNAU'),
(25, 'Toy Story', 'G', 'A cowboy doll is profoundly threatened and jealous when a new spaceman figure supplants him as top toy in a boy\'s room.', 'ts.jpg', 2.99, 'https://www.youtube.com/watch?v=KYz2wyBy3kc'),
(26, 'Edward Scissorhands', 'PG-13', 'A gentle man, with scissors for hands, is brought into a new community after living in isolation.', 'edward.jpg', 2.99, 'https://www.youtube.com/watch?v=M94yyfWy-KI'),
(27, 'The Blair Witch Project', 'R', 'Three film students vanish after traveling into a Maryland forest to film a documentary on the local Blair Witch legend, leaving only their footage behind.', 'blair.jpg', 3.99, 'https://www.youtube.com/watch?v=a_Hw4bAUj8A'),
(28, 'Beauty and the Beast', 'G', 'A selfish prince is cursed to become a monster for the rest of his life, unless he learns to fall in love with a beautiful young woman he keeps prisoner.', 'beauty.jpg', 3.89, 'https://www.youtube.com/watch?v=tRlzmyveDHE'),
(29, 'Desperado', 'R', 'A gunslinger is embroiled in a war with a local drug runner.', 'desperado.jpg', 4.99, 'https://www.youtube.com/watch?v=MdZaOB03b1U'),
(30, 'Space Jam', 'PG', 'In a desperate attempt to win a basketball match and earn their freedom, the Looney Tunes seek the aid of retired basketball champion, Michael Jordan.', 'spaceJam.jpg', 1.99, 'https://www.youtube.com/watch?v=oKNy-MWjkcU'),
(31, 'Happy Gilmore', 'PG-13', 'A rejected hockey player puts his skills to the golf course to save his grandmother\'s house.', 'happyGilmore.jpg', 3.99, 'https://www.youtube.com/watch?v=y1emDAYCfVQ'),
(32, 'The Wedding Singer', 'PG-13', 'Robbie, a singer, and Julia, a waitress, are both engaged, but to the wrong people. Fortune intervenes to help them discover each other.', 'weddingSinger.jpg', 5.99, 'https://www.youtube.com/watch?v=8yjOXMTa6vA'),
(33, 'Batman', 'PG-13', 'Batman must battle former district attorney Harvey Dent, who is now Two-Face and Edward Nygma, The Riddler with help from an amorous psychologist and a young circus acrobat who becomes his sidekick, R', 'batmanForever.jpg', 3.99, 'https://www.youtube.com/watch?v=suOgRZflPtk'),
(34, 'Office Space', 'R', 'Three company workers who hate their jobs decide to rebel against their greedy boss.', 'officeSpace.jpg', 4.99, 'https://www.youtube.com/watch?v=dMIrlP61Z9s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`idVid`),
  ADD UNIQUE KEY `idVid` (`idVid`),
  ADD KEY `idVid_2` (`idVid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genre_movie`
--
ALTER TABLE `genre_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `idVid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
