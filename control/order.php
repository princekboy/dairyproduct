<?php include 'header.php'; 

if(isset($_GET["user_id"]) AND isset($_GET['order_id'])){
	$user_id = $_GET['user_id'];
	$order_id = $_GET['order_id'];
    $sql = $db_conn->prepare("SELECT user_id FROM users WHERE user_id = :user_id");
    $sql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $sql->execute();
    if ($sql->rowCount() < 0) {
    	header("Location: ./");
    }
}else{
	header("Location: ./");
}

$sql = $db_conn->prepare("SELECT * FROM orders WHERE user_id = :user_id AND main_id = :order_id");
$sql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
$sql->bindParam(":order_id", $order_id, PDO::PARAM_STR);
$sql->execute();

$row = $sql->fetch(PDO::FETCH_ASSOC);


$total = 0; 
?>
<title>Order Details | <?= SITE_NAME; ?></title>
<div class="card shadow-3 col-md-12 mt-5 mb-4 px-3 py-3 me-auto ms-auto">
	<div class="card-body">
		<h2 class="text-start font-weight-bold mb-1">Order Details</h2>
		<div class="row mb-3">
    		<div class="col-lg-12 col-md-12">
    			<div class="card card-cascade shadow-3">
    				<div class="card-body p-4">
    					<h4>User Details</h4><hr>
    					<h6 class="text-start mb-4">Name: <span class="fw-bolder"><?= $row['fullname']; ?></span></h6>
    					<h6 class="text-start mb-4">Email: <span class="fw-bolder"><?= $row['email']; ?></span></h6>
    					<h6 class="text-start mb-4">Phone Number: <span class="fw-bolder"><?= $row['phone']; ?></span></h6>
    					<h6 class="text-start mb-4">Delivery Address: <span class="fw-bolder"><?= $row['address']; ?></span></h6>
    					<h6 class="text-start mb-4">Village: <span class="fw-bolder"><?= $row['village']; ?></span></h6>
    				</div>
    			</div>
    		</div>
    	</div>
		<?php
       		$items = explode(",", $row['item']);
       		$qtys = explode(",", $row['quantity']);

       		$productArr = [];

       		foreach ($items as $key => $value) {
       			$sql1 = $db_conn->prepare("SELECT * FROM products WHERE main_id = :main_id");
       			$sql1->bindParam(":main_id", $value, PDO::PARAM_STR);
       			$sql1->execute();

       			$row1 = $sql1->fetch(PDO::FETCH_ASSOC);

       			$productArr[] = array('id'=>$row1['main_id'],'image'=>$row1['image'],'name'=>$row1['item'],'price'=>$row1['price'],'quantity'=>$qtys[$key]);
       		}
       	?>
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
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $i = 1;
	                		foreach ($productArr as $cart){ ?>
	                	<tr>
		             		<td>#<?= $i; ?></td>
		              		<td>
		            			<div class="d-flex align-items-center">
		               				<img src="../assets/images/products/<?= $cart['image']; ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
		               				<div class="ms-3">
		           						<p class="fw-bold"><?= $cart['name']; ?></p>
		           					</div>
		              			</div>
	                		</td>
	                		<td><p class="fw-normal mb-1">R<?= number_format($cart['price'], 2); ?></p></td>
	                		<td><span class="rounded-pill d-inline"><?= $cart['quantity']; ?></span></td>
	                		<td><p class="fw-normal">R<?= number_format($cart['price'] * $cart['quantity'], 2); ?></p></td>
	                	</tr>
	                	<?php $total += $cart['price'] * $cart['quantity'];  $i++; } ?>
	                	<tr class="fw-bold">
	                		<td scope="row">#</td>
	                		<td class="fw-bold"><span class="fw-bold">Total</span></td><td> </td><td> </td>
	                		<td><span class="fw-bold text-end">R<?= number_format($total, 2); ?></span></td>
	                	</tr>
	                </tbody>
	            </table>
	        </div>
	   	</div>
	</div>
</div>
</div>
</main>
<!--Main layout-->
<?php include 'footer.php'; ?>

<script>
var TableDataGifts = new Array();
    
		$('#cart tr').each(function(row, tr){
		    TableDataGifts[row]={
		        "S/N" : $(tr).find('td:eq(0)').text()
		        , "Item" :$(tr).find('td:eq(1)').text()
		        , "Price" : $(tr).find('td:eq(2)').text()
		        , "Quantity" : $(tr).find('td:eq(3)').text()
				, "Total" : $(tr).find('td:eq(4)').text()
				
		    }
		}); 
		TableDataGifts.shift();
	const instanceMedia = new mdb.Datatable(document.getElementById("cart"), TableDataGifts)
    document.getElementById("cart-search-input").addEventListener('input', (e) => { instanceMedia.search(e.target.value); });
</script>