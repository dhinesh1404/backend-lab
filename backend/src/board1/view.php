<?php
session_start();

    // id validation
    if( !isset($_GET['id']) || empty($_GET['id']) ){
        header("refresh: 2; URL = 'index.php'");
        echo "Invalid id value.";
        exit;
    }
try{
    // db connection
    require_once "../login/db_config.php";

    // sql statement
    $sql = "SELECT * FROM board WHERE id = '".$_GET['id']."';";
    // execute query
    $result = $db_conn->query($sql);
    // result error check
    if($result -> num_rows <= 0){
        header("refresh:2 ; URL = 'indeex.php'");
        echo "post is not found.";
    }else{
        $row = $result -> fetch_assoc();
    }
    // fetch result
}catch(Exception $e) {
    header("refresh: 10; URL = 'index.php'");
    echo "Database error<br>".$e;
    exit;
}
    // db connection close
    $db_conn->close();
    
?>
