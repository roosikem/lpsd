<?php
include('connection.php');
$response = array();
$sql =" SELECT person.person_id,person.name,person.fathersname,person.mothersname,person.gender,person.age,person.religion,person.report_type,person.person_login_id,person.create_date,person.update_date,person.image_name FROM LFPERSON person where person.isActive=1 LIMIT 0, 5";
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
  echo('Not Found '. mysql_error());
}
?> 