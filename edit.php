<?php
session_start();

if(!isset($_SESSION['email'])) {
    // redirect to login page
    header('Location: login.php');
    exit;
}
//Require database in this file & image helpers
require_once "includes/connection.php";

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $id = mysqli_escape_string($con, $_POST['id']);
    $workshops = mysqli_escape_string($con, $_POST['soort_workshop']);
    $numberPersons = mysqli_escape_string($con, $_POST['aantal_personen']);
    $date = mysqli_escape_string($con, $_POST['datum']);
    $time = mysqli_escape_string($con, $_POST['tijdstip']);
    $specialRequests = mysqli_escape_string($con, $_POST['speciale_verzoeken']);
    $reservationName = mysqli_escape_string($con, $_POST['reserveringsnaam']);
    $emailClient = mysqli_escape_string($con, $_POST ['email']);
    $phonenumber = mysqli_escape_string($con, $_POST ['telefoonnummer']);

    //Require the form validation handling
    require_once "includes/form-validation.php";
    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $reservering = [
        'soort_workshop'    => $workshops,
        'aantal_personen'      => $numberPersons,
        'datum'      => $date,
        'tijdstip'      => $time,
        'speciale_verzoeken'      => $specialRequests,
        'reserveringsnaam'      => $reservationName,
        'email'      => $emailClient,
        'telefoonnummer'      => $phonenumber,
    ];

    // If there are no errors, data can be inserted into the database
    if (empty($errors)) {
        $query = "UPDATE informatie
                  SET soort_workshop = '$workshops', aantal_personen = '$numberPersons', datum = '$date', tijdstip = '$time', speciale_verzoeken = '$specialRequests', reserveringsnaam = '$reservationName', email = '$emailClient', telefoonnummer = '$phonenumber'
                  WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            header('Location: reserveringen.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
    }
}

else if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $id = $_GET['id'];
    //Get the record from the database result
    $query = "SELECT * FROM informatie WHERE id = " . mysqli_escape_string($con, $id);
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) == 1)
    {
        $reservation = mysqli_fetch_assoc($result);
    }
    else {
        // redirect when db returns no result
        header('Location: reserveringen.php');
        exit;
    }
}

else {
    header('Location: reserveringen.php');
    exit;
}
//Close connection
mysqli_close($con);
?>

<!doctype html>
<html>
    <head>
        <title>Bij Assie | reservering aanpassen</title>
        <meta charset="utf-8"/>
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
                    <h4 class="create">Reservering aanpassen</h4>
                    <hr>
                    <p>Pas een reservering aan</p>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <label for="artist">Soort workshop:</label>
                                <input class="form-control" type="text" name="soort_workshop" value="<?= $reservation['soort_workshop'] ?>"/>
                                <span class="errors"><?= isset($errors['soort_workshop']) ? $errors['soort_workshop'] : '' ?></span>
                            </div><!-- End col-6 -->

                            <div class="col-6">
                                <label for="name">Aantal personen:</label>
                                <input class="form-control" type="text" name="aantal_personen" value="<?= $reservation['aantal_personen'] ?>"/>
                                <span class="errors"><?= isset($errors['aantal_personen']) ? $errors['aantal_personen'] : '' ?></span>
                            </div><!-- End col-6 -->
                        </div><!-- End row-->

                        <div class="row">
                            <div class="col-6">
                                <label for="date">Datum:</label>
                                <input class="form-control" type="text" name="datum" value="<?= $reservation ['datum'] ?>"/>
                                <span class="errors"><?= isset($errors['datum']) ? $errors['datum'] : '' ?></span>
                            </div><!-- End col-6 -->

                            <div class="col-6">
                                <label for="time">Tijdstip:</label>
                                <input class="form-control" type="text" name="tijdstip" value="<?= $reservation ['tijdstip'] ?>"/>
                                <span class="errors"><?= isset($errors['tijdstip']) ? $errors['tijdstip'] : '' ?></span>
                            </div><!-- End col-6 -->
                        </div><!-- End row-->

                        <div class="row">
                            <div class="col-12">
                                <label id="special" for="date">Speciale verzoeken:</label>
                                <input class="form-control" type="text" name="speciale_verzoeken" value="<?= $reservation['speciale_verzoeken'] ?>"/>
                                <span class="errors"></span>
                            </div><!-- End col-6 -->
                        </div><!-- End row-->

                        <div class="row">
                            <div class="col-6">
                                <label for="date">Reserveringsnaam:</label>
                                <input class="form-control" type="text" name="reserveringsnaam" value="<?= $reservation ['reserveringsnaam'] ?>"/>
                                <span class="errors"><?= isset($errors['reserveringsnaam']) ? $errors['reserveringsnaam'] : '' ?></span>
                            </div><!-- End col-6 -->

                            <div class="col-6">
                                <label for="time">Email:</label>
                                <input class="form-control" type="text" name="email" value="<?= $reservation ['email'] ?>"/>
                                <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                            </div><!-- End col-6 -->
                        </div><!-- End row-->

                        <div class="row">
                            <div class="col-6">
                                <label for="time">Telefoonnummer:</label>
                                <input class="form-control" type="text" name="telefoonnummer" value="<?= $reservation ['telefoonnummer'] ?>"/>
                                <span class="errors"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : '' ?></span>
                            </div>
                            <div class="col-6">
                                <input type="hidden" name="id" value="<?= $id; ?>"/><!-- id wordt anders niet onthouden daarom gebruik je type=hidden-->
                                <input type="submit" id="reserve" name="submit" value="Opslaan"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="reserveringen.php" class="back"><i class="fa fa-angle-left" aria-hidden="true"></i> Terug naar reserverings overzicht</a>
                            </div>
                        </div>
                    </form>
                </div><!-- END wrapper -->
            </div><!-- END container -->
        </section><!-- END section create -->
    </body>
</html>