<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <title>Delete Route</title>
</head>
<body class="deleteRoute-body">
        
<div class="back-to-home-container">
        <button type="button"><a href="../../index.html">BACK TO HOME</a></button>
    </div>
    <section class="delete-Route">
    <div class="delete-form">
        <form action="delete.php" method="post">
            Please Enter Route for Delete: <input type="text" name="id"><br><br>
            <input type="submit" name="submitdetails" value="SUBMIT">
        </form> 
    </div>
       
    <br><br>
    <h1>View All Active Routes</h1>
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
    </section>
    
</body>
</html>
