<?php
/*
    Classe BlogPostManager
    Classe qui gère le fonctionnement des posts (billets)
*/

namespace jeremie;

// On charge est on appel l'autoloader (qui va charger les classes utilisées)
require_once 'class/Autoloader.php';
Autoloader::loadClass();

// On crée une nouvelle session
Session::getInstance();


$db = App::getDataBase(); // On récupère la bdd


class BlogPostManager extends Manager{

    /*
    private $db;

    function __construct()
    {
        $this->db = App::getDataBase(); // On récupère la bdd
    }
    */
    
    // Méthode qui renvoie la liste des billets (les 5 derniers)
    public function getPosts(){
        
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin%ss\') AS createdAt_fr, author_post 
                            FROM posts ORDER BY createdAt DESC LIMIT 0, 5');

        return $posts;
        
    }

    // Méthode qui récupère un post (billet) via son id
    public function getPost($postId){
        
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin%ss\') AS createdAt_fr, author_post 
                            FROM posts WHERE id = ?');
        
        $req->execute(array($postId)); //Le point d'interrogation de la requête sera remplacé par le contenu de la variable$_GET['billet']

        // Affichage de chaque billet, 'fetch' veut dire 'va chercher'.
        $post = $req->fetch();

        return $post;
    }

}
