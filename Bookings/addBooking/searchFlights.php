<?php
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

    if (isset($_POST['deptAirport']) && isset($_POST['arrAirport'])) {
        $deptAirport = $_POST['deptAirport'];
        $arrAirport = $_POST['arrAirport'];

        // Retrieving flights for the selected departure and arrival airports
        $sql = 'SELECT f.FlightNumber, f.FlightTime, f.EstArrTime
                FROM flights f
                JOIN routes r ON f.RouteID = r.RouteID
                WHERE r.DeptAirport = :deptAirport AND r.ArrAirport = :arrAirport 
                AND f.FlightDate > CURDATE()';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':deptAirport', $deptAirport);
        $stmt->bindValue(':arrAirport', $arrAirport);
        $stmt->execute();
        $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($flights) {
            ?>
            <h2>Available Flights</h2>
            <table id="flightTable" border='1'>
                <tr>
                    <th>Flight Number</th>
                    <th>Departure Time</th>
                    <th>Estimated Arrival Time</th>
                    <th>Select to Flight to Book</th>
                </tr>
                <?php foreach ($flights as $flight) { ?>
                    <tr>
                        <td class="flightNumber"><?php echo $flight['FlightNumber']; ?></td>
                        <td><?php echo $flight['FlightTime']; ?></td>
                        <td><?php echo $flight['EstArrTime']; ?></td>
                        <td>
                            <form method="get" action="flightBookingDetails.php">
                                <input type="hidden" name="flightNumber" value="<?php echo $flight['FlightNumber']; ?>">
                                <button type="submit" name="select">Select</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <?php
        } else {
            echo "No flights available for the selected route.";
        }
    }
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include("searchFlightsForm.php");
?>
