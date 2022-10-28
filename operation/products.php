<?php include "connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$request = filter_var(htmlentities($_POST['request']),FILTER_UNSAFE_RAW);

	switch ($request) {
		case 'addcart':
			if(isset($_SESSION['user_id']) AND isset($_POST['main_id'])){
				$main_id = filter_var(htmlentities($_POST['main_id']),FILTER_UNSAFE_RAW);
				$user_id = filter_var(htmlentities($_POST['user_id']),FILTER_UNSAFE_RAW);

				$getProd = $db_conn->prepare("SELECT * FROM products WHERE main_id = :main_id");
				$getProd->bindParam(":main_id", $main_id, PDO::PARAM_STR);
				$getProd->execute();

				$row = $getProd->fetch(PDO::FETCH_ASSOC);

				$name = $row['item'];
				$id = $row['main_id'];
				$price = $row['price'];
				$image = $row['image'];

				$cartArray = array($id=>array('name'=>$name, 'id'=>$id, 'price'=>$price, 'quantity'=>1, 'image'=>$image));



				if(empty($_SESSION["shopping_cart"])) {
					$status = "Product is added successfully to your cart!";
				    $_SESSION["shopping_cart"] = $cartArray;
				    echo json_encode([
			            "status"=> "success",
			            "message"=>$status
			        ]);
				}else{
				    $array_keys = array_keys($_SESSION["shopping_cart"]);
				    if(in_array($id,$array_keys)){
						$status = "Product already exists in your cart!";
						$_SESSION['shopping_cart'][$id]['quantity'] += 1;
						echo json_encode([
					        "status"=> "exists",
					        "message"=>$status
					    ]);
				    }else{
					    $_SESSION["shopping_cart"] += $cartArray;
					    $status = "Product is added successfully to your cart!";
						echo json_encode([
						    "status"=> "success",
						    "message"=>$status
						]);
					}
				}
			}else{
				if (isset($_POST['main_id'])) {
					$main_id = filter_var(htmlentities($_POST['main_id']),FILTER_UNSAFE_RAW);
					$getProd = $db_conn->prepare("SELECT * FROM products WHERE main_id = :main_id");
					$getProd->bindParam(":main_id", $main_id, PDO::PARAM_STR);
					$getProd->execute();

					$row = $getProd->fetch(PDO::FETCH_ASSOC);

					$name = $row['item'];
					$id = $row['main_id'];
					$price = $row['price'];
					$image = $row['image'];

					$cartArray = array($id=>array('name'=>$name, 'id'=>$id, 'price'=>$price, 'quantity'=>1, 'image'=>$image));



					if(empty($_SESSION["shopping_cart"])) {
						$status = "Product is added successfully to your cart!";
					    $_SESSION["shopping_cart"] = $cartArray;
					    echo json_encode([
				            "status"=> "success",
				            "message"=>$status
				        ]);
					}else{
					    $array_keys = array_keys($_SESSION["shopping_cart"]);
					    if(in_array($id,$array_keys)){
							$status = "Product already exists in your cart!";
							$_SESSION['shopping_cart'][$id]['quantity'] += 1;
							echo json_encode([
						        "status"=> "exists",
						        "message"=>$status
						    ]);
					    }else{
						    $_SESSION["shopping_cart"] += $cartArray;
						    $status = "Product is added successfully to your cart!";
							echo json_encode([
							    "status"=> "success",
							    "message"=>$status
							]);
						}
					}
				}else{
					echo json_encode([
					    "status"=> "none",
					    "message"=>"Please select an item to add to cart"
					]);
				}
			}
			break;
		case 'removecart':
			if(isset($_SESSION['user_id']) AND isset($_POST['main_id'])){
				$main_id = filter_var(htmlentities($_POST['main_id']),FILTER_UNSAFE_RAW);
				if(!empty($_SESSION["shopping_cart"])) {

					foreach($_SESSION['shopping_cart'] as $key => $value){
						if (in_array($main_id, $value)) {
							$status = "Item has successfully been removed from cart";
							unset($_SESSION["shopping_cart"][$key]);
							echo json_encode([
						        "status"=> "success",
						        "message"=>$status
						    ]);
						    break;
						}
					}		
				}
				if(empty($_SESSION["shopping_cart"])){
					unset($_SESSION["shopping_cart"]);
				}
			}else{
				if (isset($_POST['main_id'])) {
					$main_id = filter_var(htmlentities($_POST['main_id']),FILTER_UNSAFE_RAW);
					if(!empty($_SESSION["shopping_cart"])) {

						foreach($_SESSION['shopping_cart'] as $key => $value){
							if (in_array($main_id, $value)) {
								$status = "Item has successfully been removed from cart";
								unset($_SESSION["shopping_cart"][$key]);
								echo json_encode([
							        "status"=> "success",
							        "message"=>$status
							    ]);
							    break;
							}
						}		
					}
					if(empty($_SESSION["shopping_cart"])){
						unset($_SESSION["shopping_cart"]);
					}
				}else{
					echo json_encode([
					    "status"=> "none",
					    "message"=>"Please select an item to remove"
					]);
				}
			}
			break;

		case 'addQty':
			if(isset($_SESSION['user_id']) AND isset($_POST['id'])){
				$id = filter_var(htmlentities($_POST['id']),FILTER_UNSAFE_RAW);
				foreach($_SESSION["shopping_cart"] as &$value){
				    if($value['id'] == $id){
				        $value['quantity'] += 1;
				        echo json_encode([
					        "status"=> "success",
					        "quantity"=>$value['quantity'],
					        "total"=>number_format($value['quantity'] * $value['price'], 2)
					    ]);
					    break;
				    }
				}
			}else{
				if (isset($_POST["id"])) {
					$id = filter_var(htmlentities($_POST['id']),FILTER_UNSAFE_RAW);
					foreach($_SESSION["shopping_cart"] as &$value){
					    if($value['id'] == $id){
					        $value['quantity'] += 1;
					        echo json_encode([
						        "status"=> "success",
						        "quantity"=>$value['quantity'],
						        "total"=>number_format($value['quantity'] * $value['price'], 2)
						    ]);
						    break;
					    }
					}
				}else{
					echo json_encode([
				        "status"=> "none",
				        "message"=>"Please select an item from the list"
				    ]);
				}
			}
			break;

		case 'removeQty':
			if(isset($_SESSION['user_id']) AND isset($_POST['id'])){
				$id = filter_var(htmlentities($_POST['id']),FILTER_UNSAFE_RAW);
				foreach($_SESSION["shopping_cart"] as &$value){
				    if($value['id'] == $id AND $value['quantity'] > 1){
				        $value['quantity'] -= 1;
				        echo json_encode([
					        "status"=> "removed",
					        "quantity"=>$value['quantity'],
					        "total"=>number_format($value['quantity'] * $value['price'], 2)
					    ]);
					    break;
				    }
				}
			}else{
				if (isset($_POST['id'])) {
					$id = filter_var(htmlentities($_POST['id']),FILTER_UNSAFE_RAW);
					foreach($_SESSION["shopping_cart"] as &$value){
					    if($value['id'] == $id AND $value['quantity'] > 1){
					        $value['quantity'] -= 1;
					        echo json_encode([
						        "status"=> "removed",
						        "quantity"=>$value['quantity'],
						        "total"=>number_format($value['quantity'] * $value['price'], 2)
						    ]);
						    break;
					    }
					}
				}else{
					echo json_encode([
				        "status"=> "none",
				        "message"=>"Please select an item from the list"
				    ]);
				}
			}
			break;

		case 'saveinvoice':
			if(isset($_SESSION['user_id']) AND $_SERVER['REQUEST_METHOD'] == "POST"){
				
				$json = $_POST["items"];
				$items = json_decode($json, true);

				$main_id = filter_var(htmlentities(str_pad(mt_rand(1,99999999),7,'0',STR_PAD_LEFT)),FILTER_UNSAFE_RAW);
				$user_id = filter_var(htmlentities($_SESSION['user_id']),FILTER_UNSAFE_RAW);
				$fullname = filter_var(htmlentities($_POST['fullname']),FILTER_UNSAFE_RAW);
				$email = filter_var(htmlentities($_POST['email']),FILTER_UNSAFE_RAW);
				$phone = filter_var(htmlentities($_POST['phone']),FILTER_UNSAFE_RAW);
				$address = filter_var(htmlentities($_POST['address']),FILTER_UNSAFE_RAW);
				$village = filter_var(htmlentities($_POST['village']),FILTER_UNSAFE_RAW);
				$payment = filter_var(htmlentities("0"),FILTER_UNSAFE_RAW);
				$date_added = filter_var(htmlentities(date("d M, Y")),FILTER_UNSAFE_RAW);

				$itemarr = array();
				$qtyarr = array();

				foreach ($items as $key => $value) {
					array_push($itemarr, $value['id']);
					array_push($qtyarr, $value['quantity']);

					arsort($qtyarr);
					arsort($itemarr);
				}

				$dbitem = implode(",", $itemarr);
				$dbqty = implode(",", $qtyarr);

				$insert = $db_conn->prepare("INSERT INTO orders (main_id, user_id, item, quantity, fullname, email, phone, address, village, payment_status, date_added) VALUES (:main_id, :user_id, :item, :quantity, :fullname, :email, :phone, :address, :village, :payment_status, :date_added)");
				$insert->bindParam(":main_id", $main_id, PDO::PARAM_STR);
				$insert->bindParam(":user_id", $user_id, PDO::PARAM_STR);
				$insert->bindParam(":item", $dbitem, PDO::PARAM_STR);
				$insert->bindParam(":quantity", $dbqty, PDO::PARAM_STR);
				$insert->bindParam(":fullname", $fullname, PDO::PARAM_STR);
				$insert->bindParam(":email", $email, PDO::PARAM_STR);
				$insert->bindParam(":phone", $phone, PDO::PARAM_STR);
				$insert->bindParam(":address", $address, PDO::PARAM_STR);
				$insert->bindParam(":village", $village, PDO::PARAM_STR);
				$insert->bindParam(":payment_status", $payment, PDO::PARAM_STR);
				$insert->bindParam(":date_added", $date_added, PDO::PARAM_STR);

				if ($insert->execute()) {
					echo json_encode([
				        "status"=> "success",
				        "order_id"=>$main_id
				    ]);
				}else{
					echo json_encode([
				        "status"=> "error",
				        "message"=> "An error has occured placing your order"
				    ]);
				}
			}else{
				echo json_encode([
			        "status"=> "none",
			        "message"=>"Please login or register to place an order"
			    ]);
			}
			break;
		case 'addproduct':
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$main_id = filter_var(htmlentities(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT)),FILTER_UNSAFE_RAW);
				$item = filter_var(htmlentities($_POST['item']),FILTER_UNSAFE_RAW);
				$description = filter_var(htmlentities($_POST['description']),FILTER_UNSAFE_RAW);
				$price = filter_var(htmlentities($_POST['price']),FILTER_UNSAFE_RAW);
				$status = filter_var(htmlentities("1"),FILTER_UNSAFE_RAW);
				$date_added = filter_var(htmlentities(date("d M, Y")),FILTER_UNSAFE_RAW);

				if ($main_id == null || $item == null || $description == null || $price == null || $status == null || $date_added == null) {
					echo json_encode([
						"status"=> "error",
					    "message"=>"<b>Error! </b> All fields are required"
					]);
				}else{
					$fileName = $_FILES["image"]["name"];
					$fileTmpLoc = $_FILES["image"]["tmp_name"];
					$fileType = $_FILES["image"]["type"];
					$fileSize = $_FILES["image"]["size"]; 
					$fileErrorMsg = $_FILES["image"]["error"];
					$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); 
					$kaboom = explode(".", $fileName);
					$fileExt = end($kaboom);
					$fileName = $main_id.".".$fileExt;

					if($fileSize > 8422145) {
						echo json_encode([
							"status"=> "error",
						    "message"=>"<b>Error! </b> Your image must be less than 8MB of size."
						]);
						unlink($fileTmpLoc); 
						exit();
					}
					if (!preg_match("/.(jpeg|jpg|png|webp)$/i", $fileName) ) {  
						echo json_encode([
							"status"=> "error",
						    "message"=>"<b>Error! </b> Your image was not jpeg, jpg, webp or png file."
						]);
						unlink($fileTmpLoc);
						exit();
					}
					if ($fileErrorMsg == 1) {
						echo json_encode([
							"status"=> "error",
						    "message"=>"<b>Error! </b> An error occured while processing the image. Try again."
						]);
						exit();
					}else{
						$moveResult = move_uploaded_file($fileTmpLoc, "../assets/images/products/$fileName");
						if ($moveResult != true) {
							echo json_encode([
								"status"=> "error",
							    "message"=>"<b>Error! </b> ERROR: File not uploaded. Try again."
							]);
							exit();
						}else{
							$insert = $db_conn->prepare("INSERT INTO products (main_id, item, description, price, date_added, image, status) VALUES (:main_id, :item, :description, :price, :date_added, :image, :status)");
							$insert->bindParam(":main_id", $main_id, PDO::PARAM_STR);
							$insert->bindParam(":item", $item, PDO::PARAM_STR);
							$insert->bindParam(":description", $description, PDO::PARAM_STR);
							$insert->bindParam(":price", $price, PDO::PARAM_STR);
							$insert->bindParam(":date_added", $date_added, PDO::PARAM_STR);
							$insert->bindParam(":image", $fileName, PDO::PARAM_STR);
							$insert->bindParam(":status", $status, PDO::PARAM_STR);
							if ($insert->execute()) {
								echo json_encode([
							        "status"=> "success",
							        "message"=>"Item has successfully been added"
							    ]);
							}else{
								echo json_encode([
							        "status"=> "error",
							        "message"=> "An error has occured placing your order"
							    ]);
							}
						}
					}
				}
			}else{
				echo json_encode([
			        "status"=> "error",
			        "message"=>"You have sent an invalid request"
			    ]);
			}
			break;

		case 'editproduct':
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$main_id = filter_var(htmlentities($_POST['main_id']),FILTER_UNSAFE_RAW);
				$photo = filter_var(htmlentities($_POST['photo']),FILTER_UNSAFE_RAW);
				$item = filter_var(htmlentities($_POST['item']),FILTER_UNSAFE_RAW);
				$description = filter_var(htmlentities($_POST['description']),FILTER_UNSAFE_RAW);
				$price = filter_var(htmlentities($_POST['price']),FILTER_UNSAFE_RAW);
				$status = filter_var(htmlentities($_POST['status']),FILTER_UNSAFE_RAW);

				if ($main_id == null || $item == null || $description == null || $price == null || $status == null || $photo == null && $_FILES["image"]["name"] == null) {
					echo json_encode([
						"status"=> "error",
					    "message"=>"<b>Error!</b> All fields are required"
					]);
				}elseif($_FILES["image"]["name"] != null){
					$fileName = $_FILES["image"]["name"];
					$fileTmpLoc = $_FILES["image"]["tmp_name"];
					$fileType = $_FILES["image"]["type"];
					$fileSize = $_FILES["image"]["size"]; 
					$fileErrorMsg = $_FILES["image"]["error"];
					$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); 
					$kaboom = explode(".", $fileName);
					$fileExt = end($kaboom);
					$fileName = $main_id.".".$fileExt;

					if($fileSize > 8422145) {
						echo json_encode([
							"status"=> "error",
						    "message"=>"<b>Error! </b> Your image must be less than 8MB of size."
						]);
						unlink($fileTmpLoc); 
						exit();
					}
					if (!preg_match("/.(jpeg|jpg|png|webp)$/i", $fileName) ) {  
						echo json_encode([
							"status"=> "error",
						    "message"=>"<b>Error! </b> Your image was not jpeg, jpg, webp or png file."
						]);
						unlink($fileTmpLoc);
						exit();
					}
					if ($fileErrorMsg == 1) {
						echo json_encode([
							"status"=> "error",
						    "message"=>"<b>Error! </b> An error occured while processing the image. Try again."
						]);
						exit();
					}else{
						if (file_exists("../assets/images/products/$photo")) {
							$del = unlink("../assets/images/products/$photo");
							if ($del) {
								$moveResult = move_uploaded_file($fileTmpLoc, "../assets/images/products/$fileName");
								if ($moveResult != true) {
									echo json_encode([
										"status"=> "error",
									    "message"=>"<b>Error! </b> ERROR: File not uploaded. Try again."
									]);
									exit();
								}else{
									$insert = $db_conn->prepare("UPDATE products SET item = :item, description = :description, price = :price, image = :image, status = :status WHERE main_id = :main_id");
									$insert->bindParam(":item", $item, PDO::PARAM_STR);
									$insert->bindParam(":description", $description, PDO::PARAM_STR);
									$insert->bindParam(":price", $price, PDO::PARAM_STR);
									$insert->bindParam(":image", $fileName, PDO::PARAM_STR);
									$insert->bindParam(":status", $status, PDO::PARAM_STR);
									$insert->bindParam(":main_id", $main_id, PDO::PARAM_STR);
									if ($insert->execute()) {
										echo json_encode([
									        "status"=> "success",
									        "message"=>"Item has successfully been updated"
									    ]);
									}else{
										echo json_encode([
									        "status"=> "error",
									        "message"=> "An error has occured placing your order"
									    ]);
									}
								}
							}

						}
					}
				}else{
					$insert = $db_conn->prepare("UPDATE products SET item = :item, description = :description, price = :price, status = :status WHERE main_id = :main_id");
					$insert->bindParam(":item", $item, PDO::PARAM_STR);
					$insert->bindParam(":description", $description, PDO::PARAM_STR);
					$insert->bindParam(":price", $price, PDO::PARAM_STR);
					$insert->bindParam(":status", $status, PDO::PARAM_STR);
					$insert->bindParam(":main_id", $main_id, PDO::PARAM_STR);
					if ($insert->execute()) {
						echo json_encode([
					        "status"=> "success",
					        "message"=>"Item has successfully been updated"
					    ]);
					}else{
						echo json_encode([
					        "status"=> "error",
					        "message"=> "An error has occured placing your order"
					    ]);
					}
				}
			}else{
				echo json_encode([
			        "status"=> "error",
			        "message"=>"<b>Error!</b> You have sent an invalid request"
			    ]);
			}
			break;

		case 'deleteproduct':
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$main_id = filter_var(htmlentities($_POST['main_id']),FILTER_UNSAFE_RAW);
				$photo = filter_var(htmlentities($_POST['photo']),FILTER_UNSAFE_RAW);

				if ($main_id != null && $photo != null) {

					if (file_exists("../assets/images/products/$photo")) {
						$del = unlink("../assets/images/products/$photo");
						if ($del) {
							$delProduct = $db_conn->prepare("DELETE FROM products where main_id = :main_id");
							$delProduct->bindParam(":main_id", $main_id, PDO::PARAM_STR);
							if ($delProduct->execute()) {
								echo json_encode([
									"status"=> "success",
								    "message"=>"Deleted"
								]);
							}else{
								echo json_encode([
									"status"=> "error",
								    "message"=>"<b>Error!</b> An error occured while deleting this products"
								]);
							}
						}
					}else{
						$delProduct = $db_conn->prepare("DELETE FROM products where main_id = :main_id");
						$delProduct->bindParam(":main_id", $main_id, PDO::PARAM_STR);
						if ($delProduct->execute()) {
							echo json_encode([
								"status"=> "success",
							    "message"=>"Deleted"
							]);
						}else{
							echo json_encode([
								"status"=> "error",
							    "message"=>"<b>Error!</b> An error occured while deleting this products"
							]);
						}
					}
				}
			}else{
				echo json_encode([
			        "status"=> "error",
			        "message"=>"<b>Error!</b> You have sent an invalid request"
			    ]);
			}
			break;
		
		default:
			// code...
			break;
	}
}

?>