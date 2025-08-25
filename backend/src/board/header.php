<?php

    // 안녕하세요! [사용자 이름(사용자 아이디)]님 "로그아웃(버튼)" 출력을 위한 세션 처리
    // 1. 세션 시작
    session_start();

    // 2. 세션 변수 저장 -> 로그인 프로세스 처리 중 세션 변수 값 저장
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <!--
    안녕하세요! [사용자 이름(사용자 아이디)]님
    로그아웃 버튼 활성화
    -->
    안녕하세요! <?php echo $name."($account)"; ?>님 
    <a href="logout.php">로그아웃</a>
</body>
</html>