<?php

use jeremie\NumberManager; // UTILISATION DE LA METHODE DateFr() qui format les date au format fr

/******************************************************************************************************/
/*************** PAGE DE PRESENTATION DU COMPTE DE L'UTILISATEUR *************************************/
/****************************************************************************************************/

/*
require_once '../../inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

$db = App::getDataBase(); // Connexion à la bdd (getDataBase est une méthode statique)

// On instancie la class Auth.php (qui permet la gestion de l'authentification) avec la méthode getAuth() de la classe App.php (qui se charge elle-même d'instancier les autres classe)
// et on lui applique la méthode restrict() de la classe Auth.php qui permet que s'il personne n'est connecté alors on refuse l'accès à account.php avec un message flash
App::getAuth()->restrict();


// VERIFICATIONS LORS DE LA SOUMISSION DU FORMULAIRE
if(!empty($_POST)){
   
    if(empty($_POST['mdp'])){

        $_SESSION['flash']['warning'] = "Il faut remplir le mot de passe !";
    // Si les 2 mots de passes sont différents (le nouveau et sa confirmation) alors...
    }elseif($_POST['mdp'] != $_POST['mdp2']){
    
        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas !";
    // Sinon on fait la modif dans la bdd
    }else{
        $user_id = $_SESSION['infoUser']->id; // On récup l'id de l'utilisateur connecté
        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT); // On hash le nouveau mot de passe

        require_once '../../inc/db.php'; ////////////////////// trouver un moyen de ne pas avoir à inclure ce fichier ($db = App::getDataBase(); ne fonctionne pas)
        
        $req = $pdo->prepare('UPDATE users SET mdp = ? WHERE id = ?');
        $req->execute([$mdp, $user_id]);

        $_SESSION['flash']['success'] = "votre mot de pase à bien été mis à jour !";
    }
}
*/

?>

<?php ob_start(); ?>

    <h1 class="text-center mt-4">Votre compte :</h1>

    <hr class="bg-secondary">
    
    <h2 class="text-center my-5">Bienvenue <?= $_SESSION['infoUser']->username; ?> </h2>


    <!-- AMELIORATION DE LA PAGE ACCOUNT 
    
    ON VEUT : 
    
    - un tableau qui récap les info utilisateur:
        avec username, adresse email, date d'enregistrement sur le site, avatar utilisé
    - dans ce tableau aussi:
        un lien pour accéder au formulaire de changement de mot de passe
        un lien pour accéder à la possibilité d'ajouter un avatar (qui sera visible dans la nav-bar)
     -->

    <?php

        

    ?>

    <table class="table table-hover">
    <thead>
        <!-- HEADER DU TABLEAU -->
        <tr class="table-secondary">
        <th>Votre adresse email</th>
        <!-- Utilisation de la méthode maison dateFr() pour formater la date de la bdd au format fr (méthode de la classe NumberManager) -->
        <th scope="col">Votre date d'inscription</th>
        <th scope="col">Votre image de profil</th>
        </tr>
    </thead>
    <tbody>
        <!-- BODY (INFORMATION UTILISATEUR) -->
        <tr class="table-primary">
        <td><?= $_SESSION['infoUser']->email ?></td>
        <td><?= NumberManager::formatDateFr($_SESSION['infoUser']->confirmed_at); ?></td>
        <td>Avatar vide</td>
        </tr>

        <!-- BODY (Liens pour déplier les formulaires) -->
        <tr class="table-info">
        <td>
            <a href="" id="changePassword">Changer de mot de passe</a>
        </td>
        <td></td>
        <td>
            <a href="" id="avatar">Inclure/modifier sa photo de profil</a>
        </td>
        </tr>
        
    </tbody>
    </table> 

    <hr class="bg-secondary my-5">

    
    <!-- FORMULAIRE DE CHANGEMENT DE MOT DE PASSE -->
    <form action="" method="POST">

        <div class="form-group">
            <label for="">Changer de mot de passe :</label>
            <input type="password" name="mdp" class="form-control" placeholder="Entrer votre nouveau mot de passe">
        </div>
        <div class="form-group">
            <label for="">Confirmer le nouveau mot de passe :</label>
            <input type="password" name="mdp2" class="form-control" placeholder="Confirmation du mot de passe">
        </div>

        <button type="submit" class="btn btn-primary ">Enregistrer les modifications</button>

    </form>

    <!-- http://randomuser.me/api/portraits/men/1.jpg -->
    <!-- FORMULAIRE DE CREATION OU MODIFICATION D'AVATAR -->
    <form action="" method="POST">

        <div class="form-group">
            <label for="">Ajouter une photo de profil</label>
            <input type="text" name="avatar" class="form-control" placeholder="Entrer l'url de votre photo de profil">
        </div>

        <button type="submit" class="btn btn-primary ">Ajouter la photo de profil</button>

    </form>

    <!-- Script particulier pour les formulaires de la page account.php -->
    <script src="js/js_espace_membre/account_formulaire.js"></script>

<?php

$content = ob_get_clean();


require 'template.php';



?>