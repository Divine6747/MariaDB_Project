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
    <form action="" method="post">
        <label for="forename">Forename:</label><br>
        <input type="text" id="forename" name="forename" required><br><br>
        
        <label for="surname">Surname:</label><br>
        <input type="text" id="surname" name="surname" required><br><br>
        
        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required><br><br>
        
        <label for="street">Street Address:</label><br>
        <input type="text" id="street" name="street"><br><br>
        
        <label for="town">Town/City:</label><br>
        <input type="text" id="town" name="town"><br><br>
        
        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country"><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
