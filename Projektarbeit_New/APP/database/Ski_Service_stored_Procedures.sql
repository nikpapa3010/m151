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


-- insert Mietauftrag

DELIMITER $$
create Procedure PMietauftrag
(
	in rd date,
    in sd date,
    in dr int(11),
    in mg int(11),
    in uid int(11) ,
    in mo int(11),
    in st int(11)
) 
Begin
				
					insert into Mietauftrag (Reservationsdatum, Startdatum, Dauer, Menge, BenutzerFK, MietobjektFK, StatusFK) 
                        values (rd, sd, dr, mg, uid, mo, st);
				
END $$
Delimiter ;
call PMietauftrag('2021-02-20', '2021-02-17', 7, 1, (select benutzer.BenutzerID from benutzer where BenutzerID = 1), (select mietobjekt.MietobjektID from mietobjekt where MietobjektID = 1), (select mietstatus.StatusID from mietstatus where StatusID = 1));
select * from Mietauftrag;
