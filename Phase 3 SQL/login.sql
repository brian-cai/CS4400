select email,username,user_type from USER where( USER.username = un_input  and USER.password = pw_input);

-- if empty set:
--      error "Invalid username or password"
-- else:
--      successful login use user_type to direct user to correct menu page


--actual implementation
--$sql = "select email,username,user_type from USER where( USER.username = '$username'  and USER.password = '$password');";
-- TEST
-- select username, password,user_type from USER where( USER.username = "Arnold" and USER.password = "Strong")



---Citi_Official constraint-------
SELECT approved 
FROM CITY_OFFICIAL
WHERE username = un_input
## code will have to handle the error. 
## only gives access to approved city_official
## If approved == 1 (i.e city_official is approved)
##		allow access to the application 