<?php 
    if(isset($_POST['status']) AND $_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['txnid'])){
        include "./connect.php";
        //* check payment status
        if($_POST['status'] == 'cancelled'){
        	echo json_encode([
        		"status" => "cancelled",
                "response" => "<b>Error! </b> Your payment has been cancelled. Try again."
            ]);
        }elseif($_POST['status'] == 'successful'){
        	$transac_id = filter_var(htmlentities($_POST['txnid']),FILTER_UNSAFE_RAW);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$transac_id}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  "Authorization: Bearer FLWSECK_TEST-be33dd177face5e1ce24e94b13f7f975-X"
                ),
            ));
              
            $response = curl_exec($curl);
              
            curl_close($curl);
              
            $res = json_decode($response);

            if($res->status == "success"){
                $amountPaid = $res->data->charged_amount;
                $charges = $res->data->app_fee;
                $amountToPay = $amountPaid - $charges;
                if($amountPaid  >= $amountToPay){

                    $payid = filter_var(htmlentities($transac_id),FILTER_UNSAFE_RAW);
                    $reference = filter_var(htmlentities($_POST['reference']),FILTER_UNSAFE_RAW);
			        $user_id = filter_var(htmlentities($_POST['user_id']),FILTER_UNSAFE_RAW);
			        $email = filter_var(htmlentities($_POST['email']),FILTER_UNSAFE_RAW);
			        $total = filter_var(htmlentities($_POST['total']),FILTER_UNSAFE_RAW);
			        $order_id = filter_var(htmlentities($_POST['order_id']),FILTER_UNSAFE_RAW);
			        $paydate = filter_var(htmlentities(date("d M, Y")),FILTER_UNSAFE_RAW);
					$status = filter_var(htmlentities("1"),FILTER_UNSAFE_RAW);
                    $amount = filter_var(htmlentities($amountToPay),FILTER_UNSAFE_RAW);
                        
                    $chekRef = $db_conn->prepare("SELECT * FROM payments WHERE reference = :ref");
                    $chekRef->bindParam(":ref", $reference, PDO::PARAM_STR);
                    $chekRef->execute();

                    if($chekRef->rowCount() > 0){
                    	echo json_encode([
			                "message" => "<b>Error! </b> This payment reference already exists. Please contact the admin."
			            ]);
                        exit();
                    }else{
                    	if ($reference != $res->data->tx_ref){
                        	echo json_encode([
				                "message" => "<b>Error! </b> An error occured. Fraud Detected."
				            ]);
                        }else{
                        	$insertDb = $db_conn->prepare("INSERT into payments (payment_id, reference, user_id, amount, pay_date, status, order_id) VALUES (:payment_id, :reference, :user_id, :amount, :pay_date, :status, :order_id)");
                            $insertDb->bindParam(':payment_id', $payid, PDO::PARAM_STR);
                            $insertDb->bindParam(':reference', $reference, PDO::PARAM_STR);
                            $insertDb->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                            $insertDb->bindParam(':amount', $total, PDO::PARAM_STR);
                            $insertDb->bindParam(':pay_date', $paydate, PDO::PARAM_STR);
                            $insertDb->bindParam(':status', $status, PDO::PARAM_STR);
                            $insertDb->bindParam(':order_id', $order_id, PDO::PARAM_STR);
                            if($insertDb->execute()){
                                $updateOrder = $db_conn->prepare("UPDATE orders SET payment_status = :status WHERE user_id = :user_id AND main_id = :order_id");
	                            $updateOrder->bindParam(':status', $status, PDO::PARAM_STR);
	                            $updateOrder->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	                            $updateOrder->bindParam(':order_id', $order_id, PDO::PARAM_STR);
	                            if($updateOrder->execute()){
						            echo json_encode([
							            "message" => "<b>Info! </b> Your payment was processed successfully",
		                            	"status" => $res->status
							        ]);
						            unset($_SESSION['shopping_cart']);
	                            }else{
	                            	echo json_encode([
						                "message" => "<b>Error! </b> An error occured while confirming your payment",
	                            		"status" => $res->status
						            ]);
	                            }
	                        }else{
                            	$status = 0;
                                $insertDb = $db_conn->prepare("INSERT into payments (payment_id, reference, user_id, amount, pay_date, status, order_id) VALUES (:payment_id, :reference, :user_id, :amount, :pay_date, :status, :order_id)");
	                            $insertDb->bindParam(':payment_id', $payid, PDO::PARAM_STR);
	                            $insertDb->bindParam(':reference', $reference, PDO::PARAM_STR);
	                            $insertDb->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	                            $insertDb->bindParam(':amount', $total, PDO::PARAM_STR);
	                            $insertDb->bindParam(':pay_date', $paydate, PDO::PARAM_STR);
	                            $insertDb->bindParam(':status', $status, PDO::PARAM_STR);
	                            $insertDb->bindParam(':order_id', $order_id, PDO::PARAM_STR);
	                            if($insertDb->execute()){
	                                $updateOrder = $db_conn->prepare("UPDATE orders SET payment_status = :status WHERE user_id = :user_id AND main_id = :order_id");
		                            $updateOrder->bindParam(':status', $status, PDO::PARAM_STR);
		                            $updateOrder->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		                            $updateOrder->bindParam(':order_id', $order_id, PDO::PARAM_STR);
		                            if($updateOrder->execute()){
		                            	echo json_encode([
							                "message" => "<b>Info! </b> Your payment was processed successfully, an error occured while updating payment, please cotact the admin to confirm payment",
		                            		"status" => $res->status
							            ]);
							            unset($_SESSION['shopping_cart']);
		                            }else{
		                            	echo json_encode([
							                "message" => "<b>Error! </b> An error occured while confirming your payment",
		                            		"status" => $res->status
							            ]);
		                            }
		                        }
	                        }
                        }
                    }
                }else{
                	echo json_encode([
                		"message" => "<b>Error! </b> An error occured. Fraud Detected."
					]);
                }
            }else{
            	echo json_encode([
            		"message" => "<b>Error! </b> Payment failed!. Contact our help center for assistance.",
		            "status" => $res->status
				]);
            }
        }
    }else{
        echo "<b>Error!</b> You do not have access to this page.";
    }
?>