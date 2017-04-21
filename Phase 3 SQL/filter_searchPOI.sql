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
    ('Atlanta' IS NULL OR city = 'Atlanta') and
    (null IS NULL OR state = null) and
    (30332 IS NULL OR zip = 30332) and
    (null IS NULL OR flagged = null) and
    (null IS NULL OR date_flagged = null);


-- select * from POI where
--     (null IS NULL OR location_name = null) and
--     (null IS NULL OR city = null) and
--     (null IS NULL OR state = null) and
--     (null IS NULL OR zip = null) and
--     (null IS NULL OR flagged = null) and
--     (null IS NULL OR date_flagged = null)
