-- POI DETAIL
-- INCLUDES:
-- Filter/search and Flag

-- Filter/search

select * from DATA_POINT where
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