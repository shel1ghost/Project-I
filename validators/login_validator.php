<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = '';

    if(isset($_POST['email']) && empty(trim($_POST['email']))){
        $err_email = "Please enter email.";
    }else{
        $email = $_POST['email'];
    }

    if(isset($_POST['password']) && empty(trim($_POST['password']))){
        $err_password = "Please enter password.";
    }
}