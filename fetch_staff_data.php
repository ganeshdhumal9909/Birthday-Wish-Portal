<?php
   include_once 'database.php';
   $output= array();
$sql = "SELECT * FROM staff";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'Staff_Name',
	2 => 'Phone_Number',
	3 => 'Birthdate',
	4 => 'staff_AniiDate',
    5 => 'Photo_URL',
	6 => 'AnniPhoto_URL',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE Staff_Name like '%".$search_value."%'";
	$sql .= " OR Phone_Number like '%".$search_value."%'";
	$sql .= " OR Birthdate like '%".$search_value."%'";
	$sql .= " OR staff_AniiDate like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($conn,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['Staff_Name'];
	$sub_array[] = $row['Phone_Number'];
	$sub_array[] = $row['Birthdate'];
	$sub_array[] = $row['staff_AniiDate'];
    $sub_array[] = $row['Photo_URL'];
	$sub_array[] = $row['AnniPhoto_URL'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
?>