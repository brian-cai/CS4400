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

INSERT INTO LOCATION
VALUES ("New York", "NY"), ("Los Angeles", "CA"), ("Chicago", "IL"), ("Houston", "TX");

INSERT INTO LOCATION
VALUES ("Philadelphia", "PA"), ("Phoenix", "AZ"), ("San Antonio", "TX"), ("San Diego", "CA");

INSERT INTO LOCATION
VALUES ("Dallas", "TX"), ("San Jose", "CA"), ("Austin", "TX"), ("Jacksonville", "FL");

INSERT INTO LOCATION
VALUES ("San Francisco", "CA"), ("Indianapolis", "IN"), ("Columbus", "OH"), ("Fort Worth", "TX");

INSERT INTO LOCATION
VALUES ("Charlotte", "NC"), ("Seattle", "WA"), ("Denver", "OH"), ("El Paso", "TX");
