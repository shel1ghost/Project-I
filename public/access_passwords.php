<?php 
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT']; 
require($documentRoot.'/src/Controller/access_pass.php');
include $documentRoot.'/src/Controller/session_timeout.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Passwords | CipherShield</title>
    <link rel="stylesheet" href="./css/access_passwords.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="view_title">
            <h1>View Passwords - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>Please enter CipherShield's password to continue</p>
        <div>
            <label for="password">CipherShield Password:</label>
            <input type="password" id="password" name="password">
            <br/>
            <span class="error_msg"><?php echo isset($err_password) ? $err_password:''; ?></span>
        </div>
        <button class="view_password_btn" type="submit">View Password</button>
        <button class="cancel_btn" type="button" onclick="redirectToDashboard()">Cancel</button>
    </form>
    <script>
    function redirectToDashboard() {
        window.location.href = "dashboard.php";
    }
    </script>
</body>
</html>
