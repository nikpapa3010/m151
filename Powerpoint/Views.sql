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

	select * from OffeneAuftraege;
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