<?php 
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require $documentRoot.'/templates/header.php';
require $documentRoot.'/src/Controller/login_user.php';
?>
<title>Login | CipherShield</title>
<link rel="stylesheet" href="./css/login.css" />
    <div class="login-form">
        <h2>CipherShield Login</h2>
        <p class="login_error"><?php echo $login_error;?></p>
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
<?php require $documentRoot.'/templates/footer.php' ?>

