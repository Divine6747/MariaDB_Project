<?php    
    try { 
        $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM routes WHERE Status = "Active"';
        $result = $pdo->query($sql); 

    } 
    catch (PDOException $e) { 
        echo 'Unable to connect to the database server: ' . $e->getMessage();
    }
    finally{
        $pdo = null;
        /*
         Title: How to close PDO Connection in PHP
         Authour:  Baransel Arslan
         Published: 27/12/20
         Website: https://baransel.dev/post/php-how-to-close-pdo-connection/
         Visited: 26/04/24
        */
    }
    
    if (isset($_POST['submitdetails'])) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['id'])) {
                $sql = 'DELETE FROM routes WHERE RouteID = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $_POST['id']);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "You have successfully deleted Route Number: " . $_POST['id'];
                } 
                else {
                    echo "Route with ID " . $_POST['id'] . " does not exist!!!";
                }
            } 
            else {
                echo "Route ID was not entered!!!";
            }
        } 
        catch (PDOException $e) {

            if ($e->getCode() == 23000) {
                echo "Couldn't delete the record as it is linked to other tables";
            } 
            else {
                echo "An error occurred: " . $e->getMessage();
            }
        }
        finally{
            $pdo = null;
            /*
             Title: How to close PDO Connection in PHP
             Authour:  Baransel Arslan
             Published: 27/12/20
             Website: https://baransel.dev/post/php-how-to-close-pdo-connection/
             Visited: 26/04/24
            */
         }
    }  
    include("viewRouteForDelition.php");
?>