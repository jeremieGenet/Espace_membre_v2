<!-- Ce fichier est invoqué par le fichier controller/blogController.php (dans la fonction listPosts()), lui-même invoqué par le routeur index.php -->


<!-- VUE DES POSTS (billet) avec appel au template -->

<?php 

//$title = 'Mon blog, liste des posts'; 

//var_dump($post);
//var_dump($posts);

?>


<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<h4>Derniers billets du blog:</h4>

<?php

// Affichage des billets, 'fetch' veut dire 'va chercher'.
while ($data = $posts->fetch()){

    //var_dump($post);
    //var_dump($posts);

?>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($data['title']); ?>     
        <em>le <?php echo $data['createdAt_fr']; ?></em>
        par <?php echo $data['author_post']; ?>
    </h3>

    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($data['content'])); // nl2br(). permet de convertir les retours à la ligne en balises HTML<br />.
    ?>
        <br/>
        <em>
            <!-- lien qui dirige vers le post et ses commentaires -->
            <!-- la variable 'blog' (traitée par le routeur index.php) va permettre de savoir vers quelle page on va rediriger -->
            <a href="index.php?blog=post&id=<?php echo $data['id']; ?>">
                Commentaires <?php echo $data['id']; ?>
            </a>
        </em>
    </p>
</div>

<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
<?php 

$content = ob_get_clean(); 

require 'view/frontend/template.php';

?>


