<?php

    // Input validation
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    
    // If invalid input is received
    // Display error message and redirect to write post page
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='insert.php'");
        echo "Invalid input values.";
        exit;
    }

    // Start session
    session_start();

    // Database connection
    try {
        require_once "./db_connect.php";

        // SQL statement (INSERT)
        $sql = "INSERT INTO board (name, title, content) VALUES ('$_SESSION[name]', '$title', '$content');";

        // Execute query
        $result = $db_conn->query($sql);
        
        // Display success message and redirect to board list page
        header("Refresh: 2; URL='index.php'");
        echo "Post successfully created!";
        exit;

    } catch (Exception $e) {
        // If database connection fails
        // Display error message and redirect to write post page
        // header("Refresh: 2; URL='insert.php'");
        echo "Database connection failed.<br>".$e;
    }

    // Close database connection
    $db_conn->close();

?>
