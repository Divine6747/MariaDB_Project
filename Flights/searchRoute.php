<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deptAirport']) && isset($_POST['arrAirport'])) {
    $deptAirport = $_POST['deptAirport'];
    $arrAirport = $_POST['arrAirport'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlRouteId = 'SELECT RouteID FROM routes WHERE DeptAirport = :deptAirport AND ArrAirport = :arrAirport AND Status = "Active"';
        $stmt = $pdo->prepare($sqlRouteId);
        $stmt->bindValue(':deptAirport', $deptAirport);
        $stmt->bindValue(':arrAirport', $arrAirport);
        $stmt->execute();

        $routeId = $stmt->fetchColumn();

        if ($routeId) {
            echo "Route found! Route ID: " . $routeId;
        } else {
            echo "No active route found between selected airports.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Please select departure and arrival airports.";
}
?>
