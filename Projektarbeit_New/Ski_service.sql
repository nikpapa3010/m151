drop schema if exists `Ski_service`;
create schema `Ski_service`;
use `Ski_service`;


create table rang
(
	RangID int unique not null,
    Berehtigung int null,
    Bezeichnung varchar(20) not null,
    Primary key (RangID)
);

create table benutzer
(
	BenuzterID int unique not null,
    Passwort varchar(256) not null,
    Telefon varchar(20) null,
    Email varchar(50) unique not null,
    Vorname varchar(30) not null,
    Nachname varchar(30) not null,
    RangFK int unique,
    Primary key (BenuzterID),
    Foreign key (RangFK) references Rang(RangID)
);


-- Service Tables --
create table Prioritaet 
(
	PrioID int unique not null,
    Bezeichnung varchar(20) not null,
    Aufschlag decimal(5,2) not null,
    Dauer int not null,
	Primary key (PrioID)  

);

create table Servicestatus
(
	StatusID int unique not null,
    Bezeichnung varchar(20) not null,
    AnzeigenInView bool not null,
    AnzeigenInWarenkorb bool not null,
    bearbeitbar bool not null,
    Primary key (StatusID)
);

create table Serviceobjekt
(
	ServiceobjektID int unique not null,
    Bezeichnung varchar(20) not null,
    Grundpreis decimal(6,2) not null,
    Primary key (ServiceobjektID)
);

create table Serviceauftrag
(
	ServiceauftragID int unique not null,
    Startdatum	date not null,
    StatusFK int unique not null, 
    ServiceobjektFK int unique not null,
    PrioFK int unique not null,
    BenutzerFK int unique not null,
    Primary key (ServiceauftragID),
	Foreign key (ServiceobjektFK) references Serviceobjekt(ServiceobjektID),
    Foreign key (PrioFK) references Prioritaet(PrioID),
    Foreign key (StatusFK) references Servicestatus(StatusID),
    Foreign key (BenutzerFK) references benutzer(BenuzterID)

);


-- Mietauftrag --

create table Mietstatus
(
	StatusID int unique not null,
    Bezeichnung varchar(20) not null,
    AnzeigenInView bool not null,
    AnzeigenInWarenkorb bool not null,
    bearbeitbar bool not null,
    Primary key (StatusID)
);

create table Mietobjekttyp
(
	ObjekttypID int unique not null,
    Bezeichnung varchar(20) not null
);

create table Mietobjekt
(
	MietobjektID int unique not null,
    Koerpergroesse int not null,
    Altersgrupp enum('Kind','Jugendlich','Erwachsen'),
    Geschlecht enum('m','w','d'),
    PreisProTag decimal(5,2),
    ObjekttypFK int unique,
    Primary key(MietobjektID),
    Foreign key(ObjekttypFK) references Mietobjekttyp(ObjekttypID)
);




-- Procedures for Create User, insert Serviceauftrag, insert Mietauftrag --







create table Mietauftrag
(
	MietauftragID int unique not null,
    Reservationsdatum date not null,
    Startdatum date not null,
    Dauer int not null,
    BenutzerFK int unique,
    MietobjektFK int unique,
    StatusFK int unique,
    Primary key (MietauftragID),
    Foreign key(BenutzerFK) references Benutzer(BenuzterID),
    Foreign key(MietobjektFK) references Mietobjekt(MietobjektID),
    Foreign key(StatusFK) references Mietstatus(StatusID)
    
);



--------------------- Views -------------------------
-- Alle benutzter mit Mieatauftrag

create view Benutzter_Mietauftrag as
	select  benutzer.Nachname, benutzer.Vorname, benutzer.Passwort, benutzer.Telefon, benutzer.Email, mietobjekttyp.Bezeichnung as 'Miete', 
			mietstatus.Bezeichnung as 'Status', Reservationsdatum, Startdatum, Dauer
    from mietauftrag 
    inner join benutzer on benutzer.BenuzterID = mietauftrag.BenutzerFK
    inner join mietobjekttyp on mietobjekttyp.ObjekttypID = mietauftrag.MietobjektFK
    inner join mietstatus on mietstatus.StatusID = mietauftrag.StatusFK;
select * from Benutzter_Mietauftrag;



-- Alle benutzter mit Serviceauftrag
create view Benutzter_Serviceauftrag as
	select  benutzer.Nachname, benutzer.Vorname, benutzer.Passwort, benutzer.Telefon, benutzer.Email, Serviceobjekt.Bezeichnung 'Service', 
    serviceobjekt.Grundpreis, servicestatus.Bezeichnung as 'status', Startdatum, prioritaet.Bezeichnung as 'Prioritaet', Dauer
    from serviceauftrag 
    inner join benutzer on benutzer.BenuzterID = serviceauftrag.BenutzerFK
    inner join serviceobjekt on serviceobjekt.ServiceobjektID = serviceauftrag.ServiceobjektFK
    inner join servicestatus on servicestatus.StatusID = serviceauftrag.StatusFK
    inner join prioritaet on prioritaet.PrioID = serviceauftrag.PrioFK;
select * from Benutzter_Serviceauftrag;
    

-- Alle Mietaufträge ---

create view Mieatauftraege as
	select mietobjekttyp.Bezeichnung as 'Typ', mietauftrag.Startdatum, mietauftrag.Reservationsdatum, mietauftrag.Dauer,
		   mietstatus.Bezeichnung as 'Status'
	from mietauftrag
    inner join mietobjekttyp on mietobjekttyp.ObjekttypID =	mietauftrag.MietobjektFK
    inner join mietstatus on mietstatus.StatusID = mietauftrag.StatusFK;
    
select * from Mieatauftraege;
    

-- Alle Services -- 
create view Services as 
	select serviceobjekt.Bezeichnung as 'Service', serviceobjekt.Grundpreis, servicestatus.Bezeichnung as 'Status',
		   prioritaet.Bezeichnung as 'Priorität', serviceauftrag.Startdatum, prioritaet.Dauer
	from serviceauftrag
    inner join serviceobjekt on serviceobjekt.ServiceobjektID = serviceauftrag.ServiceobjektFK
    inner join servicestatus on servicestatus.StatusID = serviceauftrag.StatusFK
    inner join prioritaet on prioritaet.PrioID = serviceauftrag.PrioFK;
    
select * from Services;