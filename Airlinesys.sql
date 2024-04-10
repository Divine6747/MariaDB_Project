-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: AirlineSYS
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `BookingID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `PassengerID` tinyint(4) DEFAULT NULL,
  `FlightNumber` tinyint(4) DEFAULT NULL,
  `PaymentAmount` decimal(5,2) NOT NULL,
  `NoOfSeats` tinyint(2) DEFAULT NULL,
  `Status` enum('Confirm','Cancelled') DEFAULT NULL,
  PRIMARY KEY (`BookingID`),
  KEY `PassengerID` (`PassengerID`),
  KEY `FlightNumber` (`FlightNumber`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`PassengerID`) REFERENCES `passengers` (`PassengerID`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`FlightNumber`) REFERENCES `flights` (`FlightNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,1,500.00,2,'Confirm'),(2,2,2,350.00,1,'Confirm'),(3,3,3,200.00,1,'Cancelled'),(4,4,4,450.00,2,'Cancelled');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flights` (
  `FlightNumber` tinyint(4) NOT NULL AUTO_INCREMENT,
  `RouteID` tinyint(2) NOT NULL,
  `FlightDate` date DEFAULT NULL,
  `FlightTime` time DEFAULT NULL,
  `EstArrTime` time DEFAULT NULL,
  `NumSeats` tinyint(3) DEFAULT NULL,
  `Status` enum('Active','Cancelled') DEFAULT NULL,
  PRIMARY KEY (`FlightNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,1,'2024-02-10','08:00:00','10:30:00',127,'Active'),(2,2,'2024-02-11','12:00:00','14:30:00',120,'Active'),(3,3,'2024-02-12','09:30:00','11:00:00',100,'Active'),(4,4,'2024-02-13','14:00:00','16:30:00',127,'Active');
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passengers` (
  `PassengerID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Forename` varchar(60) NOT NULL,
  `Surname` varchar(60) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `Town` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PassengerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passengers`
--

LOCK TABLES `passengers` WRITE;
/*!40000 ALTER TABLE `passengers` DISABLE KEYS */;
INSERT INTO `passengers` VALUES (1,'John','Doe','1990-05-15','john.doe@example.com','1234567890','123 Main St','Anytown','USA'),(2,'Jane','Smith','1985-09-20','jane.smith@example.com','9876543210','456 Elm St','Othertown','USA'),(3,'Alice','Johnson','1995-03-10','alice.johnson@example.com','5551234567','789 Oak St','Smalltown','USA'),(4,'Bob','Brown','1980-11-25','bob.brown@example.com','3339876543','321 Pine St','Villagetown','USA');
/*!40000 ALTER TABLE `passengers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routes` (
  `RouteID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `DeptAirport` varchar(3) NOT NULL,
  `ArrAirport` varchar(3) NOT NULL,
  `TicketPrice` decimal(5,2) DEFAULT NULL,
  `Duration` tinyint(3) NOT NULL,
  `Status` enum('Active','Inactive') DEFAULT NULL,
  PRIMARY KEY (`RouteID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,'JFK','LAX',9.99,127,'Inactive'),(2,'LAX','SFO',9.99,90,'Active'),(3,'SFO','ORL',100.00,127,'Active'),(4,'ORD','JFK',9.99,127,'Inactive'),(5,'JFK','LAX',9.99,127,'Active'),(19,'FAM','MAN',9.99,75,'Active'),(20,'FAM','MAN',9.99,75,'Active'),(21,'FAM','MAN',9.99,75,'Active'),(22,'FAM','MAN',9.99,75,'Active'),(23,'FAM','MAN',9.99,75,'Active');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-10 23:54:43
