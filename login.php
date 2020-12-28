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

<div class="container" style="max-width:80%;">
<h5 class="text-center">
<small class="text-muted">Bentornato, compila con i tuoi <abbr title="Netflox.it">dati</abbr> per entrare, oppure vai nella pagina di <a href="registrationform.php"/> Registrazione</a>. </small>
</h5>
<br/>

<?php
if (isset($_POST['submit'])) {

function checkUser($email, $password){
    
include'dbcon.php';
    
$query = "SELECT password FROM Members WHERE email='$email'";
$result= mysqli_query($connection, $query);
//cerco la password cifrata corrispondente all'email e la salvo in userCP
$userCP = $result->fetch_assoc();

//controllo se la password è corretta
    if(password_verify($password, $userCP['password'])){
            echo "Benvenuto!\n";
            echo "SID: " . session_id() . "\n";
            $_SESSION['login']=1;
        header('Location: index.php');
        }
        else {
printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> Email o password errati.</h3></div> ");
            unset($_SESSION['login']);
        }

    } checkUser($_POST['email'], $_POST['pass']);    
 }
?> 
  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form1Example1" name="email" class="form-control" placeholder="Inserisci email" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form1Example2" name="pass" class="form-control" placeholder="Inserisci password" />
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          value=""
          id="form1Example3"
          checked
        />
<label class="form-check-label" for="form1Example3"> Ricordami </label>
      </div>
    </div>

    <div class="col" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <!-- Simple link -->
      <a href="#!">Password Dimenticata?</a>
    </div>
  </div>
  

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recupera Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
Se non ricordi la password puoi recuperarla, inserisci qui sotto la tua email e ti invieremo una nuova password:
       <br/><br/>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>



  <!-- Submit button -->
    <div class="d-grid gap-2 col-3 mx-auto">
<button type="submit" class="btn btn-primary btn-block" name="submit" value="login">Entra</button>
    </div>
</form>

</div>
<br/>

<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="bs/js/bootstrap.min.js"></script>

</body>
</html>

