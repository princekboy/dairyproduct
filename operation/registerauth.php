<?php
ob_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT);
    $fullname = filter_var(htmlentities($_POST['fullname']),FILTER_UNSAFE_RAW);
    $username = filter_var(htmlentities($_POST['username']),FILTER_UNSAFE_RAW);
    $email = filter_var(htmlentities($_POST['email']),FILTER_UNSAFE_RAW);
    $phone = filter_var(htmlentities($_POST['phone']),FILTER_UNSAFE_RAW);
    $address = filter_var(htmlentities($_POST['address']),FILTER_UNSAFE_RAW);
    $password = filter_var(htmlentities($_POST['password']),FILTER_UNSAFE_RAW);
    $cpassword = filter_var(htmlentities($_POST['conpassword']),FILTER_UNSAFE_RAW);

    if($fullname == null || $username == null || $email == null || $password == null || $address == null || $phone == null){
        echo json_encode([
            "message" => "<b>Error!</b> Please fill required fields."
        ]);
        exit();
    }else{
        $checkuser = $db_conn->prepare("SELECT * FROM users WHERE username = :username");
        $checkuser->bindParam(":username", $username, PDO::PARAM_STR);
        $checkuser->execute();
        $userExists = $checkuser->rowCount();

        $checkemail = $db_conn->prepare("SELECT * FROM users WHERE email = :email");
        $checkemail->bindParam(":email", $email, PDO::PARAM_STR);
        $checkemail->execute();
        $emailExists = $checkemail->rowCount();
        if ($userExists > 0) {
            echo json_encode([
                "message" => "<b>Error! in username :</b> This username is taken, please try another"
            ]);
            exit();
        }elseif($emailExists > 0){
            echo json_encode([
                "message" => "<b>Error! in email :</b> This email address is already taken"
            ]);
            exit();
        }elseif(strlen($username) < 3){
            echo json_encode([
                "message" => "<b>Error! in username :</b> Username should be at lease 3 characters long"
            ]);
            exit();
        }elseif(strlen($password) < 5){
            echo json_encode([
                "message" => "<b>Error! in password :</b> Password should be more than 5 characters long"
            ]);
            exit();
        }elseif(strpos($username, ' ') !== false || preg_match('/[\'^£$%&*()}{@#~?><>,.|=+¬-]/', $username) || !preg_match('/[A-Za-z0-9]+/', $username)) {
            echo json_encode([
                "message" => "<b>Error! in username :</b> Special characters not allowed."
            ]);
            exit();
        }elseif(preg_match('/[\'^£$%&*()}{@#~?><>,.|=+¬-]/', $fullname) || !preg_match('/[A-Za-z0-9]+/', $username)) {
            echo json_encode([
                "message" => "<b>Error! in fullname :</b> Special characters not allowed."
            ]);
            exit();
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                "message" => "<b>Error!</b> Invalid email address."
            ]);
            exit();
        }elseif($password != $cpassword){
            echo json_encode([
                "message" => "<b>Error!</b> Passwords do not match"
            ]);
            exit();
        }else{
            $options = array(
                SITE_NAME => 32,
            );

            $status = 0;

            $password_hashed = password_hash($password, PASSWORD_BCRYPT, $options);

            $insertDb = $db_conn->prepare("INSERT INTO users (user_id, fullname, username, password, email, phone, address) VALUES (:user_id, :fullname, :username, :password, :email, :phone, :address)");
            $insertDb->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $insertDb->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $insertDb->bindParam(':username', $username, PDO::PARAM_STR);
            $insertDb->bindParam(':password', $password_hashed, PDO::PARAM_STR);
            $insertDb->bindParam(':email', $email, PDO::PARAM_STR);
            $insertDb->bindParam(':phone', $phone, PDO::PARAM_STR);
            $insertDb->bindParam(':address', $address, PDO::PARAM_STR);
            if ($insertDb->execute()) {
                echo json_encode([
                    "status" => "success"
                ]);
            }else{
                echo json_encode([
                    "message" => "<b>Error!</b> There was an error with registration"
                ]);
            }
        }
    }
}else{
    echo "<b>Error! You cannot access this page</b>";
}
?>