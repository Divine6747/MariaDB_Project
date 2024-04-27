<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=airlineSYS; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'UPDATE flights
            SET FlightDate=:flightDate, Status=:status, NumSeats=:numSeats
            WHERE FlightNumber = :flightNumber';
    
    $result = $pdo->prepare($sql);
    $result->bindValue(':flightNumber', $_POST['flightNumber']);
    $result->bindValue(':flightDate', $_POST['flightDate']);
    $result->bindValue(':status', $_POST['status']);
    $result->bindValue(':numSeats', $_POST['numSeats']);
    $result->execute();
    
    $count = $result->rowCount();
    
    if ($count > 0) {
        echo "Flight details updated successfully for Flight Number: " . $_POST['flightNumber'];
    } else {
        echo "No changes were made to the flight details.";
    }
} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>
