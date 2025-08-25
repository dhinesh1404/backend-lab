<?php

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    
    // 유효하지 않는 id 값이 넘어올 경우
    // 오류 메시지 출력 후 해당 게시물 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='read.php?id=$id'");
        echo "유효하지 않는 id 값입니다.";
        exit;
    }

    // 세션 시작
    session_start();

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 결과값이 없을 경우
        // 오류 메시지 출력 후 해당 게시물 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='read.php?id=$id'");
            echo "해당 게시글이 없습니다.";
            exit;
        } else {    // 결과값이 있을 경우
            $row = $result->fetch_assoc();

            // 로그인 정보와 해당 게시글 작성자 정보가 다를 경우
            // 해당 게시글의 권한이 없습니다. -> 게시물 목록 페이지 리다이렉션
            if ($_SESSION['account'] != $row['account']) {
                header("Refresh: 2; URL='index.php'");
                echo "해당 게시글의 권한이 없습니다.";
                exit;
            }
        }
    } catch (Exception $e) {
        // DB 오류 메시지 출력 후 해당 게시물 페이지 리다이렉션
        echo "DB 오류<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
    <!--
    게시판 목록 > 게시글 > 수정

    SELECT
    제목: 값 불러오기
    내용: 값 불러오기

    수정 버튼 활성화
    초기화 버튼 활성화
    ------------------------
    Form
    Action: update_process.php
    Method: post
    입력값: 제목, 내용
    -->
    안녕하세요! <?= $row['name']."($row[account])"; ?>님 
    <a href="logout.php">로그아웃</a>
    <h1>게시판 목록 > 게시글 > 수정</h1>
    <form action="update_process.php?id=<?= $id; ?>" method="post">
        <fieldset>
            제목: <input type="text" name="title" value="<?= $row['title']; ?>"><br>
            내용:<br>
            <textarea name="content" rows="5" cols="30"><?= $row['content']; ?></textarea>
        </fieldset>
        <button>수정</button>
        <input type="reset" value="초기화">
        <hr>
        해당 게시글로 돌아가시겠습니까? <a href="read.php?id=<?= $id; ?>">돌아가기</a>
    </form>
</body>
</html>