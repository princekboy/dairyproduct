<?php include "header.php"; ?>
<title>Products | <?= SITE_NAME; ?></title>
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
    <p class="alert alert-success col-md-4" id="info" data-mdb-position="top-right"><?= $_SESSION["message"]; ?></p>
<?php }else{ unset($_SESSION['message']); } ?>
<div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(./assets/images/bg-default.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask rgba-purple-slight" style="background-color: rgba(0, 0, 0, 0.7)">
        <div class="container h-100 d-flex align-items-left">
            <div class="row smooth-scroll py-5">
                <div class="col-md-12 text-white text-start">
                    <div class="wow fadeInDown py-5" data-wow-delay="0.2s">
                        <h3 class="display-6 font-weight-bold text-start">PRODUCTS</h3>
                        <hr class="hr-light">
                        <h5 class="subtext-header mt-4 mb-3">Products page</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<!--/Navigation & Intro-->

<!--Main content-->
<main>
    <!--First container-->
    <div class="container-fluid px-3 py-3">
    	<h3 class="text-start mb-5">Available Products</h3>
    	<div class="row">
    		<?php
    			$getProd = $db_conn->prepare("SELECT * FROM products");
    			$getProd->execute();
    			while($row = $getProd->fetch(PDO::FETCH_ASSOC)):
    		?>
    		<div class="col-lg-4 col-md-12 ms-auto me-auto">
    			<div class="card shadow-3 mb-5">
    				<div class="card-img-top card-img">
    					<img src="./assets/images/products/<?= $row['image']; ?>" class="bg-image w-100 img-fluid img-responsive">
    				</div>
    				<div class="card-body py-4 px-4">
    					<h4 class="text-center fw-bold text-dark"><?= $row['item']; ?></h4><hr>
    					<p class="text-justify"><span class="fw-bold text-dark">Description: </span><?= $row['description']; ?></p>
    					<p class="text-start"><span class="fw-bold text-dark">Price: </span>R<?= $row['price']; ?></p>
    					<p class="text-start"><span class="fw-bold text-dark">Date Added: </span><?= $row['date_added']; ?></p>
    					<p class="text-start"><span class="fw-bold text-dark">Status: </span><?php if($row['status'] == 1){ ?><span class="bg-success py-1 px-2 rounded text-white">Available</span><?php }else{ ?><span class="bg-danger py-1 px-2 rounded text-white">Out of Stock</span><?php } ?> </p>
    				</div>
    				<div class="card-footer">
    					<div align="center" class="col-md-6 ms-auto me-auto">
    						<button id="btn<?= $row['main_id']; ?>" class="btn btn-success btn-block btn-rounded btn-md">Add to Cart</button>
    					</div>
    				</div>
    			</div>
    		</div>
    		<span class="alert alert-success col-md-4" id="alert<?= $row['main_id']; ?>" data-mdb-position="top-left"></span>
    		<script>
    			$(document).ready(function(){
    				$("#alert<?= $row['main_id']; ?>").hide();
    			});

    			$("#btn<?= $row['main_id']; ?>").click(function() {  
		        	var main_id = "<?= $row['main_id']; ?>";
		        	var user_id = "<?php isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
		        	$.ajax({
			            url: 'operation/products',
			            type: 'POST',
			            data: {request:'addcart',main_id:main_id,user_id:user_id},
			            beforeSend:function(){
			                $('#alert<?= $row['main_id']; ?>').html("Adding item to cart <span class='fas fa-spinner fa-spin'></span>").show();
			            },
			            success: function (response) {
			            	var result = $.parseJSON(response);
			                if (result.status == "success") {
			                    $("#alert<?= $row['main_id']; ?>").html(result.message).show();
			                    setTimeout(function(){
			                        $("#alert<?= $row['main_id']; ?>").hide();
			                    }, 3000);
			                }else if (result.status == "exists") {
			                    $("#alert<?= $row['main_id']; ?>").html(result.message).show();
			                    setTimeout(function(){
			                        $("#alert<?= $row['main_id']; ?>").hide();
			                    }, 3000);
			                }else{
			                    $("#alert<?= $row['main_id']; ?>").html("<span class='far fa-exclamation-triangle'></span> " + result.message).show();
			                    setTimeout(function(){
			                        $("#alert<?= $row['main_id']; ?>").hide();
			                    }, 3000);
			                }   
			            },
			            error:function(){
			                $('#alert<?= $row['main_id']; ?>').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!").show();
			                setTimeout(function(){
			                    $("#alert<?= $row['main_id']; ?>").hide();
			                }, 3000);
			            }
			        });
		    	});
    		</script>
    		<?php endwhile; ?>
    	</div>
    </div>
</main>
<?php include "footer.php"; ?>

<script>
	$(document).ready(function(){
		$("#info").show();
    });

    setTimeout(function(){
        $("#info").hide();
    }, 3500);
</script>