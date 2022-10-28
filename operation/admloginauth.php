<?php
ob_start();
require("connect.php");

$username = filter_var(htmlentities($_POST['username']),FILTER_UNSAFE_RAW);
$password = filter_var(htmlentities($_POST['password']),FILTER_UNSAFE_RAW);


if($username == null && $password == null){
    echo json_encode([
        "message" => "<b>Error!</b> Enter your username and password to login"
    ]);
}elseif ($username == null){
    echo json_encode([
        "message" => "<b>Error!</b> Enter your username address to login!"
    ]);
}elseif($password == null){
    echo json_encode([
        "message" => "<b>Error!</b> Enter your password to login!"
    ]);
}
else{
    $chekPwd = $db_conn->prepare("SELECT * FROM admin WHERE username = :username");
    $chekPwd->bindParam(':username',$username,PDO::PARAM_STR);
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        echo json_encode([
            "message" => "<b>Error!</b> No admin exists with that username!"
        ]);
    }
    while ($row = $chekPwd->fetch(PDO::FETCH_ASSOC)) {
        $rAdminId = $row['admin_id'];
        $rUsername = $row['username'];
        $rPassword = $row['password'];
        $rEmail = $row['email'];
        $rPhone = $row['phone'];

        if (password_verify($password,$rPassword)) {
        	$loginsql = "SELECT * FROM admin WHERE username = :username AND password = :rPassword";
        	$query = $db_conn->prepare($loginsql);
    		$query->bindParam(':username', $rUsername, PDO::PARAM_STR);
    		$query->bindParam(':rPassword', $rPassword, PDO::PARAM_STR);
   			$query->execute();
    		$num = $query->rowCount();
		    if($num == 0){
		       echo json_encode([
                    "message" => "<b>Error!</b> User and password incorrect!"
                ]);
		    }
		    else{
                $_SESSION['admin_id'] = $rAdminId;
                $_SESSION['admusername'] = $rUsername;
                $_SESSION['admemail'] = $rEmail;
                $_SESSION['admpassword'] = $rPassword;
                $_SESSION['admphone'] = $rPhone;
                echo json_encode([
                    "message" => "success"
                ]);
		    }   
        }
        else{
          echo "Incorrect password Please try again";

        }
    }
}
?>