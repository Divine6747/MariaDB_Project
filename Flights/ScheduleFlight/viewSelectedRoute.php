<?php
    if(isset($_GET['routeId'])) {
        $routeId = $_GET['routeId'];

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Getting duration, dept, and arr airport
            $sql = 'SELECT DeptAirport, ArrAirport, Duration FROM routes WHERE RouteID = :routeId';
            $result = $pdo->prepare($sql);
            $result->bindValue(':routeId', $routeId);
            $result->execute();

            // Getting route details
            $row = $result->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $deptAirport = $row['DeptAirport'];
                $arrAirport = $row['ArrAirport'];
                $duration = $row['Duration'];
            } else {
                $deptAirport = "Not found";
                $arrAirport = "Not found";
                $duration = "Not found";
            }
        } catch (PDOException $e) {
            $deptAirport = "Error";
            $arrAirport = "Error";
            $duration = "Error";
        }
    } else {
        $deptAirport = "Route ID not given";
        $arrAirport = "Route ID not given";
        $duration = "Route ID not given";
    }

    try {
        // Retrieve flight times from the flighttime table
        $sqlFlightTimes = 'SELECT FlightTime FROM flightTimes';
        $stmtFlightTimes = $pdo->query($sqlFlightTimes);
        $flightTimes = $stmtFlightTimes->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        // Handle errors if any
        $flightTimes = [];
        echo "Error fetching flight times: " . $e->getMessage();
    }

    include("viewSelectedRouteForm.php");
?>
