<?php
    require_once 'includes/connection.php';

    $soort_workshop = mysqli_escape_string ($con, $_POST['soort_workshop']);
    $aantal_personen = mysqli_escape_string ($con, $_POST['aantal_personen']);
    $datum = mysqli_escape_string ($con, $_POST['datum']);
    $tijdstip = mysqli_escape_string ($con, $_POST['tijdstip']);
    $speciale_verzoeken = mysqli_escape_string ($con, $_POST['speciale_verzoeken']);
    $reserveringsnaam = mysqli_escape_string ($con, $_POST['reserveringsnaam']);
    $email = mysqli_escape_string ($con, $_POST ['email']);
    $telefoonnummer = mysqli_escape_string ($con, $_POST ['telefoonnummer']);

    $sql = "INSERT INTO informatie (soort_workshop, aantal_personen,datum, tijdstip, speciale_verzoeken, reserveringsnaam, email, telefoonnummer) VALUES ('$soort_workshop','$aantal_personen','$datum','$tijdstip','$speciale_verzoeken','$reserveringsnaam','$email','$telefoonnummer')";

    $result = mysqli_query($con, $sql);
    if ($sql){
        header("Location:reserveringen.php");
    } else {
        echo "Helaas, niet gelukt";
    }

?>



