<?php include 'header.php';

if (isset($_GET['main_id'])) {
		$main_id = $_GET['main_id'];
		$getprodyct = $db_conn->prepare("SELECT * FROM products WHERE main_id = :main_id");
		$getprodyct->bindParam(':main_id', $main_id, PDO::PARAM_STR);
		$getprodyct->execute();
		if ($getprodyct->rowCount() < 1) {
			header("Location: ./products");
			exit();
		}
	}else{
		header("Location: ./products");
		exit();
	}

?>
<title>Edit Product Item | <?= SITE_NAME; ?></title>

            <small><span class="fas fa-tachometer-alt "></span> Edit Product.</small>
			<div class="card shadow-3 mt-5 px-3 py-2 me-auto ms-auto">
				<div class="card-body col-md-7 me-auto ms-auto">
					<h4 class="text-center fw-bold text-dark">Edit Product Item</h4>
					<p>Fill in the form below to Edit a Product </p>
					<form class="md-form" id="editmedia" method="POST" enctype="multipart/form-data">
						<?php $row = $getprodyct->fetch(PDO::FETCH_ASSOC); ?>
	                    <div class="form-outline mt-3 mb-4">
	                        <i class="far fa-list trailing"></i>
	                        <input type="text" value="<?= $row['item']; ?>" class="form-control form-icon-trailing" placeholder="Brown Cow" name="item" id="item">
	                        <label class="form-label" for="item">Product Name </label>
	                    </div>
	                    <div class="form-outline mt-3 mb-4">
	                        <i class="far fa-money-bill trailing"></i>
	                        <input type="text" value="<?= $row['price']; ?>" class="form-control form-icon-trailing" name="price" id="price">
	                        <label class="form-label" for="price">Price </label>
	                    </div>
	                    <div class="form-outline mb-5">
							<i class="far fa-money-bill trailing"></i>
							<textarea rows="5" placeholder="Description" id="description" required="" name="description" class="form-control form-icon-trailing"><?= $row['description']; ?></textarea>
							<label for="description" class="form-label">Description</label>
						</div>
	                    <div class="select-wrapper mb-3">
							<label class="select-label" for="status">Select Status </label>
	                    	<select class="select select-initialized" id="status" name="status">
								<option value="1" <?php if($row['status'] == "1") { echo "selected"; } ?>>Available</option>
								<option value="0" <?php if($row['status'] == "0") { echo "selected"; } ?>>Out of stock</option>
							</select>
	                    </div>
	                    <div class="form-outline mt-3 mb-4">
	                        <i class="far fa-image trailing"></i>
	                        <label class="form-label ps-1" for="image"> Product Image (Optional)</label>
	                        <input type="file" class="form-control form-icon-trailing" name="image" id="image">
	                    </div>
	                    <div class="form-group" align="center">
	                        <p class="alert alert-success" id="errorshow"></p>
	                    </div>
	                    <center>
	                        <div class="text-center align-items-center ms-auto me-auto mb-2 col-md-6">
	                    		<button type="submit" id="btnSend" class="btn btn-md btn-block btn-success btn-rounded">Save Product</button>
	                        </div>
	                    </center>
	                </form>
	    		</div>
			</div>
		    <!--Grid row-->
		</div>
	</main>
	<!--Main layout-->
<?php include 'footer.php'; ?>
<script>
	$(document).ready(function(){
		$('#errorshow').hide();
	});

	$("form#editmedia").submit(function(e) {
	    e.preventDefault();    
	    var formData = new FormData(this);
	    var request = "editproduct";
	    var photo = "<?= $row['image']; ?>";
	    var main_id = "<?= $row['main_id']; ?>";
	    formData.append("request", request);
	    formData.append("photo", photo);
	    formData.append("main_id", main_id);
	    $.ajax({
		    url: '../operation/products',
		    type: 'POST',
		    data: formData,
		    beforeSend:function(){
				$('#errorshow').html("Saving Product <span class='fas fa-spinner fa-spin'></span>").show();
			},
			success: function (data) {
				var response = $.parseJSON(data);
				if (response.status == "success") {
				    $("#errorshow").html("Product was updated successfully <br> Redirecting <span class='fas fa-spinner fa-pulse'></span> ").show();
				    setTimeout(' window.location.href = "./products"; ', 5000);
				}else{
					$("#errorshow").html("<span class='fas fa-exclamation-triangle'></span> " + response.message).show();
				    setTimeout(function(){
						$("#errorshow").hide();
					}, 5000);
				}   
			},
			cache: false,
			error:function(){
				$('#errorshow').html("<span class='fas fa-exclamation-triangle'></span> An error has occured!!").show();
				setTimeout(function(){
					$("#errorshow").hide();
				}, 5000);
			},
			contentType: false,
			processData: false
		});
	});
</script>