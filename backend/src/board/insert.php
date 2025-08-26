<?php

    // Load login information
    require_once "./header.php";

?>
<!--
    Board List > Create Post

    FORM
    Action: insert_process.php
    Method: POST
    Input fields: Title (title), Content (content)

    Edit button enabled
    Delete button enabled
    -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <h1>Board List > Create Post</h1>
    <form action="insert_process.php" method="post">
        <fieldset>
            <strong>Title: </strong><input type="text" name="title"><br>
            <strong>Content: </strong><br>
            <textarea name="content" cols="30" rows="5"></textarea>
        </fieldset>
        <button>Submit</button>
        <input type="reset" value="Reset">
    </form>
    <hr>
    Return to the board list? <a href="index.php">Go back</a>
    
</body>
</html>