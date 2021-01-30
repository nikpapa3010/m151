-- Database --
drop database if exists  Ski_service;
create schema Ski_service;
use  Ski_Service;


-- Tables --
create table Prioritaet
(
	PrioID int not null auto_increment,
    Prioritaet varchar(20) not null unique,
    totalTage int not null,
    Aufschlag decimal(5, 2) null, 
    primary key (PrioID)
);

create table Dienstleistung(
	DienstID int not null auto_increment, 
    Dienstleistung varchar(35) not null unique,
    Preis decimal(6,2) not null,
    primary key (DienstID)

);

create table `Status`
(
	StatusID int not null auto_increment,
    Status varchar(20) not null unique,
    AnzInDB bool not null,
    primary key (StatusID)

);

create table Rang
(
	RangID int not null auto_increment,
    Rang varchar(30)  not null unique,
    ShowAll bool not null,
    primary key (RangID)
);

create table Benutzer
(
	UserID int not null auto_increment,
    Benutzername varchar(20) not null unique,
    Nachname varchar(30) not null,
    Vorname varchar(30) not null,
    Passwort varchar(70) not null,
    Email varchar(60) not null unique,
    Telefonnummer varchar(20) null unique,
    Körpergrösse int not null, 
    Lebensalter int not null,
    Geschlecht varchar(20), 
    RangID int not null,
    primary key (UserID),
    foreign key (RangID) references Rang(RangID)
);

create table Auftrag(
	AuftragID int not null auto_increment,
    StartDatum Date not null,
    PrioID int not null,
    DienstID int not null,
    StatusID int not null,
    AuftraggeberID int not null,
    primary key (AuftragID),
    foreign key (PrioID) references Prioritaet(PrioID),
    foreign key (DienstID) references Dienstleistung(DienstID),
    foreign key (StatusID) references Status(StatusID),
    foreign key (AuftraggeberID) references Benutzer(UserID)  
);


-- Inserts --
insert into Prioritaet(Prioritaet, totalTage, Aufschlag)
	values("Tief", 12, -5),
		  ("Standard", 7, 0),
          ("Express", 5, 10);

insert into Dienstleistung(Dienstleistung, Preis)
	   values("Kleiner Service", 30),
		     ("Grosser Service", 60),
             ("Rennski-Service", 150),
             ("Bindung montieren und einstellen", 20),
             ("Fell zuschneiden", 30),
             ("Heisswachsen", 30);

insert into rang(Rang, ShowAll)
	values("Kunde", false),
		  ("Mitarbeiter", true),
          ("Admin", true);

insert into `status`(`status`, AnzInDB)
	values("Offen", true),
		  ("InArbeit", true),
		  ("Abgeschlossen", false),
		  ("Storniert", false);

insert into benutzer(Benutzername, Nachname, Vorname, Passwort, Email, Telefonnummer, RangID)
	values("Joseph_123", "Mauer", "Joseph", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "joseph_m@gmail.com", "0761812354", 1),
	("Nikol_buyer", "Haufmann", "Nikol", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "hauf_nikol@gmail.com", "0762847694", 2),
	("Bob_Ssor", "Schuhmacher", "Bob", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "bob_theschuhmacher@gmail.com", "0763478932", 3),
	("Jordan_Flying", "Schmidt", "Jordan", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "jordan_schmidt@gmail.com", "0765812563", 1),
	("Emil_idk", "Schneider", "Emil", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "emil123@gmail.com", "0769812384", 3),
	("Thomas_Meyer", "Meyer", "Thomas", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "thomas_meyer@gmail.com", "0764878643", 2),
	("Paul_Weber_BP", "Weber", "Paul", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "paul_basket@gmail.com", "0769452965", 1),
	("Giannis_Ioannis", "Psomopoulos", "Ioannis", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "ioannis_psomi@gmail.com", "0766137656", 3),
	("Lukas_LeWag", "Wagner", "Lukas", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "lukas_wagner@gmail.com", "0764765665", 2),
	("TheWolf", "Wolf", "Felix", "$2y$10$gnnxuPGNEkk19SdB1bHQ7OuIi3TDqK/rou23pkOZ.yvHOh45Xusje", "wolf_felix735@gmail.com", "0765745576", 1);

-- Beispielauftrag --
insert into Auftrag (StartDatum, PrioID, DienstID, StatusID, AuftraggeberID)
	values ("2020-10-01", 2, 3, 1, 3);

-- Views --
create view AlleBenutzer as
select UserID, Benutzername, concat(Nachname, " ", Vorname) as `Name`, Email, Telefonnummer, Rang
	from Benutzer
	inner join Rang on Benutzer.RangID = Rang.RangID
	order by UserID;

create view AlleAuftraege as
select AuftragID, Benutzername, Dienstleistung, Prioritaet as `Priorität`, Status, StartDatum,
	adddate(StartDatum, interval totalTage day) as EndDatum,
	dienstleistung.Preis + prioritaet.Aufschlag as `Preis`
	from Auftrag
	inner join Benutzer on AuftraggeberID = UserID
	inner join Dienstleistung on Auftrag.DienstID = dienstleistung.DienstID
	inner join prioritaet on auftrag.PrioID = prioritaet.PrioID
	inner join `status` on auftrag.StatusID = `status`.StatusID
    order by EndDatum asc;

create view OffeneAuftraege as
select AuftragID, Benutzername, Dienstleistung, Prioritaet as `Priorität`, Status, StartDatum,
	adddate(StartDatum, interval totalTage day) as EndDatum,
	dienstleistung.Preis + prioritaet.Aufschlag as `Preis`
	from Auftrag
	inner join Benutzer on AuftraggeberID = UserID
	inner join Dienstleistung on Auftrag.DienstID = dienstleistung.DienstID
	inner join prioritaet on auftrag.PrioID = prioritaet.PrioID
	inner join `status` on auftrag.StatusID = `status`.StatusID
	where AnzInDB = true
    order by EndDatum asc;

-- users --
drop user if exists `SkiAdmin`@`%`;
create user `SkiAdmin`@`%` identified by "SkiAdmin123$";
grant all on ski_service.* to `SkiAdmin`@`%`;

drop user if exists `SkiMitarbeiter`@`%`;
create user `SkiMitarbeiter`@`%` identified by "SkiMitarbeiter123$";
grant select, update, insert, delete on ski_service.* to `SkiMitarbeiter`@`%`;

drop user if exists `SkiKunde`@`%`;
create user `SkiKunde`@`%`;
grant select, update, insert on ski_service.* to `SkiKunde`@`%`;





