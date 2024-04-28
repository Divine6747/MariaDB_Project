<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST['scheduleFlight'])) {

            $routeId = $_POST['routeId'];
            $flightTime = $_POST['flightTime'];
            $flightDate = $_POST['flightDate'];
            $numSeats = $_POST['noSeats'];

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Checking if there's already a flight scheduled for the same route and time
                $sqlCheckDuplicate = 'SELECT COUNT(*) FROM flights WHERE RouteID = :routeId AND FlightTime = :flightTime AND FlightDate = :departureDate';
                $stmtCheckDuplicate = $pdo->prepare($sqlCheckDuplicate);
                $stmtCheckDuplicate->bindValue(':routeId', $routeId);
                $stmtCheckDuplicate->bindValue(':flightTime', $flightTime);
                $stmtCheckDuplicate->bindValue(':flightDate', $flightDate);

                $stmtCheckDuplicate->execute();
                $duplicateCount = $stmtCheckDuplicate->fetchColumn();

                if ($duplicateCount > 0) {

                    $message = "A flight is already scheduled for the same route and time.";
                }
                else {
                    $sqlInsert = 'INSERT INTO flights (RouteID, FlightDate,  FlightTime, NumSeats, NumAvailSeats, Status) VALUES (:routeId,  :flightDate, :flightTime, :numSeats, :numSeats, "Active")';
                    $stmtInsert = $pdo->prepare($sqlInsert);
                    $stmtInsert->bindValue(':routeId', $routeId);
                    $stmtInsert->bindValue(':flightDate', $flightDate);
                    $stmtInsert->bindValue(':flightTime', $flightTime);
                    $stmtInsert->bindValue(':numSeats', $numSeats);
                    $stmtInsert->execute();
                    echo '<script>success()</script>';
                    echo "succcess";
                }
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        }
        include("viewSelectedRouteForm.php");
    ?>    
</body>
</html>
