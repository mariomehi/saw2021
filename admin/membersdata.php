<?php
include'../dbcon.php';
$query="SELECT id,firstname,lastname,email,reg_date FROM Members";
$result=mysqli_query($connection, $query);

$string="{ \"data\": [";
while($row = $result->fetch_assoc()) {
$string=$string."[". "\"" .$row['id']."\",\"".$row['firstname']."\",\"".$row['lastname']."\",\"".$row['email']."\",\"".$row['reg_date']."\"],";
}
$string=mb_substr($string, 0, -1);
$string=$string."]}";
print $string;
?>


