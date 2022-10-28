<?php include 'header.php'; ?>
<title>Products | <?= SITE_NAME; ?></title>
<div class="card shadow-3 mt-5 px-3 py-2 me-auto ms-auto">
	<ul class="nav nav-pills nav-fill mb-3" id="ex1" role="tablist">
		<li class="nav-item" role="presentation">
		 	<a class="nav-link active text-nowrap" id="ex3-tab-1" data-mdb-toggle="pill" href="#addpayment" role="tab" aria-controls="ex3-pills-1" aria-selected="true"><i class="fas fa-money-bill-wave-alt fa-fw me-2"></i> Add New Products</a>
		</li>
		<li class="nav-item" role="presentation">
		    <a class="nav-link text-nowrap" id="ex3-tab-2" data-mdb-toggle="pill" href="#allpaymenttab" role="tab" aria-controls="ex3-pills-2" aria-selected="false"><i class="fas fa-wallet fa-fw me-2"></i>All Products</a>
		</li>
	</ul>
	<!-- Pills navs -->
	<!-- Pills content -->
	<div class="tab-content" id="ex2-content">
	  	<div class="tab-pane fade show active" id="addpayment" role="tabpanel" aria-labelledby="ex3-tab-1">
	  		<div class="mt-4">
	  			<div class="col-md-6 me-auto ms-auto">
			  		<h2 class="text-left font-weight-bold mb-1">Add New Products</h2>
    				<p class="grey-text text-left mt-1">Fill the form to add new products </p>
			  		<form class="" id="addProduct" method="POST" enctype="multipart/form-data">
			  			<div class="form-outline mb-5">
							<i class="far fa-user-circle trailing"></i>
							<input type="text" id="item" required="" placeholder="Product name" name="item" class="form-control form-icon-trailing">
							<label for="item" class="form-label">Product name</label>
						</div>
						<div class="form-outline mb-5">
							<i class="far fa-money-bill trailing"></i>
							<input type="text" placeholder="Price" id="price" required="" name="price" class="form-control form-icon-trailing">
							<label for="price" class="form-label">Price</label>
						</div>
						<div class="form-outline mb-5">
							<i class="far fa-money-bill trailing"></i>
							<textarea rows="5" placeholder="Description" id="description" required="" name="description" class="form-control form-icon-trailing"></textarea>
							<label for="description" class="form-label">Description</label>
						</div>
						<div class="form-outline mt-3 mb-4">
	                        <i class="far fa-image trailing"></i>
	                        <label class="form-label ps-1" for="image"> Product Image</label>
	                        <input type="file" required="" class="form-control form-icon-trailing" name="image" id="image">
	                    </div>
						<div class="" align="center">
							<p class="alert alert-success py-3 mt-3 text-center" id="errorshows"></p>
						</div>
						<center>
							<div class="col-md-6 me-auto ms-auto mb-3">
								<button type="submit" id="btnAdd" class="btn btn-md btn-block btn-success btn-rounded z-depth-1a">Add Product</button>
							</div>
						</center>
					</form>
			  	</div>
			</div>
	  	</div>
	  	<div class="tab-pane fade show" id="allpaymenttab" role="tabpanel" aria-labelledby="ex3-tab-2">
	  		<div class="form-group" align="center">
	        	<p class="alert alert-success" id="errorshow"></p>
	        </div>
	        <div class="form-outline mb-4 ms-auto col-lg-4">
	           	<i class="far fa-search trailing"></i>
			    <input type="text" class="form-control" id="pay-search-input" />
			    <label class="form-label" for="pay-search-input">Search</label>
			</div>
	        <div id="paytab" class="datatable">
				<div class="datatable-inner table-responsive">
					<table class="table datatable-table hoverable table-striped table-hover">
		                <thead class="datatable-header">
		                    <tr class="text-nowrap">
		                        <th scope="col">S/N</th>
		                        <th scope="col">Product ID</th>
			                 	<th scope="col">Name</th>
			                   	<th scope="col">Price</th>
			                   	<th scope="col">Date Added</th>
			                   	<th scope="col">Status</th>
	                            <th scope="col">Edit</th>
	                            <th scope="col">Delete</th>
		                    </tr>
	                    </thead>
	                    <?php
	                        $sql = $db_conn->prepare("SELECT * FROM products ORDER BY main_id DESC");
	                        $sql->execute();
	                        $b = 1;
	                    ?>
	                    <tbody class="datatable-body">
	                       	<?php if ($sql->rowCount() < 1) { echo "<tr class='text-center' colspan='9'><td class='text-center fw-bold'>No payments available to show</td></tr>"; }else{
	                            while ($row = $sql->fetch(PDO::FETCH_ASSOC)): ?>
	                        <tr class="text-nowrap">
	                           	<td class="text-start"><?= $b; ?></td>
	                            <td class="text-start"><?= $row['main_id']; ?></td>
	                            <td class="text-start">
	                               	<div class="d-flex align-items-center">
				           				<img src="../assets/images/products/<?= $row['image']; ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
				           				<div class="ms-3">
				           					<p class="fw-bold"><?= $row['item']; ?></p>
				           				</div>
				           			</div>
	                            </td>
	                            <td class="text-start">R<?= number_format($row['price'],2); ?></td>
	                            <td class="text-start"><?= $row['date_added']; ?></td>
	                            <td class="text-start font-weight-bold"><?php if($row['status'] == 1){ echo "<span class='text-success'>Available <span class='fas fa-check-circle'></span></span>"; }elseif($row['status'] == 0){ echo "<span class='text-danger'>Out of Stock <span class='fas fa-exclamation-circle'></span></span>"; } ?></td>
	                            <td class="text-start"><a href="editproduct?main_id=<?= $row['main_id']; ?>" class="btn btn-sm btn-rounded btn-secondary">Edit</a></td>
	                            <td class="text-start"><button onclick="deletep<?= $row['main_id']; ?>()" id="btnDel<?= $row['main_id']; ?>" class="btn btn-sm btn-rounded btn-danger">Delete Product</button></td>
	                            <script>
	                            	function deletep<?= $row['main_id']; ?>(){
	                            		var main_id = "<?= $row['main_id']; ?>";
	                            		var photo = "<?= $row['image']; ?>";
    									$.ajax({
	    								    type:'POST',
	    								    url:'../operation/products.php',
	    								    data:{request:'deleteproduct','main_id':main_id,'photo':photo},
	    								    beforeSend:function(){
	    								    	$('#errorshow').html("Deleting Product <span class='far fa-spinner fa-pulse'></span>").show();
	    								    	$('#btnDel<?= $row['main_id']; ?>').html("Deleting <span class='far fa-spinner fa-pulse'></span>");
	    								    },
	    								    success:function(result){
	    								    	var response = $.parseJSON(result);
		    								    if (response.status == "success") {
		    								    	$("#errorshow").html("Product deleted Successfully <span class='fas fa-check-circle'></span>").show();
		    								      	setTimeout(function(){
														location.reload();
													}, 4000);
		    								    }else{
		    								    	$("#errorshow").html("<span class='fas fa-exclamation-triangle'></span>" + response.message).show();
		    								    	setTimeout(function(){
														$("#errorshow").hide();
													}, 4000);
		    								    }
	    									},
	    									error:function(){
	    									   	$("#errorshow").html("<span class='fas fa-exclamation-triangle'></span> An error occured. Try again.").show();
	    									   	setTimeout(function(){
													$("#errorshow").hide();
												}, 4000);
	    									}
    									});
    								}
	                            </script>
	                            <?php  $b++; endwhile; } ?>
	                        </tr>
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
</div>
</main>
</body>
<?php include 'footer.php'; ?>
<script>
	$(document).ready(function(){
		$("#errorshows").hide();
		$("#errorshow").hide();
	});

	var TableDataPay = new Array();
    
	$('#paytab tr').each(function(row, tr){
	    TableDataPay[row]={
	        "S/N" : $(tr).find('td:eq(0)').text()
	        , "Fullname" :$(tr).find('td:eq(1)').text()
	        , "Username" : $(tr).find('td:eq(2)').text()
	        , "Email" : $(tr).find('td:eq(3)').text()
			, "Phone" : $(tr).find('td:eq(4)').text()
			, "Status" : $(tr).find('td:eq(5)').text()
			
	    }
	}); 
	TableDataPay.shift();
	const instancePay = new mdb.Datatable(document.getElementById("paytab"), TableDataPay)
    document.getElementById("pay-search-input").addEventListener('input', (e) => { instancePay.search(e.target.value); });

    $("form#addProduct").submit(function(e) {
	    e.preventDefault();    
	    var formData = new FormData(this);
	    var request = "addproduct";
	    formData.append('request', request);
	    $.ajax({
		    url: '../operation/products',
		    type: 'POST',
		    data: formData,
		    beforeSend:function(){
				$("#errorshows").html("Adding Products <span class='far fa-spinner fa-pulse fa-fw'></span>").show();
			},
		    success: function(result) {
		    	var response = $.parseJSON(result);
		       	setTimeout(function(){
		       		if(response.status == 'success'){
						$("#errorshows").html("<span class='far fa-check-circle'></span> Product added successfully").show();
						setTimeout(function(){
							location.reload();
						}, 4000);
			       	}else{
						$("#errorshows").html("<span class='far fa-exclamation-triangle'></span>  " + response.message).show();
			       	}
		       	}, 1000);
		    },
		    cache: false,
			error:function(err){
				setTimeout(function(){
					$("#errorshows").html("<span class='far fa-exclamation-triangle'></span>  " + err).show();
				}, 1000);
			},
			contentType: false,
			processData: false
		});
	});
</script>	
