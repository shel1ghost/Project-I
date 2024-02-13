<?php
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    require($documentRoot.'/config/database.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updated_details = false;
        if(isset($_POST['new_name']) && !empty(trim($_POST['new_name']))){
            session_start();
            $new_name = trim($_POST['new_name']);
            if(!preg_match("/^([A-Z][a-z\s]+)+$/",$new_name)){
                $err_name = "Please enter a valid name.";
            }
        }

        if(isset($_POST['current_password']) && !empty(trim($_POST['current_password']))){
            $current_password = trim($_POST['current_password']);
            $error = 0;
            if(isset($_POST['new_password']) && !empty(trim($_POST['new_password']))){
                $new_password = trim($_POST['new_password']);
                if(isset($_POST['re_new_password']) && !empty(trim($_POST['re_new_password']))){
                    $re_new_password = trim($_POST['re_new_password']);
                    if($new_password !== $re_new_password){
                        $err_settings = "New password and re-typed password did not matched.";
                        $error++;
                    }
                }else{
                    $err_re_new_password = "Please re-enter the password.";
                    $error++;
                }
            }else{
                $err_new_password = "Please enter the new password.";
                $error++;
            }
            
            if($error == 0){
                $password_regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/';
                if(!preg_match($password_regex, $new_password)){
                    $err_settings = "Your password should be at least 8 characters and contain an uppercase, a lowercase, numbers and special characters.";
                }else{
                    $email = $_SESSION['email'];
                    $stmt = $conn->prepare("SELECT password FROM users WHERE email=?;");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($db_hashed_password);
                    $stmt->fetch();
                    $stmt->close();
                    if(password_verify($current_password, $db_hashed_password)){
                        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                        $stmt->bind_param("ss", $new_hashed_password, $email);
                        $stmt->execute();
                        $stmt->close();
                        $updated_details = true;
                    }else{
                        $err_settings = "Entered current password did not matched your password.";
                    }
                }
            }
            
        }

        if($new_name !== $_SESSION['name']){
            $email = $_SESSION['email'];
            $sql = "UPDATE users SET name = ? WHERE email = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $new_name, $email);
            if($stmt->execute()){
                $_SESSION['name'] = $new_name;
                $updated_details = true;
            }
        }

        if($updated_details){
            header('Location: dashboard.php');
        }
    }
?>