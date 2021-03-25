<?php
$dbhost = "localhost";
$dbuser = "S4719894";
$dbpassword = "marienedudi";
$dbase = "S4719894";

$connection = mysqli_connect($dbhost, $dbuser, $dbpassword);

if (!$connection) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
}

mysqli_select_db($connection, $dbase);
