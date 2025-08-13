<?php
session_start();

// CRUD

if(session_id() !== '') {
    echo "session starting";
}
if(session_status() == PHP_SESSION_ACTIVE) {
    echo "<br> session activating";
}
// Create, update
$_SESSION ['std_info'] = {
    "id" => 2423013, "name" => "dhinesh"
};

if(isset($_SESSION['std_info'])) {
    $_SESSION ['std_info'] = {
        "id" => 2423013, "name"=> "dhinesh"
    }; 
}else {
    echo "No Student Information"
}

$_SESSION['name'] = "dhinesh";