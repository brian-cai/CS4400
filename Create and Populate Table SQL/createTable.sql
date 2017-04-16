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
)engine = innodb;

-- Data Type
-- works independetly
CREATE TABLE  `cs4400_37`.`DATA_TYPE` (
`type` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (`type`)
)engine = innodb;

-- USER table
-- error regarding usertype ENUM
CREATE TABLE  `cs4400_37`.`USER` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`password` VARCHAR( 100 ) NOT NULL ,
`user_type` ENUM(  'admin',  'city_scientist',  'city_official' ) NOT NULL ,
PRIMARY KEY (  `username` ),
UNIQUE ( `email` )
)engine = innodb;


-- City Official
CREATE TABLE  `cs4400_37`.`CITY_OFFICIAL` (
`username` VARCHAR( 100 ) NOT NULL ,
`title` VARCHAR( 100 ) NOT NULL ,
`approved` BOOL DEFAULT 0,
`city` VARCHAR( 100 ) NOT NULL ,
`state` CHAR( 2 ) NOT NULL ,
PRIMARY KEY (  `username` ),
FOREIGN KEY (`username`)
    REFERENCES `USER` (`username`)
    ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`city`, `state`)
    REFERENCES `LOCATION` (`city`, `state`)
    ON DELETE CASCADE ON UPDATE CASCADE
) engine = innodb;

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
) engine = innodb;

-- Data Point
CREATE TABLE  `cs4400_37`.`DATA_POINT` (
`location_name` VARCHAR( 100 ) NOT NULL ,
`date_time` DATETIME NOT NULL ,
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
) engine = innodb ;
