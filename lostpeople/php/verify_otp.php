<?php

include 'DbHandler.php';
$db = new DbHandler();


$response = array();
$response["error"] = false;

if (isset($_POST['otp']) && $_POST['otp'] != '' && isset($_POST['mobile']) && $_POST['mobile'] != '') {
    $otp = $_POST['otp'];
    $mobileNumber = $_POST['mobile'];

    $user = $db->activateUser($otp,$mobileNumber);

    if ($user != NULL) {
        $response["message"] = "SUCCESS";
        $response["success"] = 1;
    } else {
        $response["success"] = 2;
        $response["message"] = "Invalid OTP";
    }
    
    
} else {
   $response["success"] = 2;
    $response["message"] = "Sorry! OTP is missing.";
}


echo json_encode($response);
?>
