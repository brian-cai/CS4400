select email,username,user_type from USER where( USER.username = un_input  and USER.password = pw_input)
-- select username, password,user_type from USER where( USER.username = "brohith" and USER.password = "password")
-- if empty set:
--      error "Invalid username or password"
-- else:
--      successful login use user_type to direct user to correct page