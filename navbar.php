<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.png" alt="Netflox.it" width="90" height="64"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="movies.php">Movies</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genres
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="movies.php?genre=action">Action</a></li>
<li><a class="dropdown-item" href="movies.php?genre=adventure">Adventure</a></li>
<li><a class="dropdown-item" href="movies.php?genre=drama">Drama</a></li>
<li><a class="dropdown-item" href="movies.php?genre=fantasy">Fantasy</a></li>
<li><a class="dropdown-item" href="movies.php?genre=sci-fi">Sci-Fi</a></li>
<li><a class="dropdown-item" href="movies.php?genre=thriller">Thriller</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
      
          
<?php
if (!isset($_SESSION['login'])) {

echo "<li class='nav-item' style='margin-right:20px;'> <a class=\"nav-link active\" aria-current=\"page\" href=\"login.php\"> <i class=\"fas fa-user\"></i> Login</a>";

   } else {
   
   $userid=$_SESSION['login'];
   
    echo "<li class='nav-item'> <a class=\"nav-link active\" aria-current=\"page\" href=\"show_profile.php?id=$userid\"> 
    <i class=\"fas fa-user\"></i> Profile</a> 
    </li><li>";
    
    if (isset($_SESSION['admin'])) {
        echo "<a class=\"nav-link active\" aria-current=\"page\" 
        href=\"admin/index.php\"> <i class=\"fas fa-tools\"></i> Admin</a>";
    }

    }
?>
          
      </li>
        <li class="nav-item" style="margin-right:20px;">
        
<?php
if (!isset($_SESSION['login']))
echo "<a class='nav-link active' aria-current='page' href='registration.php'><i class='fas fa-hand-point-right'></i> Register</a>";
    else 
    echo "<a class='nav-link active' aria-current='page' href='logout.php'> <i class='fas fa-sign-out-alt'></i> Logout</a>";
?>
        </li>

<div>

        <input class="form-control me-2" type="search" id="search" onkeyup="searchmovie('ajax/searchmovie.php');" placeholder="Search" aria-label="Search">
      
      <div id="results" style="position:absolute; width:220px; background-color: white; z-index:1; border: 1px solid #ced4da; border-radius: .25rem; padding:5px; display:none;">
      </div>
      
</div>
      
<script src="js/jquery-3.5.1.min.js"></script>
<script>
function searchmovie(url) {
    let smovie = document.getElementById("search").value;
    console.log(smovie);
if (smovie.length>2) {
    
    $.post(url, { movie: smovie }, function(data, status) {
    console.log(data);
    
        if (status == "success") {
        var obj = JSON.parse(data); 
        console.log(obj);

var string="";
for (var film of obj) {
    string=string+"<div style='display:flex; padding: 5px;'><img src='"+film.poster+"' width='30px'>"+"&nbsp; <div style='font-size:14px;'> <a href='https://webdev19.dibris.unige.it/~S4719894/movie.php?id="+film.id+"'>"+film.title+" </a><br/><span style='font-size:12px; color:grey;'> "+film.year+"</span></div></div>";
}

document.getElementById("results").style.display = "grid";
document.getElementById("results").innerHTML = string;


            } else {
            alert("ops, something went wrong");
            }
    });
} else {
    document.getElementById("results").innerHTML = " ";
    document.getElementById('results').style.display = "none";
}
    
}
</script>
      
      
      
        <ul>
    </div>
  </div>
</nav>

