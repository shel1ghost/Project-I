<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
require $documentRoot.'/src/Model/PasswordModel.php'; 
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}else{
    $password_id = $_GET['id'];
    $key = $_SESSION['token'];
    $password_model = new PasswordModel($conn);
    $password_model->deletePassword($password_id);
    header('Location: view_passwords.php');
}
?>