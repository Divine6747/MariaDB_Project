<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles.css">
    <title>Booking Details</title>
    <script src="redirect.js"></script>
</head>
<body class="cancelBooking-body2">
<button onclick="goBackToHome()" class="back-to-top-left">BACK TO HOME</button>
    <section class="cancelBooking-control2">        
        
        <form class="cancelBookingID2" id="cancelBookingID2" action="cancelBooking.php" method="post">

            <h2>Booking Details</h2>
            <p>Booking ID: <?php echo $booking['BookingID']; ?></p>
            <p>Passenger ID: <?php echo $booking['PassengerID']; ?></p>
            <p>Flight Number: <?php echo $booking['FlightNumber']; ?></p>
            <p>Flight Time: <?php echo $booking['FlightTime']; ?></p>
            <p>No. of Baggage: <?php echo $booking['NoBaggage']; ?></p>
            <p>Status: <?php echo $booking['Status']; ?></p>

            <input type="hidden" name="bookingID" value="<?php echo $booking['BookingID']; ?>">
            <input type="submit" name="cancelBooking" value="Cancel Booking">
        </form>

    </section>
    
</body>
</html>
