<?php

namespace jeremie;

// Gère les différent chemins du Template Html de base
class Path{

    // Titre du template (balise title dynamique, voir contructeur de la classe)
    private $title;

    // Les attributs suivant servent au style
    private $style_bootstrap = "css/bootstrap.min.css";
    private $fontawesome_cdn = 'https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous';
    private $myStyle = "css/app.css";

    // Les  attributs suivants servent aux liens de la nav bar du header
    private $homeLink = "index.php";
    private $registerLink = "index.php?espace_membre=register";
    private $loginLink = "index.php?espace_membre=login";
    private $logoutLink = "index.php?espace_membre=logout";
    private $accountLink = "index.php?espace_membre=account";
    private $blogLink = "index.php?blog=listPosts";

    // Les attributs suivants servent au fonctionnement de bootstrap
    private $jsJquery = "js/jquery.min.js";
    private $jsPopper = "js/popper.min.js";
    private $jsBootstrap = "js/bootstrap.min.js";
    private $customJs = "js/custom.js";


    // Permet à l'instanciation de préciser le titre (le titre du template ici) 
    public function __construct($title)
    {
        $this->title = $title;
    }


    public function getTitle(){
        return $this->title;
    }

    public function getBootstrap(){
        return $this->style_bootstrap;
    }

    public function getFontawesome_cdn(){
        return $this->fontawesome_cdn;
    }

    public function getMonStyle(){
        return $this->myStyle;
    }

    public function getHomeLink(){
        return $this->homeLink;
    }

    public function getRegisterLink(){
        return $this->registerLink;
    }

    public function getblogLink(){
        return $this->blogLink;
    }

    public function getLoginLink(){
        return $this->loginLink;
    }

    public function getLogoutLink(){
        return $this->logoutLink;
    }

    public function getAccountLink(){
        return $this->accountLink;
    }

    public function getJsJquery(){
        return $this->jsJquery;
    }

    public function getJsPopper(){
        return $this->jsPopper;
    }

    public function getJsBootstrap(){
        return $this->jsBootstrap;
    }

    public function getCustomJs(){
        return $this->customJs;
    }

}
