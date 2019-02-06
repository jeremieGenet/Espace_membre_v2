<!-- Ce fichier est invoqué par le fichier controller/blogController.php (dans la fonction post()), lui-même invoqué par le routeur index.php -->

<!-- VUE DU POST, DE SES COMMENTAIRES, ET DU FORMULAIRE d'envoie de commentaires (appel au template) -->

<?php ob_start(); ?>

    <h1>Mon super blog !</h1>
    
    <h2> <a href="index.php?blog=listPosts">Retour à la liste des billets</a> </h2>

    <h2>Commentaire à modifier : </h2>
    
    <!-- Affichage (dans une boucle) des commentaires -->
    <?php
    while ($comment = $comments->fetch()){
    ?>
        <p>
            <strong><?php echo htmlspecialchars($comment['author']); ?></strong> le <?php echo $comment['comment_date_fr']; ?>
            
            <?php
            //echo $comment['author'];
            //echo "Ca marche?";
            ?>

        </p>
        <p>
            <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>
    
    
    <!-- Affichage du commentaire à modifier -->
    <h2>Remplir le formulaire pour modifier le commentaire :</h2>
    
    <?php
    //var_dump($comment['id']); // Affiche l'id du commentaire à modifier
    //var_dump($comment['comment']); // Affiche le contenu du commentaire à modifier
    ?>
    
    <!-- Affichage du formulaire d'envoie (de commentaires) -->
    <form action="index.php?blog=editComment&amp;id=<?= $comment['id'] ?>" method="post">
        
        <div>
            <label for="comment">Nouveau commentaire : </label><br />
            <textarea id="comment" name="commentModif"></textarea>
        </div>
        <div>
            <input type="submit" name="submit" />
        </div>
    </form>
    
    <?php
    } // Fin de boucle while
    ?>
    
<?php 

$content = ob_get_clean(); 

require 'view/frontend/template.php';

?>





































