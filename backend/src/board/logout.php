<?php

    // 로그아웃을 위한 세션 처리
    // 1. 세션 시작
    session_start();

    // 2. 세션 변수 초기화
    $_SESSION = [];

    // 3. 세션 쿠키 삭제
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    // 4. 세션 파괴
    session_destroy();

    // 세션 처리가 끝나면 로그아웃 성공 메시지 출력 후 로그인 페이지 리다이렉션
    header("Refresh: 2; URL='login.html'");
    echo "로그아웃 성공!";
    exit;
    
?>