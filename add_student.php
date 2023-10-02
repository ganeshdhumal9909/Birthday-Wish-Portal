<?php
   include_once 'database.php';
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$bdate = $_POST['bdate'];
$fbdate = $_POST['fbdate'];
$mbdate = $_POST['mbdate'];
$andate = $_POST['andate'];
$purl = $_POST['purl'];

$sql = "INSERT INTO `birthday` (`First_Name`,`Last_Name`,`Mobile_Number`,`Birth_Date`,`Father_Bdate`,`Mother_Bdate`,`Parrent_AniiDate`,`Photo_URL`) values ('$fname', '$lname', '$mobile', '$bdate','$fbdate', '$mbdate', '$andate', '$purl' )";
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