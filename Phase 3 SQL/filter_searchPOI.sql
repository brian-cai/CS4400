-- this is a pretty complicated one

select * from POI where
    (name_input IS NULL OR location_name = name_input) and
    (city_input IS NULL OR city = city_input) and
    (state_input IS NULL OR state = state_input) and
    (zip_input IS NULL OR zip = zip_input) and
    (flagged_input IS NULL OR flagged = flagged_input) and
    (dflag_input IS NULL OR date_flagged = dflag_input) and