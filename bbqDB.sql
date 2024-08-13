-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 25, 2021 at 01:29 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbqDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblReviews`
--

CREATE TABLE `tblReviews` (
  `reviewID` int(11) NOT NULL,
  `venueName` tinytext,
  `venueCity` tinytext,
  `regionStyle` tinytext,
  `foodImgURL` text,
  `reviewComments` text,
  `rating` int(1) DEFAULT NULL,
  `websiteURL` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblReviews`
--

INSERT INTO `tblReviews` (`reviewID`, `venueName`, `venueCity`, `regionStyle`, `foodImgURL`, `reviewComments`, `rating`, `websiteURL`) VALUES
(2, 'Fancy Hanks', 'Melbourne', 'Texas', 'https://images.unsplash.com/photo-1585325701165-351af916e581?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1350&q=80', 'Great sausage links, brisket a little dry.', 3, 'https://www.fancyhanks.com/'),
(3, 'Le Bon Ton', 'Collingwood', 'Carolina', 'https://images.unsplash.com/photo-1597377779407-51e50715cc7d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80', 'Fantastic smoked chicken... great Nawlins styled cocktails.  Potato salad with dill and pickle slices is the best ever eaten!', 5, 'https://www.lebonton.com.au/'),
(4, 'Bluestone American BBQ', 'Coburg', 'Texas', 'https://images.unsplash.com/photo-1614231556674-f91780097f53?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80', 'An amazing BBQ experience, the food is exceptionally slow cooked!  The subtle smoke flavour really shines through in the delicious tender and juicy meat.\r\nStand out dishes include the brisket - the bark was wonderful.  Beautifully silky mac and cheese!', 5, 'http://bluestoneamericanbbq.com/'),
(6, 'test_updated', 'test_updated', 'Kansas City', '_updated', 'test_updated', 2, '_updated'),
(7, 'Up In Smoke                ', 'Footscray', 'Texas', 'https://images.unsplash.com/photo-1586805608485-add336722759?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Amazing brisket burnt end poutine!  The cheese curds are melty and silky... the gravy delicious and crunch of the chips wonderful.  A great place for some beautiful smoked meats!  Cocktails go alright too!!', 5, 'https://upinsmoke.net.au/');

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers`
--

CREATE TABLE `tblUsers` (
  `userID` int(11) NOT NULL,
  `firstName` tinytext,
  `userName` tinytext,
  `email` tinytext,
  `userPassword` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblUsers`
--

INSERT INTO `tblUsers` (`userID`, `firstName`, `userName`, `email`, `userPassword`) VALUES
(6, 'Michael', 'megan19', 'eganfamily53@optusnet.com.au', '$2y$10$VALTh2RAMF906FjLqunU6ebTLxF5OE1Mb/JYVsJi9S7nPrqEZp9mS'),
(7, 'Bianca', 'bjhendricks', 'bianca@gmail.com', '$2y$10$2gQWIHclrSovrUxefXtUe.gfFW4M.1KRnX.GBxuGhK4NDWonYby7.'),
(8, 'Peter', 'petercharles', 'theicecreammachine@icloud.com', '$2y$10$CMub6YYNs.EraVv9mDRMCe1D84UQkuuYwuzsM1Jm4sWw8flDS4qE2'),
(9, 'Patricia', 'pjegan', 'pjegan@yprl.vic.gov.au', '$2y$10$Cr0OnAYA7JJoY94eC5b/PutIXQdNSm9u.uEYoQYtamQGqm43DOc1m'),
(10, 'Laura', 'lozza89', 'laura@hotmail.com', '$2y$10$hAOb7/bMjbDu0TauW7vcR.4kCcgQWn4vIWWL4hCzSA3RB/FI1tFQC'),
(11, 'Paul', 'bigpaul00', 'bigpaul@gmail.com', '$2y$10$EspV/hdxhF/K9Rfnqu.HJ.Mc3Bq6MOBu6XPzvMO6x2h2Tw3tJfrty'),
(12, 'Benjamin', 'benji83', 'ben@eganfencing.com', '$2y$10$NKcFLD/3vAQd33LNAd4LHe5ZcH3synKhWh/29CVOXXU/7aHvtO7La'),
(13, 'Callan', 'weeman43', 'minime@apple.com', '$2y$10$lNEfKaTjkxWXgFc52.lZnOaM/JBY6RBcPcgtRBDTsJIGHs.23zw2u'),
(14, 'Charlie', 'charlesdawg', 'charliedanger@hotmail.com', '$2y$10$D4RCXFtKAkiUXa9BzsutIu428sXQYFR88V46F3uZ/MgFZcBjeUBoC'),
(15, 'Bianca', 'bianchen', 'bianca.hendricks@gmail.com', '$2y$10$U7qgZR9bmpXTRokssSxqgOERPMMOJBavQSbLJv1W1ajcadI2p0PSS'),
(16, 'John', 'johnnyboy', 'johnnyboy@hotmail.com', '$2y$10$xuWdhD5oBsz.w4bpomeD7.UC5ueXsv3e8M9ki5dS5dQGjXYq36CvW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblReviews`
--
ALTER TABLE `tblReviews`
  ADD PRIMARY KEY (`reviewID`);

--
-- Indexes for table `tblUsers`
--
ALTER TABLE `tblUsers`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblReviews`
--
ALTER TABLE `tblReviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblUsers`
--
ALTER TABLE `tblUsers`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
