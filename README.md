# php-sakila movie database manipulation practice
## Database
You can download the database from [here](https://dev.mysql.com/doc/index-other.html).
## Database credentials
You need to create databaseCredentials.php -file to the root folder (or to the includes -folder for the MVC version) with following content:
```php
<?php
$servername = 'localhost_or_your_server_address';
$username = 'your_database_username_here';
$password = 'your_database_password_here';
$database = 'your_database_name_here';
```
## Model - View - Controller design pattern
I redid the basic procedural version (found in the root folder) using object oriented approach and implemented model - view - controller design pattern. You can find it in the MVC folder.
