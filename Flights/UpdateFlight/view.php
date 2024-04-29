<?php
try { 
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM Flights';
    $result = $pdo->query($sql); 

   } 
   catch (PDOException $e) { 
     echo 'Unable to connect to the database server: ' . $e->getMessage();
   }
include("viewScheduledFlights.php");

   
?>