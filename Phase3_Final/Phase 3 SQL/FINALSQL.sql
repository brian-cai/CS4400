-- Login SQL
--
--
--
select email,username,user_type from USER where( USER.username = '$username'  and USER.password = '$password');
-- if empty set:
--      error "Invalid username or password"
-- else:
--      successful login use user_type to direct user to correct menu page
--
--
---Citi_Official constraint---
select username,approved from CITY_OFFICIAL where (username = '$username' and approved = 1);
-- if empty set:
--      error "city_official has not been approved"
-- else:
--      successful login use user_type to direct user to correct menu page
--
-- REGISTER.SQL

-- Registers a user into the USER relation (used for city_official and city_scientist)
insert into USER values('$rEmail', '$usernameR', '$password1', '$UserType');

-- if type_input == "City Official":
-- populate city and state dropdowns
    SELECT DISTINCT state FROM LOCATION ORDER BY state;
    SELECT DISTINCT city FROM LOCATION ORDER BY city;
-- assumption: city and state are already in the database
--
-- Registers city_officials into CITY_OFFICIAL relation
insert into CITY_OFFICIAL values('$usernameR', '$rTitle', NULL, '$rCity', '$rState');
--
--
--
-- POI Report
--
--
-- This command is used to get the data from the view for POI Report
SELECT * FROM POI_report_view;
--
-- This is the view used in the above querry
CREATE VIEW POI_report_view AS
SELECT a.location_name, a.city, a.state, a.airmin, a.airavg, a.airmax, m.moldmin, m.moldavg, m.moldmax, c.number_points, c.flagged
FROM air_report_test AS a
LEFT JOIN mold_report_test AS m
  on a.location_name = m.location_name
LEFT JOIN count_flagged as c
  on a.location_name = c.location_name
UNION
SELECT m.location_name, m.city, m.state, a.airmin, a.airavg, a.airmax, m.moldmin, m.moldavg, m.moldmax, c.number_points, c.flagged
FROM mold_report_test AS m
LEFT JOIN air_report_test AS a
  on m.location_name = a.location_name
LEFT JOIN count_flagged as c
  on m.location_name = c.location_name
UNION
SELECT c.location_name, c.city, c.state, a.airmin, a.airavg, a.airmax, m.moldmin, m.moldavg, m.moldmax, c.number_points, c.flagged
FROM count_flagged as c
LEFT JOIN air_report_test AS a
  on c.location_name = a.location_name
LEFT JOIN mold_report_test AS m
  on c.location_name = m.location_name

-- These 3 views are used to buildthe one above
--view for mold
CREATE VIEW mold_report_test AS
SELECT d.location_name, p.city, p.state, MIN(d.data_value) AS moldmin, AVG(d.data_value) AS moldavg, MAX(d.data_value) AS moldmax, p.flagged
FROM DATA_POINT AS d
INNER JOIN POI AS p
WHERE d.location_name = p.location_name AND d.type = "mold" AND d.approved = TRUE
GROUP BY d.type, d.location_name
ORDER BY d.location_name;

--testwhat I can do
CREATE VIEW air_report_test AS
SELECT d.location_name, p.city, p.state, MIN(d.data_value) AS airmin, AVG(d.data_value) AS airavg, MAX(d.data_value) AS airmax, p.flagged
FROM DATA_POINT AS d
INNER JOIN POI AS p
WHERE d.location_name = p.location_name AND d.type = "air quality" and d.approved = TRUE
GROUP BY d.type, d.location_name
ORDER BY d.location_name;

--count and flagged view
CREATE VIEW count_flagged AS
SELECT p.location_name, p.city, p.state, count(d.date_time) AS number_points, p.flagged AS flagged
FROM POI as p
LEFT JOIN DATA_POINT as d
   on p.location_name = d.location_name
GROUP BY p.location_name;
--
--
--
 -- POI Detail
 --
-- INCLUDES:
-- Filter/search Data Point's and Flag

-- Type Dropdown
-- data types
SELECT type from DATA_TYPE ORDER BY type

-- Filter/search Data Point's
-- THis query is constructed with a string builder in the application. The case below works if
 -- a non-null value is inputed for each user input but the string builder handles other cases as well.
select type, data_value, date_time from DATA_POINT where
    ('$locationbutton' IS NULL OR location_name = '$locationbutton') and
    ('$poitype' IS NULL OR type = '$poitype') and
    (data_value >= '$lowdata' AND data_value <= '$highdata') and
    (date_time >= '$lowtime' AND date_time <= '$hightime');
--
--
-- Flag button sql command
--
-- checks to see if a particular POI is Flagged
select flagged from POI where location_name = '$locationbutton';
--
--
-- sets a not flagged location to flagged
update POI SET flagged = 1, date_flagged = CURDATE() where (location_name = '$locationbutton' and flagged = 0);
--
--
-- sets a flagged location to not flagged
update POI SET flagged = 0, date_flagged = NULL where (location_name = '$locationbutton' and flagged = 1);
--
--
--
-- City Official View POI's
-- FILTER SEARCH POI
--
-- populate drop downs with this data
-- ********* All of these must have an option for null when there is no value selected

