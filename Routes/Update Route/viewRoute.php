<?php include("view.php");?>

<br><b>A Quick View of Routes</b><br><br>
<table>
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
                  <td><a href="updateForm.php?RouteID=<?php echo $row['RouteID'] ?>">Update</a></td>
              </tr>
    <?php  } ?>
</table>