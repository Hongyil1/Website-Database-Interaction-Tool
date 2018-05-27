# Website-Database-Interaction-Tool

This php project is used to visualize the data in database (MySQL/SQLite). From the webpage, the user can query and modify the database. The input file is a .csv with header | url | status_code | CMS |. The .csv can be get from my project [Website-CMS-Detection](https://github.com/Hongyil1/Website-CMS-Detection). The Python scripts are used to input data from .csv file to database. 

The table in database is like: 

| ID  | url | notes | owner | cms |
| --- | --- | ----- | ----- | --- |

In the website, users can click the buttons the see the next and last record in database.The control bar will show the url, cms of the url. YOu can modify the notes and owner record in database by submitting the texts.

![screenshot from 2018-05-14 16-17-34](https://user-images.githubusercontent.com/22671087/39981488-16b51e2c-5794-11e8-8a0e-da65d19f479a.png)

## Prerequisites
- Python3.+
- Apache
- PHP
- Mysql
- Sqlit

## How to use
1. Install the Prerequisites
2. Move .php files to your www/html/ folder and give **permisions** to **www-data** and enable it to read and write.
3. Change the database servername, username, password, databasename,tablename in mysql.php (line 15-19), project_mysql.php (line 4-8). For SQLite version, you need to change database file name and table name in sqlite.php (line 12,13 ), project_sqlite.php (line 3,4).
4. Run the Python Script to input the data in .csv file to database (Mysql/Sqlite).**The parameters should be consistent with those in point 3.**
5. Operate in the webpage.

**For Mysql version:**
```
python3 Main_Mysql.py -f Final_result.csv -hs localhost -u root -p abc123 -db test_db -tb test_table
```
-f is the file you want to input to the database<br>
-hs is the host of your MySQL database<br>
-u is the user of your database<br>
-p is the password<br>
-db is the name of the database you want to create or use (if already exist)<br>
-tb is the name of table<br>

**For Sqlite version:**
```
sudo python3 Main_SQLite.py -db mysqlite -tb my_table -f Final_result.csv
```
-db is the database file name<br>
-tb is the table name<br>
-f is the file you want to input to your database<br>

## Authors

* **[Hongyi Lin](https://github.com/Hongyil1)** 

## License

This project is licensed under the MIT License

## Demo
link: https://gfycat.com/DeadlyGranularIlladopsis

<a href="https://imgflip.com/gif/2a81gk"><img src="https://i.imgflip.com/2a81gk.gif" title="made at imgflip.com"/></a>
