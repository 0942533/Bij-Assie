<?php
// Require database in this file
require_once 'includes/connection.php';

// Check if form is posted
if (isset($_POST['submit'])) {
    // Get form data
    $workshops = mysqli_escape_string($con, $_POST['soort_workshop']);
    $numberPersons = mysqli_escape_string($con, $_POST['aantal_personen']);
    $date = mysqli_escape_string($con, $_POST['datum']);
    $time = mysqli_escape_string($con, $_POST['tijdstip']);
    $specialRequests = mysqli_escape_string($con, $_POST['speciale_verzoeken']);
    $reservationName = mysqli_escape_string($con, $_POST['reserveringsnaam']);
    $emailClient = mysqli_escape_string($con, $_POST ['email']);
    $phonenumber = mysqli_escape_string($con, $_POST ['telefoonnummer']);

    $errors = [];
    if (empty($date)) {
        $errors['datum'] = 'Kies een datum';
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $reservationName)) {
        $errors['reserveringsnaam'] = "Alleen letters en spaties zijn toegestaan";
    }
    if (empty($reservationName)) {
        $errors['reserveringsnaam'] = 'Vul een reserveringsnaam in';
    }
    if (!filter_var($emailClient, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Het ingevulde e-mailadres is onjuist';
    }
    if (empty($emailClient)) {
        $errors['email'] = 'Vul een e-mailadres in';
    }
    if (empty($phonenumber)) {
        $errors['telefoonnummer'] = 'Vul een telefoonnummer in';
    }

    // If there are no errors, data can be inserted into the database
    if (empty($errors)) {
        $query = "INSERT INTO informatie (soort_workshop, aantal_personen,datum, tijdstip, speciale_verzoeken, reserveringsnaam, email, telefoonnummer) VALUES ('$workshops','$numberPersons','$date','$time','$specialRequests','$reservationName','$emailClient','$phonenumber')";
        $result = mysqli_query($con, $query);

        $errors = [];

        if ($query) {
            header("Location: index.php");
            exit;
        }
    }
}

