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

-- USER table
CREATE TABLE  `cs4400_37`.`USER` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
`password` VARCHAR( 100 ) NOT NULL ,
`usertype` ENUM(  `admin`,  `city scientist`,  `city official` ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
) ENGINE = MYISAM





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


-- admin 
CREATE TABLE  `cs4400_37`.`ADMIN` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)

-- city scientist
CREATE TABLE  `cs4400_37`.`CITY_SCIENTIST` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)

-- city scientist
CREATE TABLE  `cs4400_37`.`CITY_OFFICIAL` (
`email` VARCHAR( 100 ) NOT NULL ,
`username` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `email` ),
UNIQUE ( `username` )
)


-- point of interest
CREATE TABLE  `cs4400_37`.`POI` (
`locationName` VARCHAR( 100 ) NOT NULL ,
`zip` VARCHAR( 5 ) NOT NULL ,
`flagged` BOOL NOT NULL ,
`date_flagged` VARCHAR( 100 ),
`city` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 100 ) NOT NULL ,
`usertype` ENUM(  `admin`,  `city scientist`,  `city official` ) NOT NULL ,
)

-- data point
CREATE TABLE  `cs4400_37`.`DATAPOINT` (
`locationName` VARCHAR( 100 ) NOT NULL ,
`dateTime` VARCHAR( 5 ) NOT NULL ,
`dataType` VARCHAR NOT NULL ,
`dataValue` VARCHAR( 100 ),
`approved` BOOL NOT NULL ,
)

ENGINE = MYISAM
