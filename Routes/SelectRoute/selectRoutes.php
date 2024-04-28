<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <title>Document</title>
</head>
<body class="header">
    <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['routeStatus'])) {

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
            <div class="all">
                <div class="select-route-table">
                    <h2>View Selected Route Option</h2>
                </div>
                <div class="select-route-table-container">
                    <table class="select-route-table" border='1'>
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
                </div>            
            </div>
                        
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
    
</body>
</html>
