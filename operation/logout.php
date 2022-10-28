<?php 
ob_start();
include ("connect.php");
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['fullname']);
unset($_SESSION['phone']);
unset($_SESSION['address']);
header("Location: ../login");
exit();
?>