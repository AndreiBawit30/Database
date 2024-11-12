-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 09:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bawit1`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `addressID` int(11) NOT NULL,
  `cityID` int(11) NOT NULL,
  `provinceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`addressID`, `cityID`, `provinceID`) VALUES
(1, 4, 2),
(2, 2, 2),
(3, 1, 1),
(4, 2, 2),
(5, 3, 1),
(6, 1, 1),
(7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityID` int(11) NOT NULL,
  `cityName` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityID`, `cityName`) VALUES
(1, 'Sto Tomas'),
(2, 'Calamba'),
(3, 'Tanauan'),
(4, 'San Pablo');

-- --------------------------------------------------------

--
-- Table structure for table `closefriends`
--

CREATE TABLE `closefriends` (
  `closeFriendID` int(11) NOT NULL,
  `ownderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `dateTime` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `dateTime`, `content`, `userID`, `postID`) VALUES
(22, '2024-10-31 10:30:00', 'Great recommendation! I’ll check it out.', 2, 1),
(23, '2024-10-31 11:15:00', 'Sounds like a fun trip! Enjoy!', 3, 2),
(24, '2024-10-31 12:45:00', 'I love that restaurant! What did you order?', 4, 3),
(25, '2024-10-31 13:30:00', 'Good luck with the challenge! You got this!', 5, 4),
(26, '2024-10-31 14:15:00', 'Taking time for yourself is so important.', 6, 5),
(27, '2024-10-31 15:45:00', 'Congrats! You deserve it!', 7, 6),
(28, '2024-10-31 16:30:00', 'Reconnecting with friends is the best!', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendID` int(11) NOT NULL,
  `requesterID` int(11) NOT NULL,
  `requesteeID` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcmembers`
--

CREATE TABLE `gcmembers` (
  `gcMemberID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `gcID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupchat`
--

CREATE TABLE `groupchat` (
  `groupChatID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `recieverID` int(11) NOT NULL,
  `gcID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `dateTime` varchar(50) NOT NULL,
  `privacy` varchar(50) NOT NULL,
  `isDeleted` varchar(50) NOT NULL,
  `attachment` varchar(50) NOT NULL,
  `cityID` int(11) NOT NULL,
  `provinceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `content`, `dateTime`, `privacy`, `isDeleted`, `attachment`, `cityID`, `provinceID`) VALUES
(1, 1, 'Just finished a great book on personal development! Highly recommend it.', '2024-10-31 10:00:00', 'public', '0', '', 1, 1),
(2, 2, 'Excited for the weekend! Planning a trip to the beach.', '2024-10-31 11:00:00', 'friends', '0', '', 2, 1),
(3, 3, 'Had a wonderful dinner with friends last night. Food was amazing!', '2024-10-31 12:00:00', 'public', '0', '', 3, 2),
(4, 4, 'Just started a new fitness challenge. Let’s see how this goes!', '2024-10-31 13:00:00', 'public', '0', '', 4, 2),
(5, 5, 'Enjoying a quiet day at home. Sometimes you just need to relax.', '2024-10-31 14:00:00', 'friends', '0', '', 1, 2),
(6, 6, 'Excited to announce that I got a promotion at work! Feeling grateful.', '2024-10-31 15:00:00', 'public', '0', '', 2, 1),
(7, 7, 'Caught up with an old friend today. It’s great to reconnect!', '2024-10-31 16:00:00', 'friends', '0', '', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(11) NOT NULL,
  `provinceName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`provinceID`, `provinceName`) VALUES
(1, 'Batangas'),
(2, 'Laguna');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `kind` varchar(50) NOT NULL,
  `commentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userInfoID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `addressID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userInfoID`, `firstName`, `lastName`, `addressID`) VALUES
(1, 'Alice', 'Smith', 0),
(2, 'Bob', 'Johnson', 0),
(3, 'Charlie', 'Williams', 0),
(4, 'David', 'Jones', 0),
(5, 'Eva', 'Brown', 0),
(6, 'Frank', 'Davis', 0),
(7, 'Grace', 'Garcia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `messagesID` int(11) NOT NULL,
  `userInfoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `messagesID`, `userInfoID`) VALUES
(1, 0, 1),
(2, 0, 2),
(3, 0, 3),
(4, 0, 4),
(5, 0, 5),
(6, 0, 6),
(7, 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressID`),
  ADD KEY `cityID` (`cityID`),
  ADD KEY `provinceID` (`provinceID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD PRIMARY KEY (`closeFriendID`),
  ADD KEY `ownderID` (`ownderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postID` (`postID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendID`),
  ADD KEY `requesterID` (`requesterID`),
  ADD KEY `requesteeID` (`requesteeID`);

--
-- Indexes for table `gcmembers`
--
ALTER TABLE `gcmembers`
  ADD PRIMARY KEY (`gcMemberID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `gcID` (`gcID`);

--
-- Indexes for table `groupchat`
--
ALTER TABLE `groupchat`
  ADD PRIMARY KEY (`groupChatID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `recieverID` (`recieverID`),
  ADD KEY `gcID` (`gcID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `cityID` (`cityID`),
  ADD KEY `provinceID` (`provinceID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `commentID` (`commentID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userInfoID`),
  ADD KEY `addressID` (`addressID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userInfoID` (`userInfoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `closefriends`
--
ALTER TABLE `closefriends`
  MODIFY `closeFriendID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gcmembers`
--
ALTER TABLE `gcmembers`
  MODIFY `gcMemberID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupchat`
--
ALTER TABLE `groupchat`
  MODIFY `groupChatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`),
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`provinceID`) REFERENCES `provinces` (`provinceID`);

--
-- Constraints for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD CONSTRAINT `closefriends_ibfk_1` FOREIGN KEY (`ownderID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `closefriends_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`requesterID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`requesteeID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `gcmembers`
--
ALTER TABLE `gcmembers`
  ADD CONSTRAINT `gcmembers_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `gcmembers_ibfk_2` FOREIGN KEY (`gcID`) REFERENCES `groupchat` (`groupChatID`);

--
-- Constraints for table `groupchat`
--
ALTER TABLE `groupchat`
  ADD CONSTRAINT `groupchat_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recieverID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`gcID`) REFERENCES `groupchat` (`groupChatID`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`provinceID`) REFERENCES `provinces` (`provinceID`);

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `reactions_ibfk_2` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userInfoID`) REFERENCES `userinfo` (`userInfoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
