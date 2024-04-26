<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Details</title>
</head>
<body>
    <?php if(isset($flightDetails)): ?>

        <h2>Flight Details</h2>

        <p>Flight Number: <?php echo $flightDetails['FlightNumber']; ?></p>        
        
        <p>Departure Time: <?php echo $flightDetails['FlightTime']; ?></p>
        
        <p>Estimated Arrival Time: <?php echo $flightDetails['EstArrTime']; ?></p>
        <?php else: ?>

        <p>No flight details found.</p>

    <?php endif; ?>

    <h3>Passenger Details</h3>
    <form action="bookFlight.php" method="post">
        <label for="forename">Forename:</label><br>
        <input type="text" id="forename" name="forename" required maxlength = 60><br><br>
        
        <label for="surname">Surname:</label><br>
        <input type="text" id="surname" name="surname" required maxlength = 60><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required pattern = "[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}"><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required maxlength = 10 pattern = "08[356789]\d{7}"><br><br>
        
        <label for="street">Street Address:</label><br>
        <input type="text" id="street" name="street" maxlength = 50><br><br>
        
        <label for="town">Town/City:</label><br>
        <input type="text" id="town" name="town" maxlength = 50 ><br><br>
        
        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country" maxlength = 50 ><br><br>

        <label for="baggage">No.Baggage:</label><br>
        <input type="number" id="baggage" name="baggage" max = 7 min = 0 value = 0><br><br>
        
        <input type="hidden" name="flightNumber" value="<?php echo $flightDetails['FlightTime']; ?>">
        <input type="hidden" name="flightTime" value="<?php echo $flightDetails['FlightTime']; ?>">
        <input type="hidden" name="estArrTime" value="<?php echo $flightDetails['EstArrTime']; ?>">

        <input name="BookingSubmit" type="submit" value="Submit">
    </form>
</body>
</html>
