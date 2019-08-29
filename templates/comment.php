<?php $this->title='Commentaires';?>
        <p><a href="../public/index.php">Retour à la liste des billets</a></p>


<?php $donnees = $article->fetch(); ?>
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

foreach ($comments as $donnees)
{
?>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?>
    <?php
    if($_SESSION['pseudo'] ==  $donnees['auteur'] || $_SESSION['id'] == 2) {
        echo '<a href="../public/index.php?route=delete_comment&ID_comment=' . $donnees['ID'] . '&ID_article=' . $_GET['article'] . '">Supprimer </a>';
        echo '<a href="../public/index.php?route=get_comment&ID_comment=' . $donnees['ID'] . '&ID_article=' . $_GET['article'] . '">Modifier </a></p>';
    }
    ?>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
} // Fin de la boucle des commentaires

?>
<p class="newComments">Ajouter un nouveau commentaire :
    <form method="post" action="../public/index.php?route=add_comment&article=<?php echo $_GET['article'];?>" class="newComments">
<p>
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
