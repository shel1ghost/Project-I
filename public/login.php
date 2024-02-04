<?php require '../templates/header.php' ?>
<?php require '../validators/login_validator.php' ?>
<title>Login | CipherShield</title>
<link rel="stylesheet" href="./css/login.css" />
    <div class="login-form">
        <h2>CipherShield Login</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>">
                <br/>
                <span class="error_msg"><?php echo isset($err_email) ? $err_email:''; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <br/>
                <span class="error_msg"><?php echo isset($err_password) ? $err_password:''; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" value="Login">
            </div>
	    <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
<?php require '../templates/footer.php' ?>

