use ski_service;

--------------------- Views -------------------------
-- Alle benutzter mit Mieatauftrag
drop view if exists Benutzer_Mietauftrag;
create view Benutzer_Mietauftrag as
	select  mietauftrag.MietauftragID as MAID, concat(benutzer.Nachname, " ", benutzer.Vorname) as `Name`, benutzer.Email, mietobjekttyp.Bezeichnung as `Miete`,
			mietstatus.Bezeichnung as `Status`, Reservationsdatum, Startdatum, adddate(Startdatum, interval Dauer day) as EndDatum,
            mietobjekt.PreisProTag * mietauftrag.Dauer * mietauftrag.Menge as Preis, mietstatus.AnzeigenInView as anzInView, mietstatus.AnzeigenInWarenkorb as anzInWk, bearbeitbar
    from mietauftrag 
    inner join benutzer on benutzer.BenutzerID = mietauftrag.BenutzerFK
    inner join mietobjekt on mietobjekt.MietobjektID = mietauftrag.MietobjektFK
    inner join mietobjekttyp on mietobjekttyp.ObjekttypID = mietobjekt.ObjekttypFK
    inner join mietstatus on mietstatus.StatusID = mietauftrag.StatusFK;



-- Alle benutzter mit Serviceauftrag
drop view if exists Benutzer_Serviceauftrag;
create view Benutzer_Serviceauftrag as
	select  serviceauftrag.ServiceauftragID as SAID, concat(benutzer.Nachname, " ", benutzer.Vorname) as `Name`, benutzer.Email, Serviceobjekt.Bezeichnung `Service`, 
			serviceobjekt.Grundpreis + prioritaet.Aufschlag as `Preis`, servicestatus.Bezeichnung as `Status`, prioritaet.Bezeichnung as `Prioritaet`,
			Startdatum, adddate(Startdatum, interval Dauer day) as EndDatum, servicestatus.AnzeigenInView as anzInView, servicestatus.AnzeigenInWarenkorb as anzInWk, bearbeitbar
    from serviceauftrag 
    inner join benutzer on benutzer.BenutzerID = serviceauftrag.BenutzerFK
    inner join serviceobjekt on serviceobjekt.ServiceobjektID = serviceauftrag.ServiceobjektFK
    inner join servicestatus on servicestatus.StatusID = serviceauftrag.StatusFK
    inner join prioritaet on prioritaet.PrioID = serviceauftrag.PrioFK;


-- Alle Mietaufträge ---
drop view if exists Mietauftraege;
create view Mietauftraege as
	select mietobjekttyp.Bezeichnung as 'Typ', mietauftrag.Startdatum, mietauftrag.Reservationsdatum, mietauftrag.Dauer,
		   mietstatus.Bezeichnung as 'Status'
	from mietauftrag
    inner join mietobjekt on mietobjekt.MietobjektID = mietauftrag.MietobjektFK
    inner join mietobjekttyp on mietobjekttyp.ObjekttypID = mietobjekt.ObjekttypFK
    inner join mietstatus on mietstatus.StatusID = mietauftrag.StatusFK;

    

-- Alle Services -- 
drop view if exists Services;
create view Services as 
	select serviceobjekt.Bezeichnung as `Service`, serviceobjekt.Grundpreis, servicestatus.Bezeichnung as `Status`,
		   prioritaet.Bezeichnung as `Prioritaet`, serviceauftrag.Startdatum, prioritaet.Dauer
	from serviceauftrag
    inner join serviceobjekt on serviceobjekt.ServiceobjektID = serviceauftrag.ServiceobjektFK
    inner join servicestatus on servicestatus.StatusID = serviceauftrag.StatusFK
    inner join prioritaet on prioritaet.PrioID = serviceauftrag.PrioFK;


-- Alle Mietobjekte --
drop view if exists Mietobjekte;
create view Mietobjekte as
	select MietobjektID, KoerpergroesseVon, KoerpergroesseBis, Altersgruppe, Geschlecht, PreisProTag, BildLink,
		   mietobjekttyp.Bezeichnung as Objekttyp, ObjekttypID
    from mietobjekt
    inner join mietobjekttyp on ObjekttypFK = ObjekttypID;
    
    

-- Benutzer und Berechtigung --
drop view if exists Benutzer_Berechtigung;
create view Benutzer_Berechtigung as
	select Passwort, Berechtigung, Email, concat(Vorname, " ", Nachname) as `Name` from Benutzer
    inner join rang on RangFK = rangID;

-- Benutzer und Rang
drop view if exists Benutzer_Rang;
create view Benutzer_Rang as
	select BenutzerID, concat(Vorname, " ", Nachname) as `Name`, Email, Telefon, rang.Bezeichnung as `Rang` from Benutzer
    inner join rang on RangFK = rangID;