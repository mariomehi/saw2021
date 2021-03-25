<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Netflox.it Admin</title>

  <!-- Bootstrap CSS CDN -->
  <link href="../bs/css/bootstrap.min.css" rel="stylesheet">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

  <?php
  // start a session
  session_start();

  if (isset($_SESSION['admin'])) {
  ?>

    <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar">
        <div class="sidebar-header">
          <h3>Netflox.it Admin</h3>
          <strong>NF</strong>
        </div>
        <ul class="list-unstyled components">
          <li>
            <a href="index.php">
              <i class="fas fa-home"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a href="members.php">
              <i class="fas fa-users"></i>
              Members
            </a>
          </li>
          <li>
            <a href="films.php">
              <i class="fas fa-film"></i>
              Movies
            </a>
          </li>
        </ul>
        <ul class="list-unstyled CTAs">
          <li>
            <a href="../index.php" class="article"> <i class="fas fa-hand-point-left"></i> Back to site</a>
          </li>
        </ul>
      </nav>


      <!-- Page Content  -->
      <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-info">
              <i class="fas fa-align-left"></i>
              <span></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
          </div>
        </nav>

        <h2>Admin Home</h2>
        <br />




        <div class="container">
          <div class="row">
            <div class="col-sm">
              <h4>Latest members</h4>

              <?php
              include '../dbcon.php';
              $query = "SELECT * FROM Members order by id DESC";
              $result = mysqli_query($connection, $query);

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                  echo $row["id"] . " " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                }
              } else {
                echo "0 results";
              }
              ?>

            </div>
            <div class="col-sm">
              <h4>Latest movies</h4>
              <?php
              include '../dbcon.php';
              $query2 = "SELECT * FROM Films order by id DESC";
              $result2 = mysqli_query($connection, $query2);

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row2 = mysqli_fetch_assoc($result2)) {
                  echo $row2["id"] . " " . $row2["title"] . " (" . $row2["year"] . ")<br>";
                }
              } else {
                echo "0 results";
              }
              mysqli_close($connection);
              ?>

            </div>
            <div class="col-sm">
              <h4>Latest rates</h4>
              <?php
              include '../dbcon.php';
              
              $querylatestrates = "SELECT Films.id, Films.title, Rates.rating, Rates.idmember, Members.firstname 
              FROM Films 
              JOIN Rates ON Rates.idfilm=Films.id 
              JOIN Members ON Rates.idmember=Members.id 
              ORDER by Rates.id DESC;";
              
              $resultlatestrates = mysqli_query($connection, $querylatestrates);

    while ($rowlatrat = $resultlatestrates->fetch_assoc()) {
                  echo $rowlatrat["title"] . " rated " . $rowlatrat["rating"] . " by " .$rowlatrat["firstname"].  " <br>";
                }

              mysqli_close($connection);
              ?>
            </div>
          </div>
        </div>

        <div class="line"></div>

      </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });
      });
    </script>

  <?php
  } else
    printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> User not authorized.</h3></div> ");
  ?>
</body>

</html>
