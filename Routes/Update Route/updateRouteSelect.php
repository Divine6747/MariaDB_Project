<?php
try { 
  $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', ''); 
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql="SELECT count(*) FROM routes WHERE RouteID=:id";
  $result = $pdo->prepare($sql);
  $result->bindValue(':id', $_GET['RouteID']); 
  $result->execute();

  if($result->fetchColumn() > 0) {
    $sql = 'SELECT * FROM routes where RouteID = :id';
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
  }
  else {
    echo "No rows matched the query. Try again. <a href='selectupdate.php'>Click here</a> to go back.";
  }
} catch (PDOException $e) { 
  echo 'Unable to connect to the database server: ' . $e->getMessage();
}
?>
