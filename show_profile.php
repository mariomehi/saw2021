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
    ?>

      <h5 class="text-center">
        <small class="text-muted">Welcome <strong><?php echo $userexist['firstname'] ?></strong>, in this page you can modify your data. </small>
      </h5>

      <div class="row">
        <div class="col-12"><br /></div>
        <div class="col-2 border border-1 rounded-1">
          <ul class="list-group list-group-flush" style="padding-top:50px;">
            <br /><br />
            <li class="list-group-item"><i class="fas fa-address-card"></i> <a href="show_profile.php" class="link-secondary">Profile</a></li>
            <li class="list-group-item"><i class="fas fa-key"></i> <a href="modify_pass.php" class="link-secondary">Password</a></li>
          </ul>
        </div>


        <div class="col-1"></div>
        <div class="col-9 border border-1 rounded-1">

          <br />
          <form action="update_profile.php" method="POST">
            <div class="row mb-4">
              <div class="col">
                <!-- Firstname input -->
                <div class="form-outline">
                  <input type="text" id="validationServer01" name="firstname" class="form-control is-valid" placeholder="*Insert firstname" value="<?php echo $userexist['firstname'] ?>" pattern="[A-Za-z]+" title="solo lettere" required />
                </div>
              </div>
              <!-- Lastname input -->
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="validationServer02" name="lastname" class="form-control is-valid" placeholder="*Insert lastname" value="<?php echo $userexist['lastname'] ?>" pattern="[A-Za-z]+" title="solo lettere" required />
                </div>
              </div>
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" onchange="checkemail('checkemail.php');" class="form-control is-valid" placeholder="*Insert email" value="<?php echo $userexist['email'] ?>" required />
              <div id="emailerror" class="text-muted"></div>
            </div>

            <input class="form-control" type="text" placeholder="Role: <?php echo $userexist['role'] ?>" aria-label="readonly input example" readonly>


            <br />
            <!-- Submit button -->
            <div class="d-grid gap-2 col-3 mx-auto">
              <button type="submit" class="btn btn-primary btn-block mb-4" value="update" name="submit">Update</button>
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