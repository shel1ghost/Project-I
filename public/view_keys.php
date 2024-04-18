<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}else if(!$_SESSION['authorized_user']){
    header('Location: access_passwords.php');
}
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
include $documentRoot.'/src/Controller/session_timeout.php';

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
    <title>View Encryption Keys | CipherShield</title>
    <link rel="stylesheet" href="./css/view_keys.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="view_password_title">
            <h1>Encryption Keys - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <?php
    $stmt = $conn->prepare("SELECT * FROM password_keys WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<h2>Your passwords are secured with these keys:</h2>';
        echo '<table border="1">';
        echo '<tr><th><span class="title">Key ID</span></th><th><span class="title">Key</span></th></tr>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><span class="key_id">'.$row['key_id'].'</span></td>';
            echo '<td><span class="key_value">'.$row['key_value'].'</span></td>';
            echo '</tr>';
        }
        echo '</tbody>';
    }else {
        echo '<h2>No keys to show.</h2>';
    }
    ?>
</body>
</html>
