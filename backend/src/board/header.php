<?php

    // 1. session start
    session_start();

    // 2. Store session variables -> Save session variable values during the login process
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
</head>
<body>
    Hello! <?php echo $name."($account)"; ?>
    <a href="logout.php">logout</a>
</body>
</html>