<?php 
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/src/Controller/add_pass_validator.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Password - CipherShield</title>
    <link rel="stylesheet" href="./css/add_password.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="add_password_title">
            <h1>Add Password - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <p class="error_add_pass"><?php echo isset($error_add_pass)?$error_add_pass:'';?></p>
    <p class="success_add_pass"><?php echo isset($success_add_pass)?$success_add_pass:'';?></p>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="column">
        <label for="appName">Application Name:</label>
        <input type="text" id="appName" name="appName" value="<?php echo isset($appName)?$appName:'';?>">
        <span class="error_msg"><?php echo isset($err_appName) ? $err_appName:''; ?></span>
        <br/><br/>

        <label for="userID">UserID:</label>
        <input type="text" id="userID" name="userID" value="<?php echo isset($app_userID)?$app_userID:'';?>">
        <span class="error_msg"><?php echo isset($err_userID) ? $err_userID:''; ?></span>
        <br/><br/>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($password)?$password:'';?>">
        <span class="error_msg"><?php echo isset($err_password) ? $err_password:''; ?></span>
        <br/><br/>

        <label for="ciphershield_pass">CipherShield Password:</label>
        <input type="password" id="ciphershield_pass" name="ciphershield_pass" value="<?php echo isset($ciphershield_pass)?$ciphershield_pass:'';?>">
        <span class="error_msg"><?php echo isset($err_ciphershield_pass) ? $err_ciphershield_pass:''; ?></span>
        <br/><br/>

        </div>

        <div class="column">
        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="social" <?php if ($category === "social") echo "selected"; ?>>Social</option>
            <option value="banking" <?php if ($category === "banking") echo "selected"; ?>>Banking</option>
            <option value="email" <?php if ($category === "email") echo "selected"; ?>>Email</option>
            <option value="others" <?php if ($category === "others") echo "selected"; ?>>Others</option>
        </select>
        <span class="error_msg"><?php echo isset($err_category) ? $err_category:''; ?></span>
        <br/><br/>

        <label for="securityQuestion">Security QN/A (if any):</label>
        <input type="text" id="securityQuestion" name="securityQuestion" placeholder="Security question..." value="<?php echo isset($securityQuestion)?$securityQuestion:'';?>">
        <br/><br/>
        <input type="text" id="securityAnswer" name="securityAnswer" placeholder="Answer..." value="<?php echo isset($securityAnswer)?$securityAnswer:'';?>">
        <span class="error_msg"><?php echo isset($err_security_qna)?$err_security_qna:''; ?></span>
        <br/><br/>
        <!-- <div class="checkbox_container">
            <input type="checkbox" id="twofa_checkbox" name="twofa_checkbox">
            <label for="twofa_checkbox" class="twofa_label">2FA Information:</label>
        </div> -->

        <div class="flex-container">
            <input type="checkbox" name="twofa_checkbox" id="twofa_checkbox" <?php echo isset($twofa_checkbox)?$twofa_checkbox:''; ?>>
            <label for="twofa_checkbox">Add 2FA Information</label>
        </div>

        <textarea id="twoFactorInfo" name="twoFactorInfo" rows="1" class="hidden"><?php echo isset($twoFactorInfo)?htmlspecialchars($twoFactorInfo):'';?></textarea>
        <span class="error_msg"><?php echo isset($err_twoFactorInfo) ? $err_twoFactorInfo:''; ?></span>
        <br/><br/>
        </div>
        <button class="add_password_btn" type="submit">Add Password</button>
        <button class="cancel_btn" type="button" onclick="redirectToDashboard()">Cancel</button>
        
    </form>
    <script>
    const checkbox = document.getElementById('twofa_checkbox');
    const textArea = document.getElementById('twoFactorInfo');

    if(checkbox.checked){
        textArea.classList.remove('hidden');
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                textArea.classList.remove('hidden');
            }else {
                textArea.classList.add('hidden');
            }
        });
    }else{
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                textArea.classList.remove('hidden');
            }else {
                textArea.classList.add('hidden');
            }
        });
    }

    function redirectToDashboard() {
        window.location.href = "dashboard.php";
    }
    </script>
</body>
</html>

