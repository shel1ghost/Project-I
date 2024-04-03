<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Controller/aes.php');

$user_id = $_GET['user_id'];
$search_query = $_GET['query'];
$db_search_query = '%' . $search_query . '%'; 

$stmt = $conn->prepare("SELECT key_value FROM password_keys WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->bind_result($key_value);
$stmt->fetch();
$stmt->close();

$sql = "SELECT * FROM passwords WHERE application_name LIKE ? AND user_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $db_search_query, $user_id);
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
        $password = decryptAES($row['password'], $key_value);
        echo '<span class="password_label">Password: </span><input class="password_box" type="text" value="'.$password.'" readonly/>';
        echo '<br/>';
        echo '<button class="view_pass_btn" onclick="toggle_password('.$pass_num.')">View Password</button>';
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
        echo '<p class="hidden_category_info">'.$row['category'].'</p>';
        echo '</div>';
        echo '<div class="column3">';
        echo '<a class="edit_btn" href="edit_password.php?id='.$row['password_id'].'">Edit</a>';
        echo '<a class="delete_btn" href="delete_password.php?id='.$row['password_id'].'&category='.$row['category'].'" onclick="return confirm(\'Are your sure you want to delete\')">Delete</a>';
        echo '<a class="view_enc_btn" href="view_encryption_process.php?id='.$row['password_id'].'&category='.$row['category'].'&user_id='.$row['user_id'].'">View Encryption Process</a>';
        echo '</div>';
        echo '</div>';
        $pass_num++;
    }
} else {
    echo "No passwords found.";
}

$stmt->close();
$conn->close();

?>