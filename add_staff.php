<?php
   include_once 'database.php';
$sname = $_POST['sname'];
$snumber = $_POST['snumber'];
$sbdate = $_POST['sbdate'];
$sandate = $_POST['sandate'];
$surl = $_POST['surl'];
$saurl = $_POST['saurl'];

$sql = "INSERT INTO `staff` (`Staff_Name`,`Phone_Number`,`Birthdate`,`staff_AniiDate`,`Photo_URL`,`AnniPhoto_URL`) values ('$sname', '$snumber', '$sbdate', '$sandate','$surl', '$saurl')";
$query= mysqli_query($conn,$sql);
$lastId = mysqli_insert_id($conn);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>