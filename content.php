<br />
<div class="container">

  <h3>Top 5</h3>

  <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
    <?php
    include 'dbcon.php';

    //$queryavgrate = "SELECT ROUND(AVG(rating),1) as averageRating FROM Rates;

    $query = "SELECT Films.id, Films.title, Films.year, Films.idfilm, ROUND(AVG(Rates.rating),1) as avgrating FROM Films INNER JOIN Rates ON Rates.idfilm=Films.id GROUP BY Films.id ORDER by avgrating DESC limit 5;";
    $result = mysqli_query($connection, $query);

    while ($row = $result->fetch_assoc()) {
      $_GET['imdb'] = $row['idfilm'];
      include "ajax/filmdata.php";
    ?>

      <div class="card bg-white text-white" style="border:none;">
        <a style="text-decoration: none;" href="movie.php?id=<?php echo $row["id"]; ?>">
          <div style="background-image:url('<?php echo $obj["Poster"]; ?>'); padding-bottom: 86%; background-size: cover; background-position: center center; width: 100%; height:300px;">


            <div class="card-img-overlay" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1)); top:240px; color:white; right:5px;  left:5px;">
              <h6 class="card-title" style="position: relative; bottom: 10px; background: rgba(0, 0, 0, 0);">
                <?php echo $obj["Title"] . " (" . $obj["Year"] . ")"  ?>
              </h6>
            </div>

            <div class="ratstarfilm"><i class="fas fa-star"></i> <?php echo $row["avgrating"]; ?></div>
          </div>
        </a>

      </div>

    <?php
    }
    ?>
  </div>

<br/>
  <h3>Latest added</h3>
  <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
    <?php
    include 'dbcon.php';
    $query = "SELECT * FROM Films ORDER by ID DESC limit 5";
    $result = mysqli_query($connection, $query);

    while ($row = $result->fetch_assoc()) {
      $_GET['imdb'] = $row['idfilm'];
      include "ajax/filmdata.php";
    ?>

      <div class="card bg-white text-white" style="border:none;">
        <a href="movie.php?id=<?php echo $row["id"]; ?>">
          <div style="background-image:url('<?php echo $obj["Poster"]; ?>'); padding-bottom: 86%; background-size: cover; background-position: center center; width: 100%; height:300px;">


            <div class="card-img-overlay" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1)); top:240px; color:white; right:5px;  left:5px;">
              <h6 class="card-title" style="position: relative; bottom: 10px; background: rgba(0, 0, 0, 0);">
                <?php echo $obj["Title"] . " (" . $obj["Year"] . ")"  ?></h6>
              <p class="card-text"></p>
            </div>
          </div>
        </a>
      </div>

    <?php
    }
    ?>
  </div>


</div>

<br />
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="js/slider.js"></script>
