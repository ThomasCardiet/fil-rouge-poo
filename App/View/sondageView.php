<?php
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sondage</title>
    <link rel="stylesheet" href="css/sondage.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
<?php
include ("include/header.php");
?>

<main>

    <h2 id="question" class="question"><?=$poll[0]['title']?></h2>

    <div class="responses">
        <form method="post">
            <div>
                <input required type="radio" class="radio" name="response" value="0"  id="response_1"/><label class="response"><?=$responses[0]?></label>
            </div><br>
            <div>
                <input required type="radio" class="radio" name="response" value="1" id="response_2"/><label class="response"><?=$responses[1]?></label>
            </div><br>

            <input type="submit" id="button" class="button" value="Confirmer" name="response_submit"/>
        </form>
    </div>

</main>

<?php
include ("include/footer.php");
?>

</body>
</html>
