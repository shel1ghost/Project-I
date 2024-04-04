<?php

// Start the session
//session_start();

// Check if last activity timestamp is set
if (isset($_SESSION['last_activity'])) {
    // Calculate time difference in seconds
    $inactive_time = time() - $_SESSION['last_activity'];

    // Set session timeout in seconds (e.g., 30 minutes)
    $timeout = 600; // 10 minutes

    // Check if session has timed out
    if ($inactive_time > $timeout) {
        // Destroy the session
        session_unset();
        session_destroy();
        header('Location: login.php'); // Redirect to login page
        exit;
    }
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

?>
