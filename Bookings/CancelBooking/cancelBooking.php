<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <script src="redirect.js"></script>
</head>
<body>
    <?php
    if (isset($_POST['submitBookingID'])) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $bookingID = $_POST['bookingID'];
            $surname = $_POST['surname'];
            $forename = $_POST['forename'];

            $stmt = $pdo->prepare('SELECT * FROM bookings b 
                                   JOIN passengers p ON b.PassengerID = p.PassengerID 
                                   WHERE b.BookingID = :bookingID 
                                   AND p.Forename = :forename 
                                   AND p.Surname = :surname');
            $stmt->bindParam(':bookingID', $bookingID);
            $stmt->bindParam(':forename', $forename);
            $stmt->bindParam(':surname', $surname);
            $stmt->execute();
            $booking = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($booking) {
                include 'bookingDetails.php';
            } else {
                echo "Booking not found.";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    if (isset($_POST['cancelBooking'])) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $bookingID = $_POST['bookingID'];

            $stmt = $pdo->prepare('UPDATE bookings SET Status = "Cancelled" WHERE BookingID = :bookingID');
            $stmt->bindValue(':bookingID', $bookingID);
            $stmt->execute();
            
            //Increase number of Available seats from the flights table
            $stmtUpdateSeats = $pdo->prepare('UPDATE flights SET NumAvailSeats = NumAvailSeats + 1 WHERE FlightNumber = :flightNumber');
            $stmtUpdateSeats->bindValue(':flightNumber', $flightNumber);
            $stmtUpdateSeats->execute();
            echo "<script>redirectCancelBooking();</script>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>
