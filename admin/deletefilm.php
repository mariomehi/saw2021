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
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">

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
                        <a href="../index.php" class="article">Back to site</a>
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

                <h2>Delete Film</h2>
                <br />

                <?php
                if (isset($_SESSION['login'])) {
                    $filmid = $_GET['id'];

                    include '../dbcon.php';

                    $queryid = "SELECT * FROM Films WHERE id='$filmid'";
                    $resultid = mysqli_query($connection, $queryid);


                    if (mysqli_num_rows($resultid) <= 0) {
                        header("Refresh:5; url=films.php", true, 303);
                        echo "<div class=\"alert alert-warning\" role=\"alert\"><h3>
        Movie doesn't exist<br/> You will be redirected to movies in 5 seconds</h3></div> ";
                    } else {

                        $query = "DELETE FROM Films WHERE id='$filmid'";
                        if (mysqli_query($connection, $query)) {
                            header("Refresh:5; url=films.php", true, 303);
                            echo "
<div class=\"alert alert-success\" role=\"alert\"><h3>
        Deleted successfully<br/> You will be redirected to movies in 5 seconds</h3></div> ";
                        } else {
                            header("Refresh:5; url=films.php", true, 303);
                            echo "<div class=\"alert alert-warning\" role=\"alert\"><h3>
        Ops, something went wrong<br/> You will be redirected to movies in 5 seconds</h3></div> ";
                        }
                    }

                    mysqli_close($connection);
                }
                ?>

                <div class="line"></div>

            </div>
        </div>


    <?php
    } else
        printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> User not authorized.</h3></div> ");
    ?>
</body>

</html>
