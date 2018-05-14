import MySQLdb
import webbrowser

db = MySQLdb.connect(host="localhost", user="kent", passwd="abc123")
cur = db.cursor()

# create table
cur.execute("SET sql_notes = 0; ") # hide the warning
cur.execute("create database IF NOT EXISTS kentproj;")
cur.execute("use kentproj;")
cur.execute("create table IF NOT EXISTS proj_table(id INT PRIMARY KEY, url varchar(70), notes varchar(100), owner varchar(70), cms varchar(70));")

# Read from result.csv
with open('Final_result.csv') as f:
    for i, line in enumerate(f):
        if i > 0:
            line_list = line.split(",")
            url = line_list[0]
            cms = line_list[2].strip()
            id = i
            # print(id)
            cur.execute("insert IGNORE into proj_table (id, url, notes, owner, cms) value('{0}', '{1}', 'None', 'None', '{2}')".format(id, url, cms))

# # insert data
# cur.execute("insert into proj_table (url, notes, owner, cms) values('http://weboptimizers.com', 'This is not Magento', 'kent', 'Wordpress')")

db.autocommit(on=True)
webbrowser.open("http://127.0.0.1/project.php")
print("Finish.")
