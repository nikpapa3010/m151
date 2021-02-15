use ski_service;

-- Procedures for Create User, insert Serviceauftrag, insert Mietauftrag --

-- Create User
DELIMITER $$
CREATE PROCEDURE Createuser
(
	 in uVorname varchar(30),
     in uNachname varchar(30),
     in uPasswort varchar(256),
     in uTelefon varchar(20),
     in uEmail varchar(50),
     in rBerechtigung int(11),
     in rBezeichnung varchar(20)
)
BEGIN
    insert into rang(Berechtigung, Bezeichnung)
				values(rBerechtigung, rBezeichnung);
                
	insert into benutzer(Vorname, Nachname, Passwort, Telefon, Email, RangFK) 
				 values(uVorname, uNachname, uPasswort, uTelefon, uEmail,(select RangID from rang where rangID ));
	
END $$
Delimiter ;

call Createuser('Hans','Müller','oops','','Hans@gmail.com', 1, 'User');


select * from benutzer;
select * from rang;