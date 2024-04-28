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
    <title>View Route</title>
</head>
<body class="passFlightForm-body">
<button onclick="goBackToHome()" class="back-to-top-left">BACK TO FLIGHT RE-BOOKING</button>
    <section class="pass-form-control">
    <h1>Route Details</h1>
    <p>Route ID: <?php echo $routeId; ?></p>
    <p>Departure Airport: <?php echo $deptAirport; ?></p>
    <p>Arrival Airport: <?php echo $arrAirport; ?></p>
    <p>Duration: <?php echo $duration; ?></p>

    <form class="passengerID" id="passengerID" method="post" action="scheduleFlight.php">
        
        <input type="hidden" name="routeId" value="<?php echo $routeId; ?>">

        <label for="flightTime">Departure Time:</label>
        <select name="flightTime" required>
            <?php foreach ($flightTimes as $time) : ?>
                <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="departureDate">Departure Date:</label>
        <input type="date" id="departureDate" name="flightDate" required><br><br>

        <label for="noSeats">Number of Seats:</label>
        <input type="number" id="noSeats" name="noSeats" value="50" required min="50" max = 100><br><br>

        <input type="hidden" name="routeId" value="<?php echo $routeId; ?>">

        <button type="submit" name="scheduleFlight">Schedule Flight</button>
    </form>
    </section>    

    <?     include("viewSelectedRoute.php");
?>
</body>
</html>
