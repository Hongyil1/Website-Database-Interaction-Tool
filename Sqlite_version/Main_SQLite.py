import sqlite3
import webbrowser
from shutil import copyfile

sqlite_file = "kentproj"
table_name = "proj_table"

# Connect to db
db = sqlite3.connect(sqlite_file)
cur = db.cursor()
cur.execute("CREATE TABLE IF NOT EXISTS {0}(id INT PRIMARY KEY, url TEXT, notes TEXT, owner TEXT, cms TEXT);".format(table_name))

# Read from Final_result.csv
with open('Final_result.csv') as f:
    for i, line in enumerate(f):
        if i > 0:
            line_list = line.split(",")
            url = line_list[0]
            cms = line_list[2].strip()
            id = i
            cur.execute("INSERT OR IGNORE INTO {0} (id, url, notes, owner, cms) VALUES('{1}', '{2}', 'None', 'None', '{3}')".format(table_name, id, url, cms))

db.commit()
db.close()

# Copy .db file to /var/www/htmlcms
copyfile(sqlite_file, "/var/www/html/{0}".format(sqlite_file))

webbrowser.open("http://127.0.0.1/project_sqlite.php")
print("Finish.")
