# Website-Database-Interaction-Tool



## Prerequisites
- Python3.+
- Apache
- PHP
- Mysql
- Sqlit

## How to use
1. Install the Prerequisites
2. Move .php files to your www/html/ folder and give permisions to read and write.
3. Change the database username, password in Mysql python script (No need for Sqlite version).
4. Run the Python Script to input the data in .csv file to database (Mysql/Sqlite).

For Mysql version:
```
python3 Main_Mysql.py -f Final_result.csv -hs localhost -u root -p abc123 -db test_db -tb test_table
```
-f is the file you want to input to the database<br>
-hs is the host of your MySQL database<br>
-u is the user of your database<br>
-p is the password
-db is the name of the database you want to create or use (if already exist)
-tb is the name of table

For Sqlite version:</b>
```
sudo python3 Main_SQLite.py -db mysqlite -tb my_table -f Final_result.csv
```
5. Operate in the webpage


## Authors

* **Hongyi Lin** - *Initial work* - [Hongyi Lin](https://github.com/Hongyil1)

## License

This project is licensed under the MIT License
