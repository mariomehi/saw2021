<?php
include "../dbcon.php";
        
if (isset($_POST['movie'])) {
        
    $namefilm = $_POST['movie'];

    $query = "SELECT * FROM Films WHERE title LIKE '%$namefilm%'";

    $result = mysqli_query($connection,$query);
    
    $string="[";
    
        while ($exist = $result->fetch_assoc()) {
        
        $_GET['imdb'] = $exist['idfilm'];
        include "filmdata.php";
        
            $string=$string."{".'"id":'.'"'.$exist['id'].'"'.','.'"title":"'.$exist['title'].'"'.','.'"poster":"'.$obj['Poster'].'"'.','.'"year":"'.$exist['year'].'"'."},";
        }
    
    if ($string!="[")
    $string=mb_substr($string, 0, -1);
    $string=$string."]";
        
    print $string;
}
