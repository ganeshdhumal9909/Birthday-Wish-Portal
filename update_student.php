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
$id = $_POST['id'];

$sql = "UPDATE `birthday` SET  `First_Name`='$fname' , `Last_Name`= '$lname', `Mobile_Number`='$mobile',  `Birth_Date`='$bdate', `Father_Bdate`= '$fbdate', `Mother_Bdate`='$mbdate',  `Parrent_AniiDate`='$andate',  `Photo_URL`='$purl' WHERE id='$id' ";
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