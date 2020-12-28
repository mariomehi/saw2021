<?php
include 'navbar.php';
?>
<br/>
<?php
$uri=$_SERVER['REQUEST_URI'];
$pieces = explode("/", $uri);
$urlo=$pieces[2];
if ($urlo=='registrationform.php' || $urlo=='registration.php')
    $nomeurl='Registrazione';
if ($urlo=='login.php')
    $nomeurl='Login';
if ($urlo=='film.php')
    $nomeurl='Film';
if($urlo=='index.php')
    $nomeurl='';
if($urlo=='')
    $nomeurl='';
?>

  <div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a>
    </li>
    
<?php
if ($urlo=='index.php' || $urlo=='') {

} else {
echo "<li class=\"breadcrumb-item active\"><a href=\"$urlo\">$nomeurl</a></li>";
}

?>

  </ol>
</nav>
</div>
<br/>
