<?php
    include 'header.html';
    try { 
    $pdo = new PDO('mysql:host=localhost;dbname=videos; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql="SELECT count(*) FROM customer WHERE custID=:cid";

    $result = $pdo->prepare($sql);
    $result->bindValue(':cid', $_POST['id']); 
    $result->execute();
    if($result->fetchColumn() > 0) 
    {
        $sql = 'SELECT * FROM customer where custID = :cid';
        $result = $pdo->prepare($sql);
        $result->bindValue(':cid', $_POST['id']); 
        $result->execute();

        $row = $result->fetch() ;
        $id = $row['custID'];
        $name= $row['name'];
        $address=$row['address'];
        
    }

    else {
        print "No rows matched the query. try again click<a href='selectupdate.php'> here</a> to go back";
        }
    } 
    catch (PDOException $e) { 
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }


    include 'updatedetails.html';
?>


