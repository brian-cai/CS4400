-- populates POI location name dropdown
select location_name from POI;

-- populates the data_type dropdown
select type from DATA_TYPE;

insert into DATA_POINT values(name_input, datetime_input, type_inout, value_input, 0);




-- populate drop downs

select city from LOCATION
select state from LOCATION