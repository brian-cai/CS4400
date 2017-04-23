---------------------
--Vic's Code Below--
CREATE VIEW POI_report AS 
(
	SELECT P.location_name as POIlocation, P.city as City, P.state as State, 
	(SELECT MIN(data_value) as MoldMin, D.location_name as POIlocation FROM DATA_POINT AS D 
		WHERE D.type = "mold" GROUP BY D.location_name))

FROM POI AS P, DATA_POINT AS D
)

-----Temp----
--MOLD STATS--
(SELECT P.location_name as POIlocation, P.city as City, P.state as State, 
	MIN(data_value) as MoldMin, AVG(data_value) as MoldAvg, MAX(data_value) as MoldMax
	FROM POI as P,DATA_POINT AS D 
	WHERE D.type = "mold" and  P.location_name = D.location_name 
	GROUP BY P.location_name)
--AQ STATS--
(SELECT P.location_name as POIlocation, P.city as City, P.state as State, 
	MIN(data_value) as AQMin, AVG(data_value) as AQAvg, MAX(data_value) as AQMax
	FROM POI as P,DATA_POINT AS D 
	WHERE D.type = "air quality" and  P.location_name = D.location_name 
	GROUP BY P.location_name)
-- # COUNT STATS -- 
(SELECT P.location_name as POIlocation, P.city as City, P.state as State, 
	COUNT(*) as NumOfDataPts
	FROM POI as P,DATA_POINT AS D 
	WHERE D.type = "mold" or D.type = "air quality" and P.location_name = D.location_name 
	GROUP BY P.location_name)
------X-----
