<?php

    // create a pagination.
    $limit = 5 ; // set the page limit
    
    // get the page query
    $page = isset($_GET['page']) ? $_GET['page']: '1';

    // set the offset
    $offset = ($page - 1) * $limit;

    // create a search query
    $search_type = isset($_GET['search_type']) ? $_GET['search_type']: 'name';
    $search_query = isset($_GET['search_query']) ? $_GET['search_query']: '';

    $where = '';

    // validate the search query
    if(!empty($search_query)){
        $where = "WHERE $search_type LIKE '$search_query%'";
    }
    // inside this error handling
    try{
        // db address
        require_once "./db_config.php";

        // sql statement
        $sql = "SELECT * FROM final $where ORDER BY id DESC LIMIT $limit OFFSET $offset"; 
        
        // sql query
        $result = $db_conn->query($sql);

        // set the page setting
        $totalSql = "SELECT COUNT(*) total FROM final $where";
        $totalResult = $db_conn->query($totalSql);
        $totalRow = ($totalResult->fetch_assoc());
        $total = $totalRow['total'];
        $totalPage = ceil($total/$limit);

        // set the block setting
        $pagePerBlock = 5;
        $currentBlock = ceil($page / $pagePerBlock);
        $startPage = ($currentBlock - 1) * $pagePerBlock + 1;
        $endPage = min($currentBlock * $pagePerBlock, $totalPage);

    }catch(Exception $e){
        // db error 
        echo "db error".$e;
    }
    // db close
    $db_conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
</head>
<body>
    <h2>list</h2>
<!-- create a search type option and search input bar and search button -->
<form action="list.php" method= "get">
    <select name="search_type">
        <option value="name">Author</option>
        <option value="messageArea">Content</option>
    </select>
    <input type="search" name="search_query">
    <button>search</button>
</form>

<!-- create a table tag -->
<form action="list.php" method= "get">
        <table border="2">
        <tr>
            <td>id</td>
            <td>Name</td>
            <td>Title</td>
            <td>Content</td>
            <td>Created_at</td>
        </tr>
<?php
    // if the input is valid show the post 
    // else show the error message
    if($result->num_rows <=0){
        echo "No post";
    }
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>$row[id]</td>";
        echo "<td>$row[name]</td>";
        echo "<td>$row[title]</td>";
        echo "<td><a href='read.php?id=$row[id]'>$row[messageArea]</a></td>";
        echo "<td>$row[created_at]</td>";
        echo "</tr>";
    }
        
?>
</table>
</form>
    <!-- create a anchor for write -->
    <a href="form.html">write</a><br><br>
<?php
    // search query
    $search = "search_type=$search_type&search_query=$search_query";

    // previous block
    $prevPage = $startPage - 1;

    if($currentBlock != 1){
        echo "<a href='?page=1&$search'><<<</a> ";
        echo "<a href='?page=$prevPage&$search'><</a> ";
    }

    for($i = $startPage; $i <= $endPage; $i++){
        if($i == $page){
            echo "<a href='?page=$i&$search'><strong>$i</strong></a> ";
        }else{
            echo "<a href='?page=$i&$search'>$i</a> ";
        }
    }

    // next block
    $nextBlock = $endPage + 1;

    if($endPage != $totalPage){
        echo "<a href='?page=$nextBlock&$search'>></a> ";
        echo "<a href='?page=$endPage&$search'>>></a> ";
    }

?>
</body>
</html>