<?php
try { 
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM routes';
    $result = $pdo->query($sql); 
?>

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
            <td><a href="delete.php?RouteID=<?php echo $row['RouteID'] ?>">Remove</a></td>
            <td><a href="updateRouteForm.php?RouteID=<?php echo $row['RouteID'] ?>">Update</a></td>
        </tr>
    <?php } ?>
</table>

<?php
} catch (PDOException $e) { 
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}
?>
