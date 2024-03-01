<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}
$documentRoot = $_SERVER['DOCUMENT_ROOT']; 
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Model/UserModel.php'); 

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
            $user_model = new UserModel($conn);
            $user_model->deleteUser($email);
            session_destroy();
            header("Location: login.php");
        }else{
            $err_password = "Incorrect Password.";
        }
    }
}
?>
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account | CipherShield</title>
    <link rel="stylesheet" href="./css/delete.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="delete_title">
            <h1><span>Account Deletion</span> - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <div class="main">
        <h2>Make sure to read the below statements before your account deletion.</h2>
        <ul>
            <li>
                Make sure to backup your passwords before you delete your account
                as you will lose all of your store passwords when you delete your account.
            </li>
            <li>
                All of your data will be deleted from CipherShield's server. You will
                not be able to get back your data after account deletion.
            </li>
            <li>
                Feel free to get back to CipherShield by registering yourself as
                a new user if you want.
            </li>
            <li>
                If you have any queries related to CipherShield and related information
                please feel free to reach our customer support page <a href="support.php">here.<a>
            </li>
        </ul>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <label for="delete_password">Enter your password to continue:</label>
                <br/>
                <input type="password" id="password" name="password" value="<?php echo isset($password)?$password:''; ?>">
                <br/>
                <span class="error_msg"><?php echo isset($err_password)?$err_password:'';?></span>
            </div>
            <button class="cancel_btn" type="button" onclick="redirectToDashboard()">Cancel</button>
            <button class="delete_btn" type="submit">Delete</button>
        </form>
    </div>
    <script>
  function redirectToDashboard() {
    window.location.href = "dashboard.php";
  }
</script>
</body>
</html>
