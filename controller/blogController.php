<?php
/*
    FICHIER CONTROLLER qui contient les fonctions utiles au fichier index.php
    Fichier appelé par le routeur (index.php)
*/


// On déclare nos classes dans leurs namespace
use jeremie\Autoloader;
use jeremie\Path;
use jeremie\Session;
use jeremie\App;
use jeremie\Validator;
use jeremie\NumberManager;

use jeremie\BlogPostManager;
use jeremie\BlogCommentManager;

// On charge et on appelle l'autoloader (qui va charger les classes utilisées)
require_once 'class/Autoloader.php';
Autoloader::loadClass();


// On crée une nouvelle session
//Session::getInstance();


// fonction qui renvoie la liste des posts (billets) et qui affiche cette même liste
function listPosts(){
    
    // A la création des objets on appel en préfixe le namespace (défini dans le fichier de la classe instanciée)
    $postManager = new BlogPostManager();

    //$postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // getPosts() est une requête qui récupère les 5 derniers posts

    // la classe Path.php contient tous les chemins du template de base
    $path = new Path('Page de la liste des posts'); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require 'view/frontend/blog/listPosts.php';
     
}

// Fonction qui récupère un post via son id ($post), et les commentaires qui lui sont associés ($comments), puis affiche le post et ses commentaires associés
function post(){
    
    // On créé deux objets (on pense bien aussi à les créer dans le même namespace de leur classes)
    $postManager = new BlogPostManager();
    $commentManager = new BlogCommentManager();

    $post = $postManager->getPost($_GET['id']); // On récupère le post qui posséde l'id de l'url (soit le post sélectionné dans le liste des posts)
    $comments = $commentManager->getComments($_GET['id']); // On récupère les commentaires associés à l'id du post

    // la classe Path.php contient tous les chemins du template de base
    $path = new Path('Page du post'); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontEnd/blog/post.php');
}

// Fonction qui récupère le commentaire à modifier, affiche le formulaire de modification
function post2(){
    
    // On créé deux objets (on pense bien aussi à les créer dans le même namespace de leur classes)
    $postManager = new BlogPostManager();
    $commentManager = new BlogCommentManager();

    $post = $postManager->getPost($_GET['id']); // On récupère le post qui posséde l'id de l'url (soit le post sélectionné dans le liste des posts)
    //$comments2 = $commentManager2->getComments($_GET['id']); // On récupère les commentaires associés à l'id du post
    $comments = $commentManager->getComment($_GET['id']); // On récupère les commentaires associés à l'id du post

    // la classe Path.php contient tous les chemins du template de base
    $path = new Path("Page d'édition du post"); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontEnd/blog/editComment.php');
}

// Fonction qui ajoute le commentaire à la bdd
function addComment($postId, $author, $comment){
    
    // A la création des objets on appel en préfixe le namespace (définit dans le fichier de la classe instanciée)
    $commentManager = new BlogCommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    
    // Contrôle si le commentaire à bien été ajouté à la bdd
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function edit($postId, $newContentComment){
    
    $commentManager = new BlogCommentManager();
    $commentManager->editComment($postId, $newContentComment);
    
    $affectedLines = $commentManager->editComment($postId, $newContentComment);
    
    // Contrôle si le commentaire à bien été ajouté à la bdd
    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le nouveau commentaire !');
    }
    else {
        echo 'Le commentaire à bien été modifié !!';
    }
}