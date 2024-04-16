<?php
$routeId = ""; 
$message = "";
$duration = "";
$estimatedArrivalTime = "";

if (isset($_POST['deptAirport']) && isset($_POST['arrAirport'])) {
    $deptAirport = $_POST['deptAirport'];
    $arrAirport = $_POST['arrAirport'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT RouteID FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
        $result = $pdo->prepare($sql);
        $result->bindValue(':deptAirport', $deptAirport);
        $result->bindValue(':arrAirport', $arrAirport);
        $result->execute();

        $routeId = $result->fetchColumn();

        if ($routeId) {
            $sqlDuration = 'SELECT Duration FROM routes WHERE RouteID = :routeId';
            $resultDuration = $pdo->prepare($sqlDuration);
            $resultDuration->bindValue(':routeId', $routeId);
            $resultDuration->execute();
            $duration = $resultDuration->fetchColumn();

            $message = "Route found, Route ID: " . $routeId;
        } else {
            $message = "No active route found between selected airports.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

if (isset($_POST['flightTime'])) {

    $flightTime = $_POST['flightTime'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT RouteID, Duration FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
        $result = $pdo->prepare($sql);
        $result->bindValue(':deptAirport', $deptAirport);
        $result->bindValue(':arrAirport', $arrAirport);
        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $routeId = $row['RouteID'];
            $duration = $row['Duration'];

            $estimatedArrivalTime = date('H:i', strtotime("$flightTime + $duration minutes"));

            $message = "Route ID: " . $routeId;
        } else {
            $message = "No active route found for selected airports.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlDept = 'SELECT DISTINCT DeptAirport FROM routes WHERE Status = "Active"';
    $resultDept = $pdo->query($sqlDept);
    $deptAirports = [];
    while ($row = $resultDept->fetch(PDO::FETCH_ASSOC)) {
        $deptAirports[] = $row["DeptAirport"];
    }

    $sqlArr = 'SELECT DISTINCT ArrAirport FROM routes WHERE Status = "Active"';
    $resultArr = $pdo->query($sqlArr);
    $arrAirports = [];
    while ($row = $resultArr->fetch(PDO::FETCH_ASSOC)) {
        $arrAirports[] = $row["ArrAirport"];
    }

    $sqlFlightTimes = 'SELECT FlightTime FROM FlightTimes';
    $resultFlightTimes = $pdo->query($sqlFlightTimes);
    $flightTimes = [];
    while ($row = $resultFlightTimes->fetch(PDO::FETCH_ASSOC)) {
        $flightTimes[] = $row["FlightTime"];
    }
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
include "scheduleFlight.php";
?>
