<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php'); 
require($documentRoot.'/src/Model/UserModel.php'); 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $login_error = $password = '';
    $error = 0;

    if(isset($_POST['email']) && empty(trim($_POST['email']))){
        $err_email = "Please enter email.";
        $error++;
    }else{
        $email = $_POST['email'];
    }

    if(isset($_POST['password']) && empty(trim($_POST['password']))){
        $err_password = "Please enter password.";
        $error++;
    }else{
        $password = $_POST['password'];
    }

    if($error === 0){
        $user_model = new UserModel($conn);
        $user = $user_model->authenticate($email, $password);
        if($user){
            session_start();
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
        }else{
            $login_error = "Invalid Credentials!";
        }
    }
}