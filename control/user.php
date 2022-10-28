<?php include 'header.php'; 

if (isset($_GET['userid'])) {
	$user_id = $_GET['userid'];

	$getuser = $db_conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
	$getuser->bindParam(":user_id", $user_id, PDO::PARAM_STR);
	$getuser->execute();
	if ($getuser->rowCount() < 1) {
		header('Location: ./users');
	}else{
		$userrow = $getuser->fetch(PDO::FETCH_ASSOC);
	}
}else{
	header('Location: ./users');
}

?>

<title>User - <?= $user_id; ?> | <?= SITE_NAME; ?></title>
	<main style="margin-top: 76px; height:100%;" class="h-100" id="content">
		<div class="container-fluid text-start mt-5 h-100">
			<div class="card shadow-3 col-md-12 mt-2 mb-2 px-3 py-2 me-auto ms-auto">
				<h4 class="font-weight-bold text-center pt-3 pb-1">User Profile</h4><hr>
				<div class="px-3">
					<div class="d-flex mt-4 mb-5">
			  			<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">User ID</span></div>
						<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;">#<?= $userrow['user_id']; ?></span></div>
					</div>
					<div class="d-flex mt-4 mb-5">
			  			<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Full name</span></div>
						<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $userrow['fullname']; ?></span></div>
					</div>
					<div class="d-flex mt-4 mb-5">
			  			<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Username</span></div>
						<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $userrow['username']; ?></span></div>
					</div>
					<div class="d-flex mt-4 mb-5">
			  			<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Email</span></div>
						<div class="justify-content-end ps-5 text-wrap"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $userrow['email']; ?></span></div>
					</div>
					<div class="d-flex mt-4 mb-5">
			  			<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Phone number</span></div>
						<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $userrow['phone']; ?></span></div>
					</div>
				</div>
			</div>
			<div class="card shadow-3 col-md-12 mt-5 mb-4 px-3 py-2 me-auto ms-auto">
				<div class="card-body">
					<h4 class="text-start fw-bold">All Orders</h4>
					<div class="form-outline mb-4 ms-auto col-lg-4 col-md-12">
		        		<i class="far fa-search trailing"></i>
					    <input type="text" class="form-control form-icon-trailing" id="cart-search-input" />
					    <label class="form-label" for="cart-search-input">Search</label>
					</div>
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
				                		<td><a href="./order?user_id=<?= $row['user_id']; ?>&order_id=<?= $row['main_id']; ?>" class="btn btn-link btn-sm btn-rounded"><span class="fas fa-eye pe-2" ></span>View Details</a>
				                		</td>
				                	</tr>
				                	<?php $i++; endwhile; ?>
				                </tbody>
				            </table>
				        </div>
		        	</div>
				</div>
			</div>
		</div>
		</div>
	</main>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function(){
	$("#errorshow1").hide();
	$("#errorshow2").hide();
});

var TableDataGifts = new Array();
    
		$('#cart tr').each(function(row, tr){
		    TableDataGifts[row]={
		        "S/N" : $(tr).find('td:eq(0)').text()
		        , "Date Added" :$(tr).find('td:eq(1)').text()
		        , "Title" : $(tr).find('td:eq(2)').text()
		        , "Type" : $(tr).find('td:eq(3)').text()
				, "Status" : $(tr).find('td:eq(4)').text()
				
		    }
		}); 
		TableDataGifts.shift();
	const instanceMedia = new mdb.Datatable(document.getElementById("cart"), TableDataGifts)
    document.getElementById("cart-search-input").addEventListener('input', (e) => { instanceMedia.search(e.target.value); });
</script>