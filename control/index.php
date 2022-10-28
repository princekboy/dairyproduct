<?php include 'header.php'; ?>
<title>Dashboard | <?= SITE_NAME; ?></title>
<div class="card shadow-3 col-md-12 mt-5 mb-4 px-3 py-3 me-auto ms-auto">
	<div class="card-body">
		<h3 class="text-start font-weight-bold mb-1 primary">All Orders</h3>
		<div class="form-outline mb-4 ms-auto col-lg-4">
			<i class="far fa-search trailing"></i>
			<input type="text" class="form-control" id="upload-search-input" />
			<label class="form-label" for="upload-search-input">Search</label>
		</div>
		<div class="form-group" align="center">
			<p class="alert alert-secondary" id="errorshow2"></p>
		</div>
		<div class="datatable" id="upload">
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
		            <tbody class="datatable-body">
		            	<?php $i = 1;
			                $sql = $db_conn->prepare("SELECT * FROM orders");
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

 <div class="card shadow-3 mt-5 px-3 py-2 me-auto ms-auto">
 	<div class="card-body card-body-cascade">
		<h4 class="text-center fw-bold">All Users</h4>
	    <div class="form-outline mb-4 ms-auto col-lg-4">
	       	<i class="far fa-search trailing"></i>
	       	<input type="text" class="form-control" id="user-search-input" />
			<label class="form-label" for="user-search-input">Search</label>
		</div>
		<div id="usertab" class="datatable">
			<div class="datatable-inner table-responsive">
				<table class="table datatable-table hoverable table-striped table-hover">
					<thead class="datatable-header">
						<tr class="text-nowrap">
							<th scope="col"> S/N</th>
							<th scope="col"> Fullname</th>
							<th scope="col"> Username</th>
							<th scope="col"> Email</th>
							<th scope="col"> Phone</th>
							<th scope="col"> View</th>
						</tr>
					</thead>
					<?php
						$sql = $db_conn->prepare("SELECT * FROM users");
						$sql->execute();
						$b = 1;
	                ?>
	                <tbody class="datatable-body">
	                	<div class="text-center" align="center"><?php if ($sql->rowCount() < 1) { echo "<td class='text-center' colspan='8'>No user available to show</td>"; }else{
	                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)): ?></div>
	                    <tr class="text-nowrap">
	                       	<td class="text-left"><?= $b; ?></td>
	                       	<td class="text-left"><?= $row['fullname']; ?></td>
	                       	<td class="text-left"><?= $row['username']; ?></td>
	                       	<td class="text-left"><?= $row['email']; ?></td>
	                       	<td class="text-left"><?= $row['phone']; ?></td>
	                       	<td class="text-left font-weight-bold"><a target="_blank" href="./user?userid=<?= $row['user_id']; ?>" class="btn btn-sm btn-rounded btn-info">View</a></td>
	                       	<?php  $b++; endwhile; } ?>
	                    </tr>
	                </tbody>
	            </table>
			</div>
		</div>
	</div>
</div>
</main>
<!--Main layout-->
<?php include 'footer.php'; ?>
<script>
	$(document).ready(function(){
		$("#errorshow2").hide();
	});


	var TableDataUser = new Array();
    
		$('#usertab tr').each(function(row, tr){
		    TableDataUser[row]={
		        "S/N" : $(tr).find('td:eq(0)').text()
		        , "Fullname" :$(tr).find('td:eq(1)').text()
		        , "Username" : $(tr).find('td:eq(2)').text()
		        , "Email" : $(tr).find('td:eq(3)').text()
				, "Phone" : $(tr).find('td:eq(4)').text()
				, "Status" : $(tr).find('td:eq(5)').text()
				
		    }
		}); 
		TableDataUser.shift();
	const instanceUser = new mdb.Datatable(document.getElementById("usertab"), TableDataUser)
    document.getElementById("user-search-input").addEventListener('input', (e) => { instanceUser.search(e.target.value); });

	var TableDataGifts = new Array();
    
		$('#upload tr').each(function(row, tr){
		    TableDataGifts[row]={
		        "S/N" : $(tr).find('td:eq(0)').text()
		        , "Date Added" :$(tr).find('td:eq(1)').text()
		        , "Title" : $(tr).find('td:eq(2)').text()
		        , "Type" : $(tr).find('td:eq(3)').text()
				, "Status" : $(tr).find('td:eq(4)').text()
				
		    }
		}); 
		TableDataGifts.shift();
	const instanceUpload = new mdb.Datatable(document.getElementById("upload"), TableDataGifts)
    document.getElementById("upload-search-input").addEventListener('input', (e) => { instanceUpload.search(e.target.value); });
</script>