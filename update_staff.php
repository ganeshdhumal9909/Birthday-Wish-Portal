<?php 
include_once 'database.php';
$sname = $_POST['sname'];
$snumber = $_POST['snumber'];
$sbdate = $_POST['sbdate'];
$sandate = $_POST['sandate'];
$surl = $_POST['surl'];
$saurl = $_POST['saurl'];
$id = $_POST['id'];

$sql = "UPDATE `staff` SET  `Staff_Name`='$sname' , `Phone_Number`= '$snumber', `Birthdate`='$sbdate',  `staff_AniiDate`='$sandate', `Photo_URL`= '$surl', `AnniPhoto_URL`='$saurl' WHERE id='$id' ";
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