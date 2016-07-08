<?php

//Load SQL settings
#Load SQL Settings (MySQL)
f_sql_address=open(app_path+'www/settings/sql/address','r+')
sql_address=f_sql_address.readline()
sql_address=sql_address.rstrip('\n')
f_sql_address.close()

f_sql_username=open(app_path+'www/settings/sql/username','r+')
sql_username=f_sql_username.readline()
sql_username=sql_username.rstrip('\n')
f_sql_username.close()

f_sql_password=open(app_path+'www/settings/sql/password','r+')
sql_password=f_sql_password.readline()
sql_password=sql_password.rstrip('\n')
f_sql_password.close()

f_sql_database=open(app_path+'www/settings/sql/database','r+')
sql_database=f_sql_database.readline()
sql_database=sql_database.rstrip('\n')
f_sql_database.close()

#db = MySQLdb.connect(sql_address,sql_username,sql_password,sql_database)

$db = new mysqli($sql_address, $sql_username, $sql_password, $sql_database, 3306);


#$db = new SQLite3($_SERVER['DOCUMENT_ROOT'] . '/yieldbuddy/www/sql/yieldbuddy.sqlite3');
#$db = new SQLite3('/mnt/usb/yieldbuddy.sqlite3');
?>
