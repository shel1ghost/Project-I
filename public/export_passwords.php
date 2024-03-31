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

// Fetch passwords by user_id from the database
$user_id = $_GET['id']; 
$sql = "SELECT * FROM passwords WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$stmt = $conn->prepare("SELECT key_value FROM password_keys WHERE user_id=?;");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->bind_result($key_value);
$stmt->fetch();
$stmt->close();

if($result->num_rows === 0){
    echo '<script>
    alert("You have no passwords to export.");
    window.location.href = "view_pass_menu.php?category=social";
    </script>';
}else{
// Create an array to store passwords
$passwords = array();
while ($row = $result->fetch_assoc()) {
    //$key = $_SESSION['token'];
    //$decrypted_key = decrypt($key);
    $password = decryptAES($row['password'], $key_value);
    $row['password'] = $password;
    unset($row['password_id']);
    unset($row['user_id']);
    $passwords[] = $row;
}

// Close the statement
// $stmt->close();

// Convert passwords array to JSON
$json = json_encode($passwords, JSON_PRETTY_PRINT);

// Set headers for file download
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="ciphershield_passwords.json"');

// Output JSON to the browser
echo $json;
}

?>