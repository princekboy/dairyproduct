<?php
ob_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = filter_var(htmlentities($_POST['username']),FILTER_UNSAFE_RAW);
    $password = filter_var(htmlentities($_POST['password']),FILTER_UNSAFE_RAW);

    if($username == null && $password == null){
        echo json_encode([
            "message" => "<b>Error!</b> Enter your username and password to login"
        ]);
    }elseif ($username == null){
        echo json_encode([
            "message" => "<b>Error!</b> Enter your username to login"
        ]);
    }elseif($password == null){
        echo json_encode([
            "message" => "<b>Error!</b> Enter your password to login"
        ]);
    }
    else{
        $chekPwd = $db_conn->prepare("SELECT * FROM users WHERE username = :username");
        $chekPwd->bindParam(':username',$username,PDO::PARAM_STR);
        $chekPwd->execute();
        if ($chekPwd->rowCount() < 1) {
            echo json_encode([
                "message" => "<b>Error!</b> No user exists with that username"
            ]);
        }
        
        while ($row = $chekPwd->fetch(PDO::FETCH_ASSOC)) {
            $rUserId = $row['user_id'];
            $rUsername = $row['username'];
            $rFullname = $row['fullname'];
            $rPassword = $row['password'];
            $rEmail = $row['email'];
            $rAddress = $row['address'];
            $rPhone = $row['phone'];

            if (password_verify($password,$rPassword)) {
                $loginsql = "SELECT * FROM users WHERE username = :rUsername AND password = :rPassword";
                $query = $db_conn->prepare($loginsql);
                $query->bindParam(':rUsername', $username, PDO::PARAM_STR);
                $query->bindParam(':rPassword', $rPassword, PDO::PARAM_STR);
                $query->execute();
                $num = $query->rowCount();
                if($num == 0){
                    echo json_encode([
                        "message" => "<b>Error!</b> User and password incorrect!"
                    ]);
                }
                else{
                    $_SESSION['user_id'] = $rUserId;
                    $_SESSION['fullname'] = $rFullname;
                    $_SESSION['username'] = $rUsername;
                    $_SESSION['email'] = $rEmail;
                    $_SESSION['address'] = $rAddress;
                    $_SESSION['phone'] = $rPhone;
                    $_SESSION['message'] = "";
                    echo json_encode([
                        "message" => "success"
                    ]);
                }   
            }
            else{
                echo json_encode([
                    "message" => "<b>Error!</b> Incorrect password Please try again"
                ]);
            }
        }
    }
}


?>