<?php
include('connection.php');
  // array for JSON response
$response = array();

$pageLimit = (int)$_GET['pageLimit'];
if(isset($_GET['advance'])){
$sql ="SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.report_type,person.person_login_id,person.create_date,person.update_date,person.image_name FROM LFPERSON person INNER JOIN LFADDRESS lfAddress ON person.person_id = lfAddress.person_id
INNER JOIN LFCADRESS lfcAddress ON person.person_id = lfcAddress.person_id
INNER JOIN LFAPPERANCEDETAILS lfAppreance ON person.person_id = lfAppreance.person_id
INNER JOIN LFIDENTIFICATION_MARKS lfIdenti ON person.person_id = lfIdenti.person_id where person.isActive=1";

	if(isset($_GET['advance'])){
		
	}
	   if(isset($_GET['name'])){
		$name = $_GET['name'];
		$sql .= " and person.name like '%$name%'";
   	   }
		
		
	
	if(isset($_GET['fathername'])){
		$fatherName = $_GET['fathername'];
		$sql .= " and person.fathersname like '%$fatherName%'";
	}
	if(isset($_GET['age'])){
		$age= $_GET['age'];
	        $sql .= " and person.age='$age'";
	}
	if(isset($_GET['country'])){
		$country= $_GET['country'];
		$sql .= " and lfAddress.country='$country'";
	}
	if(isset($_GET['state'])){
		$state= $_GET['state'];
		$sql .= " and lfAddress.state='$state'";
	}
	if(isset($_GET['city'])){
		$city= $_GET['city'];
		$sql .= " and lfAddress.city_name='$city'";
	}
	if(isset($_GET['area'])){
		$area= $_GET['area'];
		$sql .= " and lfAddress.area='$area'";
	}
	if(isset($_GET['gender'])){
		$gender= $_GET['gender'];
		$sql .= " and person.gender='$gender'";
	}
	if(isset($_GET['religion'])){
		$religion= $_GET['religion'];
		$sql .= " and person.religion='$religion'";
	}
	if(isset($_GET['physique'])){
		$physique= $_GET['physique'];
		$sql .= " and lfAppreance.physique='$physique'";
	}
	if(isset($_GET['hairType'])){
		$hairType= $_GET['hairType'];
		$sql .= " and lfAppreance.hair_type='$hairType'";
	}
	if(isset($_GET['eyeType'])){
		$eyeType= $_GET['eyeType'];
		$sql .= " and lfAppreance.eye_type='$eyeType'";
	}
	if(isset($_GET['complexion'])){
		$complexion= $_GET['complexion'];
		$sql .= " and lfAppreance.complexion='$complexion'";
	}
	
    $sql .= " LIMIT $pageLimit, 8";
}else{
$sql =" SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.report_type,person.person_login_id,person.create_date,person.update_date,person.image_name FROM LFPERSON person where person.isActive=1 LIMIT $pageLimit, 8";

}
$query=mysql_query($sql);
if($query)
{
   while($row = mysql_fetch_array($query)){
                    array_push($response,
                        array('person_id'=>$row[0],'person_name'=>$row[1],'fathername'=>$row[2],'mothername'=>$row[3],'gender'=>$row[4],'age'=>$row[5],'religion'=>$row[6],'reportType'=>$row[7],'createdBy'=>$row[8],'create_date'=>$row[9],'update_date'=>$row[10],'imageName'=>$row[11]
                    ));
                }
    echo json_encode($response);
}else
{
  echo('Not Found ');
}
?> 