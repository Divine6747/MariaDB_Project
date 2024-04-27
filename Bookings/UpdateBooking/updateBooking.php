<?php
if (isset($_POST['submitUpdateBookingID'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $bookingID = $_POST['bookingID'];
        $forename = $_POST['forename'];
        $surname = $_POST['surname'];

        $stmt = $pdo->prepare('SELECT * FROM bookings b 
                               JOIN passengers p ON b.PassengerID = p.PassengerID 
                               WHERE b.BookingID = :bookingID 
                               AND p.Forename = :forename 
                               AND p.Surname = :surname');
        $stmt->bindValue(':bookingID', $bookingID);
        $stmt->bindValue(':forename', $forename);
        $stmt->bindValue(':surname', $surname);
        $stmt->execute();

        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($booking) {
            if ($booking['Status'] === 'Cancelled') {
                echo "This booking has been cancelled and cannot be updated.";
            } else {
                include 'updateBookingForm.php';
            }
        } else {
            echo "Booking not found or forename and surname do not match.";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

if (isset($_POST['updateBooking'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $bookingID = $_POST['bookingID'];
        $noBaggage = $_POST['noBaggage'];

        $stmt = $pdo->prepare('SELECT Status FROM bookings WHERE BookingID = :bookingID');
        $stmt->bindValue(':bookingID', $bookingID);
        $stmt->execute();
        $status = $stmt->fetchColumn();

        if ($status === 'Cancelled') {
            echo "This booking has been cancelled and cannot be updated.";
        } else {
            $stmt = $pdo->prepare('UPDATE bookings SET NoBaggage = :noBaggage WHERE BookingID = :bookingID');
            $stmt->bindValue(':noBaggage', $noBaggage);
            $stmt->bindValue(':bookingID', $bookingID);
            $stmt->execute();

            echo "Booking details updated successfully.";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
