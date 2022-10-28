<?php
$servername = "us-cdbr-east-06.cleardb.net";
$username = "b25224a3c46145";
$password = "7fea6da0";
$dbname = "heroku_e3132b845349c6a";

define("SITE_URL", "https://mydairyp.herokuapp.com/");

define("SITE_ADDRESS", "mydairyp.herokuapp.com/");

define("SITE_NAME", "COW SALE PROJECT");

define("SITE_PHONE", "+234 819 256 2776");

define("SITE_EMAIL", "info@".SITE_ADDRESS);


try 
    {
    $db_conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
// ========================= config the languages ================================
   	session_start();
   	ob_start();
    date_default_timezone_set("Africa/Johannesburg");
    error_reporting(E_NOTICE ^ E_ALL);

?>
