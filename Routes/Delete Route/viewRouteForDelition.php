<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <title>Delete Route</title>
</head>
<body>
    <form action="delete.php" method="post">
        Please Enter Route for Delete: <input type="text" name="rid"><br><br>
        <input type="submit" name="submitdetails" value="SUBMIT">
    </form>    

    <br><b>A Quick View of Routes</b><br><br>
    <table class="table-container">
        <tr>    
            <th>RouteID</th>
            <th>Departure Airport</th>
            <th>Arrival Airport</th>
            <th>Ticket Price</th>
            <th>Duration</th>
        </tr>

        <?php while ($row = $result->fetch()) { ?>
                <tr>
                    <td><?php echo $row['RouteID'] ?></td>
                    <td><?php echo $row['DeptAirport'] ?></td>
                    <td><?php echo $row['ArrAirport'] ?></td>
                    <td><?php echo $row['TicketPrice'] ?></td>
                    <td><?php echo $row['Duration'] ?></td>
                </tr>
        <?php  } ?>
    </table>
</body>
</html>
