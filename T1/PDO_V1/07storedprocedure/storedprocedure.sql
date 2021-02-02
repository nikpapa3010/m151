DELIMITER $$
CREATE PROCEDURE GetCustomers()
BEGIN
 SELECT customerName, creditlimit
 FROM customers;
END$$
