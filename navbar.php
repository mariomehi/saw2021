<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="src/logo.png" alt="" width="90" height="64">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="film.php">Film</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Generi Film
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Azione</a></li>
            <li><a class="dropdown-item" href="#">Avventura</a></li>
            <li><a class="dropdown-item" href="#">Commedia</a></li>
            <li><a class="dropdown-item" href="#">Fantasy</a></li>
            <li><a class="dropdown-item" href="#">Fantascienza</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="serie.php">Serie</a>
        </li>
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item" style="margin-right:20px;">
          
<?php
if (!isset($_SESSION['login']))
echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"login.php\"> <i class=\"fas fa-user\"></i> Login</a>";
    else 
    echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"show_profile.php\"> <i class=\"fas fa-user\"></i> Profilo</a>";
?>
          
      </li>
        <li class="nav-item" style="margin-right:20px;">
        
<?php
if (!isset($_SESSION['login']))
echo "<a class='nav-link active' aria-current='page' href='register.php'><i class='fas fa-hand-point-right'></i> Registrati</a>";
    else 
    echo "<a class='nav-link active' aria-current='page' href='logout.php'> <i class='fas fa-user'></i> Logout</a>";
?>
        
        </li>
        
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      
        <ul>
    </div>
  </div>
</nav>
