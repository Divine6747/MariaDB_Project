<?php
try { 
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql="SELECT count(*) FROM Routes WHERE RouteID=:id";
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $_GET['RouteID']); 
    $result->execute();

    if($result->fetchColumn() > 0) {
      $sql = 'SELECT * FROM Routes WHERE RouteID=:id';
      $result = $pdo->prepare($sql);
      $result->bindValue(':id', $_GET['RouteID']);  
      $result->execute();

      $row = $result->fetch() ;
      $id = $row['RouteID'];
      $deptAirport = $row['DeptAirport'];
      $arrAirport = $row['ArrAirport'];
      $ticketPrice = $row['TicketPrice'];
      $duration = $row['Duration'];
      $status = $row['Status'];
      include 'updatedetails.html';

    }
    else {
      Print "No rows matched the query. Try again. <a href='selectupdate.php'>Click here</a> to go back.";
    }
  } 
  catch (PDOException $e) { 
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
  }

?>
