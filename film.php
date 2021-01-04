<?php
// start a session
session_start();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="css/style.css">-->
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Netflox.it</title>
</head>
<body>

<?php
include 'header.php';
?>

<div class="container">


<div class="row row-cols-1 row-cols-md-4 g-4">

<?php
include'dbcon.php';
$query="SELECT idfilm FROM Films ORDER by ID DESC";
$result=mysqli_query($connection, $query);
while($row = $result->fetch_assoc()) {

$_GET['imdb'] = $row['idfilm'];
include"filmdata.php";
?>

  <div class="col">
    <div class="card">
      <img src="<?php echo $obj["Poster"]; ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $obj["Title"]; ?></h5>
        <p class="card-text"><?php echo $obj["Genre"]; ?></p>
      </div>
    </div>
  </div>

<?php
  }
?>
</div>



</div>
<br/>

<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="bs/js/bootstrap.min.js"></script>

</body>
</html>

