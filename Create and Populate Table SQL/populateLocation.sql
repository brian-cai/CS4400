--only constraints are that city-state combination should be unique
--CREATE TABLE  `cs4400_37`.`LOCATION` (
--`city` VARCHAR( 100 ) NOT NULL ,
--`state` CHAR( 2 ) NOT NULL ,
--CONSTRAINT PK_LOCATION PRIMARY KEY (`city`,`state`)
--)engine = innodb;

INSERT INTO LOCATION ("city", "state")
VALUES ("Atlanta", "GA");

INSERT INTO LOCATION
VALUES ("Decatur", "GA"), ("Tampa", "FL")

INSERT INTO LOCATION
VALUES ("Birmingham", "AL"), ("Savannah", "GA"), ("Charleston", "SC"), ("Alpharetta", "GA");
