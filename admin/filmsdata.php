<?php
include'../dbcon.php';
$query="SELECT * FROM Films";
$result=mysqli_query($connection, $query);

$string="{ \"data\": [";
while($row = $result->fetch_assoc()) {
$string=$string."[". "\"" .$row['id']."\",\"".$row['idfilm']."\",\"".$row['title']."\",\"".$row['year']."\",\"".$row['genre']."\"],";
}
$string=mb_substr($string, 0, -1);
$string=$string."]}";
print $string;
?>
