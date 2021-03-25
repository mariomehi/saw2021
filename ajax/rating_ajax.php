<?php
// start a session
session_start();

include "../dbcon.php";

if (!isset($_SESSION['login'])) {

$return_arr = array();
echo json_encode($return_arr);

} else {

$userid = $_SESSION['login'];
$postid = $_POST['idfilm'];
$rating = $_POST['rating'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM Rates WHERE idfilm=".$postid." AND idmember=".$userid;
$result = mysqli_query($connection,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if($count == 0){
 $insertquery = "INSERT INTO Rates(idmember,idfilm,rating) values(".$userid.",".$postid.",".$rating.")";
 mysqli_query($connection,$insertquery);
$count++;
}else {
 $updatequery = "UPDATE Rates SET rating=" . $rating . " where idmember=" . $userid . " and idfilm=" . $postid;
 mysqli_query($connection,$updatequery);
}

// get average
$query = "SELECT COUNT(*) as countf, ROUND(AVG(rating),1) as averageRating FROM Rates WHERE idfilm=".$postid;
$result = mysqli_query($connection,$query);
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];
$countfilm = $fetchAverage['countf'];

$return_arr = array("averageRating"=>$averageRating,"count"=>$countfilm);

echo json_encode($return_arr);
}
