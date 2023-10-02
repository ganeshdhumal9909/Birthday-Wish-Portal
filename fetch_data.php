<?php
   include_once 'database.php';
   $output= array();
$sql = "SELECT * FROM birthday";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'First_Name',
	2 => 'Last_Name',
	3 => 'Mobile_Number',
	4 => 'Birth_Date',
    5 => 'Father_Bdate',
	6 => 'Mother_Bdate',
	7 => 'Parrent_AniiDate',
	8 => 'Photo_URL',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE First_Name like '%".$search_value."%'";
	$sql .= " OR Last_Name like '%".$search_value."%'";
	$sql .= " OR Mobile_Number like '%".$search_value."%'";
	$sql .= " OR Birth_Date like '%".$search_value."%'";
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
	$sub_array[] = $row['First_Name'];
	$sub_array[] = $row['Last_Name'];
	$sub_array[] = $row['Mobile_Number'];
	$sub_array[] = $row['Birth_Date'];
    $sub_array[] = $row['Father_Bdate'];
	$sub_array[] = $row['Mother_Bdate'];
	$sub_array[] = $row['Parrent_AniiDate'];
	$sub_array[] = $row['Photo_URL'];
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