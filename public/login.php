<?php require '../templates/header.php' ?>
<title>Login | CipherShield</title>
<link rel="stylesheet" href="./css/login.css" />
    <div class="login-form">
        <h2>CipherShield Login</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Login">
            </div>
	    <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
<?php require '../templates/footer.php' ?>

