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
    <title>Flight Search</title>
</head>
<body class="seacrchFlightForm">
<button id="back" onclick="goBackToHome()" class="back-to-top-left">BACK TO HOME</button>

    <div class="form" >
    <form method="post" action="searchFlights.php">
    <h1>Search for Flight to Booking</h1>

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
        <button class="button"type="submit" name="search">Search Flights</button>
    </form>    
    </div>   
</body>
</html>
