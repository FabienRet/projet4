<!DOCTYPE html>
<html>
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
    <title>Mon Bô Blog</title>
</head>
<body>

<p class="newComments">Ajouter un nouveau commentaire :
    <form method="post" action="../public/index.php?route=add_comment&article=<?php echo $_GET['article'];?>" class="newComments">
<p>
    <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])){echo $_POST['pseudo'];}?>" /><br />
    <label for="message">Message</label> :  <input type="text" name="message" id="message" value="<?php if(isset($_POST['message'])){echo $_POST['message'];}?>" /><br />

    <input type="submit" value="Envoyer" />
</p>
</form>
</p>
</body>
</html>
