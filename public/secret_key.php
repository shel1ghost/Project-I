<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Key | CipherShield</title>
    <link rel="stylesheet" href="./css/secret_key.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="welcome">
            <h1>Manage Secret Key - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <div class="main">
        <h2>Update your Secret Key</h2>
        <form>
            <div class="form-group">
                <label for="currentSecretKey">Current Secret Key:</label>
                <input type="password" id="currentSecretKey" name="currentSecretKey">
            </div>
            <div class="form-group">
                <label for="newSecretKey">New Secret Key:</label>
                <input type="password" id="newSecretKey" name="newSecretKey">
            </div>
            <div class="form-group">
                <label for="confirmSecretKey">Confirm Secret Key:</label>
                <input type="password" id="confirmSecretKey" name="confirmSecretKey">
            </div>
            <button type="submit">Update Secret Key</button>
        </form>
    </div>
</body>
</html>