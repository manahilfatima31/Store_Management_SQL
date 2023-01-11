-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2016 at 07:01 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wholesale_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `discount_calc` (IN `product` INT(10), IN `quant` INT(10), OUT `disc` INT(10))  BEGIN
declare price int; 
declare disc int; 
declare total int;
select USP into price from price_list where ProductID = product;
set total=quant*price; 
if (total >= 20000 and total < 40000) THEN
   set disc=total*0.025;
elseif (total >= 40000 and total < 60000) THEN
   set disc=total*0.05;
elseif (total >= 60000 and total < 100000) THEN
   set disc=total*0.075;
elseif (total >= 100000) THEN
   set disc=total*0.1;
end if;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Food'),
(2, 'Cosmetics'),
(3, 'Personal Hygiene'),
(4, 'Pets');

-- --------------------------------------------------------

--
-- Table structure for table `customer_information`
--

CREATE TABLE `customer_information` (
  `CustomerID` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_information`
--

INSERT INTO `customer_information` (`CustomerID`, `Name`, `Address`, `Phone`, `Password`) VALUES
('A1', 'Usman Yaqoob', 'Gulshan', '03231234509', 'abc12'),
('A2', 'Manahil Fatima', 'Johar', '03351356204', 'mypassword'),
('A3', 'Anas Ahmed', 'DHA', '03247894651', 'whocares');

-- --------------------------------------------------------

--
-- Table structure for table `depleted_product`
--

CREATE TABLE `depleted_product` (
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `TransactionID` int(11) NOT NULL,
  `Amount_Paid` int(11) NOT NULL,
  `Mode` varchar(30) NOT NULL,
  `Transaction_Date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`TransactionID`, `Amount_Paid`, `Mode`, `Transaction_Date`) VALUES
