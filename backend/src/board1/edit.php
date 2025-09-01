<?php
    require_once "./db_config.php";
    session_start();

    // id validation
    $id = isset($_GET['id'])? $_GET['id']:'';

try{

    // db connection
    $db_conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $db_conn->set_charset("utf8");

    // prepare the sql statement
    $sql = "SELECT * FROM board WHERE id = '".$_GET['id']."';";
    // query execution
    $result = $db_conn->query($sql);
    
    // check the error
    if($result -> num_rows <= 0){
        header("refresh:2; URL = 'index.php'");
        echo "post was not found.";
        exit;
    }else{
        $row = $result -> fetch_assoc();
    }
    // fetch the result

}catch(Exception $e){
    header("refresh: 10; URL = 'index.php'");
    echo "Database error<br>".$e;
    exit;
}
    // db connection close
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
</head>
<body>
    <h1>edit post</h1>
    <!-- create a form and method is post -->
<form action = "edit_process.php" method = "post">
    <input type="hidden" name = "id" value = "<?php echo $row['id'];?>">
    
    <!-- cannot mofify author name and display it -->
     <p><strong>Author:</strong> <?php echo htmlspecialchars($row['name']); ?></p>

    <!-- Title inpiut box -->
    <p>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
    </p>    
    
    <!-- Content input box -->
    <p>
        <lable for = "content">content:</lable><br>
        <textarea id = "content" name = "content" rows = "10" cols = "50" required><?php echo htmlspecialchars($row['content']); ?></textarea>
    </p>

    <!-- password input box -->
    <p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </p>
    <!-- submit button and cancel button -->
    <button type = "submit">Submit</button>
    <button type = "button" onclick="window.location.href='index.php'">Cancel</button>
</form>  
</body>
</html>