<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Update</title>
</head>
<body>
    <?php
        include 'header.html';
        try { 
        $pdo = new PDO('mysql:host=localhost;dbname=videos; charset=utf8', 'root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM customers';
        $result = $pdo->query($sql); 
    ?>

    <b>A Quick View</b><br><br>
    <table border=1>
    <tr><th>User Id</th>
    <th>FirstName:</th></tr>

    <?php

        while ($row = $result->fetch()):
        echo '<tr><td>' . $row['custID'] . '</td><td>'. $row['name'] . '</td></tr>';
        endwhile;
        ?>
        </table>

    <?php

    } 
    catch (PDOException $e) { 
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }

    include 'whotoupdate.html';

    ?>
    
</body>
</html>