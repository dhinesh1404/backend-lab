<?php

    // Validate 'id' value
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // If an invalid 'id' is received
    // Display error message and redirect to the post update page
    if (empty($id)) {
        header("Refresh: 2; URL='update.php?id=$id'");
        echo "Invalid id value.";
        exit;
    }

    // Input validation
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    // If invalid input values are received
    // Display error message and redirect to the post update page
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='update.php?id=$id'");
        echo "Invalid input values.";
        exit;
    }

    // Database connection
    try {
        require_once "./db_connect.php";

        // SQL statement (UPDATE)
        $sql = "UPDATE board SET title = '$title', content = '$content' WHERE id='$id'";

        // Execute query
        $result = $db_conn->query($sql);

        // If query execution is successful
        // Display success message and redirect to board list page
        if ($result) {
            header("Refresh: 2; URL='index.php'");
            echo "Update successful!";
            exit;
        } else {   
            // If query fails
            // Display error message and redirect to board list page
            header("Refresh: 2; URL='index.php'");
            echo "Post not found.";
            exit;
        }
    } catch (Exception $e) {
        // If DB error occurs
        // Display error message and redirect to post update page
        header("Refresh: 10; URL='update.php?id=$id'");
        echo "Database error<br>".$e;
    }
    // Close database connection
    $db_conn->close();
?>