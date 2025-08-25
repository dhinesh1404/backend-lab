<?php

    // 입력값 유효성 검사
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않는 입력값이 넘어올 경우
    // 오류 메시지 출력 후 로그인 페이지 리다이렉션
    if (empty($account) || empty($pw)) {
        header("Refresh: 2; URL='login.html'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // 세션 시작
    session_start();

    // 데이터베이스 연결 (try-catch문)
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (SELECT) - 아이디, 비밀번호 비교를 위해
        $sql = "SELECT * FROM login WHERE account='$account'";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 아이디가 일치하지 않을 경우
        // 오류 메시지 출력 후 로그인 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='login.html'");
            echo "아이디가 일치하지 않습니다.";
            exit;
        } else {     // 아이디가 일치하는 경우
            // 입력 비밀번호와 해싱 처리된 비밀번호 비교
            $row = $result->fetch_assoc();

            // 비밀번호가 일치하지 않을 경우
            // 오류 메시지 출력 후 로그인 페이지 리다이렉션
            if (!password_verify($pw, $row['pw'])) {
                header("Refresh: 2; URL='login.html'");
                echo "비밀번호가 일치하지 않습니다.";
                exit;
            } else {    // 비밀번호가 일치하는 경우
                // 세션 변수(name, account) 저장
                // 로그인 성공 메시지 출력 후 게시판 목록 페이지 리다이렉션
                $_SESSION['name'] = $row['name'];
                $_SESSION['account'] = $row['account'];
                header("Refresh: 2; URL='index.php'");
                echo "로그인 성공!";
                exit;
            }
        }
    } catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 로그인 페이지 리다이렉션
        header("Refresh: 2; URL='login.html'");
        echo "DB 연결 실패". $e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>