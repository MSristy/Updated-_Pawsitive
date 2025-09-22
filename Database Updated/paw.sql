-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 05:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Admin',
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_email`, `admin_password`, `role`, `name`) VALUES
(1, 'sumaiyalima@gmail.com', '$2y$10$2cvvQgl6XLUrp3dLoFmMReEQL37Bxpr.0EKRdetgmUrp5QSdjTGVi', 'Admin', ''),
(4, 'tareqmonour00@gmail.com', '0d20b93812a60f072cbcf2ac64b271a6', 'Admin', 'Tareq Monour'),
(6, 'tareqmonour51@gmail.com', 'tareq', 'Admin', 'Tareq Monour');

-- --------------------------------------------------------

--
-- Table structure for table `adopters`
--

CREATE TABLE `adopters` (
  `a_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `preferences` text NOT NULL,
  `adoption_date` date NOT NULL,
  `experience` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adopters`
--

INSERT INTO `adopters` (`a_id`, `name`, `phone_number`, `email`, `preferences`, `adoption_date`, `experience`, `address`, `status`) VALUES
(9, 'sumaiya', '01861666884', 'sumaiya@gmail.com', 'Bichon Frise', '2024-10-03', 'yes', 'Dhaka', 'approved'),
(10, 'limaa', '01861666884', 'lima@gmail.com', 'Bichon Frise', '2024-10-03', 'no', 'Barishal', 'approved'),
(11, 'sristy', '01569108045', 'sristy@gmail.com', 'Budgerigar', '2024-10-04', 'yes', 'Dhaka', 'approved'),
(14, 'sristy', '01569108045', 'mina@gmail.com', 'Poodle', '2023-10-04', 'no', 'Chittagong', 'approved'),
(15, 'khushbu', '234455555', 'khushbu@gmail.com', 'Budgerigar', '2024-10-10', 'i have no experience', 'Dhaka', 'approved'),
(20, 'minaas', '01569108045', 'llll@gmail.com', 'Exotic Shorthair', '2024-10-06', 'no', 'Rajshahi', 'approved'),
(21, 'minaas', '01569108045', 'lalala@gmail.com', 'Budgerigar', '2024-10-06', 'yes', 'Barishal', 'approved'),
(23, 'sristy', '01569108045', 'aabdc@gmail.com', 'Budgerigar', '2024-10-11', 'yes', 'Rajshahi', 'approved'),
(24, '', '', '', '', '0000-00-00', '', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `adopter_email` varchar(255) NOT NULL,
  `certificate_number` varchar(50) NOT NULL,
  `date_of_issue` date NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `adopter_email`, `certificate_number`, `date_of_issue`, `pet_name`, `file_path`, `created_at`) VALUES
(7, 'sumaiya@gmail.com', 'CERT_66fe8dbcbabcf', '2024-10-03', '', '', '2024-10-03 12:27:40'),
(8, 'sumaiya@gmail.com', 'CERT_66fe8dedf11ad', '2024-10-03', '', '', '2024-10-03 12:28:29'),
(9, 'lima@gmail.com', 'CERT_66fe930c21906', '2024-10-03', '', '', '2024-10-03 12:50:20'),
(10, 'lima@gmail.com', 'CERT_66fe933551d63', '2024-10-03', '', '', '2024-10-03 12:51:01'),
(11, 'sristy@gmail.com', 'CERT_66ff98915711c', '2024-10-04', '', '', '2024-10-04 07:26:09'),
(12, 'sristy@gmail.com', 'CERT_66ff98a84dac9', '2024-10-04', '', '', '2024-10-04 07:26:32'),
(13, 'mina@gmail.com', 'CERT_66fff5c2522ac', '2023-10-04', '', '', '2024-10-04 14:03:46'),
(14, 'mina@gmail.com', 'CERT_66fff5dccc269', '2023-10-04', '', '', '2024-10-04 14:04:12'),
(15, 'khushbu@gmail.com', 'CERT_670253c101160', '2024-10-10', '', '', '2024-10-06 09:09:21'),
(16, 'khushbu@gmail.com', 'CERT_670254909ddac', '2024-10-10', '', '', '2024-10-06 09:12:48'),
(17, 'llll@gmail.com', 'CERT_67026c52ee541', '2024-10-06', '', '', '2024-10-06 10:54:10'),
(18, 'lalala@gmail.com', 'CERT_67026d9e0f3a6', '2024-10-06', '', '', '2024-10-06 10:59:42'),
(19, 'llll@gmail.com', 'CERT_67060c155ab5a', '2024-10-06', '', '', '2024-10-09 04:52:37'),
(20, 'lalala@gmail.com', 'CERT_670807177f9f0', '2024-10-06', '', '', '2024-10-10 16:55:51'),
(21, 'aabdc@gmail.com', 'CERT_670928a52e1a4', '2024-10-11', '', '', '2024-10-11 13:31:17'),
(22, 'aabdc@gmail.com', 'CERT_67092ad37c825', '2024-10-11', '', '', '2024-10-11 13:40:35'),
(23, '', 'CERT_678361a8afd99', '0000-00-00', '', '', '2025-01-12 06:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `how_to_win` text DEFAULT NULL,
  `previous_winners` text DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `title`, `date`, `location`, `contact`, `how_to_win`, `previous_winners`, `image`) VALUES
(1, 'Annual Pet Talent Show', '2025-02-27', 'Pampered Paws Bangladesh', '123-456-7890', 'Showcase your pet\'s best trick, behavior, or talent! Judges will be evaluating based on creativity, execution, and audience appeal.', 'Winner 2023: Bella the Beagle - Best trick: balancing 5 balls.', 'com.jpg'),
(2, 'Pet Fashion Parade', '2025-03-14', 'Shaheed Zayan Chowdhury Playground', '+8801568754631', 'Dress up your pets in their fanciest costumes. Judges will be scoring based on originality, detail, and pet comfort.', 'Winner 2024: Max the Poodle - Best Costume: Superhero Outfit.', 'compi.jpg'),
(3, 'PAW CARNIVAL 2025', '2025-02-07', 'Gulshan Society Lake Park', '01800000328', 'To excel at the Paw Carnival 2025\'s pet fashion show, unleash your creativity by designing unique outfits for your pet. Ensure your pet is comfortable and confident in their attire. Practice walking together to perfect their runway presence. Most importantly, enjoy the experience and have fun with your furry friend. \r\n', '2024: Charlie the Border Collie - Best Trick: Solving a puzzle in under 2 minutes.', 'Paw Carnival 2025.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `contact_type` enum('phone','email','facebook') NOT NULL,
  `contact_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `contact_type`, `contact_value`, `created_at`) VALUES
