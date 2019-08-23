<!DOCTYPE html>
<html>
<head>
    <script src="https://your_server/tinymce.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
    <script>
        tinymce.init({
            selector: '#message'
        });
    </script>
	<title>Mon Bô Blog</title>
</head>
<body>

<p>Bienvenu sur l'éditeur de texte. ici vous pouvez ajouter votre nouvel article.</p>
<p>Pensez à respecter au minimums les règles de français basique.</p>
<form  method="post" action="../public/index.php?route=add_article" class="newComments">
        <p>
        <label for="titre">Titre</label> : <input type="text" name="titre" id="pseudo" /><br />
        <label for="article">Article</label> :  <input type="text" name="article" id="message" /><br />

        <input type="submit" value="Envoyer" />
    </p>
    </form>
    </body>
</html>
