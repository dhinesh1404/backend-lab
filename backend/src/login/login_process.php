<?php
    // login.php
    // FORM
    // Action : login_process.php (current file)
    // Method : POST
    // Input field : username (id) and password

    
    // input validation
    $username = isset($_POST['username'])? $_POST['username']:'';
    $password = isset($_POST['password'])? $_POST['password']:'';

    // when received a invalid input 
    if(empty($username) || empty($password)) {
        header("refresh:2, URL = 'login.php'");
        echo "invalid input enter again.";
        exit;
    }

    // DB address
    require_once "./db_config.php";

    // Session start
    session_start();

    // Connecting DB
    try{
        $db_conn = new mysqli($hostname,$userid,$password,$database);

        $sql = "select * from users where username = '$username'";
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();  // [id : 3, username : root, password : hash, name : gsc]
        
        if(!$row) {
            header("refresh:2; URL= 'login.php'");
            echo "ID and Password does not exist";
            exit;
        }else {
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            header("refresh:2; URL = 'welcome.php'");
            echo "login success";
            exit;
        }

    }catch (Exception $e) {
        echo "DB error.$e";
    }
    // Close the DB connection
    $db_conn->close();

?>
