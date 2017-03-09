-- /mnt/c/Users/joseb/cs4400 project/CS4400
drop table user;
create table user (email varchar(30), username varchar(30), password varchar(30) NOT NULL, primary key(email), unique(username));

insert into user values("rohith@test", "brohith", "password");
insert into user values("victor@test", "braza", "lol");
insert into user values("victor@test", "should fail", "123456");
insert into user values("jose@test", "braza", "should fail");
insert into user values("victor@test", "braza", "should fail");


select * from user;