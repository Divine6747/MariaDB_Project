<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Route</title>
</head>
<body>
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['rid'])) {
        $sql = 'DELETE FROM routes WHERE RouteID = :rid';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':rid', $_POST['rid']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "You have successfully deleted Route Number: " . $_POST['rid'] . ". <a href='deleteRouteForm.html'>Click here</a> to go back.";
        } else {
            echo "Route with ID " . $_POST['rid'] . " does not exist. <a href='deleteRouteForm.html'>Click here</a> to go back.";
        }
    } else {
        echo "Route ID is missing. <a href='deleteRouteForm.html'>Click here</a> to go back.";
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "Oops! Couldn't delete the record as it is linked to other tables. <a href='deleteRouteForm.html'>Click here</a> to go back.";
    } else {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>
</body>
</html>

</body>
</html>