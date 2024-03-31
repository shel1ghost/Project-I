<?php
session_start();
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

$stmt = $conn->prepare("SELECT key_value FROM password_keys WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->bind_result($key_value);
$stmt->fetch();
$stmt->close();

$category = "Others";
$stmt = $conn->prepare("SELECT * FROM passwords WHERE user_id = ? AND category=?");
$stmt->bind_param("is", $user_id, $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // echo '<h3 class="category_heading">'.$category[$i].'</h3>';
    echo "<table>";
    echo "<thead>";
    echo "<tr>
    <th class='application_name'>Application Name</th>
    <th class='user_id'>UserID</th>
    <th class='password_heading'>Password</th>
    <th class='sec_qna'>Security QN/A</th>
    <th class='twofa'>2FA Info</th>
    <th class='created_at'>Modified</th>
    <th class='actions_heading'>Actions</th>
    </tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="name_row">'.$row['application_name'].'</td>';
        echo '<td>'.$row['app_user_id'].'</td>';
        echo '<td>';
        //$key = $_SESSION['token'];
        //$decrypted_key = decrypt($key);
        $password = decryptAES($row['password'], $key_value);
        echo $password;
        echo '</td>';
        echo '<td>';
        if($row['security_question'] !== null){
            echo $row['security_question'].' -> '.$row['security_answer'];
        }else{ 
            echo 'None';
        }
        echo '</td>';
        echo '<td>';
        if($row['twofa_info'] !== null){
            echo $row['twofa_info'];
        }else{
            echo 'None';
        }
        echo '</td>';
        echo '<td>'.$row['created_at'].'</td>';
        echo '<td><a class="edit_btn" href="edit_password.php?id='.$row['password_id'].'">Edit</a>';
        echo '<a class="delete_btn" href="delete_password.php?id='.$row['password_id'].'&category='.$row['category'].'" onclick="return confirm(\'Are your sure you want to delete\')">Delete</a></td>';
        echo '</tr>';
    }
    echo "</tbody>";
    echo "</table>";
}else{
    echo '<h3 class="no_passwords">No passwords to show.</h3>';
}


?>