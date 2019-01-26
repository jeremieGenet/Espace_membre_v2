<?php
// INDICATION DE CHEMIN BRACKET : http://localhost/Cours_POO_php_Architecture_MVC/7.Exercice_MVC

/*
    ROUTEUR qui va diriger vers la page voulue (en fonction des lien de redirection des différentes pages)
    Bdd utilisée : test, et Tables utilisée : posts et comments
*/


require('controller/controller.php'); // Contient les fonctions

try{ // On essaie de faire des choses (et si on se retrouve dans dans un 'throw new Exception' alors le code s'arrête pour aller directement dans le bloc 'catch' et afficher l'erreur)
    if(isset($_GET['espace_membre'])){
        
        if($_GET['espace_membre'] == 'register'){
            
            if(!empty($_POST)){
                registerUser($_POST['username'], $_POST['email'], $_POST['mdp'], $_POST['mdp2']);  
            }
            require('register.php');
            

        }elseif($_GET['espace_membre'] == 'login'){

            if(!empty($_POST)){
                loginUser($_POST['username'], $_POST['mdp']);  
            }
            require('view/front_end/login.php');

        }elseif($_GET['espace_membre'] == 'confirm'){
            if(isset($_GET['id']) && isset($_GET['token_confirmation'])){
                confirmUser($_GET['id'], $_GET['token_confirmation']);
            }

            // lien reçu par l'utilisateur (après son enregistrement) pour tester la confirmation de compte (id et confirmation_token récup dans la bdd de l'utilisateur )
            // http://localhost/Espace_Membre_v1/index.php?id=47&token_confirmation=2qf60DUYR3U49V7DoNOmzxSgyNJwO0cmY0qKsDL9XVZ9vLNcPJaDowcdv726
            
            
        }elseif($_GET['espace_membre'] == 'account'){
            //
            //accountUser();
            require('view/front_end/account.php');
        }elseif(isset($_GET['reset'])){
            //
            resetPasswordUser();
        }elseif(isset($_GET['forget'])){
            //
            forgetPasswordUser();
        }elseif(isset($_GET['login'])){
            //
            loginUser();
        }elseif(isset($_GET['logout'])){
            //
            logoutUser();
        }
    }else{
        // Si il n'y a pas de variable dans l'url on affiche la page d'accueil
        //home();
        require('register.php');
    }
}
catch(Exception $e){ // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage(); // On stock le message d'erreur dans '$errorMessage'
    require('view/front_end/errorView.php');  // On appel le fichier qui représente la "vue" de l'erreur
}






