<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM flights WHERE FlightNumber=:flightNumber';
    $result = $pdo->prepare($sql);
    $result->bindValue(':flightNumber', $_GET['FlightNumber']);
    $result->execute();

    $row = $result->fetch();
    $flightNumber = $row['FlightNumber'];
    $routeID = $row['RouteID'];
    $flightTime = $row['FlightTime'];
    $flightDate = $row['FlightDate'];
    $status = $row['Status'];
    $numSeats = $row['NumSeats'];

    include 'updatedetails.php';
} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}
?>
