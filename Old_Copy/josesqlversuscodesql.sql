--Code sql
SELECT * FROM POI;
('Georgia Tech' IS NULL OR location_name = 'Georgia Tech')
and('null' IS NULL OR city = 'null') and('null' IS NULL OR state = 'null')
and( IS NULL OR zip = ) and( IS NULL OR location_name = ) and($ IS NULL OR location_name = ) and

--Jose Sql
select * from POI where
    (name_input IS NULL OR location_name = name_input) and
    (city_input IS NULL OR city = city_input) and
    (state_input IS NULL OR state = state_input) and
    (zip_input IS NULL OR zip = zip_input) and
    (flagged_input IS NULL OR flagged = flagged_input) and
    (lowDate_input IS NULL OR highDate_input IS NULL OR (date_time >= lowDate_input AND date_time <= highDate_input));
