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
$checktable = mysqli_query($connection, "SELECT * FROM user");
if(empty($checktable)) {
    $sql = "CREATE TABLE Members (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(256) NOT NULL UNIQUE KEY,
    password VARCHAR(256) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
$checktable = mysqli_query($connection, $sql);
}

/*
$con = new mysqli('localhost', $username, $password, $dbname);
if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
echo 'Success... ' . $con->host_info . "\n";
*/
?>
