<?php
session_start();

// read_session.php

// delete all 
// delete memory
$_SESSION = [];
// delete all file
session_destroy();


print_r($_SESSION);