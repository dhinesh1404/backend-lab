<?php

    // 페이지네이션
    $limit = 5;    // 한 페이지 당 게시글 개수
    $page = isset($_GET['page']) ? $_GET['page'] : 1;    // 현재 페이지
    $offset = ($page - 1) * $limit;    // offset

    // 검색
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

    // 검색 조건 설정(검색 타입 LIKE 검색 쿼리)
    $where = '';
    if (!empty($search_query)) {
        $where = "WHERE $search_type LIKE '%$search_query%'";
    }

    // 로그인 정보 불러오기
    require_once "./header.php";

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset;";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 전체 게시글 개수
        $sql_num = "SELECT COUNT(*) AS total FROM board $where";
        $result_num = $db_conn->query($sql_num);
        $row_num = $result_num->fetch_assoc();
        $total = $row_num['total'];
        $totalPage = ceil($total / $limit);

        $pagesPerBlock = 5;    // 한 블록 당 페이지 수
        $currentBlock = ceil($page / $pagesPerBlock);
        $startPage = ($currentBlock - 1) * $pagesPerBlock + 1;
        $endPage = min($currentBlock * $pagesPerBlock,$totalPage);

    } catch (Exception $e) {
        // DB 관련 오류 메시지 출력
        echo "DB 오류<br>".$e ;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
    
</head>
<body>
    <!--
    안녕하세요! [사용자 이름(사용자 아이디)]님 "로그아웃(버튼)"

    게시판 목록

    검색창 활성화

    Table 생성
    번호 작성자 제목 작성일 수정일
    
    글쓰기 버튼 활성화 -> insert.php

    페이지네이션 활성화
    -->
    <h1>게시판 목록</h1>

    <form action="index.php">
        <select name="search_type">
            <option value="title">제목</option>
            <option value="content">내용</option>
        </select>

        <input type="search" name="search_query">

        <button>검색</button>   
    </form>
    <br>
    <?php

        if (!empty($search_query)) {
            echo "현재 검색어(유형): ".$search_query."($search_type)<br>";
        }

    ?>
    
    
    <table border="1">
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>제목</th>
            <th>작성일</th>
            <th>수정일</th>
        </tr>

        <?php

            // 게시글 개수
            $countPage = $total - $offset;

            // DB board 테이블 출력
            // 게시글이 없을 경우
            if ($total <= 0) {
                echo "<tr>";
                echo "  <td colspan='5'>게시글이 없습니다.</td>";
                echo "</tr>";
            } else {     // 게시글이 있을 경우
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "  <td>$countPage</td>";
                    echo "  <td>$row[name]</td>";
                    echo "  <td><a href='read.php?id=$row[id]'>$row[title]</a></td>";
                    echo "  <td>$row[created_at]</td>";
                    echo "  <td>$row[updated_at]</td>";
                    echo "</tr>";

                    $countPage -= 1;
                }
            }
        ?>
    </table>
    <button><a href="insert.php">글쓰기</a></button><br>

    <?php

        // 블록 단위 이동 (이전)
        $prevBlock = $startPage - 1;

        if ($page > 5) {
            echo "<a href='?page=1&search_type=$search_type&search_query=$search_query'><<</a> ";
            echo "<a href='?page=$prevBlock&search_type=$search_type&search_query=$search_query'><</a> ";
        }

        // 현재 페이지 표시
        for ($i = $startPage ; $i <= $endPage ; $i++) {
            // 현재 페이지 진하게 강조
            if ($i == $page) {
                echo "<a href='?page=$i&search_type=$search_type&search_query=$search_query'><strong>$i</strong></a> ";
            } else {    // 현재 페이지 이외 페이지는 연하게
                echo "<a href='?page=$i&search_type=$search_type&search_query=$search_query'>$i</a> ";
            }
        }

        // 블록 단위 이동 (이후)
        $nextBlock = $endPage + 1;

        if (ceil($totalPage / $pagesPerBlock) != $currentBlock && !empty($total)) {
            echo "<a href='?page=$nextBlock&search_type=$search_type&search_query=$search_query'>></a> ";
            echo "<a href='?page=$totalPage&search_type=$search_type&search_query=$search_query'>>></a>";
        }
    ?>
    
</body>
</html>