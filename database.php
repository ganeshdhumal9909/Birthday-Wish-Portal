<?php
error_reporting(1);
$servername = 'server295.web-hosting.com';
$username = 'buzzqiir_ganii';
$password = '1OfVo~$Hxql~';
$dbname= 'buzzqiir_wishsms';

// Create connection
$conn = new mysqli($servername, $username, $password ,$dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>