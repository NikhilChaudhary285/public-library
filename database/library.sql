-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 06:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `availablebooks`
--

CREATE TABLE `availablebooks` (
  `sno` int(11) NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  `type` text NOT NULL,
  `borrower` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `availablebooks`
--

INSERT INTO `availablebooks` (`sno`, `name`, `author`, `type`, `borrower`, `timestamp`) VALUES
(1, 'Introduction to C++', 'Bjarne Stroustrup', 'Computer Programming', 'None', '2023-02-20 15:52:35'),
(110, 'The Complete Sonnets and Poems', 'William Shakespeare', 'Poetry', 'None', '2023-04-21 15:18:58'),
(111, 'History of Modern India', 'Bipan Chandra', 'History', 'None', '2023-04-21 15:24:05'),
(112, 'What Technology Wants', 'Kevin Kelly', 'Technology', 'None', '2023-04-21 15:30:07'),
(113, 'Journey to the Center of the Earth', 'Jules Verne', 'Action and Adventure', 'None', '2023-04-21 15:32:09'),
(114, 'The colour of Magic ', 'Terry Pratchett', 'Fantasy', 'None', '2023-04-21 15:39:37'),
(115, 'The Adventures of Superman', 'George Lowther', 'Novel', 'None', '2023-04-21 15:47:29'),
(117, 'Chhooa Aasmaan', 'A.P.J Abdul Kalam', 'Autobiography', 'None', '2023-04-21 16:00:41'),
(118, 'Amar Chitra Katha', 'Anant Pai', 'Comic', 'None', '2023-04-21 16:03:06'),
(123, 'The Lord of the Rings', 'JRR TOLKIEN', 'Fantasy', 'None', '2023-04-21 16:13:16'),
(125, 'Ek Tukda Neela Aasmaan', 'Mridula Bajpai', 'Biography', 'None', '2023-04-21 16:28:16'),
(126, 'RHS Gardening Through the Year', 'Ian Spence', 'Gardening', 'None', '2023-04-21 16:29:57'),
(127, '50 Great Curries Of India', 'Camellia Punjabi', 'Cooking', 'None', '2023-04-21 16:32:09'),
(129, 'Front-End Web Development', 'Gerardus Blokdyk', 'Computer Programming', 'None', '2023-04-21 16:37:07'),
(130, 'Ancient India', 'RC Majumdar', 'History', 'None', '2023-04-21 16:38:28'),
(135, 'How Google Works', 'Eric Schmidt', 'Technology', 'None', '2023-04-21 16:48:32'),
(138, '​Tenali Raman', 'Kamala Laxman', 'Comic', 'None', '2023-04-21 17:00:21'),
(139, 'Molecular Biology of the Cell', 'Bruce Alberts ', 'Biology', 'None', '2023-04-21 17:12:54'),
(142, 'Saaye main dhoop', 'Dushyant Kumar', 'Poetry', 'None', '2023-04-21 17:22:27'),
(143, 'We Made a Garden', 'Margery Fish', 'Gardening', 'None', '2023-04-21 17:23:52'),
(144, 'Brief History of Time', 'Stephen Hawking', 'Physics', 'None', '2023-04-21 17:26:25'),
(145, 'The Curry Secret', 'Kris Dhillon', 'Cooking', 'None', '2023-04-21 17:30:28'),
(147, 'Ready Player One', 'Ernest Cline', 'Technology', 'None', '2023-04-21 17:35:26'),
(148, 'Ivanhoe', 'Walter Scott', 'Action and Adventure', 'None', '2023-04-21 17:37:13'),
(150, 'Dirt to Soil', 'Gabe Brown', 'Agriculture', 'None', '2023-04-21 17:43:34'),
(153, 'Wonder Woman', 'John Byrne', 'Novel', 'None', '2023-04-21 17:55:54'),
(154, 'The Book of R', 'Tilman M. Davies', 'Computer Programming', 'None', '2023-04-21 17:58:59'),
(155, 'A Textbook of Medieval Indian History', 'Sailendra Nath Sen', 'History', 'None', '2023-04-21 18:02:18'),
(156, 'Molecular and Cellular Biology of Viruses', 'Phoebe Lostroh ', 'Biology', 'None', '2023-04-21 18:06:25'),
(160, 'Tinkle', 'Anant Pai', 'Comic', 'None', '2023-04-21 18:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `designers`
--

CREATE TABLE `designers` (
  `sno` int(11) NOT NULL,
  `designer` text NOT NULL,
  `designername` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designers`
--

INSERT INTO `designers` (`sno`, `designer`, `designername`, `datetime`) VALUES
(1, 'designer1', 'Nikhil', '2023-04-19 19:32:00'),
(2, 'designer2', 'Karandeep Singh', '2023-04-19 19:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `issuedbooks`
--

CREATE TABLE `issuedbooks` (
  `sno` int(11) NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  `type` text NOT NULL,
  `borrower` text NOT NULL,
  `bor_email` varchar(200) NOT NULL,
  `bor_phone` varchar(10) NOT NULL,
  `bor_address` varchar(200) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issuedbooks`
--

INSERT INTO `issuedbooks` (`sno`, `name`, `author`, `type`, `borrower`, `bor_email`, `bor_phone`, `bor_address`, `timestamp`) VALUES
(55, 'PHP', 'Rasmus Lerdorf', 'Computer Programming', 'Shivaang', 'shivaang@gmail.com', '9865380563', 'H.no :- F76/78; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-03-31 19:32:08'),
(59, 'Elements', 'Theodore Gray', 'Chemistry', 'Shubham', 'shubham@gmail.com', '3523223523', 'H.No: F23/23; Nehru Colony; Majitha Road; Amritsar', '2023-04-21 18:36:07'),
(60, 'Leaves of Grass', 'Walt Whitman', 'Poetry', 'Divyansh', 'divyansh@gmail.com', '2349827384', 'H.no :- F77/98; Jagdamba Colony; Amritsar', '2023-04-21 18:38:46'),
(61, 'Treasure Island', 'Robert Louis Stevenson', 'Action and Adventure', 'Dushyant', 'dushyant@gmail.com', '2874672364', 'H.no :- F86/68; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:42:03'),
(62, 'The Dal Cookbook', 'Krishna Dutta', 'Cooking', 'Karandeep', 'karandeep@gmail.com', '8263452348', 'H.no :- F66/88; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:43:06'),
(63, 'Business Adventures', 'John Brooks', 'Business', 'Amandeep', 'amandeep@gmail.com', '8264787826', 'H.no :- F86/77; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:44:56'),
(64, 'THE FIFTH SEASON', 'NK JEMISIN', 'Fantasy', 'Harmanjot', 'harmanjot@gmail.com', '7263784621', 'H.no :- F56/72; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:47:14'),
(65, 'The Well-Tempered Garden', 'Christopher Lloyd', 'Gardening', 'Divyanshu', 'divyanshu@gmail.com', '9812379127', 'H.no :- F65/90; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:49:26'),
(66, 'Java', 'Sun Microsystems', 'Computer Programming', 'Gurjinder', 'gurjinder@gmail.com', '7687346872', 'H.no :- F76/78; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:52:39'),
(67, 'Chacha Chaudhary', 'Pran Kumar Sharma', 'Comic', 'Abhishek', 'abhishek@gmail.com', '8917239719', 'H.no :- F96/89; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:53:43'),
(68, 'Madhushala', 'Harivansh Rai Bachan', 'Poetry', 'Harmandeep', 'harmandeep@gmail.com', '2878237822', 'H.no :- F85/66; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 18:58:29'),
(69, 'Ancient History of India', 'Charles J. Naegele', 'History', 'Ramandeep', 'ramandeep@gmail.com', '7283647826', 'H.no :- F76/88; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:00:00'),
(70, 'Gitanjali', 'Rabindranath Tagore', 'Poetry', 'Abhimanyu', 'Abhimanyu@gmail.com', '9812738672', 'H.no :- F85/96; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:03:03'),
(71, 'You Are Not a Gadget', 'Jaron Lanier', 'Technology', 'Arjun Kashyup', 'arjunkashyup@gmail.com', '8627384687', 'H.no :- F79/88; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:07:30'),
(72, 'Vertical Gardening', 'Olivia Abby', 'Gardening', 'Aditya Chopra', 'adityachopra@gmail.com', '8926841621', 'H.no :- F52/36; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:09:32'),
(73, 'AMERICAN GODS', 'NEIL GAIMAN', 'Fantasy', 'Neha Kumari', 'nehakumari@gmail.com', '2838472937', 'H.no :- F57/86; Jagamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:10:36'),
(74, 'C# in Depth', 'Jon Skeet', 'Computer Programming', 'Harmanpreet', 'harmanpreet@gmail.com', '8923487293', 'H.no :- F72/76; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:12:56'),
(75, 'Fundamentals of Physics', 'R. Shankar', 'Physics', 'Gautam Kumar', 'gautamkumar@gmail.com', '8923847129', 'H.no :- F86/76; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:13:54'),
(76, 'Das Kahaaniyan', 'Rajinder Kumar Suryvanshi', 'Action and Adventure', 'Charanjeet Kaur', 'charanjeetkaur@gmail.com', '8289279349', 'H.no :- F86/36; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:16:28'),
(77, 'I Remember', 'Joe Brainard', 'Poetry', 'Simranjeet Kaur', 'simranjeetkaur@gmail.com', '7892168746', 'H.no :- F86/56; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:18:09'),
(78, 'The Ruby Programming Language', 'Yukihiro Matsumoto', 'Computer Programming', 'Shravan Kumar', 'shravankumar@gmail.com', '8273849728', 'H.no :- F66/59; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:21:00'),
(79, 'Batman vs. Three Villains of Doom', 'Winston Lyon', 'Novel', 'Madhuri Dubey', 'madhuridubey@gmail.com', '9827342374', 'H.no :- F56/65; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:23:27'),
(80, 'My First Kitchen', 'Vikas Khanna', 'Cooking', 'Priyanka Chopra', 'priyankachopra@gmail.com', '8927347236', 'H.no :- F63/58; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:26:42'),
(81, 'THE GUNSLINGER', 'STEPHEN KING', 'Fantasy', 'Prankush Kumar', 'prankushkumar@gmail.com', '8263874621', 'H.no :- F66/62; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:28:36'),
(82, 'Clean Code', 'Robert C. Martin', 'Technology', 'Hariharan Dubey', 'hariharandubey@gmail.com', '9827398472', 'H.no :- F54/45; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:29:46'),
(83, 'The Periodic Table', 'Primo Levi', 'Chemistry', 'Nitin Mahajan', 'nitinmahajan@gmail.com', '8123894792', 'H.no :- F65/90; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:31:49'),
(84, 'Introduction to C', 'Dennis Ritchie', 'Computer Programming', 'Nisha Chaudhary', 'nishachaudhary@gmail.com', '8927809472', 'H.no :- F87/99; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:33:22'),
(85, 'Passing Through', 'Stanley Kunitz', 'Poetry', 'Mohit Kumar', 'mohitkumar@gmail.com', '9821402634', 'H.no :- F62/87; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:35:13'),
(86, 'The Circle', 'Dave Eggers', 'Technology', 'Gautam Chouhan', 'gautamchouhan@gmail.com', '7127384621', 'H.no :- F67/59; Jagdamba Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:38:05'),
(87, 'Python', 'Guido van Rossum', 'Computer Programming', 'Ramesh Chopra', 'rameshchopra@gmail.com', '8838997492', 'H.no :- F52/77; Nehru Colony; Majitha Road; Amritsar; Punjab', '2023-04-21 19:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `libraryadmins`
--

CREATE TABLE `libraryadmins` (
  `sno` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libraryadmins`
--

INSERT INTO `libraryadmins` (`sno`, `username`, `emailid`, `password`, `datetime`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$SKpPtKy8a0JSEeNphZx7ue2i0J0Xk9esXYFj429pXC7K3VxFOO99m', '2023-04-11 14:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `libraryeditors`
--

CREATE TABLE `libraryeditors` (
  `sno` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libraryeditors`
--

INSERT INTO `libraryeditors` (`sno`, `username`, `emailid`, `password`, `datetime`) VALUES
(9, 'Nikhil', 'nikhilchaudhary285@gmail.com', '$2y$10$/WC0pM5FlCmyTVd9oYi75.29aqNkhstBtfvCurT8ZOVTPO2pjp33i', '2023-04-16 22:56:53'),
(10, 'Karandeep', 'skarandeep98765@gmail.com', '$2y$10$PDQzmSQrP8jmklJyUxVFT.89ylQj7EZ8Ef62JwKAG3RZkI2e1cSQC', '2023-04-16 22:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `libraryinquirymembers`
--

CREATE TABLE `libraryinquirymembers` (
  `sno` int(11) NOT NULL,
  `librarian` text NOT NULL,
  `librarianimage` text NOT NULL,
  `librarianname` text NOT NULL,
  `librarianphone` varchar(10) NOT NULL,
  `librarianemail` varchar(200) NOT NULL,
  `librarianworkinghours` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libraryinquirymembers`
--

INSERT INTO `libraryinquirymembers` (`sno`, `librarian`, `librarianimage`, `librarianname`, `librarianphone`, `librarianemail`, `librarianworkinghours`, `datetime`) VALUES
(1, 'librarian1', '/publiclibrary/images/librarian_1.jpg', 'Nikhil', '8360737384', 'nikhilchaudhary285@gmail.com', '09:30 am to 06:00 pm', '2023-04-20 16:35:15'),
(2, 'librarian2', '/publiclibrary/images/librarian_2.jpeg', 'Karandeep Singh', '9855295267', 'skarandeep98765@gmail.com', '09:30 am to 06:00 pm', '2023-04-20 16:39:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availablebooks`
--
ALTER TABLE `availablebooks`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `designers`
--
ALTER TABLE `designers`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `issuedbooks`
--
ALTER TABLE `issuedbooks`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `libraryadmins`
--
ALTER TABLE `libraryadmins`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- Indexes for table `libraryeditors`
--
ALTER TABLE `libraryeditors`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- Indexes for table `libraryinquirymembers`
--
ALTER TABLE `libraryinquirymembers`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availablebooks`
--
ALTER TABLE `availablebooks`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `designers`
--
ALTER TABLE `designers`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issuedbooks`
--
ALTER TABLE `issuedbooks`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `libraryadmins`
--
ALTER TABLE `libraryadmins`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `libraryeditors`
--
ALTER TABLE `libraryeditors`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `libraryinquirymembers`
--
ALTER TABLE `libraryinquirymembers`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
