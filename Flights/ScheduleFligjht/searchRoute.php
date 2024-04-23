<?php
    $routeId = ""; 
    $message = "";
    $duration = "";
    $estimatedArrivalTime = "";
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
    } 
    
    catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }

    //Using the selected deptAirport and arrAirport to find the routeid
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

    //Checks if route exists
    if(isset($_POST['search'])) {

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

                $message = "Route ID: " . $routeId;
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

            //Getting the database to find the routeid and duration
            $sql = 'SELECT RouteID, Duration FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
            $result = $pdo->prepare($sql);
            $result->bindValue(':deptAirport', $deptAirport);
            $result->bindValue(':arrAirport', $arrAirport);
            $result->execute();

            //fetching the result from the database
            $row = $result->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // If routeID and duration are found then calculate the estimated arrival time
                $routeId = $row['RouteID'];
                $duration = $row['Duration'];
                $estimatedArrivalTime = date('H:i', strtotime("$flightTime + $duration minutes"));
            } else {
                $message = "No active route found for selected airports.";
            }
        } 
        catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
    //Schedules the flight
    if(isset($_POST['schedule']))  {    
        $deptAirport = $_POST['deptAirport'];
        $arrAirport = $_POST['arrAirport'];
        $flightTime = $_POST['flightTime'];
        $departureDate = $_POST['departureDate'];
        $noSeats = $_POST['noSeats'];

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Getting the duration for selected route
            $sqlDuration = 'SELECT Duration FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
            $stmtDuration = $pdo->prepare($sqlDuration);
            $stmtDuration->bindValue(':deptAirport', $deptAirport);
            $stmtDuration->bindValue(':arrAirport', $arrAirport);
            $stmtDuration->execute();
            $duration = $stmtDuration->fetchColumn();

            //Calculating the estimated arrival time
            $estimatedArrivalTime = date('H:i', strtotime("$flightTime + $duration minutes"));

            //Inserting the data to the database
            $sqlInsert = 'INSERT INTO flights (RouteID, FlightTime, FlightDate, EstArrTime, NumSeats, Status) VALUES (:routeId, :flightTime, :departureDate, :estimatedArrivalTime, :noSeats, "Active")';
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindValue(':routeId', $routeId);
            $stmtInsert->bindValue(':flightTime', $flightTime);
            $stmtInsert->bindValue(':departureDate', $departureDate);
            $stmtInsert->bindValue(':estimatedArrivalTime', $estimatedArrivalTime);
            $stmtInsert->bindValue(':noSeats', $noSeats);
            $stmtInsert->execute();
            header("location: searchRoute.php",true,303); 
            $message = "Flight scheduled successfully.";                       
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }    
    include "scheduleFlight.php";
?>