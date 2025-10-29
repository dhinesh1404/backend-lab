<?php
    // post id 
    $id = isset($_GET['id']) ? $_GET['id']: '';

    // validate the id
    if(empty($id)){
        header("refresh: 2; URL= 'list.php'");
        echo "Invalid access";
        exit;

    }
    try{
        // db address
        require_once "./db_config.php";

        // sql statement
        $sql = "DELETE FROM final WHERE id= '$id'";

        // sql query
        $result = $db_conn->query($sql);

        // if the post was delete show a message
        if(!$result){
            header("refresh: 2; URL= 'read.php'");
            echo "fail to delete post";
            exit;
        }else{
            header("refresh: 2; URL= 'list.php'");
            echo "post deleted!";
            exit;
        }

    }catch(Exception $e){
        // db error
        echo "db error".$e;
        exit;
    }
    // db close
    $db_conn->close();

?>