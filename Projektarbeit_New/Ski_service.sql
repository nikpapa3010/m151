drop schema if exists `Ski_service`;
create schema `Ski_service`;
use `Ski_service`;

create table benutzter
(
	BenutzterID int unique not null,
    Passwort varchar(256) not null,
    Telefon varchar(20) null,
    Email varchar(50) unique not null,
    Vorname varchar(30) not null,
    Nachname varchar(30) not null,
    Primary key (BenutzterID)
);

create table rang
(
	RangID int unique not null,
    Berehtigung int null,
    Bezeichnugn varchar(20) not null,
    Primary key (RangID)
);








































--------------------- Views -------------------------

-- Alle benutzter


-- Alle benutzter mit Mieatauftrag






-- Alle benutzter mit Serviceauftrag