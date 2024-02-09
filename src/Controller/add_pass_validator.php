<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $appName = $userID = $category = $securityQuestion = $securityAnswer = $twoFactorInfo = $twofa_checkbox = '';
    if(isset($_POST['appName']) && empty(trim($_POST['appName']))){
        $err_appName = "Please enter application name.";
    }else{
        $appName = $_POST['appName'];
    }
    if(isset($_POST['userID']) && empty(trim($_POST['userID']))){
        $err_userID = "Please enter user id.";
    }else{
        $userID = $_POST['userID'];
    }
    if(isset($_POST['password']) && empty(trim($_POST['password']))){
        $err_password = "Please enter password.";
    }
    if(isset($_POST['ciphershield_pass']) && empty(trim($_POST['ciphershield_pass']))){
        $err_ciphershield_pass = "Please enter ciphershield password.";
    }
    if(isset($_POST['category']) && empty(trim($_POST['category']))){
        $err_category = "Please select category.";
    }else{
        $category = $_POST['category'];
    }
    if(isset($_POST['securityQuestion']) && !empty(trim($_POST['securityQuestion']))){
        $securityQuestion = $_POST['securityQuestion'];
    }
    if(isset($_POST['securityAnswer']) && !empty(trim($_POST['securityAnswer']))){
        $securityAnswer = $_POST['securityAnswer'];
    }
    if(isset($_POST['twofa_checkbox'])){
        $twofa_checkbox = 'checked';
        if(isset($_POST['twoFactorInfo']) && !empty(trim($_POST['twoFactorInfo']))){
            $twoFactorInfo = $_POST['twoFactorInfo'];
        }else{
            $err_twoFactorInfo = "Please enter 2FA information.";
        }
    } 


}
?>