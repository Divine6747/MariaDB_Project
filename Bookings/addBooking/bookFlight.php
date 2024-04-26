<?php
if (isset($_POST['BookingSubmit'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=AirlineSYS;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $forename = $_POST['forename'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $street = $_POST['street'];
        $town = $_POST['town'];
        $country = $_POST['country'];

        $stmtPassenger = $pdo->prepare('INSERT INTO passengers (Forename, Surname, Email, Phone, Street, Town, Country) 
                                        VALUES (:forename, :surname, :email, :phone, :street, :town, :country)');

        $stmtPassenger->bindValue(':forename', $forename);
        $stmtPassenger->bindValue(':surname', $surname);
        $stmtPassenger->bindValue(':email', $email);
        $stmtPassenger->bindValue(':phone', $phone);
        $stmtPassenger->bindValue(':street', $street);
        $stmtPassenger->bindValue(':town', $town);
        $stmtPassenger->bindValue(':country', $country);
        $stmtPassenger->execute();

        if ($stmtPassenger->rowCount() > 0) {
            if (isset($_POST['flightNumber']) && isset($_POST['baggage'])) {
                $flightNumber = $_POST['flightNumber'];
                $noBaggage = $_POST['baggage'];
                $status = 'Confirm';

                $stmtBooking = $pdo->prepare('INSERT INTO bookings (PassengerID, FlightNumber, NoBaggage, Status) 
                                                VALUES (:passengerID, :flightNumber, :baggage, :status)');
                $stmtBooking->bindValue(':passengerID', $pdo->lastInsertId());
                $stmtBooking->bindValue(':flightNumber', $flightNumber);
                $stmtBooking->bindValue(':baggage', $noBaggage);
                $stmtBooking->bindValue(':status', $status);
                $stmtBooking->execute();

                if ($stmtBooking->rowCount() > 0) {
                    echo "Booking successful!!";
                    header("location: searchFlights.php",true,303);
                    exit;
                } else {
                    echo "Failed to insert booking details.";
                }
            } else {
                echo "Flight number, payment amount, or number of baggage items not provided.";
            }
        } else {
            echo "Failed to insert passenger details.";
        }
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }
}
?>
