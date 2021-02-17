use ski_service;

-- Give all Access to Admin --
drop user if exists `SkiAdmin`@`%`;
create user `SkiAdmin`@`%` identified by "SkiAdmin123$";
grant all on ski_service.* to `SkiAdmin`;



-- Access to User --
drop user if exists `SkiUser`@`%`;
create user `SkiUser`@`%` identified by "SkiUser123$";
-- Table privileges --
grant select on ski_service.servicestatus to `SkiUser`;
grant select on ski_service.Serviceobjekt to `SkiUser`;
grant select on ski_service.Prioritaet to `SkiUser`;
grant select on ski_service.Rang to `SkiUser`;
grant select on ski_service.mietobjekttyp to `SkiUser`;
grant select on ski_service.mietobjekt to `SkiUser`;
grant select on ski_service.mietstatus to `SkiUser`;
grant All on ski_service.serviceauftrag to `SkiUser`;
grant All on ski_service.benutzer to `SkiUser`;
grant All on ski_service.mietauftrag to `SkiUser`;
-- Procedure privileges --
grant execute on procedure ski_service.Createuser to `SkiUser`;
grant execute on procedure ski_service.PMietauftrag to `SkiUser`;
-- View privileges --
grant select on ski_service.benutzer_mietauftrag to `SkiUser`;
grant select on ski_service.benutzer_serviceauftrag to `SkiUser`;
grant select on ski_service.mietauftraege to `SkiUser`;
grant select on ski_service.services to `SkiUser`;
grant select on ski_service.mietobjekte to `SkiUser`;
grant select on ski_service.benutzer_berechtigung to `SkiUser`;


-- Access to Mitarbeiter -- 
drop user if exists `SkiMitarbeiter`@`%`;
create user `SkiMitarbeiter`@`%` identified by "SkiMitarbeiter123$";
-- Table privileges --
grant select on ski_service.servicestatus to `SkiMitarbeiter`;
grant select on ski_service.prioritaet to `SkiMitarbeiter`;
grant select on ski_service.rang to `SkiMitarbeiter`;
grant select on ski_service.mietobjekttyp to `SkiMitarbeiter`;
grant select on ski_service.mietstatus to `SkiMitarbeiter`;
grant all on ski_service.serviceauftrag to `SkiMitarbeiter`;
grant all on ski_service.serviceobjekt to `SkiMitarbeiter`;
grant all on ski_service.benutzer to `SkiMitarbeiter`;
grant all on ski_service.mietobjekt to `SkiMitarbeiter`;
grant all on ski_service.mietauftrag to `SkiMitarbeiter`;
-- Procedure privileges --
grant all on procedure ski_service.Createuser to `SkiMitarbeiter`;
grant all on procedure ski_service.PMietauftrag to `SkiMitarbeiter`;
-- View privileges --
grant all on ski_service.benutzer_mietauftrag to `SkiMitarbeiter`;
grant all on ski_service.benutzer_serviceauftrag to `SkiMitarbeiter`;
grant all on ski_service.mietauftraege to `SkiMitarbeiter`;
grant all on ski_service.services to `SkiMitarbeiter`;
grant all on ski_service.mietobjekte to `SkiMitarbeiter`;
grant all on ski_service.benutzer_berechtigung to `SkiMitarbeiter`;