<?php
$routeId = ""; 
$message = "";
$duration = "";
$estimatedArrivalTime = "";

// Retrieving the Departure Airports, Arrival Airports, and Times from the database 
// and populating their associated list boxes with the retrieved data.
try {
    $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Getting distinct departure airports in the database
    $sqlDept = 'SELECT DISTINCT DeptAirport FROM routes WHERE Status = "Active"';
    $resultDept = $pdo->query($sqlDept);
    $deptAirports = [];
    while ($row = $resultDept->fetch(PDO::FETCH_ASSOC)) {
        $deptAirports[] = $row["DeptAirport"];
    }

    //Getting distinct arrival airports in the database
    $sqlArr = 'SELECT DISTINCT ArrAirport FROM routes WHERE Status = "Active"';
    $resultArr = $pdo->query($sqlArr);
    $arrAirports = [];
    while ($row = $resultArr->fetch(PDO::FETCH_ASSOC)) {
        $arrAirports[] = $row["ArrAirport"];
    }

    //Getting flight times in the database
    $sqlFlightTimes = 'SELECT FlightTime FROM FlightTimes';
    $resultFlightTimes = $pdo->query($sqlFlightTimes);
    $flightTimes = [];
    while ($row = $resultFlightTimes->fetch(PDO::FETCH_ASSOC)) {
        $flightTimes[] = $row["FlightTime"];
    }
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

// Using the selected deptAirport and arrAirport to find the routeid
if (isset($_POST['deptAirport']) && isset($_POST['arrAirport'])) {
    $deptAirport = $_POST['deptAirport'];
    $arrAirport = $_POST['arrAirport'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Getting the routeid based on selected airports
        $sql = 'SELECT RouteID FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
        $result = $pdo->prepare($sql);
        $result->bindValue(':deptAirport', $deptAirport);
        $result->bindValue(':arrAirport', $arrAirport);
        $result->execute();

        //Fetching the route ID
        $routeId = $result->fetchColumn();

        if ($routeId) {
            $sqlDuration = 'SELECT Duration FROM routes WHERE RouteID = :routeId';
            $resultDuration = $pdo->prepare($sqlDuration);
            $resultDuration->bindValue(':routeId', $routeId);
            $resultDuration->execute();
            $duration = $resultDuration->fetchColumn();

            $message = "Route ID: " . $routeId;
        } else {
            $message = "No active route found between selected airports.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
if(isset($_POST['search'])) {
    // Handle search route button click
    // Perform route search logic here
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
            $stmtDuration = $pdo->prepare($sqlDuration);
            $stmtDuration->bindValue(':routeId', $routeId);
            $stmtDuration->execute();
            $duration = $stmtDuration->fetchColumn();

            $message = "Route found, Route ID: " . $routeId;
        } else {
            $message = "No active route found between selected airports.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}


//Getting the selected flight time to calculate the estimated arrival time
if (isset($_POST['flightTime'])) {
    
    $flightTime = $_POST['flightTime'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Querying the database to find the route ID and duration
        $sql = 'SELECT RouteID, Duration FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
        $result = $pdo->prepare($sql);
        $result->bindValue(':deptAirport', $deptAirport);
        $result->bindValue(':arrAirport', $arrAirport);
        $result->execute();

        //fetching the result from the database
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // If route ID and duration found, calculating the estimated arrival time
            $routeId = $row['RouteID'];
            $duration = $row['Duration'];
            $estimatedArrivalTime = date('H:i', strtotime("$flightTime + $duration minutes"));
        } else {
            $message = "No active route found for selected airports.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Including the scheduleFlight.php file
include "scheduleFlight.php";
?>
