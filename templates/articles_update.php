<!DOCTYPE html>
<html>
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
	<title>Mon Bô Blog</title>
</head>
<body>
<?php $donnees = $result->fetch(); ?>

<p>Bienvenu sur l'éditeur de texte. ici vous pouvez ajouter votre nouvel article.</p>
<p>Pensez à respecter au minimums les règles de français basique.</p>
<form method="post" action="../public/index.php?route=update_article&article=<?php echo $_GET['article'];?>" class="newComments">
        <label for="titre">Titre</label> : <input type="text" name="titre" id="pseudo" value="<?php echo $donnees['titre']; ?>"/><br />
        <label for="article">Article</label> :  <input type="text" name="article" id="message" value="<?php echo $donnees['contenu']; ?>" /><br />

        <input type="submit" value="Envoyer" />
    </form>
    </body>
</html>
