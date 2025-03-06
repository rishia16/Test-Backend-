/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - product_sales_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`product_sales_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `product_sales_db`;

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id_product`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=131330 DEFAULT CHARSET=utf8mb4;

/*Data for the table `product` */

insert  into `product`(`id_product`,`product_code`,`product_name`,`price`,`stock`) values 
(131318,'P002','Produk A',100000.00,5031),
(131319,'P003','Produk B',150000.00,30),
(131320,'P004','Produk C',300000.00,40),
(131321,'P005','Produk D',450000.00,79),
(131322,'P006','Produk E',600000.00,120),
(131326,'P001','Produk I',200000.00,112),
(131329,'P010','Produk J',500000.00,131412412);

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL AUTO_INCREMENT,
  `sales_reference` varchar(50) NOT NULL,
  `sales_date` datetime NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_sales`),
  UNIQUE KEY `sales_reference` (`sales_reference`),
  KEY `sales_ibfk_1` (`product_code`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sales` */

insert  into `sales`(`id_sales`,`sales_reference`,`sales_date`,`product_code`,`quantity`,`price`,`subtotal`) values 
(1,'S001','2025-03-06 14:26:18','P001',10,100000.00,1000000.00),
(2,'S002','2025-03-06 14:26:18','P002',8,150000.00,1200000.00),
(3,'S003','2025-03-06 14:26:18','P003',5,200000.00,1000000.00),
(4,'S004','2025-03-06 14:26:18','P001',15,100000.00,1500000.00),
(5,'S005','2025-03-06 14:26:18','P004',20,50000.00,1000000.00),
(6,'S006','2025-03-06 14:26:18','P005',7,120000.00,840000.00),
(7,'INV001','2025-03-06 14:39:28','P001',5,100000.00,500000.00),
(8,'INV002','2025-03-06 14:43:16','P001',3,100000.00,300000.00);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`PASSWORD`) values 
(6,'asta','$2y$10$zTaNHS/Behyxu6OJHu001O4kbAWLcqG1Oczu8QKxwhlorzEK/1k4i');

/* Procedure structure for procedure `get_top_product` */

/*!50003 DROP PROCEDURE IF EXISTS  `get_top_product` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `get_top_product`()
BEGIN
    SELECT 
        p.product_name,
        SUM(s.quantity) AS total_sales
    FROM sales s
    JOIN product p ON s.product_code = p.product_code
    GROUP BY p.product_name
    ORDER BY total_sales DESC
    LIMIT 5;
END */$$
DELIMITER ;

/* Procedure structure for procedure `process_sale` */

/*!50003 DROP PROCEDURE IF EXISTS  `process_sale` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `process_sale`(
    IN p_sales_reference VARCHAR(50),
    IN p_sales_date DATETIME,
    IN p_product_code VARCHAR(50),
    IN p_quantity INT,
    IN p_price DECIMAL(10,2)
)
BEGIN
    DECLARE v_stock INT;
    DECLARE v_subtotal DECIMAL(10,2);
    START TRANSACTION;
    SELECT stock INTO v_stock 
    FROM product 
    WHERE product_code = p_product_code;
    IF v_stock < p_quantity THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Stok tidak cukup';
    ELSE
        SET v_subtotal = p_quantity * p_price;
        INSERT INTO sales (
            sales_reference, 
            sales_date, 
            product_code, 
            quantity, 
            price, 
            subtotal
        ) VALUES (
            p_sales_reference, 
            p_sales_date, 
            p_product_code, 
            p_quantity, 
            p_price, 
            v_subtotal
        );
        UPDATE product 
        SET stock = stock - p_quantity 
        WHERE product_code = p_product_code;
        COMMIT;
    END IF;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
