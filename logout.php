<?php
session_start();

$_SESSION['questions'] = array();

session_destroy();

header ('location: index.php');

echo '<script>alert("You have been successfully logged out.");</script>';

?>

