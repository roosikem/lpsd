<?php

include('connection.php');
  // array for JSON response
$response = array();

// check for required fields
if (isset($_POST['userId'])) {
  
    $userId= $_POST['userId'];
    $active= (int)$_POST['active'];
 $result = mysql_query("update LFPERSON person set person.isActive=$active WHERE person.person_id='$userId'");
             
    if($result) {
	     $response["success"] = 1;
	     $response["message"] = "Successs";
	     echo json_encode($response);
    } else{
    	     $response["success"] = 0;
	     $response["message"] = "Error in updating person";
	     echo json_encode($response);
    }         
    
    
  
 } else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) missing";
    echo json_encode($response);
}
?> 