CREATE SCHEMA if not exists `m151` ;

use m151;

CREATE TABLE if not exists `personen` 
(
  `personalnummer` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `vorname` varchar(25) NOT NULL,
  `gehalt` double DEFAULT NULL,
  `geburtstag` date DEFAULT NULL,
  PRIMARY KEY (`personalnummer`)
  );
  