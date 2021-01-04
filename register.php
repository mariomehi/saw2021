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

<?php
if (isset($_SESSION['login']))
printf("\n <div class='container'> <div class='alert alert-warning' role='alert'><h3> Sei già registrato.</h3></div></div> ");
else {
?>

<div class="container">
<?php
if (isset($_POST['submit'])) {

if (!isset($_POST["firstname"]) || !isset($_POST["lastname"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["confirm"])) {
    echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Alcuni campi non sono compilati!</h3></p> </div>";
    
} else {

$firstname = trim($_POST["firstname"]);
$lastname  = trim($_POST["lastname"]);
$email     = trim($_POST["email"]);
$pass      = trim($_POST["pass"]);
$confirm   = trim($_POST["confirm"]);

if (empty($firstname) || empty($lastname) || empty($email) || empty($pass) || empty($confirm)) {
    echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Alcuni campi sono mancanti! </h3></p> </div>";
    echo "</div>";
} 

else {

// mandatory data have been sent
$error = "";

// check email format
if (!$email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
    $error .= "<p>Ricontrolla l'email perfavore</p>";
}

// check if passwords match
// other checks can be performed on passwords, for example minimal length
if ($pass != $confirm) {
    $error .= "<p>Password non coincidono!</p>";
}

// if problems with input
if ($error) {
    echo 
"<div class=\"alert alert-warning\" role=\"alert\"><h3> $error </h3></div>";
}
 else {

include'dbcon.php';

$CP = password_hash($pass, PASSWORD_DEFAULT);
$firstname = mysqli_real_escape_string($connection, $firstname);
$lastname = mysqli_real_escape_string($connection, $lastname);
$email = mysqli_real_escape_string($connection, $email);

$query="INSERT INTO Members (firstname,lastname,email,password) VALUES ('$firstname','$lastname','$email','$CP')"; 

$query2="SELECT email FROM Members WHERE email='$email'";
$result2=mysqli_query($connection, $query2);
$userexist = $result2->fetch_assoc();

if ($userexist["email"]==$email) {
    printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3>
        Questa email è giò in uso. </h3></div> ");
    
 } else {

    if (mysqli_query($connection, $query)) {
printf("\n <div class=\"alert alert-success\" role=\"alert\"><h3>
        La Registrazione è andata a buon fine. <br/> Verrai reindirizzato tra 5 secondi alla Homepage! </h3></div> ");
        header( "Refresh:5; url=index.php", true, 303);
    }
    else {

printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3>
        Qualcosa è andato storto! </h3></div> ");
    }
}

    mysqli_close($connection);
    }
    }
    }
    }
?>


<h5 class="text-center">
<small class="text-muted">Benvenuto su <abbr title="Netflox.it">Netflox</abbr>, compila tutti i campi per registrarti al sito, oppure se sei già registrato vai alla pagina di <a href="login.php"/>Login</a>.</small>
</h5>
<br/>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
  <div class="row mb-4">
    <div class="col">
   <!-- Firstname input -->
      <div class="form-outline">
        <input type="text" id="form3Example1" name="firstname" class="form-control" placeholder="*Inserisci nome" pattern="[A-Za-z]+" title="solo lettere" required/>
      </div>
    </div>
   <!-- Lastname input -->
    <div class="col">
      <div class="form-outline">
        <input type="text" id="form3Example2" name="lastname"​ class="form-control" placeholder="*Inserisci cognome" pattern="[A-Za-z]+" title="solo lettere" required/>
      </div>
    </div>
  </div>
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="email" name="email" onchange="checkemail('checkemail.php');" class="form-control" placeholder="*Inserisci email" required/> <div id="emailerror" class="text-muted"></div>
  </div>
  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form3Example4" name="pass" class="form-control" placeholder="*Inserisci password" pattern="[A-Za-z0-9]{8,}" title="solo lettere e numeri minimo 8 caratteri" required/>
  </div>
  <!-- ConfirmPassw input -->
    <div class="form-outline mb-4">
    <input type="password" id="form3Example4" name="confirm" class="form-control" placeholder="*Conferma password" pattern="[A-Za-z0-9]{8,}" title="solo lettere e numeri minimo 8 caratteri" required/>
  </div>
  <!-- Submit button -->
      <div class="d-grid gap-2 col-3 mx-auto">
  <button type="submit" class="btn btn-primary btn-block mb-4" value="register" name="submit">Registrati</button>
      </div>
</form>

<script src="js/jquery-3.5.1.min.js"></script>
<script>
function checkemail(url) {
    let usermail = document.getElementById("email").value;
    console.log(usermail);
    $.post(url, { email: usermail }, function(data, status) {
    console.log(data);
        if (status == "success") {
            if (data == "ko")
document.getElementById("emailerror").innerHTML = " <mark> email esiste già</mark>";
                else document.getElementById("emailerror").innerHTML="";
            } else {
            alert("qualcosa è andato storto");
            }
    });
}
</script>

</div>
<?php
}
?>

<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="bs/js/bootstrap.min.js"></script>

</body>
</html>

