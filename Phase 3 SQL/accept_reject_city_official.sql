--the tricky thing is to find out how to deal with multiple city officials that they can "select" with a checkbox
--If the select box is clicked next to their name put their username in a tuple called username_inputs
--I literally have no idea if this is right
SELECT ("username", "email", "city", "state")
FROM USER
INNER JOIN CITY_OFFICIAL ON USER.username == CITY_OFFICIAL.username
WHERE ("approved" == 0);

--ACCEPT city officials
--if their name is checked and accept button is clicked then run this query
UPDATE CITY_OFFICIAL
SET "approved" = 1
WHERE ("username" IN username_inputs);

--REJECT AND DELETE
DELETE FROM CITY_OFFICIAL, USER
WHERE ("username" IN username_inputs);
