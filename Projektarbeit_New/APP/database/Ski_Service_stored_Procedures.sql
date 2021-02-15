use ski_service;

-- Procedures for Create User, insert Serviceauftrag, insert Mietauftrag --

-- Create User
DELIMITER $$
CREATE PROCEDURE Createuser
(
	 in vn varchar(30),
     in nn varchar(30),
     in ps varchar(256),
     in tl varchar(20),
     in em varchar(50)
)
BEGIN
                
	insert into benutzer(Vorname, Nachname, Passwort, Telefon, Email, RangFK) 
				 values(vn, nn, ps, tl, em,(select RangID from rang where rangID = 1 ));
	
END $$
Delimiter ;

call Createuser('Peter','Müller','oops','','Peter@gmail.com');


select * from benutzer;
select * from rang;




