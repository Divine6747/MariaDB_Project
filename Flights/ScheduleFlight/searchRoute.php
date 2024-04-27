<?php
    $routeId = ""; 
    $message = "";
    $duration = "";

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Getting distinct departure airports in the database
        $sqlDept = 'SELECT DISTINCT DeptAirport FROM routes WHERE Status = "Active"';
        $resultDept = $pdo->query($sqlDept);
        $deptAirports = [];
        while ($row = $resultDept->fetch(PDO::FETCH_ASSOC)) {
            $deptAirports[] = $row["DeptAirport"];
        }

        // Getting distinct arrival airports in the database
        $sqlArr = 'SELECT DISTINCT ArrAirport FROM routes WHERE Status = "Active"';
        $resultArr = $pdo->query($sqlArr);
        $arrAirports = [];
        while ($row = $resultArr->fetch(PDO::FETCH_ASSOC)) {
            $arrAirports[] = $row["ArrAirport"];
        }

    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }

    // Check if the form is submitted for route search
    if(isset($_POST['search'])) {
        if(isset($_POST['deptAirport']) && isset($_POST['arrAirport'])) {
            $deptAirport = $_POST['deptAirport'];
            $arrAirport = $_POST['arrAirport'];

            try {
                //Getting the selected airports using the selected airports
                $sql = 'SELECT RouteID, Duration FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
                $result = $pdo->prepare($sql);
                $result->bindValue(':deptAirport', $deptAirport);
                $result->bindValue(':arrAirport', $arrAirport);
                $result->execute();

                //Fetching the routeid and duration
                $row = $result->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $routeId = $row['RouteID'];
                    $duration = $row['Duration'];
                    $message = "Route ID: " . $routeId;

                    header("location: viewSelectedRoute.php?routeId=$routeId&deptAirport=$deptAirport&arrAirport=$arrAirport&duration=$duration", true, 303);
                } else {
                    $message = "No active route found between selected airports.";
                }
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        } else {
            $message = "Please select both departure and arrival airports.";
        }
    }

    include "searchRouteForm.php";
?>

