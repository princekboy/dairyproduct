<?php
	ob_start();
	include("connect.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['request'])) {
		$request = filter_var(htmlentities($_POST['request']),FILTER_UNSAFE_RAW);
		switch($request){
			case 'approvepayment':
				if (isset($_SESSION['admin_id'])) {
					$payment_id = filter_var(htmlentities($_POST['payment_id']),FILTER_UNSAFE_RAW);
					$user_id = filter_var(htmlentities($_POST['user_id']),FILTER_UNSAFE_RAW);

					$status = 1;

					$sqlUpdate1 = $db_conn->prepare("UPDATE payments SET status = :status WHERE payment_id = :payment_id AND user_id = :user_id");
					$sqlUpdate1->bindParam(":status", $status, PDO::PARAM_STR);
					$sqlUpdate1->bindParam(":payment_id", $payment_id, PDO::PARAM_STR);
					$sqlUpdate1->bindParam(":user_id", $user_id, PDO::PARAM_STR);

					if ($sqlUpdate1->execute()) {
				        echo "success";
					}else{
						echo "<b>Error! </b> An error occured!!";
					}
				}else{
					echo "<b>Error! </b> you do not have permission to approve payments";
				}
			break;

			case 'unapprovepayment':
				if (isset($_SESSION['admin_id'])) {
					$payment_id = filter_var(htmlentities($_POST['payment_id']),FILTER_UNSAFE_RAW);
					$user_id = filter_var(htmlentities($_POST['user_id']),FILTER_UNSAFE_RAW);

					$status = 0;

					$sqlUpdate1 = $db_conn->prepare("UPDATE payments SET status = :status WHERE payment_id = :payment_id AND user_id = :user_id");
					$sqlUpdate1->bindParam(":status", $status, PDO::PARAM_STR);
					$sqlUpdate1->bindParam(":payment_id", $payment_id, PDO::PARAM_STR);
					$sqlUpdate1->bindParam(":user_id", $user_id, PDO::PARAM_STR);

					if ($sqlUpdate1->execute()) {
						echo "success";
					}else{
						echo "<b>Error! </b> An error occured!!";
					}
				}else{
					echo "<b>Error! </b> you do not have permission to approve payments";
				}
			break;

			case 'deletepayment':
				if (isset($_SESSION['admin_id'])) {
					$payment_id = filter_var(htmlentities($_POST['payment_id']),FILTER_UNSAFE_RAW);
					$user_id = filter_var(htmlentities($_POST['user_id']),FILTER_UNSAFE_RAW);

					$sqlUpdate1 = $db_conn->prepare("DELETE FROM payments WHERE payment_id = :payment_id AND user_id = :user_id");
					$sqlUpdate1->bindParam(":payment_id", $payment_id, PDO::PARAM_STR);
					$sqlUpdate1->bindParam(":user_id", $user_id, PDO::PARAM_STR);

					if ($sqlUpdate1->execute()) {
						echo "success";
					}
				}else{
					echo "<b>Error! </b> you do not have permission to approve payments";
				}
			break;
			default:
				echo "You cannot access this page";
				break;
		}
	}
   ?>