-- location names in alphabetical order
SELECT location_name FROM POI ORDER BY location_name;
-- distinct cities in alphabetical order
SELECT DISTINCT city FROM LOCATION ORDER BY city;
-- distinct states in alphabetical order
SELECT DISTINCT state FROM LOCATION ORDER BY state;
--
--
--
-- Filter/search POI's
-- THis query is constructed with a string builder in the application. The case below works if
 -- a non-null value is inputed for each user input but the string builder handles other cases as well.
-- is flagged
select * from POI where
    ('$loc' IS NULL OR location_name = '$loc') and
    ('$city' IS NULL OR city = '$city') and
    ('$state' IS NULL OR state = '$state') and
    ('$zcode' IS NULL OR zip = '$zcode') and
    (flagged = TRUE) and
    (date_flagged >= '$lowend' AND date_flagged <= '$highend');
-- is not flagged
select * from POI where
    ('$loc' IS NULL OR location_name = '$loc') and
    ('$city' IS NULL OR city = '$city') and
    ('$state' IS NULL OR state = '$state') and
    ('$zcode' IS NULL OR zip = '$zcode') and
    (flagged = FALSE);

--
--
--
-- DROPDOWN menu query's
--
--

-- distinct states in alphabetical order
SELECT DISTINCT state FROM LOCATION ORDER BY state

-- distinct cities in alphabetical order
SELECT DISTINCT city FROM LOCATION ORDER BY city

-- data types
SELECT type from DATA_TYPE ORDER BY type

-- location names in alphabetical order
SELECT location_name FROM POI ORDER BY location_name

--
--
-- ADD POI
--
--
--if a city official clicks "add a new location"
--city and state inputs are from the database and in drop-down format
INSERT INTO POI
VALUES (name_input, zip_input, 0, NULL, city_input, state_input);
--if location_name already exists: ERROR - "name_input already exists"


INSERT INTO POI
VALUES ("Bev-hills", 90210, 0, NULL, "Los Angeles", "CA");
--
--
-- ADD data point
--
--
-- populates POI location name dropdown
select location_name from POI;

-- populates the data_type dropdown
select type from DATA_TYPE;

insert into DATA_POINT values(name_input, datetime_input, type_inout, value_input, 0);




-- populate drop downs

    SELECT DISTINCT state FROM LOCATION ORDER BY state;
    SELECT DISTINCT city FROM LOCATION ORDER BY city;

--
--
-- accept/reject datapoints
--
--

--initializing the table
SELECT location_name, date_time, type, data_value
FROM DATA_POINT
WHERE approved IS NULL;

--If the user puts a check mark by a data point that data point's name should
--go into a tuple called "name_inputs" and same for the date_time_inputs

--Then dependent on whether they pick accept or reject you run the following query

--ACCEPT DATA POINT with name_input and date_time_input which are both tuples
--having trouble with this one it may not necessary be correct
UPDATE DATA_POINT
SET approved = 1
WHERE (location_name IN name_inputs AND date_time IN date_time_inputs);

--REJECT DATA POINT name_inputs and date_time_inputs
UPDATE DATA_POINT
SET approved = 0
WHERE (location_name IN name_inputs AND date_time IN date_time_inputs);



-- alternate querry only updates one at a time


--ACCEPT DATA POINT with name_input and date_time_input

UPDATE DATA_POINT
SET approved = 1
WHERE (location_name = name_input AND date_time = dt_input);

--REJECT DATA POINT name_input and date_time_input
UPDATE DATA_POINT
SET approved = 0
WHERE (location_name = name_input AND date_time = dt_input);

--
--
-- add/reject city officials
--
--
--the tricky thing is to find out how to deal with multiple city officials that they can "select" with a checkbox
--If the select box is clicked next to their name put their username in a tuple called username_inputs

SELECT U.username, U.email, C.city, C.state, C.approved
FROM USER AS U
INNER JOIN CITY_OFFICIAL AS C ON U.username = C.username
WHERE approved IS NULL;

--the above returns what I want


--ACCEPT city officials
--if their name is checked and accept button is clicked then run this query
UPDATE CITY_OFFICIAL
SET approved = 1
WHERE (username IN username_inputs);

--REJECT
UPDATE CITY_OFFICIAL
SET approved = 0
WHERE (username IN username_inputs);



-- alternate query only updates one at a time

--ACCEPT city official based on username_input selected
UPDATE CITY_OFFICIAL
SET approved = 1
WHERE (username = username_input);

--REJECT city official based on username_input selected
UPDATE CITY_OFFICIAL
SET approved = 0
WHERE (username = username_input);

