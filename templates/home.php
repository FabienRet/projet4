<!DOCTYPE html>
<html>
    <head>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <!--<h1>Mon super blog !</h1>-->
        <img  class = "image" src="../public/fonts/banniere2.jpg">
        <p>Derniers billets du blog :</p>
 
        

<div class="news">
    <?php
    foreach ($result as $donnees):;?>
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    <br />
    <em><a href="../public/index.php?route=comment&article=<?php echo $donnees['ID']; ?>">Commentaires</a><a href="../public/index.php?route=get_article&article=<?php echo $donnees['ID']; ?>">Modifier</a><a href="../public/index.php?route=delete_article&article=<?php echo $donnees['ID']; ?>">Supprimer</a></em>
    </p>
    <?php endforeach; ?>
</div>

<a href="index.php?route=add_article">Ajouter un nouvel article</a>
      <a href='../templates/inscription.php'>Inscription</a>
      <a href="../templates/login.php">Connection</a>
</body>
</html>