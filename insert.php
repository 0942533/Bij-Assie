<?php
    require_once 'includes/connection.php';

    $workshops = mysqli_escape_string($con, $_POST['soort_workshop']);
    $numberPersons = mysqli_escape_string($con, $_POST['aantal_personen']);
    $date = mysqli_escape_string($con, $_POST['datum']);
    $time = mysqli_escape_string($con, $_POST['tijdstip']);
    $specialRequests = mysqli_escape_string($con, $_POST['speciale_verzoeken']);
    $reservationName = mysqli_escape_string($con, $_POST['reserveringsnaam']);
    $emailClient = mysqli_escape_string($con, $_POST ['email']);
    $phonenumber = mysqli_escape_string($con, $_POST ['telefoonnummer']);

    $sql = "INSERT INTO informatie (soort_workshop, aantal_personen,datum, tijdstip, speciale_verzoeken, reserveringsnaam, email, telefoonnummer) VALUES ('$workshops','$numberPersons','$date','$time','$specialRequests','$reservationName','$emailClient','$phonenumber')";

    $result = mysqli_query($con, $sql);
    if ($sql){
        header("Location:reserveringen.php");
    } else {
        echo "Helaas, niet gelukt";
    }
?>



