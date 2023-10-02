<?php 
include_once 'database.php';
$id = $_POST['id'];
$sql = "SELECT * FROM staff WHERE id='$id' LIMIT 1";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
