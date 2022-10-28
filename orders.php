<?php include "header.php";

if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION['user_id'];
    $sql = $db_conn->prepare("SELECT user_id FROM users WHERE user_id = :user_id");
    $sql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $sql->execute();
    if ($sql->rowCount() < 0) {
		$_SESSION['message'] = "Please login or register to access this page";
    	header("Location: ./");
    }
}else{
	$_SESSION['message'] = "Please login or register to access this page";
	header("Location: ./");
}

$total = 0; 

?>
<title>My Orders | <?= SITE_NAME; ?></title>
<style>
    html,body, header, .jarallax {
        height: 80%;
    }

    @media (min-width: 560px) and (max-width: 740px) {
        html,body,header, .jarallax {
            height: 260px;
        }
    }

    @media (min-width: 800px) and (max-width: 850px) {
        html,body,header,.jarallax {
            height: 260px;
        }
    }
</style>
<?php if (isset($_SESSION["message"]) AND !empty($_SESSION['message'])) { ?>
    <p class="alert alert-success col-md-4" id="success" data-mdb-position="top-right"><?= $_SESSION["message"]; ?></p>
<?php }else{ unset($_SESSION['message']); } ?>
<div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(./assets/images/bg-default.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask rgba-purple-slight" style="background-color: rgba(0, 0, 0, 0.7)">
        <div class="container h-100 d-flex align-items-left">
            <div class="row smooth-scroll py-5">
                <div class="col-md-12 text-white text-start">
                    <div class="wow fadeInDown py-5" data-wow-delay="0.2s">
                        <h3 class="display-6 font-weight-bold text-start">My Orders</h3>
                        <hr class="hr-light">
                        <h5 class="subtext-header mt-4 mb-3">Check all your ordered items.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<!--/Navigation & Intro-->

<main class="">
    <div class="container wow fadeIn">
    	<!-- Heading -->
    	<h2 class="my-5 h2 text-center">My Orders</h2>
    	<!--Grid row-->
    	<div class="row">
	        <!--Grid column-->
	        <div class="col-lg-12 col-md-12 mb-4 card shadow-3 py-4">
	        	<!-- Heading -->
	        	<div class="form-outline mb-4 ms-auto col-lg-4 col-md-12">
	        		<i class="far fa-search trailing"></i>
				    <input type="text" class="form-control form-icon-trailing" id="cart-search-input" />
				    <label class="form-label" for="cart-search-input">Search</label>
				</div>
				<div class="alert alert-success my-2" id="alert"></div>
	        	<div class="datatable" id="cart">
					<div class="datatable-inner table-responsive">
				  		<table class="table datatable-table hoverable table-striped table-hover">
				  			<thead class="datatable-header">
			                	<tr class="text-nowrap">
			                		<th>S/N</th>
			                    	<th>Order ID</th>
			                    	<th>Number of Items</th>
			                    	<th>Date Added</th>
			                    	<th>Actions</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	<?php $i = 1;
			                		$user_id = $_SESSION['user_id'];
			                		$sql = $db_conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
			                		$sql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
			                		$sql->execute();

			                		while($row = $sql->fetch(PDO::FETCH_ASSOC)):
			                			$item = explode(",", $row['item']);
			                		?>
			                	<tr>
			                		<td><?= $i; ?></td>
			                		<td>#<?= $row['main_id']; ?></td>
			                		<td><?= count($item); ?></td>
			                		<td><?= $row['date_added']; ?></td>
			                		<td><a href="./order?order_id=<?= $row['main_id']; ?>" class="btn btn-link btn-sm btn-rounded"><span class="fas fa-eye pe-2" ></span>View Details</a>
			                		</td>
			                	</tr>
			                	<?php $i++; endwhile; ?>
			                </tbody>
			            </table>
			        </div>
	        	</div>
	        </div>
	        <!--Grid column-->
	    </div>
	    <!--Grid row-->
	</div>
</main>
<!--Main layout-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
    	$("#errorshow").hide();
    	$("#alert").hide();
    	$("#errorshowPay").hide();
    	$("#info").show();
    });

    setTimeout(function(){
        $("#info").hide();
    }, 6000);

	var TableDataGifts = new Array();
	$('#cart tr').each(function(row, tr){
	    TableDataGifts[row]={
	        "S/N" : $(tr).find('td:eq(0)').text()
	        , "Item" :$(tr).find('td:eq(1)').text()
	        , "Price" : $(tr).find('td:eq(2)').text()
	        , "Quantity" : $(tr).find('td:eq(3)').text()
	        , "Total" : $(tr).find('td:eq(4)').text()
			, "Actions" : $(tr).find('td:eq(5)').text()
	    }
	}); 
	TableDataGifts.shift();
	const instanceMedia = new mdb.Datatable(document.getElementById("cart"), TableDataGifts)
    document.getElementById("cart-search-input").addEventListener('input', (e) => { instanceMedia.search(e.target.value); });
</script>