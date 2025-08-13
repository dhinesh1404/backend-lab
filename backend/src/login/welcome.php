<?php
    // Session start
    session_start();

    // DB connect 
    require_once "./db_config.php";

    $db_conn = new mysqli($hostname,$userid,$password,$database);

    $sql = "select * from users where username='$_SESSION[username]'";
    $result = $db_conn->query($sql);
    $row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    Hello! <?php echo $row['username']; ?>

    <h2>Welcome Page</h2>
    <form>
        <fieldset>
            <legend>Login Successful</legend>
            <p><strong>Welcome <?php echo $row['name'];?> nice to meet you!!!</strong></p>
            <p><strong>You are successfully logged in.</strong></p>
            <a href="logout.php">Logout</a>
        </fieldset>
    </form>
</body>
</html>
