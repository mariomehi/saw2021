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
  <link rel="shortcut icon" href="img/favicon.ico" />
  <!--<link rel="stylesheet" href="css/style.css">-->
  <link rel="stylesheet" href="bs/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <title>Netflox.it</title>
</head>

<body>

  <?php
  include 'navbar.php';
  ?>
  <br />
  <div class="container">

    <?php
    if (isset($_SESSION['login'])) {
      $userid = $_SESSION['login'];

      include 'dbcon.php';
      $queryid = "SELECT * FROM Members WHERE id='$userid'";
      $resultid = mysqli_query($connection, $queryid);
      $userexist = $resultid->fetch_assoc();

      if (isset($_POST['submit'])) {

        if (isset($_POST["oldpas"]) || isset($_POST["newpass"]) || isset($_POST["newconfirm"])) {


          $oldpass      = trim($_POST["oldpass"]);
          $newpass      = trim($_POST["newpass"]);
          $newconfirm   = trim($_POST["newconfirm"]);

          if (password_verify($oldpass, $userexist['password'])) {

            if ($newpass != $newconfirm) {
              echo "<div class='alert alert-warning' role='alert'>
                  Passwords don't match!</div>";
            } else {

              $newpasshash = password_hash($newpass, PASSWORD_DEFAULT);
              $queryupdatepass = "UPDATE Members SET password='$newpasshash' WHERE id='$userid'";
              if (mysqli_query($connection, $queryupdatepass)) {
                echo "<div class='alert alert-success' role='alert'>
              Password changed successfully!</div>";
              }
            }
          } else {
            echo "<div class='alert alert-warning' role='alert'>
                  Ops, something wrong!</div>";
          }
        }
      }
    ?>

      <h5 class="text-center">
        <small class="text-muted">Welcome <strong><?php echo $userexist['firstname'] ?></strong>, in this page you can modify your password. </small>
      </h5>

      <div class="row">
        <div class="col-12"><br /></div>
        <div class="col-3 border border-1 rounded-1">
          <ul class="list-group list-group-flush" style="padding-top:50px;">
            <br /><br />
            <li class="list-group-item"><i class="fas fa-address-card"></i> <a href="show_profile.php" class="link-secondary">Profile</a></li>
            <li class="list-group-item"><i class="fas fa-key"></i> <a href="modify_pass.php" class="link-secondary">Password</a></li>
          </ul>
        </div>


        <div class="col-1"></div>
        <div class="col-8 border border-1 rounded-1">

          <br />
          <form action="modify_pass.php" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" placeholder="Your email: <?php echo $userexist['email'] ?>" readonly />
              <div id="emailerror" class="text-muted"></div>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" name="oldpass" class="form-control" placeholder="*Insert actual password" required />
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" name="newpass" class="form-control" placeholder="*Insert new password" pattern="[A-Za-z0-9]{8,}" title="only letters and numbers, minimum 8 characters" required />
            </div>

            <!-- ConfirmPassw input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" name="newconfirm" class="form-control" placeholder="*Confirm new password" pattern="[A-Za-z0-9]{8,}" title="only letters and numbers, minimum 8 characters" required />
            </div>

            <br />
            <!-- Submit button -->
            <div class="d-grid gap-2 col-3 mx-auto">
              <button type="submit" class="btn btn-primary btn-block mb-4" value="update" name="submit">Update Password</button>
            </div>
          </form>
          <br />

        <?php
      } else
        printf("\n <br/><div class=\"alert alert-warning\" role=\"alert\"><h3> 
You are not logged in.</h3></div> ");
        ?>

        </div>
      </div>
  </div>
  <br />

  <?php
  include 'footer.php';
  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="bs/js/bootstrap.min.js"></script>

</body>

</html>