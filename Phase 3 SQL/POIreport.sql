--this is tricky af has view, joins, and aggregate functions all mixed in
CREATE VIEW POI_report AS
SELECT *
FROM POI
--not done just in here

--have no idea of the difference between ordering and filtering with SQL vs GUI fuck these TAs

--testing

--this is a good start...
SELECT location_name, AVG( data_value )
FROM DATA_POINT
WHERE TYPE =  "mold"
GROUP BY location_name;
