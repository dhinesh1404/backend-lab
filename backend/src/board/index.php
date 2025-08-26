<?php

    // Pagination
    $limit = 5;    // Number of posts per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;    // Current page
    $offset = ($page - 1) * $limit;    // Offset

    // Search
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

    // Set search condition (LIKE query based on search type)
    $where = '';
    if (!empty($search_query)) {
        $where = "WHERE $search_type LIKE '%$search_query%'";
    }

    // Load login information
    require_once "./header.php";

    // Database connection
    try {
        require_once "./db_connect.php";

        // SQL statement (SELECT)
        $sql = "SELECT * FROM board $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset;";

        // Execute query
        $result = $db_conn->query($sql);

        // Total number of posts
        $sql_num = "SELECT COUNT(*) AS total FROM board $where";
        $result_num = $db_conn->query($sql_num);
        $row_num = $result_num->fetch_assoc();
        $total = $row_num['total'];
        $totalPage = ceil($total / $limit);

        $pagesPerBlock = 5;    // Pages per block
        $currentBlock = ceil($page / $pagesPerBlock);
        $startPage = ($currentBlock - 1) * $pagesPerBlock + 1;
        $endPage = min($currentBlock * $pagesPerBlock, $totalPage);

    } catch (Exception $e) {
        // Display DB error message
        echo "Database error<br>".$e ;
    }

    // Close database connection
    $db_conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board List</title>
</head>
<body>
    <!--
    Hello! [User Name(User ID)] "Logout(button)"

    Board List

    Activate search bar

    Create table
    No | Author | Title | Created At | Updated At

    Activate "Write Post" button -> insert.php

    Enable pagination
    -->
    <h1>Board List</h1>

    <form action="index.php">
        <select name="search_type">
            <option value="title">Title</option>
            <option value="content">Content</option>
        </select>

        <input type="search" name="search_query">

        <button>Search</button>   
    </form>
    <br>
    <?php
        if (!empty($search_query)) {
            echo "Current search query (type): ".$search_query." ($search_type)<br>";
        }
    ?>
    
    <table border="1">
        <tr>
            <th>No</th>
            <th>Author</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>

        <?php
            // Post numbering
            $countPage = $total - $offset;

            // Display posts from DB board table
            if ($total <= 0) {
                echo "<tr>";
                echo "  <td colspan='5'>No posts available.</td>";
                echo "</tr>";
            } else {
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
    <button><a href="insert.php">Write Post</a></button><br>

    <?php
        // Previous block
        $prevBlock = $startPage - 1;

        if ($page > 5) {
            echo "<a href='?page=1&search_type=$search_type&search_query=$search_query'><<</a> ";
            echo "<a href='?page=$prevBlock&search_type=$search_type&search_query=$search_query'><</a> ";
        }

        // Display current pages
        for ($i = $startPage ; $i <= $endPage ; $i++) {
            if ($i == $page) {
                echo "<a href='?page=$i&search_type=$search_type&search_query=$search_query'><strong>$i</strong></a> ";
            } else {
                echo "<a href='?page=$i&search_type=$search_type&search_query=$search_query'>$i</a> ";
            }
        }

        // Next block
        $nextBlock = $endPage + 1;

        if (ceil($totalPage / $pagesPerBlock) != $currentBlock && !empty($total)) {
            echo "<a href='?page=$nextBlock&search_type=$search_type&search_query=$search_query'>></a> ";
            echo "<a href='?page=$totalPage&search_type=$search_type&search_query=$search_query'>>></a>";
        }
    ?>
    
</body>
</html>