(16, 3400, 'credit card', 2022),
(23, 5440, 'cash', 2022),
(27, 1560, 'debit card', 2022),
(28, 5254, 'debit card', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

CREATE TABLE `price_list` (
  `ProductID` int(11) NOT NULL,
  `USP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_list`
--

INSERT INTO `price_list` (`ProductID`, `USP`) VALUES
(1, 230),
(2, 100),
(3, 560),
(4, 40),
(5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Pname` varchar(30) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `Quantity_in_stock` int(11) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `ReorderLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Pname`, `CategoryID`, `SupplierID`, `Quantity_in_stock`, `UnitPrice`, `ReorderLevel`) VALUES
(1, 'KnS Qeema Extra Lean', 1, 12, 150, 480, 50),
(2, 'Pringles Salted', 1, 12, 55, 100, 30),
(3, 'Blue for Women Deodorant', 2, 2, 20, 300, 20),
(4, 'Maybelline Sky High Mascara', 3, 6, 30, 680, 10),
(5, 'Fluffy Cat Food', 4, 8, 102, 500, 20);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `depleted_check_update` BEFORE UPDATE ON `product` FOR EACH ROW BEGIN
Declare finished integer default 0;
Declare cust varchar(30);
declare flag integer default 0;
Declare c1 cursor for select ProductID from depleted_product;
DECLARE CONTINUE HANDLER 
FOR NOT FOUND SET finished = 1;

if NEW.Quantity_in_stock < NEW.ReorderLevel THEN
insert into depleted_product(ProductID,Quantity) values(NEW.ProductID,NEW.Quantity_in_stock);


else
open c1;
get_cust: LOOP
Fetch c1 into cust;
if finished=1 then 
leave get_cust; 
end if;
if cust=NEW.ProductID then 
set finished=1;
set flag=1;
end if;
end loop get_cust;
close c1;
if flag=1 then
Delete from depleted_product where ProductID=NEW.ProductID;
END if;
end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `supplier_check` BEFORE INSERT ON `product` FOR EACH ROW BEGIN
Declare finished integer default 0;
Declare cust varchar(30);
declare flag integer default 0;
Declare c1 cursor for select supplierID from supplier_information;
DECLARE CONTINUE HANDLER 
FOR NOT FOUND SET finished = 1;

if NEW.Quantity_in_stock < NEW.ReorderLevel THEN
insert into depleted_product(ProductID,Quantity) values(NEW.ProductID, NEW.Quantity_in_stock);
end if;

open c1;
get_cust: LOOP
Fetch c1 into cust;
if finished=1 then 
leave get_cust; 
end if;
if cust=NEW.SupplierID then 
set flag=1;
end if;
end loop get_cust;
close c1;
if flag=0 then
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Supplier does not exist';
END if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_information`
--

CREATE TABLE `supplier_information` (
  `SupplierID` int(11) NOT NULL,
  `SName` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_information`
--

INSERT INTO `supplier_information` (`SupplierID`, `SName`, `Address`, `Phone`) VALUES
(2, 'Arham', 'Saddar', '03011567430'),
(6, 'Lohit', 'Gulshan', '03318746556'),
(8, 'Sarim', 'Malir', '03231264454'),
(12, 'Farzan', 'Layari', '03003325459');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `TransactionID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Discount` int(11) NOT NULL DEFAULT '0',
  `Total_Amount` int(11) NOT NULL,
  `Trans_Init_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`TransactionID`, `ProductID`, `Quantity`, `Discount`, `Total_Amount`, `Trans_Init_Date`) VALUES
(16, 4, 2, 0, 960, '2022-12-1'),
(16, 5, 5, 0, 2500, '2022-12-1'),
(23, 1, 5, 0, 2400, '2022-12-3'),
(23, 2, 10, 0, 1000, '2022-12-3'),
(27, 1, 15, 0, 7200, '2022-12-4'),
(27, 2, 30, 0, 3000, '2022-12-4'),
(27, 3, 12, 0, 3600, '2022-12-4'),
(28, 5, 10, 0, 5000, '2022-12-4');

--
-- Triggers `transaction_detail`
--
DELIMITER $$
CREATE TRIGGER `max_min_quantity` BEFORE INSERT ON `transaction_detail` FOR EACH ROW BEGIN
declare var1 int;
declare var2 int;
select ReorderLevel into var1 from Product where ProductID = NEW.ProductID;
select Quantity_in_stock into var2 from Product where ProductID = NEW.ProductID;
if new.Quantity<var1 THEN
   signal sqlstate '45000' set message_text = 'Less than min quantity';
end if;
if new.Quantity>var2 THEN
   signal sqlstate '45000' set message_text = 'More than max quantity';
end if;
update product set Quantity_in_stock = Quantity_in_stock - NEW.Quantity where ProductID = NEW.ProductID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `max_min_quantity_update` BEFORE UPDATE ON `transaction_detail` FOR EACH ROW BEGIN
declare var1 int;
declare var2 int;

select ReorderLevel into var1 from Product where ProductID = NEW.ProductID;
select Quantity_in_stock into var2 from Product where ProductID = NEW.ProductID;
if new.Quantity<var1 THEN
   signal sqlstate '45000' set message_text = 'Less than min quantity';
end if;
if new.Quantity>var2 THEN
   signal sqlstate '45000' set message_text = 'More than max quantity';
end if;
update product set Quantity_in_stock = Quantity_in_stock - NEW.Quantity where ProductID=NEW.ProductID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_information`
--

CREATE TABLE `transaction_information` (
  `TransactionID` int(11) NOT NULL,
  `CustomerID` varchar(30) NOT NULL,
  `Trans_Init_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_information`
--

INSERT INTO `transaction_information` (`TransactionID`, `CustomerID`, `Trans_Init_Date`) VALUES
(16, 'A1', '2022-12-4'),
(23, 'A2', '2022-12-3'),
(27, 'A2', '2022-12-3'),
(28, 'A3', '2022-12-1');

--
-- Triggers `transaction_information`
--
DELIMITER $$
CREATE TRIGGER `customer_check` BEFORE INSERT ON `transaction_information` FOR EACH ROW BEGIN
Declare finished integer default 0;
Declare cust varchar(30);
declare flag integer default 0;
Declare c1 cursor for select customerID from customer_information;
DECLARE CONTINUE HANDLER 
FOR NOT FOUND SET finished = 1;
open c1;
get_cust: LOOP
Fetch c1 into cust;
if finished=1 then 
leave get_cust; 
end if;
if cust=NEW.CustomerID then 
set flag=1;
end if;
end loop get_cust;
close c1;
if flag=0 then
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Customer does not exist';
END if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `customer_check_update` BEFORE UPDATE ON `transaction_information` FOR EACH ROW BEGIN
Declare finished integer default 0;
Declare cust varchar(30);
declare flag integer default 0;
Declare c1 cursor for select customerID from customer_information;
DECLARE CONTINUE HANDLER 
FOR NOT FOUND SET finished = 1;
open c1;
get_cust: LOOP
Fetch c1 into cust;
if finished=1 then 
leave get_cust; 
end if;
if cust=NEW.CustomerID then 
set flag=1;
end if;
end loop get_cust;
close c1;
if flag=0 then
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Customer does not exist';
END if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `decrease_quantity` BEFORE DELETE ON `transaction_information` FOR EACH ROW BEGIN

Declare finished integer default 0;
Declare cust integer;
Declare quant integer default 0;
Declare c1 cursor for select ProductID from transaction_detail where TransactionID=OLD.TransactionID;
DECLARE CONTINUE HANDLER 
FOR NOT FOUND SET finished = 1;

CREATE TEMPORARY TABLE IF NOT EXISTS my_temp_table
SELECT ProductID, Quantity from transaction_detail where TransactionID=OLD.TransactionID;
open c1;
get_cust: LOOP
Fetch c1 into cust;
if finished=1 then 
leave get_cust; 
end if;
Select Quantity into quant from my_temp_table where ProductID=cust; 
Update Product set quantity_in_stock=quantity_in_stock+quant where ProductID=cust;
end loop;
close c1;
Delete from transaction_detail where transactionID=OLD.TransactionID;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer_information`
--
ALTER TABLE `customer_information`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `depleted_product`
--
ALTER TABLE `depleted_product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `product_ibfk_2` (`CategoryID`),
  ADD KEY `product_ibfk_3` (`SupplierID`);

--
-- Indexes for table `supplier_information`
--
ALTER TABLE `supplier_information`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`TransactionID`,`ProductID`),
  ADD KEY `td_ibfk_2` (`ProductID`);

--
-- Indexes for table `transaction_information`
--
ALTER TABLE `transaction_information`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `ti_ibfk_1` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction_information`
--
ALTER TABLE `transaction_information`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`SupplierID`) REFERENCES `supplier_information` (`SupplierID`);

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `td_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `transaction_information`
--
ALTER TABLE `transaction_information`
  ADD CONSTRAINT `ti_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer_information` (`CustomerID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
