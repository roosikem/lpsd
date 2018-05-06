<?php

    include('connection.php');
    $response = array();
    $file_path = "uploads/";
    $file_name=$_FILES['uploaded_file']['name'];
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        $temp = explode('.', $file_name);
	$ext  = array_pop($temp);
	$id= implode('.', $temp);
	
	 $resultt = mysql_query("update LFPERSON person set person.image_name= '$file_name' where person.person_id='$id'");
	 if($resultt){
		 $response["success"] = 1;
	         $response["message"] = "Success";
	 }
         
    } else{
        $response["success"] = 0;
        $response["message"] = "Error";
    }

    echo json_encode($result);

?>
