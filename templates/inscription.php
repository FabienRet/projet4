<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>

    <form method="post" action="../public/index.php?route=inscription" class="newComments">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" />
        <br />
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass" />
        <br />
        <label for="checkpass">Confirmation mot de passe</label>
        <input type="password" name="checkpass" id="checkpass" />
        <br />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" />

        <input type="submit" value="Envoyer" />
    </form>

</body>
</html>