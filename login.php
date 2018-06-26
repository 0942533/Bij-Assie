<?php
session_start();

require_once "includes/connection.php";

if (isset($_POST['submit'])){
    $email = mysqli_escape_string($con, $_POST['email']);
    $password  = $_POST['password']; // real_escape_string is not needed because of hash later.

    $errors = [];
    $message = "";

    if(empty($email)) {
        $errors['email'] = 'Vul je e-mailadres in';
    }
    if(empty($password)){
        $errors['password'] = 'Vul je wachtwoord in';
    }

    if(empty($errors)){
        $query = "SELECT * FROM login WHERE email = '$email'";

        $result = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($result);

        $errors = [];
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                //Redirect to secure.php & exit script
                header("Location: reserveringen.php");
                exit;
            } else {
                $message = 'Het ingevoerde e-mailadres of wachtwoord is onjuist. Probeer het opnieuw.';
            }
        }else
        {
            $message = 'Het ingevoerde e-mailadres of wachtwoord is onjuist. Probeer het opnieuw.';
        }
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Bij Assie | Login</title>
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
            <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
                <div id="img-logo">
                    <img src="img/logo-bij-assie_wit-4.5cmx4.5cm.svg">
                </div>

                <span class="error"><?= isset($message) ? $message : ''; ?></span>

                <input type="email" name="email" class="form-control" value="<?= (isset($email) ? $email : ''); ?>" placeholder="E-mailadres"/>
                <span class="error"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>

                <input type="password" name="password" class="form-control has-error" placeholder="Wachtwoord"/>
                <span class="error"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Inloggen</button>
        <!--        <div id="register"><a href="register.php"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Nieuw account aanmaken</a></div>-->
            </form>
        </section>
    </body>
</html>
