<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT']; 
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Controller/enc.php');

session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}else if($_SESSION['authorized_user']){
    header('Location: view_passwords.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['password']) && empty(trim($_POST['password']))){
        $err_password = "Please enter password.";
    }else{
        $password = $_POST['password'];
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT password FROM users WHERE email=?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($db_hashed_password);
        $stmt->fetch();
        $stmt->close();
        if(password_verify($password, $db_hashed_password)){
            $key = md5($password);
            $secure_key = encrypt($key);
            $_SESSION['token'] = $secure_key; //passing users encrypted password through session as 'token'
            $_SESSION['authorized_user'] = true;
            header('Location: view_passwords.php');
        }else{
            $err_password = "Incorrect password. Try again!";
        }
    }
}
?>