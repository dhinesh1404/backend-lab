<?php

    // Input validation
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // If invalid input is received
    // Display error message and redirect to login page
    if (empty($account) || empty($pw)) {
        header("Refresh: 2; URL='login.html'");
        echo "Invalid input values.";
        exit;
    }

    // Start session
    session_start();

    // Database connection (try-catch)
    try {
        require_once "./db_connect.php";

        // SQL statement (SELECT) to verify account and password
        $sql = "SELECT * FROM login WHERE account='$account'";

        // Execute query
        $result = $db_conn->query($sql);

        // If account does not exist
        // Display error message and redirect to login page
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='login.html'");
            echo "Account does not exist.";
            exit;
        } else {
            // If account exists, compare input password with hashed password
            $row = $result->fetch_assoc();

            // If password does not match
            // Display error message and redirect to login page
            if (!password_verify($pw, $row['pw'])) {
                header("Refresh: 2; URL='login.html'");
                echo "Password does not match.";
                exit;
            } else {
                // If password matches, store session variables (name, account)
                // Display success message and redirect to board list page
                $_SESSION['name'] = $row['name'];
                $_SESSION['account'] = $row['account'];
                header("Refresh: 2; URL='index.php'");
                echo "Login successful!";
                exit;
            }
        }
    } catch (Exception $e) {
        // If database connection fails
        // Display error message and redirect to login page
        header("Refresh: 2; URL='login.html'");
        echo "Database connection failed: ".$e;
    }

    // Close database connection
    $db_conn->close();

?>
