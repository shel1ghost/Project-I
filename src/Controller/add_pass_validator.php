<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/src/Model/PasswordModel.php');
require($documentRoot.'/src/Controller/aes.php');
require($documentRoot.'/config/database.php'); 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //$appName = $app_userID = $category = $securityQuestion = $securityAnswer = $twoFactorInfo = $twofa_checkbox = '';
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

    if(!$error){
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email=?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id, $db_hashed_password);
        $stmt->fetch();
        $stmt->close();
        if(password_verify($ciphershield_pass, $db_hashed_password)){
            $security_qn = isset($securityQuestion)?$securityQuestion:null;
            $security_ans = isset($securityAnswer)?$securityAnswer:null;
            $two_factor_info = isset($twoFactorInfo)?$twoFactorInfo:null;
            $encrypted_password = encryptAES($password, md5($ciphershield_pass));
            $add_password = new PasswordModel($conn);
            $add_password->createPassword($user_id, $appName, $app_userID, $encrypted_password, $category, $security_qn, $security_ans, $two_factor_info);
            $success_add_pass = "Password added successfully!";
        }else{
            $error_add_pass = "Incorrect ciphershield password.";
        }
    }
}
?>