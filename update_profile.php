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
<?php
if (isset($_SESSION['login'])) {
if (isset($_POST['submit'])) {

$userid=$_SESSION['login'];
$firstname = trim($_POST["firstname"]);
$lastname  = trim($_POST["lastname"]);
$email     = trim($_POST["email"]);

include'dbcon.php';

$queryid ="UPDATE Members SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id='$userid'";

if (mysqli_query($connection, $queryid)) {
  echo "<div class=\"alert alert-success\" role=\"alert\"><h3>La modifica è andata a buon fine. <br/> Verrai reindirizzato tra 5 secondi al tuo profilo! </h3></div>";
  header( "Refresh:5; url=show_profile.php?id=$userid", true, 303);
} else {
  echo "<div class=\"alert alert-warning\" role=\"alert\"><h3>Errore nella modifica. <br/> Verrai reindirizzato tra 5 secondi al tuo profilo! </h3></div>";
  header( "Refresh:5; url=show_profile.php?id=$userid", true, 303);
}
?>
<br/>

<?php
    }
}else 
printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> Accesso non effetuato.</h3></div> ");
?>

</div>

<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="bs/js/bootstrap.min.js"></script>

</body>
</html>
