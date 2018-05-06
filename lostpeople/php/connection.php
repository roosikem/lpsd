<?php

    $dbname = getenv("dbname");
    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbuser =  getenv("dbusername");
    $dbpass = getenv("dbpassword");
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);    
    if(!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($dbname);
?>
