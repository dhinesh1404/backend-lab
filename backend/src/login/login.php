<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h2>login</h2>
    
    <form action = "login_process.php" method = "post">
    <fieldset>
        <legend>Enter login Information</legend>
        <label>ID:<input type = "text" name = "username" required></label><br>

        <label>PASSWORD:<input type = "password" name = "password" required></label><br>
        
        <input type = "submit" valule = "login">
    </fieldset>    
</form>
</body>
</html>