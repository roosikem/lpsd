<?php
include('connection.php');
  // array for JSON response
$response = array();
$person_id = (int)$_GET['person_id'];
$sql="SELECT person.person_image
                        FROM LFPERSON person where person.person_id=$person_id";
$query=mysql_query($sql);
if($query)
{
   while($row = mysql_fetch_array($query)){
                    array_push($response,
                            array('person_image'=>$row[0]
                    ));
                }
    echo json_encode(array("result"=>$response));
}else
{
  echo('Not Found ');
}
?> 