<?php $this->title = 'Administration'; ?>

<h1>Administration</h1>
<p>En construction</p>
<div class="news">
    <?php
    foreach ($articles as $donnees):;?>
        <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
        </h3>

        <p>
            <?php
            // On affiche le contenu du billet
            ?>
            <br />
            <em><a href="../public/index.php?route=comment&article=<?php echo $donnees['ID']; ?>">Commentaires</a><a href="../public/index.php?route=get_article&article=<?php echo $donnees['ID']; ?>">Modifier</a><a href="../public/index.php?route=delete_article&article=<?php echo $donnees['ID']; ?>">Supprimer</a></em>
        </p>
    <?php endforeach; ?>
</div>
<a href="../public/index.php?route=add_article">Créer un nouvel article</a></br>
<a href="../public/index.php">Retour à l'accueil</a>