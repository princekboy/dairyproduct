<?php include 'connect.php';
	
	$request = filter_var(htmlentities($_POST['request']),FILTER_UNSAFE_RAW);

	switch ($request) {
		case 'changepassword':
			$oldpass = filter_var(htmlentities($_POST['password']),FILTER_UNSAFE_RAW);
			$newpass = filter_var(htmlentities($_POST['newpassword']),FILTER_UNSAFE_RAW);
			$compass = filter_var(htmlentities($_POST['conpassword']),FILTER_UNSAFE_RAW);
			$username = $_SESSION['username'];
			if ($oldpass == null || $newpass == null || $compass == null) {
			    echo "<b>Error! </b> All fields are required";
			}else if($newpass != $compass){
			    echo "<b>Error! </b> New Passwords do not match!";
			}
			else{
			    $users = $db_conn->prepare("SELECT * FROM users WHERE username = :username");
			    $users->bindParam(':username', $username, PDO::PARAM_STR);
			    $users->execute();
			    $row = $users->fetch(PDO::FETCH_ASSOC);
			    $e_email = $row['email'];
			    $old_pass = $row['password'];
			    if (!password_verify($oldpass, $old_pass)) {
			        echo "<b>Error! </b> Old Password is incorrect!!";
			    }
			    else{
			        $newpass = filter_var(htmlentities($newpass),FILTER_UNSAFE_RAW);
			        $options = array(
			            SITE_NAME => 16,
			        );
			        $change_pass = password_hash($newpass, PASSWORD_BCRYPT, $options);

			        $sqlQuery = $db_conn->prepare("UPDATE users SET password = :password WHERE username= :username");
			        $sqlQuery->bindParam(':password', $change_pass, PDO::PARAM_STR);
			        $sqlQuery->bindParam(':username', $username, PDO::PARAM_STR);

			        if ($sqlQuery->execute()) {
			            echo "success";
			        }
			        else{
			            echo "<b>Error! </b> An Error Occured!!";
			        }
			    }
			}
			break;

		case 'editprofile':
			//=================================================================================
			$fullname = filter_var(htmlentities($_POST['fullname']),FILTER_UNSAFE_RAW);
			$email = filter_var(htmlentities($_POST['email']),FILTER_UNSAFE_RAW);
			$phone = filter_var(htmlentities($_POST['phone']),FILTER_UNSAFE_RAW);
			$address = filter_var(htmlentities($_POST['address']),FILTER_UNSAFE_RAW);

			$user_id = $_SESSION['user_id'];

			if ($fullname == null || $phone == null || $email == null || $address == null) {
				echo "<b>Error! </b> All fields are required";
			}else if($fullname == $_SESSION['fullname'] AND $phone == $_SESSION['phone'] AND $email == $_SESSION['email'] AND $address == $_SESSION['address']){
				echo "<b>Alert! </b> No changes were made";
			}else{
				$emailCheck = $db_conn->prepare("SELECT email FROM users WHERE email = :email");
				$emailCheck->bindParam(":email", $email, PDO::PARAM_STR);
				$emailCheck->execute();
				if ($emailCheck->rowCount() > 0 && $email != $_SESSION['email']) {
					echo "<b>Error! </b> This email address already exists";
				}else{
					$editSql = $db_conn->prepare("UPDATE users SET fullname = :fullname, email = :email, phone = :phone, address = :address WHERE user_id = :user_id");
					$editSql->bindParam(":fullname", $fullname, PDO::PARAM_STR);
					$editSql->bindParam(":email", $email, PDO::PARAM_STR);
					$editSql->bindParam(":phone", $phone, PDO::PARAM_STR);
					$editSql->bindParam(":address", $address, PDO::PARAM_STR);
					$editSql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
					if($editSql->execute()){
						echo "success";
						$_SESSION['fullname'] = $fullname;
					    $_SESSION['email'] = $email;
					    $_SESSION['phone'] = $phone;
					    $_SESSION['address'] = $address;
					}else{
						echo "<b>Error! </b> There was an error making changes!!";
					}
				}
			}
			break;

		case 'changepasswordadm':
			$oldpass = filter_var(htmlentities($_POST['password']),FILTER_UNSAFE_RAW);
	        $newpass = filter_var(htmlentities($_POST['newpassword']),FILTER_UNSAFE_RAW);
	        $compass = filter_var(htmlentities($_POST['conpassword']),FILTER_UNSAFE_RAW);
	        $username = $_SESSION['admusername'];
	        if ($oldpass == null || $newpass == null || $compass == null) {
	            echo "<b>Error! </b> All fields are required";
	        }else if($newpass != $compass){
	            echo "<b>Error! </b> Passwords do not match!!!";
	        }
	        else{
	            $getAdm = $db_conn->prepare("SELECT * FROM admin WHERE username = :username");
	            $getAdm->bindParam(':username', $username, PDO::PARAM_STR);
	            $getAdm->execute();
	            $row = $getAdm->fetch(PDO::FETCH_ASSOC);
	            $e_email = $row['email'];
	            $old_pass = $row['password'];
	                
	            if (!password_verify($oldpass, $old_pass)) {
	                echo "<b>Error! </b> Old Password is incorrect!!";
	            }
	            else{
	                $newpass = filter_var(htmlentities($newpass),FILTER_UNSAFE_RAW);
	                $options = array(
	                    SITE_NAME => 16,
	                );
	                $change_pass = password_hash($newpass, PASSWORD_BCRYPT, $options);
	                $sql = "UPDATE admin SET password = :password WHERE username= :username";
	                $sqlQuery = $db_conn->prepare($sql);
	                $sqlQuery->bindParam(':password', $change_pass, PDO::PARAM_STR);
	                $sqlQuery->bindParam(':username', $username, PDO::PARAM_STR);
	                if ($sqlQuery->execute()) {
	                    echo "success";
	                }
	                else{
	                    echo "<b>Error! </b> An Error Occured!!";
	                }
	            }
	        }
			break;

		case 'editprofileadm':
			//=================================================================================
			$username = filter_var(htmlentities($_POST['username']),FILTER_UNSAFE_RAW);
			$email = filter_var(htmlentities($_POST['email']),FILTER_UNSAFE_RAW);
			$phone = filter_var(htmlentities($_POST['phone']),FILTER_UNSAFE_RAW);
			$user_id = $_SESSION['admin_id'];
			if ($username == null || $phone == null || $email == null) {
				echo "All fields are required";
			}else if($username == $_SESSION['admusername'] AND $phone == $_SESSION['admphone'] AND $email == $_SESSION['admemail']){
				echo "<b>Error! </b> No changes were made";
			}else{
				$emailCheck = $db_conn->prepare("SELECT email FROM admin WHERE email = :email");
				$emailCheck->bindParam(":email", $email, PDO::PARAM_STR);
				$emailCheck->execute();
				if ($emailCheck->rowCount() > 0 && $email != $_SESSION['admemail']) {
					echo "<b>Error! </b> This email address already exists";
				}else{
					$editSql = $db_conn->prepare("UPDATE admin SET username = :username, email = :email, phone = :phone WHERE admin_id = :user_id");
					$editSql->bindParam(":username", $username, PDO::PARAM_STR);
					$editSql->bindParam(":email", $email, PDO::PARAM_STR);
					$editSql->bindParam(":phone", $phone, PDO::PARAM_STR);
					$editSql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
					if($editSql->execute()){
						echo "success";
						$_SESSION['admusername'] = $username;
				        $_SESSION['admemail'] = $email;
				        $_SESSION['admphone'] = $phone;
					}else{
						echo "<b>Error! </b> There was an error making changes!!";
					}
				}
			}
			break;
		default:
			echo "<b>Error! </b> You do not have access to this page";
			break;
	}
?>