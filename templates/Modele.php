<!DOCTYPE html>
<html>
    <head>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zi1bvc4rum0rk645xk1e5dq7ybgjb8fzaktl15q3m88bnqkl"></script>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
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
    </p>
    <?php endforeach; ?>
</div>

      <a href='register.php'>Inscription</a>
      <a href="index.php?route=login">Connection</a>
</body>
</html>