<?php
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
    <form>
        <div class="column">
        <h2>Change Password</h2>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password">

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password">

        <label for="re_new_password">Re-type New Password:</label>
        <input type="password" id="re_new_password" name="re_new_password">

        </div>

        <div class="column">
        <h2>Edit Name</h2>
        <label for="new_name">Name:</label>
        <input type="text" id="new_name" name="new_name">

        <h2>Account Deletion</h2>
        <button class="delete_account_btn" type="button" onclick="redirectTo('delete')">Delete</button>
        </div>

        <button class="save_btn" type="submit">Save Changes</button>

        <button class="cancel_btn" type="button" onclick="redirectTo('dashboard')">Cancel</button>
        
    </form>
    <script>
        function redirectTo(page){
            if(page === 'delete'){
                window.location.href = "delete.php";
            }else{
                window.location.href = "dashboard.php";
            }
        }
    </script>
</body>
</html>