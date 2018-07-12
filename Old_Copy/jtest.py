import sqlite3
import sys

connection = sqlite3.connect("{}.sqlite3".format("josetest"))
cursor = connection.cursor()
cursor.execute("""DROP TABLE IF EXISTS User""")
cursor.execute("""CREATE TABLE User (email varchar(30),username varchar(30) not null, password varchar(30) not null, primary key(email), unique(username))""")


commandlist = [
"""INSERT INTO User values("rohith@testPotato Left Right DOwn", "brohith", "password")""",
"""INSERT INTO User values("victor@test", "braza", "lol")""",
"""INSERT INTO User values("victor@test", "should fail", "123456")""",
"""INSERT INTO User values("jose@test", "braza", "should fail")""",
"""INSERT INTO User values("victor@test", "braza", "should fail")""",
"""INSERT INTO User values("nullcheck@1", null, "should fail")""",
"""INSERT INTO User values("nullcheck@2", "pooplah", null)"""
]

for command in commandlist:
    try:
        cursor.execute(command)
        print("good")
    except:
        print(sys.exc_info()[0])
# cursor.execute("""INSERT INTO User values("rohith@test", "brohith", "password")""")
# cursor.execute("""INSERT INTO User values("victor@test", "braza", "lol")""")
# cursor.execute("""INSERT INTO User values("victor@test", "should fail", "123456")""")
# cursor.execute("""INSERT INTO User values("jose@test", "braza", "should fail")""")
# cursor.execute("""INSERT INTO User values("victor@test", "braza", "should fail")""")

# cursor.execute("""_""")


connection.commit()