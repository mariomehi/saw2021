<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.ico" />
  <link rel="stylesheet" href="bs/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <title>Netflox.it</title>
</head>

<body>

<?php
  include 'dbcon.php';
  include 'navbar.php';
?>

  <div class="container">
    <?php
    if (isset($_SESSION['login'])) {
      if (isset($_POST['submit'])) {

        $userid = $_SESSION['login'];
        $firstname = trim($_POST["firstname"]);
        $lastname  = trim($_POST["lastname"]);
        $email     = trim($_POST["email"]);

        $queryid = "UPDATE Members SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id='$userid'";

        if (mysqli_query($connection, $queryid)) {
          header("Refresh:5; url=show_profile.php?id=$userid", true, 303);
          echo "<br/><div class=\"alert alert-success\" role=\"alert\"><h3>
  Updated successfully. <br/> You will be redirected to your profile in 5 seconds. </h3></div>";
          
        } else {
          header("Refresh:5; url=show_profile.php?id=$userid", true, 303);
          echo "<br/><div class=\"alert alert-warning\" role=\"alert\"><h3>
  Ops, something went wrong.<br/> You will be redirected to your profile in 5 seconds. </h3></div>";
        }
?>
        <br />

    <?php
      } else {
        header("Refresh:5; url=show_profile.php?id=$userid", true, 303);
        echo "<br/><div class=\"alert alert-warning\" role=\"alert\"><h3>
  No modification issued.<br/> You will be redirected to your profile in 5 seconds. </h3></div>";
        
      }
    } else {
      header("Refresh:5; url=index.php", true, 303);
      echo "<br/><div class=\"alert alert-warning\" role=\"alert\"><h3>
  You are not logged in.<br/> You will be redirected to the homepage in 5 seconds. </h3></div>";
      
    }
    ?>

  </div>

  <?php
  include 'footer.php';
  ?>

</body>

</html>
