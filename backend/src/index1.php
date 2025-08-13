<?php
//cookie username
// cookie -> input username
if(isset($_COOKIE['username'])) {
    $username = htmlspecialchars($_COOKIE['username']);
    echo "hello, {$username}<br>";
    echo "<a href='delete_cookie.php'>delete cookie</a>"; 
}else {
// cookie !username
//input form

    echo "<form method='post' action='set_cookie.php'>
    Name:<input type='text' name='username'>
    <buttom type='submit'>저장</buttom>
    </form>";
}