-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 08:19 PM
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
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(53, 'Mariam', 'maria', '21ad0bd836b90d08f4cf640b4c298e7c'),
(56, 'Mariam', 'maria', '1272c19590c3d44ce33ba054edfb9c78'),
(64, 'Marjan Hussain', 'maria', '20cc8da8a479b5051e505bb5049e016e'),
(65, 'Mariam Maria', 'maria', '81dc9bdb52d04dc20036dbd8313ed055'),
(66, 'Marjan Hussain', 'marjan', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(9, 'Dumplings', 'Food_Category_133.jpeg', 'Yes', 'Yes'),
(10, 'Kebab /Curry', 'Food_Category_11.jpeg', 'Yes', 'Yes'),
(11, 'Pizza', 'Food_Category_185.jpeg', 'Yes', 'Yes'),
(12, ' Cheesecake', 'Food_Category_193.jpeg', 'Yes', 'Yes'),
(13, 'Burger', 'Food_Category_692.jpeg', 'Yes', 'Yes'),
(14, 'Pasta and Noodles', 'Food_Category_22.jpeg', 'Yes', 'Yes'),
(15, 'Platters and Biriyani', 'Food_Category_943.jpeg', 'Yes', 'Yes'),
(16, 'Naan items', 'Food_Category_653.jpeg', 'Yes', 'Yes'),
(17, 'Drinks and coffee', 'Food_Category_54.jpeg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(10, 'Pepperoni Pizza', 'A timeless favorite featuring a crispy crust, tangy tomato sauce, and a generous layer of melted mozzarella cheese, all topped with savory slices of pepperoni.', 850.00, 'Food-Name-1903.jpeg', 11, 'Yes', 'Yes'),
(11, 'Gourmet Cheeseburger', ' Juicy beef patty topped with melted cheddar cheese, crisp lettuce, ripe tomatoes, and our special sauce, all sandwiched in a freshly baked bun.', 280.00, 'Food-Name-7865.jpeg', 13, 'Yes', 'Yes'),
(12, 'Creamy Alfredo Pasta:', 'Al dente pasta tossed in a rich and creamy Alfredo sauce, with a hint of garlic and a generous sprinkle of Parmesan cheese.', 450.00, 'Food-Name-1452.jpeg', 14, 'Yes', 'Yes'),
(13, 'Steamed Chicken Momo', ' Delicate dumplings filled with seasoned chicken and herbs, steamed to perfection and served with a spicy dipping sauce.', 250.00, 'Food-Name-3299.jpeg', 9, 'Yes', 'Yes'),
(14, 'Egg Fried Rice with Chicken Manchurian', 'Egg Fried Rice with Chicken Manchurian: Enjoy a delightful combination of fluffy egg fried rice, perfectly seasoned and tossed with vegetables, served alongside tender pieces of chicken coated in a rich, tangy Manchurian sauce. A perfect fusion of flavors and textures in every bite.', 490.00, 'Food-Name-7867.jpeg', 15, 'Yes', 'Yes'),
(15, 'Chicken Biriyani', ' Savor the aromatic and flavorful Chicken Biryani, a classic dish featuring tender chicken pieces marinated in a blend of spices and cooked with fragrant basmati rice. This delectable meal is layered with caramelized onions, fresh herbs, and garnished with boiled eggs and fried onions for a truly rich and satisfying experience.', 250.00, 'Food-Name-1825.jpeg', 15, 'Yes', 'Yes'),
(16, 'Chicken Tikka Kebab', 'Indulge in our succulent Chicken Tikka Kebabs, featuring tender pieces of chicken marinated in a blend of yogurt and traditional spices. Grilled to perfection, these kebabs offer a smoky flavor and a deliciously charred exterior, served with a side of tangy mint chutney and fresh salad for a delightful appetizer or main course.', 400.00, 'Food-Name-8162.jpeg', 10, 'Yes', 'Yes'),
(17, 'Paneer Tikka', 'Savor the exquisite flavors of our Paneer Tikka, a classic Indian appetizer loved by vegetarians and non-vegetarians alike. Made from fresh paneer (Indian cottage cheese) marinated in a blend of yogurt and aromatic spices, each cube is skewered and grilled to perfection, resulting in a tantalizing smoky flavor with a tender texture. Served with a side of tangy mint chutney and crisp salad, our Paneer Tikka is a delightful addition to any meal or occasion, promising a burst of authentic Indian flavors in every bite.', 400.00, 'Food-Name-8515.jpeg', 10, 'No', 'No'),
(18, 'Chicken Chowmein', 'Stir-fried noodles with tender chicken strips, mixed vegetables, and a savory blend of soy and oyster sauces.', 280.00, 'Food-Name-5934.jpeg', 14, 'Yes', 'Yes'),
(19, 'Oreo Bubble Shake', 'Indulge in the ultimate creamy delight with our Oreo Bubble Shake. Made with rich, velvety milkshake blended with crushed Oreo cookies, topped with a generous dollop of whipped cream, and finished with delightful boba pearls for a unique twist. Satisfy your sweet cravings with every sip of this irresistible treat, perfect for cooling off on a hot day or simply indulging in a decadent dessert experience.', 320.00, 'Food-Name-4280.jpeg', 17, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Steamed Chicken Momo', 250.00, 1, 250.00, '2024-05-18 05:12:28', 'Ordered', 'fnbsfn', '37489353', 'rijegi@gmail.com', 'iergisbgisr'),
(2, 'Steamed Chicken Momo', 250.00, 1, 250.00, '2024-05-18 05:12:57', 'Ordered', 'Maria Akter Mariam', '01722529385', 'abs@gmail.com', 'Metropolitan University,Sylhet'),
(3, 'Steamed Chicken Momo', 250.00, 1, 250.00, '2024-05-18 05:14:06', 'Ordered', 'Maria Akter Mariam', '01722529385', 'abs@gmail.com', 'Metropolitan University,Sylhet'),
(4, 'Steamed Chicken Momo', 250.00, 1, 250.00, '2024-05-18 05:14:18', 'Ordered', 'Maria Akter Mariam', '01722529385', 'abs@gmail.com', 'lkymlmk'),
(5, 'Steamed Chicken Momo', 250.00, 1, 250.00, '2024-05-18 05:16:15', 'On Delivery', 'Maria Akter Mariam', '01722529385', 'abs@gmail.com', 'lkymlmk'),
(6, 'Chicken Tikka Kebab', 400.00, 1, 400.00, '2024-05-18 05:18:26', 'Ordered', 'Maria Akter Mariam', '01722529385', 'abs@gmail.com', 'sdfe  ijgi ngisnin b'),
(7, 'Paneer Tikka', 400.00, 1, 400.00, '2024-05-18 05:20:29', 'Ordered', 'fnbsfn', '01722529385', 'mmaria1537@gmail.com', 'mlmflmv lb '),
(8, 'Chicken Biriyani', 250.00, 1, 250.00, '2024-05-18 05:23:08', 'Ordered', 'Maria Akter Mariam', '54655687959', 'fnjiefdksdnl@nrgjinv', 'mfk krfb'),
(9, 'Egg Fried Rice with Chicken Manchurian', 490.00, 1, 490.00, '2024-05-18 05:39:57', 'Delivered', 'Abdur Razzak', '01722529385', 'laden@gmail.com', 'hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
