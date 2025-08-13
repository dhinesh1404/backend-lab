<?php

if(isset($_post["username"])){
    // cookie 생성
    setcookie("username",trim($_POST["dhinesh"]));
    // Redirection to index.php
    header("location:index.php");
}