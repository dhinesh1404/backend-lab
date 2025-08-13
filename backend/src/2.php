<?php
//2.php

$db_conn = new mysqli("db", "root", "root", "gsc");

if ($db_conn->errno) {
    echo "DB 접속 실패: " . $db_conn->error;
    exit();
}

// 2. sql 전송
$sql = "select * from student";
$result = $db_conn->query($sql);

// mysqli_result -> fetch_field(), fetch_field()
$field_info = $result->fetch_field();

echo "<hr>";

$field_info = $result->fetch_field();
    $field_info = $field_info[3]{
    echo $key.":".$field."<br>";
}


$db_conn->close();