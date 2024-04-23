<?php
if(isset($_GET['flightNumber'])) {
    $flightNumber = $_GET['flightNumber'];
    
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'SELECT * FROM flights WHERE FlightNumber = :flightNumber';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':flightNumber', $flightNumber);
        $stmt->execute();
        
        $flightDetails = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Flight number not provided.";
}

include 'flightDetailsForm.php';
?>
