<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }else{
        session_destroy();
        header("Location: login.php");
    }
?>