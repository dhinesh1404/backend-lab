<?php
    // get the ID
    $id = isset($_GET['id'])? $_GET['id']: '';

    // validate the ID
    if(empty($id)){
        header("header: 2; URL= 'list.php'");
        echo "Invalid input";
        exit;
    }

    try{
        // db address
        require_once "./db_config.php";

        // sql statement
        $sql = "SELECT * FROM final WHERE id= '$id'";

        // sql query
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // comment table query
        $commentID = "SELECT * FROM comment WHERE id= $id ORDER BY commentID DESC";

        // sql query
        $commentResult = $db_conn->query($commentID);

    }catch(Exception $e){
        // db error message
        echo "db error".$e;
    }
    // db close
    $db_conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board</title>
</head>
<body>
    <h3>Post List</h3>
    <fieldset>
        <strong>Author : </strong><?= $row['name']?><br>
        <strong>Date : </strong><?= $row['created_at']?><br><br>
        <strong>Title : </strong><?= $row['title']?><br>
        <strong>Content : </strong><?= $row['messageArea']?><br>
    </fieldset><br>
    <button onclick= "location.href= 'delete.php?id=<?= $id?>'">delete</button>
    <button onclick= "location.href= 'list.php?id=<?= $id?>'">Go back</button>
    <hr>
    <form action="review.php?id=<?= $id ?>" method= "post">
    <fieldset>
        <input type="text" name="name" placeholder= "Enter your name">
        <input type="text" name="password" placeholder= "Enter your password"><br><br>
        <textarea type="text" name= "messageArea" placeholder= "Enter your comment"></textarea><br><br>
        <button>submit</button>
    </fieldset>
    </form>
<?php
    if($commentResult->num_rows <= 0){
        echo "No comment";
    }else{
        while($commentRow = $commentResult->fetch_assoc()){
            echo "$commentRow[name] ~ $commentRow[created_at]<br>";
            echo "$commentRow[messageArea]<br><br>";
        }
    }

?>
</body>
</html>
