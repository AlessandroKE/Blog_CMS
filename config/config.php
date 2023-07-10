<?php

/* initializing the required values:
host, username , password ,dbname */
$host = 'localhost';
$db_name = 'cleanblog';
$user = 'root';
$password = '';

//By specifying "mysql" as the driver, you are indicating that you want to establish a connection with a MySQL database. 
//This driver allows PDO to understand and communicate with MySQL databases using the appropriate protocols and commands.

function getConn($host, $db_name, $user, $password){

    //The DSN (Data Source Name) string is enclosed within double quotes, allowing the variables to be interpolated.
    //The "user" and "password" parameters are passed separately as arguments to the PDO constructor.

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}



   




