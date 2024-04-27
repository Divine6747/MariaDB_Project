<?php
    if (isset($_POST['scheduleFlight'])) {

        $routeId = $_POST['routeId'];
        $flightTime = $_POST['flightTime'];
        $departureDate = $_POST['departureDate'];
        $numSeats = $_POST['noSeats'];

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Checking if there's already a flight scheduled for the same route and time
            $sqlCheckDuplicate = 'SELECT COUNT(*) FROM flights WHERE RouteID = :routeId AND FlightTime = :flightTime AND FlightDate = :departureDate';
            $stmtCheckDuplicate = $pdo->prepare($sqlCheckDuplicate);
            $stmtCheckDuplicate->bindValue(':routeId', $routeId);
            $stmtCheckDuplicate->bindValue(':flightTime', $flightTime);
            $stmtCheckDuplicate->bindValue(':departureDate', $departureDate);
            $stmtCheckDuplicate->execute();
            $duplicateCount = $stmtCheckDuplicate->fetchColumn();

            if ($duplicateCount > 0) {

                $message = "A flight is already scheduled for the same route and time.";
            }
            else {
                $sqlInsert = 'INSERT INTO flights (RouteID, FlightTime, FlightDate, NumSeats, NumAvailSeats, Status) VALUES (:routeId, :flightTime, :departureDate, :numSeats, :numSeats, "Active")';
                $stmtInsert = $pdo->prepare($sqlInsert);
                $stmtInsert->bindValue(':routeId', $routeId);
                $stmtInsert->bindValue(':flightTime', $flightTime);
                $stmtInsert->bindValue(':departureDate', $departureDate);
                $stmtInsert->bindValue(':numSeats', $numSeats);
                $stmtInsert->execute();
                header("Location: searchRoute.php", true, 303);
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
?>
