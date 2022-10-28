<?php 
ob_start();
include ("../operation/connect.php");
unset($_SESSION['admin_id']);
unset($_SESSION['admusername']);
unset($_SESSION['admemail']);
unset($_SESSION['admphone']);
header("Location: ../admlogin");
exit();
?>