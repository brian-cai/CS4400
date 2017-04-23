insert into USER values(em_input, un_input, pw_input, type_input);
--
-- if confpw_input != pw_input: error "passwords don't match "


-- if type_input == "City Official":
-- populate city and state dropdowns
    select city from LOCATION;
    select state from LOCATION;

insert into CITY_OFFICIAL values(un_input, title_input, 0, city_input, state_input);
-- assumption: city and state are already in the database