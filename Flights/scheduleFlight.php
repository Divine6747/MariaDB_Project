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

if (isset($_POST['deptAirport']) && isset($_POST['arrAirport']) && isset($_POST['flightTime'])) {
    $deptAirport = $_POST['deptAirport'];
    $arrAirport = $_POST['arrAirport'];
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

            $message = "Route found, Route ID: " . $routeId;
        } else {
            $message = "No active route found between selected airports.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlDept = 'SELECT DISTINCT DeptAirport FROM routes WHERE Status = "Active"';
    $stmtDept = $pdo->query($sqlDept);
    $deptAirports = [];
    while ($row = $stmtDept->fetch(PDO::FETCH_ASSOC)) {
        $deptAirports[] = $row["DeptAirport"];
    }

    $sqlArr = 'SELECT DISTINCT ArrAirport FROM routes WHERE Status = "Active"';
    $stmtArr = $pdo->query($sqlArr);
    $arrAirports = [];
    while ($row = $stmtArr->fetch(PDO::FETCH_ASSOC)) {
        $arrAirports[] = $row["ArrAirport"];
    }

    $sqlFlightTimes = 'SELECT FlightTime FROM FlightTimes';
    $stmtFlightTimes = $pdo->query($sqlFlightTimes);
    $flightTimes = [];
    while ($row = $stmtFlightTimes->fetch(PDO::FETCH_ASSOC)) {
        $flightTimes[] = $row["FlightTime"];
    }
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
?>

<script>
function updateEstimatedArrivalTime() {
    var flightTime = document.getElementById('flightTime').value;
    var duration = <?php echo json_encode($duration); ?>;
    var estimatedArrivalTimeElement = document.getElementById('estimatedArrivalTime');
    var estimatedArrivalTime = document.getElementById('estimatedArrivalTime').value;

    var newEstimatedArrivalTime = new Date('1970-01-01T' + flightTime);
    newEstimatedArrivalTime.setMinutes(newEstimatedArrivalTime.getMinutes() + duration);

    estimatedArrivalTimeElement.value = newEstimatedArrivalTime.getHours().toString().padStart(2, '0') + ':' + newEstimatedArrivalTime.getMinutes().toString().padStart(2, '0');
}
</script>

<form method="post" action="">
    <label for="deptAirport">Departure Airport:</label>
    <select name="deptAirport" id="deptAirport">
        <?php foreach ($deptAirports as $dept) : ?>
            <option value="<?php echo $dept; ?>"><?php echo $dept; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="arrAirport">Arrival Airport:</label>
    <select name="arrAirport" id="arrAirport">
        <?php foreach ($arrAirports as $arr) : ?>
            <option value="<?php echo $arr; ?>"><?php echo $arr; ?></option>
        <?php endforeach; ?>
    </select>    

    <button type="submit" name="search">Search Route</button>
    <p><?php echo $message; ?></p>

    <label for="flightTime">Flight Time:</label>
    <select name="flightTime" id="flightTime" onchange="updateEstimatedArrivalTime()">
        <?php foreach ($flightTimes as $time) : ?>
            <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
        <?php endforeach; ?>
    </select>

    <p>Estimated Arrival Time: <input type="text" id="estimatedArrivalTime" value="<?php echo $estimatedArrivalTime; ?>" readonly></p>
</form>
