<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $status = $_POST['routeStatus'];

        if ($status == "") {
            
            $sql = "SELECT * FROM routes";
        } 
        
        else {
            $sql = "SELECT * FROM routes WHERE Status = :status";
        }

        $stmt = $pdo->prepare($sql);

        if ($status != "") {
            $stmt->bindValue(':status', $status);
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
        ?>              
            <link rel="stylesheet" href="../../styles.css">

            <h2 class="select-route">Routes</h2>

            <table border='1'>
                <tr>
                    <th>RouteID</th>
                    <th>DeptAirport</th>
                    <th>ArrAirport</th>
                    <th>TicketPrice</th>
                    <th>Duration</th>
                    <th>Status</th>
                </tr>

                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $row['RouteID']?></td>
                        <td><?php echo $row['DeptAirport'] ?></td>
                        <td><?php echo $row['ArrAirport'] ?></td>
                        <td><?php echo $row['TicketPrice'] ?></td>
                        <td><?php echo $row['Duration'] ?></td>
                        <td><?php echo $row['Status'] ?></td>
                    </tr>
                <?php } ?>
            </table>            
            <button onclick="goBackToSelect()">BACK</button>
            <script src="backFunction.js"></script>

<?php
        }
        else {
            echo "No routes found.";
        }       
    }
} 

catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>