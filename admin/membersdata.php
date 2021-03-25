<?php
// start a session
session_start();
if (isset($_SESSION['admin'])) {

    include'../dbcon.php';
    $query="SELECT id,firstname,lastname,email,role,reg_date FROM Members";
    
    $result=mysqli_query($connection, $query);

    $string="{ \"data\": [";
    while($row = $result->fetch_assoc()) {

    $string=$string."[".'"'.$row['id'].'"'.','.'"'.$row['firstname'].'"'.','.'"'.$row['lastname'].'"'.','.'"'.$row['email'].'"'.','.'"'.$row['role'].'"'.','.'"'.$row['reg_date'].'"'.','.'"'.'<a href=\'show_profile.php?id='.$row['id'].'\''.'><i class=\'fas fa-user-edit\'></i></a>'.'"'.','.'"'.'<a href=\'deletemember.php?id='.$row['id'].'\''.'><i class=\'fas fa-trash-alt\'></i></a>'.'"'."],";
    }

    $string=mb_substr($string, 0, -1);
    $string=$string."]}";
    print $string;

    } else
        printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> User not authorized.</h3></div> ");
