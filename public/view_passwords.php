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
    
    <div class="main">
        <?php
        // $email = $_SESSION['email'];
        // $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        // $stmt->bind_param("s", $email);
        // $stmt->execute();
        // $stmt->bind_result($user_id);
        // $stmt->fetch();
        // $stmt->close();

        $category = ["Social", "Banking", "Gmail", "Others"];
        $password_set = 4;
        //$password_model = new PasswordModel($conn);

        for($i=0; $i<count($category); $i++){
        $stmt = $conn->prepare("SELECT * FROM passwords WHERE user_id = ? AND category=?");
        $stmt->bind_param("is", $user_id, $category[$i]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<h3 class="category_heading">'.$category[$i].'</h3>';
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
                $key = $_SESSION['token'];
                $decrypted_key = decrypt($key);
                $password = decryptAES($row['password'], $decrypted_key);
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
                echo '<a class="delete_btn" href="delete_password.php?id='.$row['password_id'].'" onclick="return confirm(\'Are your sure you want to delete\')">Delete</a></td>';
                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
        }else{
            $password_set--;
        } 
        $stmt->close();
        }
        if($password_set === 0){
            echo '<h3 class="no_passwords">No passwords to show.</h3>';
        }
    ?>
    </div>
</body>
</html>