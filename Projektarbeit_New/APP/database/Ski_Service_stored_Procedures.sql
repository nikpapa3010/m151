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
	values (vn, nn, ps, tl, em, 1);
	
END $$
Delimiter ;

-- insert Mietauftrag
DELIMITER $$
create Procedure PMietauftrag
(
	in rd date,
    in sd date,
    in dr int(11),
    in mg int(11),
    in bem varchar(50) ,
    in mo int(11),
    in st int(11)
) 
Begin
				
	insert into Mietauftrag (Reservationsdatum, Startdatum, Dauer, Menge, BenutzerFK, MietobjektFK, StatusFK) 
	values (rd, sd, dr, mg, (select BenutzerID from benutzer where Email =  bem), (select mietobjekt.MietobjektID from mietobjekt where MietobjektID = mo),  (select mietstatus.StatusID from mietstatus where StatusID = st));
				
END $$
Delimiter ;

call PMietauftrag('2021-02-20', '2021-02-17', 7, 1, "nikolaos.papadopoulos@student.ibz.ch", 1, 1);
	select * from Mietauftrag;