(1, 'phone', '0186166884', '2024-10-03 05:37:45'),
(2, 'email', 'sumaiyalima789@gmail.com', '2024-10-03 05:37:45'),
(3, 'facebook', 'https://www.facebook.com/sumaiya.lima.25', '2024-10-03 05:37:45'),
(4, 'phone', '01569108045', '2024-10-03 05:37:45'),
(5, 'email', 'msristy221447@bscse.uiu.ac.bd', '2024-10-03 05:37:45'),
(6, 'facebook', 'https://www.facebook.com/mahmudaakter.sristy', '2024-10-03 05:37:45'),
(7, 'phone', '01745531727', '2024-10-03 05:37:45'),
(8, 'email', 'mdalmahfuzchowdhury@gmail.com', '2024-10-03 05:37:45'),
(9, 'facebook', 'https://www.facebook.com/siam.mahfuz.7', '2024-10-03 05:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `donation_amount` decimal(10,2) DEFAULT NULL,
  `shelter` varchar(255) DEFAULT NULL,
  `in_honor_of` varchar(255) DEFAULT NULL,
  `additional_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `donation_amount`, `shelter`, `in_honor_of`, `additional_message`, `created_at`, `payment_method`, `category`) VALUES
(1, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:12:37', 'bkash', ''),
(2, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:15:41', 'bkash', ''),
(3, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:17:34', 'bkash', ''),
(4, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:18:50', 'bkash', ''),
(5, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:19:11', 'bkash', ''),
(6, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:19:29', 'bkash', ''),
(7, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:19:45', 'bkash', ''),
(8, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:20:30', 'bkash', ''),
(9, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:20:42', 'bkash', ''),
(10, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:21:51', 'bkash', ''),
(11, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:22:18', 'bkash', ''),
(12, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:22:29', 'bkash', ''),
(13, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:22:43', 'bkash', ''),
(14, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:23:02', 'bkash', ''),
(15, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:23:20', 'bkash', ''),
(16, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:23:37', 'bkash', ''),
(17, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:23:56', 'bkash', ''),
(18, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 05:28:49', 'bkash', ''),
(19, 93.96, NULL, '', '', '2025-01-19 06:34:11', 'bkash', 'marketplace'),
(20, 93.96, NULL, '', '', '2025-01-19 06:39:45', 'rocket', 'marketplace'),
(21, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:40:32', 'nagad', 'shelter'),
(22, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:42:20', 'nagad', 'shelter'),
(23, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:42:52', 'nagad', 'shelter'),
(24, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:46:26', 'nagad', 'shelter'),
(25, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:51:17', 'nagad', 'shelter'),
(26, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:51:26', 'nagad', 'shelter'),
(27, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:52:08', 'nagad', 'shelter'),
(28, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:52:20', 'nagad', 'shelter'),
(29, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:52:30', 'nagad', 'shelter'),
(30, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:52:49', 'nagad', 'shelter'),
(31, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:53:42', 'nagad', 'shelter'),
(32, 93.96, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 06:54:10', 'nagad', 'shelter'),
(33, 200.00, 'shelter_3', 'Tareq Monour', 'Thank you.', '2025-01-19 06:54:35', 'nagad', 'shelter'),
(34, 200.00, 'shelter_3', 'Tareq Monour', 'Thank you.', '2025-01-19 06:59:10', 'nagad', 'shelter'),
(35, 200.00, 'shelter_2', 'Tareq Monour', 'Thank you.', '2025-01-19 07:00:25', 'rocket', 'shelter'),
(36, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:08:46', 'rocket', 'shelter'),
(37, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:09:03', 'rocket', 'shelter'),
(38, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:09:16', 'rocket', 'shelter'),
(39, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:09:33', 'rocket', 'shelter'),
(40, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:09:45', 'rocket', 'shelter'),
(41, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:09:59', 'rocket', 'shelter'),
(42, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:10:13', 'rocket', 'shelter'),
(43, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:12:26', 'rocket', 'shelter'),
(44, 200.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 07:12:48', 'rocket', 'shelter'),
(45, 148.49, 'shelter_1', 'Tareq Monour', '', '2025-01-19 08:09:14', 'bkash', 'marketplace'),
(46, 90.48, NULL, '', '', '2025-01-19 08:46:45', 'nagad', 'marketplace'),
(47, 120.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-19 08:49:34', 'bkash', 'shelter'),
(48, 150.00, NULL, '', '', '2025-01-19 09:46:55', 'rocket', 'marketplace'),
(49, 100.00, 'shelter_1', 'Tareq Monour', 'Thank you.', '2025-01-26 17:17:02', 'rocket', 'shelter');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`) VALUES
(1, 'How do I adopt a pet?', 'You can browse the pets available for adoption and submit an adoption request.', '2024-10-03 05:37:45'),
(2, 'What is the adoption fee?', 'The adoption fee varies depending on the pet. Please contact us for more details.', '2024-10-03 05:37:45'),
(3, 'How long does the adoption process take?', 'The adoption process typically takes between 2-5 days, depending on the pet and the application.', '2024-10-03 05:37:45'),
(4, 'Can I return a pet if it doesn’t fit in?', 'While we do our best to match pets with the right owners, we understand things happen. Please contact us for returns.', '2024-10-03 05:37:45'),
(5, 'Do you offer support after adoption?', 'Yes, we offer post-adoption support through our network of veterinarians and trainers.', '2024-10-03 05:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `localpets`
--

CREATE TABLE `localpets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `localpets`
--

INSERT INTO `localpets` (`id`, `name`, `type`, `age`, `sex`, `breed`, `description`, `image_url`) VALUES
(1, 'Buddy', NULL, 2, 'Female', 'Golden Retriever', 'Friendly and energetic.', 'images/dog1.jpg'),
(2, 'Mittens', NULL, 3, 'Male', 'Persian Cat', 'Loves cuddles and attention.', 'images/cat1.jpg'),
(3, 'Charlie', NULL, 1, 'Female', 'Labrador', 'Playful and loves kids.', 'images/dog2.jpg'),
(4, 'Bella', NULL, 4, 'Male', 'Siamese Cat', 'Calm and affectionate.', 'images/cat2.jpg'),
(5, 'Buddy', NULL, 2, 'Female', 'Golden Retriever', 'Friendly and energetic.', 'images/Dog Final.jpg'),
(6, 'Deba', NULL, 3, 'Male', 'Persian Cat', 'Loves cuddles and attention.', 'images/local bird 4.jpg'),
(7, 'Charlie', NULL, 1, 'Female', 'Labrador', 'Playful and loves kids.', 'images/new cat.jpg'),
(8, 'Bella', NULL, 4, 'Male', 'Siamese Cat', 'Calm and affectionate.', 'images/local cat 2.jpg'),
(9, 'Buddy', NULL, 2, 'Female', 'Golden Retriever', 'Friendly and energetic.', 'images/local cat 3.jpg'),
(10, 'Rabbo', NULL, 3, 'Male', 'Desi Rabbit', 'Loves cuddles and attention.', 'images/local rabbit 1.jpg'),
(11, 'Paruu', NULL, 1, 'Female', 'Labrador', 'Playful and loves kids.', 'images/local bird 1.jpg'),
(12, 'Lamphi', NULL, 4, 'Male', 'Siamese Cat', 'Calm and affectionate.', 'images/local bird 2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `membership_level`
--

CREATE TABLE `membership_level` (
  `id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parks`
--

CREATE TABLE `parks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parks`
--

INSERT INTO `parks` (`id`, `name`, `location`, `image`) VALUES
(1, 'Central Park', 'Shaheed Zayan Chowdhury Playground', 'park1.jpg'),
(2, 'Gulshan Park', 'Gulshan Society Lake Park', 'park2.jpg'),
(3, 'Baridhara park', 'Baridhara Park, 9 Road No. 9, Dhaka 1212', 'park3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL,
  `status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets1`
--

CREATE TABLE `pets1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `age` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `pet_size` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `story` text DEFAULT NULL,
  `additional_images` text DEFAULT NULL,
  `suggested_food` text DEFAULT NULL,
  `care_tips` text DEFAULT NULL,
  `suggested_pets` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets1`
--

INSERT INTO `pets1` (`id`, `name`, `breed`, `age`, `location`, `gender`, `pet_size`, `fee`, `temp`, `image_url`, `story`, `additional_images`, `suggested_food`, `care_tips`, `suggested_pets`) VALUES
(1, 'Bella', 'Poodle', '3 years', 'Los Angeles', 'Male', 'Medium', '15k', 'Friendly', 'images/dogpod.png', 'Bella is a loving and friendly poodle who enjoys long walks and playing fetch. She is great with kids and other pets.', '[\"images/dogpod_side.png\", \"images/dogpod_back.png\"]', 'Premium dog food, chicken treats, and grain-free snacks.', 'Daily walks, regular grooming, and annual vet checkups.', '[2, 3]'),
(2, 'Max', 'Poodle', '2 years', 'New York', 'Male', 'Large', '25k', 'Energetic', 'images/poddle2.jpg', 'Max is an energetic and playful poodle who loves outdoor adventures and is always ready for a game of tug-of-war.', '[\"images/poddle2_side.jpg\", \"images/poddle2_back.jpg\"]', 'High-protein dog food, dental chews, and peanut butter.', 'Frequent exercise, mental stimulation, and socialization.', '[1, 4]'),
(3, 'Chini', 'Exotic Shorthair', '6 month', 'San Francisco', 'Female', 'Medium', '22k', 'Calm', 'images/catExo.png', 'Chini is a calm and affectionate exotic shorthair cat who loves curling up in a sunny spot. She is perfect for a quiet home.', '[\"images/catExo_side.png\", \"images/catExo_back.png\"]', 'Premium cat food, wet food with salmon, and catnip treats.', 'Regular brushing, scratching posts, and quiet environments.', '[4, 5]'),
(4, 'Mini', 'Exotic Shorthair', '1 year', 'San Francisco', 'Male', 'Medium', '16k', 'Friendly', 'images/exo2.jpg', 'Mini is a playful and curious exotic shorthair cat who enjoys exploring and playing with toys. She loves attention and cuddles.', '[\"images/exo2_side.jpg\", \"images/exo2_back.jpg\"]', 'Dry cat food, tuna treats, and hairball control snacks.', 'Weekly grooming, interactive toys, and climbing spaces.', '[3, 6]'),
(5, 'Leo', 'Budgerigar', '8 month', 'Pakistan', 'Female', 'Small', '18k', 'Energetic', 'images/birdBud.png', 'Leo is a vibrant and cheerful budgerigar who loves singing and interacting with people. He enjoys flying around and exploring his surroundings.', '[\"images/birdBud_side.png\", \"images/birdBud_back.png\"]', 'Seed mix, millet sprays, and fresh fruits.', 'Clean cage daily, provide fresh water, and plenty of interaction.', '[6, 7]'),
(6, 'Tweety', 'Budgerigar', '1.5 years', 'Pakistan', 'Female', 'Small', '12k', 'Friendly', 'images/bud2.jpg', 'Tweety is a sweet and friendly budgerigar who loves chirping and playing with toys. She is perfect for a loving family.', '[\"images/bud2_side.jpg\", \"images/bud2_back.jpg\"]', 'Pellet food, leafy greens, and egg food.', 'Provide perches, toys for mental stimulation, and a spacious cage.', '[5, 8]'),
(7, 'Johny', 'Bichon Frisé ', '2 years', 'Finland', 'Male', 'Large', '30k', 'Friendly', 'images/dog2.png', 'Johny is a charming Bichon Frisé who loves to be around people. He is highly trainable and enjoys learning new tricks.', '[\"images/dog2_side.png\", \"images/dog2_back.png\"]', 'Grain-free kibble, chicken jerky, and dental chews.', 'Frequent playtime, regular vet visits, and a healthy diet.', '[8, 9]'),
(8, 'Tommy', 'Bichon Frisé ', '2 years', 'Finland', 'Male', 'Medium', '20k', 'Energetic', 'images/bic2.jpg', 'Tommy is a spirited and playful Bichon Frisé who loves running and playing in open spaces. He is great for an active family.', '[\"images/bic2_back.jpg\"]', 'Low-fat kibble, peanut butter, and chew toys.', 'Daily walks, mental stimulation, and proper grooming.', '[7, 10]'),
(9, 'Anny', 'Norwegian Forest cat', '1 year', 'Norwegian ', 'Female', 'Medium', '18k', 'Calm', 'images/catNor.png', 'Anny is a gentle and elegant Norwegian Forest cat who enjoys lounging and being pampered. She is ideal for a quiet home.', '[\"images/catNor_back.png\"]', 'Premium dry cat food, fish-flavored treats, and milk.', 'Daily brushing, quiet spaces, and regular playtime.', '[10, 11]'),
(10, 'Peanut', 'Norwegian Forest cat', '2 years', 'Norwegian ', 'Male', 'Small', '25k', 'Friendly', 'images/nor2.jpg', 'Peanut is a curious and intelligent Norwegian Forest cat who loves exploring and interacting with her environment.', '[\"images/nor2_side.jpg\", \"images/nor2_back.jpg\"]', 'Grain-free wet food, chicken-flavored snacks, and catnip.', 'Provide scratching posts, regular grooming, and mental stimulation.', '[9, 12]'),
(11, 'Lanny', 'Cockatiel', '1.5 years', 'India', 'Female', 'Medium', '10k', 'Friendly', 'images/birdCok.png', 'Lanny is a lively and friendly Cockatiel who enjoys whistling and interacting with people. She loves being the center of attention.', '[\"images/birdCok_side.png\", \"images/birdCok_back.png\"]', 'Seed mix, fresh vegetables, and occasional egg food.', 'Provide toys, clean water, and a variety of perches.', '[12, 1]'),
(12, 'Pinni', 'Cockatiel', '5 months', 'India', 'Female', 'Small', '20k', 'Calm', 'images/cock2.jpg', 'Pinni is a calm and sweet Cockatiel who enjoys quiet environments. She loves sitting on your shoulder and being part of the family.', '[\"images/cock2_side.jpg\", \"images/cock2_back.jpg\"]', 'Pellet food, leafy greens, and occasional millet.', 'Keep the cage clean, provide fresh water, and avoid overcrowding.', '[11, 2]');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `date_posted` date DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `date_posted`, `category`, `tags`, `image_url`, `is_featured`, `views`) VALUES
(1, 'The Benefits of Pet Adoption', 'Adopting a pet saves lives...', 'John Doe', '2024-09-21', 'Pet Care', 'adoption, rescue', 'images/picpic.webp', 1, 0),
(2, 'How to Care for Your New Puppy', 'Caring for a new puppy...', 'Jane Smith', '2024-09-20', 'Pet Care', 'puppy, care', 'images/picpic2.jpg', 0, 0),
(3, 'Upcoming Shelter Events', 'Join us for our shelter event...', 'Shelter Team', '2024-09-18', 'Events', 'events, adoption', 'images/pipcpic3.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` enum('food','medicine') NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category`, `description`, `price`, `image_url`) VALUES
(1, 'Meow Mix Cat Food', 'food', 'Delicious and nutritious food for your cat.', 10.99, 'images/download (4).jpeg'),
(2, '9Lives Daily Cat Food', 'food', 'Affordable and healthy meals for cats.', 12.50, 'images/d5.jpeg'),
(3, 'ProDiet Dog Food', 'food', 'Premium dog food for a balanced diet.', 18.99, 'images/d6.jpg'),
(4, 'Captain Cat Treats', 'food', 'Special treats to make your cat happy.', 15.00, 'images/d7.jpeg'),
(5, 'PetVax Vaccine', 'medicine', 'Vaccine for maintaining your pet’s health.', 25.00, 'images/d8.jpeg'),
(6, 'Flea Control Spray', 'medicine', 'Effective flea treatment for pets.', 20.00, 'images/d9.jpeg'),
(7, 'Dog Antibiotics', 'medicine', 'Antibiotics for treating dog infections.', 30.00, 'images/d10.jpg'),
(8, 'Cat Eye Drops', 'medicine', 'Eye drops for treating cat eye infections.', 15.50, 'images/d11.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `rehomers_application`
--

CREATE TABLE `rehomers_application` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pet_choice` varchar(50) DEFAULT NULL,
  `pet_age` varchar(10) DEFAULT NULL,
  `pet_picture` varchar(255) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rehomers_application`
--

INSERT INTO `rehomers_application` (`id`, `name`, `email`, `phone`, `pet_choice`, `pet_age`, `pet_picture`, `approved`) VALUES
(1, 'sristy', 'sristy@gmail.com', '01861666884', 'cat', '2', 'images/cat.png', 1),
(2, 'lima', 'sristy@gmail.com', '01861666884', 'bird', '3', 'images/bird.png', 1),
(3, 'siam', 'sristy@gmail.com', '01861666884', 'dog', '1', 'images/bic2.jpg', 1),
(4, 'minaas', 'sristy@gmail.com', '01861666884', 'cat', '1', 'images/birdCok.png', 1),
(18, 'Tareq Monour', 'mmonour221519@bscse.uiu.ac.bd', '01521782400', 'dog', '2', 'images/Dog Final.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_type` enum('Adoption','Complaint','Feedback','Bug','Other') NOT NULL,
  `report_title` varchar(255) NOT NULL,
  `report_description` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Resolved','Closed') DEFAULT 'Pending',
  `resolved_date` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_housing`
--

CREATE TABLE `temporary_housing` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `pet_type` enum('dog','cat','bird') NOT NULL,
  `pet_name` varchar(100) NOT NULL,
  `pet_breed` varchar(100) DEFAULT NULL,
  `pet_age` varchar(50) NOT NULL,
  `health_status` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `pet_picture` varchar(255) NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temporary_housing`
--

INSERT INTO `temporary_housing` (`id`, `name`, `email`, `phone`, `address`, `pet_type`, `pet_name`, `pet_breed`, `pet_age`, `health_status`, `start_date`, `end_date`, `reason`, `pet_picture`, `approved`, `created_at`) VALUES
(1, 'sristy', 'sristy@gmail.com', '01861666884', 'dhaka', 'dog', 'kitty', 'poddle', '2', 'normal', '2024-10-07', '2024-10-10', 'I am going for treatment', 'images/bic2.jpg', 1, '2024-10-06 13:39:00'),
(2, 'khushbu', 'khushbu@gmail.com', '01861666884', 'dhaka', 'bird', 'kitty', 'parsian', '3', 'good', '2024-10-12', '2024-10-15', 'I am going for treatment\r\n', 'images/cock2.jpg', 0, '2024-10-11 13:38:07'),
(3, 'Tareq Monour', 'mmonour221519@bscse.uiu.ac.bd', '', 'Madani Avenue, Vatara, Dhaka', 'dog', 'Panda', '', '2', 'Good', '2025-01-26', '2025-01-26', 'I\'m leaving home for a trip of 7 days. I will take it back.', 'images/cat.png', 0, '2025-01-26 14:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'uploads/default.png',
  `password` varchar(255) NOT NULL,
  `pet_type` varchar(100) DEFAULT NULL,
  `pet_picture` varchar(255) DEFAULT 'uploads/default_pet.png',
  `users_first_name` varchar(255) DEFAULT NULL,
  `users_last_name` varchar(255) DEFAULT NULL,
  `users_email` varchar(255) DEFAULT NULL,
  `users_password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','User') DEFAULT 'User',
  `rewards` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_pic`, `password`, `pet_type`, `pet_picture`, `users_first_name`, `users_last_name`, `users_email`, `users_password`, `role`, `rewards`) VALUES
(1, '', 'lima@gmail.com', 'uploads/default.png', '$2y$10$OXhp5QiJQjLAdhJ7KdW9D.GAFFBuuzXXk30mLBpeXjoBgInf4hijW', NULL, 'uploads/default_pet.png', NULL, NULL, NULL, NULL, 'User', 0),
(2, '', 'afnan@gmail.com', 'uploads/default.png', '$2y$10$yjBPeQHJ600Eqn/8P.CC8OJiMWbkpI3vKy86i5/hxHNgIpuJ7Ag4q', NULL, 'uploads/default_pet.png', NULL, NULL, NULL, NULL, 'User', 0),
(3, '', 'sumaiya@gmail.com', 'uploads/default.png', '$2y$10$qhEPyYKGxSB9buu7RiEt9.K3b77V3o5itUYGZu27p6C4VvBH4Lt5q', NULL, 'uploads/default_pet.png', NULL, NULL, NULL, NULL, 'User', 0),
(4, '', 'sristy@gmail.com', 'uploads/default.png', '$2y$10$ubOWjPp1Dna/pU/TUJVuvunon1EyMAAH1q7GheAkT1pJavAe02ihi', NULL, 'uploads/default_pet.png', NULL, NULL, NULL, NULL, 'User', 0),
(7, 'Lotifur Nishat', 'lnishat@gmail.com', 'uploads/default.png', '86119e55ee53cc8e91c65180d552d5b1', NULL, 'uploads/default_pet.png', 'Lotifur', 'Nishat', NULL, NULL, 'User', 0),
(10, 'Tareq Monour', 'tareqmonour00@gmail.com', 'images/67964c95e337c_Tareq.jpg', '1234', NULL, 'uploads/default_pet.png', 'Tareq', 'Monour', NULL, NULL, 'User', 10),
(11, '', 'mariorozario@gmail.com', 'uploads/default.png', '$2y$10$Uxsvzsmh61NQlkXWKOFO4O2s2K6YEQFIIsroZL8IQT6Hnl9mPM3Be', NULL, 'uploads/default_pet.png', NULL, NULL, NULL, NULL, 'User', 0),
(12, 'Tareq Monour', 'tareqmonour51@gmail.com', 'images/679667b5ded99_Tareq.jpg', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'uploads/default_pet.png', 'Tareq', 'Monour', NULL, NULL, 'User', 0),
(13, 'Mahmuda Sristy', 'msristy221447@bscse.uiu.ac.bd', 'images/679b787b3b5d5_IMG20231025222101.jpg', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'uploads/default_pet.png', 'Mahmuda', 'Sristy', NULL, NULL, 'User', 0),
(14, 'Mahmuda Sristy', '447@bscse.uiu.ac.bd', 'uploads/default.png', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'uploads/default_pet.png', 'Mahmuda', 'Sristy', NULL, NULL, 'User', 0),
(15, 'Mahmuda Sristy', 'a@gmail.com', 'uploads/default.png', '202cb962ac59075b964b07152d234b70', NULL, 'uploads/default_pet.png', 'Mahmuda', 'Sristy', NULL, NULL, 'User', 0),
(16, 'Mahmuda Akter', 'yz@gmail.com', 'images/67d7d12ee06c2_679b787b3b5d5_IMG20231025222101.jpg', '8d5e957f297893487bd98fa830fa6413', NULL, 'uploads/default_pet.png', 'Mahmuda', 'Akter', NULL, NULL, 'User', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_pets`
--

CREATE TABLE `user_pets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_type` varchar(100) NOT NULL,
  `pet_picture` varchar(255) DEFAULT 'uploads/default_pet.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_pets`
--

INSERT INTO `user_pets` (`id`, `user_id`, `pet_type`, `pet_picture`) VALUES
(1, 10, 'Bird', 'uploads/67964cc18c4d4_bird.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `blog_post` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date_submitted` datetime DEFAULT current_timestamp(),
  `approved` tinyint(1) DEFAULT 0,
  `is_approved` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`id`, `name`, `email`, `blog_post`, `picture`, `date_submitted`, `approved`, `is_approved`) VALUES
(1, 'Siam Mahfuz', 'siam@gmail.com', 'Transform the life of a shelter pet and find unconditional love. ', 'images/birdBud.png', '2025-01-15 19:53:00', 1, 1),
(2, 'Sayma Khusbu ', 'sristy@gmail.com', 'Bring joy into your life by adopting a pet in need.', 'images/dog2.png', '2025-01-11 20:08:54', 1, 1),
(3, 'Tareq Monour', 'tareqmonour@gmail.com', 'Discover a world of wagging tails and purring friends. Every adoption is a chance to spread love and kindness.', 'images/bud2.jpg', '2025-01-24 20:36:33', 1, 1),
(4, 'Jannatul Tazrian', 'jtazrian@gmail.com', 'Be the hero every pet dreams of. Browse our pet adoption system and welcome a loyal companion into your life.', 'images/catExo.png', '2025-01-06 20:50:20', 1, 1),
(5, 'Mahmuda Sristy', 'ssristy@gmail.com', 'Turn your home into a haven of joy with a rescued pet. Adoption isn’t just a choice—it’s a life-changing journey.', 'images/local cat 3.jpg', '2025-01-26 13:52:18', 0, 1),
(9, 'Tareq Monour', 'tareqmonour00@gmail.com', 'Lovely experience to exploring Pawsitive.', 'images/679674a80d7cd.jpg', '2025-01-26 23:45:12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_questions`
--

CREATE TABLE `user_questions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vets`
--

CREATE TABLE `vets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `experience` int(11) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vets`
--

INSERT INTO `vets` (`id`, `name`, `specialization`, `experience`, `contact`, `image`) VALUES
(1, 'Dr. Sagir uddin Ahmed', 'Veterinary Surgeon & Pet Consultant', 10, '01706214759', 'Vet Dr. Sagir uddin Ahmed.jpeg'),
(2, '	Dr. Azmat Ali', 'Veterinary Dermatology', 8, '01715078434', 'dr-azmat-ali.png'),
(3, 'Dr. Arifur Rabbi', 'Pet Animal Practitioner', 12, '01785636036', 'Dr. Arifur Rabbi.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `vet_appointments`
--

CREATE TABLE `vet_appointments` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `pet_name` varchar(100) NOT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `contact_info` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `time_slot` varchar(10) NOT NULL,
  `status` enum('pending','confirmed') DEFAULT 'pending',
  `admin_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vet_appointments`
--

INSERT INTO `vet_appointments` (`id`, `user_name`, `pet_name`, `vet_id`, `appointment_date`, `contact_info`, `email`, `time_slot`, `status`, `admin_message`) VALUES
(1, 'sristy', 'ululu', 1, '2024-10-04', '01861666884', 'sristy@gmail.com', '09:00', 'confirmed', NULL),
(2, 'sristy', 'ululu', 1, '2024-10-04', '01861666884', 'sristy@gmail.com', '10:00', 'confirmed', NULL),
(3, 'lima', 'kitty', 3, '2024-10-04', '01861666884', 'sristy@gmail.com', '13:00', 'confirmed', NULL),
(5, 'khushbu', 'Budgerigar', NULL, '2024-10-06', '234455555', 'khushbu@gmail.com', '10:00', 'confirmed', NULL),
(6, 'khushbu', 'Budgerigar', NULL, '2024-10-06', '234455555', 'khushbu@gmail.com', '10:00', 'confirmed', NULL),
(7, 'sristy', 'Budgerigar', NULL, '2024-10-07', '01569108045', 'sristy@gmail.com', '14:00', 'confirmed', NULL),
(8, 'sristy', 'Budgerigar', NULL, '2024-10-08', '01569108045', 'sristy@gmail.com', '10:00', 'confirmed', NULL),
(9, 'sristy', 'Budgerigar', NULL, '2024-10-08', '01569108045', 'sristy@gmail.com', '11:00', 'confirmed', NULL),
(10, 'sristy', 'Poodle', NULL, '2024-10-08', '01569108045', 'mina@gmail.com', '10:00', 'confirmed', NULL),
(11, 'sristy', 'Budgerigar', NULL, '2024-10-01', '01569108045', 'sristy@gmail.com', '09:00', 'confirmed', NULL),
(12, 'sristy', 'Budgerigar', NULL, '2024-10-12', '01569108045', 'sristy@gmail.com', '09:00', 'confirmed', NULL),
(19, 'Tareq Monour', 'Panda', NULL, '2025-01-27', '01764968722', 'tareqmonour00@gmail.com', '15:00', 'pending', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`admin_email`);

--
-- Indexes for table `adopters`
--
ALTER TABLE `adopters`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `certificate_number` (`certificate_number`),
  ADD KEY `adopter_email` (`adopter_email`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localpets`
--
ALTER TABLE `localpets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_level`
--
ALTER TABLE `membership_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level_name` (`level_name`);

--
-- Indexes for table `parks`
--
ALTER TABLE `parks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pets1`
--
ALTER TABLE `pets1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rehomers_application`
--
ALTER TABLE `rehomers_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `temporary_housing`
--
ALTER TABLE `temporary_housing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_pets`
--
ALTER TABLE `user_pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_questions`
--
ALTER TABLE `user_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vets`
--
ALTER TABLE `vets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vet_appointments`
--
ALTER TABLE `vet_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adopters`
--
ALTER TABLE `adopters`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `localpets`
--
ALTER TABLE `localpets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `membership_level`
--
ALTER TABLE `membership_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parks`
--
ALTER TABLE `parks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pets1`
--
ALTER TABLE `pets1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rehomers_application`
--
ALTER TABLE `rehomers_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_housing`
--
ALTER TABLE `temporary_housing`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_pets`
--
ALTER TABLE `user_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_questions`
--
ALTER TABLE `user_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vets`
--
ALTER TABLE `vets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vet_appointments`
--
ALTER TABLE `vet_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`adopter_email`) REFERENCES `adopters` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_pets`
--
ALTER TABLE `user_pets`
  ADD CONSTRAINT `user_pets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vet_appointments`
--
ALTER TABLE `vet_appointments`
  ADD CONSTRAINT `vet_appointments_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `vets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
