<?php
session_start();
ob_start();
unset($_SESSION['login']);
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
  include 'navbar.php';
  ?>


  <?php
  if (isset($_SESSION['login']))
    printf("\n <br/><div class='container'> <div class='alert alert-warning' role='alert'><h3> You are already registered.</h3></div></div> ");
  else {
  ?>
<br/>
    <div class="container">
      <?php
      if (isset($_POST['submit'])) {

        if (!isset($_POST["firstname"]) || !isset($_POST["lastname"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["confirm"])) {
          echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Some fields are missing!</h3></p> </div>";
        } else {
          //Removes whitespace & special chars
          $firstname = trim(htmlspecialchars($_POST["firstname"]));
          $lastname  = trim(htmlspecialchars($_POST["lastname"]));
          $email     = trim(htmlspecialchars($_POST["email"]));
          $pass      = trim($_POST["pass"]);
          $confirm   = trim($_POST["confirm"]);

          if (empty($firstname) || empty($lastname) || empty($email) || empty($pass) || empty($confirm)) {
            echo "
    <div class=\"alert alert-warning\" role=\"alert\">
    <p><h3>Some fields are empty! </h3></p> </div>";
            echo "</div>";
          } else {

            $error = "";

            // check email format
            if (!$email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
              $error .= "<p>Email not valid</p>";
            }

            // check if passwords match
            // other checks can be performed on passwords, for example minimal length
            if ($pass != $confirm) {
              $error .= "<p>Passwords don't match</p>";
            }

            // if problems with input
            if ($error) {
              echo
              "<div class=\"alert alert-warning\" role=\"alert\"><h3> $error </h3></div>";
            } else {

              include 'dbcon.php';

              $CP = password_hash($pass, PASSWORD_DEFAULT);
              $firstname = mysqli_real_escape_string($connection, $firstname);
              $lastname = mysqli_real_escape_string($connection, $lastname);
              $email = mysqli_real_escape_string($connection, $email);

              $query = "INSERT INTO Members (firstname,lastname,email,password) VALUES ('$firstname','$lastname','$email','$CP')";

              $query2 = "SELECT email FROM Members WHERE email='$email'";
              $result2 = mysqli_query($connection, $query2);
              $userexist = $result2->fetch_assoc();

              if ($userexist['email'] == $email) {
                printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> 
                This email is already being used. </h3></div> ");
              } else {

                if (mysqli_query($connection, $query)) {
                  printf("\n <div class=\"alert alert-success\" role=\"alert\"><h3>
        Registered successfully. <br/> You will be redirected to the homepage in 5 seconds! </h3></div> ");
                  header("Refresh:5; url=index.php", true, 303);
                } else {

                  printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3>
        Ops, something went wrong! </h3></div> ");
                }
              }

              mysqli_close($connection);
            }
          }
        }
      }
      ?>

      <br />
      <h5 class="text-center">
        <small class="text-muted">Welcome to Netflox, fill up the registration form, or if you are already registered go to the <a href="login.php" />Login</a> page.</small>
      </h5>
      <br />
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="row mb-4">
          <div class="col">
            <!-- Firstname input -->
            <div class="form-outline">
              <input type="text" id="form3Example1" name="firstname" class="form-control" placeholder="*Insert firstname" pattern="[A-Za-z]+" title="only letters" required />
            </div>
          </div>
          <!-- Lastname input -->
          <div class="col">
            <div class="form-outline">
              <input type="text" id="form3Example2" name="lastname" ​ class="form-control" placeholder="*Insert lastname" pattern="[A-Za-z]+" title="only letters" required />
            </div>
          </div>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="email" name="email" onchange="checkemail('ajax/checkemail.php');" class="form-control" placeholder="*Insert email" required />
          <div id="emailerror" class="text-muted"></div>
        </div>
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="form3Example4" name="pass" class="form-control" placeholder="*Insert password" pattern="[A-Za-z0-9]{8,}" title="only letters and numbers, minimum 8 characters" required />
        </div>
        <!-- ConfirmPassw input -->
        <div class="form-outline mb-4">
          <input type="password" id="form3Example4" name="confirm" class="form-control" placeholder="*Confirm password" pattern="[A-Za-z0-9]{8,}" title="only letters and numbers, minimum 8 characters" required />
        </div>
        <!-- Submit button -->
        <div class="d-grid gap-2 col-3 mx-auto">
          <button type="submit" class="btn btn-primary btn-block mb-4" value="register" name="submit">Register</button>
        </div>
      </form>

      <script src="js/jquery-3.5.1.min.js"></script>
      <script>
        function checkemail(url) {
          let usermail = document.getElementById("email").value;
          console.log(usermail);
          $.post(url, {
            email: usermail
          }, function(data, status) {
            console.log(data);
            if (status == "success") {
              if (data == "ko")
                document.getElementById("emailerror").innerHTML = " <mark>email already exist!</mark>";
              else document.getElementById("emailerror").innerHTML = "";
            } else {
              alert("something went wrong!");
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
