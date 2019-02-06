<!-- Ce fichier est invoqué par le fichier controller/blogController.php (dans la fonction post()), lui-même invoqué par le routeur index.php -->

<!-- VUE DU POST, DE SES COMMENTAIRES, ET DU FORMULAIRE d'envoie de commentaires (appel au template) -->

<?php ob_start(); ?>

    <h1>Mon super blog !</h1>
    <h5> <a href="index.php?blog=listPosts">Retour à la liste des billets</a> </h5>
    
    <!-- Affichage du post sélectionné -->
    <div class="news">
        <h3>
            <?php echo htmlspecialchars($post['title']); ?>
            <em>
                le <?php echo $post['createdAt_fr']; ?>
            </em>
        </h3>
        <p> 
            <?php
            echo nl2br(htmlspecialchars($post['content']));

            ?>
        </p>
    </div> 
    <h2>Commentaires</h2>
    
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
            
            <!-- ------------------------------------------------ -->
            <em>
                <!-- lien qui dirige vers le post et ses commentaires -->
                <!-- la variable 'blog' (traitée par le routeur index.php) va permettre de savoir vers quelle page on va rediriger -->
                <a href="index.php?blog=editComment&id=<?php echo $comment['id']; ?>">           (Modifier)
                    Commentaires id = <?php echo $comment['id']; ?> 
                    post id = <?php echo $post['id']; ?>
                </a>
            </em>
            <!-- ------------------------------------------------ -->
            
        </p>
        <p>
            <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>
        
    <?php
    }
    ?>
    
    <!-- Affichage du formulaire d'envoie (de commentaires) -->
    <form action="index.php?blog=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
    
    
<?php

$content = ob_get_clean(); 

require 'view/frontend/template.php';

?>


