<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT']; 
require($documentRoot.'/src/Controller/control_settings.php');
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | CipherShield</title>
    <link rel="stylesheet" href="./css/settings.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="settings_title">
            <h1>Settings - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="column">
        <span class="error_msg"><?php echo isset($err_settings) ? $err_settings:'';?></span>
        <h2>Change Password</h2>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" value="<?php echo isset($current_password) ? $current_password:'';?>">
        <img class="toggle_img" id="toggle_current_password" src="./images/eye-slash-regular.svg" onclick="toggle_password_visibility('#current_password', '#toggle_current_password')"/>
        <br/>
        <span class="error_msg"><?php echo isset($err_name) ? $err_name:''; ?></span>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" value="<?php echo isset($new_password) ? $new_password:'';?>">
        <img class="toggle_img" id="toggle_new_password" src="./images/eye-slash-regular.svg" onclick="toggle_password_visibility('#new_password', '#toggle_new_password')"/>
        <br/>
        <span class="error_msg"><?php echo isset($err_new_password) ? $err_new_password:''; ?></span>

        <label for="re_new_password">Re-type New Password:</label>
        <input type="password" id="re_new_password" name="re_new_password" value="<?php echo isset($re_new_password) ? $re_new_password:'';?>">
        <img class="toggle_img" id="toggle_renew_password" src="./images/eye-slash-regular.svg" onclick="toggle_password_visibility('#re_new_password', '#toggle_renew_password')"/>
        <br/>
        <span class="error_msg"><?php echo isset($err_re_new_password) ? $err_re_new_password:''; ?></span>

        </div>

        <div class="column">
        <h2>Edit Name</h2>
        <label for="new_name">Name:</label>
        <input type="text" id="new_name" name="new_name" value="<?php echo $_SESSION['name'];?>">
        <br/>
        <span class="error_msg"><?php echo isset($err_name) ? $err_name:''; ?></span>

        <h2>Account Deletion</h2>
        <button class="delete_account_btn" type="button" onclick="redirectTo('delete')">Delete</button>
        </div>

        <button class="save_btn" type="submit">Save Changes</button>

        <button class="cancel_btn" type="button" onclick="redirectTo('dashboard')">Cancel</button>
        
    </form>
    <script>
        function redirectTo(page){
            if(page === 'delete'){
                window.location.href = "delete_user.php";
            }else{
                window.location.href = "dashboard.php";
            }
        }

        function toggle_password_visibility(input, img) {
            var password_input = document.querySelector(input);
            var toggle_img = document.querySelector(img);
            if (password_input.type === "password") {
                password_input.type = "text";
                toggle_img.src = "./images/eye-regular-blue.svg";
            } else {
                password_input.type = "password";
                toggle_img.src = "./images/eye-slash-regular.svg";
            }
        }
    </script>
</body>
</html>
