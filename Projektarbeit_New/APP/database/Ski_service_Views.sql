use ski_service;



--------------------- Views -------------------------
-- Alle benutzter mit Mieatauftrag

create view Benutzer_Mietauftrag as
	select  benutzer.Nachname, benutzer.Vorname, benutzer.Passwort, benutzer.Telefon, benutzer.Email, mietobjekttyp.Bezeichnung as 'Miete', 
			mietstatus.Bezeichnung as 'Status', Reservationsdatum, Startdatum,adddate(Startdatum, interval Dauer day) as EndDatum
    from mietauftrag 
    inner join benutzer on benutzer.BenutzerID = mietauftrag.BenutzerFK
    inner join mietobjekttyp on mietobjekttyp.ObjekttypID = mietauftrag.MietobjektFK
    inner join mietstatus on mietstatus.StatusID = mietauftrag.StatusFK;



-- Alle benutzter mit Serviceauftrag
create view Benutzer_Serviceauftrag as
	select  benutzer.Nachname, benutzer.Vorname, benutzer.Passwort, benutzer.Telefon, benutzer.Email, Serviceobjekt.Bezeichnung 'Service', 
    serviceobjekt.Grundpreis, servicestatus.Bezeichnung as 'status', prioritaet.Bezeichnung as 'Prioritaet', Startdatum, adddate(Startdatum, interval Dauer day) as EndDatum
    from serviceauftrag 
    inner join benutzer on benutzer.BenutzerID = serviceauftrag.BenutzerFK
    inner join serviceobjekt on serviceobjekt.ServiceobjektID = serviceauftrag.ServiceobjektFK
    inner join servicestatus on servicestatus.StatusID = serviceauftrag.StatusFK
    inner join prioritaet on prioritaet.PrioID = serviceauftrag.PrioFK;


-- Alle Mietaufträge ---

create view Mieatauftraege as
	select mietobjekttyp.Bezeichnung as 'Typ', mietauftrag.Startdatum, mietauftrag.Reservationsdatum, mietauftrag.Dauer,
		   mietstatus.Bezeichnung as 'Status'
	from mietauftrag
    inner join mietobjekttyp on mietobjekttyp.ObjekttypID =	mietauftrag.MietobjektFK
    inner join mietstatus on mietstatus.StatusID = mietauftrag.StatusFK;

    

-- Alle Services -- 
create view Services as 
	select serviceobjekt.Bezeichnung as 'Service', serviceobjekt.Grundpreis, servicestatus.Bezeichnung as 'Status',
		   prioritaet.Bezeichnung as 'Priorität', serviceauftrag.Startdatum, prioritaet.Dauer
	from serviceauftrag
    inner join serviceobjekt on serviceobjekt.ServiceobjektID = serviceauftrag.ServiceobjektFK
    inner join servicestatus on servicestatus.StatusID = serviceauftrag.StatusFK
    inner join prioritaet on prioritaet.PrioID = serviceauftrag.PrioFK;
