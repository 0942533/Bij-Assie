<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($soort_workshop == "") {
    $errors['soort_workshop'] = 'Het veld soort workshop mag niet leegblijven';
}
if ($aantal_personen == "") {
    $errors['aantal_personen'] = 'Het veld aantal personen mag niet leegblijven';
}
if ($datum == "") {
    $errors['datum'] = 'Het veld aantal datum mag niet leegblijven';
}
if ($tijdstip == "") {
    $errors['tijdstip'] = 'Het veld tijdstip mag niet leegblijven';
}
if ($reserveringsnaam == "") {
    $errors['reserveringsnaam'] = 'Het veld reserveringsnaam personen mag niet leegblijven';
}
if ($email == "") {
    $errors['email'] = 'Het veld email personen mag niet leegblijven';
}
if ($telefoonnummer == "") {
    $errors['telefoonnummer'] = 'Het veld aantal telefoonnummer mag niet leegblijven';
}
?>