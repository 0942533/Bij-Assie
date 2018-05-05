<?php
session_start();
if(!isset($_SESSION['email'])) {
    // redirect to login page
    header('Location: login.php');
    exit;
}

// Making connection with the database
require_once "includes/connection.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM informatie";
$result = mysqli_query($con, $query);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($con, "DELETE FROM informatie WHERE id=" . $id);

    if ($query) {
        header("Location: reserveringen.php");
    } else {
        echo "helaas niet gelukt";
    }
}
?>
<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<head>
    <title>Bij-Assie | reserveringen</title>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-reserveringen.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <style>
        .users {
            table-layout: fixed;
            width: 100%;
            white-space: nowrap;
        }
        .users td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Column widths are based on these cells */
        .row-nr{
            width: 3%;
        }
        .row-name {
            width: 12.5%;
        }
        .row-ap {
            width: 11%;
        }
        .row-datum {
            width: 8%;
        }
        .row-tijdstip {
            width:9.2%;
        }
        .row-svz {
            width:17%;
        }
        .row-rn {
            width:12%;
        }
        .row-email {
            width:12%;
        }
        .row-tel {
            width:11%;
        }
    </style>
</head>

<body>


<section id="reservation">
    <div class="container">
        <div class="logout">
            <a href="logout.php"><img src="img/logout-button.png" id="logout-button"/> Uitloggen</a>
        </div>
        <div id="wrapper">
            <h4>Reserveringen | Bij Assie</h4>
            <hr>
            <p>Hier kunt u de reserveringen beheren die bij u zijn gedaan.</p>
            <a href="create.php">
                <button type="button" class="btn btn-secondary btn-sm">+ Reservering toevoegen</button>
            </a><br/><br/>
            <table class="users">
                <thead>
                <tr>
                    <th class="row-nr">Nr.</th>
                    <th class="row-name">Soort workshop</th>
                    <th class="row-ap">Aantal personen</th>
                    <th class="row-datum">Datum</th>
                    <th class="row-tijdstip">Tijdstip</th>
                    <th class="row-svz">Speciale verzoeken</th>
                    <th class="row-rn">Reserveringsnaam</th>
                    <th class="row-email">E-mail</th>
                    <th class="row-tel">Telefoonnummer</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= htmlentities($row["id"]); ?></td>
                            <td><?= htmlentities($row["soort_workshop"]); ?></td>
                            <td><?= htmlentities($row["aantal_personen"]); ?></td>
                            <td><?= htmlentities($row["datum"]); ?></td>
                            <td><?= htmlentities($row["tijdstip"]); ?></td>
                            <td><?= htmlentities($row["speciale_verzoeken"]); ?></td>
                            <td><?= htmlentities($row["reserveringsnaam"]); ?></td>
                            <td><?= htmlentities($row["email"]); ?></td>
                            <td><?= htmlentities($row["telefoonnummer"]); ?></td>
                            <td class="icons"><a href="edit.php?id=<?= htmlentities($row["id"]); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td><td class="icons"><a onclick="return confirm('Wilt u deze reservering verwijderen?')" href="reserveringen.php?id=<?= htmlentities($row["id"]); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div><!-- END wrapper-->

    </div><!-- END container-->
</section><!-- END reservation -->
</body>
</html>