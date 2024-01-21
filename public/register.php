<?php require '../templates/header.php' ?>
<link rel="stylesheet" href="./css/register.css" />
<title>Register | CipherShield</title>
    <div class="registration-form">
        <h2>CipherShield Registration</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
	<p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
<?php require '../templates/footer.php' ?>

