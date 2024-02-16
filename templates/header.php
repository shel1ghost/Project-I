<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/header.css"/>
</head>
<body>
    <nav>
        <div class="logo"></div>
        <div>
            <a href="../index.php" id="indexLink">Home</a>
            <a href="/public/about.php" id="aboutLink">About</a>
            <a href="/public/login.php" id="loginLink">Login</a>
        </div>
    </nav>
    <script>
        const currentPage = window.location.pathname.split("/").pop();
        const activeLink = document.getElementById(currentPage.replace('.php', 'Link'));
        if (activeLink) {
            activeLink.classList.add('active');
        }
    </script>