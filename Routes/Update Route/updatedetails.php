<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="update.php" method="post">

        <input type="hidden" name="ud_id" value="<?php echo $id; ?>">
        
        Departure Airport: <input type="text" name="ud_deptAirport" value="<?php if (isset($deptAirport)) echo $deptAirport; ?>"><br>
        
        Arrival Airport: <input type="text" name="ud_arrAirport" value="<?php if (isset($arrAirport)) echo $arrAirport; ?>"><br>
        
        Ticket Price: <input type="text" name="ud_ticketPrice" value="<?php if (isset($ticketPrice)) echo $ticketPrice; ?>"><br>
        
        Duration (in minutes): <input type="text" name="ud_duration" value="<?php if (isset($duration)) echo $duration; ?>"><br>
        
        Status:
        <select name="ud_status">
            <option value="Active" <?php if(isset($status) && $status == 'Active') echo 'selected'; ?>>Active</option>
            <option value="Inactive" <?php if(isset($status) && $status == 'Inactive') echo 'selected'; ?>>Inactive</option>
        </select><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>