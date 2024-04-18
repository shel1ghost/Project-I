<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Controller/aes.php');

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

$category = "Social";
$stmt = $conn->prepare("SELECT * FROM passwords WHERE user_id = ? AND category=?");
$stmt->bind_param("is", $user_id, $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $pass_num = 0;
    while($row = $result->fetch_assoc()) {
        echo '<div class="main">';
        echo '<div class="column1">';
        echo '<p><span>Application Name: </span>'.$row['application_name'].'</p>';
        echo '<br/>';
        echo '<p><span>User ID: </span>'.$row['app_user_id'].'</p>';
        echo '<br/>';
        $key_id = bin2hex(strtolower(substr($row['application_name'], 0, 1).$row['user_id'].substr($row['app_user_id'], 0, 3)));
        $stmt = $conn->prepare("SELECT key_value FROM password_keys WHERE key_id = ? AND user_id = ?");
        $stmt->bind_param("ss", $key_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($key_value);
        $stmt->fetch();
        $stmt->close();
        $password = decryptAES($row['password'], $key_value);
        echo '<span class="password_label">Password: </span><input class="password_box" type="text" value="'.$row['password'].'" readonly/>';
        echo '<br/>';
        echo '<button class="dec_pass_btn" onclick="decrypt_password(\''.$row['password'].'\', \''.$password.'\', '.$pass_num.')">Decrypt Password</button>';
        echo '</div>';
        echo '<div class="column2">';
        echo '<p><span>Security QN/A: </span>';
        if($row['security_question'] !== null){
            echo $row['security_question'].' -> '.$row['security_answer'].'</p>';
        }else{ 
            echo 'None</p>';
        }
        echo '<br/>';
        echo '<p><span>2FA Information: </span>';
        if($row['twofa_info'] !== null){
            echo $row['twofa_info'].'</p>';
        }else{
            echo 'None</p>';
        }
        echo '<br/>';
        echo '<p><span>Modified: </span>'.$row['created_at'].'</p>';
        echo '</div>';
        echo '<div class="column3">';
        echo '<a class="edit_btn" href="edit_password.php?id='.$row['password_id'].'">Edit</a>';
        echo '<a class="delete_btn" href="delete_password.php?id='.$row['password_id'].'&key_id='.$key_id.'&category='.$row['category'].'" onclick="return confirm(\'Are your sure you want to delete\')">Delete</a>';
        echo '<a class="view_enc_btn" href="view_encryption_process.php?id='.$row['password_id'].'&category='.$row['category'].'&user_id='.$user_id.'&key_id='.$key_id.'">View Encryption Process</a>';
        echo '</div>';
        echo '</div>';
        $pass_num++;
    }
}else{
    echo '<h3 class="no_passwords">No passwords to show.</h3>';
}


?>
