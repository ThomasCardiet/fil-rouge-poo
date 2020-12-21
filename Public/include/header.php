<head>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/dc883addae.js" crossorigin="anonymous"></script>
</head>
<header>
    <div class="header_top">
        <div class="burger_icons">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times"></i>
        </div>

        <div class="head_title">
            <img src="img/logo.png" alt="#">
            <h1>SondageBerry</h1>
        </div>
    </div>

    <nav class="header_links">

        <hr>
        <a href="?page=home"><i class="fas fa-home"></i> Accueil</a>
        <hr>
        <?php if($this->auth->islogged()){
            echo '<a href="?page=logout">Se déconnecter</a>';
            echo '<hr>';
            echo '<a href="?page=profil">Mon profil</a>';
            if($this->auth->isAdmin()) {
                echo '<hr>';
                echo '<a href="?page=admin">Panel Admin</a>';
            }
        }else {
            echo '<a href="?page=login">Se Connecter</a>';
            echo '<hr>';
            echo '<a href="?page=register">S\'enregistrer</a>';
        }?>
        <hr>
    </nav>
</header>
