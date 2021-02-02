-- 
-- Trigger
-- 
use m151;


alter table personen 
	add column letzt_aenderung datetime null; 
    
drop trigger if exists `personen_before_update`; 



-- update triggers
delimiter $$
create trigger `personen_before_update`
 before update on `personen`
 for each row
 Begin
	set new.letzt_aenderung = now();
 END$$
delimiter ; 
 call Insert_UpsertCustomer(1000, 'Muester', 'Hans', 4000.0, '1990-05-01');
 select * from personen; 
 
 
 -- insert update information to new table --
 delimiter $$
CREATE TRIGGER `personen_after_update_V2` 
  AFTER UPDATE ON `personen` 
FOR EACH ROW 
BEGIN
	INSERT INTO `personen_audit` (	`personalnummer`,
									`username`,
									`change_date`)
		VALUES (	new.personalnummer,
					CURRENT_USER(),
					now());
END$$

delimiter ;


call Insert_UpsertCustomer(200, 'Lukas', 'Peter', 2000.0, '1955-01-01');
select * from personen;
select * from personen_audit;
 
 
 
 
 
 
 


