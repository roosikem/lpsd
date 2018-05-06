<?php
    
    $dbhost = 'localhost';
    $dbuser = 'androidl_anupama';
    $dbpass = 'MNAnupama@112';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);    
    if(!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db('androidl_labmanager');
?>