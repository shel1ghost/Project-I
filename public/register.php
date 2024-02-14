<?php 
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    require $documentRoot.'/templates/header.php';
    require $documentRoot.'/src/Controller/register_user.php'; 
?>
<link rel="stylesheet" href="./css/register.css" />
<title>Register | CipherShield</title>
    <div class="registration-form">
        <h2>CipherShield Registration</h2>
        <p class="error_msg" style="text-align: center;"><?php echo isset($err_register) ? $err_register:''; ?></p>
        <form action="<?php echo $_SERVER['SELF']; ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name;?>">
                <br/>
                <span class="error_msg"><?php echo isset($err_name) ? $err_name:''; ?></span>
            </div>

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
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password">
                <br/>
                <span class="error_msg"><?php echo isset($err_confirm_password) ? $err_confirm_password:''; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
	<p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
<?php require '../templates/footer.php' ?>

