<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
</head>
<body>
    <h1>Search for Flight to Booking</h1>

    <form method="post" action="searchFlights.php">
        <label for="deptAirport">Departure Airport:</label>
        <select name="deptAirport">
            <option>Select an Option</option>
            <?php foreach ($deptAirports as $dept) : ?>
                <option value="<?php echo $dept; ?>"><?php echo $dept; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="arrAirport">Arrival Airport:</label>
        <select name="arrAirport">
            <option>Select an Option</option>
            <?php foreach ($arrAirports as $arr) : ?>
                <option value="<?php echo $arr; ?>"><?php echo $arr; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="search">Search Flights</button>
    </form>    
</body>
</html>
