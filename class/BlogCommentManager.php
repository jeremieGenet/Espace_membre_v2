<?php
/*
    Classe CommentManager
    Classe qui gère le fonctionnement des commentaires
*/

namespace jeremie;

// On charge est on appel l'autoloader (qui va charger les classes utilisées)
require_once 'class/Autoloader.php';
Autoloader::loadClass();

// On crée une nouvelle session
Session::getInstance();


$db = App::getDataBase(); // On récupère la bdd


class BlogCommentManager extends Manager{

    // Fonction qui récupére les commentaires associés à un ID de post
    public function getComments($postId){

        $db = $this->dbConnect();
        
        // Récupération des commentaires
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        
        $comments->execute(array($postId)); 

        return $comments;
        
    }
    // Fonction qui récupère un commentaire via son id
    public function getComment($postId){
        $db = $this->dbConnect();
        // Récupération des commentaires
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        
        $comments->execute(array($postId)); 

        return $comments;
    }

    // Fonction qui insére dans la table "comments" le commentaire (paramètres: l'id du post, l'auteur, et le commentaire)
    public function postComment($postId, $author, $comment){
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    // Fonction qui modifie un le contenu d'un commentaire et sa date
    public function editComment($postId,$newContentComment){
        $db = $this->dbConnect();
        $datetime = date("d-m-Y à H:i:s");
        $req = $db->prepare('UPDATE comments SET 
        comment = ?, comment_date = NOW() WHERE id = ?');
        
        $req->execute(array(
            $newContentComment,
            $postId
        ));
        
        return $req;
    }
    
    
}
















