<?php
// start a session
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
  <link href="css/mystyle.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>

<body>

  <?php
  include 'navbar.php';
  ?>

  <div class="container">
    <?php
    if (!isset($_GET['id'])) {
      echo "<br/><div class=\"alert alert-warning\" role=\"alert\"><h3>
  Movie id is not set.<br/> You will be redirected to the homepage in 5 seconds. </h3></div>";
      header("Refresh:5; url=index.php", true, 303);
    } else {
      $idfilm = $_GET['id'];
    ?>
      <br />

      <div class="card mb-3">
        <?php
        include 'dbcon.php';
        $query = "SELECT * FROM Films WHERE id=$idfilm";
        $result = mysqli_query($connection, $query);
        while ($row = $result->fetch_assoc()) {

          $_GET['imdb'] = $row['idfilm'];
          include "ajax/filmdata.php";
        ?>

          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?php echo $obj["Poster"]; ?>" alt="<?php echo $obj["Title"];?>" width="100%">
            </div>
            <div class="col-md-8">
              <div class="card-body">

                <button type="button" class="btn btn-outline-warning" style="width:100%; height:200px; border-color: #ED8A1C;"><i class="far fa-play-circle"></i>
                  <br />
                  (work in progress)
                </button>

                <br /><br />
                <h5 class="card-title"><?php echo $obj["Title"];
                                        echo " (";
                                        echo $row['year'];
                                        echo ")"; ?></h5>

                <h6 class="card-subtitle mb-2 text-muted"><?php echo $obj["Director"]; ?> - <?php echo $obj["Runtime"]; ?> | <?php echo $obj["Rated"]; ?></h6>

                <p class="card-text">
                  <?php echo $obj["Plot"]; ?></p>
                <p class="card-text"><small class="text-muted">
                    <?php echo $obj["Genre"]; ?>
                    <br />
                    Actors: <?php echo $obj["Actors"]; ?>
                    <br />
                    Country: <?php echo $obj["Country"]; ?>
                    <br />
                    Release date: <?php echo $obj["Released"]; ?>
                    <br />
                    Awards: <?php echo $obj["Awards"]; ?>
                    <br />
                  </small></p>



                <div class="content">

                  <?php

                  if (isset($_SESSION['login']))
                    $userid = $_SESSION['login'];

                  $idfil = $row['id'];

                  // User rating
                  if (!isset($_SESSION['login'])) {
                    $rating = "Register to rate this movie";
                  } else {
                    $queryu = "SELECT * FROM Rates WHERE idfilm=" . $idfil . " and idmember=" . $userid;
                    $userresultu = mysqli_query($connection, $queryu);
                    $fetchRating = mysqli_fetch_array($userresultu);
                    $rating = $fetchRating['rating'];

                    if ($rating <= 0) {
                      $rating = "No rating yet.";
                    }
                  }

                  // Count rates
                  $queryc = "SELECT COUNT(*) AS cntpost FROM Rates WHERE idfilm=" . $idfil;
                  $resultc = mysqli_query($connection, $queryc);
                  $fetchdatac = mysqli_fetch_array($resultc);
                  $countc = $fetchdatac['cntpost'];

                  // get average
                  $querya = "SELECT ROUND(AVG(rating),1) as averageRating FROM Rates WHERE idfilm=" . $idfil;
                  $avgresulta = mysqli_query($connection, $querya);
                  $fetchAveragea = mysqli_fetch_array($avgresulta);
                  $averageRating = $fetchAveragea['averageRating'];

                  if ($averageRating <= 0) {
                    $averageRating = "No rating yet.";
                  }
                  ?>


                  <span id='avgrating' style="font-size:20px; padding-left:45%;"><?php echo $averageRating;
                                                                echo " (" . $countc . ")"; ?></span>


                  <!-- Rating -->
                  <fieldset class="score" id="score" onchange="checkrate('ajax/rating_ajax.php',<?php echo $idfil; ?>);">
                    <legend>Score:</legend>

                    <input type="radio" id="score-5" name="score" value="5" />
                    <label title="5 stars" for="score-5">5 stars</label>

                    <input type="radio" id="score-4" name="score" value="4" />
                    <label title="4 stars" for="score-4">4 stars</label>

                    <input type="radio" id="score-3" name="score" value="3" />
                    <label title="3 stars" for="score-3">3 stars</label>

                    <input type="radio" id="score-2" name="score" value="2" />
                    <label title="2 stars" for="score-2">2 stars</label>

                    <input type="radio" id="score-1" name="score" value="1" />
                    <label title="1 stars" for="score-1">1 stars</label>
                  </fieldset>

                  <div style='clear: both;'></div>

                  <span style="padding-left:40%;">
                  Your Rate: <span id='yourating' style="font-weight: bold;"><?php echo $rating; ?></span>
                  </span>
                  <br />


                  <!-- Set rating -->
                  <?php
                  if (isset($_SESSION['login'])) {
                  ?>
                    <script src="js/jquery-3.5.1.min.js"></script>
                    <script>
                      function checkrate(url, idfilm) {

                        let tip = document.getElementsByName('score');
                        var tipValue;
                        for (var i = 0; i < tip.length; i++) {
                          if (tip[i].type === "radio" && tip[i].checked) {
                            tipValue = tip[i].value;
                          }
                        }

                        $.post(url, {
                          idfilm: idfilm,
                          rating: tipValue
                        }, function(data, status) {

                          if (status == "success") {

                            document.getElementById('yourating').innerHTML = tipValue;

                            var obj = JSON.parse(data);
                            document.getElementById("avgrating").innerHTML = obj.averageRating + " (" + obj.count + ")";

                          }
                        });
                      }
                    </script>
                  <?php
                  }
                  ?>

                </div>



              </div>
            </div>
          </div>


      <?php
        }
      }
      ?>
      </div>



  </div>
  <br />

  <?php
  include 'footer.php';
  ?>

</body>

</html>
