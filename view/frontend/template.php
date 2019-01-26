<!-- HEADER DE L'ENSEMBLE DES PAGES DE L'ESPACE MEMBRES -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- TITRE DYNAMYQUE -->
        <title>
            <?= $title ?> 
        </title>

        <!-- STYLES DU SITE (chemin dynamique)-->
        <!-- Style Bootstrap -->
        <link rel="stylesheet" href="<?= $style_bootstrap ?>">
        <!-- Fontawesome en cdn -->
        <link rel="stylesheet" href="<?= $fontawesome_cdn ?>">
        <!-- Mon style Css-->
        <link rel="stylesheet" href="<?= $monStyle ?>">

    </head>

    <body>

        <!-- HEADER DU SITE -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Mon Site</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <!--<a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>-->
                            <a class="nav-link" href="<?= $linkHome ?>">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- Si un utilisateur est connecté alors... -->
                        <?php if(isset($_SESSION['infoUser'])): ?>
                            <li class="nav-item">
                                <!--<a href="index.php?espace_membre=logout" class="nav-link">Déconnexion</a> -->
                                <a href="<?= $linkLogout ?>" class="nav-link">Déconnexion</a> 
                            </li>
                        <!-- sinon si l'utilisateur n'est pas connecté alors... -->
                        <?php else: ?>
                            <li class="nav-item">
                                 <!--<a href="index.php?espace_membre=register" class="nav-link">Inscription</a>-->
                                <a href="<?= $linkRegister ?>" class="nav-link">Inscription</a>
                            </li>
                            <li class="nav-item">
                                 <!--<a href="index.php?espace_membre=connect" class="nav-link">Connexion</a> -->
                                <a href="<?= $linkLogin ?>" class="nav-link">Connexion</a> 
                            </li>
                            
                        <?php endif; ?>
                    </ul>

                </div>
            </nav>
        </header>

        <!-- Debug session utilisateur (affichage) -->
        <?php var_dump($_SESSION); ?>
        <?= var_dump($_SESSION['flash']); ?>

        <!-- CONTENU DU SITE -->
        <div class="container">

            <!-- MESSAGE FLASH -->
            <!-- Si il y a un message flash dans notre session alors... -->
            <?php if(isset($_SESSION['flash'])): ?>
                <!-- Pour chaque flash on récup la clé qu'on nomme $type (danger, success...) et en valeur le message nommé $message -->
                <?php foreach($_SESSION['flash'] as $type => $message): ?>
                    <!-- Création d'une div qui aura comme classe au final une classe bootstrap dynamique -->
                    <div class="alert alert-<?= $type; ?> mt-3">
                        <?= $message; ?>
                    </div>

                <?php endforeach; ?>

                <!-- On détruit l'index "flash" de la session (comme cela le message sera supprimé dès l'actualisation de la page) -->
                <?php unset($_SESSION['flash']); ?> 
            <?php endif; ?>


            <!-- CONTENU DYNAMIQUE résultat des ob_start() / ob_get_clean(); -->
            <?= $content ?>

        </div> <!-- Fin de div container -->


        <!-- FOOTER DE L'ENSEMBLE DES PAGES DE L'ESPACE MEMBRES -->
        <footer class="mt-5 bg-primary py-5 text-center">
            <p>Copyright Espace_Membres3 !</p>
        </footer>

        <!-- Les 3 scripts suivants servent au fonctionnement de bootstrap (chemin dynamique)-->
        <script src="<?= $JsJquery ?>"></script>
        <script src="<?= $JsPopper ?>"></script>
        <script src="<?= $JsBootstrap ?>"></script>

    </body>

</html>