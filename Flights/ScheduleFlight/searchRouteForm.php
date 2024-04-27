<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>
<body>
    <form action="searchRoute.php" method="post">
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
    </form>

</body>
</html>