<?php
    $error = false;
    if(isset($_POST['appName']) && empty(trim($_POST['appName']))){
        $err_appName = "Please enter application name.";
        $error = true;
    }else{
        $appName = $_POST['appName'];
    }
    if(isset($_POST['userID']) && empty(trim($_POST['userID']))){
        $err_userID = "Please enter user id.";
        $error = true;
    }else{
        $app_userID = $_POST['userID'];
    }
    if(isset($_POST['password']) && empty(trim($_POST['password']))){
        $err_password = "Please enter password.";
        $error = true;
    }else{
        $password = $_POST['password'];
    }
    if(isset($_POST['ciphershield_pass']) && empty(trim($_POST['ciphershield_pass']))){
        $err_ciphershield_pass = "Please enter ciphershield password.";
        $error = true;
    }else{
        $ciphershield_pass = $_POST['ciphershield_pass'];
    }
    if(isset($_POST['category']) && empty(trim($_POST['category']))){
        $err_category = "Please select category.";
        $error = true;
    }else{
        $category = $_POST['category'];
    }
    if(isset($_POST['securityQuestion']) && !empty(trim($_POST['securityQuestion']))){
        $securityQuestion = $_POST['securityQuestion'];
        if(isset($_POST['securityAnswer']) && !empty(trim($_POST['securityAnswer']))){
            $securityAnswer = $_POST['securityAnswer'];
        }else{
            $err_security_qna = "Please enter security answer.";
            $error = true;
        }
    }
    
    if(isset($_POST['twofa_checkbox'])){
        $twofa_checkbox = 'checked';
        if(isset($_POST['twoFactorInfo']) && !empty(trim($_POST['twoFactorInfo']))){
            $twoFactorInfo = $_POST['twoFactorInfo'];
        }else{
            $err_twoFactorInfo = "Please enter 2FA information.";
            $error = true;
        }
    } 
?>