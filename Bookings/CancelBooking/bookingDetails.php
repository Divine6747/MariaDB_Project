<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <script src="redirect.js"></script>
</head>
<body>
    <h2>Booking Details</h2>
    <p>Booking ID: <?php echo $booking['BookingID']; ?></p>
    <p>Passenger ID: <?php echo $booking['PassengerID']; ?></p>
    <p>Flight Number: <?php echo $booking['FlightNumber']; ?></p>
    <p>Flight Time: <?php echo $booking['FlightTime']; ?></p>
    <p>Estimated Arrival Time: <?php echo $booking['EstArrTime']; ?></p>
    <p>No. of Baggage: <?php echo $booking['NoBaggage']; ?></p>
    <p>Status: <?php echo $booking['Status']; ?></p>
    <form action="cancelBooking.php" method="post">
        <input type="hidden" name="bookingID" value="<?php echo $booking['BookingID']; ?>">
        <input type="submit" name="cancelBooking" value="Cancel Booking">
    </form>
</body>
</html>
