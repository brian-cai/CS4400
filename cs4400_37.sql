/*
CREATE TABLE  `cs4400_37`.`Location` (
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `city` ,  `state` )
) ENGINE = MYISAM
*/

-- Location table
CREATE TABLE  `cs4400_37`.`LOCATION` (
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
CONSTRAINT PK_Location PRIMARY KEY (`city`,`state`)
)

-- Data Type
CREATE TABLE  `cs4400_37`.`DATA_TYPE` (
`type` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (`type`)
)

-- USER table
CREATE TABLE  `cs4400_37`.`USER` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`password` VARCHAR( 100 ) NOT NULL ,
`usertype` ENUM(  `admin`,  `city scientist`,  `city official` ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)


-- City Official
CREATE TABLE  `cs4400_37`.`CITY OFFICIAL` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`title` VARCHAR( 100 ) NOT NULL ,
`approved` BOOL NOT NULL ,
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
)


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

-- City Official
CREATE TABLE  `cs4400_37`.`CITY_OFFICIAL` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)


-- Point of Interest
CREATE TABLE  `cs4400_37`.`POI` (
`locationName` VARCHAR( 100 ) NOT NULL ,
`zip` CHAR( 5 ) NOT NULL ,
`flagged` BOOL NOT NULL ,
`date_flagged` DATE,
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `locationName` ),
FOREIGN KEY (`city`, `state`)
    REFERENCES `LOCATION` (`city`, `state`)
    ON DELETE CASCADE
)

-- Data Point
CREATE TABLE  `cs4400_37`.`DATAPOINT` (
`locationName` VARCHAR( 100 ) NOT NULL ,
`dateTime` TIMESTAMP NOT NULL ,
`type` VARCHAR NOT NULL ,
`dataValue` INTEGER NOT NULL,
`approved` BOOL NOT NULL ,
PRIMARY KEY (  `locationName` ),
UNIQUE ( `dateTime` )
)
FOREIGN KEY ('locationName')
    REFERENCES `POI` (`locationName`)
    ON DELETE CASCADE
)
FOREIGN KEY (`type`)
    REFERENCES `DATA_TYPE` (`type`)
    ON DELETE CASCADE
)

--ENGINE = MYISAM
