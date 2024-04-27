<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=airlinesys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['flightNumber'])) {
        $sql = 'DELETE FROM flights WHERE FlightNumber = :flightNumber';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':flightNumber', $_POST['flightNumber']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "You have successfully deleted Flight Number: " . $_POST['flightNumber'] . ". <a href='deleteFlightForm.html'>Click here</a> to go back.";
        } else {
            echo "Flight with Number " . $_POST['flightNumber'] . " does not exist. <a href='deleteFlightForm.html'>Click here</a> to go back.";
        }
    } else {
        echo "Flight Number is missing. <a href='deleteFlightForm.html'>Click here</a> to go back.";
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "Oops! Couldn't delete the record as it is linked to other tables. <a href='deleteFlightForm.html'>Click here</a> to go back.";
    } else {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>
