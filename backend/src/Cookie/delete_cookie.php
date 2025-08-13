<?php

// delete cookie
setcookie("username","", time() - 3600);
header("location:index.php");
exit;