<?php
// start a session
session_start();
if (isset($_SESSION['admin'])) {
  
    include'../dbcon.php';
    $query="SELECT * FROM Films";
    $result=mysqli_query($connection, $query);

    $string="{ \"data\": [";
    while($row = $result->fetch_assoc()) {
    /*
    $string=$string."[". "\"" .$row['id']."\",\"".$row['idfilm']."\",\"".$row['title']."\",\"".$row['year']."\",\"".$row['genre']."\"],";
    }
    */

    $string=$string."[".'"'.$row['id'].'"'.','.'"'.$row['idfilm'].'"'.','.'"'.$row['title'].'"'.','.'"'.$row['year'].'"'.','.'"'.$row['genre'].'"'.','.'"'.'<a href=\'deletefilm.php?id='.$row['id'].'\''.'><i class=\'fas fa-trash-alt\'></i></a>'.'"'."],";
    }

    $string=mb_substr($string, 0, -1);
    $string=$string."]}";
    print $string;

    } else
        printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> User not authorized.</h3></div> ");
