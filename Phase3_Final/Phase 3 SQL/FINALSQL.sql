-- REGISTER.SQL
insert into USER values(em_input, un_input, pw_input, type_input);
--
-- if confpw_input != pw_input: error "passwords don't match "


-- if type_input == "City Official":
-- populate city and state dropdowns
    select city from LOCATION;
    select state from LOCATION;

insert into CITY_OFFICIAL values(un_input, title_input, 0, city_input, state_input);
-- assumption: city and state are already in the database


--
--
-- POI Report
--
--
--this is tricky af has view, joins, and aggregate functions all mixed in

--BRIAN THIS IS ALL YOU need
SELECT *
FROM POI_report_view;
--***USE THE ABOVE STATEMENT BRIAN IGNORE THE REST
--not done just in here

--have no idea of the difference between ordering and filtering with SQL vs GUI fuck these TAs

--testing

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
--you only need this query as long as our views are stored in the database
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

 --man fuck this shit
 DROP VIEW IF EXISTS count_flagged_new;
 CREATE VIEW count_flagged_new AS
 SELECT p.location_name, p.city, p.state, count(d.date_time) AS number_points, p.flagged AS flagged
 FROM POI as p
 LEFT JOIN DATA_POINT as d
    on p.location_name = d.location_name
 GROUP BY p.location_name;

 --
 CREATE VIEW count_test AS
 SELECT p.location_name, p.city, p.state, count(d.date_time) AS number_points, p.flagged AS flagged
 FROM POI as p
 LEFT JOIN DATA_POINT as d
    on p.location_name = d.location_name
 GROUP BY p.location_name;


 --
 --
 -- POI Detail
 --
 --
 -- POI DETAIL
-- INCLUDES:
-- Filter/search and Flag

-- Filter/search

select type, data_value, date_time from DATA_POINT where
    (location_input = location_name) and
    (type_input IS NULL OR type = type_input) and
    (lowVal_input IS NULL OR highVal_input IS NULL OR (data_value >= lowVal_input AND data_value <= highVal_input)) and
    (lowDate_input IS NULL OR highDate_input IS NULL OR (date_time >= lowDate_input AND date_time <= highDate_input));

-- TEST QUERIES \/\/\/\/\/

-- select * from DATA_POINT where
--     ('GSU' = location_name) and
--     (null IS NULL OR type = null) and
--     (10 IS NULL OR null IS NULL OR (data_value >= 10 AND data_value <= null)) and
--     ('20170101' IS NULL OR null IS NULL OR (date_time >= '20170101' AND date_time <= null));

-- select * from DATA_POINT where
--     ('Georgia Tech' = location_name) and
--     (null IS NULL OR type = null) and
--     (3 IS NULL OR 42 IS NULL OR (data_value >= 3 AND data_value <= 42)) and
--     (null IS NULL OR '20160101' IS NULL OR (date_time >= null AND date_time <= '20160101'));



-- Flag button sql command

update POI SET flagged = 1 where (location_name = location_input and flagged = 0);
-- ^^^^^^ sets a not flagged location to flagged

update POI SET flagged = 0 where (location_name = location_input and flagged = 1);
-- ^^^^^^ sets a flagged location to not flagged


-- requires php to check which state the POI is in when clicked
update POI SET flagged = 0 where (location_name = 'Emory' and flagged = 1);

update POI SET flagged = 1 where (location_name = 'Emory' and flagged = 0);





select * from DATA_POINT where date_time >= '20170101' and date_time <= '20170231';
--
--
-- Login SQL
--
--
select email,username,user_type from USER where( USER.username = un_input  and USER.password = pw_input);

-- if empty set:
--      error "Invalid username or password"
-- else:
--      successful login use user_type to direct user to correct menu page


--actual implementation
--$sql = "select email,username,user_type from USER where( USER.username = '$username'  and USER.password = '$password');";
-- TEST
-- select username, password,user_type from USER where( USER.username = "Arnold" and USER.password = "Strong")



---Citi_Official constraint-------
SELECT approved 
FROM CITY_OFFICIAL
WHERE username = un_input
## code will have to handle the error. 
## only gives access to approved city_official
## If approved == 1 (i.e city_official is approved)
##      allow access to the application 

--
--
-- FILTER SEARCH 
--
--
 -- this is a pretty complicated one


-- populate drop downs with this data
-- ********* All of these must have an option for null when there is no value selected
select location_name from POI;
select city from LOCATION;
select state from LOCATION;




select * from POI where
    (name_input IS NULL OR location_name = name_input) and
    (city_input IS NULL OR city = city_input) and
    (state_input IS NULL OR state = state_input) and
    (zip_input IS NULL OR zip = zip_input) and
    (flagged_input IS NULL OR flagged = flagged_input) and
    (lowDate_input IS NULL OR highDate_input IS NULL OR (date_time >= lowDate_input AND date_time <= highDate_input));




-- test queries for dummy data on the php server

select * from POI where
    (null IS NULL OR location_name = null) and
    (null IS NULL OR city = null) and
    (null IS NULL OR state = null) and
    (null IS NULL OR zip = null) and
    (null IS NULL OR flagged = null) and
    (null IS NULL OR null IS NULL OR (null >= null AND null <= null));



-- select * from POI where
--     (null IS NULL OR location_name = null) and
--     (null IS NULL OR city = null) and
--     (null IS NULL OR state = null) and
--     (null IS NULL OR zip = null) and
--     (null IS NULL OR flagged = null) and
--     (null IS NULL OR date_flagged = null)

--
--
-- DROPDOWN
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
VALUES( '$poiname', '$zip', '0', NULL, '$city', '$state' );
--if location_name already exists: ERROR - "name_input already exists"

--populate city dropdown
SELECT DISTINCT city FROM LOCATION ORDER BY city;
--populate state dropdown
SELECT DISTINCT state FROM LOCATION ORDER BY state;

--
--
-- ADD data point
--
--
-- 

INSERT INTO DATA_POINT VALUES( '$locc', '$time', '$datatype', '$value', NULL );

-- populates POI location name dropdown
select location_name from POI;
-- populates the data_type dropdown
select type from DATA_TYPE;
--populate city dropdown
SELECT DISTINCT city FROM LOCATION ORDER BY city;
--populate state dropdown
SELECT DISTINCT state FROM LOCATION ORDER BY state;

--
--
-- accept/reject datapoints
--
--

--Table
SELECT location_name, date_time, type, data_value
FROM DATA_POINT
WHERE approved IS NULL;

--If the user puts a check mark by a data point that data point's name should
--go into a tuple called "$name_inputs" and same for the $dt_inputs (for name and date-time)

--ACCEPT DATA POINT with name_input and date_time_input which are both tuples
UPDATE DATA_POINT
SET approved = 1
WHERE (location_name = '$name_input' AND date_time = '$dt_input')

--REJECT DATA POINT name_inputs and date_time_inputs
UPDATE DATA_POINT
SET approved = 0
WHERE (location_name = '$name_input' AND date_time = '$dt_input')


--
--
-- add/reject city officials 
--
--

--Table
SELECT U.username, U.email, C.city, C.state, C.approved, C.title
FROM USER AS U
INNER JOIN CITY_OFFICIAL AS C ON U.username = C.username
WHERE approved IS NULL;


--ACCEPT city officials
UPDATE CITY_OFFICIAL
SET approved = 1
WHERE (username = '$username');

--REJECT
UPDATE CITY_OFFICIAL
SET approved = 0
WHERE (username = '$username');