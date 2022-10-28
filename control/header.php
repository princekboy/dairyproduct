<?php include '../operation/connect.php';

if (!isset($_SESSION['admusername']) AND !isset($_SESSION['admin_id'])) {
   header("Location: ../adminlogin");
   exit();
}else{
	$admin_id = $_SESSION['admin_id'];
	$admusername = $_SESSION['admusername'];
	$chekuser = $db_conn->prepare("SELECT * FROM admin WHERE username = :username AND admin_id = :admin_id");
	$chekuser->bindParam(':username', $admusername, PDO::PARAM_STR);
	$chekuser->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
	$chekuser->execute();
	if ($chekuser->rowCount() < 1) {
		header("Location: ../adminlogin");
   		exit();
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;" charset="utf-8"/>
	<meta name="author" content="Web Tech Solute"/>
   <meta name="description" content="FARM SALE PROJECT" />
   <meta name="keywords" content="Farm, Sale, Payment, Cows, Milk, Products" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/mdb.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<script src="../assets/js/jquery.min.js"></script>

</head>
<style>
	input.form-control, textarea.form-control, select.form-control{
		font-size: 16px;
	}
	ul.lists li{
		display: inline;
		padding-left: 25px;
	}
	.fas, .fab, .far, .fa{
		font-size: 1.16rem;
	}
	.sidenav-link.collapsed .rotate-down {
		-webkit-transform: rotate(90deg);    
	    -moz-transform: rotate(90deg);        
	    -o-transform: rotate(90deg);       
	    -ms-transform: rotate(90deg);
		transform: rotate(90deg);
		transition: .5s ease-in-out;
	}

	.sidenav-link .rotate-down{
		-webkit-transform: rotate(0deg);     
	    -moz-transform: rotate(0deg);        
	    -o-transform: rotate(0deg);          
	    -ms-transform: rotate(0deg);   
	    transform: rotate(0deg);
	    transition: .5s ease-in-out;
	}
	.submenu{
		font-size: 13px;
	}
</style>
<body class="">
	<header>
		<div id="mysidenav" class="sidenav" role="navigation" data-mdb-close-on-esc="true" data-mdb-position="fixed" data-mdb-hidden="true" data-mdb-mode="over" data-mdb-slim="true" data-mdb-slim-collapsed="true" data-mdb-content="#content" data-mdb-focus-trap="true" data-mdb-scroll-container="#scroll-container">        
	        <ul class="sidenav-menu mt-5" id="scroll-container">
	        	<li class="sidenav-item active ps-1">
	        		<a class="sidenav-link mb-4" style="cursor: pointer;">
	        			<i class="fas fa-bars me-4" id="slim-toggler"></i><img src="../assets/images/<?= $_SESSION['headerphoto']; ?>" alt="<?= SITE_NAME; ?>" style='width:140px;' class='img-fluid'><span onclick="slimInstance.hide();" class="fas ps-2 fa-angle-left fa-lg"></span>
	        		</a>
	        	</li>
	        	<li class="sidenav-item mb-2 <?= basename($_SERVER['PHP_SELF']) == "index.php" ? "active" : ""; ?>">
	        		<a class="sidenav-link" href="./">
	        			<i class="fas fa-home me-4"></i><span> Dashboard</span>
	        		</a>
	        	</li>
	        	<li class="sidenav-item mb-2 <?= basename($_SERVER['PHP_SELF']) == "products.php" ? "active" : ""; ?>">
	        		<a class="sidenav-link" href="./products">
	        			<i class="fas fa-cubes me-4"></i><span> Products</span>
	        		</a>
	        	</li>
	        	<li class="sidenav-item mb-2 <?= basename($_SERVER['PHP_SELF']) == "orders.php" ? "active" : ""; ?>">
	        		<a class="sidenav-link" href="./orders">
	        			<i class="fas fa-list me-4"></i><span> Orders</span>
	        		</a>
	        	</li>
	        	<li class="sidenav-item mb-2 <?= basename($_SERVER['PHP_SELF']) == "users.php" ? "active" : ""; ?>">
	        		<a class="sidenav-link" href="./users">
	        			<i class="fas fa-user me-4"></i><span> Users</span>
	        		</a>
	        	</li>
	        	<li class="sidenav-item mb-2 <?= basename($_SERVER['PHP_SELF']) == "payments.php" ? "active" : ""; ?>">
	        		<a class="sidenav-link" href="./payments">
	        			<i class="fas fa-wallet me-4"></i><span> Payments</span>
	        		</a>
	        	</li>
	        	<li class="sidenav-item mb-2">
	        		<a class="sidenav-link" href="./logout">
	        			<i class="fas fa-sign-out-alt me-4"></i><span> Logout</span>
	        		</a>
	        	</li>
	        </ul>
	        <div class="sidenav-footer mt-5">
	        	<p class="text-center">&copy; <?= date("Y"); ?> <?= SITE_NAME; ?></p>
	        </div>
	    </div>
	    <!-- Sidenav -->
	    <!-- Navbar -->
	    <nav id="main-navbar" class="navbar navbar-expand-lg bg-success navbar-dark fixed-top">
	    	<div class="container-fluid">
	    		<img src="../assets/images/" alt="<?= SITE_NAME; ?>" style='width:160px; color: #fff;' class='img-fluid'>
	            <ul class="navbar-nav ml-auto d-flex flex-row">
	            	<li class="nav-item dropstart me-2">
	            		<a class="nav-link dropdown-toggle hidden-arrow" href="#" id="navProfile" role="button" data-mdb-toggle="dropdown" aria-expanded="false"> <span class="fas fa-user-circle fa-2x"></span> </a>
	            		<ul class="dropdown-menu" aria-labelledby="navProfile">
	            			<li><a class="dropdown-item" href="./settings">Settings</a></li>
	            			<li><a class="dropdown-item" href="./logout">Logout</a></li>
	            		</ul>
	            	</li>
	            	<li class="nav-item me-2">
	            		<a href="javascript:history.back();" class="nav-link"><span class="fas fa-angle-double-left"></span> Back</a>
	            	</li>
	            	<li class="nav-item">
	            		<a onclick="slimInstance.show();" class="nav-link">
	            		<i class="fas fa-bars fa-lg" style="cursor: pointer;"></i></a>
	            	</li>
	            </ul>
	        </div>
	    </nav>
	</header>
	<!--Main layout-->
	<main style="margin-top: 86px; height:100%;" class="h-100 mb-5" id="content">
		<div class="container text-start mt-5 h-100">
			<h2 class="text-center font-weight-bold">Admin Dashboard</h2>
			<p class="mb-0">Welcome</p>
            <h3><b><?= strtoupper($_SESSION['admusername']); ?></b></h3>