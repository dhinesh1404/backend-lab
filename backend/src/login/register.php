<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
<h2>Sign Up</h2>
<form action = "register_process.php" method = "post">
    <fieldset>
        <legend>Enter Information</legend>
        <label for = "username">ID:</lable>
        <input type = "text" id = "username" name = "username" required><br><br>

        <label for = "password">PASSWORD:</lable>
        <input type = "password" id = "password" name = "password" required><br><br>

        <label for = "name">NAME:</lable>
        <input type = "text" id = "name" name = "name" required><br><br>

        <input type = "submit" value = "Sign Up">
    </fieldset>    
</form>


</body>
</html>