// Check if form is posted
if (isset($_POST["contactSubmit"])) {
    $thankyou = "";

    //Get Form Data
    $name = mysqli_escape_string($con, $_POST['naam']);
    $emailSec = mysqli_escape_string($con, $_POST['emailSec']);
    $subjectContactform = mysqli_escape_string($con, $_POST['onderwerp']);
    $messageContactform = mysqli_escape_string($con, $_POST['bericht']);

    $errormessage = [];
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errormessage['naam'] = "Alleen letters en spaties zijn toegestaan";
    }
    if (empty($name)) {
        $errormessage['naam'] = 'Vul je naam in';
    }
    if (!filter_var($emailSec, FILTER_VALIDATE_EMAIL)) {
        $errormessage['emailSec'] = 'Het ingevulde e-mailadres is onjuist';
    }
    if (empty($emailSec)) {
        $errormessage['emailSec'] = 'Vul je e-mailadres in';
    }
    if (empty($subjectContactform)) {
        $errormessage['onderwerp'] = 'Vul een onderwerp in';
    }
    if (empty($messageContactform)) {
        $errormessage['bericht'] = 'Vul een bericht in';
    }

    if (empty($errormessage)) {
        $to = '0942533@hr.nl';
        $subject = 'Contact Form Submit';
        $message = "Naam: " . $name . "\n" . "E-mail: " . $emailSec . "\n" . "Onderwerp: " . $subjectContactform . "\n" . "Bericht: " . $messageContactform;
        $headers = "From: " . $emailSec;

        if (mail($to, $subject, $message, $headers)) {
            $thankyou = "Hallo " . $name . ", bedankt voor het verzenden van je bericht. Wij zullen zo snel mogelijk contact met je opnemen";
        } else {
            echo "Sorry, er is iets mis gegaan bij het verzenden van uw bericht. Probeer het opnieuw.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bij-Assie</title>

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="js/scrolling-nav.js" rel="stylesheet">
</head>

<body>
<section id="home">
    <div class="container">
        <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#our-store">Onze winkel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#workshops">Workshops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#reservation">Reserveren</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row">
            <div class="col-lg-12">
                <img id="logo-home" src="img/logo-bij-assie_wit-6cmx6cm.svg">
            </div>
        </div><!-- END row -->
    </div><!-- END container -->
</section><!-- END home-->

<section id="our-store">
    <div class="container">
        <h1 class="white">Onze winkel</h1>

        <div class="row">
            <div class="col-lg-12">
                <p id="intro">Bij Assie is een vintage winkel in een huiselijke sfeer, waar je een vers gezet bakje koffie of thee kunt drinken met huisgebakken taart. Daarnaast verkoopt Bij Assie de meest mooie vintage en industriële meubelen. Alles wat je ziet Bij Assie is te koop.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <img src="img/onze-winkel-01.png">
                <h4>Losse koffie en thee</h4>
                <p>In de winkel verkopen we verschillende soorten koffie en thee. De koffie is op juiste maling voor u gemalen. En ook voor losse thee bent u op het goede adres.</p>
            </div>
            <div class="col-lg-4">
                <img src="img/onze-winkel-02.png">
                <h4>Chocolade, cake/taart</h4>
                <p>De chocolade die wij verkopen is een fairtrade product. Daarnaast wordt er bij de thee en koffie huisgebakken taart geserveerd.</p>
            </div>
            <div class="col-lg-4">
                <img src="img/onze-winkel-03.png">
                <h4>Meubels</h4>
                <p>Samen met een aantal leveranciers presenteren we echte industriële en vintage meubelen en lampen. Deze spullen komen uit Frankrijk en Oostblok landen, opgeknapt en klaargemaakt voor in jouw woonkamer of bedrijf.</p>
            </div>
        </div>

        <div class="row" id="row2">
            <div class="col-lg-4">
                <img src="img/onze-winkel-04.png">
                <h4>Decoratie</h4>
                <p>Vind je favoriete items en cadeautjes in vintage style.</p>
            </div>
            <div class="col-lg-4">
                <img src="img/onze-winkel-05.png">
                <h4>Cadeaubon</h4>
                <p>In onze winkel zijn cadeaubonnen te koop vanaf €5,-. </p>
            </div>
            <div class="col-lg-4">
                <img src="img/onze-winkel-06.png">
                <h4>Workshop</h4>
                <p>Twee keer in de maand kun je je inschrijven voor koffie en thee workshops.</p>
            </div>
            <img src="img/onze-winkel.png">
        </div>
    </div><!-- END container -->
</section><!-- END our-store -->

<section id="workshops">
    <div class="container">
        <h1>Koffie en thee workshops</h1>

        <div class="row">
            <div class="col-lg-12">
                <p class="intro-workshop">Zin in ouderwetse gezelligheid? Dan ben je bij ons aan het juiste adres! Bij Assie organiseert koffie en thee workshops in de vintage winkel aan de Weerd 18 in Alblasserdam.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4 class="h4-blue">Wat houdt de workshop in?</h4>
                <p class="p-blue">Na ontvangst met wat te drinken en lekkere hapjes volgt een korte introductie over koffie of thee. (Het is maar net voor welke workshop je hebt gekozen) Hier wordt verteld waar het product vandaan komt en hoe het wordt verwerkt tot eindproduct. Vervolgens wordt er een thee of koffie proeverij gehouden. Hier kun je zelf je eigen koffie of thee smaak samenstellen en deze vervolgens ook zelf opdrinken. Na de workshop krijgt elke deelnemer een proefpakketje mee met verschillende koffie of thee smaken.</p>
            </div>
            <div class="col-lg-6">
                <h4 class="h4-blue">Betaalwijze</h4>
                <p class="p-blue">Zonder tegenbericht geldt de reservering 8 dagen. Een deel van het bedrag dient binnen deze 8 dagen overgemaakt te worden op ons bankrekeningnummer IBAN NL30 RABO 0001238910. Als het bedrag niet binnen 8 dagen betaald is, vervalt de reservering. Bij annulering voor de workshop wordt het volledige bedrag geretourneerd. Na deze twee weken moet het gehele bedrag alsnog worden betaald.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4 class="h4-blue">Kosten</h4>
                <p class="p-blue">De kosten voor de thee workshop bedragen €40,- per persoon. De kosten voor de koffie workshop bedragen €45,- per persoon.</p>
            </div>
            <div class="col-lg-6">
                <h4 class="h4-blue">Dagen en tijden</h4>
                <p class="p-blue">De workshops zullen 2 keer per maand plaatsvinden. In de even weken op woensdag avond van 19:30 – 21:30u.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4 class="h4-blue">Aantal deelnemers</h4>
                <p class="p-blue">Aan de koffie of thee workshop kunnen maximaal 20 mensen deelnemen. </p>
            </div>
            <div class="col-lg-6">
                <h4 class="h4-blue">Annulering</h4>
                <p class="p-blue">Bij onvoldoende deelnemers kan Bij Assie de workshop annuleren. Dit wordt uiterlijk 14 dagen van te voren doorgegeven</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3>Lijkt het je leuk om aan één van onze workshops deel te nemen? <a href="#reservation" id="quest_reservation">Reserveer dan nu je plekje!</a></h3>
            </div>
        </div>
    </div>
</section><!-- END section workshop -->

<section id="workshop-pics">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <img src="img/workshops-01.png">
            </div>
            <div class="col-lg-4">
                <img src="img/workshops-02.png">
            </div>
            <div class="col-lg-4">
                <img src="img/workshops-03.png">
            </div>
        </div>
    </div>
</section><!-- END section workshop-pics -->

<section id="reservation">
    <div class="container">
        <h1>Reserveer je workshop</h1>
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
                    <input type="date" name="datum" value="<?php if(isset($datum)){echo $datum;}?>"/>
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

            <div class="row" id="special">
                <div class="col-12">
                    <label for="speciale-verzoeken">Speciale verzoeken:</label>
                    <textarea name="speciale_verzoeken" class="form-control" rows="5" id="comment" placeholder="Denk aan dieetrestricties, allergieën of andere zaken die we zouden moeten weten, of is bijvoorbeeld iemand jarig?"></textarea>
                </div><!-- End col-12 -->
            </div><!-- End row special-->

            <div class="row">
                <div class="col-6">
                    <label for="reserveringsnaam">Reserveringsnaam:</label>
                    <input type="text" name="reserveringsnaam" class="form-control" id="email" value="<?php if(isset($reserveringsnaam)){echo $reserveringsnaam;}?>" placeholder="Typ hier de naam die je wilt opgeven...">
                    <span class="error"><?= isset($errors['reserveringsnaam']) ? $errors['reserveringsnaam'] : ''; ?></span>
                </div><!-- End col-6 -->
                <div class="col-6">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?php if(isset($emailClient)){echo $emailClient;}?>" placeholder="Typ hier uw e-mailadres...">
                    <span class="error"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
                </div><!-- End col-6 -->
            </div><!-- End row -->

            <div class="row">
                <div class="col-6">
                    <label for="telefoonnummer">Telefoonnummer:</label>
                    <input type="tel" name="telefoonnummer" class="form-control" id="email" value="<?php if(isset($telefoonnummer)){echo $telefoonnummer;}?>" placeholder="Vul hier uw telefoonnummer in...">
                    <span class="error"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : ''; ?></span>
                </div><!-- End col-6 -->
                <div class="col-6">
                    <input id="reserve" type="submit" name="submit" value="Reserveren"/>
                </div><!-- End col-6 -->
            </div><!-- End row -->
            <div class="row">
                <div class="col-12">
                    <h3>*Het e-mailadres en het telefoonnummer gebruiken we alleen bij annulering van de workshop</h3>
                </div><!-- End col-12 -->
            </div><!-- End row -->
        </form>
    </div><!-- End container -->
</section><!-- End section reservation -->

<section id="contact">
    <div class="container">
        <h1 class="white-contact">Contact</h1>
        <div class="row">
            <div class="col-lg-12">
                <p id="intro">Heb je vragen of opmerkingen? Neem gerust contact op met mij door onderstaand formulier in te vullen of bel 078-1234567</p>
            </div><!-- End col-lg-12 -->
        </div><!-- End row -->

        <form action="" method="post">
            <div class="row">
                <div class='message'><?= "$thankyou" ?></div>
                <div class="col-lg-6">
                    <input type="text" name="naam" class="form-control" id="email" value="<?php if(isset($naam)){echo $naam;}?>" placeholder="Naam*">
                    <span class="error"><?= isset($errormessage['naam']) ? $errormessage ['naam'] : ''; ?></span>
                </div><!-- End col-lg-6 -->
                <div class="col-lg-6">
                    <input type="text" name="emailSec" class="form-control" id="email" value="<?php if(isset($emailSec)){echo $emailSec;}?>" placeholder="E-mail*">
                    <span class="error"><?= isset($errormessage['emailSec']) ? $errormessage ['emailSec'] : ''; ?></span>
                </div><!-- End col-lg-6 -->
            </div><!-- End row -->

            <div class="row">
                <div class="col-lg-12">
                    <input type="text" name="onderwerp" class="form-control" id="email" value="<?php if(isset($onderwerp)){echo $onderwerp;}?>" placeholder="Onderwerp*">
                    <span class="error"><?= isset($errormessage['onderwerp']) ? $errormessage ['onderwerp'] : ''; ?></span>
                </div>
            </div><!-- End row -->
            <div class="row">
                <div class="col-lg-12">
                    <input type="text" name="bericht" class="form-control" id="email" value="<?php if(isset($bericht)){echo $bericht;}?>" placeholder="Bericht*">
                    <span class="error"><?= isset($errormessage['bericht']) ? $errormessage ['bericht'] : ''; ?></span>
                </div>
            </div><!-- End row -->

            <div class="row">
                <div class="col-lg-6">
                    <p id="intro">De velden met een * zijn verplichte velden</p>
                </div>
                <div class="col-lg-6">
                    <input id="reserve" name="contactSubmit" type="submit" value="Verzenden"/>
                </div>
            </div><!-- End row -->
        </form>
    </div><!-- End container -->
</section><!-- End section contact -->

<!-- Bootstrap core JavaScript -->
<script src="lib/jquery/jquery.min.js"></script>

<!-- Plugin JavaScript -->
<script src="lib/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="js/scrolling-nav.js"></script>
</body>
</html>