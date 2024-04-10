<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Routes</title>
</head>
<body>
<?php
if (isset($_POST['submitdetails'])) {
    try {
        $DeptAirport = $_POST['DeptAirport'];
        $ArrAirport = $_POST['ArrAirport'];
        $TicketPrice = $_POST['TicketPrice'];
        $Duration = $_POST['Duration'];
        $Status = $_POST['Status'];

        if ($DeptAirport == '' || $ArrAirport == '' || $TicketPrice == '' || $Duration == '' || $Status == '') {
            echo "You did not complete the insert form correctly <br><br>";
        } else {
            $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO routes (DeptAirport, ArrAirport, TicketPrice, Duration, Status) VALUES (:DeptAirport, :ArrAirport, :TicketPrice, :Duration, :Status)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':DeptAirport', $DeptAirport);
            $stmt->bindValue(':ArrAirport', $ArrAirport);
            $stmt->bindValue(':TicketPrice', $TicketPrice);
            $stmt->bindValue(':Duration', $Duration);
            $stmt->bindValue(':Status', $Status);

            $stmt->execute();
            echo "Route added successfully!";
        }
    } catch (PDOException $e) {
        echo 'An error has occurred: ' . $e->getMessage();
    }
}
include 'addRouteForm.html';
?>

</body>
</html>