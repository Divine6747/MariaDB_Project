<?php
if (isset($_POST['deptAirport']) && isset($_POST['arrAirport'])) {
    $deptAirport = $_POST['deptAirport'];
    $arrAirport = $_POST['arrAirport'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlRouteId = 'SELECT RouteID FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
        $result = $pdo->prepare($sqlRouteId);
        $result = $pdo->prepare($sqlRouteId);
        $result->bindValue(':deptAirport', $deptAirport);
        $result->bindValue(':arrAirport', $arrAirport);
        $result->execute();

        $routeId = $result->rowCount() > 0;

        if ($routeId) {
            echo "Route found Route ID: " . $routeId;
        } else {
            echo "No active route found between selected airports.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charsetutf8', 'root', '');
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
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }
?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="deptAirport">Departure Airport:</label>
        <select name="deptAirport" id="deptAirport">
            <?php foreach ($deptAirports as $deptAirport) : ?>
                <option value="<?php echo $deptAirport; ?>"><?php echo $deptAirport; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="arrAirport">Arrival Airport:</label>
        <select name="arrAirport" id="arrAirport">
            <?php foreach ($arrAirports as $arrAirport) : ?>
                <option value="<?php echo $arrAirport; ?>"><?php echo $arrAirport; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="submitvalue" value="Search">
    </form>

<?php
}
?>
