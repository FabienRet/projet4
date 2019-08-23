<!DOCTYPE html>
<html>
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
    <title>Mon Bô Blog</title>
</head>
<body>
<?php $donnees = $result->fetch(); ?>

<p class="newComments">Modifier votre commentaire :
    <form method="post" action="../public/index.php?route=update_comment&ID_article=<?php echo $_GET['ID_article'];?>&ID_comment=<?php echo $_GET['ID_comment'];?>" class="newComments">
<p>
    <label for="pseudo">Pseudo</label> : <input type="text" name="auteur" id="auteur" value="<?php echo $donnees['auteur']; ?>" /><br />
    <label for="message">Message</label> :  <input type="text" name="commentaire" id="commentaire" value="<?php echo $donnees['commentaire']; ?>" /><br />

    <input type="submit" value="Envoyer" />
</p>
</form>
</p>
</body>
</html>