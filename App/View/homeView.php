<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet"
          href="css/home.css">
    <link rel="icon" href="img/logo.png">

</head>
<body>
 <?php

 include ("include/header.php");
 ?>


 <main>

     <?php

     if(!$this->auth->islogged()) {
        echo '<p class="connexion_msg">Vous devez vous connecter pour voir les sondages!</p>';
     } else {

         $index = 0;
         foreach($values['polls'] as $poll){
             $index++;
             ?>

             <div class="sondage">
                 <div class="sondage_icon">
                     <img src="<?=$poll['icon']?>" alt="#">
                 </div>
                 <div class="sondage_desc">
                     <h2><?=$index?># <?=$poll['title']?></h2>
                     <div>
                         <?php if($model->hasVoted($poll[0], $_SESSION['id'])){ ?>
                            <a href="<?=$this->getPath('sondage_result', ['id' => $poll[0]])?>">Voir les résultats (répondu) <i class="fas fa-arrow-right"></i></a>
                        <?php }else { ?>
                             <a href="<?=$this->getPath('poll_responses', ['id' => $poll[0]])?>">Répondre à ce sondage <i class="fas fa-arrow-right"></i></a>
                        <?php } ?>
                     </div>
                 </div>
             </div>

             <?php
         }
     }

     ?>

 </main>

 <?php
 include ("include/footer.php");
 ?>

</body>
</html>
