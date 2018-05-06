<?php

include('connection.php');
  // array for JSON response
$response = array();

// check for required fields
if (isset($_GET['userId'])) {
	$userId= $_GET['userId'];
    $reportType=$_GET["reportType"];
	  if(isset($_GET['email'])){
		  $email= $_GET['email'];
		   $result = mysql_query("SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.person_image,
                        lfAddress.address_id,lfAddress.area,lfAddress.city_name,lfAddress.pincode,lfAddress.state,lfAddress.country,lfAddress.houseno_street,
                        lfcAddress.address_id,lfcAddress.area,lfcAddress.city_name,lfcAddress.pincode,lfcAddress.state,lfcAddress.country,lfcAddress.houseno_street,lfcAddress.contact_name,
                        lfcAddress.contact_phone_no,lfcAddress.contact_email,
                        lfAppreance.apperance_id,lfAppreance.physique,lfAppreance.complexion,lfAppreance.hair_type,lfAppreance.eye_type,
                        lfIdenti.identification_marks_id,lfIdenti.identification_mark,lfIdenti.identification_part,person.report_type,person.thumbnail
                        ,person.person_login_id,person.create_date,person.update_date,person.isActive,person.image_name,person.report_date
                        FROM LFPERSON person
INNER JOIN LFADDRESS lfAddress ON person.person_id = lfAddress.person_id
INNER JOIN LFCADRESS lfcAddress ON person.person_id = lfcAddress.person_id
INNER JOIN LFAPPERANCEDETAILS lfAppreance ON person.person_id = lfAppreance.person_id
INNER JOIN LFIDENTIFICATION_MARKS lfIdenti ON person.person_id = lfIdenti.person_id
WHERE person.person_id='$userId' and person.person_login_id='$email'");
                while($row = mysql_fetch_array($result )){
                    array_push($response,
                            array('person_id'=>$row[0],'person_name'=>$row[1],'fathername'=>$row[2],'mothername'=>$row[3],'gender'=>$row[4],'age'=>$row[5],'religion'=>$row[6],'person_image'=>$row[7],'maddress_id'=>$row[8],'mRoad'=>$row[9],'mCity'=>$row[10],
                            'mPincode'=>$row[11],'mState'=>$row[12],'mCountry'=>$row[13],'mStreet'=>$row[14],'caddress_id'=>$row[15],'cRoad'=>$row[16],'cCity'=>$row[17],'cPincode'=>$row[18],'cState'=>$row[19],'cCountry'=>$row[20],
                            'cStreet'=>$row[21],'contactName'=>$row[22],'contactPhoneNumber'=>$row[23],'contactEmail'=>$row[24],'appreance_id'=>$row[25],'physique'=>$row[26],'complexion'=>$row[27],
                            'hairType'=>$row[28],'eyeType'=>$row[29],'identification_mark_id'=>$row[30],'part'=>$row[31],'bodyLocation'=>$row[32],'reportType'=>$row[33],'thumbnail'=>$row[34]
                            ,'createdBy'=>$row[35],'create_date'=>$row[36],'update_date'=>$row[37],'isActive'=>$row[38],'imageName'=>$row[39],'reportDate'=>$row[40]
                    ));
                }
    echo json_encode(array("result"=>$response));
		  
	  }else{
		  
		   $result = mysql_query("SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.person_image,
                        lfAddress.address_id,lfAddress.area,lfAddress.city_name,lfAddress.pincode,lfAddress.state,lfAddress.country,lfAddress.houseno_street,
                        lfcAddress.address_id,lfcAddress.area,lfcAddress.city_name,lfcAddress.pincode,lfcAddress.state,lfcAddress.country,lfcAddress.houseno_street,lfcAddress.contact_name,
                        lfcAddress.contact_phone_no,lfcAddress.contact_email,
                        lfAppreance.apperance_id,lfAppreance.physique,lfAppreance.complexion,lfAppreance.hair_type,lfAppreance.eye_type,
                        lfIdenti.identification_marks_id,lfIdenti.identification_mark,lfIdenti.identification_part,person.report_type,person.thumbnail
                        ,person.person_login_id,person.create_date,person.update_date,person.isActive,person.image_name,person.report_date
                        FROM LFPERSON person
INNER JOIN LFADDRESS lfAddress ON person.person_id = lfAddress.person_id
INNER JOIN LFCADRESS lfcAddress ON person.person_id = lfcAddress.person_id
INNER JOIN LFAPPERANCEDETAILS lfAppreance ON person.person_id = lfAppreance.person_id
INNER JOIN LFIDENTIFICATION_MARKS lfIdenti ON person.person_id = lfIdenti.person_id
WHERE person.person_id='$userId' and person.isActive=1");
                while($row = mysql_fetch_array($result )){
                    array_push($response,
                            array('person_id'=>$row[0],'person_name'=>$row[1],'fathername'=>$row[2],'mothername'=>$row[3],'gender'=>$row[4],'age'=>$row[5],'religion'=>$row[6],'person_image'=>$row[7],'maddress_id'=>$row[8],'mRoad'=>$row[9],'mCity'=>$row[10],
                            'mPincode'=>$row[11],'mState'=>$row[12],'mCountry'=>$row[13],'mStreet'=>$row[14],'caddress_id'=>$row[15],'cRoad'=>$row[16],'cCity'=>$row[17],'cPincode'=>$row[18],'cState'=>$row[19],'cCountry'=>$row[20],
                            'cStreet'=>$row[21],'contactName'=>$row[22],'contactPhoneNumber'=>$row[23],'contactEmail'=>$row[24],'appreance_id'=>$row[25],'physique'=>$row[26],'complexion'=>$row[27],
                            'hairType'=>$row[28],'eyeType'=>$row[29],'identification_mark_id'=>$row[30],'part'=>$row[31],'bodyLocation'=>$row[32],'reportType'=>$row[33],'thumbnail'=>$row[34]
                            ,'createdBy'=>$row[35],'create_date'=>$row[36],'update_date'=>$row[37],'isActive'=>$row[38],'imageName'=>$row[39],'reportDate'=>$row[40]
                    ));
                }
    echo json_encode(array("result"=>$response));
	  }
    

    
  
 } else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) missing";
    echo json_encode($response);
}
?> 