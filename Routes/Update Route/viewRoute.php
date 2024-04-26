<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <?php include("view.php");?>

    <br><b>A Quick View of Routes</b><br><br>
    <table class="table-container">
        <tr>    
            <th>RouteID</th>
            <th>Departure Airport</th>
            <th>Arrival Airport</th>
            <th>Ticket Price</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php while ($row = $result->fetch()) { ?>
                <tr>
                    <td><?php echo $row['RouteID'] ?></td>
                    <td><?php echo $row['DeptAirport'] ?></td>
                    <td><?php echo $row['ArrAirport'] ?></td>
                    <td><?php echo $row['TicketPrice'] ?></td>
                    <td><?php echo $row['Duration'] ?></td>
                    <td><?php echo $row['Status'] ?></td>
                    <td><a href="deleteRouteForm.html?RouteID=<?php echo $row['RouteID'] ?>">Remove</a></td>
                    <td ><a href="updateForm.php?RouteID=<?php echo $row['RouteID'] ?>">Update</a></td>
                </tr>
        <?php  } ?>
    </table>
</body>
</html>