<?php

/******************************************************************************************************/
/*************** PAGE DE PRESENTATION DU COMPTE DE L'UTILISATEUR *************************************/
/****************************************************************************************************/

use jeremie\NumberManager; // UTILISATION DE LA METHODE formatDateFr() qui format les date au format fr de la classe NumberManager

?>

<?php ob_start(); ?>

    <h1 class="text-center mt-4">Votre compte :</h1>

    <hr class="bg-secondary">
    
    <h2 class="text-center my-5">Bienvenue <?= $_SESSION['infoUser']->username; ?> </h2>

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
        </tbody>
        <tfoot>
            <!-- FOOTER (Liens pour déplier les formulaires) -->
            <tr class="table-info">
            <td>
                <a href="" id="changePassword">Changer de mot de passe</a>
            </td>
            <td></td>
            <td>
                <a href="" id="avatar">Inclure/modifier sa photo de profil</a>
            </td>
            </tr>
        </tfoot>
    </table> 

    <hr class="bg-secondary my-5">

    <div id="formulary">

        <!-- CREE EN JAVASCRIPT (account_formulary.js) -->
        <!-- FORMULAIRE DE CHANGEMENT DE MOT DE PASSE -->
        <!--
        <form action="" method="POST" id="formId">

            <div class="form-group" id="divPass">
                <label for="">Changer de mot de passe :</label>
                <input type="password" name="mdp" class="form-control" placeholder="Entrer votre nouveau mot de passe">
            </div>
            <div class="form-group" id="divPass_confirm">
                <label for="">Confirmer le nouveau mot de passe :</label>
                <input type="password" name="mdp2" class="form-control" placeholder="Confirmation du mot de passe">
            </div>

            <button type="submit" class="btn btn-primary ">Enregistrer les modifications</button>

        </form>
        -->

    </div>

        <!-- CREE EN JAVASCRIPT (account_formulary.js) -->
        <!-- http://randomuser.me/api/portraits/men/1.jpg -->
        <!-- FORMULAIRE DE CREATION OU MODIFICATION D'AVATAR -->
        <!--
        <form action="" method="POST" id="formAvatar">

            <div class="form-group" id="divAvatar">
                <label for="">Ajouter une photo de profil</label>
                <input type="text" name="avatar" class="form-control" placeholder="Entrer l'url de votre photo de profil">
            </div>

            <button type="submit" class="btn btn-primary ">Ajouter la photo de profil</button>

        </form>
        -->

    <!-- Script particulier pour les formulaires de la page account.php -->
    <script src="js/js_espace_membre/account_formulary.js"></script>

<?php

$content = ob_get_clean();

require 'template.php';

?>