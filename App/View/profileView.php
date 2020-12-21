

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link rel="stylesheet" href="css/profil.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
<?php
include ("include/header.php");
?>

<main>
        <h1>Mon profil</h1>

        <form method="post">
            <p class="titre_infos">Mes informations :</p>
            <div class="line">
                <p>Pseudo: <span class="pseudo"><?=$user['username']?></span></p>
                <input class="change" type="text" name="change_username_value" placeholder="Pseudo"/>
                <button type="submit" name="change_username_submit">Changer</button>
            </div>

            <div class="line">
                <p>Mail: <span class="mail"><?=$user['email']?></span></p>
                <input class="change" type="email" name="change_email_value" placeholder="Email"/>
                <button type="submit" name="change_email_submit">Changer</button>
            </div>

            <div class="line">
                <p>Password: <span class="mail">*********</span></p>
                <input class="change" type="password" name="change_password_value" placeholder="Mot de passe"/>
                <button type="submit" name="change_password_submit">Changer</button>
            </div>
        </form>

    <p class="warn_msg">
        <?php

        if(isset($msg)) echo $msg;

        ?>
    </p>

</main>

<?php
include ("include/footer.php");
?>

</body>
</html>
