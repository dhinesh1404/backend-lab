<?php

    // Include function for value validation
    require_once "./check_value.php";

    // Validate 'id' value
    $id = check_value('id');

    // If an invalid 'id' is passed
    // "Invalid id value." -> Redirect to board list page
    if (empty($id)) {
        header("Refresh: 2;URL='index.php'");
        echo "Invalid id value.";
        exit;
    }

    // Start session
    session_start();

    // Database connection
    try {
        require_once "./db_connect.php";

        // Check authorization
        // SQL statement (SELECT)
        $sql_select = "SELECT account FROM board WHERE id='$id'";

        // Execute query
        $result = $db_conn->query($sql_select);
        $row = $result->fetch_assoc();

        // If logged-in user and post author are different
        // "You do not have permission for this post." -> Redirect to board list page
        if ($_SESSION['account'] != $row['account']) {
            header("Refresh: 2; URL='index.php'");
            echo "You do not have permission for this post.";
            exit;
        }

        // SQL statement (DELETE)
        $sql_del = "DELETE FROM board WHERE id='$id'";

        // Execute query
        $result = $db_conn->query($sql_del);

        // If deletion is successful -> Redirect to board list page
        header("Refresh: 2; URL='index.php'");
        echo "Deletion successful!";
        exit;

    } catch (Exception $e) {
        // If a database error occurs -> Redirect to the post page
        header("Refresh: 2; URL='read?id=$id'");
        echo "Database error<br>".$e;
    }

    // Close database connection
    $db_conn->close();
?>
