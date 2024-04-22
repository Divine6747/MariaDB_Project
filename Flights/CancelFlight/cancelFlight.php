<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=airlineSYS;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['flightNumber'])) {
        $sql = 'UPDATE flights SET Status = "Cancelled" WHERE FlightNumber = :flightNumber';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':flightNumber', $_POST['flightNumber']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "You have successfully cancelled Flight Number: " . $_POST['flightNumber'] . ". <a href='cancelFlightForm.html'>Click here</a> to go back.";
        } else {
            echo "Flight with Number " . $_POST['flightNumber'] . " does not exist. <a href='cancelFlightForm.html'>Click here</a> to go back.";
        }
    } else {
        echo "Flight Number is missing. <a href='cancelFlightForm.html'>Click here</a> to go back.";
    }
} catch (PDOException $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
