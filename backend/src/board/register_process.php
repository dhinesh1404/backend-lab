<?php

    // Include function for input validation
    require_once "./check_value.php";

    // Input validation
    $name = check_value('name');
    $account = check_value('account');
    $pw = check_value('pw');
    $pw_check = check_value('pw_check');

    // If invalid input is received
    // Display error message and redirect to registration page
    if (empty($name) || empty($account) || empty($pw) || empty($pw_check)) {
        header("Refresh: 2; URL='register.html'");
        echo "Invalid input values.";
        exit;
    }

    // Database connection (try-catch)
    try {
        require_once "./db_connect.php";

        // SQL statement (SELECT) - check for duplicate account
        $sql_select = "SELECT account FROM login WHERE account='$account'";

        // Execute query
        $result = $db_conn->query($sql_select);
        
        // If account already exists
        // Display error message and redirect to registration page
        if ($result->num_rows > 0) {
            header("Refresh: 2; URL='register.html'");
            echo "Account already exists.";
            exit;
        } else {     
            // If password and password confirmation do not match
            // Display error message and redirect to registration page
            if ($pw != $pw_check) {
                header("Refresh: 2; URL='register.html'");
                echo "Passwords do not match.";
                exit;
            }

            // Hash the password
            $pw = password_hash($pw, PASSWORD_DEFAULT);

            // SQL statement (INSERT) - insert new user after validation
            $sql_insert = "INSERT INTO login (name, account, pw) VALUES ('$name', '$account', '$pw')";

            // Execute query
            $result = $db_conn->query($sql_insert);

            // If insertion is successful
            // Display success message and redirect to login page
            header("Refresh: 2; URL='login.html'");
            echo "Registration successful!";
            exit;
        }
    } catch (Exception $e) {
        // If database connection fails
        // Display error message and redirect to registration page
        // header("Refresh: 2; URL='register.html'");
        echo "Database connection failed.<br>".$e;
    }
    // close db connection
    $db_conn->close();
?>