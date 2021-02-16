use ski_service;

-- Give all Access to Admin --
drop user if exists `SkiAdmin`@`%`;
create user `SkiAdmin`@`%` identified by "SkiAdmin123$";
grant all on ski_service.* to "SkiAdmin123$";



-- Access to User --
drop user if exists `SkiUser`@`%`;
create user `SkiUser`@`%` identified by "SkiUser123$";
grant select on ski_service.servicestatus to "SkiUser123$";
grant select on ski_service.Serviceobjekt to "SkiUser123$";
grant select on ski_service.Prioritaet to "SkiUser123$";
grant select on ski_service.Rang to "SkiUser123$";
grant select on ski_service.mietobjekttyp to "SkiUser123$";
grant select on ski_service.mietobjekt to "SkiUser123$";
grant select on ski_service.mietstatus to "SkiUser123$";
grant All on ski_service.serviceauftrag to "SkiUser123$";
grant All on ski_service.benutzer to "SkiUser123$";
grant All on ski_service.mietauftrag to "SkiUser123$";


-- Access to Mitarbeiter -- 
drop user if exists `SkiMitarbeiter`@`%`;
create user `SkiMitarbeiter`@`%` identified by "SkiMitarbeiter123$";
grant select on ski_service.servicestatus to "SkiMitareiter123$";
grant select on ski_service.prioritaet to "SkiMitareiter123$";
grant select on ski_service.rang to "SkiMitareiter123$";
grant select on ski_service.mietobjekttyp to "SkiMitareiter123$";
grant select on ski_service.mietstatus to "SkiMitareiter123$";
grant all on ski_service.serviceauftrag to "SkiMitareiter123$";
grant all on ski_service.serviceobjekt to "SkiMitareiter123$";
grant all on ski_service.benutzer to "SkiMitareiter123$";
grant all on ski_service.mietobjekt to "SkiMitareiter123$";
grant all on ski_service.mietauftrag to "SkiMitareiter123$";