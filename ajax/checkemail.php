<?php

$json=json_encode($_POST);
$data = json_decode($json); 

$usermail=$data->email;
include '../dbcon.php';
$query2="SELECT email FROM Members WHERE email='$usermail'";
$result2=mysqli_query($connection, $query2);
$userexist = $result2->fetch_assoc();
if ($userexist["email"]==$usermail)
echo "ko";
else 
echo "ok";
