<?php include "operation/connect.php";
	if(!empty($_SESSION["shopping_cart"])) {
		$cart_count = count(array_keys($_SESSION["shopping_cart"]));
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;" charset="utf-8"/>
    <meta name="author" content="Web Tech Solute"/>
    <meta name="description" content="FARM SALE PROJECT" />
    <meta name="keywords" content="Farm, Sale, Payment, Cows, Milk, Products" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <!-- Favicon -->
    <link rel="icon" href="./assets/images/favicon.png"/>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="./assets/css/mdb.min.css"/>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css"/>
    <script src="./assets/js/jquery.min.js"></script>
</head>
<body class="intro-page" style="background-color: #f9f9f9;">
<!--Navigation & Intro-->
<header>
	<!--Navbar-->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar bg-success lighten-2">
    	<div class="container">
        	<a class="navbar-brand" href="#"><strong>WELCOME</strong></a>
        	<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
        	<div class="collapse navbar-collapse" id="navbarNav">
          	<!--Links-->
          	<ul class="navbar-nav me-auto smooth-scroll">
	            <li class="nav-item">
	            	<a class="nav-link text-white" href="./">Home</a>
	            </li>
              	<li class="nav-item">
              		<a class="nav-link text-white" href="./products" data-mdb-offset="100">Products</a>
              	</li>
                <?php if(!isset($_SESSION["user_id"])){ ?>
              	<li class="nav-item">
              		<a class="nav-link text-white" href="./login" data-mdb-offset="100">Login</a>
              	</li>
              	<li class="nav-item">
              		<a class="nav-link text-white" href="./register" data-mdb-offset="100">Register</a>
              	</li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav ms-auto">
	            <li class="nav-item">
	            	<a class="nav-link text-white" href="./checkout"><span class="far fa-shopping-cart"></span> Cart <span class="badge badge-danger"><?php if(isset($_SESSION['shopping_cart'])){ echo $cart_count; }else{ echo 0; } ?></span></a>
	            </li>
                <?php if(isset($_SESSION["user_id"])){
                    $user_id = $_SESSION['user_id'];
                    $sql = $db_conn->prepare("SELECT user_id FROM users WHERE user_id = :user_id");
                    $sql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
                    $sql->execute();
                    if ($sql->rowCount() > 0) {  ?>
                <li class="nav-item dropstart me-2">
                    <a class="nav-link dropdown-toggle hidden-arrow" href="#" id="navProfile" role="button" data-mdb-toggle="dropdown" aria-expanded="false"> <span class="fas fa-user-circle fa-2x"></span> </a>
                    <ul class="dropdown-menu" aria-labelledby="navProfile">
                        <li><a class="dropdown-item" href="./orders">My Orders</a></li>
                        <li><a class="dropdown-item" href="./settings">Settings</a></li>
                        <li><a class="dropdown-item" href="./operation/logout">Logout</a></li>
                    </ul>
                </li>
                <?php } } ?>
            </ul>
        </div>
    </div>
</nav>
<!--/Navbar-->