<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles.css">
    <script src="redirect.js"></script>

    <title>Flight Details</title>
</head>
<body class="passFlightForm-body">
<button onclick="goBackToSelect()" class="back-to-top-left">BACK TO FLIGHT RE-BOOKING</button>
    <section class="pass-form-control">
        <?php if(isset($flightDetails)): ?>

        <h2>Flight Details</h2>

        <p>Flight Number: <?php echo $flightDetails['FlightNumber']; ?></p>        

        <p>Departure Time: <?php echo $flightDetails['FlightTime']; ?></p>
        <?php else: ?>

        <p>No flight details found.</p>

        <?php endif; ?><br>

        <h2>Passenger Details</h2>
        <form class="passengerID" id="passengerID" action="bookFlight.php" method="post">
            <label for="forename">Forename:</label><br>
            <input type="text" id="forename" name="forename" required maxlength = 60><br><br>

            <label for="surname">Surname:</label><br>
            <input type="text" id="surname" name="surname" required maxlength = 60><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required pattern = "[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}"><br><br>

            <label for="phone">Phone:</label><br>
            <input type="tel" id="phone" name="phone" required maxlength = 10 pattern = "08[356789]\d{7}"><br><br>

            <label for="street">Street Address:</label><br>
            <input type="text" id="street" name="street" maxlength = 50 required><br><br>

            <label for="town">Town/City:</label><br>
            <input type="text" id="town" name="town" maxlength = 50 required ><br><br>

            <label for="country">Country:</label><br>
            <input type="text" id="country" name="country" maxlength = 50 required><br><br>

            <label for="baggage">No.Baggage:</label><br>
            <input type="number" id="baggage" name="baggage" max = 7 min = 0 value = 0><br><br>

            <input type="hidden" name="flightNumber" value="<?php echo $flightDetails['FlightNumber']; ?>">
            <input type="hidden" name="flightTime" value="<?php echo $flightDetails['FlightTime']; ?>">
            <input name="BookingSubmit" type="submit" value="Submit">
        </form>
    </section>    
</body>
</html>
