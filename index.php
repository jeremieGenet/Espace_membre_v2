<?php
// INDICATION DE CHEMIN BRACKET : http://http://localhost/Espace_membre_v2/index.php

/*
    ROUTEUR qui va diriger vers la page voulue (en fonction des lien de redirection des différentes pages)
    Bdd utilisée : test, et Tables utilisée : posts et comments
*/

require('controller/espaceMembreController.php'); // Contient les fonctions utilisées pour l'espace membre
require('controller/blogController.php'); // Contient les fonctions utilisées pour le blog


if(isset($_GET['espace_membre'])){
    
    // GESTION DE L'ENREGISTREMENT UTILISATEUR (formulaire d'enregistrement)
    if($_GET['espace_membre'] == 'register'){
        
        // Si le  formulaire n'est pas vide alors...
        if(!empty($_POST)){
            registerUser();
        }
        displayRegister(); // Affiche la page d'enregistrement
    
    // GESTION DE LA CONNEXION UTILISATEUR (formulaire de connexion)
    }elseif($_GET['espace_membre'] == 'login'){

        if(!empty($_POST)){
            loginUser();
        }
        loginUser(); // Envoie à la page pour se connecter

    // GESTION DE LA CONFIRMATION DE CREATION DE COMPTE UTILISATEUR (envoie d'un mail avec lien pour créer son compte)
    }elseif($_GET['espace_membre'] == 'confirm'){

        if(isset($_GET['id']) && isset($_GET['token'])){
            confirmUser();
        }
        // lien reçu par l'utilisateur (après son enregistrement) pour tester la confirmation de compte (id et confirmation_token récup dans la bdd de l'utilisateur)
        // POUR TESTER :
        // http://localhost/Espace_membre_v2/index.php?espace_membre=confirm&id=95&token=UoVML8iqtOnlBdSzpwcny1q2xNFOWObWBdp5lnx7ULAd0ERH1MZituOHp3Pn
        
    // GESTION DU COMPTE DE L'UTILISATEUR  (formulaire de changement de mot de passe et d'ajout/modification d'avatar)
    }elseif($_GET['espace_membre'] == 'account'){

        // Si le formulaire n'est pas vide alors...
        if(!empty($_POST)){

            // Si on est dans le formulaire de modification de password alors...
            if(isset($_POST['password'])){

                // Traitement du changement de mot de passe
                accountPasswordUser();

            // Sinon on est dans le formulaire avatar alors...
            }elseif(isset($_POST['avatar'])){

                // Traitement de l'avatar
                accountAvatarUser();
                
            }
            //accountPasswordUser();
        }
        displayAccount();

    // GESTION DE LA REINITIALISATION DE SON MOT DE PASSE (lien 'mot de passe oublié' dans le formulaire de connexion) 
    // (envoie d'un mail avec lien qui dirige sur un formulaire de réinitialisation de son mot de passe)
    }elseif($_GET['espace_membre'] == 'reset'){

        // Si il y a les variables 'id' et 'token_reset' alors...
        if(isset($_GET['id']) && isset($_GET['token_reset'])){
            // POUR TESTER :
            // http://localhost/Espace_membre_v2/index.php?espace_membre=reset&id=95&token_reset=FirQ4Yu4yrwhlS4fgG9iZEDZzTE5qaNgDVaPgz9TeYiG7gZc26WTs2tnfkAe
            resetPasswordUser();
        }else{
            displayLogin(); // On redirige vers la page de connexion
        }
        displayResetPassword();

    // GESTION DU MOT DE PASSE OUBLIE (formulaire de demander de reset mot de passe via son adresse email)
    }elseif($_GET['espace_membre'] == 'forget'){

        if(!empty($_POST) && !empty($_POST['email'])){
            forgetPasswordUser();
        }
        displayForgetPassword();

    // GESTION DE LA DECONNEXION UTILISATEUR
    }elseif($_GET['espace_membre'] == 'logout'){
        //
        logoutUser();
    }




}elseif(isset($_GET['blog'])){

    if($_GET['blog'] == 'listPosts'){
        // Récupération et affichage des posts (billets),  (function listePosts() du fichier blogController.php)
        listPosts(); 

    // Sinon si la variable action vaut 'post' alors...
    }elseif($_GET['blog'] == 'post'){
        // Si il y a dans l'url un id et qu'il est supérieur à 0 alors...
        if (isset($_GET['id']) && $_GET['id'] > 0){
            post(); // Affichage du post et des ses commentaires (function post() du fichier controller.php)
        }
        else{
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    // Sinon si la variable action vaut addComment alors...
    }elseif($_GET['blog'] == 'addComment'){
        // Si il y a dans l'url un id (id billet) supérieur à 0 alors...
        if(isset($_GET['id']) && $_GET['id'] > 0){
            // Si l'auteur et le commentaire (du formulaire) on bien été envoyés alors...
            
            //var_dump('le commentaire c\'est : ' . $_POST['comment']);
            
            if(!empty($_POST['author']) && !empty($_POST['comment'])){
                addComment($_GET['id'], $_POST['author'], $_POST['comment']); // On insére dans la bdd le commentaire (function addComment() du fichier controller.php)
            }else{
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }else{
            //echo 'Erreur : aucun identifiant de billet envoyé';
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }elseif($_GET['blog'] == 'editComment'){
        
        // Si il y a dans l'url un id (id billet) et supérieur à 0 alors...
        if(isset($_GET['id']) && $_GET['id'] > 0){
            // Si l'auteur et le commentaire (du formulaire) on bien été envoyés alors...
            post2(); // Affichage du commentaire à modifier et du formulaire pour réécrire le commentaire
            

            //var_dump($_GET['id']); // Affiche l'id du commentaire à modifier
            //var_dump($_POST['commentModif']); // Affiche bien le commentaire modifié de l'utilisateur
            
            // Si on soumet le formulaire (appuie sur le bouton submit) alors...
            if(isset($_POST['submit'])){
                if(!empty($_POST['commentModif'])){

                    edit($_GET['id'], $_POST['commentModif']); // On modifie dans la bdd le commentaire (function editComment() du fichier controller.php)
                }else{
                    throw new Exception('Tous les champs ne sont pas remplis !!');
                }
                
            }
            
        }else{
            //echo 'Erreur : aucun identifiant de billet envoyé';
            throw new Exception('Aucun identifiant de billet envoyé');
        }
        
    }
    /*
    echo "on est bien? ";
    displayBlog();
    */

}else{
    // Si il n'y a pas de variable dans l'url on affiche la page d'accueil
    home();
}
    /*
if(isset($_GET['blog'])){

    echo "on est bien? ";
    displayBlog();

}else{
    // Si il n'y a pas de variable dans l'url on affiche la page d'accueil
    //home();
}
*/





