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
        <input type="new_password" id="new_password" name="new_password">

        <label for="re_new_password">Re-type New Password:</label>
        <input type="password" id="re_new_password" name="re_new_password">

        </div>

        <div class="column">
        <h2>Edit Name</h2>
        <label for="new_name">Name:</label>
        <input type="text" id="new_name" name="new_name">

        <h2>Account Deletion</h2>
        <button class="delete_account_btn" type="submit">
            <a class="delete_account_link" href="#">Delete Account</a>
        </button>
        </div>

        <button class="save_btn" type="submit">
            <a class="save_link" href="#">Save Changes</a>
        </button>
        <button class="cancel_btn" type="submit">
            <a class="cancel_link" href="dashboard.php">Cancel</a>
        </button>
        
    </form>

</body>
</html>