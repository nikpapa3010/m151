drop schema if exists `Ski_service`;
create schema `Ski_service`;
use `Ski_service`;


create table rang
(
	RangID int auto_increment not null,
    Berechtigung int null,
    Bezeichnung varchar(20) not null,
    Primary key (RangID)
);

create table benutzer
(
	BenutzerID int auto_increment not null,
    Passwort varchar(256) not null,
    Telefon varchar(20)  null,
    Email varchar(50) unique not null,
    Vorname varchar(30) not null,
    Nachname varchar(30) not null,
    RangFK int,
    Primary key (BenutzerID),
    Foreign key (RangFK) references Rang(RangID)
);


-- Service Tables --
create table Prioritaet 
(
	PrioID int auto_increment not null,
    Bezeichnung varchar(20) not null,
    Aufschlag decimal(5,2) not null,
    Dauer int not null,
	Primary key (PrioID)  

);

create table Servicestatus
(
	StatusID int auto_increment not null,
    Bezeichnung varchar(20) not null,
    AnzeigenInView bool not null,
    AnzeigenInWarenkorb bool not null,
    bearbeitbar bool not null,
    Primary key (StatusID)
);

create table Serviceobjekt
(
	ServiceobjektID int auto_increment not null,
    Bezeichnung varchar(20) not null,
    Grundpreis decimal(6,2) not null,
    Primary key (ServiceobjektID)
);

create table Serviceauftrag
(
	ServiceauftragID int auto_increment not null,
    Startdatum	date not null,
    StatusFK int not null, 
    ServiceobjektFK int not null,
    PrioFK int not null,
    BenutzerFK int not null,
    Primary key (ServiceauftragID),
	Foreign key (ServiceobjektFK) references Serviceobjekt(ServiceobjektID),
    Foreign key (PrioFK) references Prioritaet(PrioID),
    Foreign key (StatusFK) references Servicestatus(StatusID),
    Foreign key (BenutzerFK) references benutzer(BenutzerID)

);


-- Mietauftrag --

create table Mietstatus
(
	StatusID int auto_increment not null,
    Bezeichnung varchar(20) not null,
    AnzeigenInView bool not null,
    AnzeigenInWarenkorb bool not null,
    bearbeitbar bool not null,
    Primary key (StatusID)
);

create table Mietobjekttyp
(
	ObjekttypID int auto_increment not null,
    Bezeichnung varchar(30) not null,
    Primary key (ObjekttypID)
);

create table Mietobjekt
(
	MietobjektID int auto_increment not null,
    KoerpergroesseVon int not null,
    KoerpergroesseBis int not null,
    Altersgruppe enum('Kind','Jugendlich','Erwachsen'),
    Geschlecht enum('m','w','d','u'),
    PreisProTag decimal(5,2),
    BildLink varchar(256),
    ObjekttypFK int,
    Primary key(MietobjektID),
    Foreign key(ObjekttypFK) references Mietobjekttyp(ObjekttypID)
);



create table Mietauftrag
(
	MietauftragID int auto_increment not null,
    Reservationsdatum date not null,
    Startdatum date not null,
    Dauer int not null,
    Menge int,
    BenutzerFK int,
    MietobjektFK int,
    StatusFK int,
    Primary key (MietauftragID),
    Foreign key(BenutzerFK) references Benutzer(BenutzerID),
    Foreign key(MietobjektFK) references Mietobjekt(MietobjektID),
    Foreign key(StatusFK) references Mietstatus(StatusID)
    
);


insert into rang (RangID, Berechtigung, Bezeichnung)
values	(1, 0, "Benutzer"),
		(2, 1, "Mitarbeiter"),
        (3, 2, "Admin");

insert into Benutzer (Email, Passwort, Telefon, Vorname, Nachname, RangFK)
values	("runasophie.roth@gmail.com", "$2y$10$0Coew9LRRAIkrSbW4hIr2eLLxueoMgtp1Z8o8oby1F.0xk0l4rVue", "076 799 97 42", "Runa", "Roth", 3),
		("nikolaos.papadopoulos@student.ibz.ch", "$2y$10$0Coew9LRRAIkrSbW4hIr2eLLxueoMgtp1Z8o8oby1F.0xk0l4rVue", null, "Nikolaos", "Papadopoulos", 3);

insert into Mietstatus (StatusID, Bezeichnung, AnzeigenInView, AnzeigenInWarenkorb, bearbeitbar)
values	(1, "im Warenkorb", false, true, true),
		(2, "reserviert", true, false, true),
        (3, "angefangen", true, false, false),
        (4, "überfällig", true, false, false),
        (5, "zurückgegeben", false, false, false),
        (6, "abgeschlossen", false, false, false),
        (7, "storniert", false, false, false);

insert into Mietobjekttyp (ObjekttypID, Bezeichnung)
values	(1, "Allround-Ski"),
		(2, "Slalom-Ski"),
		(3, "All-Mountain-Carving-Ski"),
		(4, "Freeride-Ski"),
		(5, "Regular-Snowboard"),
		(6, "Goofy-Snowboard");

insert into Prioritaet (PrioID, Bezeichnung, Aufschlag, Dauer)
values	(1, "Standard", 0.0, 7),
        (2, "Tief", -5.0, 12),
        (3, "Express", 10.0, 5);

insert into Servicestatus (StatusID, Bezeichnung, AnzeigenInView, AnzeigenInWarenkorb, bearbeitbar)
values	(1, "im Warenkorb", false, true, true),
		(2, "reserviert", true, false, true),
        (3, "angefangen", true, false, false),
        (4, "abgeschlossen", false, false, false),
        (5, "storniert", false, false, false);

insert into Serviceobjekt (ServiceobjektID, Bezeichnung, Grundpreis)
values	(1, "Kleiner Service", 40.0),
		(2, "Grosser Service", 60.0),
        (3, "Rennski-Service", 150.0),
        (4, "Bindungen montieren und einstellen", 20.0),
        (5, "Fell zuschneiden", 20.0),
        (6, "Heisswachsen", 20.0);