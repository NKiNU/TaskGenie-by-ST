<?php 
session_start();
unset($_SESSION['user_id']);

echo '<script>alert("Welcome to Geeks for Geeks")</script>';
header ("Location:login.php");


?>