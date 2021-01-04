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
$userid=$_SESSION['login'];

include'dbcon.php';
$queryid="SELECT * FROM Members WHERE id='$userid'";
$resultid=mysqli_query($connection, $queryid);
$userexist = $resultid->fetch_assoc();
?>

<h5 class="text-center">
<small class="text-muted">Ciao <abbr title="Ti chiami cosi no?"><?php echo $userexist['firstname'] ?></abbr>, in questa pagina puoi modificare i tuoi dati. </small>
</h5>
<br/>
<form action="update_profile.php" method="POST">
  <div class="row mb-4">
    <div class="col">
   <!-- Firstname input -->
      <div class="form-outline">
        <input type="text" id="validationServer01" name="firstname" class="form-control is-valid" placeholder="*Inserisci nome" value="<?php echo $userexist['firstname'] ?>" pattern="[A-Za-z]+" title="solo lettere" required/>
      </div>
    </div>
   <!-- Lastname input -->
    <div class="col">
      <div class="form-outline">
        <input type="text" id="validationServer02" name="lastname" class="form-control is-valid" placeholder="*Inserisci cognome" value="<?php echo $userexist['lastname'] ?>" pattern="[A-Za-z]+" title="solo lettere" required/>
      </div>
    </div>
  </div>
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="email" name="email" onchange="checkemail('checkemail.php');" class="form-control is-valid" placeholder="*Inserisci email" value="<?php echo $userexist['email'] ?>" required/> <div id="emailerror" class="text-muted"></div>
  </div>

  <!-- Submit button -->
      <div class="d-grid gap-2 col-3 mx-auto">
  <button type="submit" class="btn btn-primary btn-block mb-4" value="update" name="submit">Modifica</button>
      </div>
</form>
<br/>

<?php
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
