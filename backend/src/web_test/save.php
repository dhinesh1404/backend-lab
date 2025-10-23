<?php
    // Recieve the data from the form through POST method
    $name = isset($_POST['Name']) ? ($_POST['Name']): '';
    $messageArea = isset($_POST['messageArea']) ? ($_POST['messageArea']): '';

    // validate the user input
    if(empty($name) || empty($messageArea)) {
        header("refresh: 2; URL= form.html");
        echo "Invalid input. Please go back and try again.";
        exit;
    }

    try{
        // db address
        require_once "./db_config.php";

        // sql statement
        $sql = "INSERT INTO final (name, messageArea) VALUES ('$name', '$messageArea')";

        // Run the sql statement
        $result = $db_conn->query($sql);

        // if the result is failed
        // show error message
            // else show success message and redirect to list.php page
            // exit();
        if(!$result){
            header("refresh: 2; URL= form.html");
            echo "Fail to submit. please try again.";
            exit;
        }else{
            header("refresh: 2; URL= list.php");
            echo "post saved successfully!";
            exit;
        }

    }catch(Exception $e){
        // db error message
        echo "db error" .$e;
    }
    // db close
    $db_conn->close();

?>
