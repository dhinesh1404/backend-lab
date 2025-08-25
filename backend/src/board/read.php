<?php

    // id값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id값일 경우
    // 오류 메시지 출력 후 게시판 목록 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='index.php'");
        echo "유효하지 않는 id값 입니다.";
        exit;
    }

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 결과값이 없을 경우
        // 해당 게시글이 없습니다. -> 게시판 목록 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='index.php'");
            echo "해당 게시글이 없습니다.";
            exit;
        } else {     // 결과값이 있을 경우
            $row = $result->fetch_assoc();
        }
    } catch (Exception $e) {
        // DB 오류 메시지 출력 후 게시판 목록 페이지 리다이렉션
        header("Refresh: 10; URL='index.php'");
        echo "DB 오류<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

    // 로그인 정보 가져오기
    require_once "./header.php";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--
    게시판 목록 > 게시글

    작성자:
    작성일:
    수정일:
    -------------------
    제목:
    내용:

    *해당 게시글 작성자만 뜨게 만들기!
    수정 버튼 활성화
    삭제 버튼 활성화
    -->
    <h1>게시판 목록 > 게시글</h1>
    <fieldset>
        <strong>작성자: </strong><?= "$row[name] ($row[account])"; ?><br>
        <strong>작성일: </strong><?= $row['created_at']; ?><br>
        <?php
            // 수정일 값이 있을 경우 출력
            if (isset($row['updated_at'])) {
                echo "<strong>수정일: </strong>$row[updated_at]<br>";
            }
        ?>
        <hr>
        <strong>제목: </strong><?= $row['title']; ?><br>
        <strong>내용:</strong><br>
        <?= $row['content']; ?><br>
    </fieldset>
    <?php
        // 게시글 작성 계정과 로그인 정보가 일치한다면
        // 버튼 활성화
        if ($row['account'] == $_SESSION['account']) {
            echo "<button><a href=update.php?id=$row[id]>수정</a></button>";
            echo "<button><a href=delete.php?id=$row[id]>삭제</a></button>";
        } else {    // 일치하지 않는다면 버튼 비활성화 -> 권한 없음 메시지 출력
            echo "<strong>-> 해당 게시글 변경 권한이 없습니다.</strong>";
        }
    ?>
    <hr>
    게시판 목록으로 돌아가시겠습니까? <a href="index.php">돌아가기</a>
</body>
</html>