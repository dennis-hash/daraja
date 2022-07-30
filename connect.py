
import mysql.connector
mydb = mysql.connector.connect(host="localhost", user="dennis", passwd="12414-Denn!s", database="web")
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM users")
myresult = mycursor.fetchall()
for x in myresult:
    print(x)
print("Hello World")