--the tricky thing is to find out how to deal with multiple city officials that they can "select" with a checkbox
--If the select box is clicked next to their name put their username in a tuple called username_inputs

SELECT U.username, U.email, C.city, C.state, C.approved
FROM USER AS U
INNER JOIN CITY_OFFICIAL AS C ON U.username = C.username
WHERE approved IS NULL;

--the above returns what I want


--ACCEPT city officials
--if their name is checked and accept button is clicked then run this query
UPDATE CITY_OFFICIAL
SET approved = 1
WHERE (username IN username_inputs);

--REJECT
UPDATE CITY_OFFICIAL
SET approved = 0
WHERE (username IN username_inputs);



-- alternate querry only updates one at a time

--ACCEPT city official based on username_input selected
UPDATE CITY_OFFICIAL
SET approved = 1
WHERE (username = username_input);

--REJECT city official based on username_input selected
UPDATE CITY_OFFICIAL
SET approved = 0
WHERE (username = username_input);