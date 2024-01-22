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
    <form>
        <div class="column">
        <label for="appName">Application Name:</label>
        <input type="text" id="appName" name="appName">

        <label for="userID">UserID:</label>
        <input type="text" id="userID" name="userID">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        </div>

        <div class="column">
        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="social">Social</option>
            <option value="banking">Banking</option>
            <option value="email">Email</option>
            <option value="others">Others</option>
        </select>

        <label for="securityQuestion">Security QN/A (if any):</label>
        <input type="text" id="securityQuestion" name="securityQuestion">

        <label for="twoFactorInfo">2FA Information:</label>
        <textarea id="twoFactorInfo" name="twoFactorInfo" rows="2"></textarea>
        </div>

        <button type="submit">Add Password</button>
    </form>
</body>
</html>
