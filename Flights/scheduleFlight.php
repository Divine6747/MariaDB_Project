<form method="post" action="searchRoute.php" onsubmit="return validateDate()">
    <label for="deptAirport">Departure Airport:</label>
    <select name="deptAirport">

        <?php foreach ($deptAirports as $dept) : ?>
            <option value="<?php echo $dept; ?>"><?php echo $dept; ?></option>
        <?php endforeach; ?>

    </select>

    <label for="arrAirport">Arrival Airport:</label>

    <select name="arrAirport">

        <?php foreach ($arrAirports as $arr) : ?>
            <option value="<?php echo $arr; ?>"><?php echo $arr; ?></option>
        <?php endforeach; ?>

    </select>    

    <button type="submit" name="search">Search Route</button>
    <p><?php echo $message; ?></p>
    <?php echo "Duration: " . $duration . " minutes"; ?></p>

    <label for="flightTime">Departure Time:</label>

    <select name="flightTime">

        <?php foreach ($flightTimes as $time) : ?>
            <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
        <?php endforeach; ?>

    </select>

    <?php if ($estimatedArrivalTime) : ?>

        <p>Estimated Arrival Time: <?php echo $estimatedArrivalTime; ?></p>

    <?php endif; ?>
    <button type="submit" name="calculate">Calculate</button><br><br>

    <label for="departureDate">Departure Date:</label>

    <input type="date" id="departureDate" name="departureDate"><br><br>

    <label for="noSeats">No. Seats:</label>

    <input type="textbox" id="noSeats" name="noSeats">

    <script src="scheduleFlights.js"></script>
</form>