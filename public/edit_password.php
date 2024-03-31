<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
} 
$documentRoot = $_SERVER['DOCUMENT_ROOT']; 
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Controller/enc.php');
require($documentRoot.'/src/Controller/aes.php');
require($documentRoot.'/src/Model/PasswordModel.php');




$password_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM passwords WHERE password_id=?");
$stmt->bind_param("i", $password_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT key_value FROM password_keys WHERE user_id=?;");
$stmt->bind_param("i", $row['user_id']);
$stmt->execute();
$stmt->bind_result($key_value);
$stmt->fetch();
$stmt->close();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require($documentRoot.'/src/Controller/add_pass_validator.php');
    if(!$error){
        //$email = $_SESSION['email'];
        // $stmt = $conn->prepare("SELECT password FROM users WHERE email=?;");
        // $stmt->bind_param("s", $email);
        // $stmt->execute();
        // $stmt->bind_result($db_hashed_password);
        // $stmt->fetch();
        // $stmt->close();
        
        $security_qn = isset($securityQuestion)?$securityQuestion:null;
        $security_ans = isset($securityAnswer)?$securityAnswer:null;
        $two_factor_info = isset($twoFactorInfo)?$twoFactorInfo:null;
        $encrypted_password = encryptAES($password, $key_value);
        $add_password = new PasswordModel($conn);
        $add_password->updatePassword($password_id, $appName, $app_userID, $encrypted_password, $category, $security_qn, $security_ans, $two_factor_info);
        $redirectURL = 'view_pass_menu.php?category='.$category;
        header('Location: '.$redirectURL);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password | CipherShield</title>
    <link rel="stylesheet" href="./css/edit_password.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="edit_title">
            <h1>Edit Password - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <p class="error_add_pass"><?php echo isset($error_add_pass)?$error_add_pass:'';?></p>
    <p class="success_add_pass"><?php echo isset($success_add_pass)?$success_add_pass:'';?></p>
    <form method="POST" action="<?php echo $_SERVER['SELF'].'?id='.$password_id; ?>">
    <div class="column">
        <label for="appName">Application Name:</label>
        <input type="text" id="appName" name="appName" value="<?php echo $row['application_name'];?>">
        <span class="error_msg"><?php echo isset($err_appName) ? $err_appName:''; ?></span>
        <br/><br/>

        <label for="userID">UserID:</label>
        <input type="text" id="userID" name="userID" value="<?php echo $row['app_user_id'];?>">
        <span class="error_msg"><?php echo isset($err_userID) ? $err_userID:''; ?></span>
        <br/><br/>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php 
        //$key = $_SESSION['token'];
        //$decrypted_key = decrypt($key);
        $password = decryptAES($row['password'], $key_value);
        echo $password;
        ?>">
        <span class="error_msg"><?php echo isset($err_password) ? $err_password:''; ?></span>
        <br/><br/>

        <!--<label for="ciphershield_pass">CipherShield Password:</label>
        <input type="password" id="ciphershield_pass" name="ciphershield_pass">
        <span class="error_msg"><?php echo isset($err_ciphershield_pass) ? $err_ciphershield_pass:''; ?></span>
        <br/><br/>-->

        </div>

        <div class="column">
        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="social" <?php if ($row['category'] === "social") echo "selected"; ?>>Social</option>
            <option value="banking" <?php if ($row['category'] === "banking") echo "selected"; ?>>Banking</option>
            <option value="email" <?php if ($row['category'] === "email") echo "selected"; ?>>Email</option>
            <option value="others" <?php if ($row['category'] === "others") echo "selected"; ?>>Others</option>
        </select>
        <span class="error_msg"><?php echo isset($err_category) ? $err_category:''; ?></span>
        <br/><br/>

        <label for="securityQuestion">Security QN/A (if any):</label>
        <input type="text" id="securityQuestion" name="securityQuestion" placeholder="Security question..." value="<?php echo ($row['security_question'] !== null)?$row['security_question']:''; ?>">
        <br/><br/>
        <input type="text" id="securityAnswer" name="securityAnswer" placeholder="Answer..." value="<?php echo ($row['security_answer'] !== null)?$row['security_answer']:''; ?>">
        <br/><br/>

        <div class="flex-container">
            <input type="checkbox" name="twofa_checkbox" id="twofa_checkbox" <?php echo ($row['twofa_info'] !== null)?'checked':''; ?>>
            <label for="twofa_checkbox">Add 2FA Information</label>
        </div>

        <textarea id="twoFactorInfo" name="twoFactorInfo" rows="1" class="<?php echo ($row['twofa_info'] !== null)?'':'hidden';?>"><?php echo ($row['twofa_info'] !== null)?$row['twofa_info']:''; ?></textarea>
        <span class="error_msg"><?php echo isset($err_twoFactorInfo) ? $err_twoFactorInfo:''; ?></span>
        <br/><br/>
        </div>
        <button class="add_password_btn" type="submit">Update Password</button>
        <button class="cancel_btn" type="button" onclick="redirectBack()">Cancel</button>
    </form>
    <script src="./js/edit_password.js"></script>
</body>
</html>
