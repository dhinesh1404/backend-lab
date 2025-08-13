<?php

    // register.php
    // FORM
    // Action: register_process.php (current file)
    // Method: POST
    // Input fields: username (ID), password, name (User's full name)

    // Input validation
    // If isset returns True → Go directly to DB connection
    // If isset returns False → Handle as an exception
    $username = isset($_POST['username'])? $_POST['username']:'';
    $password = isset($_POST['password'])? $_POST['password']:'';
    $name = isset($_POST['name'])? $_POST['name']:'';

    // Exception handling
    // When invalid input values are received
    // Show error message and redirect to the registration page

    if(empty($username) || empty($password) || empty($name)) {
        // header("") → Refresh: 2 (redirect after 2 seconds), Location (redirect immediately)
        header("Refresh:2; URL = 'register.php'");
        echo "Invalid Input Value.";
        exit;
    }
            
    // DB connection
    try{
        // Connect to the database
        require_once "./db_config.php";
        $db_conn = new mysqli($hostname, $userid, $password, $database);

        // Password hashing
        $password = password_hash($password);

        // Write SQL statement (INSERT)
        $sql = "insert into users (username, password, name) values('$username', '$password', '$name');";

        // Execute query → result returns True or False
        $result = $db_conn->query($sql);

        // Exception handling
        // If the username already exists in the database (because username is unique in DB) → $result returns False
        // Show error message and redirect to registration page
        if(!$result) {
            header("refresh:2; URL = 'register.php'");
            echo"There is a duplicate ID";
            exit;
        }else{
            header("refresh:2; URL = 'login.php'");
            echo"Successful membership registration";
            exit;
        }
    }catch (Exception $e){            
        // If DB error occurs
        // Show DB error message
        echo"DB error.$e";
    }    

    // Close the database connection
    $db_conn->close();
?>