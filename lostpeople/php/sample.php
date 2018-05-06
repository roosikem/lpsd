<?php
 
include('connection.php');
$response = array();
$file_path = "uploads/";
// check for required fields
if (isset($_POST['firstName'])) {
 
    $firstName= $_POST['firstName'];
    $age= $_POST['age'];
    $fatherName= $_POST['fatherName'];
 
    $motherName= $_POST['motherName'];
    $gender= $_POST['gender'];
    $religion=$_POST["religion"];
 
    
    $user_image=$_POST["image"];
    $hairType=$_POST["hairType"];
    $eyeType=$_POST["eyeType"];
    
    $physique=$_POST["physique"];
    $complexion=$_POST["complexion"];
    
    $partType=$_POST["partType"];
    $bodyLocation=$_POST["bodyLocation"];
    
    $mStreat=$_POST["mStreat"];
    $mRoad=$_POST["mRoad"];
    
    $mCity=$_POST["mCity"];
    $mState=$_POST["mState"];
    
    $mCountry=$_POST["mCountry"];
    $mPinCode=$_POST["mPinCode"];
    
    $cStreat=$_POST["cStreat"];
    $cRoad=$_POST["cRoad"];
    
    $cCity=$_POST["cCity"];
    $cCountry=$_POST["cCountry"];
    $cState=$_POST["cState"];
    
    $cPinCode=$_POST["cPinCode"];
    $cName=$_POST["cName"];
    
    $cEmail=$_POST["cEmail"];
    $cPhoneNumber=$_POST["cPhoneNumber"];
    $reportType=$_POST["reportType"];
    $thumbnail=$_POST["thumbnail"];
    $login_id=$_POST["login_id"];
    
    $report_date=$_POST["founddate"];
    
    if (isset($_POST['person_id'])) {
    	     $person_id=$_POST["person_id"];
    	     
             $image_name=$_POST["image_name"];
             $create_date=$_POST["create_date"];
		             
		          
             $result = mysql_query("UPDATE LFPERSON person set person.name='$firstName', person.fathersname='$fatherName', person.mothersname='$motherName', 
                       person.gender='$gender',person.age='$age', person.religion='$religion',
                       person.person_login_id='$login_id', person.create_date='$create_date', person.update_date=NOW(),
                       person.report_type='$reportType' where person.person_id=$person_id");
             
              if(isset($_POST['image_name'])){
             		$filename = $_POST['image_name'];
                        $fullpath=$file_path . $filename;
				  if (file_exists($fullpath)) {
					unlink($fullpath);
				  } else {
				  }
             }
            
			
			
			$apperanceDetail = mysql_query("UPDATE LFAPPERANCEDETAILS SET physique= '$physique',complexion='$complexion',hair_type='$hairType',
                                           eye_type='$eyeType' where person_id='$person_id'");
			$identificationDetail = mysql_query("UPDATE LFIDENTIFICATION_MARKS SET identification_mark= '$partType',
                                                identification_part='$bodyLocation' where person_id='$person_id'");
			$lfAddress=mysql_query("UPDATE LFADDRESS SET area= '$mRoad',city_name='$mCity',pincode='$mPinCode',state='$mState',country='$mCountry',
                                   houseno_street='$mStreat' where person_id='$person_id'");
			$lfcAddress=mysql_query("UPDATE LFCADRESS SET 		
                                    area='$cRoad',city_name='$cCity',pincode='$cPinCode',state='$cState',country='$cCountry',houseno_street='$cStreat',contact_name='$cName',
                                    contact_phone_no='$cPhoneNumber',contact_email='$cEmail' where person_id='$person_id'");
		        
                                    
                if($result){
				  if(isset($_POST['image_name'])){
                    $file_name=$_FILES['uploaded_file']['name'];
					$temp = explode('.', $file_name);
					$ext  = array_pop($temp);
					$imageName=$person_id . "." . $ext;
					$file_path = $file_path . $imageName;
					if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
						
					
						 $resultt = mysql_query("update LFPERSON person set person.image_name= '$imageName' where person.person_id='$person_id'");
						 if($resultt){
								 
								 $response["success"] = 1;
								 $response["userId"] =  $person_id;
								 $response["reportType"] = $reportType;
								 $response["message"] = "successfully add.";
					             echo json_encode($response);
					    }else{
							     $response["success"] = 5;
								 $response["userId"] = $person_id;
								 $response["reportType"] = $reportType;
								 $response["message"] = "Image Upload but Not Update Database";
					             echo json_encode($response);
						}
						 
					} else{
						         $response["success"] = 4;
								 $response["userId"] = $person_id;
								 $response["reportType"] = $reportType;
								 $response["message"] = "Image Not  Upload SuccessFully In Edit Mode";
					             echo json_encode($response);
					    }
				    }else{
						         $response["success"] = 1;
								 $response["userId"] =  $person_id;
								 $response["reportType"] = $reportType;
								 $response["message"] = "successfully add. but not image";
					             echo json_encode($response);
						
					}
                                    
                   }else{
                                    
                            $response["success"] = 0;
					        $response["message"] = 'Oops error in updating person.';
				            $response["userId"] = $person_id;
				            $response["reportType"] = $reportType;
					        echo json_encode($response);
                        }
                                    
                                    
	  }else{
	     $result = mysql_query("INSERT INTO LFPERSON(name,fathersname,mothersname,gender,age,religion,person_image,thumbnail,person_login_id,report_date,create_date,update_date,report_type) 
                    VALUES('$firstName','$fatherName','$motherName','$gender','$age','$religion','$user_image','$thumbnail','$login_id','$report_date',NOW(),NOW(),'$reportType')");
                    if ($result) {
	     $last_id = mysql_insert_id($conn);
	     $apperanceDetail = mysql_query("INSERT INTO LFAPPERANCEDETAILS(physique,complexion,hair_type,eye_type,person_id) VALUES('$physique','$complexion','$hairType','$eyeType','$last_id')");
	     $identificationDetail = mysql_query("INSERT INTO LFIDENTIFICATION_MARKS(identification_mark,identification_part,person_id) VALUES('$partType','$bodyLocation','$last_id')");
	     $lfAddress=mysql_query("INSERT INTO LFADDRESS(area,city_name,pincode,state,country,houseno_street,person_id) VALUES('$mRoad','$mCity','$mPinCode','$mState','$mCountry','$mStreat','$last_id')");
	     $lfcAddress=mysql_query("INSERT INTO LFCADRESS(area,city_name,pincode,state,country,houseno_street,contact_name,contact_phone_no,contact_email,person_id) 		
                         VALUES('$cRoad','$cCity','$cPinCode','$cState','$cCountry','$cStreat','$cName','$cPhoneNumber','$cEmail','$last_id')");
	
	     if($apperanceDetail &&  $identificationDetail && $lfAddress && $lfcAddress){
			  if(isset($_POST['image_upload'])){
	                $file_name=$_FILES['uploaded_file']['name'];
					$temp = explode('.', $file_name);
					$ext  = array_pop($temp);
					$imageName=$last_id . "." . $ext;
					$file_path = $file_path . $imageName;
					if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
						
					
					 $resultt = mysql_query("update LFPERSON person set person.image_name= '$imageName' where person.person_id='$last_id'");
					 if($resultt){
						     
							 $response["success"] = 1;
							 $response["userId"] = $last_id;
							 $response["reportType"] = $reportType;
							 $response["message"] = "successfully add.";
				 
				 
								echo json_encode($response);
					 }else{
						 $deleteRollback = mysql_query("delete from LFPERSON where person_id = '$last_id'");
						 $deleteRollback2 = mysql_query("delete from LFAPPERANCEDETAILS where person_id = '$last_id'");
						 $deleteRollback3 = mysql_query("delete from LFIDENTIFICATION_MARKS where person_id = '$last_id'");
						 $deleteRollback4 = mysql_query("delete from LFADDRESS where person_id = '$last_id'");
						 $deleteRollback5 = mysql_query("delete from LFCADRESS where person_id = '$last_id'");
					 
							$response["success"] = 2;
							$response["userId"] = $last_id;
							$response["reportType"] = $reportType;
							$response["message"] = "Successfully rollback.";
							echo json_encode($response);
					 }
						 
					} else{
						 $deleteRollback = mysql_query("delete from LFPERSON where person_id = '$last_id'");
						 $deleteRollback2 = mysql_query("delete from LFAPPERANCEDETAILS where person_id = '$last_id'");
						 $deleteRollback3 = mysql_query("delete from LFIDENTIFICATION_MARKS where person_id = '$last_id'");
						 $deleteRollback4 = mysql_query("delete from LFADDRESS where person_id = '$last_id'");
						 $deleteRollback5 = mysql_query("delete from LFCADRESS where person_id = '$last_id'");
					 
							$response["success"] = 2;
							$response["userId"] = $last_id;
							$response["reportType"] = $reportType;
							$response["message"] = "Successfully rollback.";
							echo json_encode($response);
					}
				 
		      }else{
				             $response["success"] = 1;
							 $response["userId"] = $last_id;
							 $response["reportType"] = $reportType;
							 $response["message"] = "successfully add.";
							 echo json_encode($response);
				  
			  }
	      }else{
		     $deleteRollback = mysql_query("delete from LFPERSON where person_id = '$last_id'");
		     $deleteRollback2 = mysql_query("delete from LFAPPERANCEDETAILS where person_id = '$last_id'");
		     $deleteRollback3 = mysql_query("delete from LFIDENTIFICATION_MARKS where person_id = '$last_id'");
		     $deleteRollback4 = mysql_query("delete from LFADDRESS where person_id = '$last_id'");
		     $deleteRollback5 = mysql_query("delete from LFCADRESS where person_id = '$last_id'");
	     
	            $response["success"] = 2;
	            $response["userId"] = $last_id;
	            $response["reportType"] = $reportType;
	            $response["message"] = "Successfully rollback.";
		    echo json_encode($response);
	    }
       
 
        
      } else {
	        $response["success"] = 0;
	        $response["message"] = 'Oops error in mysql';
 
	        echo json_encode($response);
    }
    
  }
    
    
      				
  
    
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    echo json_encode($response);
}
?>