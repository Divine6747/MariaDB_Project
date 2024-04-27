<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Submit</title>
    <script src="redirect.js"></script>
</head>
<body>
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

                if (isset($_POST['flightNumber']) && isset($_POST['baggage'])&& isset($_POST['flightTime'])) {
                    $flightNumber = $_POST['flightNumber'];
                    $flightTime = $_POST['flightTime'];
                    $noBaggage = $_POST['baggage'];
                    $status = 'Confirm';
    
                    $stmtBooking = $pdo->prepare('INSERT INTO bookings (PassengerID, FlightNumber, FlightTime, NoBaggage, Status) 
                                                    VALUES (:passengerID, :flightNumber, :flightTime, :baggage, :status)');
                    $stmtBooking->bindValue(':passengerID', $pdo->lastInsertId());
                    $stmtBooking->bindValue(':flightNumber', $flightNumber);
                    $stmtBooking->bindValue(':flightTime', $flightTime);
                    $stmtBooking->bindValue(':baggage', $noBaggage);
                    $stmtBooking->bindValue(':status', $status);
                    $stmtBooking->execute();
    
                    if ($stmtBooking->rowCount() > 0) {
                        //Deceasing the flight number
                        $stmtUpdateSeats = $pdo->prepare('UPDATE flights SET NumAvailSeats = NumAvailSeats - 1 WHERE FlightNumber = :flightNumber');
                        $stmtUpdateSeats->bindValue(':flightNumber', $flightNumber);
                        $stmtUpdateSeats->execute();

                        echo '<script>redirectBooking();</script>';
                    } else {
                        echo "Failed to insert the booking details.";
                    }
                } else {
                    echo "Flight number or number of baggage items not provided.";
                }
            } else {
                echo "Failed to insert passenger details.";
            }
        } catch (PDOException $e) {
            $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
        }
    }
    ?>
</body>
</html>



