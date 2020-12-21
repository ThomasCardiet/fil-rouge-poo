<?php
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crée ton sondage</title>
    <link rel="stylesheet" href="css/creaSondage.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>

<?php
include ("include/header.php");
?>

<main>

    <section class="poll_create">

        <h1>Créer un sondage</h1>

        <form class="form" method="post">
            <label for="titre" >Titre:</label>
            <input type="text" id="titre" name="poll_title"/>
            <label for="response_1" >Réponse 1:</label>
            <input type="text" id="response_1" name="poll_response_1"/>
            <label for="response_2" >Réponse 2:</label>
            <input type="text" id="response_2" name="poll_response_2"/>
            <label for="icon" >Lien de l'icon</label>
            <input type="text" id="icon" name="poll_icon" placeholder="https://www.exemple.fr/image.jpg"/>

            <input type="submit" id="button" value="Créer le sondage" name="poll_submit"/>
        </form>
    </section>

    <section class="polls_list">
        <?php foreach($my_polls as $poll) { ?>

            <div class="line-polls">
                <h2><?=$poll['title']?></h2>
                <a href="<?=$this->getPath('sondage_result', ['id' => $poll[0]])?>">Voir les résultats</a>
            </div>

        <?php } ?>
    </section>

</main>

<?php
include ("include/footer.php");
?>

</body>
</html>
