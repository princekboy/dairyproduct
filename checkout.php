<?php include "header.php";

if (empty($_SESSION['shopping_cart'])) {
	$_SESSION['message'] = "Cart is currently empty. Please add items to cart to check out";
	header("Location: ./products");
	exit();
}elseif(!isset($_SESSION['user_id'])){
	$_SESSION['message'] = "Please login or register to check out your items";
	header("Location: ./products");
}else{
	$_SESSION['message'] = "";
}

$total = 0; 

?>
<title>Checkout | <?= SITE_NAME; ?></title>
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
                        <h3 class="display-6 font-weight-bold text-start">Check Out</h3>
                        <hr class="hr-light">
                        <h5 class="subtext-header mt-4 mb-3">Review your purchased items.</h5>
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
    	<h2 class="my-5 h2 text-center">Checkout form</h2>
    	<!--Grid row-->
    	<div class="row">
    		<!--Grid column-->
    		<div class="col-md-4 mb-4">
    			<!--Card-->
    			<div class="card">
    				<!--Card content-->
    				<form class="card-body" id="formPay" enctype="multipart/form-data" method="POST">
    					<div class="form-outline mt-3 mb-4">
    						<i class="far fa-user trailing"></i>
    						<input type="text" value="<?= $_SESSION["fullname"]; ?>" name="fullname" id="fullname" class="form-control form-icon-trailing">
    						<label for="fullname" class="form-label">Full name</label>
    					</div>
    					<!--First name-->
    					<!--Phone-->
    					<div class="form-outline mt-3 mb-4">
    						<i class="far fa-phone-square trailing"></i>
    						<input type="text" name="phone" value="<?= $_SESSION["phone"]; ?>" class="form-control form-icon-trailing" placeholder="Phone number" id="phone">
    						<label for="phone" class="form-label">Phone number</label>
    					</div>
    					<!--email-->
    					<div class="form-outline mt-3 mb-4">
    						<i class="far fa-envelope trailing"></i>
    						<input type="text" id="email" value="<?= $_SESSION["email"]; ?>" name="email" class="form-control form-icon-trailing">
    						<label for="email" class="form-label">Email Address</label>
    					</div>
    					<!--address-->
    					<div class="form-outline mt-3 mb-4">
    						<i class="far fa-map-marker-alt trailing"></i>
    						<textarea id="address" rows="4" name="address" class="form-control" placeholder="1234 Main St"><?= $_SESSION["address"]; ?> </textarea>
    						<label for="address" class="form-label">Address</label>
    					</div>
    					<div class="form-outline mt-3 mb-4">
    						<i class="far fa-map-marker trailing"></i>
    						<input type="text" id="village" value="" name="village" class="form-control form-icon-trailing">
    						<label for="village" class="form-label">Village name</label>
    					</div>
	                    <hr class="mb-4">
	                    <div class="alert alert-success my-2" id="errorshow"></div>
	                    <div class="col-lg-5 ms-auto me-auto">
	                    	<button class="btn btn-success btn-md btn-block btn-rounded" type="button" id="btnConfirm">Checkout</button>
	                    </div>
	                    <!--Modal: modalConfirm-->
						<div class="modal fade" id="modalPay" tabindex="-1" aria-labelledby="modalPay" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content text-center">
									<div class="modal-header justify-content-center">
										<h5 class="font-weight-bold"><span class="fas fa-exclamation-circle"></span> Make Payment</h5>
										<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close">
											<span aria-hidden="true" style="font-weight: bold;"></span>
										</button>
									</div>
									<div class="modal-body">
										<p class="text-start">You are about to pay <span class="fw-bold">R<span id="totalPay"></span></span> for the order. Click the button below to pay.</p>
						                <div class="form-group" align="center">
						                    <p class="alert alert-success" id="errorshowPay"></p>
						                </div>
						                <center>
						                    <div class="text-center align-items-center ms-auto me-auto mb-2 col-md-6">
						                  		<button type="submit" id="btnSubmit" class="btn btn-md btn-block btn-success btn-rounded">Proceed</button>
						                    </div>
						                </center>
									</div>
								</div>
							</div>
						</div>   
	                </form>
	            </div>
	            <!--/.Card-->
	        </div>
	        <!--Grid column-->
	        <!--Grid column-->
	        <div class="col-md-8 mb-4 card shadow-3 py-3">
	        	<!-- Heading -->
	        	<h4 class="d-flex justify-content-between align-items-center mb-3">
	        		<span class="text-muted">Your cart</span>
	        		<span class="badge badge-success badge-pill"><?php if(isset($_SESSION['shopping_cart'])){ echo $cart_count; }else{ echo 0; } ?></span>
	        	</h4>
	        	<div class="form-outline mb-4 ms-auto col-lg-4 col-md-12">
	        		<i class="far fa-search trailing"></i>
				    <input type="text" class="form-control form-icon-trailing" id="cart-search-input" />
				    <label class="form-label" for="cart-search-input">Search</label>
				</div>
				<?php  // print_r($_SESSION['shopping_cart']);
				//unset($_SESSION['shopping_cart']);

				?>
				<div class="alert alert-success my-2" id="alert"></div>
	        	<div class="datatable" id="cart">
					<div class="datatable-inner table-responsive">
				  		<table class="table datatable-table hoverable table-striped table-hover">
				  			<thead class="datatable-header">
			                	<tr class="text-nowrap">
			                		<th>S/N</th>
			                    	<th>Item</th>
			                    	<th>Price</th>
			                    	<th>Quantity</th>
			                    	<th>Total</th>
			                    	<th>Actions</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	<?php $i = 1;
			                	foreach ($_SESSION['shopping_cart'] as $cart){ ?>
			                	<tr>
			                		<td>#<?= $i; ?></td>
			                		<td>
			                			<div class="d-flex align-items-center">
			                				<img src="./assets/images/products/<?= $cart['image']; ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
			                				<div class="ms-3">
			                					<p class="fw-bold"><?= $cart['name']; ?></p>
			                				</div>
			                			</div>
			                		</td>
			                		<td>
			                			<p class="fw-normal mb-1">R<?= number_format($cart['price'], 2); ?></p>
			                		</td>
			                		<td>
			                			<span class="rounded-pill d-inline"><span id="qty<?= $cart['id']; ?>"><?= $cart['quantity']; ?></span> <span class="fas fa-plus-circle ps-2" style="cursor: pointer;" onclick="addQty('addQty', <?= $cart['id']; ?>, <?= $_SESSION['user_id']; ?>, '#qty<?= $cart['id']; ?>', '#total<?= $cart['id']; ?>')"></span><span class="fas fa-minus-circle ps-2" style="cursor: pointer;" onclick="removeQty('removeQty', <?= $cart['id']; ?>, <?= $_SESSION['user_id']; ?>, '#qty<?= $cart['id']; ?>', '#total<?= $cart['id']; ?>')"></span></span>
			                		</td>
			                		<td>
			                			<p class="fw-normal">R<span id="total<?= $cart['id']; ?>"><?= number_format($cart['price'] * $cart['quantity'], 2); ?></span></p>
			                		</td>
			                		<td>
			                			<button type="button" onclick="removeCart('removecart', <?= $cart['id']; ?>, <?= $_SESSION['user_id']; ?>)" class="btn btn-link btn-sm btn-rounded"><span class="fas fa-trash pe-2" ></span>Remove</button>
			                		</td>
			                	</tr>
			                	<?php $total += $cart['price'] * $cart['quantity'];  $i++; } ?>
			                	<tr class="fw-bold">
			                		<td scope="row">#</td>
			                		<td class="fw-bold"><span class="fw-bold">Total</span></td><td> </td><td> </td><td> </td>
			                		<td><span class="fw-bold text-end">R<?= number_format($total, 2); ?></span></td>
			                	</tr>
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
<script src="https://checkout.flutterwave.com/v3.js"></script>
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

    var fullname = $("#fullname");
    var village = $('#village');
    var email = $('#email');
    var phone = $('#phone');
    var address = $('#address');
    var formatamount = "<?= number_format($total, 2); ?>";
    var amount = "<?= $total / 18.44; ?>";
    var total = "<?= $total; ?>";
    var order_id = "";
    var user_id = "<?= $_SESSION['user_id']; ?>";

    $("#totalPay").html(formatamount);

    $("#btnConfirm").click(function(){
        if (fullname.val() === "" || fullname.val().length < 3) {
            $('#errorshow').html("Please enter fullname").show();
            setTimeout(function(){
                $('#errorshow').hide();
            }, 3000);
        }else if (email.val() === "" || email.val().length < 3) {
            $('#errorshow').html("Please enter email").show();
            setTimeout(function(){
                $('#errorshow').hide();
            }, 3000);
        }else if (phone.val() === "" || phone.val().length < 10) {
            $('#errorshow').html("Please enter a valid phone number").show();
            setTimeout(function(){
                $('#errorshow').hide();
            }, 3000);
        }else if (address.val() === "" || address.val().length < 4) {
            $('#errorshow').html("Please enter password").show();
            setTimeout(function(){
                $('#errorshow').hide();
            }, 3000);
        }else if (village.val() === "" || village.val().length < 3) {
            $('#errorshow').html("Please enter a village name").show();
            setTimeout(function(){
                $('#errorshow').hide();
            }, 3000);
        }else{
            $('#modalPay').modal('show');
        }
    });

    // ============================================##################///////////////////////////////////////

    function makepayment(){
        const modalPay = FlutterwaveCheckout({
            public_key: "FLWPUBK_TEST-4e9f8fe47acdd6bc96a6000e53ba0577-X",
            tx_ref: Math.floor(Math.random()*8999999999999999999+10000),
            amount: amount,
            currency: "USD",
            payment_options: " ",
            customer: {
                email: email.val(),
                phone_number: phone.val(),
                name: fullname.val(),
            },
            meta: {
                price: amount,
                village: village.val()
            },
            callback: function (data) { // specified callback function
                if(data.status == "successful"){
                    modalPay.close();
                    setTimeout(function(){
                        $.ajax({
                            type:'POST',
                            url:'./operation/confirmpayment.php',
                            data:{reference:data.tx_ref,txnid:data.transaction_id,status:data.status,amount:data.amount,user_id:user_id,email:email.val(), total:total, order_id:order_id},
                            beforeSend:function(){
                                $("#errorshowPay").html("Checking payment status <span class='far fa-fw fa-spinner fa-pulse'></span>").show();
                            },
                            success:function(res){
                                var resp = $.parseJSON(res);
                                setTimeout(function(){
                                    if (resp.status == "success") {
                                        $("#errorshowPay").html("Payment successful. Order has been placed successfully. page is reloading <span class='far fa-fw fa-spinner fa-pulse'></span>").show();
                                        setTimeout(function(){
                                            location.reload();
                                        }, 1500);
                                    }else{
                                        $("#errorshowPay").html("<span class='far fa-fw fa-exclamation-triangle'></span> " + resp.response).show();
                                    }
                                }, 500); 
                            },
                            error:function(err){
                                $("#errorshowPay").html("<span class='far fa-fw fa-exclamation-triangle'></span> " + err).show();
                                setTimeout(function(){
                                    $("#errorshowPay").hide();
                                }, 1000);
                            }
                        });
                    }, 500);
                }else{
                    $("#errorshowPay").html("<span class='far fa-fw fa-exclamation-triangle'></span> " + data.status).show();
                    setTimeout(function(){
                        $("#errorshowPay").hide();
                    }, 1000);
                }
            },
            onclose: function(incomplete) {
                if (incomplete === true || window.verified == false) {
                    $("#errorshowPay").html("<span class='far fa-fw fa-exclamation-triangle'></span> Payment Failed").show();
                    setTimeout(function(){
                        $("#errorshowPay").hide();
                    }, 4000);
                }else{
                    if (window.verified == true) {
                        $("#errorshowPay").html("<span class='far fa-fw fa-check-circle'></span> Payment successful").show();
                        setTimeout(function(){
                            $("#errorshowPay").hide();
                        }, 4000);
                    } else {
                        $("#errorshowPay").html("<span class='far fa-fw fa-exclamation-circle'></span> Payment pending").show();
                        setTimeout(function(){
                            $("#errorshowPay").hide();
                        }, 4000);
                    }
                }
            },
            customizations: {
                title: "<?= SITE_NAME; ?>",
                description: 'Payment for order #' + order_id,
                logo: 'https://www.heirtous.com/assets/images/favicon.png'
            },
        });
    }

    $("form#formPay").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        var request = "saveinvoice";
        var items = <?= json_encode($_SESSION['shopping_cart']); ?>;
        var user_id = <?= $_SESSION['user_id']; ?>;
        formData.append('request', request);
        formData.append('items', JSON.stringify(items));
        formData.append('user_id', user_id);
    	$.ajax({
            url: './operation/products',
            type: 'POST',
            data: formData,
            success: function (result) {
            	var response = $.parseJSON(result);
                if (response.status == "success") {
                	order_id = response.order_id;
                    makepayment();
                }else{
                    $("#errorshowPay").html("<span class='far fa-exclamation-triangle'></span> " + response.message).show();
                    setTimeout(function(){
                        $("#errorshowPay").hide();
                    }, 5000);
                }   
            },
            cache: false,
            error:function(err){
                $('#errorshowPay').html("<span class='far fa-exclamation-triangle'></span> An error has occured!").show();
                setTimeout(function(){
                    $("#errorshowPay").hide();
                }, 5000);
            },
            contentType: false,
            processData: false
        });
    });

    // =======================================================#######################################///////////

    function addQty(request, id, user_id, span, total) {
		$.ajax({
		    url: 'operation/products',
		    type: 'POST',
		    data: {request:request,id:id,user_id:user_id},
		    success: function (response) {
			   	var result = $.parseJSON(response);
			    if (result.status == "success") {
			        $(span).html(result.quantity);
			        $(total).html(result.total);
			        location.reload();
			    }else{
			        $("#alert").html("<span class='far fa-exclamation-triangle'></span> " + result.message).show();
			        setTimeout(function(){
			            $("#alert").hide();
			        }, 5000);
		        }   
		    },
			error:function(){
				$('#alert').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!").show();
				setTimeout(function(){
				    $("#alert").hide();
				}, 5000);
			}
		});
    }

    function removeQty(request, id, user_id, span, total) {
		$.ajax({
		    url: 'operation/products',
		    type: 'POST',
		    data: {request:request,id:id,user_id:user_id},
		    success: function (response) {
			   	var result = $.parseJSON(response);
			    if (result.status == "removed") {
			        $(span).html(result.quantity);
			        $(total).html(result.total);
			        location.reload();
			    }else{
			        $("#alert").html("<span class='far fa-exclamation-triangle'></span> " + result.message).show();
			        setTimeout(function(){
			            $("#alert").hide();
			        }, 5000);
		        }   
		    },
			error:function(){
				$('#alert').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!").show();
				setTimeout(function(){
				    $("#alert").hide();
				}, 5000);
			}
		});
    }

    function removeCart(request, main_id, user_id) {
    	$.ajax({
		    url: 'operation/products',
		    type: 'POST',
		    data: {request:request,main_id:main_id,user_id:user_id},
		    beforeSend:function(){
		    	$('#alert').html("Removing item from cart <span class='fas fa-spinner fa-spin'></span>").show();
		    },
		    success: function (response) {
			   	var result = $.parseJSON(response);
			   	if (result.status == "success") {
			   		$("#alert").html(result.message).show();
			   		setTimeout(function(){
			   			$("#alert").hide();
			   			location.reload();
			   		}, 5000);
			   	}else{
			   		$("#alert").html("<span class='far fa-exclamation-triangle'></span> " + result.message).show();
			   		setTimeout(function(){
			   			$("#alert").hide();
			   		}, 5000);
			   	}
			},
			error:function(){
				$('#alert').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!").show();
				setTimeout(function(){
					$("#alert").hide();
				}, 5000);
			}
		});
    }


	populateCountries("country", "state");

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