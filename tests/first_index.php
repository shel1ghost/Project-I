<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | CipherShield Password Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: black;
            color: #ff9900;
        }

        nav {
            background-color: black;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: inline-block;
            width: 64px;
            height: 64px;
            background-image: url("./images/logo.png");
            background-size: cover;
            border-radius: 50%;
            margin-right: 15px;
        }

        nav a {
            text-decoration: none;
            color: #ff9900;
            font-size: 20px;
            padding: 8px 15px;
            margin: 0 10px;
            transition: background-color 0.3s;
            border-bottom: 1.5px solid #ff9900;
        }

        nav a:hover {
            background-color: #333;
        }

        .main {
            display: flex;
        }

        .image-container {
            width: 460px;
            height: 460px;
            background-image: url("./images/photo6.png");
            background-size: cover;
            margin: 0px 20px 10px 10px;
        }

        .content-container {
            padding: 20px;
            width: 720px;
            height: 400px;
            margin: 12px 10px 10px 6%;
        }


        h1 {
            color: #0099ff;
            margin-bottom: 10px;
            font-size: 40px;
            font-family: 'Courier New', Courier, monospace;
            overflow: hidden;
            /* Hide the overflow to create the typing effect */
            white-space: nowrap;
            /* Prevent text from wrapping */
            animation: typing 2s steps(20, end), moveText 1.5s infinite alternate;
        }

        p {
            font-size: 24px;
            font-family: cursive;
            margin-bottom: 20px;
            color: white;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-button {
            background-color: transparent;
            border: 1.5px solid #ff9900;
            font-size: 20px;
        }

        .login-button {
            background-color: black;
            font-size: 20px;
        }

        .register-button a {
            color: #ff9900;
            text-decoration: none;
        }

        .login-button a {
            color: #ff9900;
            text-decoration: none;
        }

        button:hover {
            background-color: #333;
        }

        h2 {
            color: #0099ff;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: lighter;
        }

        li {
            font-size: 20px;
            color: white;
        }

        footer {
            background-color: black;
            color: #ff9900;
            text-align: center;
            padding: 14px 0px 0px 0px;
        }

        .footer {
            color: #ff9900;
            font-size: 14px;
        }

        .footer a {
            text-decoration: none;
            font-size: 20px;
            color:#0099ff;
            padding: 8px 2px 8px 2px;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes moveText {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo"></div>
        <div>
            <a href="#">Home</a>
            <a href="about.php">About</a>
            <a href="login.php">Login</a>
        </div>
    </nav>
    <div class="main">
        <div class="image-container"></div>

        <div class="content-container">
            <h1>CipherShield Password Manager</h1>
            <p>Where Passwords Meet Protection.</p>
            <div class="action-buttons">
                <button class="register-button"><a href="register.php">Register</a></button>
                <button class="login-button"><a href="login.php">Login</a></button>
            </div>
            <br />
            <h2>Great choice for:</h2>
            <ul>
                <li>Secure password storage.</li>
                <li>Integrated password generator</li>
                <li>Portable.</li>
                <li>Good user interface.</li>
            </ul>
        </div>
    </div>
    <footer>
        <p class="footer">Join us on:
            <br/>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-linkedin"></a>
            <br/>
        &copy; 2024 CipherShield Password Manager. All rights reserved.
        </p>
    </footer>
</body>

</html>