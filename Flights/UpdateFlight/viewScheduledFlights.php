<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><b>A Quick View of Flights</b><br><br>
    <table class="flight-update">
        <tr>
            <th>Flight Number</th>
            <th>RouteID</th>
            <th>Flight Date</th>
            <th>Flight Time</th>
            <th>Number of Seats</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php while ($row = $result->fetch()) { ?>
                <tr>
                    <td><?php echo $row['FlightNumber'] ?></td>
                    <td><?php echo $row['RouteID'] ?></td>
                    <td><?php echo $row['FlightDate'] ?></td>
                    <td><?php echo $row['FlightTime'] ?></td>
                    <td><?php echo $row['NumSeats'] ?></td>
                    <td><?php echo $row['Status'] ?></td>
                    <td><a href="deleteFlightForm.html?FlightNumber=<?php echo $row['FlightNumber'] ?>">Remove</a></td>
                    <td><a href="updateForm.php?FlightNumber=<?php echo $row['FlightNumber'] ?>">Update</a></td>
                </tr>
        <?php  } ?>
    </table>
        
    </body>
</html>

<?php include("view.php");?>















