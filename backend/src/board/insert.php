<?php

    // 로그인 정보 불러오기
    require_once "./header.php";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성</title>
</head>
<body>
    <!--
    게시판 목록 > 글쓰기

    FORM
    Action: insert_process.php
    Method: post
    입력값: 제목(title), 내용(content)

    수정 버튼 활성화
    삭제 버튼 활성화
    -->
    <h1>게시판 목록 > 글쓰기</h1>
    <form action="insert_process.php" method="post">
        <fieldset>
            <strong>제목: </strong><input type="text" name="title"><br>
            <strong>내용: </strong><br>
            <textarea name="content" cols="30" rows="5"></textarea>
        </fieldset>
        <button>글쓰기</button>
        <input type="reset" value="초기화">
    </form>
    <hr>
    게시판 목록으로 돌아가시겠습니까? <a href="index.php">돌아가기</a>
    
    
</body>
</html>