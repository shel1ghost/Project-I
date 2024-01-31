<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | CipherShield</title>
    <link rel="stylesheet" href="./css/dashboard.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="welcome">
            <h1>Welcome to CipherShield User!</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <div class="main">
        <div class="menu">
            <div class="menu-items">
                <a href="add_password.php" class="add-password">
                    <span class="menu-option">Add Password</span>
                </a>
            </div>
            <div class="menu-items">
                <a href="view_passwords.php" class="view-passwords">
                    <span class="menu-option">View Passwords</span>
                </a>
            </div>
            <div class="menu-items">
                <a href="settings.php" class="settings">
                    <span class="menu-option">Settings</span>
                </a>
            </div>
            <div class="menu-items">
                <a href="support.php" class="help-support">
                    <span class="menu-option">Help &amp; Support</span>
                </a>
            </div>
        </div>
        <div class="password-generator">
            <h2 class="generator_title">CipherShield <br/> Password Generator</h2>
            <p>Generate a strong password quickly :)</p>
            <br/>
                <div>
                    <input type="text" id="password_field" placeholder="Click the button to generate password">
                </div>
                <div>
                <label for="password_length" class="password_length">Select password length:</label>
                <select id="password_length" name="password_length">
                <!-- Loop to generate options from 8 to 24 -->
                <?php
                    for ($i = 8; $i <= 30; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
                </select>     
                </div>
                <div>
                    <button class="generate_button" onclick="displayRandomPassword()">Generate Password</button>
                </div>
        </div>
    </div> 
    <script src="./js/password_generator.js"></script>
</body>
</html>