CREATE TABLE  `cs4400_37`.`LOCATION` (`city` VARCHAR( 100 ) NOT NULL ,`state` CHAR( 2 ) NOT NULL , CONSTRAINT PK_LOCATION PRIMARY KEY (`city`,`state`));

CREATE TABLE  `cs4400_37`.`DATA_TYPE` (`type` VARCHAR( 100 ) NOT NULL ,PRIMARY KEY (`type`));

CREATE TABLE  `cs4400_37`.`USER` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`password` VARCHAR( 100 ) NOT NULL ,
`user_type` ENUM(  'admin',  'city_scientist',  'city_official' ) NOT NULL ,
PRIMARY KEY (  `username` ),
UNIQUE ( `email` )
);
