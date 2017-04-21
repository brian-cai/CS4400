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
WHERE d.location_name = p.location_name AND d.type = "mold"
GROUP BY d.type, d.location_name
ORDER BY d.location_name;

--testwhat I can do
CREATE VIEW air_report_test AS
SELECT d.location_name, p.city, p.state, MIN(d.data_value) AS airmin, AVG(d.data_value) AS airavg, MAX(d.data_value) AS airmax, p.flagged
FROM DATA_POINT AS d
INNER JOIN POI AS p
WHERE d.location_name = p.location_name AND d.type = "air quality"
GROUP BY d.type, d.location_name
ORDER BY d.location_name;

--count and flagged view
CREATE VIEW count_flagged AS
SELECT d.location_name, p.city, p.state, count(*) AS number_points, p.flagged AS flagged
FROM DATA_POINT as d
INNER JOIN POI as p
WHERE d.location_name = p.location_name
GROUP BY d.location_name;
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
 SELECT p.location_name, p.city, p.state, count(*) AS number_points, p.flagged AS flagged
 FROM DATA_POINT as d
 RIGHT JOIN POI as p
    on d.location_name
-- GROUP BY d.location_name;
