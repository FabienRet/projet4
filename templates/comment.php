<!DOCTYPE html>
<html>
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
	<title>Mon Bô Blog</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css"/>
</head>
<body>
<h1>Mon super blog !</h1>
        <p><a href="../public/index.php">Retour à la liste des billets</a></p>


<?php $donnees = $art->fetch(); ?>
<div class="news">

    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
//fonction getComment


// Récupération des commentaires

foreach ($result as $donnees)
{
?>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?><a href="../public/index.php?route=delete_comment&ID_comment=<?php echo $donnees['ID']; ?>&ID_article=<?php echo $_GET['article']; ?>">Supprimer </a><a href="../public/index.php?route=get_comment&ID_comment=<?php echo $donnees['ID']; ?>&ID_article=<?php echo $_GET['article']; ?>">Modifier </a></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
} // Fin de la boucle des commentaires

?>
<p class="newComments">Ajouter un nouveau commentaire :
    <form method="post" action="../public/index.php?route=add_comment&article=<?php echo $_GET['article'];?>" class="newComments">
<p>
    <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])){echo $_POST['pseudo'];}?>" /><br />
    <label for="message">Message</label> :  <input type="text" name="message" id="message" value="<?php if(isset($_POST['message'])){echo $_POST['message'];}?>" /><br />

    <input type="submit" value="Envoyer" />
</p>
</form>
</p>

<!--<script>
    function confirm(){
       var agree= confirm("Etes vous sur de vous ?");
       if(agree){
        return true;
       }else{
        return false;
       }
    }
</script>-->
</body>
</html>