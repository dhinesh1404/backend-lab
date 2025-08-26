<?php

    // 1. Start session
    session_start();

    // 2. Clear session variables
    $_SESSION = [];

    // 3. Delete session cookie
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    // 4. Destroy the session
    session_destroy();

    // After session handling, display logout success message and redirect to login page
    header("Refresh: 2; URL='login.html'");
    echo "Logout successful!";
    exit;

?>
