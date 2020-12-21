<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
<?php
include ("include/header.php");
?>
<div class="contour">

    <h1>Inscrivez-vous</h1>

    <form class="form" method="post">
        <input type="text" id="name" name="user_name"  placeholder="Votre pseudo" />
        <input type="email" id="mail" name="user_email"  placeholder="Votre email" />
        <input type="password" id="password" name="user_password"  placeholder="Mot de passe" />
        <input type="submit" id="button" value="M'inscrire"/>
    </form>

    <p>
        <?php

            if(isset($msg['error'])) echo $msg['error'];

        ?>
    </p>

</div>

<?php
include ("include/footer.php");
?>

</body>
</html>
