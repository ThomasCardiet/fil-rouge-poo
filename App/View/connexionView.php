<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Connexion</title>
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
<?php
include ("include/header.php");
?>

<main>

    <h1>Connectez-vous</h1>

    <form class="form" method="post">
        <input type="text" id="name" name="user_name"  placeholder="Votre pseudo" /><br>
        <input type="password" id="password" name="user_password"  placeholder="Mot de passe" /><br>
        <input type="submit" id="button" value="Me connecter"/>
    </form>

    <p class="error_msg">
        <?php

        if(isset($msg['error'])) echo $msg['error'];

        ?>
    </p>

</main>

    <?php
    include ("include/footer.php");
    ?>

</body>
</html>
