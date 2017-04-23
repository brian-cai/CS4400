--initializing the table
SELECT location_name, date_time, type, data_value
FROM DATA_POINT
WHERE approved IS NULL;

--If the user puts a check mark by a data point that data point's name should
--go into a tuple called "name_inputs" and same for the date_time_inputs

--Then dependent on whether they pick accept or reject you run the following query

--ACCEPT DATA POINT with name_input and date_time_input which are both tuples
--having trouble with this one it may not necessary be correct
UPDATE DATA_POINT
SET approved = 1
WHERE (location_name IN name_inputs AND date_time IN date_time_inputs);

--REJECT DATA POINT name_inputs and date_time_inputs
UPDATE DATA_POINT
SET approved = 0
WHERE (location_name IN name_inputs AND date_time IN date_time_inputs);



-- alternate querry only updates one at a time


--ACCEPT DATA POINT with name_input and date_time_input

UPDATE DATA_POINT
SET approved = 1
WHERE (location_name = name_input AND date_time = dt_input);

--REJECT DATA POINT name_input and date_time_input
UPDATE DATA_POINT
SET approved = 0
WHERE (location_name = name_input AND date_time = dt_input);
