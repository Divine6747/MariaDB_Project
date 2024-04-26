<?php
    if (isset($_POST['submitdetails'])) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['rid'])) {
                $sql = 'DELETE FROM routes WHERE RouteID = :rid';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':rid', $_POST['rid']);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "You have successfully deleted Route Number: " . $_POST['rid'] . ". <a href='viewRouteForDelition.php'>Click here</a> to go back.";
                } else {
                    echo "Route with ID " . $_POST['rid'] . " does not exist. <a href='viewRouteForDelition.php'>Click here</a> to go back.";
                }
            } else {
                echo "Route ID is missing. <a href='viewRouteForDelition.php'>Click here</a> to go back.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "Oops! Couldn't delete the record as it is linked to other tables. <a href='viewRouteForDelition.php'>Click here</a> to go back.";
            } else {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }


    try { 
        $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM routes';
        $result = $pdo->query($sql); 

    } catch (PDOException $e) { 
        echo 'Unable to connect to the database server: ' . $e->getMessage();
    }

  include("viewRouteForDelition.php");

?>