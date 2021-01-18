Drop database if exists `firma` ;
create schema  `firma`;

use `firma`;


CREATE TABLE  `customers` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 100 ) NOT NULL ,
`email` VARCHAR( 100 ) NOT NULL ,
`mobile` VARCHAR( 100 ) NOT NULL
) ENGINE = INNODB;


-- Index über Email Spalte
create index idx_customer_email on customers(email);

-- View erstellen
create view CustomerView(name, email, mobile)
as 
select upper(`name`), email, mobile from customers;

select * from CustomerView;
