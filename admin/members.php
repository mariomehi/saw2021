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
        require_once("../dbcon.php");
        if (isset($_SESSION['login'])) {
        }
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

                <h2>Members</h2>
                <br />
                <div class="tabella">
                    <table id="members" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Register</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#members').DataTable({
                            "ajax": 'membersdata.php'
                        });
                    });
                </script>

                <div class="line"></div>

            </div>
        </div>


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
