<?php
include('connection.php');
  // array for JSON response
$response = array();
$name=$_GET['Query'];

if(isset($_GET['reportType']) && isset($_GET['email'])){
$reportType=$_GET['reportType'];
$email=$_GET['email'];
	$sql="SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.image_name,person.report_type,person.person_login_id
                        FROM LFPERSON person WHERE person.report_type='$reportType' and person.person_login_id='$email' and person.name LIKE '%$name%'";

}else{
$sql="SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.image_name,person.report_type,person.person_login_id
                        FROM LFPERSON person WHERE person.name LIKE '%$name%' and person.isActive=1";
}

$query=mysql_query($sql);
if($query)
{
   while($row = mysql_fetch_array($query)){
                    array_push($response,
                            array('person_id'=>$row[0],'person_name'=>$row[1],'fathername'=>$row[2],'mothername'=>$row[3],'gender'=>$row[4],'age'=>$row[5],'religion'=>$row[6],'imageName'=>$row[7],'reportType'=>$row[8]
                            ,'person_login_id'=>$row[9]
                    ));
                }
    echo json_encode($response);
}else
{
  echo('Not Found ');
}
?> 