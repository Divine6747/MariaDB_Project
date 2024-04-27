<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>
<body>
   <form action="update.php" method="post">

      <input type="hidden" name="flightNumber" value="<?php echo $flightNumber; ?>">
      
      Flight Number: <input type="text" name="flightNumber" value="<?php echo $flightNumber; ?>" readonly><br>

      Route ID: <input type="text" name="routeID" value="<?php echo $routeID; ?>" readonly><br>

      Flight Time: <input type="text" name="flightTime" value="<?php echo $flightTime; ?>" readonly><br>

      Estimated Arrival Time: <input type="text" name="estArrTime" value="<?php echo $estArrTime; ?>" readonly><br>
      
      Flight Date: <input type="date" name="flightDate" value="<?php echo $flightDate; ?>"><br>

      Status: <input type="text" name="status" value="<?php echo $status; ?>"><br>
      
      Number of Seats: <input type="text" name="numSeats" value="<?php echo $numSeats; ?>"><br>
      
      <input type="submit" value="Update">
   </form>
</body>
</html>



