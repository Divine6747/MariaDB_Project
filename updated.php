<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try { 
        $pdo = new PDO('mysql:host=localhost;dbname=videos; charset=utf8', 'root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'update customer set name=:cname,address=:caddress WHERE custID = :cid';
        $result = $pdo->prepare($sql);
        $result->bindValue(':cid', $_POST['id']); 
        $result->bindValue(':cname', $_POST['cname']); 
        $result->bindValue(':caddress', $_POST['caddress']); 
        $result->execute();
                        
        $count = $result->rowCount();
        if ($count > 0)
        {
            echo "You just updated customer no: " . $_POST['id'] ."  click<a href='selectupdate.php'> here</a> to go back ";
        }
        else
        {
            echo "nothing updated";
        }
        }
        
        catch (PDOException $e) { 

        $output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

        }
    ?>
</body>
</html>