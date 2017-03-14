
DROP TABLE IF EXISTS POI;
DROP TABLE IF EXISTS DATAPOINT;
DROP TABLE IF EXISTS LOCATION;
DROP TABLE IF EXISTS DATA_TYPE;
DROP TABLE IF EXISTS USER;
DROP TABLE IF EXISTS CITY_OFFICIAL;

-- Location table
-- works independently
CREATE TABLE  `cs4400_37`.`LOCATION` (
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
CONSTRAINT PK_Location PRIMARY KEY (`city`,`state`)
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
`usertype` ENUM(  'admin',  'city scientist',  'city official' ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
);


-- City Official
CREATE TABLE  `cs4400_37`.`CITY_OFFICIAL` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`title` VARCHAR( 100 ) NOT NULL ,
`approved` BOOL NOT NULL default 0,
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ) ,
UNIQUE (
`username`
),
FOREIGN KEY (`email`, `username`)
    REFERENCES `USER` (`email`, `username`)
    ON DELETE CASCADE,
FOREIGN KEY (`city`, `state`)
    REFERENCES `LOCATION` (`city`, `state`)
    ON DELETE CASCADE
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
`locationName` VARCHAR( 100 ) NOT NULL ,
`zip` CHAR( 5 ) NOT NULL ,
`flagged` BOOL NOT NULL default 0,
`date_flagged` DATE,
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `locationName` ),
FOREIGN KEY (`city`, `state`)
    REFERENCES `LOCATION` (`city`, `state`)
    ON DELETE CASCADE
);

-- Data Point
CREATE TABLE  `cs4400_37`.`DATAPOINT` (
`locationName` VARCHAR( 100 ) NOT NULL ,
`dateTime` TIMESTAMP NOT NULL ,
`type` VARCHAR(100) NOT NULL ,
`dataValue` INTEGER NOT NULL,
`approved` BOOL NOT NULL default 0,
PRIMARY KEY (  `locationName` ),
UNIQUE ( `dateTime` ),
FOREIGN KEY (`locationName`)
    REFERENCES `POI` (`locationName`)
    ON DELETE CASCADE,
FOREIGN KEY (`type`)
    REFERENCES `DATA_TYPE` (`type`)
    ON DELETE CASCADE
);


--ENGINE = MYISAM
