<?php
// start a session
session_start();
?>
<?php
if (isset($_SESSION['login'])) {

    unset($_SESSION['login']);

    if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
    }

    session_destroy();
    header('Location: index.php');
}
?>

