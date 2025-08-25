<?php

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id 값이 넘어온 경우
    // 유효하지 않는 id 값입니다. -> 해당 게시글 수정 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='update.php?id=$id'");
        echo "유효하지 않는 id 값입니다.";
        exit;
    }

    // 입력값 유효성 검사
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    // 유효하지 않는 입력값이 넘어온 경우
    // 유효하지 않는 입력값입니다. -> 해당 게시글 수정 페이지 리다이렉션
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='update.php?id=$id'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (INSERT)
        $sql = "UPDATE board SET title = '$title', content = '$content' WHERE id='$id'";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 쿼리 실행 성공
        // 수정 성공! -> 게시판 목록 페이지 리다이렉션
        if ($result) {
            header("Refresh: 2; URL='index.php'");
            echo "수정 성공!";
            exit;
        } else {   // 쿼리 실행 실패
            // 해당 게시글이 없습니다. -> 게시판 목록 페이지 리다이렉션
            header("Refresh: 2; URL='index.php'");
            echo "해당 게시글이 없습니다.";
            exit;
        }
    } catch (Exception $e) {
        // DB 오류 메시지 출력 후 해당 게시글 수정 페이지 리다이렉션
        header("Refresh: 10; URL='update.php?id=$id'");
        echo "DB 오류<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();
?>