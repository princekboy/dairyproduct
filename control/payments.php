<?php include 'header.php'; ?>
<title>Payments | <?= SITE_NAME; ?></title>
<div class="card shadow-3 mt-5 px-3 py-2 me-auto ms-auto">
	<div class="card-body">
		<div class="form-group" align="center">
	        <p class="alert alert-success" id="errorshow"></p>
	    </div>
	    <div class="form-outline mb-4 ms-auto col-lg-4">
	    	<i class="far fa-search trailing"></i>
	    	<input type="text" class="form-control form-icon-trailing" id="pay-search-input" />
	    	<label class="form-label" for="pay-search-input">Search</label>
	    </div>
	    <div id="paytab" class="datatable">
	    	<div class="datatable-inner table-responsive">
	    		<table class="table datatable-table hoverable table-striped table-hover">
	    			<thead class="datatable-header">
	    				<tr class="text-nowrap">
	    					<th scope="col"> S/N</th>
	    					<th scope="col"> Payment ID</th>
	    					<th scope="col"> Fullname</th>
	    					<th scope="col"> Email</th>
	    					<th scope="col"> Reference</th>
	    					<th scope="col"> Amount</th>
	    					<th scope="col"> Order ID</th>
	    					<th scope="col"> Date Paid</th>
	    					<th scope="col"> Status</th>
	    					<th scope="col"> Action</th>
	    					<th scope="col"> Delete</th>
	    				</tr>
	    			</thead>
	    			<?php
	                    $sql = $db_conn->prepare("SELECT * FROM payments, users WHERE payments.user_id = users.user_id ORDER BY payments.pay_date DESC");
	                    $sql->execute();
	                    $b = 1;
	                ?>
	                <tbody class="datatable-body">
	                	<?php if ($sql->rowCount() < 1) { echo "<tr class='text-center' colspan='9'><td class='text-center fw-bold'>No payments available to show</td></tr>"; }else{
	                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)): ?>
						<tr class="text-nowrap">
	                       	<td class="text-start"><span class="fw-bold"><?= $b; ?></span></td>
	                       	<td class="text-start"><span class="fw-bold"><?= $row['payment_id']; ?></span></td>
	                       	<td class="text-start"><span class="fw-bold"><?= $row['fullname']; ?></span></td>
	                       	<td class="text-start"><span class="fw-bold"><?= $row['email']; ?></span></td>
	                       	<td class="text-start"><span class="fw-bold"><?= $row['reference']; ?></span></td>
	                       	<td class="text-start"><span class="fw-bold">R<?= number_format($row['amount'],2); ?></span></td>
	                       	<td class="text-start"><span class="fw-bold"><?= $row['order_id']; ?></span></td>
	                       	<td class="text-start"><span class="fw-bold"><?= $row['pay_date']; ?></span></td>
	                       	<td class="text-start fw-bold"><?php if($row['status'] == 1){ echo "<span class='text-success'>Successful <span class='fas fa-check-circle'></span></span>"; }elseif($row['status'] == 0){ echo "<span class='text-danger'>Failed <span class='fas fa-exclamation-circle'></span></span>"; } ?></td>
	                       	<?php if ($row['status'] == 0) { ?>
	                       		<td class="text-start"><button onclick="approvep<?= $row['payment_id']; ?>()" id="btnApprove<?= $row['payment_id']; ?>" class="btn btn-sm btn-rounded btn-success">Approve</button></td>
	                       	<?php }elseif ($row['status'] == 1){ ?>
	                       		<td class="text-start"><button onclick="unapprovep<?= $row['payment_id']; ?>()" id="btnUnApprove<?= $row['payment_id']; ?>" class="btn btn-sm btn-rounded btn-info">Unpprove</button></td>
	                       	<?php } ?>
	                       	<td class="text-start"><button onclick="deletep<?= $row['payment_id']; ?>()" id="btnDel<?= $row['payment_id']; ?>" class="btn btn-sm btn-rounded btn-danger">Delete</button></td>
	                       	<script>
	                       		function approvep<?= $row['payment_id']; ?>(){
    							    var payment_id = "<?= $row['payment_id']; ?>";
    							    var user_id = "<?= $row['user_id']; ?>";
    							    $.ajax({
	    							    type:'POST',
	    							    url:'../operation/payments.php',
	    							    data:{request:'approvepayment','user_id':user_id,'payment_id':payment_id},
	    							    beforeSend:function(){
	    							    	$('#errorshow').html("Approving payment <span class='far fa-spinner fa-pulse'></span>").show();
	    							    	$('#btnApprove<?= $row['payment_id']; ?>').html("Approving <span class='far fa-spinner fa-pulse'></span>");
	    							    },
	    							    success:function(data){
		    							    if (data == "success") {
		    							    	$("#errorshow").html("Payment approved Successfully <span class='fas fa-check-circle'></span>").show();
		    							      	setTimeout(function(){
													location.reload();
												}, 4000);
		    							    }else{
		    							    	$("#errorshow").html("<span class='fas fa-exclamation-triangle'></span>" + data).show();
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

    							function unapprovep<?= $row['payment_id']; ?>(){
    							    var payment_id = "<?= $row['payment_id']; ?>";
    							    var user_id = "<?= $row['user_id']; ?>";
    							    $.ajax({
	    							    type:'POST',
	    							    url:'../operation/payments.php',
	    							    data:{request:'unapprovepayment','user_id':user_id,'payment_id':payment_id},
	    							    beforeSend:function(){
	    							    	$('#errorshow').html("Unapproving payment <span class='far fa-spinner fa-pulse'></span>").show();
	    							    	$('#btnUnApprove<?= $row['payment_id']; ?>').html("Unapproving <span class='far fa-spinner fa-pulse'></span>");
	    							    },
	    							    success:function(data){
		    							    if (data == "success") {
		    							    	$("#errorshow").html("Payment unapproved Successfully <span class='fas fa-check-circle'></span>").show();
		    							      	setTimeout(function(){
													location.reload();
												}, 4000);
		    							    }else{
		    							    	$("#errorshow").html("<span class='fas fa-exclamation-triangle'></span>" + data).show();
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


    							function deletep<?= $row['payment_id']; ?>(){
    							    var payment_id = "<?= $row['payment_id']; ?>";
    							    var user_id = "<?= $row['user_id']; ?>";
    							    $.ajax({
	    							    type:'POST',
	    							    url:'../operation/payments.php',
	    							    data:{request:'deletepayment','payment_id':payment_id,'user_id':user_id},
	    							    beforeSend:function(){
	    							    	$('#errorshow').html("Deleting payment <span class='far fa-spinner fa-pulse'></span>").show();
	    							    	$('#btnDel<?= $row['payment_id']; ?>').html("Deleting <span class='far fa-spinner fa-pulse'></span>");
	    							    },
	    							    success:function(data){
		    							    if (data == "success") {
		    							    	$("#errorshow").html("Payment deleted Successfully <span class='fas fa-check-circle'></span>").show();
		    							      	setTimeout(function(){
													location.reload();
												}, 4000);
		    							    }else{
		    							    	$("#errorshow").html("<span class='fas fa-exclamation-triangle'></span>" + data).show();
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
</main>
</body>
<?php include 'footer.php'; ?>
<script>
	$(document).ready(function(){
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
</script>	
