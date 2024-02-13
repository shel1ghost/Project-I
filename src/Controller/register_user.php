<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php'); 
require($documentRoot.'/src/Model/UserModel.php'); 


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $email = $err_register = '';
    $error = 0;
    if(isset($_POST['name']) && !empty(trim($_POST['name']))){
        $name = trim($_POST['name']);
        if(!preg_match("/^([A-Z][a-z\s]+)+$/",$name)){
            $err_name = "Please enter a valid name.";
        }
    }else{
        $err_name = "Please enter name.";
        $error++;
    }

    if(isset($_POST['email']) && !empty(trim($_POST['email']))){
        $email = strtolower(trim($_POST['email']));
        if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$email)){
            $err_email = "Please enter a valid email";
        }
    }else{
        $err_email = "Please enter email.";
        $error++;
    }

    if(isset($_POST['password']) && !empty(trim($_POST['password']))){
        $password = trim($_POST['password']);
        $password_regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/';
        if(!preg_match($password_regex, $password)){
            $err_password = "Your password should be at least 8 characters and contain an uppercase, a lowercase, numbers and special characters.";
        }
    }else{
        $err_password = "Please enter password.";
        $error++;
    }

    if(isset($_POST['confirm-password']) && empty(trim($_POST['confirm-password']))){
        $err_confirm_password = "Please confirm the password";
        $error++;
    }

    if($password != $_POST['confirm-password']){
        $err_register = "Password did not matched.";
        $error++;
    }

    if($error === 0){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); //hashing using bcrypt algorithm 
        $userModel = new UserModel($conn);
        $user = $userModel->createUser($name, $email, $hashed_password);
        if($user){
            header('Location: login.php');
        }else{
            $err_register = "This email is already used.";
        }
    }
}
?>