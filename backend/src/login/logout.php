<?php

    // Session start
    session_start();

    // session_process
    // 1. Session start(pass)
    // 2. Session variable reset
    $_SESSION = [];

    // 3. Session cookie delete
    if (ini_get("session.use_cookies")) {
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

    // 4. Session destroy
    session_destroy();

    header("Refresh: 2; URL='login.php'");
    echo "logout Success!";
    exit;

?>