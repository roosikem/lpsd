<?php
include('connection.php');
$response = array();

$sql ="SELECT KEY_VALUE FROM CONFIG where PROJECT_NAME ='lostandfound' and KEY_NAME='STOP_SYSTEM'";

$query=mysql_query($sql);
if($query)
{
     while($row = mysql_fetch_array($query)){
                     $response["success"] = $row[0];
                }
    echo json_encode($response);
}
?>