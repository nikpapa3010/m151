drop SCHEMA if  exists `m151` ;
create schema `m151`;

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
  
CREATE TABLE if not exists `personen_audit` (
  `audit_id` int NOT NULL auto_increment,
  `personalnummer` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `change_date` datetime DEFAULT NULL,
  PRIMARY KEY (`audit_id`)
);

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  -- ------------------------- PROCEDURES ------------------------------------------
  
-- Insert or Update Customer --
drop procedure if exists `Insert_UpsertCustomer`;
DELIMITER $$ 
CREATE  PROCEDURE  `Insert_UpsertCustomer`
(
	IN pNr int,
    IN pName varchar(30),
    IN pVorname varchar(25),
    in pGehalt double,
    in pGeburtstag date
)
BEGIN
if  (exists(select personalnummer from personen where personalnummer = pNr)) then



	update  `m151`.`personen`
	set 		`name` = pName,
				`vorname` = pVorname,
				`gehalt` = pGehalt,
				`geburtstag` = pGeburtstag
			where `personalnummer` = pNr;

else

		insert into`m151`.`personen`
				(`personalnummer`,
				`name`,
				`vorname`,
				`gehalt`,
				`geburtstag`)
	VALUES	(pNr, pName, pVorname, pGehalt, pGeburtstag);
end if;
end $$

call Insert_UpsertCustomer(1000, 'Muster', 'Max', 5500.0, '1990-05-01');
-- call InsertCustomer(1000, 'Muster', 'Hans', 4000.0, '1990-05-01');
call Insert_UpsertCustomer(200, 'Hans', 'Max', 500.0, '19500-09-05');
select * from personen;


-- Delete Person --
drop procedure if exists `DeletePerson`;

Delimitter $$
create procedure `DeletePerson`( in pNr int)
begin

if (select Personalnummer from personen where personalnummer = pNr)
	then delete from `m151`.`personen`
			where `personalnummer` = pNr;

	end if;
end $$

call DeletePerson(1000);
select * from personen;


-- Select Person By Id--
drop procedure if exists `SelectPersonByID`;

Delimitter $$
create procedure `SelectPersonByID`(in pNr int)
begin 

 if (select Personalnummer from personen where personalnummer = pNr)
	 then select * from `m151`.`personen`
		 where `personalnummer` = pNr;

 end if;
end $$

call SelectPersonByID(200);


