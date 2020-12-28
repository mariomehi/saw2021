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
if (!isset($_POST["firstname"]) || !isset($_POST["lastname"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["confirm"])) {
    echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Alcuni campi non sono compilati! <br/>Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!</h3></p>\n 
    </div>";
    echo "</div>";
    include 'footer.php';
    echo "</body>\n</html>";
    exit();
    header( "Refresh:5; url=registrationform.php", true, 303);
}

$firstname = trim($_POST["firstname"]);
$lastname  = trim($_POST["lastname"]);
$email     = trim($_POST["email"]);
$pass      = trim($_POST["pass"]);
$confirm   = trim($_POST["confirm"]);

if (empty($firstname) || empty($lastname) || empty($email) || empty($pass) || empty($confirm)) {
    echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Alcuni campi sono mancanti! <br/>Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!</h3></p>\n 
    </div>";
    echo "</div>";
    include 'footer.php';
    echo "</body>\n</html>";
    exit();
    header( "Refresh:5; url=registrationform.php", true, 303);
}

// mandatory data have been sent
$error = "";

// check email format
if (!$email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
    $error .= "<p>Ricontrolla l'email perfavore</p>\n Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!";
}

// check if passwords match
// other checks can be performed on passwords, for example minimal length
if ($pass != $confirm) {
    $error .= "<p>Password non coincidono!</p>\n Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!";
}

// if problems with input
if ($error) {
    echo 
"<div class=\"alert alert-warning\" role=\"alert\"><h3> $error </h3></div>";
    echo "</div>";
    include 'footer.php';
    echo "</body>\n</html>";
    exit();
    header( "Refresh:5; url=registrationform.php", true, 303);
}

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
        Questa email è giò in uso. <br/> Verrai reindirizzato tra 5 secondi alla pagina di Registrazione! </h3></div></div> ");
    header( "Refresh:5; url=registrationform.php", true, 303);
    
 } else {

    if (mysqli_query($connection, $query)) {
printf("\n <div class=\"alert alert-success\" role=\"alert\"><h3>
        La Registrazione è andata a buon fine. <br/> Verrai reindirizzato tra 5 secondi alla Homepage! </h3></div></div> ");
        header( "Refresh:5; url=index.php", true, 303);
    }
    else {

printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3>
        Qualcosa è andato storto! <br/> Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!
        </h3></div></div> ");
        //header( "Refresh:5; url=registrationform.php", true, 303);
    }
}

    mysqli_close($connection);
?>


<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="bs/js/bootstrap.min.js"></script>

</body>
</html>