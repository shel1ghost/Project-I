<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}else if(!$_SESSION['authorized_user']){
    header('Location: access_passwords.php');
}
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Controller/aes.php');
require($documentRoot.'/src/Controller/enc.php');
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Passwords | CipherShield</title>
    <link rel="stylesheet" href="./css/view_passwords.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="view_password_title">
            <h1>View Passwords - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <a href="export_passwords.php?id=<?php echo $user_id;?>" class="export_passwords">
        <span>Export</span>
    </a>
    <img src="./images/download-solid.svg" class="export_logo">
    <div class="menu">
        <ul>
            <li class="social" onclick="fetch_social_pass()">Social</li>
            <li class="banking" onclick="fetch_banking_pass()">Banking</li>
            <li class="email" onclick="fetch_email_pass()">Email</li>
            <li class="others" onclick="fetch_others_pass()">Others</li>
        </ul>
    </div>
    <div id="content"></div>
    <script src="js/password_menu.js"></script>
    
</body>
</html>
