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
  include "navbar.php";

  if (isset($_SESSION['login'])) {
    printf("\n <br/><div class='container'> <div class='alert alert-warning' role='alert'><h3> You are already logged in.</h3></div></div> ");
  } else {
  ?>

    <br />
    <div class="container" style="max-width:80%;">
      <h5 class="text-center">
        <small class="text-muted">Welcome, fill up the login form, or <a href="register.php" /> Register</a> if you are not registered.</small>
      </h5>
      <br />

      <?php
      if (isset($_POST['submit'])) {
      
          $email     = trim(htmlspecialchars($_POST["email"]));
          $pass      = trim($_POST["pass"]);

        function checkUser($email, $password)
        {   

          include 'dbcon.php';

          $query = "SELECT * FROM Members WHERE email='$email'";
          $result = mysqli_query($connection, $query);
          //searching encrypted password and saving it in userData
          $userData = $result->fetch_assoc();
          $userID = $userData['id'];

          //checking if password is correct
          if (password_verify($password, $userData['password'])) {

            $_SESSION['login'] = $userID;

            if ($userData['role'] == "admin")
              $_SESSION['admin'] = $userID;
              
            header("Location: index.php");
            echo "</div>";
              include 'footer.php';
              echo "</body>
              </html>";
            exit;

          } else {
            printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> Email or password is incorrect.</h3></div> ");
            unset($_SESSION['login']);
          }
        }
        checkUser($_POST['email'], $_POST['pass']);
      }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="form1Example1" name="email" class="form-control" placeholder="Insert email" required />
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="form1Example2" name="pass" class="form-control" placeholder="Insert password" required />
        </div>

        <!-- Submit button -->
        <div class="d-grid gap-2 col-3 mx-auto">
          <button type="submit" class="btn btn-primary btn-block" name="submit" value="login">Enter</button>
        </div>
      </form>

    </div>
    <br />

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
