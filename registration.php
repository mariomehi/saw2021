<!DOCTYPE html>
<html lang="it">
    <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="css/style.css">-->
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Netflox.it</title>
</head>

<body>

<?php
include 'header.php';
?>

<div class="container">
<?php
$ritorna=header( "Refresh:5; url=registrationform.php", true, 303);

if (!isset($_POST["firstname"]) || !isset($_POST["lastname"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["confirm"])) {
    echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Alcuni campi non sono compilati! <br/>Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!</h3></p>\n 
    </div>";
    echo "</div>";
    include 'footer.php';
    echo "</body>\n</html>";
    exit();
    $ritorna;
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
    $ritorna;
}

// mandatory data have been sent
$error = "";

// check email format
if (!$email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
    $error .= "<p>Ricontrolla l'email perfavore</p>\n Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!";
    $ritorna;
}

// check if passwords match
// other checks can be performed on passwords, for example minimal length
if ($pass != $confirm) {
    $error .= "<p>Password non coincidono!</p>\n Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!";
    $ritorna;
}

// if problems with input
if ($error) {
    echo 
"<div class=\"alert alert-warning\" role=\"alert\"><h3> $error </h3></div>";
    echo "</div>";
    include 'footer.php';
    echo "</body>\n</html>";
    exit();
    $ritorna;
}

$CP = password_hash($pass, PASSWORD_DEFAULT);

$link = mysqli_connect('localhost', 'mario', 'mario', 'saw2020');

if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
}

//echo "\n" . 'Success... ' . mysqli_get_host_info($link) . "\n";

$firstname = mysqli_real_escape_string($link, $firstname);
$lastname = mysqli_real_escape_string($link, $lastname);
$email = mysqli_real_escape_string($link, $email);

$query="INSERT INTO user (firstname,lastname,email,password) VALUES ('$firstname','$lastname','$email','$CP')"; 

    if (mysqli_query($link, $query)) {
        printf("%d Row inserted.\n", mysqli_affected_rows($link));
        header( "Refresh:5; url=index.php", true, 303);
    }
    else {
       
        printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3>
        Questo email risulta già registrata! <br/> Verrai reindirizzato tra 5 secondi alla pagina di Registrazione!
        </h3></div></div>
       ");
        header( "Refresh:5; url=registrationform.php", true, 303);
    }

    mysqli_close($link);
?>


<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="bs/js/bootstrap.min.js"></script>

</body>
</html>

