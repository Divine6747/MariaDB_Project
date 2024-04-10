<?php
try { 
      $pdo = new PDO('mysql:host=localhost;dbname=airlineSYS; charset=utf8', 'root', ''); 
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = 'UPDATE Routes
             SET DeptAirport=:deptAirport, ArrAirport=:arrAirport, 
                 TicketPrice=:ticketPrice, Duration=:duration, Status=:status
                 WHERE RouteID = :id';
      $result = $pdo->prepare($sql);
      $result->bindValue(':id', $_POST['ud_id']);
      $result->bindValue(':deptAirport', $_POST['ud_deptAirport']);
      $result->bindValue(':arrAirport', $_POST['ud_arrAirport']);
      $result->bindValue(':ticketPrice', $_POST['ud_ticketPrice']);
      $result->bindValue(':duration', $_POST['ud_duration']);
      $result->bindValue(':status', $_POST['ud_status']);
      $result->execute();
      $count = $result->rowCount();
      if ($count > 0){
          echo "You just updated Route no: " . $_POST['ud_id'];
      }
      else{
          echo "nothing updated";
      }
  }
   
  catch (PDOException $e) {
      $output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
  }
  ?>