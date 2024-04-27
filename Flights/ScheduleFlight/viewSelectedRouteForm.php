<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Route</title>
</head>
<body>
    <h1>Route Details</h1>
    <p>Route ID: <?php echo $routeId; ?></p>
    <p>Departure Airport: <?php echo $deptAirport; ?></p>
    <p>Arrival Airport: <?php echo $arrAirport; ?></p>
    <p>Duration: <?php echo $duration; ?></p>

    <form method="post" action="scheduleFlight.php">
        
        <input type="hidden" name="routeId" value="<?php echo $routeId; ?>">

        <label for="flightTime">Departure Time:</label>
        <select name="flightTime" required>
            <?php foreach ($flightTimes as $time) : ?>
                <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="departureDate">Departure Date:</label>
        <input type="date" id="departureDate" name="departureDate" required><br><br>

        <label for="noSeats">Number of Seats:</label>
        <input type="number" id="noSeats" name="noSeats" value="50" required min="50" max = 100><br><br>

        <button type="submit" name="scheduleFlight">Schedule Flight</button>
    </form>
</body>
</html>
