<?php 

/********************************************************************************************************************************/
/********** PAGE QUI PERMET DE FAIRE UNE DEMANDE DE SON MOT DE PASSE OUBLIE (envoie d'un mail, avec token) ************************/
/******************************************************************************************************************************/

/*
require_once '../../inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

// Si des données ont été postées et que l'email n'est pas vide alors...
if(!empty($_POST) && !empty($_POST['email'])){

    $auth = App::getAuth(); // On crée un nouvelle instance de Auth.php (gestionnaire d'identification)
    $db = App::getDatabase(); // On recup la bdd
    $session = Session::getInstance(); // On créé une instance de Session.php pour se servir de setFlash() un peu après

    // Si le reset du password est ok (qu'il ne retourne pas false) alors...
    if($auth->resetPassword($db, $_POST['email'])){
        $session->setFlash('success', "Les instructions du rappel de mot de passe vous ont été envoyées par email !");
        App::redirect('index.php?espace_membre=login');
    }else{
        $session->setFlash('danger', "Aucun compte ne correspond à cette adresse !");
    }

}
*/

?>

<?php ob_start(); ?>


<h1>Mot de passe oublié</h1>

<!-- GESTION DES ERREUR DU FORMULAIRE -->
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach ($errors as $error):?>
                <li> <?= $error; ?> </li>   
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- FORMULAIRE DE RECUPERATION DE MOT DE PASSE (via l'email) -->
<form action="" method="POST">

    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    
    <button type="submit" class="btn btn-primary">Générer un nouveau mot de passe</button>

</form>

<?php

$content = ob_get_clean();

require 'template.php';

?>