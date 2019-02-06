<!-- HEADER DE L'ENSEMBLE DES PAGES DE L'ESPACE MEMBRES -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- TITRE DYNAMYQUE -->
        <!-- $path est un objet de la classe Path.php, instancié dans le controller  -->
        <title>
            <?= $path->getTitle() ?> 
        </title>

        <!-- STYLES DU SITE (chemin dynamique)-->
        <!-- Style Bootstrap   $style_bootstrap  -->
        <link rel="stylesheet" href="<?= $path->getBootstrap() ?>">
        <!-- Fontawesome en cdn -->
        <link rel="stylesheet" href="<?= $path->getFontawesome_cdn() ?>">
        <!-- Mon style Css-->
        <link rel="stylesheet" href="<?= $path->getMonStyle() ?>">

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
                            <a class="nav-link" href="<?= $path->getHomeLink() ?>">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <!--<a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>-->
                            <a class="nav-link" href="<?= $path->getBlogLink() ?>">Blog</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- Si un utilisateur est connecté alors... -->
                        <?php if(isset($_SESSION['infoUser'])): ?>
                            <li class="nav-item">
                                <a href="<?= $path->getLogoutLink() ?>" class="nav-link bg-secondary my-2">
                                    Déconnexion
                                </a> 
                            </li>
                            <!-- Avatar et Nom de l'utilisateur -->
                            <li class="nav-item">
                                <!-- Lien vers la page de compte utilisateur -->
                                <a href="<?= $path->getAccountLink() ?>" class="nav-link bg-success my-1 ">
                                    <img src="<?= $_SESSION['infoUser']->avatar ?>" class="avatar-mini" alt="avatar">
                                    <?= $_SESSION['infoUser']->username ?>
                                </a>  
                            </li>
                        <!-- sinon si l'utilisateur n'est pas connecté alors... -->
                        <?php else: ?>
                            <li class="nav-item">
                                    <!--<a href="index.php?espace_membre=register" class="nav-link">Inscription</a>-->
                                <a href="<?= $path->getRegisterLink() ?>" class="nav-link">Inscription</a>
                            </li>
                            <li class="nav-item">
                                    <!--<a href="index.php?espace_membre=connect" class="nav-link">Connexion</a> -->
                                <a href="<?= $path->getLoginLink() ?>" class="nav-link">Connexion</a> 
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            
        </header>

        <!-- Debug session utilisateur (affichage) -->
        <?php 
            /*
            if(isset($_SESSION)){
                var_dump($_SESSION);
            }
            if(isset($_SESSION['flash'])){
                var_dump($_SESSION['flash']);
            }
            if(isset($_SESSION['infoUser'])){
                var_dump($_SESSION['infoUser']);
            }
            */
        ?>

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
                <p>Copyright Espace_Membres !</p>
            </footer>

        
        <!-- Les 3 scripts suivants servent au fonctionnement de bootstrap (chemin dynamique)-->
        <script src="<?= $path->getJsJquery() ?>"></script>
        <script src="<?= $path->getJsPopper() ?>"></script>
        <script src="<?= $path->getJsBootstrap() ?>"></script>
        <script src="<?= $path->getCustomJs() ?>"></script>
        


    </body>

</html>