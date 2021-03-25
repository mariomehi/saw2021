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
                        <a href="../index.php" class="article">Torna al Sito</a>
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

                <h2>Show Profile</h2>
                <br />

                <div class="container">

                    <?php
                    if (isset($_SESSION['login'])) {
                        $userid = $_GET['id'];

                        include '../dbcon.php';
                        $queryid = "SELECT * FROM Members WHERE id='$userid'";
                        $resultid = mysqli_query($connection, $queryid);
                        $userexist = $resultid->fetch_assoc();
                    ?>

                        <h5 class="text-center">
                            <small class="text-muted">Welcome <?php echo $userexist['firstname'] ?>, in this page you can modify your data. </small>
                        </h5>
                        <br />
                        <form action="update_profile.php?id=<?php echo $userid ?>" method="POST">
                            <div class="row mb-4">
                                <div class="col">
                                    <!-- Firstname input -->
                                    <div class="form-outline">
                                        <input type="text" id="validationServer01" name="firstname" class="form-control is-valid" placeholder="*Insert firstname" value="<?php echo $userexist['firstname'] ?>" pattern="[A-Za-z]+" title="only letters" required />
                                    </div>
                                </div>
                                <!-- Lastname input -->
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="validationServer02" name="lastname" class="form-control is-valid" placeholder="*Insert lastname" value="<?php echo $userexist['lastname'] ?>" pattern="[A-Za-z]+" title="only letters" required />
                                    </div>
                                </div>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" onchange="checkemail('checkemail.php');" class="form-control is-valid" placeholder="*Insert email" value="<?php echo $userexist['email'] ?>" required />
                                <div id="emailerror" class="text-muted"></div>
                            </div>


                            <?php
                            if (isset($_SESSION['admin'])) {
                            ?>
                                <select class="form-select" name="roleselect" aria-label="Default select example">
                                    <option selected value="<?php echo $userexist['role'] ?>">Role: <?php echo $userexist['role'] ?></option>
                                    <?php if ($userexist['role'] == "admin") { ?>
                                        <option value="member">member</option>
                                    <?php } else { ?>
                                        <option value="admin">admin</option>
                                    <?php } ?>

                                </select>
                            <?php
                            } else {
                            ?>
                                <select class="form-select" aria-label="Disabled select example" disabled>
                                    <option selected value="<?php echo $userexist['role'] ?>">Role: <?php echo $userexist['role'] ?></option>
                                </select>
                            <?php
                            }
                            ?>



                            <br />
                            <!-- Submit button -->
                            <div class="d-grid gap-2 col-3 mx-auto">
                                <button type="submit" class="btn btn-primary btn-block mb-4" value="update" name="submit">Update</button>
                            </div>
                        </form>
                        <br />

                    <?php
                    } else
                        printf("\n <div class=\"alert alert-warning\" role=\"alert\"><h3> You are not logged in.</h3></div> ");
                    ?>

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
