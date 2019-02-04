<?php

namespace jeremie;

class Path{

    // Titre du template (balise title dynamique, voir contructeur de la classe)
    private $title;

    // Les attributs suivant servent au style
    private $style_bootstrap = "css/bootstrap.min.css";
    private $fontawesome_cdn = 'https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous';
    private $monStyle = "css/app.css";

    // Les  attributs suivants servent aux liens de la nav bar du header
    private $linkHome = "index.php";
    private $linkRegister = "index.php?espace_membre=register";
    private $linkLogin = "index.php?espace_membre=login";
    private $linkLogout = "index.php?espace_membre=logout";
    private $linkAccount = "index.php?espace_membre=account";

    // Les 3 attributs suivants servent au fonctionnement de bootstrap
    private $jsJquery = "js/jquery.min.js";
    private $jsPopper = "js/popper.min.js";
    private $jsBootstrap = "js/bootstrap.min.js";


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
        return $this->monStyle;
    }

    public function getLinkHome(){
        return $this->linkHome;
    }

    public function getLinkRegister(){
        return $this->linkRegister;
    }

    public function getLinkLogin(){
        return $this->linkLogin;
    }

    public function getLinkLogout(){
        return $this->linkLogout;
    }

    public function getLinkAccount(){
        return $this->linkAccount;
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

}
