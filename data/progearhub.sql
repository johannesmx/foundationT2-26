-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 27, 2026 at 09:29 AM
-- Server version: 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progearhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'accessories', 'accessories'),
(2, 'women', 'Category for women items'),
(3, 'men', 'Category of items for men'),
(4, 'kids', 'Category of items for kids');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productdata`
--

CREATE TABLE `productdata` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(1124) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `brand` varchar(12) DEFAULT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `productdata`
--

INSERT INTO `productdata` (`id`, `name`, `description`, `price`, `category`, `brand`, `image`) VALUES
(1, 'Yoga Mat', 'Non-slip mat for yoga and stretching', '25.00', 1, 'Adidas', 'item01.jpg'),
(2, 'Nike Trend Oversized Crop Sweatshirt', 'Level up your look with this women\'s Hoodie from Nike. Nike has changed the game since 1972! Dropping iconic trainers, fits and accessories for almost half a century, Nike leads the way when it comes to tech and innovation.', '110.00', 2, 'Nike', 'item02.webp'),
(3, 'Sports T-Shirt', 'Breathable dry-fit shirt for workouts', '19.99', 3, 'Under Armour', 'item03.jpg'),
(5, 'Soccer Shin Guards', 'Designed to take the impacts of the game', '19.99', 1, 'Nike', 'item05.jpg'),
(6, 'Football', 'Standard size 5 football for matches', '29.99', 1, 'Puma', 'item06.jpg'),
(7, 'Nike Free Metcon 7', 'Flex your performance in the Free Metcon 7. Our most versatile training shoe gets updated with enhanced midfoot containment. Of course, we kept our famed Nike Free technology for a quick and powerful feel. The flexible forefoot and stable heel easily let you switch from dynamic to strength-based movements.', '133.00', 2, 'Nike', 'item07.jpg'),
(8, 'ASICS Training Joggers', 'The men\'s ASICS SportStyle Woven Training Jogger brings the same colourblock aesthetic as the rest of this JD Sports exclusive set to a functional woven pant that works across training days and casual wear with equal ease. Built from a smooth woven fabric with an elasticated drawstring waist and tapered leg, it delivers the clean, structured drape of a woven trouser with the comfort of a training bottom - making it just as useful on the way to a gym session as it is on a casual day out. White and pink contrast detailing against the black base ties this pant directly into the wider colourblock set, and zip pockets provide secure storage for everyday essentials. ASICS branding confirms the SportStyle identity. Arriving as a JD Sports exclusive in black with white and pink colourblocking, this is a men\'s ASICS woven training pant that earns its rotation spot as a versatile everyday option.', '110.00', 3, 'Asics', 'item08.jpg'),
(9, 'Sportswear Club Fleece Jogger Pants', 'Clean style meets casual comfort with these classic joggers. Midweight brushed fleece feels extra soft on the inside and smooth on the outside.\n\nStandard fit provides a relaxed feel through the seat and thighs, tapering towards the ankle. An elastic waistband and external drawcord offer a comfortable, adjustable fit at the waist. Snap closure back welt pocket and hand pockets accommodate most phones.', '52.50', 3, 'Nike', 'item09.jpg'),
(10, 'Running Shorts\n', 'Lightweight breathable shorts for running', '19.99', 3, 'Under Armour', 'item10.webp'),
(11, 'Resistance Bands Set', 'Elastic bands for strength and rehab training', '18.50', 1, 'Decathlon', 'item11.jpg'),
(12, 'Basketball', 'Indoor/outdoor durable basketball', '35.99', 1, 'Spalding', 'item12.jpg'),
(13, 'Tennis Racket\n', 'Lightweight racket for beginners and intermediates', '79.99', 1, 'Wilson', 'item13.jpg'),
(14, 'Gym Gloves', 'Protective gloves for weightlifting', '15.99', 1, 'Adidas', 'item14.jpg'),
(15, 'Cycling Helmet\n', 'Safety helmet for road and mountain cycling', '49.99', 1, 'Giro', 'item15.jpg'),
(16, 'Swim Goggles', 'Anti-fog goggles for swimming training', '14.50', 1, 'Speedo', 'item16.webp'),
(17, 'Mouthguard', 'Protect your mouth from unexpected punches', '178.00', 1, 'Everlast', 'item17.jpg'),
(18, 'Hayward Backpack', 'Recommended for Gym-Fitness, outdoors and training.\n\nAmerican sportswear giant Nike has established an inimitable reputation for performance and innovation. Combining a technical understanding of an athletes needs with a strong eye for style, Nike has become the go-to for professional and amateur athletes alike. With a roster that spans apparel, shoes and accessories suitable for any and every athletic pursuit, Nike has positioned themselves as a leader in their field with an extensive range that encompasses every aspect of a healthy lifestyle. From performance footwear to printed tights to moisture wicking running shorts, their extensive range of athletic products is designed to help keep you at the top of your game.\n\n- Durable and densely woven shell; lined interior\n- Made with at least 65% recycled polyester\n- Top carry handle\n- Adjustable shoulder straps; adjustable sternum strap\n- Exterior zip-fastened pocket with lace-up toggle fastening to front\n- Logo and Swoosh print to front\n- Side mesh pocket\n- Side sleeve pocket\n- Zip-fastened main compartment\n- Internal sleeve pocket; can fit up to a 15\" laptop', '59.49', 1, 'Nike', 'item18.jpg'),
(19, 'Amy No Chafe Phone Pocket Ankle Biter Leggings', 'Lorna Jane Amy No Chafe Phone Pocket Ankle Biter Leggings are a must-have wardrobe staple. A new take on a classic, these Nothing 2 See Here leggings feature Active Core Stability for a sculpting, supportive fit and side phone pockets for hands free movement. Pair with the Amy Sports Bra and Amy Active Tank for a matching set!\n\n- Active Core Stability\n- Side Phone Pockets for Convenience\n- Flatlock Seams for Added Comfort\n- Contouring Panel Lines to Flatter your Curves\n- Flattering High Rise Fit\n- No Inside Leg Seam to ensure friction-free movement\n- Unmatched Coverage\n- Moisture Wicking for Sweat Management\n- 4 Way Stretch for Unrestricted Movement\n- Lightly Brushed Soft Feel Fabric\n- Flattering Matte Finish\n- 71% Polyester / 29% Elastane', '75.00', 2, 'Lorna Jane', 'item19.jpg'),
(20, 'BSC COLLAGEN REGENERATE 153G', 'BODY SCIENCE TENDOFORTE COLLAGEN REGENERATE is Australia\'s first bioactive collagen peptide for tendons and ligaments. Exclusive to Body Science and supported by extensive clinical trials, intensive', '35.00', 1, 'BSC', 'item20.webp'),
(22, 'Kids\' Basketball Hoop ', 'Kids\' Basketball Hoop K100 Ball - Orange0.9m to 1.2m. Up to age 5.', '59.99', 4, 'KIPSTA', 'item22.avif'),
(23, 'Kids\' Rip-Tab Football Boots 160 Easy AG/FG - Green', 'Wanting your child to have the right boots for getting started with football? We created the 160 with a focus on comfort and elasticity for their first kicks.\r\nWe developed these 160 football boots for young beginner footballers playing 1 to 2 times a week on dry pitches.', '19.99', 4, 'KIPSTA', 'item23.avif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `productdata`
--
ALTER TABLE `productdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productdata`
--
ALTER TABLE `productdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productdata`
--
ALTER TABLE `productdata`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
