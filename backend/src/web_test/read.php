<?php
    // get the ID
    $commentID = isset($_GET['id'])? $_GET['id']: '';

    // validate the ID
    if(empty($commentID)){
        header("header: 2; URL= list.php");
        echo "Invalid input";
        exit;
    }

    try{
        // db address
        require_once "./db_config.php";

        // sql statement
        $sql = "SELECT * FROM final WHERE id= $id";

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
    <h2></h2>
</body>
</html>
