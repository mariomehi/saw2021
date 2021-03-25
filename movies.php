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
  
  <br/>
  <div class="container">
    <h3>All movies
      <?php
      if (isset($_GET['genre'])) {
        echo $_GET['genre'];
      }
      ?>
    </h3>

    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php
      include 'dbcon.php';

      if (isset($_GET['genre'])) {
        $gener = $_GET['genre'];
        $query = "SELECT * FROM Films WHERE genre LIKE '%$gener%' ORDER by ID DESC";
      } else {
        $query = "SELECT * FROM Films ORDER by title ASC";
      }
      $result = mysqli_query($connection, $query);
      while ($row = $result->fetch_assoc()) {

        $filmid = $row['id'];
        $queryavgrate = "SELECT ROUND(AVG(rating),1) as avgrate FROM Rates WHERE idfilm=" . $filmid;
        $resultavgrate = mysqli_query($connection, $queryavgrate);
        $rowavgrate = $resultavgrate->fetch_assoc();


        $_GET['imdb'] = $row['idfilm'];
        include "ajax/filmdata.php";
      ?>

        <div class="col">
        
        
          <div class="card">
          
            <div style="position: relative; text-align: center; color: white;" >
                <a href="movie.php?id=<?php echo $row["id"]; ?>">
                  <img style="width:100%;" src="<?php echo $obj["Poster"]; ?>" class="card-img-top" alt="<?php echo $obj["Title"]; ?>">
                </a>

                <div style="position: absolute; color: yellow; bottom: 0px; right: 0px; background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(0,0,0,0.5)); font-weight: bold;">
                <?php if ($rowavgrate["avgrate"] != "")
                echo "<i class='fas fa-star'></i> ".$rowavgrate['avgrate']."&nbsp;"; ?>
                </div>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo $obj["Title"]; ?></h5>
              <p class="card-text"><?php echo $obj["Genre"]; ?></p>
            </div>
          </div>
          
          
        </div>

      <?php
      }
      ?>
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
