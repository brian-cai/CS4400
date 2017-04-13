--if a city official clicks "add a new location"
--city and state inputs are from the database and in drop-down format
INSERT INTO POI
VALUES ("name_input", "zip_input", "0", "NULL", "city_input", "state_input");
--if location_name already exists: ERROR - "name_input already exists"
