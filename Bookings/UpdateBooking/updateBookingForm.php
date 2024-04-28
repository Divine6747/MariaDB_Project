<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <link rel="stylesheet" href="../../styles.css">

    <script src="redirect.js"></script>
</head>
<body class="booking-update-body2">
    <button onclick="goBackToHome()" class="back-to-top-left">BACK TO HOME</button>
    <section class="update-form-control2">
        <h2>Update Booking</h2>
        <form class="updateformcontrol2ID" id="updateformcontrol2ID" action="updateBooking.php" method="post">
            <label for="bookingID">Booking ID:</label><br>
            <input type="text" id="bookingID" name="bookingID" value="<?php echo $booking['BookingID']; ?>" required readonly><br><br>

            <label for="passengerID">Passenger ID:</label><br>
            <input type="text" id="passengerID" name="passengerID" value="<?php echo $booking['PassengerID']; ?>" required readonly><br><br>

            <label for="flightNumber">Flight Number:</label><br>
            <input type="text" id="flightNumber" name="flightNumber" value="<?php echo $booking['FlightNumber']; ?>" required readonly><br><br>

            <label for="flightTime">Flight Time:</label><br>
            <input type="time" id="flightTime" name="flightTime" value="<?php echo $booking['FlightTime']; ?>" required readonly><br><br>

            <label for="noBaggage">No. of Baggage:</label><br>
            <input type="number" id="noBaggage" name="noBaggage" value="<?php echo $booking['NoBaggage']; ?>" required><br><br>

            <input type="submit" name="updateBooking" value="Update Booking">
        </form>
    </section>    
</body>
</html>
