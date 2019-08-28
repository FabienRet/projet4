<?php
$article = new \App\src\DAO\ArticleDAO();
$articles = $article->getArticle($_GET['articleId']);
$data = $articles->fetch();
?>
<div class="text-left">
    <h2><?= $data['titre'];?></h2>
    <p><?= $data['contenu'];?></p>
    <p>Créé le <?= $data['date_creation_fr'];?></p>
</div>
<?php
$articles->closeCursor();
?>
<a href="../public/index.php">Retour à l'accueil</a>