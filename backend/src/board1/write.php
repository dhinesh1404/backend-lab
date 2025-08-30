<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating a Post</title>
</head>
<body>
<h2>Creating a Post</h2>
    
    <!-- Form for creating a new post -->
    <!-- create a form that sends a POST request to write_process.php -->
<form action = "write_process.php" method = "post">
    
    <!-- create a form for name-->
    <lable for = "name">Name:</label>
    <input type = "text" id = "name" name = "name" required><br><br>

    <!-- create a form for password-->
    <lable for = "password">Password:</label>
    <input type = "password" id = "password" name = "password" required><br><br>
    <!-- create a form for title-->
    <lable for = "title"><Title></label>
    <input type = "text" id = "title" name = "title" required><br><br>

    <!-- create a form for content-->
    <lable for = "content">content</lable>
    <textarea id = "content" name = "content" rows = "10" cols = "30" required></textarea><br><br>

    <!-- create a submit button-->
    <input type = "submit" value = "submit">
</form>    
</body>
</html>