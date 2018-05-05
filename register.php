<?php
//Require database in this file
require_once "includes/connection.php";
//If form is posted, lets validate!
if (isset($_POST['submit']))
{
    //Retrieve values (email safe for query)
    $email      = mysqli_escape_string($con, $_POST['email']);
    $password   = mysqli_escape_string ($con, $_POST['password']);
    $errors = [];
    if(empty($email)) {
        $errors['email'] = 'Vul je e-mailadres in';
    }
    if(empty($password)) {
        $errors['password'] = 'Vul je wachtwoord in';
    }
    if(empty($errors)) {
        // The password field in de database must be at least 64 characters long, because of the hash
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO login (email, password)
                  VALUES ('$email', '$password')";
        $result = mysqli_query($con, $query)
        or die('Error: '.mysqli_error($con));
        header('Location: login.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bij Assie | registreren</title>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style.admin.css" rel="stylesheet">
    <style>
        body {
            background-image: url(img/reserveren-background-bij-assie.png) ;
            background-position: center center;
            background-repeat:  no-repeat;
            background-attachment: fixed;
            background-size:  cover;
            background-color: #999;
        }
    </style>
</head>
<body>

<section id="login">
    <form action="" method="post">
        <div id="img-logo">
            <img src="img/logo-bij-assie_wit-4.5cmx4.5cm.svg">
        </div>

        <input type="email" name="email" class="form-control" placeholder="E-mailadres" value="<?= (isset($email) ? $email : ''); ?>"/>
        <span class="error"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>


        <input type="password" name="password" class="form-control" placeholder="Wachtwoord"/>
        <span class="error"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Account toevoegen</button>
        <div id="register"><a href="login.php"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;Terug naar de login pagina</a></div>
    </form>
</section>


</body>
</html>