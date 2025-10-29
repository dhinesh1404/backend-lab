<?php
    // get the ID
    $id = isset($_GET['id']) ? $_GET['id']: '';

    // post the userName, password and content
    $name = isset($_POST['name']) ? $_POST['name']: '';
    $password = isset($_POST['password']) ? $_POST['password']: '';
    $content = isset($_POST['messageArea']) ? $_POST['messageArea']: '';
    
    // validate the ID
    if(empty($name) || empty($password) || empty($content)){
        header("refresh: 2; URL= 'list.php'");
        echo "Invalid input";
        exit;
    }

    try{
        // db address
        require_once "./db_config.php";

        // password hashing
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        // sql statement
        $sql = "INSERT INTO comment(id ,name, password, messageArea) 
                    VALUES ('$id', '$name', '$pass_hash', '$content')";

        // sql query
        $result = $db_conn->query($sql);


        header("location: read.php?id= $id");
        
    }catch(Exception $e){
        // db error
        echo "db error".$e;
    }
    // db close
    $db_conn-> close();

?>