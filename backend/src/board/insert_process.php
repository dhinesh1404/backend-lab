<?php

    // 입력값 유효성 검사
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    
    // 유효하지 않는 입력값 받았을 경우
    // 오류 메시지 출력 후 글쓰기 페이지 리다이렉션
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='insert.php'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // 세션 시작
    session_start();

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (INSERT)
        $sql = "INSERT INTO board (name, account, title, content) VALUES ('$_SESSION[name]', '$_SESSION[account]', '$title', '$content');";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        
        // 성공 메시지 출력 후 게시판 목록 페이지 리다이렉션
        header("Refresh: 2; URL='index.php'");
        echo "글쓰기 성공!";
        exit;

    } catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 글쓰기 페이지 리다이렉션
        header("Refresh: 2; URL='insert.php'");
        echo "DB 연결 실패";
    }

    // 데이터베이스 종료
    $db_conn->close();

?>