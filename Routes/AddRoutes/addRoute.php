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
        } 
        else {
            $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the route already exists
            $checkStmt = $pdo->prepare("SELECT * FROM routes WHERE DeptAirport = :DeptAirport AND ArrAirport = :ArrAirport");
            $checkStmt->bindValue(':DeptAirport', $DeptAirport);
            $checkStmt->bindValue(':ArrAirport', $ArrAirport);
            $checkStmt->execute();
            $existingRoute = $checkStmt->fetch();

            if ($existingRoute) {
                echo "Route with the same departure and arrival airports already exists.";
            } 
            else {
                $insertStmt = $pdo->prepare("INSERT INTO routes (DeptAirport, ArrAirport, TicketPrice, Duration, Status) VALUES (:DeptAirport, :ArrAirport, :TicketPrice, :Duration, :Status)");
                $insertStmt->bindValue(':DeptAirport', $DeptAirport);
                $insertStmt->bindValue(':ArrAirport', $ArrAirport);
                $insertStmt->bindValue(':TicketPrice', $TicketPrice);
                $insertStmt->bindValue(':Duration', $Duration);
                $insertStmt->bindValue(':Status', $Status);
                $insertStmt->execute();
                echo "Route added successfully!";
            }
            header("location: addRouteForm.html",true,303);
        }
    } 
    catch (PDOException $e) {
        echo 'An error has occurred: ' . $e->getMessage();
    }
    finally{
       $pdo = null;
       /*
        Title: How to close PDO Connection in PHP
        Authour:  Baransel Arslan
        Published: 27/12/20
        Website: https://baransel.dev/post/php-how-to-close-pdo-connection/
        Visited: 26/04/24
       */
    }
}
include 'addRouteForm.html';
?>
