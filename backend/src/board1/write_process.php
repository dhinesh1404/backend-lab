<?php

   // start a session
   $session_start();
   
   // db address
   require_once "./db_config.php";

   // get a user input from write.php
   $name = isset($_POST['name'])? $_POST['name']:'';
   $password = isset($_POST['password'])? $_POST['password']:'';
   $title = isset($_POST['title'])? $_POST['title']:'';
   $content = isset($_POST['content'])? $_POST['content']:'';

   // input validation
   if(empty($name) || empty($password) || empty($title) || empty($content)) {
      header("refresh:2; URL = 'write.php'");
      echo "invalid input. please enter again.";
      exit;
   }
   // connect to the database
   try{
        $db_conn = new mysqli($hostname,$userid,$password,$database);
        $db_conn->set_charset("utf8");

        // password hashing
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // db sql statement
        $sql = "INSERT INTO board (name, password, title, content) 
            VALUE('$name', '$password_hash', '$title', '$content')";
        $result = $db_conn -> query($sql);

        if($result) {
            header("refresh:2; URL = 'list.php'");
            echo "post created successfully.";
            exit;
        }
        else{
            header("refresh:2; URL = 'write.php'");
            echo "post creation failed. please try again.";
            exit;
        }

   }catch (Exception $e) {
        echo "DB error.$e";
   }
    // close the db connection
    $db_conn->close();


?>