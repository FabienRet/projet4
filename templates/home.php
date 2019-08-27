<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <title>Mon blog</title>
    <link href="../public/css/style.css" rel="stylesheet" />
</head>

<body>
<!--<h1>Mon super blog !</h1>-->
<img  class = "image" src="../public/fonts/banniere2.jpg">
<p>Derniers billets du blog :</p>
<?php
var_dump($_SESSION);
if (!empty($_SESSION['pseudo'])){
    echo ('Bonjour '. $_SESSION['pseudo']);
}
?>


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
<?php
if(!empty($_SESSION)){
    if(($_SESSION['id']) == 1){
        echo ('<a href="../public/index.php?route=logout">Déconnection</a>');
        }else{
        if(($_SESSION['id']) == 2){
            echo('<a href="../public/index.php?route=add_article">Ajouter un nouvel article</a></br><a href="../public/index.php?route=logout">Déconnection</a>');
        }
    }
}else{
        echo('<a href=\'../public/index.php?route=inscription\'>Inscription</a> <a href="../public/index.php?route=login">Connection</a>');
    }

?>


<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
</body>
</html>