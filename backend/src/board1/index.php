<?php

    try {
        // connect DB
        require_once '../login/db_config.php';

        // write sql sentence (SELECT)
        $sql = "SELECT * FROM board";

        // execute Query
        $result = $db_conn->query($sql);

    } catch (Exception $e) {
        header("Refresh: 2; URL='index.php'");
        echo "DB error<br>".$e;
        exit;
    }

    // DB close
    $db_conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>board list</title>
</head>
<body>
    <h1>board</h1>

    <table border='1'>
        <tr>
            <th>id</th>
            <th>author_name</th>
            <th>title</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
    

        <?php

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>$row[id]</td>";
                echo "<td>$row[name]</td>";
                echo "<td><a href='view.php?id=$row[id]'>$row[title]</a></td>";
                echo "<td>$row[created_at]</td>";
                echo "<td>$row[updated_at]</td>";
                echo "</tr>";
            }

        ?>
    </table>
</body>
</html>