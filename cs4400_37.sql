
DROP TABLE IF EXISTS POI;
DROP TABLE IF EXISTS DATA_POINT;
DROP TABLE IF EXISTS LOCATION;
DROP TABLE IF EXISTS DATA_TYPE;
DROP TABLE IF EXISTS USER;
DROP TABLE IF EXISTS CITY_OFFICIAL;

-- Location table
-- works independently
CREATE TABLE  `cs4400_37`.`LOCATION` (
`city` VARCHAR( 100 ) NOT NULL ,
`state` CHAR( 2 ) NOT NULL ,
CONSTRAINT PK_LOCATION PRIMARY KEY (`city`,`state`)
);

-- Data Type
-- works independetly
CREATE TABLE  `cs4400_37`.`DATA_TYPE` (
`type` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (`type`)
);

-- USER table
-- TODO: error regarding usertype ENUM
CREATE TABLE  `cs4400_37`.`USER` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`password` VARCHAR( 100 ) NOT NULL ,
`user_type` ENUM(  'admin',  'city_scientist',  'city_official' ) NOT NULL ,
PRIMARY KEY (  `username` ),
UNIQUE ( `email` )
);


-- City Official
CREATE TABLE  `cs4400_37`.`CITY_OFFICIAL` (
`username` VARCHAR( 100 ) NOT NULL ,
`title` VARCHAR( 100 ) NOT NULL ,
`approved` BOOL NOT NULL DEFAULT 0,
`city` VARCHAR( 100 ) NOT NULL ,
`state` CHAR( 2 ) NOT NULL ,
PRIMARY KEY (  `username` ),
FOREIGN KEY (`username`)
    REFERENCES `USER` (`username`)
    ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`city`, `state`)
    REFERENCES `LOCATION` (`city`, `state`)
    ON DELETE CASCADE ON UPDATE CASCADE
);

/*

-- Admin
CREATE TABLE  `cs4400_37`.`ADMIN` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)

-- City Scientist
CREATE TABLE  `cs4400_37`.`CITY_SCIENTIST` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)

*/

-- Point of Interest
-- works independently
CREATE TABLE  `cs4400_37`.`POI` (
`location_name` VARCHAR( 100 ) NOT NULL ,
`zip` CHAR( 5 ) NOT NULL ,
`flagged` BOOL NOT NULL DEFAULT 0,
`date_flagged` DATE DEFAULT NULL,
`city` VARCHAR( 100 ) NOT NULL ,
`state` CHAR( 2 ) NOT NULL ,
PRIMARY KEY (  `location_name` ),
FOREIGN KEY (`city`, `state`)
    REFERENCES `LOCATION` (`city`, `state`)
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- Data Point
CREATE TABLE  `cs4400_37`.`DATA_POINT` (
`location_name` VARCHAR( 100 ) NOT NULL ,
`date_time` TIMESTAMP NOT NULL ,
`type` VARCHAR(100) NOT NULL ,
`data_value` INTEGER NOT NULL,
`approved` BOOL NOT NULL DEFAULT 0,
CONSTRAINT PK_DATA_POINT PRIMARY KEY (  `location_name`, `date_time` ),
FOREIGN KEY (`location_name`)
    REFERENCES `POI` (`location_name`)
    ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`type`)
    REFERENCES `DATA_TYPE` (`type`)
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- test entries

INSERT INTO USER values("rohith@test", "brohith", "password", 'admin');
INSERT INTO USER values("victor@test", "brazaboy555", "lol", 'city_official');
INSERT INTO LOCATION values("Atlanta", "GA");
INSERT INTO LOCATION values("Savannah", "GA");
INSERT INTO LOCATION values("Decatur", "GA");
INSERT INTO CITY_OFFICIAL (username, title, city, state) values("brazaboy555", "king", "Atlanta", "GA");
INSERT INTO POI (location_name, zip, city, state) values("Georgia Tech", "30332", "Atlanta", "GA");
INSERT INTO DATA_TYPE values("fungus");
INSERT INTO DATA_POINT (location_name, type, data_value) values("Georgia Tech", "fungus", 500);
--ENGINE = MYISAM
