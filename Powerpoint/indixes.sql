drop schema if exists indixes;
create schema indixes;
use indixes;


create table autos
(
 autos_ID int null auto_increment,
 hersteller  varchar(50) not null ,
 modell varchar(50) not null,
 hochgeschwindigkeit int not null,
	
 primary key (autos_ID)
 -- index (hersteller)
);



insert into autos(hersteller, modell, hochgeschwindigkeit)
 values('Opel', 'Astra', 200),
       ("Mercedes", "C-Klasse", 220),
       ("Audi", "A4", 250),
       ("BMW", "1er", 300),
       ("VW","Tiquan", 190),
       ("BMW", "3er",250),
       ("Audi", "A3", 200),
       ("VW", "Polo", 300),
       ("VW", "Golf", 250);
       
       
       
       CREATE INDEX idx_hersteller ON autos(hersteller);
       
        explain select * from autos where hersteller = 'VW';
        select * from autos where autos_id = 1; 
       
       
       show indexes from autos;
       
       