<?php

    // Validate 'id' value
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    
    // If an invalid 'id' is received
    // Display error message and redirect to the post page
    if (empty($id)) {
        header("Refresh: 2; URL='read.php?id=$id'");
        echo "Invalid id value.";
        exit;
    }

    // Start session
    session_start();

    // Database connection
    try {
        require_once "./db_connect.php";

        // SQL statement (SELECT)
        $sql = "SELECT * FROM board WHERE id='$id';";

        // Execute query
        $result = $db_conn->query($sql);

        // If no result
        // Display error message and redirect to the post page
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='read.php?id=$id'");
            echo "Post not found.";
            exit;
        } else {    
            $row = $result->fetch_assoc();

            // If logged-in user is not the post author
            // Display permission error and redirect to board list page
            if ($_SESSION['account'] != $row['account']) {
                header("Refresh: 2; URL='index.php'");
                echo "You do not have permission for this post.";
                exit;
            }
        }
    } catch (Exception $e) {
        // DB error message
        echo "Database error<br>".$e;
    }

    // Close database connection
    $db_conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    Hello, <?= $row['name']." ($row[account])"; ?>! 
    <a href="logout.php">Logout</a>
    <h1>Board List > Post > Edit</h1>
    <form action="update_process.php?id=<?= $id; ?>" method="post">
        <fieldset>
            Title: <input type="text" name="title" value="<?= $row['title']; ?>"><br>
            Content:<br>
            <textarea name="content" rows="5" cols="30"><?= $row['content']; ?></textarea>
        </fieldset>
        <button>Edit</button>
        <input type="reset" value="Reset">
        <hr>
        Return to the post? <a href="read.php?id=<?= $id; ?>">Go back</a>
    </form>
</body>
</html>