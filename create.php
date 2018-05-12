<?php
session_start();

if(!isset($_SESSION['email'])) {
    // redirect to login page
    header('Location: login.php');
    exit;
}

// Require database in this file
require_once 'includes/connection.php';

// if form is posted, lets validate!
if (isset($_POST['submit'])) {
    $soort_workshop = mysqli_escape_string ($con, $_POST['soort_workshop']);
    $aantal_personen = mysqli_escape_string ($con, $_POST['aantal_personen']);
    $datum = mysqli_escape_string ($con, $_POST['datum']);
    $tijdstip = mysqli_escape_string ($con, $_POST['tijdstip']);
    $speciale_verzoeken = mysqli_escape_string ($con, $_POST['speciale_verzoeken']);
    $reserveringsnaam = mysqli_escape_string ($con, $_POST['reserveringsnaam']);
    $email = mysqli_escape_string ($con, $_POST ['email']);
    $telefoonnummer = mysqli_escape_string ($con, $_POST ['telefoonnummer']);

    $errors = [];
    if(empty($datum)) {
        $errors['datum'] = 'Kies een datum';
    }
    if(empty($reserveringsnaam)) {
        $errors['reserveringsnaam'] = 'Vul je reserveringsnaam in';
    }
    if(empty($email)) {
        $errors['email'] = 'Vul je e-mailadres in';
    }
    if(empty($email)) {
        $errors['telefoonnummer'] = 'Vul je telefoonnummer in';
    }
// if everything is filled in, database can be checked
    if(empty($errors)) {
        $query = "INSERT INTO informatie (soort_workshop, aantal_personen,datum, tijdstip, speciale_verzoeken, reserveringsnaam, email, telefoonnummer) VALUES ('$soort_workshop','$aantal_personen','$datum','$tijdstip','$speciale_verzoeken','$reserveringsnaam','$email','$telefoonnummer')";

        $result = mysqli_query($con, $query);

        $errors = [];

        if ($query) {
            // Redirect to reserveringen.php &exit script
            header("Location: reserveringen.php");
            exit;
        }
    }
}
?>

<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<head>
    <title>Bij-Assie | reservering toevoegen</title>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
</head>
<body>
<section id="create">
    <div class="container">
        <div class="logout">
            <a href="logout.php"><img src="img/logout-button.png" id="logout-button"/> Uitloggen</a>
        </div><!-- End logout -->
        <div id="wrapper">
            <h4 class="create">Reservering toevoegen</h4>
            <hr>
            <p>Voeg een nieuwe reservering toe aan de tabel.</p>

            <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <label for="soort_workshop">Soort workshop:</label>
                        <select class="form-control" id="sel1" name="soort_workshop">
                            <option disabled>- Kies het soort workshop -</option>
                            <option value="Koffie workshop €45">Koffie workshop €45</option>
                            <option value="Thee workshop €40">Thee workshop €40</option>
                        </select>
                    </div><!-- End col-6 -->

                    <div class="col-6">
                        <label for="soort_workshop">Aantal personen:</label>
                        <select class="form-control" id="sel1" name="aantal_personen">
                            <option disabled>- Kies het aantal personen -</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                    </div><!-- End col-6 -->
                </div><!-- End row-->

                <div class="row">
                    <div class="col-6">
                        <label for="datum">Datum:</label>
                        <input type="date" name="datum"/>
                        <span class="error"><?= isset($errors['datum']) ? $errors['datum'] : ''; ?></span>
                    </div><!-- End col-6 -->

                    <div class="col-6">
                        <label for="tijdstip">Tijdstip:</label>
                        <select class="form-control" id="sel1" name="tijdstip">
                            <option disabled>- Kies het tijdstip -</option>
                            <option value="19:30 - 21:30u">19:30 - 21:30u</option>
                        </select>
                    </div><!-- End col-6 -->
                </div><!-- End row-->

                <div class="row">
                    <div class="col-12">
                        <label for="speciale-verzoeken">Speciale verzoeken:</label>
                        <textarea name="speciale_verzoeken" class="form-control" rows="5" id="comment" placeholder="Denk aan dieetrestricties, allergieën of andere zaken die we zouden moeten weten, of is bijvoorbeeld iemand jarig?"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="reserveringsnaam">Reserveringsnaam:</label>
                        <input type="text" name="reserveringsnaam" class="form-control" id="email" placeholder="Typ hier de naam die je wilt opgeven...">
                        <span class="error"><?= isset($errors['reserveringsnaam']) ? $errors['reserveringsnaam'] : ''; ?></span>
                    </div>
                    <div class="col-6">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Typ hier uw e-mailadres...">
                        <span class="error"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="telefoonnummer">Telefoonnummer:</label>
                        <input type="text" name="telefoonnummer" class="form-control" id="email" placeholder="Vul hier uw telefoonnummer in...">
                        <span class="error"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : ''; ?></span>
                    </div>
                    <div class="col-6">
                        <input id="reserve" type="submit" name="submit" value="Reservering toevoegen"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="reserveringen.php" class="back"><i class="fa fa-angle-left" aria-hidden="true"></i> Terug naar reserverings overzicht</a>
                    </div>
                </div>
            </form>

        </div><!-- End wrapper -->

    </div><!-- END container -->
</section><!-- END create -->

</body>
</html>