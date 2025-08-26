<?php

    // Validate 'id' value
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // If 'id' is invalid
    // Display error message and redirect to board list page
    if (empty($id)) {
        header("Refresh: 2; URL='index.php'");
        echo "Invalid id value.";
        exit;
    }

    // Database connection
    try {
        require_once "./db_connect.php";

        // SQL statement (SELECT)
        $sql = "SELECT * FROM board WHERE id='$id';";

        // Execute query
        $result = $db_conn->query($sql);

        // If no result
        // "Post not found." -> Redirect to board list page
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='index.php'");
            echo "Post not found.";
            exit;
        } else {
            $row = $result->fetch_assoc();
        }
    } catch (Exception $e) {
        // If DB error occurs
        header("Refresh: 10; URL='index.php'");
        echo "Database error<br>".$e;
    }

    // Close database connection
    $db_conn->close();

    // Load login information
    require_once "./header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
</head>
<!--
    Board List > Post Details

    Author:
    Created At:
    Updated At:

    Title:
    Content:
    Only display buttons for the author of this post
    Edit button enabled
    Delete button enabled
    -->
<body>
    <h1>Board List > Post Details</h1>
    <fieldset>
        <strong>Author: </strong><?= "$row[name] ($row[account])"; ?><br>
        <strong>Created At: </strong><?= $row['created_at']; ?><br>
        <?php
            // Display updated date if available
            if (isset($row['updated_at'])) {
                echo "<strong>Updated At: </strong>$row[updated_at]<br>";
            }
        ?>
        <hr>
        <strong>Title: </strong><?= $row['title']; ?><br>
        <strong>Content:</strong><br>
        <?= $row['content']; ?><br>
    </fieldset>
    <?php
        // If logged-in user is the post author
        // Enable buttons
        if ($row['account'] == $_SESSION['account']) {
            echo "<button><a href=update.php?id=$row[id]>Edit</a></button>";
            echo "<button><a href=delete.php?id=$row[id]>Delete</a></button>";
        } else {    
            // If not the author, disable buttons and show permission message
            echo "<strong>-> You do not have permission to modify this post.</strong>";
        }
    ?>
    <hr>
    Return to board list? <a href="index.php">Go back</a>
</body>
</html>