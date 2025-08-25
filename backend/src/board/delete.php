<?php

    // 유효성 검사를 위한 함수 정의
    require_once "./check_value.php";

    // id 값 유효성 검사
    $id = check_value('id');

    // 유효하지 않는 id 값이 넘어왔을 경우
    // 유효하지 않는 id 값입니다. -> 게시판 목록 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2;URL='index.php'");
        echo "유효하지 않는 id 값입니다.";
        exit;
    }

    // 세션 시작
    session_start();

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // 권한 확인
        // sql문 작성 (SELECT)
        $sql_select = "SELECT account FROM board WHERE id='$id'";

        // 쿼리 실행
        $result = $db_conn->query($sql_select);
        $row = $result->fetch_assoc();

        // 로그인 정보와 해당 게시글 작성자 정보가 다를 경우
        // 해당 게시글의 권한이 없습니다. -> 게시물 목록 페이지 리다이렉션
        if ($_SESSION['account'] != $row['account']) {
            header("Refresh: 2; URL='index.php'");
            echo "해당 게시글의 권한이 없습니다.";
            exit;
        }

        // sql문 작성 (DELETE)
        $sql_del = "DELETE FROM board WHERE id='$id'";

        // 쿼리 실행
        $result = $db_conn->query($sql_del);

        // 삭제 성공! -> 게시판 목록 페이지 리다이렉션
        header("Refresh: 2; URL='index.php'");
        echo "삭제 성공!";
        exit;

    } catch (Exception $e) {
        // 데이터베이스 오류 메시지 출력 후 해당 게시글 페이지 리다이렉션
        header("Refresh: 2; URL='read?id=$id'");
        echo "DB 오류<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();
?>